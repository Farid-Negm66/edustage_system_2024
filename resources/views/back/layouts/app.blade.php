
<!doctype html>
<html lang="en" dir="rtl">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords" content="dashboard, admin, bootstrap admin template, codeigniter, php, php framework, codeigniter 4, php mvc, php codeigniter, best php framework, codeigniter admin, codeigniter dashboard, admin panel template, bootstrap 4 admin template, bootstrap dashboard template"/>

    <!-- Title -->
    <title> أكاديمية اديوستديج -  @yield('title') </title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('back') }}/assets/img/brand/favicon.png" type="image/x-icon"/>

    <!-- Bootstrap css-->
	<link href="{{ asset('back') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Icons css -->
    <link href="{{ asset('back') }}/assets/css-rtl/icons.css" rel="stylesheet">

    <!--  Right-sidemenu css -->
    <link href="{{ asset('back') }}/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="{{ asset('back') }}/assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />

    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ asset('back') }}/assets/css-rtl/sidemenu.css">

    <!-- Style css -->
    <link href="{{ asset('back') }}/assets/css-rtl/style.css" rel="stylesheet">
    <link href="{{ asset('back') }}/assets/css-rtl/style-dark.css" rel="stylesheet">

    <!-- Maps css -->
    <link href="{{ asset('back') }}/assets/plugins/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!--- Select2 css --->
    <link href="{{ asset('back') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    
    <!-- Data table css -->
    <link href="{{ asset('back') }}/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('back') }}/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('back') }}/assets/plugins/datatable/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('back') }}/assets/plugins/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('back') }}/assets/plugins/datatable/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('back') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet">

    {{-- alertify --}}
    <link href="{{ asset('back/assets/css-rtl/alertify.rtl.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('back/assets/css-rtl/default.rtl.min.css') }}" type="text/css" rel="stylesheet"/>

    <!-- selectize -->
    <link href="{{ asset('back/assets/selectize.css') }}" type="text/css" rel="stylesheet"/>

    {{-- flatpickr --}}
    <link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">

    {{-- spotlight --}}
    <link href="{{ asset('back/assets/spotlight.min.css') }}" rel="stylesheet" type="text/css" />

    
    @yield('header')

    <!-- Skinmodes css -->
    <link href="{{ asset('back') }}/assets/css-rtl/skin-modes.css" rel="stylesheet" />

    <!-- Animations css -->
    <link href="{{ asset('back') }}/assets/css-rtl/animate.css" rel="stylesheet">

    <!---Switcher css-->
    <link href="{{ asset('back') }}/assets/switcher/css/switcher-rtl.css" rel="stylesheet">
    <link href="{{ asset('back') }}/assets/switcher/demo.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:slnt,wght@11,200..1000&family=Changa:wght@200..800&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: "4_F4";
            src: url("{{ asset('back/fonts/4_F4.ttf') }}");
        }
        body{
            /* font-family: Arial, Helvetica, sans-serif, serif; */
            /* font-family: "4_F4", serif; */
            font-family: Almarai;
            
        }

        table.dataTable tbody th, table.dataTable tbody td{
            padding: 5px 5px 1px !important;
        }

        .breadcrumb-header .content-title{
            font-size: 16px !important;
            font-weight: bold !important;
        }

        table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td{
            font-size: 11px !important;
            font-weight: bold !important;
        }

        .modal form label {
            font-size: 12px !important;
            font-weight: bold;
        }

        .modal form .text-danger{
            font-size: 11px;
            font-weight: bold;
        }

        #image_preview_form{
            display: block;
            height: 200px;
            width: 70%;
            margin: 0px auto;
            margin-top: -50px;
            border-radius: 3px;
            border: 1px solid #d7d7d7;
        }

        @media (min-width: 768px) {
            #image_preview_form{
                height: 293px;
                display: block;
                width: 100%;
                margin-top: 66px;
                border-radius: 3px;
                border: 1px solid #d7d7d7;
            }
        }

        .side-menu__label{
            font-size: 12.5px;
        }
        .side-menu__label{
            font-weight: bold !important;
            color: #4a4444 !important;
            font-size: 10.5px;
        }

        .slide-item{
            color: #b5b5b5 !important;
            font-size: 10.5px;
        }   

        .app-sidebar .side-item.side-item-category{
            font-size: 10.5px !important;
            font-weight: bold !important;
            color: #bf0001;
        }

        @media (min-width: 768px) {
            .app.sidenav-toggled .side-menu__label {
                font-size: 10.5px !important;
            }
        }

        .spl-title{
            text-align: center !important;
        }

        #example1_processing{
            padding: 10px 10px 35px !important;
            border: 2px solid red !important;
            color: red !important;
        }
        /* ////////////////////////////////////////////  top css new css edit  ///////////////////////////////////////////////// */





        .require_input{
            font-size: 7px;
            position: absolute;
            left: 15px;
            top: 17px;
            color: red;
        }
        
        .breadcrumb-header {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 29px !important;
        }

        .dataTables_length{
            margin-left: 10px;
        }

        table .edit, table .delete, table .show, table .crm_info, table .print{
            padding: 1px 6px;
        }

        .ajs-button {
            border: 0px;
            font-weight: bold;
        }

        .ajs-cancel {
            background: rgb(209, 56, 56) !important;
            color: #fff !important;
        }

        .ajs-success{
            font-weight: bold;
            /* width: 350px !important; */
            background: rgb(77, 124, 91) !important;
        }

        .ajs-error{
            font-weight: bold;
            /* width: 350px !important; */
            background: rgb(155, 56, 64) !important;
        }

        .modal form label{
            margin-top: 10px !important;
        }
        .modal form input::placeholder{
            font-size: 12px;
        }

        .sub-icon{
            color: rgb(37, 37, 37) !important;
            font-weight: bold !important;
        }
        .slide-item{
            font-weight: bold !important;
        }

        .spinner_request, .spinner_request2{
            width: 1.4rem;
            height: 1.4rem;
            border-width: 0.2em;
            position: relative;
            bottom: 2px;
            right: 5px;
            display: none;
        }

        .alertify{ 
            z-index:999999 !important;
            display: block !important;
        }
        
        .alertify-notifier{ 
            z-index:999999 !important;
        }
    </style>
</head>

    <body class="main-body app sidebar-mini {{-- dark-theme --}}">
    	
        <!-- Start Switcher -->
        @include('back.layouts.switcher')
        <!-- End Switcher -->

        <!-- Loader -->
        <div id="global-loader">
            <img src="{{ asset('back') }}/assets/img/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /Loader -->

        <!-- Page -->
        <div class="page">

            <!-- main-sidebar -->
            @include('back.layouts.sidebar')
			<!-- main-sidebar -->

            <!-- main-content -->
			<div class="main-content app-content">

                <!-- main-header -->
                @include('back.layouts.navbar')
				<!-- /main-header -->


                <!-- container -->
                @yield('content')				
				<!-- Container closed -->
			</div>
			<!-- main-content closed -->

            <!-- Sidebar-right-->
            @include('back.layouts.right_sidebar')
			<!--/Sidebar-right-->
            
            <!-- Footer opened -->
            @include('back.layouts.footer')
			<!-- Footer closed -->
        </div>
		<!-- End Page -->



        <!-- Back-to-top -->
        <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

        <!-- JQuery min js -->
        <script src="{{ asset('back') }}/assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap js -->
        <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="{{ asset('back') }}/assets/plugins/bootstrap/js/bootstrap-rtl.js"></script>

        <!-- Ionicons js -->
        {{-- <script src="{{ asset('back') }}/assets/plugins/ionicons/ionicons.js"></script> --}}

        <!-- Moment js -->
        {{-- <script src="{{ asset('back') }}/assets/plugins/moment/moment.js"></script> --}}

        <!-- P-scroll js -->
        <script src="{{ asset('back') }}/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js"></script>
        <script src="{{ asset('back') }}/assets/plugins/perfect-scrollbar/p-scroll-rtl.js"></script>

        <!-- Sticky js -->
        <script src="{{ asset('back') }}/assets/js/sticky.js"></script>

        <!-- eva-icons js -->
        {{-- <script src="{{ asset('back') }}/assets/js/eva-icons.min.js"></script> --}}

        <!-- Horizontalmenu js-->
        <script src="{{ asset('back') }}/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

        <!-- Rating js-->
        {{-- <script src="{{ asset('back') }}/assets/plugins/rating/jquery.rating-stars.js"></script>
        <script src="{{ asset('back') }}/assets/plugins/rating/jquery.barrating.js"></script> --}}

        <!-- Sidebar js -->
        <script src="{{ asset('back') }}/assets/plugins/side-menu/sidemenu.js"></script>

        <!-- Right-sidebar js -->
        <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-rtl.js"></script>
        <script src="{{ asset('back') }}/assets/plugins/sidebar/sidebar-custom.js"></script>

        
		<!--Internal  Chart.bundle js -->
		<script src="{{ asset('back') }}/assets/plugins/chart.js/Chart.bundle.min.js"></script>

		<!--Internal Sparkline js -->
		<script src="{{ asset('back') }}/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

		<!-- Raphael js -->
		<script src="{{ asset('back') }}/assets/plugins/raphael/raphael.min.js"></script>

		<!--Internal Apexchart js-->
		{{-- <script src="{{ asset('back') }}/assets/js/apexcharts.js"></script> --}}

		<!-- Internal Map -->
		{{-- <script src="{{ asset('back') }}/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
		<script src="{{ asset('back') }}/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}

		<!--Internal  index js -->
		<script src="{{ asset('back') }}/assets/js/index.js"></script>
		{{-- <script src="{{ asset('back') }}/assets/js/jquery.vmap.sampledata.js"></script> --}}
		
    <!--Internal  Datepicker js -->
    <script src="{{ asset('back') }}/assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

    <!-- Internal Select2 js-->
    <script src="{{ asset('back') }}/assets/plugins/select2/js/select2.min.js"></script>

    <!-- Internal Modal js-->
    <script src="{{ asset('back') }}/assets/js/modal.js"></script>

    <!-- Data tables -->
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/dataTables.dataTables.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/responsive.dataTables.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/jquery.dataTables.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/pdfmake.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/vfs_fonts.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('back') }}/assets/plugins/datatable/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('back') }}/assets/js/table-data.js"></script>

    <!-- alertify -->
    <script src="{{ asset('back/assets/js/alertify.min.js') }}"></script>

    
    {{-- general scripts file js --}}
    @include('back.layouts.general_scripts')


    {{-- selectize --}}
    <script src="{{ asset('back/assets/selectize.min.js') }}"></script>
    
    {{-- flatpickr --}}
    <script src="https://unpkg.com/flatpickr/dist/flatpickr.min.js"></script>

    <!-- spotlight -->
    <script src="{{ asset('back/assets/spotlight.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/spotlight.min.js') }}"></script>

    @yield('footer')

    <!-- custom js -->
    <script src="{{ asset('back') }}/assets/js/custom.js"></script>

    <!-- Switcher js -->
	<script src="{{ asset('back') }}/assets/switcher/js/switcher-rtl.js"></script>
</body>
</html>