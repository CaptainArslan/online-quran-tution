{{-- @extends('layouts.addition') --}}
@extends('layouts.new-app')
@section('schema')
    {!! $schema !!}
@endsection

@section('schemafaq')
    {!! $schemafaq !!}
@endsection

@section('description')
    <meta "description" content="{{ $description }}" />
@endsection
@section('meta')
    <meta name="keywords" content="{{ $meta }}" />
@endsection
@section('css')
    <style>
        /* .slick-tutors .container-thumbnail {
                                          position: relative;
                                          width: 50%;
                                        }

                                        .slick-tutors .image {
                                          opacity: 1;
                                          display: block;
                                          width: 100%;
                                          height: auto;
                                          transition: .5s ease;
                                          backface-visibility: hidden;
                                        }

                                        .slick-tutors .middle {
                                          transition: .5s ease;
                                          opacity: 0.9;
                                          position: absolute;
                                          top: 50%;
                                          left: 50%;
                                          transform: translate(-50%, -50%);
                                          -ms-transform: translate(-50%, -50%);
                                          text-align: center;
                                        }

                                        .slick-tutors .container-thumbnail:hover .image {
                                          opacity: 0.3;
                                        }

                                        .slick-tutors .container-thumbnail:hover .middle {
                                          opacity: 1;
                                        }

                                        .slick-tutors .text {
                                          background-color: #3aafa9;
                                          color: white;
                                          font-size: 13px;
                                          padding: 12px 24px;
                                          cursor: pointer;
                                        }
                                        #accordion-style-1 h1,
                                        #accordion-style-1 a{
                                            color:black;
                                        }
                                        #accordion-style-1 .btn-link {
                                            font-weight: 400;
                                            color: black;
                                            background-color: transparent;
                                            text-decoration: none !important;
                                            font-size: 16px;
                                            font-weight: bold;
                                         padding-left: 25px;
                                        }

                                        #accordion-style-1 .card-body {
                                            border-top: 2px solid black;
                                        }

                                        #accordion-style-1 .card-header .btn.collapsed .fa.main{
                                         display:none;
                                        }

                                        #accordion-style-1 .card-header .btn .fa.main{
                                         background: black;
                                            padding: 13px 11px;
                                            color: #ffffff;
                                            width: 35px;
                                            height: 41px;
                                            position: absolute;
                                            left: -1px;
                                            top: 10px;
                                            border-top-right-radius: 7px;
                                            border-bottom-right-radius: 7px;
                                         display:block;
                                        }

                                        .image-flip:hover .backside,
                                        .image-flip.hover .backside {
                                            -webkit-transform: rotateY(0deg);
                                            -moz-transform: rotateY(0deg);
                                            -o-transform: rotateY(0deg);
                                            -ms-transform: rotateY(0deg);
                                            transform: rotateY(0deg);
                                            border-radius: .25rem;
                                        }

                                        .image-flip:hover .frontside,
                                        .image-flip.hover .frontside {
                                            -webkit-transform: rotateY(180deg);
                                            -moz-transform: rotateY(180deg);
                                            -o-transform: rotateY(180deg);
                                            transform: rotateY(180deg);
                                        }

                                        .mainflip {
                                            -webkit-transition: 1s;
                                            -webkit-transform-style: preserve-3d;
                                            -ms-transition: 1s;
                                            -moz-transition: 1s;
                                            -moz-transform: perspective(1000px);
                                            -moz-transform-style: preserve-3d;
                                            -ms-transform-style: preserve-3d;
                                            transition: 1s;
                                            transform-style: preserve-3d;
                                            position: relative;
                                        }

                                        .frontside {
                                            position: relative;
                                            -webkit-transform: rotateY(0deg);
                                            -ms-transform: rotateY(0deg);
                                            z-index: 2;
                                            margin-bottom: 30px;
                                        }

                                        .backside {
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            background: white;
                                            -webkit-transform: rotateY(-180deg);
                                            -moz-transform: rotateY(-180deg);
                                            -o-transform: rotateY(-180deg);
                                            -ms-transform: rotateY(-180deg);
                                            transform: rotateY(-180deg);
                                            -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
                                            -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
                                            box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
                                        }

                                        .frontside,
                                        .backside {
                                            -webkit-backface-visibility: hidden;
                                            -moz-backface-visibility: hidden;
                                            -ms-backface-visibility: hidden;
                                            backface-visibility: hidden;
                                            -webkit-transition: 1s;
                                            -webkit-transform-style: preserve-3d;
                                            -moz-transition: 1s;
                                            -moz-transform-style: preserve-3d;
                                            -o-transition: 1s;
                                            -o-transform-style: preserve-3d;
                                            -ms-transition: 1s;
                                            -ms-transform-style: preserve-3d;
                                            transition: 1s;
                                            transform-style: preserve-3d;
                                        }

                                        .frontside .card,
                                        .backside .card {
                                            min-height: 312px;
                                        }

                                        .backside .card a {
                                            font-size: 18px;
                                            color: #3AAFA9 !important;
                                        }

                                        .frontside .card .card-title,
                                        .backside .card .card-title {
                                            color: #3AAFA9 !important;
                                        }

                                        .frontside .card .card-body img {
                                            width: 120px;
                                            height: 120px;
                                            border-radius: 50%;
                                        }


                                        .checked{
                                            color: orange;
                                        }
                                        .heading {
                                          font-size: 25px;
                                          margin-right: 25px;
                                        }

                                        .checked {
                                          color: orange;
                                          font-size: 25px;
                                        } */

        /* Three column layout */
        .side {
            float: left;
            width: 15%;
            margin-top: 10px;
        }

        .middle {
            float: left;
            width: 70%;
            margin-top: 10px;
        }

        /* Place text to the right */
        .right {
            text-align: right;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* The bar container */
        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
        }

        .card-container {
            display: grid;
            grid-template-rows: auto;
            grid-template-columns: 1fr;
            grid-gap: 10px;
        }

        .box-green,
        .box-skin {
            width: 100%;
        }



        /* Individual bars */
        .bar-5 {
            width: {{ ($star5 / $review) * 100 }}%;
            height: 18px;
            background-color: orange;
        }

        .bar-4 {
            width: {{ ($star4 / $review) * 100 }}%;
            height: 18px;
            background-color: orange;
        }

        .bar-3 {
            width: {{ ($star3 / $review) * 100 }}%;
            height: 18px;
            background-color: orange;
        }

        .bar-2 {
            width: {{ ($star2 / $review) * 100 }}%;
            height: 18px;
            background-color: orange;
        }

        .bar-1 {
            width: {{ ($star1 / $review) * 100 }}%;
            height: 18px;
            background-color: orange;
        }
    </style>
@endsection
@section('content')
    <section class="bg-cites" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5 py-5">
                    <h4 class="text-skin text-uppercase">ALHAMDULILLAH</h4>
                    <h2 class="text-skin">
                        Best Online Quran Teachers <br />
                        In Leeds
                    </h2>
                    <p class="text-skin">An online learning platform designed to cater for <br>
                        Muslims who seek the ability to read The Holy <br>
                        Quran all from the comfort of their own home.
                    </p>
                    <a class="btn green-background text-skin mb-3" href="{{ route('enroll') }}" style="border-radius: 2px;">
                        Get A Free Trial
                    </a>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row green-background p-3 d-flex align-items-center" style="margin-top: -50px;">
                <div class="col-md-3 d-flex align-items-center">
                    <h5 class="text-skin">Used by 500+ students</h5>
                </div>

                <div class="col-md-3 d-flex align-items-center">
                    <img alt="" src="{{ asset('/public/dist/img/trustpilot.png') }}">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                    <a href="{{ route('testimonials') }}"> <img alt=""
                            src="{{ asset('/public/dist/img/Google_Reviews.png') }}"> </a>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>
            </div>
        </div>
    </section>


    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-green">
                        ALHAMDULILLAH
                    </h3>
                    <p>
                        {!! $p1 !!}
                    </p>
                </div>
                <div class="col-md-6">
                    <img alt="" class="img-fluid" src="{{ asset('/public/dist/img/exports/Frame 11.png') }}">
                </div>
            </div>
        </div>
    </section>


    <section id="quran-lessons">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                    <img alt="" class="img-fluid" src="{{ asset('/public/dist/img/exports/Rectangle 7.png') }}">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h5 class="text-white">ALHAMDULILLAH</h5>
                    <h3 class="text-skin">
                        {!! $p2h !!}
                    </h3>
                    <p class="text-white">
                        {!! $p2 !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ALHAMDULILLAH</h5>
                    <h3 class="text-green">
                        {!! $c1h !!}
                    </h3>
                    <p>
                        {!! $c1 !!}
                    </p>
                </div>
                <div class="col-md-6">
                    <img alt="" class="img-fluid" src="{{ asset('/public/dist/img/exports/Frame 12.png') }}">
                </div>
            </div>
        </div>
    </section>


    <section id="quran-lessons">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <img alt="" class="img-fluid" src="{{ asset('/public/dist/img/exports/Rectangle 9.png') }}">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h5 class="text-white">ALHAMDULILLAH</h5>
                    <h3 class="text-skin">
                        {!! $c2h !!}
                    </h3>
                    <p class="text-white">
                        {!! $c2 !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ALHAMDULILLAH</h5>
                    <h3 class="text-green">
                        {!! $c3h !!}
                    </h3>
                    <p>
                        {!! $c3 !!}
                    </p>
                </div>
                <div class="col-md-6">
                    <img alt="" class="img-fluid" src="{{ asset('/public/dist/img/exports/Frame 13.png') }}">
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5 pt-5" id="learn-tajweed-ul-quran"
        style="object-fit: contain !important; background-color: #007664;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column">
                    <div class="card-container">
                        <div class="box-green flex-fill">
                            <h5>
                                {!! $r5h !!}
                            </h5>
                            <p>
                                {!! $r5 !!}
                            </p>
                        </div>

                        <div class="box-skin flex-fill">
                            <h5>
                                {!! $r4h !!}
                            </h5>
                            <p>
                                {!! $r4 !!}
                            </p>
                        </div>

                        <div class="box-green flex-fill">
                            <h5>
                                {!! $r6h !!}
                            </h5>
                            <p>
                                {!! $r6 !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column">
                    <div class="card-container">
                        <div class="box-skin flex-fill">
                            <h5>
                                {!! $r1h !!}
                            </h5>
                            <p>
                                {!! $r1 !!}
                            </p>
                        </div>

                        <div class="box-green flex-fill">
                            <h5>
                                {!! $r2h !!}
                            </h5>
                            <p>
                                {!! $r2 !!}
                            </p>
                        </div>

                        <div class="box-skin flex-fill">
                            <h5>
                                {!! $r3h !!}
                            </h5>
                            <p>
                                {!! $r3 !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="booking-form" class="pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 green-background">
                    <div class="container">
                        <div class="row d-flex justify-content-center py-5">
                            <div class="col-lg-9 col-md-12 col-sm-9 text-skin">
                                <h5>ALHAMDULILLAH</h5>
                                <h1 class="bigger-text">
                                    Get 3 trial sessions before you book
                                </h1>
                                <p>
                                    Sign up today to our 3-day free Quran classes to ask questions and to find out about our
                                    teaching styles and methods for a unique learning experience!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-lg-0 mt-md-0 mt-3">
                    @include('admin.partials.success_message')
                    <form id='contact_form' method="post" action="{{ route('enroll_submit') }}">
                        @csrf
                        <input type="hidden" name="student_time_difference" id="time_zone">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                        @endif
                        <div class="form-group">
                            <label>Enter Your Name</label>
                            <input type="text" class="form-control borderBottomClass" name='name' id='name'
                                placeholder="Your Name" required>
                            @if ($errors->has('name'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="text" class="form-control borderBottomClass" name='email' id='email'
                                placeholder="Your Email" required>
                            @error('email')
                                <span class="danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Enter Your Phone</label>
                            <input type="text" class="form-control borderBottomClass" name='phone' id='phone'
                                placeholder="Your Phone" required>
                            @error('phone')
                                <span class="danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @guest()
                            <div class="form-group">
                                <label>Enter Your Password</label>
                                <input type="password" minlength="8" name='password' id='password'
                                    class="form-control borderBottomClass" placeholder="Your Password" required>
                                @error('password')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name='password_confirmation' id='password' minlength="8"
                                    class="form-control borderBottomClass" placeholder="Confirm Password" required>
                                @error('password_confirmation')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endguest
                        <div class="field-set mb-3">
                            @if (config('services.recaptcha.key'))
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                                </div>
                            @endif
                        </div>
                        <div class="field-set mb-3">
                            @if (config('services.recaptcha.key'))
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                                </div>
                            @endif
                        </div>
                        <div class="field-set mb-3">
                            @if (config('services.recaptcha.key'))
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="exampleCheck1" value="1" name="terms_condition" required
                                data-parsley-required-message="Please confirm the field to agree with terms"
                                class="form-check-input">
                            <label for="exampleCheck1"><span></span> I have read and understand the <a
                                    href="{{ url('terms') }}" class="text-green"> Terms of use </a> & <a
                                    href="{{ url('privacy') }}" class="text-green">Privacy Policy</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn green-background text-skin float-end" value="Sign Up"
                                style="border-radius: 0 !important; padding: 0.5rem 2rem;">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>


    <section id="rating-reviews" style="object-fit: contain !important; background-color: #007664;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-12 py-5">
                    <h5 class="text-skin text-center">ALHAMDULILLAH</h5>
                    <h2 class="text-skin text-center">
                        Here's what our Students and Parents have to say!
                    </h2>
                    <div class="box-skin">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="side">
                                        <div>5star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-5"></div>
                                        </div>
                                    </div>
                                    <div class="side left">
                                        <div>{{ $star5 }}</div>
                                    </div>
                                    <div class="side">
                                        <div>4star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-4"></div>
                                        </div>
                                    </div>
                                    <div class="side left">
                                        <div>{{ $star4 }}</div>
                                    </div>
                                    <div class="side">
                                        <div>3star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-3"></div>
                                        </div>
                                    </div>
                                    <div class="side left">
                                        <div>{{ $star3 }}</div>
                                    </div>
                                    <div class="side">
                                        <div>2star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-2"></div>
                                        </div>
                                    </div>
                                    <div class="side left">
                                        <div>{{ $star2 }}</div>
                                    </div>
                                    <div class="side">
                                        <div>1star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-1"></div>
                                        </div>
                                    </div>
                                    <div class="side left">
                                        <div>{{ $star1 }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-lg-0 mt-md-0 mt-4">
                                <div id="reviews">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide"
                                                data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($total_testimonials as $testimonial)
                                                        <div
                                                            class="carousel-item @if ($loop->index == 0) active @endif">
                                                            <p class="d-block w-100"><span
                                                                    class="h3">{{ $testimonial->name }}</span><br>
                                                                {{ $testimonial->review }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="video-reviews" class="py-5">
        <div class="container">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($videos as $video)
                        <div class="carousel-item @if ($loop->index == 0) active @endif">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <h5>ALHAMDULILLAH</h5>
                                    <h3 class="text-green">
                                        What Our client’s Says Here are some glimpse!
                                    </h3>
                                    <p>
                                        "Online Quran tuition has been a fantastic experience for my child. The personalized
                                        attention and interactive sessions have helped them improve their recitation and
                                        understanding of the Quran. The tutor is knowledgeable, patient, and supportive. I
                                        highly recommend this service to anyone looking for quality Quran education online."
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12" id="video-reviwes-column">
                                    <img src="{{ asset($video->image) }}" alt="Review" class="reviews_video_slider">
                                    <button type="button" class="btn btn-greenish py-4 px-5 youtube-video video-controls"
                                        data-bs-toggle="modal" data-bs-target="#myModal-{{ $loop->index }}"
                                        data-url="{{ $video->url }}"
                                        onclick="playVideo('{{ $video->url }}', '{{ $loop->index }}')"
                                        id="play-pause-button">
                                        <i class="fas fa-play" id="play-icon"></i>
                                    </button>
                                </div>

                                <!-- Modal start -->
                                <div class="modal fade" id="myModal-{{ $loop->index }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe id="video-{{ $loop->index }}" class="embed-responsive-item"
                                                        src="" width="470" height="315"
                                                        allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal end -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section id="faqs" class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h3 class="text-skin">Read our FAQ’s?</h3>
                    <img src="{{ asset('/public/dist/img/exports/baduvector.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion" id="accordionExample">
                            @foreach ($faqs ?? '' as $faq)
                                <div class="accordion-item my-2">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button skin-background text-black collapsed"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#accordion-{{ $loop->iteration }}" aria-expanded="false"
                                            aria-controls="collapseOne">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h2>
                                    <div id="accordion-{{ $loop->iteration }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body text-skin green-background">
                                            <p>{{ $faq['answer'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="quran-in-city">
        <div class="quran-in-city mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center mt-5">
                        <h3 class="text-green ">Learn Quran Online in Your City or Town</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center mt-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box">
                                <a class="nav-link" href="{{ route('leeds') }}">Quran teacher in Leeds</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box">
                                <a class="nav-link" href="{{ route('london') }}">Quran teacher in London</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;"
                                style="background-size: cover;">
                                <a class="nav-link" href="{{ route('bradford') }}">Quran teacher in Bradford</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('manchester') }}">Quran teacher in Manchester</a>
                            </div>
                        </div>

                        <div class="row justify-content-center" style="background-size: cover;">
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('derby') }}">Quran teacher in Derby</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('sheffield') }}">Quran teacher in Sheffield</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('birmingham') }}">Quran teacher in Birmingham</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('glasgow') }}">Quran teacher in Glasgow</a>
                            </div>

                        </div>

                        <div class="row justify-content-center" style="background-size: cover;">

                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('luton') }}">Quran teacher in Luton</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('bristol') }}">Quran teacher in Bristol</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('blackburn') }}">Quran teacher in Blackburn</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('liverpool') }}">Quran teacher in Liverpool</a>
                            </div>
                        </div>

                        <div class="row justify-content-center" style="background-size: cover;">
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('southampton') }}">Quran teacher in Southampton</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('newcastle') }}">Quran teacher in Newcastle</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('nottingham') }}">Quran teacher in Nottingham</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('stockport') }}">Quran teacher in Stokeport</a>
                            </div>
                        </div>

                        <div class="row justify-content-center" style="background-size: cover;">
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('nottingham') }}">Quran teacher in Nottingham</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('cardiff') }}">Quran teacher in Cardiff</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('islington') }}">Quran teacher in Islington</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('walthamstow') }}">Quran teacher in Walthamstow</a>
                            </div>
                        </div>

                        <div class="row justify-content-center" style="background-size: cover;">
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('oldham') }}">Quran teacher in Oldham</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('leicester') }}">Quran teacher in leicester</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('shipley') }}">Quran teacher in Shipley</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('wakefield') }}">Quran teacher in Wakefield</a>
                            </div>
                        </div>

                        <div class="row justify-content-center" style="background-size: cover;">
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('croydon') }}">Quran teacher in Croydon</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('oxford') }}">Quran teacher in Oxford</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('nottingham') }}">Quran teacher in Nottingham</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('reading') }}">Quran teacher in Reading</a>
                            </div>
                        </div>

                        <div class="row justify-content-center" style="background-size: cover;">
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('slough') }}">Quran teacher in Slough</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 city-box" style="background-size: cover;">
                                <a class="nav-link" href="{{ route('stokeon') }}">Quran teacher in Stoke On Trent</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <script>
        function playVideo(url, index) {
            var iframe = document.getElementById("video-" + index);
            iframe.src = url;
        }
    </script>

    <script>
        // Get the slider element
        var slider = document.querySelector('.carousel-inner');

        // Add event listener to the modal's open event
        $('#myModal').on('shown.bs.modal', function(e) {
            // Pause or disable the slider
            slider.style.pointerEvents = 'none';
        });

        // Add event listener to the modal's close event
        $('#myModal').on('hidden.bs.modal', function(e) {
            // Resume or enable the slider
            slider.style.pointerEvents = 'auto';
        });
    </script>

@section('js')

    <script>
        $(document).ready(function() {
            var d = new Date();
            var n = d.getTimezoneOffset();
            $('#time_zone').val(n);
        });
        $(document).on('click', '.js-videoPoster', function(e) {
            e.preventDefault();
            var poster = $(this);
            var wrapper = poster.closest('.js-videoWrapper');
            videoPlay(wrapper);
        });

        function videoPlay(wrapper) {
            var iframe = wrapper.find('.js-videoIframe');
            var src = iframe.data('src');

            wrapper.addClass('videoWrapperActive');
            iframe.attr('src', src);
        }
    </script>
    <script>
        $(document).ready(function() {

            $('.slick-tutors').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

        });
        $(document).ready(function() {
            $('.youtube-video').click(function() {
                console.log('stop here pop up');
                let src = $(this).data('url');
                $("#video").attr('src', src);
                $("#myModal").modal('show');
            });
        });
    </script>

    <script>
        function autoType(elementClass, typingSpeed) {
            var thhis = $(elementClass);
            thhis.css({
                "position": "relative",
                "display": "inline-block"
            });
            thhis.prepend('<div class="cursor" style="right: initial; left:0;"></div>');
            thhis = thhis.find(".text-js");
            var text = thhis.text().trim().split('');
            var amntOfChars = text.length;
            var newString = "";

            setTimeout(function() {
                thhis.text("");
                for (var i = 0; i < amntOfChars; i++) {
                    (function(i, char) {
                        setTimeout(function() {
                            newString += char;
                            thhis.text(newString);
                        }, i * typingSpeed);
                    })(i + 1, text[i]);
                }
            }, 500);
        }

        $(document).ready(function() {
            $(".blinked-circle").hide();
            autoType(".type-js", 70);
            $(".blinked-circle").delay(4300).fadeIn();
        });

        $(document).on('click', 'a', function(event) {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function() {
                    window.location.hash = hash;
                });
            }
        });
    </script>


@endsection
@stop
