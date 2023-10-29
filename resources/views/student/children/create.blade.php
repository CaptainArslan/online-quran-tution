@extends('student.layouts.app')
@section('content')
@section('topbar-heading', 'Children')
@if (session()->has('message'))
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

<div class="content-header row" style="padding-left: 15px;padding-right: 15px;">

    <section id="profile-info">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Nav Filled Starts -->
                        <section id="nav-filled">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card overflow-hidden">
                                        <div class="card-header">
                                            <h4 class="card-title">Add a child</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form class="form form-vertical"
                                                                action="{{ url('student/submit/children') }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <input type="hidden" name="id" value="{{$child->id ?? 0}}">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="first-name-vertical">Name</label>
                                                                                <input type="text"
                                                                                    id="first-name-vertical"
                                                                                    class="form-control" name="name"
                                                                                    placeholder="Name" value="{{$child->name ?? ""}}">
                                                                                @error('name')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="contact-info-vertical">Age</label>
                                                                                <input type="number"
                                                                                    id="contact-info-vertical"
                                                                                    class="form-control" name="age"
                                                                                    placeholder="Age" value="{{$child->age ?? ""}}">
                                                                                @error('age')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="contact-info-vertical">Father
                                                                                    Name</label>
                                                                                <input type="text"
                                                                                    id="contact-info-vertical"
                                                                                    class="form-control"
                                                                                    name="fatherName"
                                                                                    placeholder="Father Name"
                                                                                    value="{{$child->fatherName ?? ""}}">
                                                                                @error('fatherName')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="contact-info-vertical">Mother
                                                                                    Name</label>
                                                                                <input type="text"
                                                                                    id="contact-info-vertical"
                                                                                    class="form-control"
                                                                                    name="motherName"
                                                                                    placeholder="Mother Name(Optional for 16 or above)"
                                                                                    value="{{$child->motherName ?? ""}}">
                                                                                @error('motherName')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="btn-group">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </div>
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
                        </section>
                        <!-- Nav Filled Ends -->
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- END: Content-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                // Basic
                $('.dropify').dropify();

                // Translated
                $('.dropify-fr').dropify({
                    messages: {
                        default: 'Glissez-déposez un fichier ici ou cliquez',
                        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                        remove: 'Supprimer',
                        error: 'Désolé, le fichier trop volumineux'
                    }
                });

                // Used events
                var drEvent = $('#input-file-events').dropify();

                drEvent.on('dropify.beforeClear', function(event, element) {
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element) {
                    alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element) {
                    console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e) {
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
            function goPrev() {
                window.history.back();
            }
        </script>

    @stop
