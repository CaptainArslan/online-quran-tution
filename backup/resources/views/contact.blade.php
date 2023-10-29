@extends('layouts.app')
@section('css')
@endsection
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section class="container-banner-lg p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 banner-left-heading m-auto">
                    <div class="banner-left-area">
                        <h1 class="text-dark custom-font-3">Wants to <span>learn online</span></h1>
                        <p class="text-justify text-dark">Submit inquiry and start your online tutoring course with our teachers.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 asideimg" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset($settings['header_banner_image']) }});"></div>
                {{-- <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset($settings['header_banner_image']) }});">

                </div> --}}
            </div>
        </div>
    </section>
    <section class="container-banner-md p-0" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset($settings['header_banner_image']) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 banner-left-heading m-auto">
                    <div class="banner-left-area">
                        <h1 class="text-white custom-font-3">Wants to <span>learn online</span></h1>
                        <p class="text-justify text-white">Submit inquiry and start your online tutoring course with our teachers.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12"></div>
                {{-- <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset($settings['header_banner_image']) }});">

                </div> --}}
            </div>
        </div>
    </section>

    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">
        <div class="mt30">
            <div class="center-y">
                <div class="container">
                    <div class="row">
                        <div class="col-12 banner-left-heading text-center">
                            <h1>Contact us</h1>
                        </div>
                    </div>
                    <div class="row">
                        @include('admin.partials.success_message')
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8 mb-sm-30" style="box-shadow: 10px 10px 52px -20px rgba(0,0,0,0.35);">
                            <form name="contactForm" id='contact_form' class="mb-4 p-5" method="post" action="{{ route('contact_submit') }}">
                                @csrf
                                @if($errors->has('name'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="field-set">
                                            <label>Name</label>
                                            <input type='text' name='name' id='name' class="form-control" placeholder="Name" required>
                                            @if($errors->has('name'))
                                            <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="field-set">
                                            <label>Email</label>
                                            <input type='text' name='email' id='email' class="form-control" placeholder="Email" required>
                                            @error('email')
                                            <span class="danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="field-set">
                                    <label>Subject</label>
                                    <input type='text' name='subject' id='subject' class="form-control" placeholder="Subject" required>
                                    @error('subject')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="field-set">
                                    <label>Message </label>
                                    <textarea name='message' id='message' class="form-control" placeholder="Enter your message" rows="3" required></textarea>
                                    @error('inquiry')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div>
                                    <button type='submit' class="btn btn-custom btn-site">Submit</button>
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
@endsection
@stop
