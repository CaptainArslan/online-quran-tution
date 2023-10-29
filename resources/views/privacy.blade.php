@extends('layouts.new-app')
@section('title', $settings['how_it_works_meta_title'] ?? '')
@section('meta')

<meta name="description" content="{{ $settings['how_it_works_meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">
@endsection
@section('css')
<style>
    .privacy-card p
    {
        text-align:justify;
    }
</style>
@endsection
@section('content')
<!-- content begin -->
<section class="bg-privacy-policy py-5" id="hero">
    <div class="container p-5">
        <div class="row">
            <div class="col-md-6 mt-5 mb-5 spacer">
                <h4 class="text-skin text-uppercase">ALHAMDULILLAH</h4>
                <h2 class="text-skin text-uppercase">
                    Privacy Policy
                </h2>
                <p class="text-skin">By using our site you accept these privacy policy.
                <p>
            
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row green-background p-3 d-flex align-items-center" style="margin-top: -50px;">
            <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                <h5 class="text-skin">Used by 500+ students</h5>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                <img alt="" src="{{asset('/public/dist/img/trustpilot.png')}}">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                <a href="{{ route('testimonials') }}"> <img alt=""
                        src="{{ asset('/public/dist/img/google.png') }}"> </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                <h5 class="text-skin">40+ Professional Tutors</h5>
            </div>


        </div>
    </div>
</section>
<section class="policy-terms">
    <div class="container my-5">
        <div class="row green-background borderRoundClass pt-4">
            <div class="col-lg-12 px-0 skin-background borderRoundClass">
                <h3 class="text-center text-green text-uppercase py-4"><u>Privacy Policy</u></h3>
                <div class="px-5">
                    <h3>1. Introduction</h3>
                <ul>
                    <li>We are committed to safeguarding the privacy of [our website visitors, service users, individual customers and customer personnel].</li>
                    <li>This policy applies where we are acting as a data controller with respect to the personal data of such persons; in other words, where we determine the purposes and means of the processing of that personal data.</li>
                    <li>Our website incorporates privacy controls which affect how we will process your personal data. By using the privacy controls, you can [specify 
                        whether you would like to receive direct marketing communications and limit the collection, sharing and publication of your personal data]. 
                        You can access the privacy controls via [URL].</li>
                    <li>We use cookies on our website. Insofar as those cookies are not strictly necessary for the provision of [our website and services], we will ask 
                        you to consent to our use of cookies when you first visit our website.</li>
                    <li>In this policy, "we", "us" and "our" refer to [data controller name].[ For more information about us, see Section 14.]</li>
                </ul>
                </div>
                <div class="green-background text-skin px-5 py-3">
                    <h3>2. Credit</h3>
                    <ul>
                        <li>This document was created using a template from Docular (https://seqlegal.com/free-legal-documents/privacy-policy). You must retain the 
                        above credit. Use of this document without the credit is an infringement of copyright. However, you can purchase from us an equivalent 
                        document that does not include the credit.</li>
                    </ul>
                </div>
                <div class="px-5 my-3">
                    <h3>3. The personal data that we collect</h3>
                    <ul>
                        <li>In this Section 3 we have set out the general categories of personal data that we process[ and, in the case of personal data that we did not 
                            obtain directly from you, information about the source and specific categories of that data].</li>
                        <li>We may process data enabling us to get in touch with you ("contact data").[ The contact data may include [your name, email address, telephone 
                            number, postal address and/or social media account identifiers].][ The source of the contact data is [you and/or your employer].][ If you log into 
                            our website using a social media account, we will obtain elements of the contact data from the relevant social media account provider.]</li>
                        <li>We may process data enabling us to get in touch with you ("contact data").[ The contact data may include [your name, email address, telephone 
                            number, postal address and/or social media account identifiers].][ The source of the contact data is [you and/or your employer].][ If you log into 
                            our website using a social media account, we will obtain elements of the contact data from the relevant social media account provider.]</li>
                        <li>We may process [information relating to transactions, including purchases of goods and/or services, that you enter into with us and/or through 
                            our website] ("transaction data").[ The transaction data may include [your name, your contact details, your payment card details (or other 
                            payment details) and the transaction details].][ The source of the transaction data is [you and/or our payment services provider].]</li>
                        <li>We may process [information contained in or relating to any communication that you send to us or that we send to you] ("communication data"). 
                            The communication data may include [the communication content and metadata associated with the communication].[ Our website will generate 
                            the metadata associated with communications made using the website contact forms.]</li>
                        <li>We may process [data about your use of our website and services] ("usage data"). The usage data may include [your IP address, geographical 
                            location, browser type and version, operating system, referral source, length of visit, page views and website navigation paths, as well as 
                            information about the timing, frequency and pattern of your service use]. The source of the usage data is [our analytics tracking system].</li>
                        <li>We may process [identify general category of data].[ This data may include [list specific items of data].][ The source of this data is 
                            [identify source].]</li>
                    </ul>
                </div>
                <a href="{{route('privacy.policy')}}" style="text-decoration: none"><p class="text-green text-center"><b>Read More</b></p></a>
            </div>
        </div>
    </div>
</section>
<!-- content close -->

@stop
@section("js")
<script>
    $(document).on('click','a', function(event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
            window.location.hash = hash;
          });
        }
    });
</script>
@endsection
