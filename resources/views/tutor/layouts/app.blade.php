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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Live Tutoring</title>
    <link rel="apple-touch-icon" href="{{asset('admin_theme')}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin_theme')}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" href="{{asset('front_assets')}}/dist/css/dropify.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/extensions/shepherd-theme-default.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- END: Page CSS-->
    <style>
        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 2px 0;
            white-space: nowrap;
            justify-content: flex-end;
        }
            .starrating > input {display: none;}
            .starrating > label:before {
            content: "\f005";
            margin: 2px;
            font-size: 20px;
            font-family: FontAwesome;
            display: inline-block;
            cursor: pointer;
        }
        .starrating > label { color: #222222;}
        .starrating > input:checked ~ label{ color: #ffca08 ; }
        .starrating > input:hover ~ label{ color: #ffca08 ;  }
        .rate-stars{color: #ffca08 ; }
        .toast {
            opacity: 1 !important;
        }
    </style>
      @yield('css')
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/assets/css/style.css">


    <!-- END: Custom CSS-->
    <style>
        .profile_img {
          border-radius: 50%;
        }
        </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('tutor._partials.topbar')
    @include('tutor._partials.sidebar')
    <!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
@yield('content')
    </div>
    </div>




<div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/extensions/tether.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/extensions/shepherd.min.js"></script>
    <script src="{{asset('front_assets')}}/dist/js/dropify.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('admin_theme')}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/js/core/app.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/js/scripts/components.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- END: Theme JS-->


<!-- END: Page Vendor JS-->


    <!-- BEGIN: Page JS-->
    <script src="{{asset('admin_theme')}}/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <!-- END: Page JS-->
    <script type="text/javascript">
        $('.data-list-view,.datatable').DataTable();
        @if(session('message'))
        toastr.success("{{ session('message') }}");
        @elseif(session('error'))
        toastr.error("{{ session('error') }}");
        @endif
    </script>
    

    @yield('js')
    <script>
        $(document).ready(function () {
            setInterval(function() {
                reloadTutor();
            }, 100000);
        });
        reloadTutor();
        function reloadTutor() {

                $.get("{{ route('tutor.unread') }}", function(messages){

                    $('.tutor-unread-messages').html(messages);


                    scrollChat();
                });

        }
    </script>
</body>
<!-- END: Body-->

</html>
