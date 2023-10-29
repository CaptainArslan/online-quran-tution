@extends('admin.layouts.app')
@section('title', 'Setting')

@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-success">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts" style="margin-left:200px">

    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Settings</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{url('admin/add_setting')}}" enctype="multipart/formdata" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Site Name</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="first-name" class="form-control" name="site_name" value="{{$site_name ?? ''}}" placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>Site Logo</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="file" id="email-id" class="form-control" name="site_logo" value="{{$site_logo ?? ''}}" placeholder="Email">
                            </div>
                        </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>Site Favicon</span>
                        </div>
                        <div class="col-md-8">
                            <input type="file" id="contact-info" class="form-control" name="site_favicon" value="{{$favicon ?? ''}}" placeholder="Mobile">
                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>Contact Email</span>
                        </div>
                        <div class="col-md-8">
                            <input type="email" id="password" class="form-control" name="contact_email" value="{{$contact ?? ''}}" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>Fcaebook Link</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="password" class="form-control" name="facebook_link" value="{{$facebook ?? ''}}" placeholder="Facebook">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>Twitter Link</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="password" class="form-control" name="twitter_link" value="{{$twitter ?? ''}}" placeholder="Twitter Link">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>Instagram Link</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="password" class="form-control" name="instagram_link" placeholder="Instagram" value="{{$instagram_link ?? ''}}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>Contact Phone</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="password" class="form-control" name="contact_phone" placeholder="Contact Phone" value="{{$phone ?? ''}}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>SEO Meta Data For Home Page</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="password" class="form-control" name="seo_meta_data" placeholder="SEO meta data for home page" value="{{$seo_meta ?? ''}}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>Meta Description</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="password" class="form-control" name="meta_description" placeholder="Meta Description" value="{{$meta_description ?? ''}}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span>Comission Rate</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="password" class="form-control" name="comission_rate" placeholder="Comission Rate" value="{{$comission_rate ?? ''}}">
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group col-md-8 offset-md-4">
                                        <fieldset class="checkbox">
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox">
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-check"></i>
                                                    </span>
                                                </span>
                                                <span class="">Remember me</span>
                                            </div>
                                        </fieldset>
                                    </div> --}}
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Cancel</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>


</section>
<!-- // Basic Horizontal form layout section end -->
@stop