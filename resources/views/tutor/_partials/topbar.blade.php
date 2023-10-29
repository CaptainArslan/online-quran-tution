        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
            <div class="navbar-wrapper">
                <div class="navbar-container content">
                    <div class="navbar-collapse" id="navbar-mobile">
                        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">

                            <h2>@yield('topbar-heading')</h2>

                        </div>
                        <ul class="nav navbar-nav float-right">

                            <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ Auth()->user()->name }}</span>
                                        <span class="user-status text-success">Online</span></div>
                                    <span><img class="round" src="{{asset(Auth()->user()->avatar)}}" alt="{{ Auth()->user()->name }}" height="40" width="40"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{route('tutor.user_profile')}}"><i class="feather icon-user"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="feather icon-power"></i>{{ __('Logout') }}
                                        </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                            </form>

                                </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <ul class="main-search-list-defaultlist-other-list d-none">
            <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                    <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
                </a></li>
        </ul>
        <!-- END: Header-->
