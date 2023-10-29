@extends('admin.layouts.app')
@section('title', 'CMS')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

<div class="content-header row">
</div>
<div class="content-body">
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Banners And Logos</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.store_settings') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        {{-- <img src="#" alt="Logo" width="500" height="600"> --}}
                                        <input type="file" class="form-control dropify" name="logo_image"
                                            data-default-file="{{ asset($settings['logo_image']?? 'images/logo-light.png')  }}">
                                        @if($errors->has('logo_image'))
                                        {{ $errors->first('logo_image') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>FavIcon</label>
                                        {{-- <img src="#" alt="Logo" width="500" height="600"> --}}
                                        <input type="file" class="form-control dropify" name="fav_icon"
                                            data-default-file="{{ asset($settings['fav_icon']?? '')  }}">

                                        @if($errors->has('fav_icon'))
                                        {{ $errors->first('fav_icon') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Banner Image</label>
                                        {{-- <img src="#" alt="Logo" width="500" height="600"> --}}
                                        <input type="file" class="form-control dropify" name="header_banner_image"
                                            data-default-file="{{ asset($settings['header_banner_image']?? '')  }}">

                                        @if($errors->has('header_banner_image'))
                                        {{ $errors->first('header_banner_image') }}
                                        @endif
                                    </div>
                                </div>
                            </div>


                            {{-- <button type="submit" class="btn btn-primary pull-left">Save</button> --}}
                            <div class="clearfix"></div>
                            {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Navbar</h4>
                    </div>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>

                                    <input type="text" class="form-control" name="phone_number"
                                        value="{{ $settings['phone_number']?? ''  }}">
                                    @if($errors->has('phone_number'))
                                    {{ $errors->first('phone_number') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email Address</label>

                                    <input type="text" class="form-control" name="email_address"
                                        value="{{$settings['email_address']?? ''  }}">

                                    @if($errors->has('email_address'))
                                    {{ $errors->first('email_address') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Navbar Text</label>

                                    <input type="text" class="form-control" name="navbar_text"
                                        value="{{ $settings['navbar_text']?? ''  }}">
                                    @if($errors->has('navbar_text'))
                                    {{ $errors->first('navbar_text') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Header Heading</label>

                                    <input type="text" class="form-control" name="header_heading"
                                        value="{{$settings['header_heading']?? ''  }}">

                                    @if($errors->has('header_heading'))
                                    {{ $errors->first('header_heading') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Header SubHeading</label>

                                    <input type="text" class="form-control" name="header_sub_heading"
                                        value="{{$settings['header_sub_heading']?? ''  }}">

                                    @if($errors->has('header_sub_heading'))
                                    {{ $errors->first('header_sub_heading') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address</label>

                                    <input type="text" class="form-control" name="site_address"
                                        value="{{$settings['site_address']?? ''  }}">

                                    @if($errors->has('site_address'))
                                    {{ $errors->first('site_address') }}
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="m-auto font-weight-bold ">
                            <h2>Header Steps</h2>
                            <hr />
                        </div>

                    </div>
                    <div class="card-content">
                        <div class="card-body">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Step 1 Heading</label>

                                        <input type="text" class="form-control" name="step_1_heading"
                                            value="{{ $settings['step_1_heading'] ?? '' }}">
                                        @if($errors->has('step_1_heading'))
                                        {{ $errors->first('step_1_heading') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Step 1 Description</label>

                                        <textarea rows="4" cols="50" type="text" class="form-control"
                                            name="step_1_description">{{ $settings['step_1_description'] ?? '' }}</textarea>
                                        @if($errors->has('step_1_description'))
                                        {{ $errors->first('step_1_description') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Step 2 Heading</label>

                                        <input type="text" class="form-control" name="step_2_heading"
                                            value="{{ $settings['step_2_heading'] ?? '' }}">
                                        @if($errors->has('step_2_heading'))
                                        {{ $errors->first('step_2_heading') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Step 2 Description</label>

                                        <textarea rows="4" cols="50" type="text" class="form-control"
                                            name="step_2_description">{{ $settings['step_2_description'] ?? '' }}</textarea>
                                        @if($errors->has('step_2_description'))
                                        {{ $errors->first('step_2_description') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Step 3 Heading</label>

                                        <input type="text" class="form-control" name="step_3_heading"
                                            value="{{ $settings['step_3_heading'] ?? '' }}">
                                        @if($errors->has('step_3_heading'))
                                        {{ $errors->first('step_3_heading') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Step 3 Description</label>

                                        <textarea rows="4" cols="50" type="text" class="form-control"
                                            name="step_3_description">{{ $settings['step_3_description'] ?? '' }}</textarea>
                                        @if($errors->has('step_3_description'))
                                        {{ $errors->first('step_3_description') }}
                                        @endif
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <div class="m-auto font-weight-bold ">
                            <h4 class="card-title">A Personalised Solution(Next To Counts)</h4>
                        </div>
                    </div>
                    <div class="card-body">


                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Solution Heading</label>

                                    <input type="text" class="form-control" name="solution_heading"
                                        value="{{ $settings['solution_heading']?? ''  }}">
                                    @if($errors->has('solution_heading'))
                                    {{ $errors->first('solution_heading') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Solution Sub Heading</label>

                                    <input type="text" class="form-control" name="solution_sub_heading"
                                        value="{{$settings['solution_sub_heading']?? ''  }}">

                                    @if($errors->has('solution_sub_heading'))
                                    {{ $errors->first('solution_sub_heading') }}
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Solution 1 Heading</label>

                                    <input type="text" class="form-control" name="solution_1_heading"
                                        value="{{ $settings['solution_1_heading']?? ''  }}">
                                    @if($errors->has('solution_1_heading'))
                                    {{ $errors->first('solution_1_heading') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Solution 1 Description</label>

                                    <input type="text" class="form-control" name="solution_1_description"
                                        value="{{$settings['solution_1_description']?? ''  }}">

                                    @if($errors->has('solution_1_description'))
                                    {{ $errors->first('solution_1_description') }}
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Solution 2 Heading</label>

                                    <input type="text" class="form-control" name="solution_2_heading"
                                        value="{{ $settings['solution_2_heading']?? ''  }}">
                                    @if($errors->has('solution_2_heading'))
                                    {{ $errors->first('solution_2_heading') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Solution 2 Description</label>

                                    <input type="text" class="form-control" name="solution_2_description"
                                        value="{{$settings['solution_2_description']?? ''  }}">

                                    @if($errors->has('solution_2_description'))
                                    {{ $errors->first('solution_2_description') }}
                                    @endif
                                </div>
                            </div>

                        </div>



                        {{-- <button type="submit" class="btn btn-primary pull-left">Save</button>
                            <a href="/admin/dashboard" class="btn btn-danger">Close</a>
                            <div class="clearfix"></div>
                            </form> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <div class="m-auto font-weight-bold ">
                            <h4 class="card-title">Offers Section</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Heading</label>

                                    <input type="text" class="form-control" name="offer_heading"
                                        value="{{ $settings['offer_heading']?? ''  }}">
                                    @if($errors->has('offer_heading'))
                                    {{ $errors->first('offer_heading') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>

                                    <input type="text" class="form-control" name="offer_description"
                                        value="{{$settings['offer_description']?? ''  }}">

                                    @if($errors->has('offer_description'))
                                    {{ $errors->first('offer_description') }}
                                    @endif
                                </div>
                            </div>

                        </div>




                    </div>
                    <div class="card-header card-header-primary">
                        <div class="m-auto font-weight-bold ">
                            <h4 class="card-title">Testimonial Section</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Heading</label>

                                    <input type="text" class="form-control" name="testimonial_heading"
                                        value="{{ $settings['testimonial_heading']?? ''  }}">
                                    @if($errors->has('testimonial_heading'))
                                    {{ $errors->first('testimonial_heading') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>

                                    <input type="text" class="form-control" name="testimonial_description"
                                        value="{{$settings['testimonial_description']?? ''  }}">

                                    @if($errors->has('testimonial_description'))
                                    {{ $errors->first('testimonial_description') }}
                                    @endif
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <div class="m-auto font-weight-bold ">
                            <h4 class="card-title">Grade Improvement Section(Next To Offers)</h4>
                        </div>
                    </div>
                    <div class="card-body">


                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Heading</label>

                                    <input type="text" class="form-control" name="grade_heading"
                                        value="{{ $settings['grade_heading']?? ''  }}">
                                    @if($errors->has('grade_heading'))
                                    {{ $errors->first('grade_heading') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sub Heading</label>

                                    <input type="text" class="form-control" name="grade_sub_heading"
                                        value="{{$settings['grade_sub_heading']?? ''  }}">

                                    @if($errors->has('grade_sub_heading'))
                                    {{ $errors->first('grade_sub_heading') }}
                                    @endif
                                </div>
                            </div>

                        </div>


                        <div class="row ">

                            <div class="row match-height">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between pb-0">


                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Title</label>

                                                            <input type="text" class="form-control"
                                                                name="instant_response"
                                                                value="{{ $settings['instant_response'] ?? '' }}">
                                                            @if($errors->has('instant_response'))
                                                            {{ $errors->first('instant_response') }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Description</label>

                                                            <textarea rows="4" cols="50" type="text"
                                                                class="form-control"
                                                                name="instant_response_description">{{ $settings['instant_response_description'] ?? '' }}</textarea>

                                                            @if($errors->has('instant_response_description'))
                                                            {{ $errors->first('instant_response_description') }}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Meta Description</label>

                                                                <input type="text" class="form-control"
                                                                    name="home_meta_description"
                                                                    value="{{ $settings['home_meta_description'] ?? '' }}">

                                                    @if($errors->has('home_meta_description'))
                                                    {{ $errors->first('home_meta_description') }}
                                                    @endif
                                                </div>
                                            </div> --}}

                                        </div>


                                        {{-- <button type="submit" class="btn btn-primary pull-left">Save</button>
                                                        <div class="clearfix"></div>
                                                    </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between pb-0">


                                </div>
                                <div class="card-content">
                                    <div class="card-body">



                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Title</label>

                                                    <input type="text" class="form-control" name="support"
                                                        value="{{ $settings['support'] ?? '' }}">
                                                    @if($errors->has('support'))
                                                    {{ $errors->first('support') }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>

                                                    <textarea rows="4" cols="50" type="text" class="form-control"
                                                        name="support_description">{{ $settings['support_description'] ?? '' }}</textarea>

                                                    @if($errors->has('support_description'))
                                                    {{ $errors->first('support_description') }}
                                                    @endif
                                                </div>
                                            </div>



                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between pb-0">


                                </div>
                                <div class="card-content">
                                    <div class="card-body">



                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Qualified Tutors</label>

                                                    <input type="text" class="form-control" name="qualified_tutors"
                                                        value="{{ $settings['qualified_tutors'] ?? '' }}">
                                                    @if($errors->has('qualified_tutors'))
                                                    {{ $errors->first('qualified_tutors') }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>

                                                    <textarea rows="4" cols="50" type="text" class="form-control"
                                                        name="qualified_tutors_description">{{ $settings['qualified_tutors_description'] ?? '' }}</textarea>

                                                    @if($errors->has('qualified_tutors_description'))
                                                    {{ $errors->first('qualified_tutors_description') }}
                                                    @endif
                                                </div>
                                            </div>



                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between pb-0">


                                </div>
                                <div class="card-content">
                                    <div class="card-body">


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Title</label>

                                                    <input type="text" class="form-control" name="best_tutoring"
                                                        value="{{ $settings['best_tutoring'] ?? '' }}"
                                                        value="{{ $settings['best_tutoring'] ?? '' }}">
                                                    @if($errors->has('best_tutoring'))
                                                    {{ $errors->first('best_tutoring') }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>

                                                    <textarea rows="4" cols="50" type="text" class="form-control"
                                                        name="best_tutoring_description">{{ $settings['best_tutoring_description'] ?? '' }}</textarea>

                                                    @if($errors->has('best_tutoring_description'))
                                                    {{ $errors->first('best_tutoring_description') }}
                                                    @endif
                                                </div>
                                            </div>



                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>




            </div>
        </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>How to Start</h4>
            </div>
            <div class="card-content">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><i class="fab fa-youtube"></i> Youtube video URL for how intro!</label>

                                <input type="text" class="form-control" name="youtube_video"
                                    value="{{ $settings['youtube_video'] ?? '' }}">
                                @if($errors->has('youtube_video'))
                                {{ $errors->first('youtube_video') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Awards & Experience Counter</h4>
            </div>
            <div class="card-content">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Awards counter</label>

                                <input type="number" class="form-control" name="awards_counter"
                                    value="{{ $settings['awards_counter'] ?? '' }}">
                                @if($errors->has('awards_counter'))
                                {{ $errors->first('awards_counter') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Year of experience counter</label>

                                <input type="number" class="form-control" name="experience_counter"
                                    value="{{ $settings['experience_counter'] ?? '' }}">
                                @if($errors->has('experience_counter'))
                                {{ $errors->first('experience_counter') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Social Media Links</h4>

            </div>
            <div class="card-content">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><i class="fab fa-facebook"></i> Facebook</label>

                                <input type="text" class="form-control" name="facebook_link"
                                    value="{{ $settings['facebook_link'] ?? '' }}">
                                @if($errors->has('facebook_link'))
                                {{ $errors->first('facebook_link') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><i class="fab fa-twitter"></i> Twitter</label>

                                <input type="text" class="form-control" name="twitter_link"
                                    value="{{ $settings['twitter_link'] ?? '' }}">

                                @if($errors->has('twitter_link'))
                                {{ $errors->first('twitter_link') }}
                                @endif
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label><i class="fab fa-whatsapp"></i> Whatsapp</label>

                                <input type="text" class="form-control" name="whatsapp_link"
                                       value="{{ $settings['whatsapp_link'] ?? '' }}">

                                @if($errors->has('whatsapp_link'))
                                    {{ $errors->first('whatsapp_link') }}
                                @endif
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label><i class="fab fa-linkedin"></i> LinkedIn</label>

                                <input type="text" class="form-control" name="linkedin_link"
                                    value="{{ $settings['linkedin_link'] ?? '' }}">

                                @if($errors->has('linkedin_link'))
                                {{ $errors->first('linkedin_link') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><i class="fab fa-linkedin"></i> Fotter Text</label>

                                <textarea rows="4" cols="50" type="text" class="form-control"
                                    name="fotter_text">{{ $settings['fotter_text'] ?? '' }}</textarea>

                                @if($errors->has('fotter_text'))
                                {{ $errors->first('fotter_text') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><i class="fas fa-copyright"></i> CopyRight</label>

                                <input type="text" class="form-control" name="copy_right"
                                    value="{{ $settings['copy_right'] ?? '' }}">

                                @if($errors->has('copy_right'))
                                {{ $errors->first('copy_right') }}
                                @endif
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
<div class="row match-height">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Meta Information For How it Works Page</h4>

            </div>
            <div class="card-content">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Title</label>

                                <input type="text" class="form-control" name="how_it_works_meta_title"
                                    value="{{ $settings['how_it_works_meta_title'] ?? '' }}">
                                @if($errors->has('how_it_works_meta_title'))
                                {{ $errors->first('how_it_works_meta_title') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Keywords</label>

                                <input type="text" class="form-control" name="how_it_works_meta_keywords"
                                    value="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">

                                @if($errors->has('how_it_works_meta_keywords'))
                                {{ $errors->first('how_it_works_meta_keywords') }}
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Description</label>

                                <input type="text" class="form-control" name="how_it_works_meta_description"
                                    value="{{ $settings['how_it_works_meta_description'] ?? '' }}">

                                @if($errors->has('how_it_works_meta_description'))
                                {{ $errors->first('how_it_works_meta_description') }}
                                @endif
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Meta Information For Teach With Us Page</h4>

            </div>
            <div class="card-content">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Title</label>

                                <input type="text" class="form-control" name="teach_with_us_meta_title"
                                    value="{{ $settings['teach_with_us_meta_title'] ?? '' }}"
                                    value="{{ $settings['teach_with_us_meta_title'] ?? '' }}">
                                @if($errors->has('teach_with_us_meta_title'))
                                {{ $errors->first('teach_with_us_meta_title') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta KeyWords</label>

                                <input type="text" class="form-control" name="teach_with_us_meta_keywords"
                                    value="{{ $settings['teach_with_us_meta_keywords'] ?? '' }}">

                                @if($errors->has('teach_with_us_meta_keywords'))
                                {{ $errors->first('teach_with_us_meta_keywords') }}
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Description</label>

                                <input type="text" class="form-control" name="teach_with_us_meta_description"
                                    value="{{ $settings['teach_with_us_meta_description'] ?? '' }}">

                                @if($errors->has('teach_with_us_meta_description'))
                                {{ $errors->first('teach_with_us_meta_description') }}
                                @endif
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Meta Information For Blogs Page</h4>

            </div>
            <div class="card-content">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Title</label>

                                <input type="text" class="form-control" name="blog_meta_title"
                                    value="{{ $settings['blog_meta_title'] ?? '' }}">
                                @if($errors->has('blog_meta_title'))
                                {{ $errors->first('blog_meta_title') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Keywords</label>

                                <input type="text" class="form-control" name="blog_meta_keyword"
                                    value="{{ $settings['blog_meta_keyword'] ?? '' }}">

                                @if($errors->has('blog_meta_keyword'))
                                {{ $errors->first('blog_meta_keyword') }}
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Description</label>

                                <input type="text" class="form-control" name="blog_meta_description"
                                    value="{{ $settings['blog_meta_description'] ?? '' }}">

                                @if($errors->has('blog_meta_description'))
                                {{ $errors->first('blog_meta_description') }}
                                @endif
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Meta Information For Home Page</h4>

            </div>
            <div class="card-content">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Title</label>

                                <input type="text" class="form-control" name="home_meta_title"
                                    value="{{ $settings['home_meta_title'] ?? '' }}">
                                @if($errors->has('home_meta_title'))
                                {{ $errors->first('home_meta_title') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Keywords</label>

                                <input type="text" class="form-control" name="home_meta_keywords"
                                    value="{{ $settings['home_meta_keywords'] ?? '' }}">

                                @if($errors->has('home_meta_keywords'))
                                {{ $errors->first('home_meta_keywords') }}
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Description</label>

                                <input type="text" class="form-control" name="home_meta_description"
                                    value="{{ $settings['home_meta_description'] ?? '' }}">

                                @if($errors->has('home_meta_description'))
                                {{ $errors->first('home_meta_description') }}
                                @endif
                            </div>
                        </div>

                    </div>



                    </div>
                    <div class="clearfix"></div>

                </div>

            </div>

        </div>
        <div class="row card-body text-right mt-0 pt-0 pb-3">
            <div class="col-md-12">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary pull-left">Save</button>
                </div>
            </div>
        </div>

    </form>
    </div>


</div>
</section>
<!-- Dashboard Analytics end -->

</div>
@endsection
