@extends('layouts.app')
@section('title', $settings['how_it_works_meta_title'] ?? '')
@section('meta')

    <meta name="description" content="{{ $settings['how_it_works_meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">
@endsection
@section('content')
    <!-- content begin -->
    <section id="hero-courses">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <h4 class="text-skin">Alhamdullilah</h4>
                    <h2 class="text-skin">
                        One-to-One online Quran tutoring that delivers results.
                    </h2>
                    <p class="text-skin">
                        A platform for online education made for Muslims <br />
                        who want to read the Holy Quran from the safety<br />
                        of their homes. We aim to provide Quranic education<br />
                        with convenience. So that one may inhibit self with<br />
                        spiritual peace. So, we provide individual classes for<br />
                        better consequences. As a personalized education<br />
                        system is a proven methodology.
                    </p>
                    <a class="btn green-background text-skin mb-3" href="#">
                        Get A Free Trial
                    </a>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
    <section id="matrix">
        <div class="container">
            <div class="row green-background p-3" style="margin-top: -50px">
                <div class="col-md-3">
                    <h5 class="text-skin">used by 500+ students</h5>
                </div>

                <div class="col-md-3">
                    <img alt="" src="{{asset('/public/dist/img/trustpilot.png')}}" />
                </div>

                <div class="col-md-3">
                    <img alt="" src="{{asset('/public/dist/img/google.png')}}" />
                </div>

                <div class="col-md-3">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>
            </div>
        </div>
    </section>

    <section id="online-course" class="pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6>ALLHAMDULilah</h6>

                    <h3 class="text-green fw-bold">Online course for the beginners</h3>
                    <p>
                        Basic education for every Muslim is to learn and understand The
                        Holy Quran. Keeping in view this purpose we have designed this
                        course for beginners, irrespective of age or gender, everyone is
                        welcomed to join this course who are willing to recite and learn
                        basic Quran teachings. Realizing the fact that not everyone is
                        fluent in Arabic language, this course covers every aspect of
                        reading the Quran from the basic levels. So that every beginner at
                        the end of this will be able to start their journey to learning
                        Arabic in a way that will directly impact your relationship with
                        the Quran and your Salah, and ultimately with Allah.
                    </p>
                </div>
                <div class="col-md-6 green-background pt-2 pb-2">
                    <p class="text-white">Main objectives:</p>
                    <ul class="text-white">
                        <li>To learn the separate forms of the Arabic letter.</li>
                        <li>The pronunciation will be 100% in the Arabic accent.</li>
                        <li>
                            Understand Arabic letters with their joint forms (Beginning,
                            middle, ending)
                        </li>
                        <li>Learn how to join letters to make words</li>
                        <li>
                            To read, understand and practice with exercises the short
                            vowels' sounds
                        </li>
                        <li>To read, understand and practice the long vowels sounds</li>
                        <li>Understand and read Jazm, Shaddah, Sukoon and Tanween</li>
                        <li>
                            To understand Madd categories and read for the appropriate
                            duration
                        </li>
                        <li>To Learn the STOP and PAUSE signs in the Quran</li>
                        <li>Huroof Muqatta'aat</li>
                        <li>To learn Stopping denoting pause (Ramoozul Auqaf)</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="online-tajweed" class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-skin">Alhamdullilah</h6>
                    <h3 class="text-skin">Online quran tajweed course</h3>

                    <p class="text-skin">
                        The word Tajweed (Tajwid) is a verbal noun from jawwada. Meaning
                        'proficiency.' When applied to the Quran. It means to recite every
                        letter of the Quran with its rights characteristics. Observing all
                        the rules required for reading the Quran. Muslims around the world
                        are under the obligation to learn the Quran. As it was revealed by
                        using the rules of Tajweed Online Quran Tuition offers courses and
                        lessons of Tajweed to learn Quran by applying the rules of
                        Tajweed. Our experienced tutors will teach Tajweed courses to
                        beginners and advanced levels.. Throughout this course you will
                        get lots of opportunities to practice the rules and recite the
                        Quran with natural style .By enrolling in this course you’ll get
                        perfection in the recitation of your Quran reading (according to
                        the rules). We’ll teach you detailed rules and terminologies of
                        tajweed.
                    </p>
                </div>
                <div class="col-md-6 skin-background pt-2 pb-2">
                    <h6 class="text-green">Main objectives:</h6>
                    <ul>
                        <li>Understand the shapes of Arabic letters.</li>
                        <li>Read Quran letters with the correct pronunciation.</li>
                        <li>know the Arabic alphabet and identify the origins.</li>
                        <li>Read the Quran with accuracy.</li>
                        <li>
                            Memorize the last 10 Suras of the Quran using Tajweed rules.
                        </li>
                        <li>Learn the exceptional rules of Qira'ah.</li>
                        <li>To learn joint forms of the Arabic alphabet.</li>
                        <li>Learn Tafkhaam (heavy sounds).</li>
                        <li>The rules of Meem Saakina</li>
                        <li>The rules of Laam Sakinah.</li>
                        <li>Ramooz ul Auqaaf.</li>
                        <li>Implementation of Tajweed rules by reciting.</li>
                        <li>
                            learn the mandatory attributes of Arabic letters (Sifaat e
                            Lazimah).
                        </li>
                        <li>
                            learn the temporary attributes of Arabic letters (Sifaat e
                            AAridhah).
                        </li>
                        <li>Know the types and rules of assimilation (Idghaam).</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="memorization-course" class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6>ALLHAMDULilah</h6>
                    <h3 class="text-green">Quran Online Memorization course</h3>
                    <p>
                        If you aspire to become a Hafiz / Hafizah or you simply want to
                        memorize the Quran, this foundational course is the perfect first
                        step to your lifelong Quran memorization journey. It Is The Next
                        Level Course designed for students who Have Basic Knowledge Of The
                        Quran And The Arabic Language. Memorization of the Noble Quran
                        takes effort and sincere commitment. However, the rewards from
                        Allah are immense in this worldly life and Hereafter. Quran
                        memorization course is an excellent opportunity for the learners
                        who seek to start memorizing Quran classes online without the fear
                        to forget it.
                    </p>
                    <p>
                        This course is for everyone who can read or understand Arabic or
                        not. The Quran tutor will take it step by step for you,
                    </p>
                    <p>
                        till you achieve your goal. The tutor will help Students to learn
                        easy techniques for fast Memorization. Students of all ages can
                        enroll in our course and learn to memorize the Quran from expert
                        hafiz tutors. This course will help you increase your memory and
                        learning ability. We teach in the best way and help students solve
                        the problems of forgetting. We help students complete the course
                        in a short time. Students will learn the lessons step by step.
                    </p>
                </div>
                <div class="col-md-6 green-background p-0">
                    <img src="{{asset('/public/dist/img/exports/memorization-course.png')}}" alt="" class="img-fluid" />
                    <div class="text-white mx-3 mt-3">
                        <h5>Main objectives:</h5>
                        <ul class="text-start" style="padding-left: 1rem">
                            <li>Understand the shapes of Arabic letters.</li>
                            <li>Read Quran letters with the correct pronunciation.</li>
                            <li>know the Arabic alphabet and identify the origins.</li>
                            <li>Read the Quran with accuracy.</li>
                            <li>Read the Quran with accuracy.</li>
                            <li>Read the Quran with accuracy.</li>
                        </ul>
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
@endsection
@section('js')

    <script>
        $(document).ready(function() {
            var d = new Date();
            var n = d.getTimezoneOffset();
            $('#time_zone').val(n);
        });
    </script>

@endsection
