@extends('layouts.app')
@section('content')

<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- revolution slider begin -->
    <!-- section begin -->
    <section class="no-top no-bottom text-light" data-bgimage="url({{asset('front_assets')}}/images/background/6.jpg" ) data-stellar-background-ratio=".2">
        <div class="overlay-gradient t80 pb30 pt90">
            <div class="center-y pt30 ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 offset-md-2 text-center">
                            <h1>For Email Verify</h1>
                            <p class="lead">Ask any questions using form below.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">

        <div class="mt30">
            <div class="center-y">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="">
                            <h1>Please Verify Your Email Address</h1>
                        </div>
                        <div>
                            <h3>
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                </form>
                            </h3>
                            <h4>
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
                            
                        <div class="col-md-6">
                                <form method="post" action="{{route('email.update')}}" class=" mt-2" data-parsley-validate="" id="payment-form">
                                            @csrf
                                            <div class="col-12 text-center">
                                                <a href="javascript:;" class="text-primary font-weight-bold show-email">Update email?</a>
                                            </div>
                                            
                                            <div class="row mt-1 hidden" @error('email') @else style="display: none" @enderror>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="email" required placeholder="New Email">
                                                    @error('email')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <button type="submit"  class="btn btn-primary submit">Update</button>
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
                $(document).ready(function () {
                
                    $('.show-email').click(function () {
                        $('.hidden').show();
                    });
                });
            </script>

@endsection