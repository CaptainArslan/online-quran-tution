@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('heading', 'Manager Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-6 col-sm-6 col-12">
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
    <div class="col-lg-6 col-sm-6 col-12">
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
    <div class="col-lg-6 col-sm-6 col-12">
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
    <div class="col-lg-6 col-sm-6 col-12">
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="text-center mt-2">
                <h4>Recent Inquiries</h4>
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
                                Action
                            </th>
                        </thead>
                        <tbody>

                            @foreach ($inquiries as $student)
                            
                                @if($student->is_interested == 1)
                            
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
                                            <div class="btn-group">
                                                
                                                @if($student->is_interested == 0)
                                                    <a href="{{ route('admin.inquiry.interest', [$student->id, 1]) }}" class="btn btn-success">Interested</a>
                                                    <a href="{{ route('admin.inquiry.interest', [$student->id, 0]) }}" class="btn btn-danger">Cancelled</a>
                                                    
                                                    @else
                                                    <a href="{{route('admin.inquiry.detail',[$student->id])}}" class="btn btn-primary">Detail</a>
                                                @endif
                                                
                                                
                                                
                                                    <!--@if($student->status=="on_trial")-->
                                                    <!--<a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>-->
                                                    <!--@elseif($student->status=="pending")-->
            
                                                    <!--    @if(is_null($student->tutor_id))-->
                                                    <!--    <a href="{{ route('admin.shared.inquiry_forward', [$student->id]) }}" class="btn btn-success">Forward</a>-->
                                                    <!--    @else-->
                                                    <!--    <a href="{{ route('admin.shared.schedule.trial.class',$student->id) }}" class="btn btn-warning">Start Trial</a>-->
                                                    <!--    @endif-->
            
                                                    <!--@endif-->
            
                                                    @if($student->status!="cancelled")
                                                    <a href="{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}" class="btn btn-danger ">Cancel</a>
                                                    @endif
                                                
                                            </div>
                                        </td>
                                    </tr>
                            
                                @endif
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop