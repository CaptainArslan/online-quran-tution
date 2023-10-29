<!--header begin -->
<header class="header-s1 has-topbar">

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="header-row">
                    <div class="header-col left " style="margin-top: 0;">
                        <!-- logo begin -->
                        <div id="logo">
                            <a href="{{ route('index') }}">
                                <img alt="" class="img-fluid" width="80" src="{{asset('/images/logo.png')}}">
                            </a>
                        </div>
                        <!-- logo close -->
                    </div>
                    <div class="header-col mid">
                        <!-- mainmenu begin -->
                        <ul id="mainmenu">
                            <li><a class="link-nav" href="{{route('index')}}">Home</a></li>
                            <li><a class="link-nav" href="{{route('pricing')}}">Pricing</a></li>
                            <li><a class="link-nav" href="{{route('courses')}}">Courses</a></li>
                            <li><a class="link-nav" href="{{route('blogs')}}">Blogs</a></li>
                            <li><a class="link-nav" href="{{route('privacy')}}">Privacy</a></li>
                            <li><a class="link-nav" href="{{route('testimonials')}}">Testimonials</a></li>
                            <!--<li><a class="link-nav" href="{{route('contact')}}">Contact us</a></li>-->
                            @if (Auth::check())
                            <li>
                                <a class="link-nav" href="{{ route('home') }}">Dashboard</a>
                            </li>
                            @else
                            <li><a class="link-nav" href="{{route('login')}}">Login</a></li>
                            <li><a class="link-nav" href="#inquiry-form">Signup</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- small button begin -->
                <span id="menu-btn"><i class="fab fa-dot-circle"></i></span>
                <!-- small button close -->

            </div>
        </div>
    </div>
</header>
<!-- header close-->
