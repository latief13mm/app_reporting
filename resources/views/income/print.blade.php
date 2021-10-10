<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Invoice - Income</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('srtdash/assets/images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{asset('srtdash/assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body onload="window.print();">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- page container area start -->
    <div class="page-container">

        <!-- main content area start -->
        <div class="main-content">
 
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-area">
                                    <div class="invoice-head">
                                        <div class="row">
                                            <div class="iv-left col-6">
                                                <span>Laporan Pemasukan Salt Nusantara</span>
                                            </div>
                                            <div class="iv-right col-6 text-md-right">
                                                <span>Salt Restauran</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="invoice-address">
                                                <h3>Laporan Income Salt Nusantara</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <ul class="invoice-date">
                                                <li>Date : {{ date('d-M-Y') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invoice-table table-responsive mt-5">
                                        <table class="table table-bordered table-hover text-right">
                                            <thead>
                                                <tr class="text-capitalize">
                                                    <th class="text-center" style="width: 5%;">NO</th>
                                                    <th class="text-center">Data Income</th>
                                                    <th>Nama Produk</th>
                                                    <th style="min-width: 100px">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($incomes as $key =>  $data)
                                                <tr>
                                                    <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $data->date_income }}</td>
                                                    <td>{{ $data->name_product }}</td>
                                                    <td>Rp. {{ $data->total }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- <div class="invoice-buttons text-right">
                                    <a href="#" class="invoice-btn">print invoice</a>
                                    <a href="#" class="invoice-btn">send invoice</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content area end -->
    </div>
    <!-- page container area end -->

    <!-- jquery latest version -->
    <script src="{{asset('srtdash/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{asset('srtdash/assets/js/popper.min.js') }}"></script>
    <script src="{{asset('srtdash/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('srtdash/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{asset('srtdash/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{asset('srtdash/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{asset('srtdash/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- others plugins -->
    <script src="{{asset('srtdash/assets/js/plugins.js') }}"></script>
    <script src="{{asset('srtdash/assets/js/scripts.js') }}"></script>
</body>

</html>
