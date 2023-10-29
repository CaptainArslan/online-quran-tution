@extends("student.layouts.app")
@section('content')
@include('admin.partials.success_message')

@section('css')
    <style>
        th
        {
        background-color: #F8F8F8;
        font-size: 14px !important;
        text-transform: uppercase;
        font-weight:900;
        }
        td
        {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .btn
        {
            font-size: 12px;
            font-weight: bold;
        }
    </style>
@endsection
@section('topbar-heading', 'Dashboard')

<div class="row">
    <div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-info">{{ count($inquiries) ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total Inquiries</h4>
          </div>
        </div>
      </div>
<div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-success">{{ count($inquiries->where('status', 'started')) ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Active Inquiries</h4>
          </div>
        </div>
      </div>
<div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-warning">{{ count($inquiries->where('status', 'pending')) ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Pending Inquiries</h4>
          </div>
        </div>
      </div>
<div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-danger">{{ count($inquiries->where('status', 'cancelled')) ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Cancelled Inquiries</h4>
          </div>
        </div>
      </div>


</div>
@foreach($inquiries as $check_session)


    @if(count($check_session->inquiry_sessions) > 0 && $check_session->inquiry_sessions->last()->created_at->format('Y-m-d')==now()->format('Y-m-d') && $check_session->inquiry_sessions->last()->meeting_review==false)
    @php
        $session_time=$check_session->inquiry_sessions->last()->created_at;
        $add_hour=$check_session->inquiry_sessions->last()->created_at->modify('+60 minutes');
        $date = new DateTime;
        $date->modify('-60 minutes');
        $formatted = $date->format('Y-m-d H:i:s');
    @endphp

    @if($session_time < now() && $add_hour > now())

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body bg-primary">
                    <div class="row">
                        <div class="col-md-8 col-8 " style="padding-top:8px;">
                            <span class="text-white">Click on the <span class="font-weight-bold">"Join Now"</span> button to join your class</span>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{$check_session->inquiry_sessions->last()->join_url}}" class="btn btn-white">Join Class</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif
    @endif

@endforeach


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="text-center pb-1 pt-1">
                <h3 class="text-uppercase text-info">latest Inquiries</h3>
            </div>
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th width="23%" class="text-right">Action</th>
                            <th>Created</th>
                            <th>Payment Status</th>
                            <th>Inquiry Status</th>
                            <th>Unread Messages</th>
                            
                        </thead>
                        <tbody id="student_unread">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <h5 class="alert alert-warning">First 3 days after inquiry submission will be marked as a trial days. After the trial period you have to pay your payments against the inquiry to continuee the classes.</h5>
    </div>

</div>

@endsection

