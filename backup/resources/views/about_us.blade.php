@extends('layouts.app')
@section('title', $settings['how_it_works_meta_title'] ?? '')
@section('meta')

<meta name="description" content="{{ $settings['how_it_works_meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">
@endsection
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section class="pages-banner-heading p-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 m-auto banner-left-heading">
                    <h1><span>How our System Works</span></h1>
                    <h5 class="mt-2">Just focus on the best and reasonable pricing</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset("images/banner.jpg") }});">
                </div>
            </div>
        </div>
    </section>

    <section id="section-features">
        <div class="container">
            <div class="row privacy1">
                <div class="col-md-6 ">
                    <h2 class="id-color">
                        New Things
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <h2 class="id-color">
                        New Things
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="col-md-6">
                    <h2 class="id-color"> New Things </h2>
                     <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                     <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor.
                    </p>

                </div>





            </div>
        </div>
    </section>

</div>
<!-- content close -->

@stop
