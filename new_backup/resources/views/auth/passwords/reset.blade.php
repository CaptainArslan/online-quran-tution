@extends('layouts.new-app')

@section('content')
    <!-- content begin -->
    <section class="bg-signup" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5 mb-5 spacer">
                    <h2 class="text-skin">
                        Reset Your Password
                    </h2>
                    <p class="text-skin">After that you are ready to use the website<br>
                    <p>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row green-background p-3 d-flex align-items-center" style="margin-top: -50px;">
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex align-items-center">
                    <h5 class="text-skin">Used by 500+ students</h5>
                </div>
                <div class="col-md-3 d-flex align-items-center d-flex justify-content-center">
                    <img alt="" src="{{ asset('/public/dist/img/trustpilot.png') }}">
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
                @include('admin.partials.success_message')
            </div>
            <div class="row">
                <div class="col-md-6 green-background">
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-10 text-skin mt-3">
                                <h1 class="bigger-text" style="font-size: 59px;">
                                    Set A New Password Here
                                </h1>
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
                            <label>Email Address</label>
                            <input id="email" type="email"
                                class="form-control borderBottomClass @error('email') is-invalid @enderror" name="email"
                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input id="password" type="password"
                                class="form-control borderBottomClass @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password" placeholder="New Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control borderBottomClass"
                                name="password_confirmation" required autocomplete="new-password" placeholder="Write Your Password Again">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control w-25 green-background text-skin float-start"
                                style="border-radius: 2px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
