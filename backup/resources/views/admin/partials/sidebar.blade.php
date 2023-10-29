<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item m-auto pr-2 pt-1">
                <a href="{{ route('index') }}"><img src="{{asset( $settings['logo_image'] ?? '')}}" class="dashboard-logo" alt="OnlineQuranTuition" style="width:120px;"></a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0 shepherd-modal-target" data-toggle="collapse">
                    <i class="icon-x d-block d-xl-none font-medium-4 primary toggle-icon feather icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <hr class="m-0 p-0"/>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">


    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


        <li class="{{ (request()->is('admin/dashboard*')) ? 'hover active' : '' }}"><a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i>Dashboard</a></li>


            <li class="navigation-header"><strong>Inquiries</strong></li>

        @if(auth()->user()->role==="manager" || auth()->user()->role==="admin")
            <li  class="{{ (request()->is('admin/inquiries')) ? 'hover active' : '' }}" data-menu="">
                <a class="dropdown-item   " href="{{route('admin.all_inquiries')}}" data-toggle="dropdown">
                    <i class="feather icon-list"></i>All Inquiries</a>
            </li>



            <li class="{{ (request()->is('admin/new-trilas*')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.new.trial')}}" ><i class="feather icon-file-text"></i>New Trials</a></li>
            <li class="{{ (request()->is('admin/regular-students*')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.regular.students')}}" ><i class="feather icon-file-text"></i>Regular Classes</a></li>





        @endif

        <li class="navigation-header"><strong>Gocardless</strong></li>

        @if(auth()->user()->role==="manager" || auth()->user()->role==="admin")
            <li  class="{{ (request()->is('admin/pending-subscriptions/list')) ? 'hover active' : '' }}" data-menu="">
                <a class="dropdown-item   " href="{{route('admin.pending.subscription')}}" data-toggle="dropdown">
                    <i class="feather icon-list"></i>All</a>
            </li>



            <li class="{{ (request()->is('admin/pending-subscriptions/submission')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.submission')}}" ><i class="feather icon-file-text"></i>Submission</a></li>
            <li class="{{ (request()->is('admin/pending-subscriptions/submitted')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.submitted')}}" ><i class="feather icon-file-text"></i>Submitted</a></li>
            <li class="{{ (request()->is('admin/pending-subscriptions/confirmed')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.confirmed')}}" ><i class="feather icon-file-text"></i>Confirmed</a></li>
            <li class="{{ (request()->is('admin/pending-subscriptions/paid_out')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.paid_out')}}" ><i class="feather icon-file-text"></i>Paid out</a></li>
            <li class="{{ (request()->is('admin/pending-subscriptions/cancelled')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.cancelled')}}" ><i class="feather icon-file-text"></i>Cancelled</a></li>
            <li class="{{ (request()->is('admin/pending-subscriptions/customer_approval_denied')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.customer_approval_denied')}}" ><i class="feather icon-file-text"></i>approval denied</a></li>
            <li class="{{ (request()->is('admin/pending-subscriptions/failed')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.failed')}}" ><i class="feather icon-file-text"></i>Failed</a></li>
            <li class="{{ (request()->is('admin/pending-subscriptions/charged_back')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.charged_back')}}" ><i class="feather icon-file-text"></i>Charged Back</a></li>
            <li class="{{ (request()->is('admin/pending-subscriptions/pending_customer_approval')) ? 'hover active' : '' }}"><a class="dropdown-item " href="{{route('admin.pending.subscription.pending_customer_approval')}}" ><i class="feather icon-file-text"></i>Pending approval</a></li>





        @endif



        <li class="navigation-header"><strong>Staff</strong></li>
        @if(auth()->user()->role==="manager")
        <!--    <li><a class="dropdown-item" href="{{route('admin.shared.inquiries.show')}}" class="{{ (request()->is('admin/student_list*')) ? 'active' : '' }}"><i class="feather icon-file-text"></i>Inquiries</a></li>
        -->
            <li class="{{ (request()->is('admin/tutor_list*')) ? 'hover active' : '' }}" ><a class="dropdown-item " href="{{route('admin.shared.tutor_list')}}" ><i class="fas fa-user"></i>Tutors</a></li>
        @endif
        @if(auth()->user()->role==="admin")

            <li class="{{ (request()->is('admin/tutor_list*')) ? 'active' : '' }}"   ><a class="dropdown-item  " href="{{route('admin.tutor_list')}}"><i class="fas fa-chalkboard-teacher"></i>Tutors</a></li>
            <li class="{{ (request()->is('admin/payment_manager_list*')) ? 'hover active' : '' }}"   ><a class="dropdown-item    " href="{{url('admin/payment_manager_list')}}"><i class="fas fa-money-bill-alt"></i>Payment Manager</a></li>
            <li class="{{ (request()->is('admin/pending_payments*')) ? 'hover active' : '' }}" >
                <a class="dropdown-item  " href="{{route('admin.pending.payments',['status'=>'paid'])}}">
                    <i class="fal fa-money-bill-wave-alt"></i>Paid Payments</a>
            </li>
            <li class="{{ (request()->is('admin/tutor-reviews*')) ? 'hover active' : '' }}">
                <a class="dropdown-item  " href="{{route('admin.tutor.reviews')}}">
                    <i class="feather icon-pocket"></i>Tutor Reviews</a>
            </li>
        @endif

        @if(auth()->user()->role==="manager" || auth()->user()->role==="admin")
            <li class="navigation-header"><strong>Students</strong></li>
            <li class="{{ (request()->is('admin/student-all*')) ? 'hover active' : '' }}" ><a class="dropdown-item  " href="{{route('admin.student_all')}}"><i class="fas fa-users"></i>All Students</a></li>

            <li class="{{ (request()->is('admin/student-list*')) ? 'hover active' : '' }}" ><a class="dropdown-item  " href="{{route('admin.studen_list')}}"><i class="fas fa-users-class"></i>Paid Students</a></li>
            <li class="{{ (request()->is('admin/schedules-list*')) ? 'hover active' : '' }}" >
                <a class="dropdown-item  " href="{{route('admin.inquiry.schedule')}}">
                    <i class="feather icon-dollar-sign"></i>Schedules</a>
            </li>
            <li  class="{{ (request()->is('admin/inquiries/not-paid*')) ? 'hover active' : '' }}" data-menu="">
                <a class="dropdown-item   " href="{{route('admin.not_paid_inquiries')}}" data-toggle="dropdown">
                    <i class="feather icon-list"></i>Unpaid Students</a>
            </li>

            {{--                <li class="{{ (request()->is('admin/trial-inquiries*')) ? 'hover active' : '' }}" >--}}
            {{--                    <a class="dropdown-item    " href="{{route('admin.trial.inquiries')}}">--}}
            {{--                        <i class="feather icon-unlock"></i>--}}
            {{--                        Trial</a></li>--}}

            <li class="{{ (request()->is('admin/students-tutor/removed*')) ? 'hover active' : '' }}" >
                <a class="dropdown-item    " href="{{route('admin.removed.tutors')}}">
                    <i class="feather icon-user"></i>
                    Removed Students
                </a>
            </li>
            @if(auth()->user()->role==="admin")
            <li class="{{ (request()->is('admin/cancel-subscriptions/list*')) ? 'hover active' : '' }}"   >
                <a class="dropdown-item " href="{{route('admin.cancel.subscription')}}">
                    <i class="feather icon-x-circle"></i>
                    Cancel Subscription</a>
            </li>
                @endif

        @endif

{{--        @if(auth()->user()->role==="manager" || auth()->user()->role==="admin")--}}
{{--        <li class="navigation-header"><strong>Processing Inquiries</strong></li>--}}
{{--        <!--   <li  class="{{ (request()->is('admin/inquiries/paid*')) ? 'hover active' : '' }}"" data-menu="">--}}
{{--                    <a class="dropdown-item "   href="{{route('admin.paid_inquiries')}}" data-toggle="dropdown">--}}
{{--                        <i class="feather icon-list"></i>Student (Paid)</a>--}}
{{--                </li>    -->--}}
{{--            --}}
{{--            --}}

{{--                --}}
{{--        @endif--}}


        @if(auth()->user()->role==="admin" || auth()->user()->role==="manager")
            <li class="navigation-header"><strong>Finance</strong></li>
            <li class="{{ (request()->is('admin/financial-statement*')) ? 'hover active' : '' }}" >
                <a class="dropdown-item  " href="{{route('admin.financial.statement')}}">
                    <i class="feather icon-dollar-sign"></i>Finance</a>
            </li>
            <li class="{{ (request()->is('admin/expense/list*')) ? 'hover active' : '' }}" >
                <a class="dropdown-item " href="{{route('admin.expense.list')}}">
                    <i class="feather icon-star"></i>Expenses</a>
            </li>


            <li class="navigation-header"><strong>Support</strong></li>




            <li class="{{ (request()->is('admin/enquiries*')) ? 'hover active' : '' }}" >
                <a class="dropdown-item " href="{{route('admin.support.enquiries')}}">
                    <i class="feather icon-list"></i>Support</a>
            </li>
            @if(auth()->user()->role==="admin")
            <li class="{{ (request()->is('admin/contact_messages*')) ? 'hover active' : '' }}" >
                <a class="dropdown-item  " href="{{route('admin.contact_messages')}}">
                    <i class="feather icon-file-text"></i>Contact Queries</a>
            </li>
            @endif
        <li class="{{ (request()->is('admin/chat*')) ? 'hover active' : '' }}" >
            <a class="dropdown-item  " href="{{route('admin.chat')}}">
                <i class="fas fa-comment"></i>Chat</a>
        </li>
            @if(auth()->user()->role==="admin")
            <li class="navigation-header"><strong>Settings</strong></li>
            <li class="{{ (request()->is('admin/coupon_list*')) ? 'hover active' : '' }}" ><a class="dropdown-item    " href="{{route('admin.coupon_list')}}"><i class="feather icon-list"></i>Coupons</a></li>

            <li class="{{ (request()->is('admin/plan_list*')) ? 'hover active' : '' }}" ><a class="dropdown-item    " href="{{route('admin.plan_list')}}"><i class="feather icon-grid"></i>Plans</a></li>

            <li class="{{ (request()->is('admin/country_list*')) ? 'hover active' : '' }}" ><a class="dropdown-item     " href="{{route('admin.country_list')}}"><i class="fas fa-globe-europe"></i>Country</a></li>


            <li class="navigation-header"><strong>CMS</strong></li>
            <li class="{{ (request()->is('admin/faqs_list*')) ? 'hover active' : '' }}" >
                <a class="dropdown-item " href="{{ route('admin.faqs.list') }}">
                    <i class="fas fa-question-circle"></i>Faqs</a>
            </li>
            @if(auth()->user()->role==="admin")
            <li class="{{ (request()->is('admin/testimonial/list*')) ? 'hover active' : '' }}"   >
                <a class="dropdown-item  " href="{{route('admin.testimonial.list')}}">
                    <i class="feather icon-star"></i>Testimonials</a>
            </li>
            @endif
            <li class="{{ (request()->is('admin/videos*')) ? 'hover active' : '' }}" ><a class="dropdown-item " href="{{route('admin.videos')}}"><i class="feather icon-camera"></i>Video Testimonials</a></li>
            <li  class="{{ (request()->is('admin/blogs_list*')) ? 'hover active' : '' }}"  class="" data-menu="">
                <a class="dropdown-item " href="{{ route('admin.blogs.list') }}">
                    <i class="fas fa-blog"></i>Blogs</a>
            </li>

            <li  class="{{ (request()->is('admin/cms*')) ? 'hover active' : '' }}" data-menu="">
                <a class="dropdown-item " href="{{ route('admin.cms.add') }}" data-toggle="dropdown">
                    <i class="feather icon-list"></i>CMS</a>
            </li>
        @endif
        @endif
    </ul>

</div>
</div>

<!-- END: Main Menu-->
