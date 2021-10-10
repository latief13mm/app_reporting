<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\DB;
use App\Models\listorder;
use App\Models\Resource;
use Dompdf\Dompdf;

class orderListController extends Controller
{
    public function index()
    {
        $orderList = DB::table('orderlist')->get();
        return view('orderlist.index', ['orderList' => $orderList]);

    }

    public function print()
    {
        $orderList = DB::table('orderlist')->get();
        return view('orderlist.print', ['orderList' => $orderList]);

    }

    public function printpdf()
    {
        $orderList = DB::table('orderlist')->get();
        $html = view('orderlist.printpdf', ['orderList' => $orderList]);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

    }

    public function searchOrder(Request $request)
    {
        $sort = $request->search;
        $listorders = listorder::where('date_order', 'like', "%" . $sort . "%")
                    ->paginate(10);

        $listorders -> withPath('orderlist');
        $listorders -> appends($request->all());
        return view('orderlist.index', compact('listorders', 'sort' ))->with('i', (request()->input('page', 1) - 1) * 5);

    }
    
    public function paginateOrder(Request $request)
    {
        $listorders = listorder::query();

        if($keyword = $request->input('s')){
            $listorders->whereRaw("name_product LIKE '%" . $keyword . "%'" )
                ->orWhereRaw("total LIKE '%" . $keyword . "%'")
                ->orWhereRaw("date_income LIKE '%" . $keyword . "%'");
        }

        $perPage = 10;
        $page = $request->input('page', 1);
        $total = $listorders->count();

        $result = $listorders->offset(($page - 1) * $perPage)->limit($perPage)->get();

        return[
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'last_page' => ceil($total / $perPage)
        ];

        return view('orderlist.index', compact('listorders', 'keyword'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resources = Resource::all();
        return view('orderlist.add', compact('resources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_order' => 'required',
            'month_income' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'resource_id' => 'required'
        ],
        [
            'date_order.required' => 'Tanggal tidak boleh kosong',
            'name_product.required' => 'Nama produk tidak boleh kosong',
            'quantity.required' => 'qunatity tidak boleh kosong',
            'total.required' => 'Total tidak boleh kosong',
            'resource_id.required' => 'Sumber tidak boleh kosong'

        ]
        );
        listorder::create([
            'date_order' => $request->date_order,
            'name_product' => $request->name_product,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'resource_id' => $request->resource_id,
        ]);

        return redirect('orderlist')->with('status', 'Successfully added orderlist');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(listorder $listorders)
    {
        $listorders->makeHidden(['resource_id']);
        return view('orderlist.show', compact('listorders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(listorder $listorders)
    {
        $resources = Resource::all();
        return view('orderlist.edit', compact('listorders', 'resources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, listorder $listorders)
    {
        $request->validate([
            'date_order' => 'required',
            'total' => 'required',
            'resource_id' => 'required'
        ],
        [
            'date_order.required' => 'Tanggal tidak boleh Kosong',
            'total.required' => 'Total tidak boleh kosong',
            'resource_id.required' => 'Tidak Boleh Kosong'

        ]
        );
                // cara pertama
                $listorders->date_order = $request->date_order;
                $listorders->total = $request->total;
                $listorders->resource_id = $request->resource_id;
                $listorders->save();
        
                //cara kedua (mass assignment)
                listorder::where('id', $listorders->id)
                ->update([
                    'date_order' => $request->date_order,
                    'total' => $request->total,
                    'resource_id' => $request->resource_id,
                ]);
        
                return redirect('orderlist')->with('status', 'Successfully Update orderlist');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(listorder $listorders)
    {

        listorder::where('id', $listorders->id)->delete();

        return redirect('orderlist')->with('status', 'Successfully delete data');
    }
}
