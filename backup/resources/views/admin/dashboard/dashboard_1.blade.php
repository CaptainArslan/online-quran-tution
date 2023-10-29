@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('content')
<div class="text-center">
    <h3>Inquiries Statistics</h3>
</div>
<hr>

<div class="row">
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.all_inquiries') }}">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-primary">{{$no_of_inquiries ?? '0'}}</h2>
                        <p class="text-primary">Total Inquiries</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-database text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.all_inquiries') }}?status=started">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-success">{{count($inq_started) ?? '0'}}</h2>
                        <p class="text-success">Started Inquiries</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-alert-octagon text-success font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.new.trial') }}">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-primary">{{count($inq_on_trial) ?? '0'}}</h2>
                        <p class="text-primary">On Trial Inquiries</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-database text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.all_inquiries') }}?status=not_start">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-info">{{count($inq_not_started) ?? '0'}}</h2>
                        <p class="text-info">Not Started Inquiries</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-server text-info font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.inquiries') }}?q=pending">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-warning">{{count($inq_pending) ?? '0'}}</h2>
                        <p class="text-warning">Pending Inquiries</p>
                    </div>
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-activity text-warning font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
   
   
    
    
    
    
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.paid_inquiries') }}">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-dark">{{count($inq_paid) ?? '0'}}</h2>
                        <p class="text-dark">Paid Inquiries</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-octagon text-dark font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.not_paid_inquiries') }}">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-secondary">{{count($inq_not_paid) ?? '0'}}</h2>
                        <p class="text-secondary">Unpaid Inquiries</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-alert-octagon text-secondary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.inquiries') }}?q=cancelled">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-danger">{{count($inq_cancelled) ?? '0'}}</h2>
                        <p class="text-danger">Cancelled Inquiries</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-x-circle text-danger font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="text-center">
    <h3>Fanancial Statistics</h3>
</div>
<hr>
<div class="row">

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
             <a href="{{ route('admin.financial.statement')}}?filter_type=daily">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-warning">{{$daily_sales_count ?? '0'}}</h2>
                        <p class="text-warning">Today Sales</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-sun text-warning font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.financial.statement')}}?filter_type=daily">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-info">£{{$daily_sales ?? '0'}}</h2>
                        <p class="text-info">Today Sales Revenue</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-sun text-info font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.financial.statement')}}?filter_type=monthly">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-secondary">{{$monthly_sales_count ?? '0'}}</h2>
                        <p class="text-secondary">Monthly Sales</p>
                    </div>
                    <div class="avatar bg-rgba-secondary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-sun text-secondary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.financial.statement')}}?filter_type=monthly">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-primary">£{{$monthly_sales ?? '0'}}</h2>
                        <p class="text-primary">Monthly Sales Revenue</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-sun text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.financial.statement')}}?from={{  \Carbon\Carbon::today()->subDays(7)->format('Y/m/d') }}&to={{  \Carbon\Carbon::today()->format('Y/m/d') }}">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-success">{{count($weekly_sales) ?? '0'}}</h2>
                        <p class="text-success">Last Week Sales</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-watch text-success font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.financial.statement')}}?from={{  \Carbon\Carbon::today()->subDays(7)->format('Y/m/d') }}&to={{  \Carbon\Carbon::today()->format('Y/m/d') }}">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-dark">Rs.{{$weekly_expense ?? '0'}}</h2>
                        <p class="text-dark">Last Week Expenses</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-server text-dark font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.financial.statement')}}">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-success">£{{number_format($all_revenue,2) ?? '0'}}</h2>
                        <p class="text-success">Total Revenue</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-server text-success font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <a href="{{ route('admin.financial.statement')}}">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-danger">Rs.{{number_format($all_expense,2) ?? '0'}}</h2>
                        <p class="text-danger">Total Expenses</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-server text-danger font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="pt-2 text-center">
                <h4>Recent Inquiries</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>
                                #
                            </th>

                            <th>
                                Std Name
                            </th>

                            <th>
                                Email Address
                            </th>
                            <th>
                                Phone
                            </th>

                            <th>
                                Payment Status
                            </th>
                            <th>
                                Inq. Status
                            </th>
                            <th>
                                Action
                            </th>


                        </thead>
                        <tbody>

                            @foreach ($inquiries as $student)

                                @if($student->is_interested == 0 && $student->status=="pending")

                                @else

                                @endif


                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{$student->user->name ?? ''}}
                                </td>
                                <td>
                                    {{$student->user->email ?? ''}}
                                </td>
                                <td>
                                    {{$student->user->phone ?? ''}}
                                </td>

                                <td>
                                    @if($student->is_paid)
                                    <span class="badge badge-success">Paid</span>
                                    @else
                                    <span class="badge badge-danger">Not Paid</span>
                                    @endif
                                </td>


                                <td>
                                    @if($student->status=="pending")
                                    <span class="badge badge-primary">
                                        Pending {{ $student->tutor ? '(Tutor assigned)' : '' }}
                                    </span>
                                    @elseif($student->status=="started")
                                    <span class="badge badge-success">Started</span>
                                    @elseif($student->status=="cancelled")
                                    <span class="badge badge-danger">Cancelled</span>
                                    @else
                                    <span class="badge badge-warning">On Trial</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">


                                        @if($student->is_interested == 0 && $student->status=="pending")


                                            <a href="{{ route('admin.inquiry.interest', [$student->id, 1]) }}" class="btn btn-success">Interested</a>
                                            <a href="{{ route('admin.inquiry.interest', [$student->id, 0]) }}" class="btn btn-danger">Cancelled</a>


                                        @else


                                            @if($student->status=="on_trial")
                                                <a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>
                                            @elseif($student->status=="pending")

                                            @if(is_null($student->tutor_id))
                                                <a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>
                                            @else
                                                <a href="{{ route('admin.shared.schedule.trial.class',$student->id) }}" class="btn btn-warning">Start Trial</a>
                                            @endif

                                            @endif

                                            @if($student->status!="cancelled")
                                                <a href="{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}" class="btn btn-danger">Cancel</a>
                                            @endif


                                        @endif





                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
