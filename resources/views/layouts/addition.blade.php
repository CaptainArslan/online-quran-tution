<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @yield('description')
    @yield('schema')
    @yield('schemafaq')
    
    <link rel="icon" type="image/png" href="{{ asset($settings['fav_icon']) ?? '' }}">
    @yield('meta')
    <meta content="" name="author">
    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
    <link href="{{asset('dist/front/css/site.css')}}" rel="stylesheet">
    <link href="{{asset('dist/front/css/custom.css')}}" rel="stylesheet">
    @yield('css')
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5HCRSZC" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
</head>

<body>

    <div id="wrapper">
        @include('_partials.topbar')
        @yield('content')
    </div>
    <!-- footer begin -->
    <footer class="pt-5 pb-0">
        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <div class="widget pb-0">

                        <a href="{{ route('index') }}">
                            <img alt="" class="img-fluid" width="180" src="{{asset('/images/logo-white.png')}}">
                        </a>
                        <p class="mt-3">{{ $settings['fotter_text'] ?? '' }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-xs-4">
                    <div class="widget pb-0">
                        <h5>Company Information</h5>
                        <ul>
                            <li><a href="{{route('privacy')}}">Privacy</a></li>
                            <li><a href="{{route('blogs')}}">Blogs</a></li>
                            <li><a href="{{route('terms')}}">Terms & Laws</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-4">
                    <div class="widget pb-0">
                        <h5>Popular Searches</h5>
                        <ul>
                            <li><a href="{{ route('forkids') }}">Quran For Kids</a></li>
                            <li><a href="{{ route('madrasauk') }}">Online Madrasa UK</a></li>
                            <li><a href="{{ route('islamiclessons') }}">Islamic Lessons For Kids</a></li>
                            <li><a href="{{ route('skypeclass') }}">Skype Quran Classes</a></li>
                            <li><a href="{{ route('tajweedclasses') }}">Tajweed Classes</a></li>
                            <li><a href="{{ route('hifzquran') }}">Quran Hifz Program</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-4">
                    <div class="widget pb-0">
                        <h5>Contact</h5>
                        <ul>
                            <li>Email:<a href="mailto:{{ $settings['email_address'] ?? '' }}"> {{ $settings['email_address'] ?? '' }}</a></li>
                            <li>Phone:<a href="tel:{{ $settings['phone_number'] ?? '' }}"> {{ $settings['phone_number'] ?? '' }}</a></li>
                            <li>Address:<a target="_blank" href="https://maps.google.com/?q={{ $settings['site_address'] ?? '' }}"> {{ $settings['site_address'] ?? '' }}</a></li>
                        </ul>
                        <div class="spacer-20"></div>
                        <div class="social-icons">
                            <a href="{{ $settings['facebook_link'] ?? '' }}"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="{{ $settings['twitter_link'] ?? '' }}"><i class="fab fa-twitter fa-lg"></i></a>
                            <a href="{{ $settings['linkedin_link'] ?? '' }}"><i class="fab fa-linkedin fa-lg"></i></a>
                            <a href="https://wa.me/{{ $settings['whatsapp_link'] ?? '' }}"><i class="fab fa-whatsapp fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="text-center p-1">
                <div>&copy; {{ $settings['copy_right'] ?? '' }}</div>
            </div>
        </div>
    </footer>
    <!-- footer close -->
    <div id="preloader">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- JS Libraries -->

    <script src="{{asset('dist/front/js/site.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <script>
        function printValidationMessages (errorObj)
        {
        	$.map(errorObj, function(value, index) {
        	    console.log(value);
        	    console.log(index);
                $(document).find('[name="' + index + '"]').closest('div').find('div.alert').remove();
                var appendIn = $(document).find('[name="' + index + '"]').closest('div');
                if (!appendIn.length) {
                    $(appendIn).append('<div class="alert alert-danger" style="padding: 1px 5px;font-size: 12px"><i class="fab fa-warning" style="color:red;font-size: 12px"></i> ' + value[0] + '</div>')
                } else {
                    if (!$(appendIn).find('div.alert').length) {
                        if ($(appendIn).hasClass('dropify-wrapper'))
                            appendIn = $(appendIn).closest('div');
                            $(appendIn).append('<div class="alert alert-danger" style="padding: 1px 5px;font-size: 12px"><i class="fab fa-warning" style="color:red;font-size: 12px"></i> ' + value[0] + '</div>')
                    }
                }
            });
        }

        $(document).on('submit', 'form#contact_form', function(e) {

            if(grecaptcha.getResponse() == "") {
                e.preventDefault();
                alert("You can't proceed! Pass the captcha first.");
                return false;
              }
              else
              {
                e.preventDefault();
                var form = $(this);
            var data = new FormData(this);
            $("#contact_form button").text("Submitting...");
            $('.loading-image').removeClass('d-none');
            $("#contact_form button").prop("disabled", true);
            $.ajax({
                type: 'POST',
                data: data,
                cache: !1,
                contentType: !1,
                processData: !1,
                url: $(form).attr('action'),
                async: true,
                headers: {
                  "cache-control": "no-cache"
                },
                success: function(response) {
                    console.log(response);
                    // location.href = "{{ route('student.gocardless.info') }}/"+response.inquiry_id;
                    location.href = "{{ route('student.thank.you') }}";
                },
                error: function(xhr, status, error) {
                    $("#contact_form button").text("Start Free Trial").prop("disabled", false);
                    grecaptcha.reset();
                    $('.loading-image').addClass('d-none');
                    if (xhr.status == 422) {
                        var errorObj = xhr.responseJSON.errors;
                        printValidationMessages(errorObj); //IT WILL USE THE SAME FUNCTION DEFINED IN POINT 4
                    }
                    else
                    {
                        toastr.error('Unknown Error!')
                    }
                }
            });

              }




        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name="intervaltype"]').click(function() {
                $(this).tab('show');
                $(this).removeClass('active');
            });
        })
    </script>
    @yield('js')
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-837030541"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-837030541');
    </script>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5HCRSZC');
</script>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '270727523582758');
    fbq('track', 'PageView');
    </script>

    <noscript>
     <img height="1" width="1"
    src="https://www.facebook.com/tr?id=270727523582758&ev=PageView
    &noscript=1"/>
    </noscript>

</body>

</html>