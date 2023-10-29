@extends('admin.layouts.app')
@section('title', 'Student Detail')
@section('heading','Student Detail')
@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success mb-2">
        {{ session()->get('message') }}
    </div>
    @endif
</div>


    <div class="row">
        @if(auth()->user()->role==="admin")
        <div class="col-lg-12 mb-2">
             
                
            <a href="{{ route('admin.student.payouts', $inquiry->user->id) }}" class="btn btn-info float-right">Paid Payments</a>
                
               
        </div>
         @endif
        <div class="col-lg-12">
           <div class="card">
                <div class=" p-2">
                   
                       <h4 class="m-0" style="padding-top:9px;">Staus : &nbsp;&nbsp;
                    
                     <span class="@if($inquiry->status=='pending')badge badge-info 
                                    @elseif($inquiry->status=='on_trial') badge badge-secondry 
                                    @elseif($inquiry->status=='started') badge badge-success
                                    @elseif($inquiry->status=='cancelled') badge badge-danger
                                    @else badge badge-primary
                                    @endif
                                 
                                    "> {{$inquiry->status ?? 'N/A'}} </span>
                    
                    </h4> 
                    
                    
                    @if(isset($inquiry->trial_start)) 
                        <h4 class="mb-0 " style="padding-top:9px;">Trial Start : &nbsp;&nbsp; <span class="font-weight-bold">{{$inquiry->trial_start}}</span></h4>
                    @endif
                    @if(isset($inquiry->trial_end_date))
                         <h4 class="mb-0 " style="padding-top:9px;">Trial End  : &nbsp;&nbsp; <span class="font-weight-bold">{{\Carbon\Carbon::parse($inquiry->trial_end_date)->format('d/m/Y')}}</span></h4>    
                    @endif
                    @if(isset($inquiry->direct_debit_start_date))
                        <h4 class="mb-0 " style="padding-top:9px;">Direct Debit Start  : &nbsp;&nbsp; <span class="font-weight-bold">{{\Carbon\Carbon::parse($inquiry->direct_debit_start_date)->format('d/m/Y')}}</span></h4>    
                    @endif
                    
                    
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="text-center pt-2">
                    <h4 class="m-0">Student Detail</h4>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>Information</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Skype ID</th>
                                <th>Father Name</th>
                                <th>Mother Name</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Student</td>
                                <td>{{$inquiry->user->name}}</td>
                                <td>{{$inquiry->user->email}}</td>
                                <td>{{$inquiry->user->phone}}</td>
                                <td>{{$inquiry->user->skype_id}}</td>
                                <td>{{$inquiry->user->fathername}}</td>
                                <td>{{$inquiry->user->mothername}}</td>
                                <td>{{$inquiry->user->address}}</td>
                            </tr>
                             @if($inquiry->tutor_id!==null)
                                <tr>
                                    <td class="font-weight-bold">Tutor</td>
                                    <td>{{$inquiry->tutor->name}}</td>
                                    <td>{{$inquiry->tutor->email}}</td>
                                    <td>{{$inquiry->tutor->phone}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="3" class="font-weight-bold">Teacher Removed</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                    
                    
                    
                    
                    <div class="text-center mt-3 pt-2">
                        <h4 class="mb-2">Class Schedules</h4>
                    </div>
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inquiry->schedules as $schedule)
                                <tr>
                                   <td>{{$loop->iteration}}</td>
                                   <td>
                                        @if($schedule->day==1)
                                            Monday
                                        @elseif($schedule->day==2)
                                            Tuesday
                                        @elseif($schedule->day==3)
                                            Wednesday
                                        @elseif($schedule->day==4)
                                            Thursday
                                        @elseif($schedule->day==5)
                                            Friday
                                        @elseif($schedule->day==6)
                                            Saturday
                                        @elseif($schedule->day==7)
                                            Sunday
                                        @endif
                                       </td>
                                   <td>{{$schedule->time}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
            
            @if(isset($plan) &&   $plan->plan!= null)
                <div class="card">
                <div class="text-center pt-2">
                    <h4 class="m-0">Subscription Plan</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Plan
                            <span class="font-weight-bold">{{$plan->plan->name}}</span>
                          </li>
                          
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Price per Month
                            <span class="font-weight-bold">{{$plan->plan->country->currency}}{{$plan->plan->price_per_month}}</span>
                          </li>
                          @if(count($data)>0)
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                              Method
                              <span class="font-weight-bold">{{$data['type']}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Amount
                            <span class="font-weight-bold badge badge-success">{{$data['currency']}}{{$data['amount']}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                           Start Date
                            <span class="font-weight-bold badge badge-success">{{$data['start_date']}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Status
                            <span class="font-weight-bold badge badge-success">{{$data['status']}}</span>
                          </li>
                          @endif
                    </ul>
                    @if(count($upcoming_payments)>0)
                    <h4 class="mt-2 text-center mb-0">Upcomming Payment Dates</h4>
                    <table class="table table stripped">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Charge Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcoming_payments as $amount)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{\Carbon\Carbon::parse($amount->charge_date)->format('d/m/Y')}}</td>
                                    <td>{{$plan->plan->country->currency}}{{$amount->amount/100}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            @endif
             @if(count($reviews)>0)
            
                <div class="card">
                    <div class="text-center pt-2">
                        <h4 class="m-0">This Month Reviews</h4>
                    </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-striped datatable">
                                <thead class="text-warning">
                                    <th>#</th>
                                    <th>Review Date</th>
                                    <th>Tutor Name</th>
                                    <th>Student Behavior</th>
                                    <th>Student Attention</th>
                                    <th>Student Progress</th>
                                    <th>Class Duration(minutes)</th>
                                    <th>Screenshot</th>
                                </thead>
                                <tbody>

                                @foreach($reviews as $review)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{date('d-m-Y',strtotime($review->created_at))}}</td>
                                        <td>{{$review->tutor->name ?? 'N / A'}}</td>
                                        <td>
                                            @for($i = 1; $i <= $review->behavior; $i++)
                                                <i class="fas fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            @for($i = 1; $i <= $review->attention; $i++)
                                                <i class="fas fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            @for($i = 1; $i <= $review->progress; $i++)
                                                <i class="fas fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        <td>{{$review->class_duration}}</td>
                                        <td>@if($review->screenshot)<img src="{{asset($review->screenshot??'')}}" style="height: 70px;">@endif</td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
            
            @endif
            

            @if(count($sessions)>0)
                
                <div class="card">
                    <div class="text-center pt-2">
                        <h4 class="m-0">This Month Sessions</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <th>
                                        Sr#
                                    </th>
                                    <th>
                                        Session Date
                                    </th>
                                    <th>
                                       Time
                                    </th>
                                    <th>
                                       Duration
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($sessions as $session)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{date('d/m/Y',strtotime($session->created_at))}}</td>
                                            <td>{{date('H:i',strtotime($session->created_at))}}</td>
                                            <td>{{$session->duration}}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
            @endif
        </div>
        
        
    </div>
    
    



@endsection