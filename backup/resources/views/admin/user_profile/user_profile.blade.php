@extends('admin.layouts.app')
@section('title', 'User Profile')

<div class="row">
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
    <div class="content-body">
        <!-- Nav Filled Starts -->
        <section id="nav-filled">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h4 class="card-title">Profile</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="true">Update Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">Change Password</a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content pt-1">
                                    <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">


                                        <form class="form form-vertical" action="{{route('update_profile')}}" method="post">
                                            @csrf
                                            <div class="form-body">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Name</label>
                                                        <input type="text" id="first-name-vertical" value="{{$user->name}}" class="form-control" name="name" placeholder="Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-vertical">Email</label>
                                                        <input type="email" id="email-id-vertical" class="form-control" value="{{$user->email}}" name="email" placeholder="Email" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-vertical">Phone Number</label>
                                                        <input type="number" id="contact-info-vertical" class="form-control" value="{{$user->phone}}" name="phone" placeholder="Contact Number">
                                                    </div>
                                                </div>

                                                <div class="form-group col-12">

                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Cancel</button>
                                                </div>
                                            </div>

                                        </form>



                                    </div>
                                    <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
                                        <form class="form form-vertical" action="{{route('reset_password')}}" method="post">
                                            @csrf
                                            <div class="form-body">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Old Password</label>
                                                        <input type="password" id="first-name-vertical" class="form-control" name="oldpassword" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-vertical">New Password</label>
                                                        <input type="password" id="email-id-vertical" class="form-control" name="newpassword" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-vertical">Confirm Password</label>
                                                        <input type="password" id="contact-info-vertical" class="form-control" name="confirm_password"" placeholder="" required>
                                                    </div>
                                                </div>

                                                <div class=" form-group col-12">
                                                        {{-- <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember me</span>
                                                        </div>
                                                    </fieldset> --}}
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Cancel</button>
                                                    </div>
                                                </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Nav Filled Ends -->
    </div>



    @stop
