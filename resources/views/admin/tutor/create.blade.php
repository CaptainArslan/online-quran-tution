@extends('admin.layouts.app')
@section('title', 'Tutor')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>


     @if( $user_tutor !==null)
     @if($user_tutor->tutor->regular_inquiries>0)
     <div class="row justify-content-center">
         <div class="col-lg-6 col-sm-6 col-12">
            {{-- <div class="card bg-success">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-white">{{number_format($user_tutor->tutor->assign_inquiries/$user_tutor->tutor->regular_inquiries,1)}}</h2>
                            <p class="text-white font-weight-bold">Conversion Rate</p>
                        </div>
                        <div class="avatar bg-white p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-package text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
        </div>
     </div>
     
     @endif
     <div class="row">
    <div class="col-sm-6 ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-info">{{ count($user_tutor->tutor_inquiries)??0 }}</h1>
            <h4 class="font-weight-bolder"> Total Appintment(s)</h4>
          </div>
        </div>
      </div>   
<div class="col-sm-6  ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-success">{{ count($user_tutor->tutor_inquiries->unique('student_id'))??0 }}</h1>
            <h4 class="font-weight-bolder"> Total Student(s)</h4>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-info">{{ count($new) ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total New Trial(s)</h4>
          </div>
        </div>
      </div>
<div class="col-sm-6  ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-success">{{ count($regular) ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total Regular Classes</h4>
          </div>
        </div>
      </div>
      <div class="col-sm-6  ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-info">{{ $total_trials_in_month ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total Trails In A month</h4>
          </div>
        </div>
      </div>
    
      <div class="col-sm-6 ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-success">{{  $paid_students ?? '0'}}</h1>
            <h4 class="font-weight-bolder"> Converted Student(s)</h4>
          </div>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="card text-center">
            <div class="card-body">
                <h1 class="font-weight-bold {{ ($conversion_rate >= 0.5 && $conversion_rate <= 1) ? 'text-success' : 'text-danger' }}">{{ $conversion_rate ?? '0' }}</h1>
                <h4 class="font-weight-bolder">Conversion Rate</h4>
            </div>
        </div>
    </div>


  



</div>
     
     
     
     @endif


<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form mt-5">
    <form class="form" action="{{url('admin/add_tutor')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$user_tutor->id ?? '0'}}" name="id">
        <div class="row match-height">
            <div class="col-12">
                <h4 class="card-title">Create Tutor</h4>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Upload Image</label>
                                        <input type="file" name="avatar" class="dropify" id="image" data-default-file="{{asset($user_tutor->avatar ?? 'uploads/avatar/dummy_image.png')}}">
                                        @error('avatar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document">Upload Document</label>
                                        <input type="file" name="document" class="dropify" id="document" data-default-file="{{asset($tutor->document ?? '')}}">
                                        @error('document')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-label-group">
                                        <input type="text" id="first-name-column" class="form-control" placeholder="Name" name="name" value="{{$user_tutor->name ?? old('name')}}">
                                        <label for="first-name-column">Name</label>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-label-group">
                                        <input type="email" id="last-name-column" class="form-control" placeholder="Email" name="email" value="{{$user_tutor->email ??  old('email')}}">
                                        <label for="last-name-column">Email</label>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-label-group">
                                        <input type="text" id="city-column" class="form-control" placeholder="Phone" name="phone" value="{{$user_tutor->phone ??  old('phone')}}">
                                        <label for="city-column">Phone</label>
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-label-group">
                                        <input type="password" id="country-floating" class="form-control" value="" name="password" placeholder="Password">
                                        <label for="country-floating">Password</label>
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <input type="text" id="company-column" class="form-control" required name="address" value="{{$tutor->address ??  old('address')}}" placeholder="Address">
                                        <label for="company-column">Address</label>
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <textarea type="email" id="email-id-column" class="form-control" placeholder="Tutor Details" name="biography" placeholder="" required>{{$tutor->biography ??  old('biography')}}</textarea>
                                        <label for="email-id-column">Biography</label>
                                        @error('biography')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <input type="text" id="salary" class="form-control" placeholder="Salary" name="salary" placeholder="" value="{{$tutor->salary ??  old('salary')}}" required>
                                        <label for="salary">Salary</label>
                                        @error('salary')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <input type="number" min="0" id="hourly_rate" class="form-control" placeholder="Hourly rate" name="hourly_rate" placeholder="" value="{{$tutor->hourly_rate ??  old('hourly_rate')}}" required>
                                        <label for="salary">Hourly Rate</label>
                                        @error('hourly_rate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-2">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" onclick="history.back();" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</section>

    @if( $user_tutor !==null)
        <section id="multiple-column-form mt-5">
            
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-title p-2 mb-0 font-weight-bold">Tutor's Students</h4>
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Student</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_tutor->tutor_inquiries as $single)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$single->user->name}}</td>
                                            <td>{{$single->user->email}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('admin.shared.edit.inquiry.schedule',$single->id)}}" class="btn btn-primary">Edit Schedule</a>
                                                    <a href="#" onclick="removeTutor('{{route('admin.shared.tutor.remove',$single->id)}}')" class="btn btn-danger">Remove Tutor</a>
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
        </section>
        <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Tutor Inquiries</h4>

            </div>
            <div class="card-body">
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
                    <table class="table table-bordered table-striped datatable table-sm">
                        <thead>
                            <th>
                                ID
                            </th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Description</th>
                            <th>Payment Status</th>
                            <th>Inq. Status</th>
                            <th>Inq.Day</th>
                            <th>Created</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($new as $student)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$student->user->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->email ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->phone ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->inquiry ?? 'N/A'}}
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
                                    <span class="badge badge-info">
                                        Pending {{ $student->tutor ? '(Tutor assigned)' : '' }}
                                    </span>
                                    @elseif($student->status=="started")
                                    <span class="badge badge-success">Started</span>
                                    @elseif($student->status=="cancelled")
                                    <span class="badge badge-danger">Cancel</span>
                                    @else
                                    <span class="badge badge-warning">On Trial</span>
                                    @endif
                                </td>
                                <td>{{$student->getInquiryDay($student['tutor_id'])}}</td>
                                <td width="12%">
                                    {{$student->created_at->diffForHumans()}}
                                </td>
                                <td width="30%">
                                    <div class="btn-group">
                                        <a href="{{route('admin.shared.edit.inquiry.schedule',$student->id)}}" class="btn btn-primary">Edit Schedule</a>
                                        @if($student->status=="on_trial")
                                        <a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>
                                        @elseif($student->status=="pending")

                                        @if(is_null($student->tutor_id))
                                        <a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>
                                        @else
                                        <a href="{{ route('admin.change.inquiry.status', [$student->id, 'on_trial']) }}" class="btn btn-warning">Start Trial</a>
                                        @endif
                                        @endif
                                        @if($student->status!="cancelled")
                                        <a href="#" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')" class="btn btn-danger">Cancel</a>
                                        @endif
                                        <a href="#" onclick="deleteAlert('{{ route('admin.remove.tutor.Inquiry', $student->id) }}')" class="btn btn-dark">Remove Tutor</a>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    </div>
                    <div class="tab-pane" id="regular" aria-labelledby="regular-tab" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable table-sm">
                        <thead>
                            <th>
                                ID
                            </th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Description</th>
                            <th>Payment Status</th>
                            <th>Inq. Status</th>
                            <th>Inq.Day</th>
                            <th>Created</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($regular as $student)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$student->user->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->email ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->phone ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->inquiry ?? 'N/A'}}
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
                                    <span class="badge badge-info">
                                        Pending {{ $student->tutor ? '(Tutor assigned)' : '' }}
                                    </span>
                                    @elseif($student->status=="started")
                                    <span class="badge badge-success">Started</span>
                                    @elseif($student->status=="cancelled")
                                    <span class="badge badge-danger">Cancel</span>
                                    @else
                                    <span class="badge badge-warning">On Trial</span>
                                    @endif
                                </td>
                                <td>{{$student->getInquiryDay($student['tutor_id'])}}</td>
                                <td width="12%">
                                    {{$student->created_at->diffForHumans()}}
                                </td>
                                <td width="30%">
                                    <div class="btn-group">
                                        <a href="{{route('admin.shared.edit.inquiry.schedule',$student->id)}}" class="btn btn-primary">Edit Schedule</a>
                                        @if($student->status=="on_trial")
                                        <a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>
                                        @elseif($student->status=="pending")

                                        @if(is_null($student->tutor_id))
                                        <a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>
                                        @else
                                        <a href="{{ route('admin.change.inquiry.status', [$student->id, 'on_trial']) }}" class="btn btn-warning">Start Trial</a>
                                        @endif
                                        @endif
                                        @if($student->status!="cancelled")
                                        <a href="#" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')" class="btn btn-danger">Cancel</a>
                                        @endif
                                        <a href="#" onclick="deleteAlert('{{ route('admin.remove.tutor.Inquiry', $student->id) }}')" class="btn btn-dark">Remove Tutor</a>
                                        
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
        
        @if(count($user_tutor->schedules)>0)
        <div class="card">
             <div class="card-header card-header-primary">
                <h4 class="card-title ">Schedules</h4>

            </div>
           <div class="card-body">
                <div class="tab-content">
                    <table class="table table-bordered table-striped datatable table-sm">
                        <thead>
                            <th>SR#</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Studnet Name</th>
                            
                        </thead>
                        <tbody>
                            @foreach ($user_tutor->schedules as $schedule)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
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
                                <td>
                                    {{$schedule->time}}
                                </td>
                                <td>{{$schedule->inquiry->user->name}}</td>
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
    
    @endif
<!-- // Basic Floating Label Form section end -->


@stop
