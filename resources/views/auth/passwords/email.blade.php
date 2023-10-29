@extends('layouts.new-app')

@section('content')
    <section class="bg-login" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5 mb-5 spacer">
                    <h2 class="text-skin">
                        Forgot Your Password?
                    </h2>
                    <p class="text-skin">Follow the link in email to reset your password.
                    <p>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row green-background p-3 d-flex align-items-center" style="margin-top: -50px;">
                <div class="col-md-3 d-flex align-items-center">
                    <h5 class="text-skin">Used by 500+ students</h5>
                </div>
                <div class="col-md-3 d-flex align-items-center d-flex justify-content-center">
                    <img alt="" src="{{ asset('/public/dist/img/trustpilot.png') }}">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                    <a href="{{ route('testimonials') }}"> <img alt=""
                            src="{{ asset('/public/dist/img/Google_Reviews.png') }}"> </a>
                </div>
                <div class="col-md-3 d-flex align-items-center d-flex justify-content-center">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>
            </div>
        </div>
    </section>
    <section id="booking-form" class="pb-5 pt-5">
        <div class="container">
            <div class="row">
                @include('admin.partials.success_message')
            </div>
            <div class="row">
                <div class="col-md-6 green-background">
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-10 text-skin mt-3">
                                <h1 class="bigger-text" style="font-size: 59px;">
                                    Forget Password
                                </h1>
                                <p>
                                    Check your email after submitting.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form name="contactForm" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        @include('admin.partials.success_message')
                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="text"
                                class="form-control borderBottomClass @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" id="email" autocomplete="email" autofocus
                                placeholder="Email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Reset Link" class="form-control w-25 green-background text-skin float-start"
                                style="border-radius: 2px;">
                        </div><br><br>
                        @if (session('status'))
                            <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                        @endif
                        @if (session('error'))
                            <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
