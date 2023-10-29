@extends('layouts.app')
@section('title', $settings['home_meta_title'] ?? '')
@section('meta')
<meta name="description" content="{{ $settings['home_meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $settings['home_meta_keywords'] ?? '' }}">
@endsection
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

<section class="container-banner p-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 banner-left-heading m-auto">
                <span class="alhamdulillah-white">Alhamdulillah</span><br/>
                <div class="type-js headline">
                    <span class="text-js m-0">one 2 one online Quran tutoring that delivers results</span><i class="fa fa-circle blinked-circle"></i>
                </div>
                {{-- <h5>That Delivers Results <i class="fa fa-circle blinked-circle"></i></h5> --}}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset($settings['header_banner_image']) }});">

                </div>
            </div>
        </div>
    </section>
    <section class="section-reviews">
        <div class="container text-center">
            <div class="row mt-2">
                <div class="col-lg-4">
                    <h3>used by 500+ schools</h3>
                </div>
                <div class="col-lg-4">
                    <h3>179,466
                        <span class="header-rating-star">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </span>
                        reviews
                    </h3>
                </div>
                <div class="col-lg-4">
                    <h3>1m+ use our study notes</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="section-lesson pt-5 pb-5">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto lessons-left-heading">
                <span class="alhamdulillah-dark">Alhamdulillah</span>
                <h1>Quran lessons from<br> <span>£4 per hour</span></h1>
                <h5>Starting learning with professional and experienced online Quran teachers who are not only selected for their knowledge, but also for their skills to gain motivation and encouragement in students to increase the understanding of the Holy Quran.</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                <img src="{{ asset("images/second_banner.png") }}" class="img-fluid" alt="">
            </div>
        </div>
    </section>

    <section class="section-handpicked">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 p-5">
                <img src="{{ asset('images/pay.png') }}" class="img-fluid p-2" alt="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto handpicked-right-heading">
                <span class="alhamdulillah-white">Alhamdulillah</span>
                <h1><span>You’ll only pay</span> for what you use</h1>
                <h5>
                    with our rolling monthly program there are no contracts which allow you to pay as you learn and cancel at any time, offering flexibility and freedom to your learning.
                </h5>
            </div>
        </div>
    </section>

    <section class="section-lesson">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto lessons-left-heading">
                <span class="alhamdulillah-dark">Alhamdulillah</span>
                <h1><span>Any time</span> any where & on any any device</h1>
                <h5>for your convenience, you can now learn Quran online everywhere, at any time, on anydevice.
                    take your Quran class on pc, iphone or any other android device at your convenience.</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="{{ asset('images/one2one.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </section>



    <section class="section-fun-learning">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 p-5">
                <img src="{{ asset('images/expert.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto fun-learning-right-heading">
                <span class="alhamdulillah-white">Alhamdulillah</span>
                <h1><span>Expert teachers trained</span> to teach The Holy Quran with tajweed rules</h1>
                <h5>
                    Our male and female Quran teachers are well versed and well qualified we personally interview every tutor and only accept 1 in 8 applicants.
                </h5>
            </div>
        </div>
    </section>

    <section class="section-lesson">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto lessons-left-heading">
                <span class="alhamdulillah-dark">Alhamdulillah</span>
                <h1><span>Get 3 trial sessions</span> before you book</h1>
                <h5>sign up now for 3 days Quran classes to ask questions and to find out about our teaching styles and methods for a unique learning experience!</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                <img src="{{ asset("images/trial.png") }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="text-center pb-5">
            <a href="{{ route('enroll') }}" class="btn btn-site btn-lg">Send Inquiry</a>
        </div>
    </section>

    <section id="section-testimonial" class="no-top no-bottom text-light pt-0 mt-0" data-bgimage="center" data-stellar-background-ratio=".1">
        <div class="overlay-gradient">
            <div class="text-center wow fadeInUp">
                <h2>{{ $settings['testimonial_heading'] ?? '' }}</h2>
                {{-- {{ $settings['testimonial_description'] ?? '' }} --}}
                <div class="spacer-20"></div>
            </div>
            <div class="owl-carousel owl-theme wow fadeInUp" id="testimonial-carousel">
                <div class="item">
                    <div class="de_testi opt-2">
                        <blockquote class="p-0">
                            <iframe class="ifrmae-carousel" src="https://www.youtube.com/embed/BHACKCNDMW8" frameborder="0" allowfullscreen></iframe>
                            <div class="de_testi_by">
                                <img alt="" class="rounded-circle" src="{{asset('front_assets')}}/images/people/1.png"> <span>Aminata, Maman</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
                <div class="item">
                    <div class="de_testi opt-2">
                        <blockquote class="p-0">
                            <iframe class="ifrmae-carousel" src="https://www.youtube.com/embed/YTJg8q9Q940" frameborder="0" allowfullscreen></iframe>
                            <div class="de_testi_by">
                                <img alt="" class="rounded-circle" src="{{asset('front_assets')}}/images/people/1.png"> <span>Aminata, Maman</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="talk-whatsapp-section" style="display:table; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.5)), url({{ asset('images/quran-flower.jpg') }});">
        <div class="container whatsapp-section-text text-center" style="background: none !important;">
            <h1>Talk to us via whatsapp and get your Quran tutor sorted today</h1>
            <a href="{{route('schools')}}" class="btn btn-primary btn-lg">online Quran memorization course</a>
            <a href="" class="btn btn-success btn-lg"><i class="fa fa-whatsapp"></i>whatsapp</a>
        </div>
    </section>


</div>
<!-- content close -->

@section('js')
<script type="text/javascript">
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
function autoType(elementClass, typingSpeed){
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

  setTimeout(function(){
    thhis.text("");
    for(var i = 0; i < amntOfChars; i++){
      (function(i,char){
        setTimeout(function() {
          newString += char;
          thhis.text(newString);
        },i*typingSpeed);
      })(i+1,text[i]);
    }
  },500);
}

$(document).ready(function(){
    $( ".blinked-circle" ).hide();
  autoType(".type-js",70);
  $( ".blinked-circle" ).delay( 4300 ).fadeIn();
});

</script>
@endsection
@stop
