<section class="green-background">
    <div class="container ">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img alt="" class="img-fluid" src="{{ asset('/public/dist/img/Logo.png') }}">
                </a>
                <button aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler" data-bs-target="#navbarScroll" data-bs-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="float-end">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item me-4">
                                <a aria-current="page" class="nav-link active float-end text-skin"
                                    href="{{ route('index') }}">Home</a>
                            </li>

                            <li class="nav-item me-4">
                                <a aria-current="page" class="nav-link active float-end text-skin"
                                    href="{{ route('courses') }}">Courses</a>
                            </li>

                            <li class="nav-item me-4">
                                <a aria-current="page" class="nav-link active float-end text-skin"
                                    href="{{ route('pricing') }}">Pricing</a>
                            </li>


                            <li class="nav-item me-4">
                                <a aria-current="page" class="nav-link active float-end text-skin"
                                    href="{{ route('blogs') }}">Blog</a>
                            </li>

                            {{-- <li class="nav-item me-4">
                                <a aria-current="page" class="nav-link active float-end text-skin" href="#">
                                    <img alt="" src="{{asset('/public/dist/img/Vector.png')}}" width="15px">
                                    Login
                                </a>
                            </li> --}}
                            @if (Auth::check())
                                <li class="nav-item me-4 mt-2">
                                    <a aria-current="page" class="link-nav active float-end text-skin"
                                        href="{{ route('home') }}">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item me-4 mt-2">
                                    <a aria-current="page" class="link-nav active float-end text-skin"
                                        href="{{ route('login') }}"><img alt=""
                                            src="{{ asset('/public/dist/img/Vector.png') }}" width="15px">Login</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</section>
