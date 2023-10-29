@extends('layouts.app')
@section('title',  $blog->meta_title ?? '')
@section('meta')
<meta name="title" content="{{ $blog->meta_title ?? '' }}">
<meta name="description" content="{{ $blog->meta_keywords ?? '' }}">
<meta name="keywords" content="{{ $blog->meta_description ?? '' }}">
@endsection
@section('css')
<style>
    .shadow{
      box-shadow: 0 0.3rem .7rem rgb(60 72 88 / 15%) !important;   
    }
</style>
@endsection
@section('content')
<!-- content begin -->
<div id="content" class="no-top no-bottom">
    <!-- section begin -->


     <section class="pages-banner-heading"  style="padding: 65px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-12 banner-left-heading m-auto text-center">
                    <h2 class="mb-3 "  style="font-weight:600;font-size:32px;">{{ $blog->title }}</h3>
                </div>
            </div>
        </div>
    </section> 

 {{--   <section class="container-banner-lg p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 banner-left-heading m-auto">
                    <div class="banner-left-area">
                        <h3 class="mb-3" style="font-weight:500;font-size:28px;">{{ $blog->title }}</h3>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 asideimg" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset($settings['header_banner_image']) }});"></div>
                 <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset($settings['header_banner_image']) }});">

                </div> 
            </div>
        </div>
    </section>   --}}
    
    <section class="container-banner-md p-0" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset($settings['header_banner_image']) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 banner-left-heading m-auto">
                    <div class="banner-left-area">
                        <h1 class="text-white custom-font-3">{{ $blog->title }}</h1>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12"></div>
                {{-- <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset($settings['header_banner_image']) }});">

                </div> --}}
            </div>
        </div>
    </section>
    <!-- section close -->
    <section aria-label="section">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8">
                 {{--   <h3 class="mb-3" style="font-weight:500;font-size:28px;">{{ $blog->title }}</h3>  --}}
                    <div class="card shadow">
                        <div class="card=title mb-0">
                            <img src="{{ asset($blog->image) }}" width="100%" alt="">
                        </div>
                        <div class="card-body">
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
                            @foreach($recent_blogs as $bl)
                            <li class="list-group-item mb-0">
                            <!--    <span class="date">{{date('d', strtotime($bl->created_at))}}
                                    {{date('M', strtotime($bl->created_at))}}</span> -->
                                   <span class="date"><img class="" src="{{asset($bl->image)}}" style="height:60px;"></span>
                                    <a class=""
                                    href="{{route('blog.detail',['id'=>$bl->id,'slug'=>$bl->slug])}}" style="padding-left: 115px">{{ $bl->title }}</a>
                            </li>
                            @endforeach


                        </ul>
                    </div>

                    @if(isset($blog->meta_keywords))
                    <div class="widget widget_tags">
                        <h4>Tags</h4>
                        
                        <?php $tags = explode(',', $blog->meta_keywords);?>


                        <ul>
                            @foreach($tags as $tag)
                        <li><a href="{{route('blogs',$tag)}}">{{ $tag }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
<!-- content close -->
@endsection
