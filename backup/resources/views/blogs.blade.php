

@extends('layouts.app')
@section('title', $settings['blog_meta_title'] ?? '')
@section('meta')

<meta name="description" content="{{ $settings['blog_meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $settings['blog_meta_keyword'] ?? '' }}">
@endsection
@section('css')
<style>
    /* .pagination {
        justify-content: center;
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
            <div class="row green-background p-3 d-flex align-items-baseline" style="margin-top: -50px;">
                <div class="col-md-3">
                    <h5 class="text-skin">used by 500+ students</h5>
                </div>
    
                <div class="col-md-3">
                    <img alt="" src="{{asset('/public/dist/img/trustpilot.png')}}">
                </div>
    
    
                <div class="col-md-3">
                    <img alt="" src="{{asset('/public/dist/img/google.png')}}">
                </div>
    
                <div class="col-md-3">
                    <h5 class="text-skin">40+ Professional Tutors</h5>
                </div>
    
    
            </div>
        </div>
    </section>

    <section id="section-features" class="mt-4">
        <div class="container" style="position:relative;">
            <div class="dis-hide" style="border-left: 1.5px solid #ccc;height: 100%;position: absolute;left: 50%;margin-left: -3px;top: 0;">
            </div>
            <div class="row">
                <ul class="list-group-flush list-group w-100">
                    @foreach($blogs as $blog)
                        <li class="@if($loop->iteration % 2 == 0) li-right @else li-left @endif shadow hover-effect li-blogs">
                            <a href="{{route('blog.detail',['id'=>$blog->id,'slug'=>$blog->slug])}}" class="a-hover">
                                <div class="card green-background text-skin">
                                    <div class="card-title">
                                        {{-- <img src="{{asset($blog->image)}}" class="w-100 blog-image " style=""> --}}
                                        <img src="{{asset('/public/dist/img/exports/Rectangle 153.png')}}" class="w-100 blog-image " style="">
                                    </div>
                                    <div class="card-body p-4">
                                        <h5 class="mb-0">{{$blog->title}}</h5>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul> 
            </div>
        </div>
{{-- <div class="row justify-content-center mt-3">
                 {{$blogs->links()}}
             </div> --}}
    </section>
<!-- content close -->

@stop
