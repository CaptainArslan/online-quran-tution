``@extends('layouts.app')
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- revolution slider begin -->
    <!-- section begin -->
    <section class="no-top no-bottom text-light" data-bgimage="url({{asset('front_assets')}}/images/background/6.jpg" ) data-stellar-background-ratio=".2">
        <div class="overlay-gradient t80 pb30 pt90">
            <div class="center-y pt30 ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 offset-md-2 text-center">
                            <h1>Inquiry</h1>
                            <p class="lead">Enter details about your inquiry</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">

        <div class="mt30">
            <div class="center-y">
                <div class="container">
                    <div class="row">
                        @include('admin.partials.success_message')
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mb-sm-30 text-center">
                            <h2>Your Inquiry has been Submitted Succcessfully Kindly wait for the confirmation Email.</h2>
                            <a href="{{route('student.s_user_profile')}}" class="btn btn-primary">Go To Dashboard</a>
                        </div>
                        <div class="col-lg-4 mb30">

                            <div class="padding40 bg-gradient-to-right-2 text-light rounded">
                                <h3>Contact Us</h3>
                                <address class="s1">
                                    <span><i class="fa fa-map-marker fa-lg"></i>08 W 36th St, New York, NY 10001</span>
                                    <span><i class="fa fa-phone fa-lg"></i>+1-408-909-5136</span>
                                    <span><i class="fa fa-envelope-o fa-lg"></i><a href="mailto:contact@example.com">gk@pinlearn.com</a></span>
                                    <span><i class="fa fa-file-pdf-o fa-lg"></i><a href="#">Download Brochure</a></span>
                                </address>
                            </div>

                            <div class="spacer-30"></div>

                            <div class="padding40 bg-gradient-to-right text-light rounded">
                                <h3>How to Use</h3>
                                <address class="s1">
                                    <span> <i class="fa fa-search fa-lg"></i>Search for Subject</span>
                                    <span><i class="fa fa-user fa-lg"></i>Choose Your Tutor</span>

                                    <span><i class="fa fa-clock-o fa-lg"></i><a href="#">Start or schedule a lesson</a></span>
                                </address>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- section close -->

</div>
<!-- content close -->
@stop