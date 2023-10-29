<section class="white-background d-lg-none d-sm-block">
    <div class="row mx-1">
        <div class="col-sm-12 right text-dark mt-1">
            <b>Phone:</b> <a class="text-decoration-none text-dark" href="tel:07493320143"><i class="icon-map-pin"></i><b>07493320143</b></a>
        </div>
    </div>
</section>
<section class="green-background">
    <div class="container ">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img alt="Logo" class="img-fluid" src="{{ asset('/public/dist/img/Logo.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item me-4">
                            <a aria-current="page" class="nav-link active float-lg-end float-md-start float-start text-skin"
                                href="{{ route('index') }}">Home</a>
                        </li>

                        <li class="nav-item me-4">
                            <a aria-current="page" class="nav-link active float-lg-end float-md-start float-start text-skin"
                                href="{{ route('courses') }}">Courses</a>
                        </li>

                        <li class="nav-item me-4">
                            <a aria-current="page" class="nav-link active float-lg-end float-md-start float-start text-skin"
                                href="{{ route('pricing') }}">Pricing</a>
                        </li>

                        <li class="nav-item me-4">
                            <a aria-current="page" class="nav-link active float-lg-end float-md-start float-start text-skin"
                                href="{{ route('testimonials') }}">Testimonials</a>
                        </li>

                        <li class="nav-item me-4">
                            <a aria-current="page" class="nav-link active float-lg-end float-md-start float-start text-skin"
                                href="{{ route('blogs') }}">Blog</a>
                        </li>

                        {{-- <li class="nav-item me-4">
                        <a aria-current="page" class="nav-link active float-lg-end float-md-start float-start text-skin" href="#">
                            <img alt="" src="{{asset('/public/dist/img/Vector.png')}}" width="15px">
                            Login
                        </a>
                    </li> --}}
                        @if (Auth::check())
                            <li class="nav-item me-4 mt-2">
                                <a aria-current="page" class="link-nav active float-lg-end float-md-start float-start text-skin"
                                    href="{{ route('home') }}">Dashboard</a>
                            </li>
                        @else

                            <li class="nav-item me-4">
                                <a aria-current="page" class="nav-link active float-lg-end float-md-start float-start text-skin"
                                   href="#booking-form">Register</a>
                            </li>

                            <li class="nav-item me-4 mt-2">
                                <a aria-current="page" class="link-nav active float-lg-end float-md-start float-start text-skin"
                                    href="{{ route('login') }}"><img alt=""
                                        src="{{ asset('/public/dist/img/Vector.png') }}" width="15px">Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</section>
