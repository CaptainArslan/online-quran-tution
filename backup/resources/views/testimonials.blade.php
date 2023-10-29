@extends('layouts.app')
@section('css')
    <style>
        /* .overlay-gradient {
            background-image: linear-gradient(to right, #fff, #fff);
             !important;
        }

        .slick-tutors .container-thumbnail {
            position: relative;
            width: 50%;
        }

        .slick-tutors .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .slick-tutors .middle {
            transition: .5s ease;
            opacity: 0.9;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .slick-tutors .container-thumbnail:hover .image {
            opacity: 0.3;
        }

        .slick-tutors .container-thumbnail:hover .middle {
            opacity: 1;
        }

        .slick-tutors .text {
            background-color: #3aafa9;
            color: white;
            font-size: 13px;
            padding: 12px 24px;
            cursor: pointer;
        } */

        .page-item.active .page-link{
        background-color: #3aafa9;
        border-color: #3aafa9;
    }

    .shadow{
      box-shadow: 0 0.5rem 1rem rgb(60 72 88 / 15%) !important;   
    }
    .a-hover{
        
        text-decoration: none !important;
        
    }
    .hover-effect:hover{
        -ms-transform: scale(1.03)!important; /* IE 9 */
        -webkit-transform: scale(1.03)!important; /* Safari 3-8 */
        transform: scale(1.03)!important;
        transition-duration: .5s;
    }
    .li-blogs{
        list-style:none;
        margin-bottom:25px;
       
    }
    
    .card-title{
        margin-bottom:0px;
    }
    @media(max-width:767px)
    {
        .blog-image{
        height:200px;
    }
        .dis-hide{
            display:none!important;
        }
        
    }
    @media(min-width:768px)
    {
        .blog-image{
        height:270px;
    }
        
        .li-right{
            margin-left: 61.01695%; 
            margin-top: -220px;
            width: 38%
        }
        .li-left{
            margin-right: 61.01695%;
            width: 38%
        }
    }

        /* Stars */
        .side {
            float: left;
            width: 15%;
            margin-top: 10px;
        }

        .middle {
            float: left;
            width: 70%;
            margin-top: 10px;
        }

        /* Place text to the right */
        .right {
            text-align: right;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* The bar container */
        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
        }
    </style>
@endsection
@section('content')
    <!-- content begin -->

    <section class="bg-testimonial py-5" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5 mb-5 spacer">
                    <h4 class="text-skin text-uppercase">Alhamdullilah</h4>
                    <h2 class="text-skin text-uppercase">
                        Every Review we’ve <br> ever received
                    </h2>
                    <p class="text-skin">197 reviews of parents and students like you
                    <p>

                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row green-background p-3 d-flex align-items-baseline" style="margin-top: -50px;">
                <div class="col-md-3">
                    <h5 class="text-skin">used by 500+ students</h5>
                </div>

                <div class="col-md-3">
                    <img alt="" src="{{ asset('/public/dist/img/trustpilot.png') }}">
                </div>


                <div class="col-md-3">
                    <img alt="" src="{{ asset('/public/dist/img/google.png') }}">
                </div>

                <div class="col-md-3">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>


            </div>
        </div>
    </section>
    <section id="section-features" class="mt-4">
        <div class="container w-100">
            <div class="dis-hide">
                <div class="row w-100">
                    {{-- <ul class="list-group-flush list-group w-100"> --}}
                        @foreach ($testimonials as $item)
                        <div class="col-lg-12">
                            <div
                                class="@if ($loop->iteration % 2 == 0) li-right @else li-left @endif shadow hover-effect li-blogs">
                                    <div class="card green-background text-skin a-hover">
                                        <div class="card-body p-4">
                                            <h3>{{ $item->name }}</h3>
                                            <p>
                                                {{ $item->review }}
                                            </p>

                                            <div class="clear-fix">
                                                <div class="float-left rating-stars">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if (floor($item->rating) - $i >= 1)
                                                            {{-- Full Star --}}
                                                            <i class="fa fa-star"></i>
                                                        @elseif ($item->rating - $i > 0)
                                                            {{-- Half Star --}}
                                                            <i class="fa fa-star-half-o"></i>
                                                        @else
                                                            {{-- Empty Star --}}
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <strong>{{ \Carbon\Carbon::parse($item->review_date)->format('M d, Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                    {{-- </ul> --}}
                </div>
            </div>
            {{-- <div class="row justify-content-center mt-3">
                {{ $testimonials->links() }}
             </div> --}}
        </div>
    </section>

    {{-- <section id="section-testimonial" class="no-top no-bottom text-light pt-0 mt-0 bg-white" data-bgimage="center"
        data-stellar-background-ratio=".1">
        <div class="overlay-gradient bg-white">
            <div class="text-center ">
                <h2 class="text-dark">{{ $settings['testimonial_heading'] ?? '' }}</h2>
                {{ $settings['testimonial_description'] ?? '' }}
                <div class="spacer-20"></div>
            </div>
            <div class="slick-tutors">
                @foreach ($videos as $video)
                    <div class="container-thumbnail p-2">
                        <img src="{{ asset($video->image) }}" class="image" style="width:100%; height:240px;">
                        <div class="middle">
                            <div class="text youtube-video" data-url="{{ $video->url }}"><i
                                    class="fas fa-play fa-3x"></i></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    <section id="booking-form" class="pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 green-background">
                    <div class="container">
                        <div class="row d-flex justify-content-center py-5">
                            <div class="col-sm-9 text-skin">
                                <h6>ALLHAMDULILLAH</h6>
                                <h1 class="bigger-text">
                                    Get 3 trial sessions before you book
                                </h1>
                                <p>
                                    Sign up today to our 3-day free Quran classes to ask questions and to find out about our
                                    teaching styles and methods for a unique learning experience!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('admin.partials.success_message')
                    <form id='contact_form' method="post" action="{{ route('enroll_submit') }}">
                        @csrf
                        <input type="hidden" name="student_time_difference" id="time_zone">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                        @endif
                        <div class="form-group">
                            <label>Enter Your Name</label>
                            <input type="text" class="form-control borderBottomClass" name='name' id='name'
                                placeholder="Your Name" required>
                            @if ($errors->has('name'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="text" class="form-control borderBottomClass" name='email' id='email'
                                placeholder="Your Email" required>
                            @error('email')
                                <span class="danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Enter Your Phone</label>
                            <input type="text" class="form-control borderBottomClass" name='phone' id='phone'
                                placeholder="Your Phone" required>
                            @error('phone')
                                <span class="danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @guest()
                            <div class="form-group">
                                <label>Enter Your Password</label>
                                <input type="password" minlength="8" name='password' id='password'
                                    class="form-control borderBottomClass" placeholder="Your Password" required>
                                @error('password')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name='password_confirmation' id='password' minlength="8"
                                    class="form-control borderBottomClass" placeholder="Confirm Password" required>
                                @error('password_confirmation')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endguest
                        <div class="form-group">
                            <input type="checkbox" id="exampleCheck1" value="1" name="terms_condition" required
                                data-parsley-required-message="Please confirm the field to agree with terms"
                                class="form-check-input">
                            <label for="exampleCheck1"><span></span> I have read and understand the <a
                                    href="{{ url('terms') }}" class="text-green"> Terms of use </a> & <a
                                    href="{{ url('privacy') }}" class="text-green">Privacy Policy</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn green-background text-skin float-end">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>


    <section id="rating-reviews">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-12 py-5">
                    <h4 class="text-skin text-center">Alhamdullilah</h4>
                    <h2 class="text-skin text-center">
                        Every Review we’ve ever received
                    </h2>
                    <div class="box-skin">
                        <div class="row">
                                <div class="col lg-6 col-md-6 col-sm-12">
                                    <div class="media-body m-auto">
                                        <div>
                                            <table class="w-100">
                                                <tr>
                                                    <td>5</td>
                                                    <td width="50%">
                                                        <span class="progress bar-container">
                                                            <span class="progress-bar" role="progressbar"
                                                                style="width: {{ count($testimonials) > 0 ? ($star5 / count($testimonials)) * 100 : '0' }}%;"
                                                                aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></span>
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($star5) ?? 0 }}</td>
                                                </tr>
    
                                                <tr>
                                                    <td>4</td>
                                                    <td width="50%">
                                                        <span class="progress">
                                                            <span class="progress-bar" role="progressbar"
                                                                style="width: {{ count($testimonials) > 0 ? ($star4 / count($testimonials)) * 100 : '0' }}%;"
                                                                aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></span>
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($star4) ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td width="50%">
                                                        <span class="progress">
                                                            <span class="progress-bar" role="progressbar"
                                                                style="width: {{ count($testimonials) > 0 ? ($star3 / count($testimonials)) * 100 : '0' }}%;"
                                                                aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></span>
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($star3) ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td width="50%">
                                                        <span class="progress">
                                                            <span class="progress-bar" role="progressbar"
                                                                style="width: {{ count($testimonials) > 0 ? ($star2 / count($testimonials)) * 100 : '0' }}%;"
                                                                aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></span>
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($star2) ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td width="50%">
                                                        <span class="progress">
                                                            <span class="progress-bar" role="progressbar"
                                                                style="width: {{ count($testimonials) > 0 ? ($star1 / count($testimonials)) * 100 : '0' }}%;"
                                                                aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></span>
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($star1) ?? 0 }}</td>
                                                </tr>
                                            </table>
    
                                        </div>
                                    </div>
                                </div>
                                <div class="col lg-6 col-md-6 col-sm-12">
                                    <div class="p-3 text-center m-auto">
                                        <h1 style="font-size: 5.5rem;">{{ round($avg, 2) ?? 0 }}</h1>
                                        <h4>out of 5 ({{ number_format(count($total_testimonials)) ?? 0 }})</h4>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-5 d-flex align-items-baseline">
                <div class="col-md-3">
                    <h5 class="text-skin">used by 500+ students</h5>
                </div>

                <div class="col-md-3">
                    <img alt="" src="{{ asset('/public/dist/img/trustpilot.png') }}">
                </div>


                <div class="col-md-3">
                    <img alt="" src="{{ asset('/public/dist/img/google.png') }}">
                </div>

                <div class="col-md-3">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>
            </div>
        </div>
    </section>

    <section id="video-reviews" class="py-5">
        <div class="container">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12">
                                <h5>ALHAMDULLILAH</h5>
                                <h3 class="text-green">
                                    What Our client’s Says Here are some glimpse!
                                </h3>
                                <p>
                                    "Online Quran tuition has been a fantastic experience for my child. The personalized
                                    attention and interactive sessions have helped them improve their recitation and
                                    understanding of the Quran. The tutor is knowledgeable, patient, and supportive. I
                                    highly recommend this service to anyone looking for quality Quran education online."
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-12" id="video-reviwes-column">
                                <video class="w-100" controls>
                                    <source src="mov_bbb.mp4" type="video/mp4">
                                    <source src="mov_bbb.ogg" type="video/ogg">
                                    Your browser does not support HTML video.
                                </video>
                                <div class="video-controls">
                                    <button class="btn btn-greenish py-4 px-5" id="play-pause-button">
                                        <i class="fas fa-play" id="play-icon"></i>
                                        <i class="fas fa-pause" id="pause-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="video" class="embed-responsive-item" width="560" height="315"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- section close -->
@section('js')

    <script>
        $(document).ready(function() {
            var d = new Date();
            var n = d.getTimezoneOffset();
            $('#time_zone').val(n);
        });
        $(document).on('click', '.js-videoPoster', function(e) {
            e.preventDefault();
            var poster = $(this);
            var wrapper = poster.closest('.js-videoWrapper');
            videoPlay(wrapper);
        });

        function videoPlay(wrapper) {
            var iframe = wrapper.find('.js-videoIframe');
            var src = iframe.data('src');

            wrapper.addClass('videoWrapperActive');
            iframe.attr('src', src);
        }
    </script>
    <script>
        $(document).ready(function() {

            $('.slick-tutors').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

        });
        $(document).ready(function() {
            $('.youtube-video').click(function() {
                console.log('stop here pop up');
                let src = $(this).data('url');
                $("#video").attr('src', src);
                $("#myModal").modal('show');
            });
        });
    </script>

    <script>
        function autoType(elementClass, typingSpeed) {
            var thhis = $(elementClass);
            thhis.css({
                "position": "relative",
                "display": "inline-block"
            });
            thhis.prepend('<div class="cursor" style="right: initial; left:0;"></div>');
            thhis = thhis.find(".text-js");
            var text = thhis.text().trim().split('');
            var amntOfChars = text.length;
            var newString = "";

            setTimeout(function() {
                thhis.text("");
                for (var i = 0; i < amntOfChars; i++) {
                    (function(i, char) {
                        setTimeout(function() {
                            newString += char;
                            thhis.text(newString);
                        }, i * typingSpeed);
                    })(i + 1, text[i]);
                }
            }, 500);
        }

        $(document).ready(function() {
            $(".blinked-circle").hide();
            autoType(".type-js", 70);
            $(".blinked-circle").delay(4300).fadeIn();
        });

        $(document).on('click', 'a', function(event) {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function() {
                    window.location.hash = hash;
                });
            }
        });
    </script>


@endsection
@stop
