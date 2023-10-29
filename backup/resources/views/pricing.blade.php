@extends('layouts.app')
@section('title', $settings['how_it_works_meta_title'] ?? '')
@section('meta')

    <meta name="description" content="{{ $settings['how_it_works_meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">
@endsection
@section('content')
    <!-- content begin -->
    <section id="hero-pricing">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <h4 class="text-skin">ALLHAMDULILLAH</h4>
                    <h2 class="text-skin text-uppercase">
                        Bespoke Online Quran </br>
                        Tutoring that is flexible </br>
                        and affordable
                    </h2>
                    <p class="text-skin">
                        We aspire our students to attain a greater understanding of The</br>
                        Holy Quran in a manner that is spiritually rewarding and </br>
                        financially feasible.
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
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ALHAMDULLILAH</h5>
                    <h3 class="text-green text-uppercase">
                        High quality personalised <br>
                        Quran tuition
                    </h3>
                    <p>
                        Learn Quran online with our well versed well qualified <br>
                        teachers who have a vast experience of teaching, <br>
                        Noorani Qaida, Tajweed-ul-Quran and <br>
                        Quran memorization (Hifz).
                    </p>
                </div>
                <div class="col-md-6">
                    <img alt="" class="img-fluid" src="{{asset('/public/dist/img/exports/Group 113.png')}}">
                </div>
            </div>
        </div>
    </section>
    <section id="talk-to-us" class="pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <img src="{{asset('/public/dist/img/exports/Rectangle 5.png')}}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 text-end text-white d-flex align-items-center">
                    <div>
                        <h5>ALHAMDULLILAH</h5>
                        <h3 class="text-skin">
                            You will only pay for </br>
                            what you use
                        </h3>
                        <p>
                            With our rolling monthly program there are no contracts </br>
                            which allow you to pay as you learn and cancel at any</br>
                            Time, offering flexibility, control, and freedom </br>
                            to your learning.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="pricing_cards">
        <div class="container my-5">
            <div class="row">
                <h3 class="text-center text-green text-uppercase">Get your best desired pricing plan</h3>
                <p class="text-center">Start your inquiry session now just go to submit inquiry</p>
                @foreach ($plans as $pl)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header green-background text-white text-center p-3">
                                <p>{{ $pl->name }}</p>
                                <div class="ptable-price">
                                    <h3>{{ $pl->country->currency }} @php echo $discounted_price = $pl->price - $pl->discount;  @endphp <span> / Hour</span></h3>
                                </div>
                            </div>
                            <div class="card-body skin-background text-center px-0">
                                <p class="card-text"><span><img src="{{asset('/public/dist/img/exports/Frame.png')}}" alt=""></span>
                                    {{ $pl->days_in_week ?? '' }} Days In Week</p>
                                <hr>
                                <p class="card-text"><span><img src="{{asset('/public/dist/img/exports/Frame.png')}}" alt=""></span>
                                    {{ $pl->classes_in_month ?? '' }} classes in month</p>
                                <hr>
                                <p class="card-text"><span><img src="{{asset('/public/dist/img/exports/Frame.png')}}" alt=""></span>
                                    {{ $pl->duration ?? '' }} minutes duration</p>
                                <hr>
                                <p class="card-text"><span><img src="{{asset('/public/dist/img/exports/Frame.png')}}" alt=""></span>
                                    {{ $pl->country->currency }}{{ $pl->price_per_month ?? '' }} price per month</p>
                                <hr>
                                <a href="{{ route('enroll') }}" class="btn green-background text-skin"
                                    style="border-radius: 2px;">Submit your inquiry Now!</a>
                            </div>
                        </div>
                    </div>
                @endforeach
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
    <!-- content close -->

@stop
@section('js')

    <script type="text/javascript">
        $(document).ready(function() {
            var d = new Date();
            var n = d.getTimezoneOffset();
            $('#time_zone').val(n);
        });
    </script>
