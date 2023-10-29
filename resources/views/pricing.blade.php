@extends('layouts.new-app')
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
                    <h4 class="text-skin">ALHAMDULILLAH</h4>
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
                    <a class="btn green-background text-skin mb-3" href="{{ route('enroll') }}">
                        Get A Free Trial
                    </a>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
    <section id="matrix">
        <div class="container">
            <div class="row green-background p-3 d-flex align-items-center" style="margin-top: -50px">
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3">
                    <h5 class="text-skin">Used by 500+ students</h5>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                    <img alt="" src="{{asset('/public/dist/img/trustpilot.png')}}" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                    <a href="{{ route('testimonials') }}"> <img alt=""
                            src="{{ asset('/public/dist/img/Google_Reviews.png') }}"> </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ALHAMDULILLAH</h5>
                    <h3 class="text-green text-uppercase">
                        You will only pay for <br>
                        what you use
                    </h3>
                    <p>Our rolling monthly program offers a unique advantage: no binding contracts. This means you have the freedom to pay as you learn and the flexibility to cancel at any time. It puts you in control of your Quranic education, allowing you to adapt your learning to your schedule and needs without any long-term commitments. This flexibility is especially beneficial for those with varying schedules or changing circumstances. You can engage in your Quranic journey on your own terms, ensuring that your learning experience is as convenient and stress-free as possible. Join us in this empowering approach to Quranic education that prioritizes your needs and preferences.
                    </p>
                </div>
                <div class="col-md-6">
                    <img alt="" class="img-fluid" src="{{asset('/public/dist/img/exports/Group 113.png')}}">
                </div>
            </div>
        </div>
    </section>
    <?php /*
    <section id="talk-to-us" class="pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <img src="{{asset('/public/dist/img/exports/Rectangle 5.png')}}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 text-end text-white d-flex align-items-center">
                    <div>
                        <h5>ALHAMDULILLAH</h5>
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
    */ ?>
    <section id="pricing_cards">
        <div class="container my-5">
            <div class="row">
                <h3 class="text-center text-green text-uppercase">Get your best desired pricing plan</h3>
                <p class="text-center">Start your inquiry session now just go to submit inquiry</p>
                @foreach ($plans as $pl)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card mt-lg-0 mt-md-3 mt-3">
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
                        

                        <div class="form-group">
                            <input type="checkbox" id="exampleCheck1" value="1" name="terms_condition" required
                                data-parsley-required-message="Please confirm the field to agree with terms"
                                class="form-check-input">
                            <label for="exampleCheck1"><span></span> I have read and understand the <a
                                    href="{{ url('terms') }}" class="text-green"> Terms of use </a> & <a
                                    href="{{ url('privacy') }}" class="text-green">Privacy Policy</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn green-background text-skin float-end" value="Sign Up" style="border-radius: 0 !important; padding: 0.5rem 2rem;">
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