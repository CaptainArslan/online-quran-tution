@extends('layouts.new-app')
@section('title', 'Login')
@section('content')
    <!-- content begin -->
    <section class="bg-login" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5 mb-5 spacer">

                    <h2 class="text-skin">
                        Correct credentials, <br>
                        take you to dashboard
                    </h2>
                    <p class="text-skin">Login to experience the best tutor <br>
                        service in the world.
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
                                    Login your account
                                </h1>
                                <p>
                                    Login to experience the best tutor <br>
                                    service in the world.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <form name="contactForm" method="post" action="{{ route('admin/login') }}">
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
                            <label>Enter Your Password</label>
                            <input type="password"
                                class="form-control borderBottomClass @error('password') is-invalid @enderror"
                                name="password" autocomplete="current-password" id="password" placeholder="Password"
                                required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="field-set mb-3">
                            @if (config('services.recaptcha.key'))
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control w-25 green-background text-skin float-start"
                                style="border-radius: 2px;">
                        </div>
                        <div style="margin-top: 4rem!important;">
                            @if (Route::has('password.request'))
                                <b>
                                    <p class="mb-0"><a href="{{ route('password.request') }}"
                                            class="text-green">{{ __('Forgot Your Password?') }}</a></p>
                                </b>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- content close -->


@stop

@section('js')
    <script>
        $(window).load(function() {
            jQuery('html,body').animate({
                scrollTop: 380
            });

        });
    </script>
@endsection
