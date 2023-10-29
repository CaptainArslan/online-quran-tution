<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Live Tutoring</title>
    <link rel="apple-touch-icon" href="{{asset('admin_theme')}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin_theme')}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" href="{{asset('front_assets')}}/dist/css/dropify.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/vendors.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    {{--<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/extensions/shepherd-theme-default.css">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->
     <link rel="stylesheet" type="text/css"
    href="{{asset('admin_theme')}}/app-assets/css/core/menu/menu-types/horizontal-menu.css">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/plugins/tour/tour.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/assets/css/style.css">
    <!-- END: Custom CSS-->
    <style>
        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 2px 0;
            white-space: nowrap;
            justify-content: flex-end;
        }
        .select2-container--default .select2-selection--single {
          height: calc(2.4375rem + 2px);
          font-size: 14px;
          padding: 4px 0px;
          border: 2px solid #eee;
          border-radius: 8px;
      }

      .select2-container--default .select2-selection--single .select2-selection__arrow {
          top: 7px;
      }
  </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('payment_manager._partials.topbar')
    @include('payment_manager._partials.sidebar')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            @yield('content')
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">

    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/vendors.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    {{--<script src="{{asset('admin_theme')}}/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/extensions/tether.min.js"></script>--}}
    {{-- <script src="{{asset('admin_theme')}}/app-assets/vendors/js/extensions/shepherd.min.js"></script> --}}
    <script src="{{asset('front_assets')}}/dist/js/dropify.js"></script>
    <!-- END: Page Vendor JS-->
        <script src="{{asset('admin_theme')}}/app-assets/vendors/js/ui/jquery.sticky.js"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('admin_theme')}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/js/core/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script src="{{asset('admin_theme')}}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{--<script src="{{asset('admin_theme')}}/app-assets/js/scripts/pages/dashboard-analytics.js"></script>--}}
    <!-- END: Page JS-->
    <script>
        $('.data-list-view,.datatable').DataTable();
        $(".datepicker").datetimepicker({
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-angle-up',
                down: 'fa fa-angle-down',
                previous: 'fa fa-angle-left',
                next: 'fa fa-angle-right',
                today: 'fa fa-bullseye',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            },
            format: 'YYYY/MM/DD',
        });
        $(document).ready(function() {
          $('.select2').select2({
            width: '100%'
        });
      });
  </script>
  @yield('js')
</body>
<!-- END: Body-->

</html>
