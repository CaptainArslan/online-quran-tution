@extends('layouts.new-app')
@section('title', $blog->meta_title ?? '')
@section('meta')
    <meta name="title" content="{{ $blog->meta_title ?? '' }}">
    <meta name="description" content="{{ $blog->meta_keywords ?? '' }}">
    <meta name="keywords" content="{{ $blog->meta_description ?? '' }}">
@endsection
@section('css')
    <style>
        .shadow {
            box-shadow: 0 0.3rem .7rem rgb(60 72 88 / 15%) !important;
        }
    </style>
@endsection
@section('content')
    <!-- content begin -->
    <section class="bg-blog py-5" id="hero">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mt-5 mb-5 spacer">
                    <h2 class="text-skin text-uppercase">
                        Our Blogs
                    </h2>
                    <p class="text-skin">A Regularly Updated Selection Of Blogs <br>
                        Articles To Suppourt Your Teaching.
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
    <section aria-label="section">
        <div class="container my-5">
            <div class="row">

                <div class="col-md-8">
                    {{--   <h3 class="mb-3" style="font-weight:500;font-size:28px;">{{ $blog->title }}</h3>  --}}
                    <div class="card shadow">
                        <div class="card=title mb-0">
                            <img src="{{ asset($blog->image) }}" width="100%" alt="">
                        </div>
                        <div class="card-body green-background text-skin">
                            <div class="blog-read">
                                <div class="post-text">
                                    <p>{!! $blog->description !!}</p>
                                </div>

                            </div>
                            <div class="spacer-single"></div>
                        </div>
                    </div>
                </div>

                <div id="sidebar" class="col-md-4">
                    <div class="widget widget-post pt-2">
                        <h4>Recent Posts</h4>

                        <ul class="list-group list-group-flush shadow">
                            @foreach ($recent_blogs as $bl)
                                <li class="list-group-item mb-0">
                                    <!--    <span class="date">{{ date('d', strtotime($bl->created_at)) }}
                                            {{ date('M', strtotime($bl->created_at)) }}</span> -->
                                    <span class="date"><img class="" src="{{ asset($bl->image) }}"
                                            style="height:60px;"></span>
                                    <a class=""
                                        href="{{ route('blog.detail', ['id' => $bl->id, 'slug' => $bl->slug]) }}"
                                        style="padding-left: 115px">{{ $bl->title }}</a>
                                </li>
                            @endforeach


                        </ul>
                    </div>

                    @if (isset($blog->meta_keywords))
                        <div class="widget widget_tags">
                            <h4>Tags</h4>

                            <?php $tags = explode(',', $blog->meta_keywords); ?>


                            <ul>
                                @foreach ($tags as $tag)
                                    <li><a href="{{ route('blogs', $tag) }}">{{ $tag }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- content close -->
@endsection
