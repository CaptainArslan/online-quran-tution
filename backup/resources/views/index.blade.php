@extends('layouts.app')
@section('title', $settings['home_meta_title'] ?? '')
@section('meta')
    <meta name="description" content="{{ $settings['home_meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['home_meta_keywords'] ?? '' }}">
@endsection

@section('css')
    <style>
        .slick-tutors .container-thumbnail {
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

        .heading {
            font-size: 25px;
            margin-right: 25px;
        }



        .checked {
            color: orange;
            font-size: 25px;
        }

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

    <section class="bg-hero" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <h4 class="text-skin">Alhamdullilah</h4>
                    <h2 class="text-skin">
                        One-to-One online Quran
                        tutoring that delivers
                        results.
                    </h2>
                    <p class="text-skin">A platform for online education made for Muslims <br>
                        who want to read the Holy Quran from the safety<br>
                        of their homes. We aim to provide Quranic education<br>
                        with convenience. So that one may inhibit self with<br>
                        spiritual peace. So, we provide individual classes for<br>
                        better consequences. As a personalized education<br>
                        system is a proven methodology.
                    </p>
                    <a class="btn green-background text-skin mb-3" href="#">
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
            <div class="row green-background p-3 d-flex align-items-baseline" style="margin-top: -50px;">
                <div class="col-md-3">
                    <h5 class="text-skin">used by 500+ students</h5>
                </div>

                <div class="col-md-3">
                    <img alt="" src="{{ asset('/public/dist/img/trustpilot.png') }}">
                </div>


                <div class="col-md-3">
                    <img alt="" src="{{ asset('public/dist/img/google.png') }}">
                </div>

                <div class="col-md-3">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>


            </div>
        </div>
    </section>


    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ALHAMDULLILAH</h5>
                    <h3 class="text-green">
                        It’s flexible, saves time and <br>
                        fits effortlessly into family <br>
                        life.
                    </h3>
                    <p>
                        Our online learning platform is designed to transcend
                        learning boundaries, enabling more efficient time
                        management. There is no longer a need to wait your
                        turn in a busy classroom environment or commute
                        to cram into the schedule of a madrassa. We have
                        the most innovative and flexible programs created
                        to engage and nurture learning to help preserve.
                        the sacred message of the Holy Quran.
                    </p>
                </div>
                <div class="col-md-6">
                    <img alt="" class="img-fluid" src="{{ asset('/public/dist/img/exports/Frame%2019.png') }}">
                </div>
            </div>
        </div>
    </section>


    <section class="pb-5" id="quran-lessons">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h5 class="text-skin">Alhamdullilah</h5>
                </div>
            </div>
            <div class="row">
                <h4 class="text-skin">Quran lessons from £4 per hour</h4>

            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <p class="text-skin">Start studying the Holy Quran with professional and seasoned online Quran teachers
                        chosen for
                        their knowledge and drive to inspire students' self-motivation and enthusiasm for
                        learning it. Moreover, you will have quality with less pay.</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item skin-background">
                            <h2 class="accordion-header" id="headingOne">
                                <button aria-controls="collapseOne" aria-expanded="true"
                                    class="accordion-button green-background text-skin" data-bs-target="#collapseOne"
                                    data-bs-toggle="collapse" type="button">
                                    Female Quran teachers
                                </button>
                            </h2>
                            <div aria-labelledby="headingOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample" id="collapseOne">
                                <div class="accordion-body text-green">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>,
                                    though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="accordion" id="accordionExample1">
                        <div class="accordion-item green-background">
                            <h2 class="accordion-header" id="headingOne1">
                                <button aria-controls="collapseOne1" aria-expanded="false"
                                    class="accordion-button skin-background text-green" data-bs-target="#collapseOne1"
                                    data-bs-toggle="collapse" type="button">
                                    Monthly classes
                                </button>
                            </h2>
                            <div aria-labelledby="headingOne1" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample1" id="collapseOne1">
                                <div class="accordion-body text-skin">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>,
                                    though the transition does limit overflow.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item green-background">
                            <h2 class="accordion-header" id="headingOne2">
                                <button aria-controls="collapseOne2" aria-expanded="false"
                                    class="accordion-button skin-background text-green" data-bs-target="#collapseOne2"
                                    data-bs-toggle="collapse" type="button">
                                    Monthly classes
                                </button>
                            </h2>
                            <div aria-labelledby="headingOne2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2" id="collapseOne2">
                                <div class="accordion-body text-skin">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>,
                                    though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                <div class="spacer">-->
                    <!--                </div>-->
                </div>

                <div class="col-md-6">

                    <div class="accordion" id="accordionExample3">
                        <div class="accordion-item skin-background">
                            <h2 class="accordion-header" id="headingOne3">
                                <button aria-controls="collapseOne" aria-expanded="true"
                                    class="accordion-button green-background text-skin" data-bs-target="#collapseOne3"
                                    data-bs-toggle="collapse" type="button">
                                    Female Quran teachers
                                </button>
                            </h2>
                            <div aria-labelledby="headingOne3" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample3" id="collapseOne3">
                                <div class="accordion-body text-green">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>,
                                    though the transition does limit overflow.
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 pb-5" id="interactive-quran-classes">
        <div class="container">
            <div class="row" style="object-fit: contain !important;">
                <div class="col-md-6 mt-5">
                    <h5>ALHAMDULLILAH</h5>
                    <h3 class="text-green">
                        It’s flexible, saves time and <br>
                        fits effortlessly into family <br>
                        life.
                    </h3>
                    <p>
                        Our online learning platform is designed to transcend
                        learning boundaries, enabling more efficient time
                        management. There is no longer a need to wait your
                        turn in a busy classroom environment or commute
                        to cram into the schedule of a madrassa. We have
                        the most innovative and flexible programs created
                        to engage and nurture learning to help preserve.
                        the sacred message of the Holy Quran.
                    </p>
                </div>
                <div class="col-md-6">
                    <img alt="" class="img-fluid" src="{{ asset('/public/dist/img/exports/Frame%203.png') }}">
                </div>
            </div>
        </div>
    </section>


    <section class="pb-5 pt-5" id="learn-tajweed-ul-quran"
        style="object-fit: contain !important; background-color: #007664;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h5 class="text-skin">
                        ALLHAMDULilah
                    </h5>
                    <h4 class="text-skin">
                        Learn Tajweed-ul-Quran rules
                        with expert teachers
                    </h4>
                    <p class="text-skin">
                        Start studying the Holy Quran with professional and seasoned online Quran teachers chosen for their
                        knowledge and drive to inspire students' self-motivation and enthusiasm for learning it. Moreover,
                        you will have quality with less pay.
                    </p>
                    <img alt="" src="{{ asset('/public/dist/img/exports/Rectangle 12.png') }}"
                        class="img-fluid">
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="box-skin">
                        <h5>
                            Quran Reading:
                        </h5>
                        <p>
                            It's one of the essential practices learned by Muslim kids whose native language is not Arabic.
                            Our Islamic teachers are well-qualified for teaching this course online to your kids and adults.
                            This course takes about three years of Duration for completing the whole Quran reading. Don't
                            worry about our classes; we provide personalized interactive lessons and single Quran teachers
                            to single teachers for better attention. If you want to see your kids read Holy book accurately,
                            then join our online Quran classes.
                        </p>
                    </div>

                    <div class="box-green">
                        <h5>
                            Quran Memorization:
                        </h5>
                        <p>
                            It's another practice of the Islamic religion for enlightening the heart with the light of the
                            Quran. Allah becomes very happy after knowing that His person remembers His book with total
                            dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the
                            world and hereafter. People don't have Quran Madrassas nearby. Hence, they can join our online
                            Quran classes to memorize unforgettable Quran with accurate pronunciation.
                        </p>
                    </div>

                    <div class="box-skin">
                        <h5>
                            Tajweed-Ul-Quran:
                        </h5>
                        <p>
                            It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy,
                            and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and
                            read Quran in a simple tone, but we should read Holy book as Commanded by Allah to read with a
                            cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed
                            classes online because we have the best Tajweed teacher who teaches you interactive learning.
                        </p>
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
                            <div class="col-sm-9 text-skin">
                                <h6>ALLHAMDULILLAH</h6>
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
                <div class="col-md-6">
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
                        <div class="form-group">
                            <input type="checkbox" id="exampleCheck1" value="1" name="terms_condition" required
                                data-parsley-required-message="Please confirm the field to agree with terms"
                                class="form-check-input">
                            <label for="exampleCheck1"><span></span> I have read and understand the <a
                                    href="{{ url('terms') }}" class="text-green"> Terms of use </a> & <a
                                    href="{{ url('privacy') }}" class="text-green">Privacy Policy</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn green-background text-skin float-end">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>


    <section id="rating-reviews">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-12 py-5">
                    <h4 class="text-skin text-center">Alhamdullilah</h4>
                    <h2 class="text-skin text-center">
                        Here's what our Students and Parents have to say!
                    </h2>
                    <div class="box-skin">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
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
                            <div class="col-lg-6 col-md-6 col-12">
                                <div id="reviews" class="carousel slide" data-ride="carousel">

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
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
    </section>

    <section id="video-reviews" class="py-5">
        <div class="container">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12">
                                <h5>ALHAMDULLILAH</h5>
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
                            <div class="col-lg-6 col-md-8 col-sm-12" id="video-reviwes-column">
                                <video class="w-100" controls>
                                    <source src="mov_bbb.mp4" type="video/mp4">
                                    <source src="mov_bbb.ogg" type="video/ogg">
                                    Your browser does not support HTML video.
                                </video>
                                <div class="video-controls">
                                    <button class="btn btn-greenish py-4 px-5" id="play-pause-button">
                                        <i class="fas fa-play" id="play-icon"></i>
                                        <i class="fas fa-pause" id="pause-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="#accordion-{{ $loop->iteration }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body text-skin green-background">
                                            <p>{{ $faq->answer }}</p>
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

    <section id="quran-in-city" class="pt-5 pb-5">
        <div class="container">
            <div class="row text-center">
                <h3 class="text-green">Learn Quran Online in Your City or Town</h3>
            </div>
            <div class="row gap-3 mt-4">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mt-2">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mt-2">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mt-2">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mt-2">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mt-2">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mt-2">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mt-2">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn skin-background text-green w-100 p-lg-3 p-1" style="border-radius: 0;"
                                href="#">Quran teacher in Leeds</a>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="quran-in-city">
        <div class="quran-in-city mb-5 ">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h3 class="text-green ">Learn Quran Online in Your City or Town</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mt-3 ">
                    <div class="row justify-content-center">
                        <div class="col city-box">
                            <a class="nav-link" href="{{route('leeds')}}">Quran teacher in Leeds</a>
                        </div>
                        <div class="col city-box">
                            <a class="nav-link" href="{{route('london')}}">Quran teacher in London</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;" style="background-size: cover;">
                            <a class="nav-link" href="{{route('bradford')}}">Quran teacher in Bradford</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('manchester')}}">Quran teacher in Manchester</a>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="background-size: cover;">
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('derby')}}">Quran teacher in Derby</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('sheffield')}}">Quran teacher in Sheffield</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('birmingham')}}">Quran teacher in Birmingham</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('glasgow')}}">Quran teacher in Glasgow</a>
                        </div>

                    </div>

                    <div class="row justify-content-center" style="background-size: cover;">

                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('luton')}}">Quran teacher in Luton</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('bristol')}}">Quran teacher in Bristol</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('blackburn')}}">Quran teacher in Blackburn</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('liverpool')}}">Quran teacher in Liverpool</a>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="background-size: cover;">
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('southampton')}}">Quran teacher in Southampton</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('newcastle')}}">Quran teacher in Newcastle</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('nottingham')}}">Quran teacher in Nottingham</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('stockport')}}">Quran teacher in Stokeport</a>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="background-size: cover;">
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('nottingham')}}">Quran teacher in Nottingham</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('cardiff')}}">Quran teacher in Cardiff</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('islington')}}">Quran teacher in Islington</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('walthamstow')}}">Quran teacher in Walthamstow</a>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="background-size: cover;">
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('oldham')}}">Quran teacher in Oldham</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('leicester')}}">Quran teacher in leicester</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('shipley')}}">Quran teacher in Shipley</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('wakefield')}}">Quran teacher in Wakefield</a>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="background-size: cover;">
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('croydon')}}">Quran teacher in Croydon</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('oxford')}}">Quran teacher in Oxford</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('nottingham')}}">Quran teacher in Nottingham</a>
                        </div>
                        <div class="col city-box" style="background-size: cover;">
                            <a class="nav-link" href="{{route('reading')}}">Quran teacher in Reading</a>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col city-box">
                            <a class="nav-link" href="{{route('slough')}}" style="margin-left: auto">Quran teacher in Slough</a>
                        </div>
                        <div class="col city-box">
                            <a class="nav-link" href="{{route('stokeon')}}">Quran teacher in Stoke On Trent</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="video" class="embed-responsive-item" width="560" height="315"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>


@section('js')

    <script type="text/javascript">
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
@endsection
@stop
