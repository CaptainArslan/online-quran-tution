<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item m-auto">
                <a class="navbar-brand" href="{{route('payment_manager.dashboard')}}">
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


            <li class=" nav-item">
                <a href="{{route('payment_manager.dashboard')}}" class="{{ (request()->is('payment_manager/dashboard*')) ? 'active' : '' }}">
                    <i class="feather icon-home"></i><span class="menu-title" data-i18n="Todo">Dashboard</span>
                </a>
            </li>

            <li class=" nav-item">
                <a href="{{route('payment_manager.profile.show')}}" class="{{ (request()->is('payment_manager/profile*')) ? 'active' : '' }}">
                    <i class="feather icon-user"></i><span class="menu-title" data-i18n="Todo">My Profile</span>
                </a>
            </li>
            
            <li class=" nav-item">
                <a href="{{route('payment_manager.tutor_list')}}" class="{{ (request()->is('payment_manager/tutor_list*')) ? 'active' : '' }}">
                    <i class="feather icon-users"></i><span class="menu-title" data-i18n="Todo">Tutors</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="{{route('payment_manager.student_list')}}" class="{{ (request()->is('payment_manager/student_list*')) ? 'active' : '' }}">
                    <i class="feather icon-user-plus"></i><span class="menu-title" data-i18n="Todo">Student</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="{{route('payment_manager.inquiries.show')}}" class="{{ (request()->is('payment_manager/show_inquiries*')) ? 'active' : '' }}">
                    <i class="feather icon-help-circle"></i><span class="menu-title" data-i18n="Todo">Inquiries</span>
                </a>
            </li>  
            <li>
                <a class="dropdown-item" href="{{route('payment_manager.inquiry.schedule')}}">
                    <i class="feather icon-dollar-sign"></i>Schedules</a>
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
