<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item m-auto">
                <a class="navbar-brand" href="{{ route('student.dashboard') }}">
                    <img src="{{ asset($settings['logo_image']) }}" style="width:120px;" alt="OnlineQuranTutor">
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0 shepherd-modal-target" data-toggle="collapse">
                    <i class="icon-x d-block d-xl-none font-medium-4 primary toggle-icon feather icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            {{-- <li class=" nav-item">
                <a href="{{route('student.student_all_session')}}"
            class="{{ (request()->is('student/student_all_session*')) ? 'active' : '' }}">
            <i class="feather icon-skip-back"></i><span class="menu-title" data-i18n="Email"></span>Previous Classes
            </a>
            </li> --}}
            <li class=" nav-item">
                <a href="{{route('student.dashboard')}}"
            class="{{ (request()->is('student/dashboard*')) ? 'active' : '' }}">
            <i class="feather icon-home"></i><span class="menu-title" data-i18n="Email"></span>Dashboard
            </a>
            </li>

            <li class=" nav-item">
                <a href="{{route('student.s_user_profile')}}" class="{{ (request()->is('student/s_user_profile*')) ? 'active' : '' }}">
                    <i class="feather icon-user"></i><span class="menu-title" data-i18n="Todo">My Profile</span>
                </a>
            </li>
            @if ($user->parent_id == null)
            <li class=" nav-item">
                <a href="{{route('student.children')}}" class="{{ (request()->is('student/children*')) ? 'active' : '' }}">
                    <i class="feather icon-users"></i><span class="menu-title" data-i18n="Todo">Child Profile</span>
                </a>
            </li>
            @endif
            {{-- <li class=" nav-item">
                <a href="{{route('student.student_all_session')}}"
            class="{{ (request()->is('student/student_all_session*')) ? 'active' : '' }}">
            <i class="feather icon-clock"></i><span class="menu-title" data-i18n="Email">Session</span>
            </a>
            </li> --}}
            <li class=" nav-item">
                <a href="{{route('student.student_subscription')}}"
                    class="{{ (request()->is('student/student_subscription*')) ? 'active' : '' }}"><i
                        class="feather icon-target"></i><span class="menu-title" data-i18n="Email">Subscriptions</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="{{route('student.canceled_payments')}}"
                    class="{{ (request()->is('student/canceled_payments*')) ? 'active' : '' }}"><i
                        class="feather icon-x-circle"></i><span class="menu-title" data-i18n="Email">Cancelled Payments</span>
                </a>
            </li>

            <li class=" nav-item"><a href="#"  class="{{ (request()->is('student/ticket*')) ? 'active' : '' }}"><i class="feather icon-help-circle"></i><span class="menu-title" data-i18n="Ecommerce">Support</span></a>
                <ul class="menu-content">
                    <li><a href="{{route('student.ticket.open_ticket')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Open Support Order</span></a>
                    </li>
                    <li><a href="{{route('student.ticket.tickets')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">My Orders</span></a>
                    </li>

                </ul>
            </li>
            
            <li class=" nav-item">
                <a href="{{route('student.reviews')}}"class=""><i class="feather icon-square"></i><span class="menu-title" data-i18n="Email">Reviews</span>
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
