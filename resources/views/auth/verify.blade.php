@extends('layouts.new-app')
@section('content')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- revolution slider begin -->
        <!-- section begin -->
        <section class="no-top no-bottom text-light" data-bgimage="url({{ asset('front_assets') }}/images/background/6.jpg")
            data-stellar-background-ratio=".2"
            style="background-position:center; background-size:cover; background-repeat:no-repeat;">
            <div class="overlay-gradient t80 pb30 pt90">
                <div class="center-y pt30 ">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8 offset-md-2 text-center py-5">
                                <h1 class="text-black"><b>For Email Verify</b></h1>
                                <p class="lead text-black"><b>Ask any questions using form below.</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">
            <div class="mt30">
                <div class="center-y">
                    <div class="container py-3">
                        <div class="row justify-content-center">
                            <div class="">
                                <h1 class="text-center text-green">Please Verify Your Email Address</h1>
                            </div>
                            <div>
                                <h3 class="text-center">
                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email') }},
                                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                    </form>
                                </h3>
                                <h4 class="text-center">
                                    @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-4">

                            @if (session('success'))
                                <div class="alert alert-success col-12" role="alert">
                                    <h4 class="mb-0">
                                        {{ __('Email has been updated Please verify your email') }}
                                    </h4>
                                </div>
                            @endif

                            <div class="col-md-6 mt-3">
                                <form method="post" action="{{ route('email.update') }}" class=" mt-2"
                                    data-parsley-validate="" id="payment-form">
                                    @csrf
                                    <div class="col-12 text-center">
                                        <a href="javascript:;" class="text-green font-weight-bold show-email">Want to Update
                                            email?</a>
                                    </div>

                                    <div class="row mt-1 hidden" @error('email') @else @enderror>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email" required placeholder="New Email" style="border: 1px solid black;">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-success rounded py-2 submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- section close -->

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.show-email', function() {
                $('.hidden').show();
            });
        });
    </script>
@endsection
