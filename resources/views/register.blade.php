@extends('layouts.new-app')
@section('title', 'Register')
@section('content')
    <section class="bg-signup" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5 mb-5 spacer">

                    <h2 class="text-skin">
                        Are you <br>
                        Interested?
                    </h2>
                    <p class="text-skin">Sign up for 3-day FREE trial Today. <br>
                    <p>

                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row green-background p-3 d-flex align-items-center" style="margin-top: -50px;">
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex align-items-center">
                    <h5 class="text-skin">Used by 500+ students</h5>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                    <img alt="" src="./img/trustpilot.png">
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
@endsection
