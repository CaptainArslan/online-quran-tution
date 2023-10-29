@extends('layouts.new-app')
@section('title', $settings['how_it_works_meta_title'] ?? '')
@section('meta')

<meta name="description" content="{{ $settings['how_it_works_meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">
@endsection
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section class="pages-banner-heading" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset($settings['header_banner_image']) }});">
        <div class="container">
            <div class="row">
                <div class="col-12 banner-left-heading m-auto">
                    <h1 class="text-white">How our <span>System Works</span></h1>
                    <h5 class="text-white">Just focus on the best and reasonable pricing</h5>
                </div>
            </div>
        </div>
    </section>

    <section class="p-0">
        <div class="container">
            <div class="card mt-4 mb-4 schools-card">
                <div class="card-header p-0 text-center schoools-card-heading">
                    <h2 class="pt-1 m-0">The problem with tuition</h2>
                </div>
                <div class="card-body">
                    <p>One-to-one tuition is proven to be one of the best ways to improve grades. And grades are directly linked to life chances and career progression. But until now, tuition has been out of reach for most families – it was too expensive, availability was low, or it relied on living near a good tutor.                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="p-0">
        <div class="container">
            <div class="card mt-2 mb-4 schools-card">
                <div class="card-header p-0 text-center schoools-card-heading">
                    <h2 class="pt-1 m-0">How we’re solving it</h2>
                </div>
                <div class="card-body">
                    <p>How we’re solving it
                        MyTutor was founded to offer life-changing tuition for all, and this mission makes us excited to get up and come to work every day.</p>
                        <p>We’re proud that our online network of great tutors supports pupils from all walks of life. lessons are tailored to each individual and fit the hectic schedule of any family. We’ve given over a quarter of a million lessons and results show that our pupils improve by an average of one whole grade in just 12 lessons.                        </p>
                </div>
            </div>
        </div>
    </section>
    <section id="section-faq">
        <div class="container">
            <div class="row">
                <div class="col text-center ">
                    <h2><span class="uptitle id-color">Do You Have</span>Any Questions?</h2>
                    <div class="spacer-20"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="accordion">
                        <div class="accordion-section">
                            @foreach($faqs ?? '' as $faq)
                            <div class="accordion-section-title" data-tab="#accordion-{{ $loop->iteration }}">
                                {{ $faq->question }}
                            </div>
                            <div class="accordion-section-content" id="accordion-{{ $loop->iteration }}">
                                <p>{{ $faq->answer }}</p>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- content close -->

@stop
