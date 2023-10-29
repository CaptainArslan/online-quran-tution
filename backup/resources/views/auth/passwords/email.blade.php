@extends('layouts.app')

@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    
    <!-- revolution slider begin -->
    <!-- section begin -->
    <section class="no-top no-bottom text-light" data-bgimage="url({{asset('front_assets')}}/images/background/6.jpg") data-stellar-background-ratio=".2">
        <div class="overlay-gradient t80 pb30 pt90">
            <div class="center-y pt30 ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 offset-md-2 text-center">
                            <h1>{{ __('Reset Password') }}!!</h1>
                            <p class="lead">Follow the link in email to reset your password.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">

        <div class="mt30 mb30">
            <div class="center-y">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mb-sm-30">	
                            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif		
                            <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                    @include('admin.partials.success_message')
                            <div class="field-set">
                                <label>Enter Your Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" autocomplete="email" autofocus placeholder="Email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                            </div>

                            

                            <div class="spacer-half"></div>

                            <div id='submit'>
                                <button type='submit' class="btn btn-custom">{{ __('Send Password Reset Link') }}</button>
                            </div>
                            <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                            <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>

                        </form>
                </div>
                <div class="col-lg-4 mb30">
                                    <div class="padding40 bg-gradient-to-right text-light rounded">
                                        <h3>How to Use</h3>
                                        <address class="s1">												
                                        <span> <i class="fa fa-search fa-lg"></i>Search for Subject</span>
                                        <span><i class="fa fa-user fa-lg"></i>Choose Your Tutor</span>
                                        
                                        <span><i class="fa fa-clock-o fa-lg"></i><a href="#">Start or schedule a lesson</a></span>
                                    </address>
                                    </div>
                    
                      </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- section close -->
    
</div>
<!-- content close -->
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
