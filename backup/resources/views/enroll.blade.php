@extends('layouts.app')
@section('css')
@endsection
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section class="pages-banner-heading" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset($settings['header_banner_image']) }});">
        <div class="container">
            <div class="row">
                <div class="col-12 banner-left-heading m-auto">
                    <h1 class="text-white">Wants to <span>learn online</span></h1>
                    <h5 class="text-white">Submit inquiry and start your <br/>free trial course with our teachers.</h5>
                </div>
            </div>
        </div>
    </section>

    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">
        <div class="mt30">
            <div class="center-y">
                <div class="container">
                    <div class="row">
                        <div class="col-12 banner-left-heading text-center">
                            <h1>Try it Now</h1>
                        </div>
                    </div>
                    <div class="row">
                        @include('admin.partials.success_message')
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8 mb-sm-30" style="box-shadow: 10px 10px 52px -20px rgba(0,0,0,0.35);">
                            <form name="contactForm" id='contact_form' class="mb-4 p-5" method="post" action="{{ route('enroll_submit') }}">
                                @csrf
                                <input type="hidden" name="student_time_difference" id="time_zone">
                                @if($errors->has('name'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                                @endif
                                <div class="field-set">
                                    <label>Enter Your Name</label>
                                    <input type='text' name='name' id='name' class="form-control" placeholder="Your Name" required>
                                    @if($errors->has('name'))
                                    <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="field-set">
                                    <label>Enter Your Email</label>
                                    <input type='text' name='email' id='email' class="form-control" placeholder="Your Email" required>
                                    @error('email')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="field-set">
                                    <label>Your Phone Number</label>
                                    <input type='text' name='phone' id='phone' class="form-control" placeholder="Your Phone" required>
                                    @error('phone')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="field-set mt-3">
                                    @if(config('services.recaptcha.key'))
                                        <div class="g-recaptcha"
                                            data-sitekey="{{config('services.recaptcha.key')}}">
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-5">
                                    <img src="{{ asset('images/loading.gif') }}" style="width:50px;" class="loading-image d-none">
                                    <button type='submit' class="btn btn-custom btn-site">Submit Form</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- section close -->
</div>
@section('js')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
     $(document).ready(function () {
        var d = new Date();
        var n = d.getTimezoneOffset();
        $('#time_zone').val(n);
     });
     
</script>
@endsection
@stop
