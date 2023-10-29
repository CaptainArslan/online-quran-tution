@extends('admin.layouts.app')
@section('title', 'Tutor Schedules')
@section('heading','Tutor Schedules')
@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success mb-2">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

    <div class="row">
        <div class="col-lg-12 text-right mb-2">
            <a href="{{route('admin.assign.inquiry.tutor',['inquiry'=>$inquiry,'tutor_id'=>$tutor->id])}}" class="text-right btn btn-primary" >Assign Tutor</a>
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
                        Student Email
                        <span class="font-weight-bold">{{$inquiry->user->email}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Student Phone
                        <span class="font-weight-bold">{{$inquiry->user->phone}}</span>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12">
            @if($tutor!==null)
                <div class="card">
                <div class="text-center pt-2">
                    <h4 class="m-0">Tutor Detail</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tutor Name
                            <span class="font-weight-bold">{{$tutor->name}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tutor Email
                            <span class="font-weight-bold">{{$tutor->email}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tutor Phone
                            <span class="font-weight-bold">{{$tutor->phone}}</span>
                          </li>
                    </ul>
                    
                    @if(count($schedules)>0)
                    <h3 class="text-center mt-3">Tutor Schedules</h3>
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Day</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        @foreach($schedules as $schedule)
                        
                       
                       
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
                       
                    </table>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        
    </div>
    
    
    
    @endsection
        
        