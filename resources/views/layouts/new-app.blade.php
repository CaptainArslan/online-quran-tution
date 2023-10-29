<!DOCTYPE html>
<html lang="en">

<head>
    
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5HCRSZC');</script>
    <!-- End Google Tag Manager -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Online Quran Tuition",
        "url": "https://www.onlinequrantuition.co.uk",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "ratingCount": "397"
        }
    }
    </script>
    
    
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5HCRSZC" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>


    <meta charset="UTF-8">
    <title>Online Quran Lessons From £4 Per Hour | Highly Qualified Quran Tutors</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @yield('meta')
    <link href="{{ asset('/public/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/dist/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    @yield('css')
    
    <style>
        
        .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
        
    </style>
</head>

<body>

    <div id="wrapper">
        @include('_partials.new-topbar')
        @yield('content')
    </div>
    
    <a href="https://wa.me/+447493320143" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>

    <section id="talk-to-us" class="pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <h2 class="text-white">Talk to us via whatsapp and get enrolled today</h2>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 d-flex justify-content-end">
                    <button class="btn skin-background text-green btn-footer"
                        style="box-shadow: 0 5px 23px rgba(0, 0, 0, 0.4);">
                        <a href="https://wa.me/+447493320143"><i class="fab fa-whatsapp"></i> Call Us Now</a>
                    </button>

                </div>
            </div>
            <div class="row mt-5 d-flex align-items-center">
                <div
                    class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center align-items-center">
                    <h5 class="text-skin">Used by 500+ students</h5>
                </div>

                <div
                    class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center align-items-start">
                    <img alt="" src="{{ asset('/public/dist/img/trustpilot.png') }}">
                </div>


                <div
                    class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-4 d-flex justify-content-center align-items-center">
                    <a href="{{ route('testimonials') }}"> <img alt=""
                            src="{{ asset('/public/dist/img/Google_Reviews.png') }}"> </a>
                </div>

                <div
                    class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center align-items-center">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-5 pt-5 skin-background ">
        <footer class="footer-container">
            <div class="container">
                <div class="container text-green ">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="widget pb-0">
                                <a class="text-center" href="{{ route('index') }}">
                                    <img alt="Footer Logo" style="max-width: 79%; !important; width:80% !important;"
                                        src="{{ asset('/public/dist/img/FooterLogo.png') }}">
                                </a>
                                <p class="mt-3 ">{{ $settings['fotter_text'] ?? '' }}
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="widget pb-0">
                                <h5>Company Information</h5>
                                <ul class="list-unstyled">
                                    <li><a class="text-decoration-none" href="{{ route('privacy') }}">Privacy</a></li>
                                    <li><a class="text-decoration-none" href="{{ route('blogs') }}">Blogs</a></li>
                                    <li><a class="text-decoration-none" href="{{ route('terms') }}">Terms &amp;
                                            Laws</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="widget pb-0">
                                <h5>Popular Searches</h5>
                                <ul class="list-unstyled">
                                    <li><a class="text-decoration-none" href="{{ route('forkids') }}">Quran For
                                            Kids</a>
                                    </li>
                                    <li><a class="text-decoration-none" href="{{ route('madrasauk') }}">Best
                                            Madrassah</a></li>
                                    <li><a class="text-decoration-none" href="{{ route('islamiclessons') }}">Online
                                            Islamic School</a></li>
                                    <li><a class="text-decoration-none" href="{{ route('skypeclass') }}">Quran Majeed
                                            via Skype</a></li>
                                    <li><a class="text-decoration-none" href="{{ route('tajweedclasses') }}">Online
                                            Tajweed Near Me</a></li>
                                    <li><a class="text-decoration-none" href="{{ route('hifzquran') }}">Hifz Quran Near
                                            Me</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="widget pb-0">
                                <h5>Contact</h5>
                                <ul class="list-unstyled">
                                    <li>Email:<a class="text-decoration-none"
                                            href="mailto:{{ $settings['email_address'] ?? '' }}">{{ $settings['email_address'] ?? '' }}</a>
                                    </li>
                                    <li>Phone:<a class="text-decoration-none"
                                            href="tel:{{ $settings['phone_number'] ?? '' }}">{{ $settings['phone_number'] ?? '' }}</a>
                                    </li>
                                    <li>Address:<a class="text-decoration-none" target="_blank"
                                            href="https://maps.google.com/?q={{ $settings['site_address'] ?? '' }}">{{ $settings['site_address'] ?? '' }}</a>
                                    </li>
                                </ul>
                                <div class="spacer-20"></div>
                                <div class="d-flex gap-3 list-unstyled"
                                    style="background-size: cover ; border-radius: 50px !important;">
                                    <a class="rounded-circle" href="{{ $settings['facebook_link'] ?? '' }}"><i
                                            class="fab fa-facebook fa-lg text-green"></i></a>
                                    <a class="rounded-circle" href="{{ $settings['twitter_link'] ?? '' }}"><i
                                            class="fab fa-twitter fa-lg text-green"></i></a>
                                    <a class="rounded-circle" href="{{ $settings['linkedin_link'] ?? '' }}"><i
                                            class="fab fa-linkedin fa-lg text-green"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </footer>
    </section>
    <script src="{{ asset('/public/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/front/js/site.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-837030541"></script>
    <noscript>
        <img height="1" width="1"
            src="https://www.facebook.com/tr?id=270727523582758&ev=PageView
    &noscript=1" />
    </noscript>
</body>
</html>
