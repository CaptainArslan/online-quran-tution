<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    @if (auth()->user()->role === 'admin')
        <title>@yield('title') | Admin | Live Tutoring</title>
    @elseif(auth()->user()->role === 'manager')
        <title>@yield('title') | Manager | Live Tutoring</title>
    @endif
    <link rel="apple-touch-icon" href="{{ asset('admin_theme') }}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin_theme') }}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/app-assets/css/themes/dark-layout.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_theme') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/app-assets/dropify/css/dropify.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_theme') }}/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_theme') }}/app-assets/css/core/colors/palette-gradient.css">
    <!-- END: Page CSS-->
    @yield('css')
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/assets/css/style.css">
    <!-- END: Custom CSS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
    <style>
        .pagination {
            display: inline-flex;
            margin: 0 auto;
        }

        .overlay-bg {
            position: absolute;
            z-index: 99;
            background-color: rgba(0, 0, 0, 0.1);
            height: 100%;
            width: 100%;
            padding: 0;
        }

        .horizontal-menu .header-navbar.navbar-brand-center .navbar-header .navbar-brand .brand-logo {
            background: url("{{ asset('front_assets') }}/images/logo1.png") no-repeat;
            height: 50px;
            width: 140px;
            background-size: 100% 100%;
        }

        table .badge {
            font-weight: bold;
            font-size: 12px;
        }

        .content-wrapper {
            padding-top: 8rem !important;
        }

        .rating-stars {
            border: none;
            float: left;
        }

        .rating-stars>input {
            display: none;
        }

        .rating-stars>label:before {
            margin: 5px;
            font-size: 1.75em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating-stars>.half:before {
            content: "\f089";
            position: absolute;
        }

        .rating-stars>label {
            color: #ddd;
            float: right;
            padding-left: 0px !important
        }

        .rating-stars>input:checked~label,
        /* show gold star when clicked */
        .rating-stars:not(:checked)>label:hover,
        /* hover current star */
        .rating-stars:not(:checked)>label:hover~label {
            color: #FFD700;
        }

        /* hover previous stars in list */

        .rating-stars>input:checked+label:hover,
        /* hover current star when changing rating */
        .rating-stars>input:checked~label:hover,
        .rating-stars>label:hover~input:checked~label,
        /* lighten current selection */
        .rating-stars>input:checked~label:hover~label {
            color: #FFED85;
        }
    </style>
    <style type="text/css">
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

        .error {
            color: red;
            font-weight: bold;
        }

        .row-title.text-warning {
            color: #FFCF40 !important;
        }

        .toast {
            opacity: 1 !important;
        }

        .btn {
            white-space: nowrap !important;
        }
    </style>
    @yield('css')
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!--<body class="horizontal-layout horizontal-menu 2-columns  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">-->
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                    class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                        class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <h3 style="margin-top:7px;">@yield('heading')</h3>
                    </div>
                    <ul class="nav navbar-nav float-right">


                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span
                                        class="user-name text-bold-600">{{ Auth::user()->name }}</span><span
                                        class="user-status text-success">Online</span></div><span><img class="round"
                                        src="{{ asset(Auth::user()->avatar) }}" alt="avatar" height="40"
                                        width="40"></span>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.user_Profile') }}"><i class="feather icon-user"></i>
                                    Profile</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                        class="feather icon-power"></i>{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->

    @include('admin.partials.sidebar')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper mt-0">
            @yield('content')
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>






    <!---------------------------------------------->
    <!--payment link MODAL-->
    <!---------------------------------------------->
    <div class="modal" tabindex="-1" role="dialog" id="mail_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Payment Mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.inquiries.paypal.mail') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="text" name="plan_id" placeholder="Enter Paypal Plan ID"
                            class="form-control">
                        <input type="hidden" name="email" id="inq_email">
                        <input type="hidden" name="inquiry_id" id="inquiry_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send Now</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!---------------------------------------------->
    <!--END payment link MODAL-->
    <!---------------------------------------------->
    {{-- Assign skype id modal starts --}}
    <div class="modal skype_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Skype Id</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="skypeIDForm" method="post" action="{{ route('admin.assign.skypeID') }}">
                        @csrf
                        <input type="hidden" class="user_id" name="user_id" value="">
                        <div class="form-group">
                            <label>Enter Skype ID</label>
                            <input type="text" class="form-control" name="skype_id"
                                value="{{ old('skype_id') }}" id="skype_id" autocomplete="skype_id" autofocus
                                placeholder="Skype ID" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" style="border-radius: 2px;">
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">Login</button> --}}
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- Assign skype id modal ends --}}





    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin_theme') }}/app-assets/vendors/js/vendors.min.js"></script>
    <script src="{{ asset('admin_theme') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('admin_theme') }}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin_theme') }}/app-assets/dropify/js/dropify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin_theme') }}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin_theme') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('admin_theme') }}/app-assets/js/core/app.js"></script>
    <script src="{{ asset('admin_theme') }}/app-assets/js/scripts/components.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- END: Theme JS-->
    @yield('js')
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script>
        $('.data-list-view,.datatable').DataTable({
            "order": [
                [0, "asc"]
            ],
            "pageLength": 25
        });
    </script>
    <script>
        $('.data-list-view,.datatable').DataTable();
        $('.dropify').dropify();
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });
        });
        var dateToday = new Date();
        $(".datepicker").datetimepicker({
            //    minDate: dateToday,
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

        // General Delete Function
        function deleteAlert(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }

        // General Delete Function
        function canclePaymentAlert(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to cancel the selected payment?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }

        function reInitiatePaymentAlert(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to ReInitiate the selected payment?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }

        // Remove Tutor Delete Function
        function removeTutor(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }
    </script>
    <script>
        @if (session('message'))
            toastr.success("{{ session('message') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
    <script>
        $(".payment-link").click(function() {
            $('#mail_modal').modal('show');
            $('#inq_email').val($(this).attr('data-mail'));
            $('#inquiry_id').val($(this).attr('data-id'));
        });
    </script>


    <script>
        // SET DEFAULT TABLE LENGTH LIMIT
        $table_length_limit = 15;



        // LOAD RECORD ON PAGE LOAD FIRST TIME
        $(document).ready(function() {
            loadRecords();
        });


        // LOAD RECORD FUNCTION
        function loadRecords() {
            let searchParams = new URLSearchParams(window.location.search);

            $.ajax({
                url: '?table_length_limit=' + $table_length_limit + '&' + searchParams,
                type: "get",
                datatype: "html"
            }).done(function(data) {
                $("#append-record").empty().html(data);
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                loadRecords();
            });
        }


        // GET DATA FROM SERVER EVENT
        function getData(page) {
            let searchParams = new URLSearchParams(window.location.search);
            let table_filter_search = $('.table_filter_search').val();
            $.ajax({
                url: '?page=' + page + '&table_length_limit=' + $('.table_length_limit').val() + '&' +
                    searchParams + '&table_filter_search=' + table_filter_search,
                type: "get",
                datatype: "html"
            }).done(function(data) {
                $("#append-record").empty().html(data);
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }


        // PAGINATION CLICK EVENT
        $(document).on('click', '.pagination a', function(event) {

            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var myurl = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];
            getData(page);

        });



        // TABLE LENGTH CHANGE EVENT
        $(document).on('change', '.table_length_limit', function(event) {
            $('.overlay-bg').removeClass('d-none');
            let searchParams = new URLSearchParams(window.location.search);
            let table_filter_search = $('.table_filter_search').val();
            $.ajax({
                url: '?table_length_limit=' + $(this).val() + '&' + searchParams + '&table_filter_search=' +
                    table_filter_search,
                type: "get",
                datatype: "html"
            }).done(function(data) {
                $("#append-record").empty().html(data);
                $('.overlay-bg').addClass('d-none');
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });

        });

        //TABLE FILTER SEARCH BOX EVENT
        //TABLE FILTER SEARCH BOX EVENT
        $(document).on('keyup', '.table_filter_search', function(event) {

            var table_filter_search = $(this).val();

            delay(function() {

                $('.overlay-bg').removeClass('d-none');
                let searchParams = new URLSearchParams(window.location.search);
                $.ajax({
                    url: '?table_filter_search=' + table_filter_search + '&table_length_limit=' + $(
                        '.table_length_limit').val() + '&' + searchParams,
                    type: "get",
                    datatype: "html"
                }).done(function(data) {
                    $("#append-record").empty().html(data);
                    $('.overlay-bg').addClass('d-none');
                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
            }, 1000);

        });

        let delay = (() => {
            let timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();
    </script>


</body>
<!-- END: Body OQT-->

</html>
