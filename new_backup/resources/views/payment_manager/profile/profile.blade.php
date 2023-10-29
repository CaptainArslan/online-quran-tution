@extends('payment_manager.layouts.app')
@section('content')
@section('topbar-heading', 'My Profile')
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
<!-- BEGIN: Content-->

        <div class="content-header row">

                <section id="profile-info">
                    <div class="row" style="padding-left:15px;padding-right:15px;">
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4></h4>

                                </div>
                                <div class="card-body">
                                     <form action="{{route('payment_manager.change.picture')}}" method="post" enctype="multipart/form-data" class="text-center">
                                        @csrf
                                     <input type="file"  id="input-file-now" name="image" class="dropify form-control" required data-default-file="{{asset($user->avatar ?? '')}}"/>
                                     <button type="submit" class="btn btn-success mt-2">Update Pic</button>
                                     </form>

                                </div>

                            </div>


                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Nav Filled Starts -->
                                    <section id="nav-filled">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card overflow-hidden">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Update Profile</h4>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body">

                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="true">Profile</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">Change Password</a>
                                                                </li>

                                                            </ul>

                                                            <!-- Tab panes -->
                                                            <div class="tab-content pt-1">
                                                                <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">

                                                                        <div class="card">
                                                                            <div class="card-header">

                                                                            </div>
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <form class="form form-vertical" action="{{route('payment_manager.profile.edit')}}" method="post">
                                                                                        @csrf
                                                                                        <div class="form-body">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="first-name-vertical">Name</label>
                                                                                                        <input type="text" id="first-name-vertical" class="form-control" name="name" placeholder="Name" value="{{$user->name ?? ''}}" >
                                                                                                        @error('name')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                       @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="email-id-vertical">Email</label>
                                                                                                        <input type="email" id="email-id-vertical" class="form-control" name="email" placeholder="Email" value="{{$user->email ?? ''}}">
                                                                                                        @error('email')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                       @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="contact-info-vertical">Phone</label>
                                                                                                        <input type="text" id="contact-info-vertical" class="form-control" name="phone" placeholder="Phone" value="{{$user->phone ?? ''}}">
                                                                                                        @error('phone')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                       @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="password-vertical">Address</label>

                                                                                                        <input type="address" id="password-vertical" class="form-control" name="address" placeholder="Address" value="{{$user->payment_manager->address ?? ''}}">
                                                                                                        @error('address')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                       @enderror
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="form-group col-12">

                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button>
                                                                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1" onclick="goPrev()">Cancel</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                </div>
                                                                <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            {{-- <h4 class="card-title"></h4> --}}
                                                                        </div>
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <form class="form form-vertical" method="post" action = "{{route('payment_manager.password.reset')}}" >
                                                                                    @csrf
                                                                                    <div class="form-body">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="old_pass">Old Password</label>
                                                                                                    <input type="text" id="old_pass" class="form-control" name="oldpassword" placeholder="Old Password" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="email-id-vertical">New Password</label>
                                                                                                    <input type="text" id="email-id-vertical" class="form-control" name="newpassword" placeholder="New Password" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="contact-info-vertical">Confirm New Password</label>
                                                                                                    <input type="text" id="contact-info-vertical" class="form-control" name="confirm_password" placeholder="Confirm New Password" required>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="form-group col-12">

                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button>
                                                                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1" onclick="goPrev()">Cancel</button>
                                                                                            </div>
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
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                <!-- Nav Filled Ends -->
                                </div>
                            </div>
                        </div>





        </div>

<!-- END: Content-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                // Basic
                $('.dropify').dropify();

                // Translated
                $('.dropify-fr').dropify({
                    messages: {
                        default: 'Glissez-déposez un fichier ici ou cliquez',
                        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                        remove:  'Supprimer',
                        error:   'Désolé, le fichier trop volumineux'
                    }
                });

                // Used events
                var drEvent = $('#input-file-events').dropify();

                drEvent.on('dropify.beforeClear', function(event, element){
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element){
                    alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element){
                    console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e){
                    e.preventDefault();
                    if (drDestroy.isDropified()) {
                        drDestroy.destroy();
                    } else {
                        drDestroy.init();
                    }
                })
            });
        </script>
<script>
    function goPrev()
    {
      window.history.back();
    }
  </script>

  @endsection
