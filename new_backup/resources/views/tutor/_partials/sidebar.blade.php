<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('tutor.user_profile') }}">

                    <h2 class="brand-text mb-0">LiveTutoring</h2>
                </a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="{{url('tutor/appointments')}}"
                    class="{{ (request()->is('tutor/appointments*')) ? 'active' : '' }}"><i
                        class="feather icon-calendar">
                    </i><span class="menu-title" data-i18n="Email">My Appointments</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="{{route('tutor.user_profile')}}" class="{{ (request()->is('tutor/user_profile*')) ? 'active' : '' }}">
                    <i class="feather icon-user"></i><span class="menu-title" data-i18n="Todo">My Profile</span>
                </a>
            </li>
            {{-- <li class=" nav-item">
                <a href="{{route('tutor.session_list')}}"
            class="{{ (request()->is('tutor/session_list*')) ? 'active' : '' }}">
            <i class="feather icon-clock"></i><span class="menu-title" data-i18n="Email">All Session</span>
            </a>
            </li> --}}
            <li class=" nav-item">
                <a href="{{route('tutor.payments')}}" class="{{ (request()->is('tutor/payments*')) ? 'active' : '' }}">
                    <i class="feather icon-award"></i><span class="menu-title" data-i18n="Email">Payments</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="{{route('tutor.link.zoom')}}" class="{{ (request()->is('tutor/link-zoom*')) ? 'active' : '' }}">
                    <i class="feather icon-globe"></i><span class="menu-title" data-i18n="Email">Attach Zoom</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="feather icon-power"></i>{{ __('Logout') }}
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
