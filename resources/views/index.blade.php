@extends('layouts.new-app')
@section('title', $settings['home_meta_title'] ?? '')
@section('meta')
    <meta name="description" content="{{ $settings['home_meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['home_meta_keywords'] ?? '' }}">
    <link rel="canonical" href="https://onlinequrantuition.co.uk/"/>
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
        .rating-stars {
            color: orange !important;
        }
    </style>
@endsection

@section('content')

    <section class="bg-hero" id="hero">
        <div class="container py-5 px-lg-5 px-md-5 px-3">
            <div class="row">
                <div class="col-lg-6 col-md-9 col-sm-12 mt-5">
                    <h4 class="text-skin">Alhamdullilah</h4>
                    <h1 class="text-skin">
                        One-to-One online Quran
                        tutoring that delivers
                        results.
                    </h1>
                    <p class="text-skin">An online education platform designed for Muslims seeking to study the holy Quran securely from their home. Our mission is to deliver Quranic education with convenience, promoting spiritual tranquility. <br/>We offer one-on-one classes to ensure optimal results, as personalized education has a track record of effectiveness.</p>
                    <a class="btn green-background text-skin mb-3" href="{{ route('enroll') }}">
                        Start A Free Trial
                    </a>
                    <a class="btn skin-background text-green mb-3" href="{{ route('pricing') }}">
                        Packages
                    </a>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row green-background p-3 d-flex align-items-center">
            <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                <h5 class="text-skin">UK's No1 Accademy Est since 2012</h5>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                <img alt="trusted reviews" src="{{ asset('/public/dist/img/trustpilot.png') }}">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                <a href="{{ route('testimonials') }}"> <img alt="online quran reviews on google"
                                                            src="{{ asset('/public/dist/img/Google_Reviews.png') }}">
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                <a href="{{ route('testimonials') }}"><h5 class="text-skin"><b class="rating-stars">4.9 Rating</b> | <b class="rating-stars">197 Reviews</b></h5></a>
            </div>
        </div>
    </section>


    {{--    <section class="pb-5" id="quran-lessons">--}}
    <section class="pb-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h5 >Alhamdullilah</h5>
                </div>
            </div>
            <div class="row">
                <h2 class="text-green text-capitalize">Quran lessons from £4 per hour</h2>

            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <p>Access online Quran lessons starting at just £4 per hour. Our affordable rates make it convenient for individuals of all backgrounds to engage in Quranic education from the comfort of their homes. Join our platform to benefit from cost-effective learning while receiving expert guidance in your Quranic studies.
                    </p>
                </div>
            </div>

            <div class="container mt-4">
            	<?php /*
                <div class="row mt-4 d-flex justify-content-evenly">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion" id="accordionExample">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="accordion-item my-2">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button skin-background text-black collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordion-female-teachers" aria-expanded="false"
                                                    aria-controls="collapseOne">
                                                Female Quran teachers
                                            </button>
                                        </h2>
                                        <div id="accordion-female-teachers" class="accordion-collapse collapse"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body text-skin green-background">
                                                <p>We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn from a male teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters can join our classes online without hesitation.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="accordion-item my-2">
                                        <h4 class="accordion-header" id="headingOne">
                                            <button class="accordion-button skin-background text-black collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordion-monthly-classes" aria-expanded="false"
                                                    aria-controls="collapseOne">
                                                Monthly classes
                                            </button>
                                        </h4>
                                        <div id="accordion-monthly-classes" class="accordion-collapse collapse"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body text-skin green-background">
                                                <p>Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="accordion-item my-2">
                                        <h4 class="accordion-header" id="headingOne">
                                            <button class="accordion-button skin-background text-black collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordion-personalized-learning" aria-expanded="false"
                                                    aria-controls="collapseOne">
                                                Personalized learning
                                            </button>
                                        </h4>
                                        <div id="accordion-personalized-learning" class="accordion-collapse collapse"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body text-skin green-background">
                                                <p>The benefit of allowing personalized classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Holy book effectively. The personalized class will take place on Zoom/Skype by either video or audio call and sharing screen.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="accordion-item my-2">
                                        <h4 class="accordion-header" id="headingOne">
                                            <button class="accordion-button skin-background text-black collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordion-free-trial" aria-expanded="false"
                                                    aria-controls="collapseOne">
                                                Free trial lessons
                                            </button>
                                        </h4>
                                        <div id="accordion-free-trial" class="accordion-collapse collapse"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body text-skin green-background">
                                                <p>Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous classes.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                */ ?>
                <div class="row d-flex justify-content-evenly">
                    <div class="col-md-6 mb-3">
                    	<div class="col-md-12 skin-background px-3 py-4" style="border-radius: 10px; min-height: 269px">
	                        <h4 class="text-capitalize">Highly qualified male & female teachers</h4>
	                        <p>Our team comprises highly skilled and qualified male and female Quran teachers. They bring a wealth of expertise to ensure a comprehensive and effective Quranic education. These dedicated instructors are committed to fostering a deep understanding of the Quran while accommodating individual needs and preferences. Their knowledge and experience make them valuable mentors for your Quranic journey.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                    	<div class="col-md-12 skin-background px-3 py-4" style="border-radius: 10px; min-height: 269px">
	                        <h4 class="text-capitalize">Rolling monthly program with no contracts</h4>
	                        <p>We offer a convenient monthly pricing plan designed to cater to the needs of our students. This flexible payment option enables students to access our services without committing to long-term fees. Whether you're a dedicated learner or someone with varying commitments, our monthly pricing plan ensures accessibility and affordability, allowing you to engage with our offerings on your terms.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="row d-flex justify-content-evenly mt-2">
                    <div class="col-md-6 mb-3">
                    	<div class="col-md-12 skin-background px-3 py-4" style="border-radius: 10px; min-height: 269px">
	                        <h4 class="text-capitalize">Tailored instruction in personalized classes</h4>
	                        <p>One-on-one instruction in personalized Quran classes delivers tailored learning, offering individualized attention for a profound understanding of the Quran. In contrast to group settings, this approach allows students to explore the Quran's depths at their own pace. It fosters a deeper connection, meaningful discussions, and immediate feedback, providing a flexible and accessible path to enhancing one's Quranic knowledge and spiritual journey.</p>
                    	</div>
                	</div>
                    <div class="col-md-6 mb-3">
                    	<div class="col-md-12 skin-background px-3 py-4" style="border-radius: 10px; min-height: 269px;">
	                        <h4 class="text-capitalize">Three days of free trial lessons</h4>
	                        <p>Experience our services with three days of complimentary trial lessons. We believe in the value of our offerings, and we want you to explore them risk-free. During this trial period, you can evaluate our teaching methods and curriculum, ensuring that it aligns with your learning goals and preferences. It's an opportunity to make an informed decision about continuing your educational journey with us.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Alhamdullilah</h5>
                    <h3 class="text-green">Learn Tajweed-ul-Quran rules with expert teachers</h3>
                    <p>Embark on a journey to master the art of Tajweed-ul-Quran, the skill of precise Quranic pronunciation and recitation. Our dedicated team of experienced instructors is well-versed in the intricate rules and subtleties of Tajweed. They are here to assist you in perfecting your Quranic recitation. By joining our program, you will have the opportunity to deepen your comprehension and expertise in this sacred art under the guidance of seasoned professionals.
                    </p>
                    <p>
                        Tajweed is not just about accurate pronunciation; it's a gateway to a more profound connection with the Quran's profound message. Our instructors are passionate about imparting their knowledge and helping you unlock the beauty and meaning within each verse. Whether you're a beginner or seeking to refine your skills, our program is designed to cater to your needs. Join us on this enriching journey of Quranic mastery, and let Tajweed become a part of your spiritual practice.
                    </p>
                </div>
                <div class="col-md-6">
                    <img alt="online quran" class="img-fluid" src="{{ asset('/public/dist/img/exports/Frame%203.png') }}">
                </div>
            </div>
        </div>
    </section>




    <section class="pt-5 pb-5" id="interactive-quran-classes">
        <div class="container">
            <div class="row d-flex" style="object-fit: contain !important;">
                <div class="col-md-6">
                    <img alt="quran teacher" class="img-fluid" src="{{ asset('/public/dist/img/exports/home-page-left-section.jpg') }}">
                </div>
                <div class="col-md-6 mt-1">
                    <h5>Alhamdullilah</h5>
                    <h3 class="text-green">Interactive Quran classes with whiteboard & screen sharing</h3>
                    <p>
                        Engage in enriching Quranic education through our interactive classes featuring whiteboard and screen sharing functionalities. Our classes are designed to enhance your learning experience by encouraging active participation. With the whiteboard, instructors can visually explain and illustrate Quranic concepts, simplifying complex topics for better comprehension. Screen sharing facilitates real-time sharing of Quranic texts, Tafsir, and related materials, further enriching your understanding. You can actively engage with the instructor, ask questions, and participate in discussions, fostering a deeper connection with the Quran. Whether you're a beginner or seeking to deepen your Quranic knowledge, our interactive Quran classes offer a modern and effective approach to connect with the holy text.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="pb-5 pt-5" id="learn-tajweed-ul-quran"
             style="object-fit: contain !important; background-color: #007664;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-skin">
                        Alhamdullilah
                    </h5>
                    <h4 class="text-skin">
                        It’s flexible, saves time and fits effortlessly into family life.
                    </h4>
                    <p class="text-skin">
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
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="box-skin col-lg-4 col-sm-12">
                            <h5>
                                Quran Reading:
                            </h5>
                            <p>
                                It's one of the essential practices learned by Muslim kids whose native language is not
                                Arabic.
                                Our Islamic teachers are well-qualified for teaching this course online to your kids and
                                adults.
                                This course takes about three years of Duration for completing the whole Quran reading.
                                Don't
                                worry about our classes; we provide personalized interactive lessons and single Quran
                                teachers
                                to single teachers for better attention. If you want to see your kids read Holy book
                                accurately,
                                then join our online Quran classes.
                            </p>
                        </div>

                        <div class="box-green col-lg-4 col-sm-12 border-0">
                            <h5>
                                Quran Memorization:
                            </h5>
                            <p>
                                It's another practice of the Islamic religion for enlightening the heart with the light of
                                the
                                Quran. Allah becomes very happy after knowing that His person remembers His book with total
                                dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the
                                world and hereafter. People don't have Quran Madrassas nearby. Hence, they can join our
                                online
                                Quran classes to memorize unforgettable Quran with accurate pronunciation.
                            </p>
                        </div>

                        <div class="box-skin col-lg-4 col-sm-12">
                            <h5>
                                Tajweed-Ul-Quran:
                            </h5>
                            <p>
                                It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and
                                accuracy,
                                and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra
                                and
                                read Quran in a simple tone, but we should read Holy book as Commanded by Allah to read with
                                a
                                cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our
                                Tajweed
                                classes online because we have the best Tajweed teacher who teaches you interactive
                                learning.
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
                <div class="col-md-6">
                    <div class="container">
                        <div class="row d-flex justify-content-center py-5">
                            <div class="col-lg-9 col-md-12 col-sm-9">
                                <h1 class="bigger-text">
                                    Get 3 trial sessions before you book
                                </h1>
                                <p>
                                    Sign up today to our 3-day free Quran classes to ask questions and to find out about
                                    our
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
                <div class="col-lg-8 col-md-9 col-sm-12 py-5">
                    <h5 class="text-skin text-center p-0 m-0">Alhamdullilah</h5>
                    <h2 class="text-skin text-center text-capitalize p-3 m-0 mb-2">
                        Here's what our Students and Parents have to say!
                    </h2>
                    <div class="box-skin" style="border-radius: 10px;">
                        <div class="row">
                            <div class="col-12">
                                <div class="p-3 text-center m-auto">
                                    <h1 style="font-size: 5.5rem;">{{ round($avg, 2) ?? 0 }}</h1>
                                    <div>
                                        @php
                                            $averageRating = round($avg, 2) ?? 0;
                                            $fullStars = floor($averageRating);
                                            $halfStar = $averageRating - $fullStars >= 0.5;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullStars)
                                                <i class="fa fa-star rating-stars"></i>
                                            @elseif ($halfStar && $i == $fullStars + 1)
                                                <i class="fa fa-star-half rating-stars"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12">

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
                            <div class="col-lg-6 col-md-12 col-12 mt-lg-0 mt-md-0 mt-4">
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
                                    <h5>Alhamdullilah</h5>
                                    <h3 class="text-green">
                                        What Our client’s Says Here are some glimpse!
                                    </h3>
                                    <p>
                                        "Online Quran tuition has been a fantastic experience for my child. The
                                        personalized
                                        attention and interactive sessions have helped them improve their recitation and
                                        understanding of the Quran. The tutor is knowledgeable, patient, and supportive.
                                        I
                                        highly recommend this service to anyone looking for quality Quran education
                                        online."
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12" id="video-reviwes-column">
                                    <img src="{{ asset($video->image) }}" alt="Review" class="reviews_video_slider">
                                    <button type="button"
                                            class="btn btn-greenish py-4 px-5 youtube-video video-controls"
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
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <h3 class="text-skin">Read our FAQ’s?</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
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
                                    <div id="accordion-{{ $loop->iteration }}" class="accordion-collapse collapse"
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

                        <div id="morecities" style="display: none">


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
                                    <a class="nav-link" href="{{ route('southampton') }}">Quran teacher in
                                        Southampton</a>
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
                                    <a class="nav-link" href="{{ route('walthamstow') }}">Quran teacher in
                                        Walthamstow</a>
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
                                    <a class="nav-link" href="{{ route('stokeon') }}">Quran teacher in Stoke On
                                        Trent</a>
                                </div>
                            </div>

                        </div>


                        <div class="row justify-content-center mt-2">
                            <div class="col-md-12">
                                <button class="btn btn-greenish text-white" id="cittiesToggle" onclick="toggleCities()">
                                    Show More
                                </button>
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
        const moreCities=document.getElementById("morecities");
        const toggleButton = document.getElementById("cittiesToggle");

        function toggleCities(){
            if (toggleButton.textContent === 'Show More') {
                moreCities.style.display="block";
                toggleButton.textContent = 'Show Less';
            } else {

                moreCities.style.display="none";
                toggleButton.textContent = 'Show More';
            }
        }
    </script>
    <script>
        // Get the slider element
        var slider = document.querySelector('.carousel-inner');

        // Add event listener to the modal's open event
        $('.modal').on('shown.bs.modal', function (e) {
            // Pause or disable the slider
            document.querySelector('.carousel-inner').style.display = 'none';
            /* slider.style.pointerEvents = 'none'; */
        });

        // Add event listener to the modal's close event
        /* $('.modal').on('hidden.bs.modal', function(e) {
            // Resume or enable the slider
            slider.style.pointerEvents = 'auto';
        }); */
    </script>

    @section('js')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

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

                setTimeout(function () {
                    thhis.text("");
                    for (var i = 0; i < amntOfChars; i++) {
                        (function (i, char) {
                            setTimeout(function () {
                                newString += char;
                                thhis.text(newString);
                            }, i * typingSpeed);
                        })(i + 1, text[i]);
                    }
                }, 500);
            }

            $(document).ready(function () {
                $(".blinked-circle").hide();
                autoType(".type-js", 70);
                $(".blinked-circle").delay(4300).fadeIn();
            });

            $(document).on('click', 'a', function (event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function () {
                        window.location.hash = hash;
                    });
                }
            });
            <
                   />
    @endsection
@stop
