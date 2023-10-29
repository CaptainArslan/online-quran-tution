@extends('admin.layouts.app')
@section('title', 'Inquiry List')
@section('heading','Inquiry Detail')
@section('css')
    <style>
        .starrating > input {display: none;}
        .starrating > label:before {
            content: "\f005";
            margin: 2px;
            font-size: 20px;
            font-family: FontAwesome;
            display: inline-block;
            cursor: pointer;
        }
        .starrating > label { color: #222222;}
        .starrating > input:checked ~ label { color: #ffca08 ; }
        .starrating > input:hover ~ label{ color: #ffca08 ;  }
        .rate-stars{color: #ffca08 ; }
    </style>
@endsection
@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success mb-2">
        {{ session()->get('message') }}
    </div>
    @endif
</div>


    <div class="row">
         @if($inquiry->trial_end_date != null && $inquiry->direct_debit_start_date == null)
            <div class="col-12 mb-1">
               
                <a href="#" class="btn btn-primary float-right debit-date">Add Direct Debit Start Date</a>
               
            </div>
         @endif
        <div class="col-lg-12">
            
           <div class="card">
                <div class=" p-2">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="m-0" style="float:left;padding-top:9px;">Staus : &nbsp;&nbsp;
                    
                     <span class="@if($inquiry->status=='pending')badge badge-info 
                                    @elseif($inquiry->status=='on_trial') badge badge-secondry 
                                    @elseif($inquiry->status=='started') badge badge-success
                                    @elseif($inquiry->status=='cancelled') badge badge-danger
                                    @else badge badge-primary
                                    @endif
                                 
                                    "> {{$inquiry->status ?? 'N/A'}} </span>
                    
                    </h4>
                    <div style="float:right;">
                        <div class="btn-group">
                             @if($inquiry->status=="on_trial")
                            <a href="#" 
                                class="btn btn-success btn-start">Start</a>
                            @elseif($inquiry->status=="pending")
                                    
                            @if($inquiry->tutor_id!==null)
                                <a href="{{ route('admin.shared.schedule.trial.class',$inquiry->id) }}"
                                class="btn btn-warning">Start Trial</a>
                            @endif
                                            
                        @endif
                                        
                        @if($inquiry->status!="cancelled")
                            <a href="{{ route('admin.forward.inquiry', [$inquiry->id]) }}"
                            class="btn btn-info">Forward</a>
                            <button class="btn btn-danger" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$inquiry->id, 'cancelled']) }}')">Cancel</button>
                        @endif
                        </div>
                    </div>
                        </div>
                        
                    </div>
                    <h4 class="mb-0 " style="padding-top:9px;">Payment Status : &nbsp;&nbsp; <span class="font-weight-bold badge badge-success">{{$inquiry->is_paid == true ? 'paid' : 'not_paid' }}</span></h4>
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
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Student Name
                        <span class="font-weight-bold">{{$inquiry->user->name}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Child Profile
                        <span class="font-weight-bold">{{$inquiry->child->name ?? "N/A"}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Student Email
                        <span class="font-weight-bold">{{$inquiry->user->email}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Student Phone
                        <span class="font-weight-bold">{{$inquiry->user->phone}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Student Skype ID
                        <span class="font-weight-bold">{{$inquiry->child->skype_id ?? "Not Assigned"}}</span>
                      </li>
                    </ul>
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
                    @if(count($paid_payments) > 0)
                    <h4 class="mt-2 text-center mb-0">Paid Payments</h4>
                    <table class="table table stripped border">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Charge Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paid_payments as $paym)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{\Carbon\Carbon::parse($paym->charge_date)->format('d/m/Y')}}</td>
                                    <td>{{$plan->plan->country->currency}}{{$paym->amount/100}}</td>
                                    <td><span class="font-weight-bold badge badge-success">{{$paym->status}}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
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
            @if(count($inquiry->schedules)>0)
            <div class="card">
                <div class="text-center pt-2">
                    <h4 class="m-0">Class Schedules</h4>
                </div>
                <div class="card-body">
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
           @endif
                        
            
            
            
            
            
            
            @if($inquiry->tutor_id!==null)
                <div class="card">
                <div class="text-center pt-2">
                    <h4 class="m-0">Tutor Detail</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tutor Name
                            <span class="font-weight-bold">{{$inquiry->tutor->name}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tutor Email
                            <span class="font-weight-bold">{{$inquiry->tutor->email}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tutor Phone
                            <span class="font-weight-bold">{{$inquiry->tutor->phone}}</span>
                          </li>
                    </ul>
                    
                    
                    <ul class="nav nav-tabs mt-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" aria-controls="new" role="tab" aria-selected="true"><h5>New Trials</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="regular-tab" data-toggle="tab" href="#regular" aria-controls="regular" role="tab" aria-selected="true"><h5>Regular Classes</h5></a>
                        </li>
                    </ul>
                    
                    
                    <div class="tab-content">
                <div class="tab-pane active" id="new" aria-labelledby="new-tab" role="tabpanel">
                     <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Day</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        @php $co=1; $new_trials=$tutor->tutor_inquiries->where('trial_end_date',null)->where('status','!=','cancelled'); @endphp
                        @foreach($new_trials as $trial)
                            @foreach($trial->schedules as $schedule)
                       
                       
                                <tr>
                               <td>{{$co++}}</td>
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
                       @endforeach
                       
                    </table>
                    </div>
                </div>
                <div class="tab-pane" id="regular" aria-labelledby="regular-tab" role="tabpanel">
                    <table class="table table-bordered table-hover table-sm">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Day</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        
                        @php $c=1; $new_trials=$tutor->tutor_inquiries->where('direct_debit_start_date','!=',null)->where('status','!=','cancelled'); @endphp
                        @foreach($new_trials as $trial)
                            @foreach($trial->schedules as $schedule)
                       
                       
                                <tr>
                               <td>{{$c++}}</td>
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
                       @endforeach
                       
                    </table>
                    </div>
                    </table>
                </div>
            </div>
                </div>
            </div>
            @endif
            
            @if(count($reviews)>0)
            <div class="col-12">
                <div class="card">
                    <div class="text-center pt-2">
                        <h4 class="m-0">Monthly Reviews</h4>
                    </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-striped datatable">
                                <thead class="text-warning">
                                    <th>#</th>
                                    <th>Review Month</th>
                                    <th>Tutor Name</th>
                                    <th>Student Behavior Avg</th>
                                    <th>Student Attention Avg</th>
                                    <th>Student Progress Avg</th>
                                    
                                   
                                </thead>
                                <tbody>
                            
                                @foreach($reviews as $review) 
                                
                                @php $beh=$review->avg('behavior');    @endphp
                                
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{date('F Y',strtotime($review[0]->created_at))}}</td>
                                        <td>{{$review[0]->tutor->name ?? 'N / A'}}</td>
                                        <td>
                                            @for($i = 1; $i <= $beh; $i++)
                                                <i class="fas fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            @for($i = 1; $i <= $review->avg('attention'); $i++)
                                                <i class="fas fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            @for($i = 1; $i <= $review->avg('progress'); $i++)
                                                <i class="fas fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            @endif
            
            
            
            @if(count($inquiry->inquiry_sessions)>0)
                <div class="col-12">
                    <div class="card">
                    <div class="text-center pt-2">
                        <h4 class="m-0">Sessions</h4>
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
                                    @foreach($inquiry->inquiry_sessions as $session)
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
                </div>
            @endif
        </div>
        
        
    </div>
    
    
    
    <div class="modal fade" id="modalStart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Start Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.change.inquiry.start.class', [$inquiry->id, 'started']) }}" method="post">
          @csrf
          <div class="modal-body">
                <div class="form-group">
                    <label>Trial End Date</label>
                    <input type="date" class="form-control" name="trial_end_date" required>
                </div>
                
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
      </form>
      
    </div>
  </div>
</div>
    
        <div class="modal fade" id="modalDebit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Direct Debit Start Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.add.debit.date', [$inquiry->id]) }}" method="post">
          @csrf
          <div class="modal-body">
                <div class="form-group">
                    <label>Direct Debit Start Date</label>
                    <input type="date" class="form-control" name="direct_debit_start_date" required>
                </div>
                
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
      </form>
      
    </div>
  </div>
</div>



@endsection
@section('js')

<script>
    $(document).ready(function(){
       $('.btn-start').click(function(){
           $('#modalStart').modal('show');
       }); 
       $('.debit-date').click(function(){
            $('#modalDebit').modal('show');
       });
    });
</script>





@endsection