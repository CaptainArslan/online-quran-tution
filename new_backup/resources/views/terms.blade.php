@extends('layouts.new-app')
@section('title', $settings['how_it_works_meta_title'] ?? '')
@section('meta')

    <meta name="description" content="{{ $settings['how_it_works_meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">
@endsection
@section('content')
    <section class="bg-law-terms py-5" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5 mb-5 spacer">
                    <h4 class="text-skin text-uppercase">ALHAMDULILLAH</h4>
                    <h2 class="text-skin text-uppercase">
                        Terms & Laws
                    </h2>
                    <p class="text-skin">By using our site you accept these terms and conditions.
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
                    <h5 class="text-skin">used by 500+ students</h5>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                    <img alt="" src="{{ asset('/public/dist/img/trustpilot.png') }}">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 my-lg-0 my-md-3 my-3 d-flex justify-content-center">
                    <a href="{{ route('testimonials') }}"> <img alt=""
                            src="{{ asset('/public/dist/img/Google_Reviews.png') }}"> </a>
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
                    <h3 class="text-center text-green text-uppercase py-4"><u>License Free Terms & Conditions</u></h3>
                    <div class="px-5">
                        <h3>You must attribute the image to its author:</h3>
                        <ul>
                            <li>In order to use a content or a part of it, you must attribute it to slidesgo / Freepik, so
                                we will be able to continue creating new graphic
                                resources every day.</li>
                        </ul>
                    </div>
                    <div class="green-background text-skin px-5 py-3">
                        <h3>How to attribute it?</h3>
                        <ul>
                            <li>For websites: Please, copy this code on your website to accredit the author: Designed by
                                slidesgo / Freepik</li>
                            <li>For printing: Paste this text on the final work so the authorship is known. - For example,
                                in the acknowledgements chapter of a book:
                                "Designed by slidesgo / Freepik"</li>
                        </ul>
                    </div>
                    <div class="px-5 my-3">
                        <h3>You are free to use this image:</h3>
                        <ul>
                            <li>- For both personal and commercial projects and to modify it.</li>
                            <li>- In a website or presentation template or application or as part of your design.</li>
                        </ul>
                    </div>
                    <div class="green-background text-skin px-5 py-3">
                        <h3>You are not allowed to:</h3>
                        <ul>
                            <li>- Sub-license, resell or rent it.</li>
                            <li>- Include it in any online or offline archive or database.</li>
                        </ul>
                    </div>
                    <div class="px-5 my-3">
                        <h3>The full terms of the license are described in section 7 of the Freepik terms of use, available
                            online in the following link:</h3>
                        <ul>
                            <li>http://www.freepik.com/terms_of_use</li>
                            <li>The terms described in the above link have precedence over the terms described in the
                                present document. In case of disagreement,
                                the Freepik Terms of Use will prevail.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row green-background borderRoundClass mt-5 pt-4">
                <div class="col-lg-12 px-0 pb-5 skin-background borderRoundClass">
                    <h3 class="text-center text-green text-uppercase py-4"><u>Premium Member Terms & Conditions</u></h3>
                    <div class="px-5">
                        <h3>You can download from your profile in Freepik a personalized license stating your right to
                            use this content as a "premium" user:</h3>
                        <ul>
                            <li>https://profile.freepik.com/my_downloads</li>
                        </ul>
                    </div>
                    <div class="green-background text-skin px-5 py-3">
                        <h3>You are free to use this image:</h3>
                        <ul>
                            <li>For both personal and commercial projects and to modify it.</li>
                            <li>In a website or presentation template or application or as part of your design</li>
                        </ul>
                    </div>
                    <div class="px-5 my-3">
                        <h3>You are not allowed to:</h3>
                        <ul>
                            <li>Sub-license, resell or rent it.</li>
                            <li>Include it in any online or offline archive or database.</li>
                        </ul>
                    </div>
                    <div class="green-background text-skin px-5 py-3 mb-3">
                        <h3>The full terms of the license are described in sections 7 and 8 of the Freepik terms of use,
                            available online in the following link:</h3>
                        <ul>
                            <li>http://www.freepik.com/terms_of_use</li>
                            <li>The terms described in the above link have precedence over the terms described in the
                                present document. In case of disagreement</li>
                            <li>the Freepik Terms of Use will prevail.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
