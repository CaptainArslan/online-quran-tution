@extends('layouts.app')
@section('title', $settings['teach_with_us_meta_title'] ?? '')
@section('meta')

<meta name="description" content="{{ $settings['teach_with_us_meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $settings['teach_with_us_meta_keywords'] ?? '' }}">
@endsection
@section('content')

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- revolution slider begin -->
    <!-- section begin -->
  
    <section class="mb-0 pb-0 pages-heading">
        <div class="container">
            <h1>For Registration</h1>
            <p class="lead">Register Yourself Now!</p>
    </div>
    </section>
    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">

        <div class="mt30">
            <div class="center-y">
                <div class="container">

                    <form name="contactForm" id='contact_form' class="" class="form" action="{{url('add_teacher')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                @include('admin.partials.success_message')
                                <div class="row">
                                    <div class="field-set col-md-6 ">
                                        <label>Upload Your File</label>
                                        <input type="file" id="input-file-now" name="image" class="dropify form-control" />
                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="field-set col-md-6 ">

                                    </div>
                                </div>
                                <div class="spacer-half"></div>
                                <div class="row">
                                    <div class="field-set col-md-6">
                                        <label>Enter Name</label>
                                        <input type='text' name='name' id='name' class="form-control" placeholder="Your Name">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field-set col-md-6">
                                        <label>Enter Email</label>
                                        <input type='text' name='email' id='email' class="form-control" placeholder="Your Email">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field-set col-md-6">
                                        <label>Enter Phone Number</label>
                                        <input type='text' name='phone' id='phone' class="form-control" placeholder="Your Phone" rows="2">
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field-set col-md-6">
                                        <label>Enter Password</label>
                                        <input type='text' name='password' id='phone' class="form-control" placeholder="Your Password" rows="2">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field-set col-md-12">
                                        <label>Your Address</label>
                                        <input type='text' name='address' id='address' class="form-control" placeholder="Your Address" rows="2">
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field-set col-md-12">
                                        <label>Biography</label>
                                        <textarea name='biography' id='message' class="form-control" placeholder="Your Biography"></textarea>
                                        @error('biography')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="hidden" value="0" name="id">
                                    <div class="field-set col-md-12 ">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" required>
                                            <label class="custom-control-label" for="customCheck">You must agree to the <a href="#">terms and conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="spacer-half"></div>
                                    <div id='submit' class="col-md-12">
                                        <button type="submit" class="btn btn-site">Submit Form</button>
                    </form>
                </div>
                <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                <div class="spacer-half"></div>


            </div>

        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="pricing-s1 mb30 right-reg">
                <div class="top">
                    <h1 class="text-white">Bring Ups!</h1>
                    <p class="price">
                        <span class="">We Done here and knew we'll make through this soon </span>

                    </p>
                </div>

                <div class="bottom">

                    <ul>
                        <li><i class="fa fa-check-square"></i>Number 1 Tuutors</li>
                        <li><i class="fa fa-check-square"></i>99.9% Uptime Guarantee</li>
                        <li><i class="fa fa-check-square"></i>Monthly Packages</li>
                        <li><i class="fa fa-check-square"></i>Yearly Packages</li>
                        <li><i class="fa fa-check-square"></i>Latest Subjects</li>
                        <li><i class="fa fa-check-square"></i>Latest Technologies</li>
                        <li><i class="fa fa-check-square"></i>Rresearch Bases</li>
                        <li><i class="fa fa-check-square"></i>99.9% Practicals</li>
                    </ul>
                </div>

            </div>
        </div>
        <!--<div class="col-lg-6 right-reg text-sm-left ">
                                <div class="right-reg-text ">
                                    <h1 class="id-color">
                                    Register Now
                                    </h1>
                                    
                                   
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut  sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut </p>
                                    <div class="pricing-s1">
                                         <div class="bottom">

                                            <ul>
                                                <li><i class="fa fa-check-square"></i>1x Processing Power</li>
                                                <li><i class="fa fa-check-square"></i>1 Website</li>
                                                <li><i class="fa fa-check-square"></i>1GB Disk Space</li>
                                                <li><i class="fa fa-check-square"></i>Easy Website Builder</li>
                                                <li><i class="fa fa-check-square"></i>99.9% Uptime Guarantee</li>
                                            </ul>
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                              
                       </div>-->

        <div class="spacer-half"></div>
        <div class="spacer-half"></div>
        </form>

</div>

</div>
</div>

</section>
<!-- section close -->

</div>
<!-- content close -->

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

@stop