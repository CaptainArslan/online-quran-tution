@extends('payment_manager.layouts.app')
@section('content')
@section('topbar-heading', 'Dashboard')
<div class="row">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$no_of_tutors}}</h2>
                    <p>No Of Tutors</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-cpu text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$no_of_inquiries}}</h2>
                    <p>No Of Inquiries</p>
                </div>
                <div class="avatar bg-rgba-success p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-server text-success font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$pendinginquiries}}</h2>
                    <p>Pending Inquiries</p>
                </div>
                <div class="avatar bg-rgba-danger p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-activity text-danger font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$done_inquiries}}</h2>
                    <p>Done Inquiries</p>
                </div>
                <div class="avatar bg-rgba-warning p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-alert-octagon text-warning font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- recent inquiries --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Recent Inquiries</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <th>
                                    ID
                                </th>

                                <th>
                                    Name
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Phone
                                </th>

                                <th>
                                    Inquiry
                                </th>
                                <th>
                                    Action
                                </th>


                            </thead>
                            <tbody>

                                @foreach ($inquiries as $student)
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

                                    <td>{{$student->inquiry ?? ''}}</td>


                                    <td>
                                        <div class="btn-group">
                                            @if($student->status=="on_trial")
                                            <a href="{{ route('payment_manager.change.inquiry.status', [$student->id, 'started']) }}"
                                                class="btn btn-success">Start</a>
                                            @elseif($student->status=="pending")

                                            @if(is_null($student->tutor_id))
                                            <a href="{{ route('payment_manager.inquiry_forward', [$student->id]) }}"
                                                class="btn btn-success">Forward</a>
                                            @else
                                            <a href="{{ route('payment_manager.change.inquiry.status', [$student->id, 'on_trial']) }}"
                                                class="btn btn-warning">Start Trial</a>
                                            @endif

                                            @endif

                                            @if($student->status!="cancelled")
                                            <a href="{{ route('payment_manager.change.inquiry.status', [$student->id, 'cancelled']) }}"
                                                class="btn btn-danger ">Cancel</a>
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
</div>

@stop
