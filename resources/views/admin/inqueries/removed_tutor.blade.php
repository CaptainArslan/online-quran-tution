@extends('admin.layouts.app')
@section('title', 'Students not allocated Teachers')

@section('heading', 'Students not allocated Teachers')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

<div class="row mb-1">


</div>
<div class="row">
    <div class="col-md-12">
       
        <div class="card">
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
                            <table class="table table-bordered table-striped datatable">
                        <thead>
                            <th>
                                ID
                            </th>
                            <th>
                                Student Name
                            </th>
                            <th>
                                Child Profile
                            </th>
                            <th>
                                Mobile
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Skype ID
                            </th>
                            <th>
                                Skype Assigned At
                            </th>
                            {{--<th>Tutor Name</th>
                            <th>Tutor Email</th>
                            <th>Tutor Phone</th>--}}
                            <th>
                                Inquiry Status
                            </th>
                            <th>
                                Action
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($new as $student)
                            @if(empty($student->user))
                            @continue
                            @endif
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    <a href="{{--@if($student->status!=='pending') {{route('admin.student.edit.schedule',$student->id)}} @else # @endif --}}#" title="Edit Schedule"> {{$student->user->name ?? 'N / A'}}</a>
                                </td>
                                <td>
                                    {{$student->child->name ?? 'N / A'}}
                                </td>
                                <td>
                                    {{$student->user->phone ?? 'N / A'}}
                                </td>
                                <td>
                                    {{$student->user->email ?? 'N / A'}}
                                </td>
                                <td>
                                    {{$student->user->skype_id ?? 'N / A'}}
                                </td>
                                <td>
                                    {{$student->user->skype_assign_at ?? 'N / A'}}
                                </td>
                                {{--<td>@if(!empty($student->tutor)) {{$student->tutor->name ?? ''}} @endif</td>
                                <td>@if(!empty($student->tutor)) {{$student->tutor->email ?? ''}} @endif</td>
                                <td>@if(!empty($student->tutor)) {{$student->tutor->phone ?? ''}} @endif</td>--}}

                                <td width="20%">
                                    @if($student->status=="pending")
                                    <span class="badge badge-info">
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
                                <td>
                                    <div class="btn-group">
                                        
                                        
                                       <!--     <a href="{{route('admin.inquiry.detail',[$student->id])}}" class="btn btn-primary">Detail</a> -->
                                       <a href="{{route('admin.assign.tutors.list',[$student->id])}}" class="btn btn-primary">Assign Tutor</a>
                                        
                                        <!--@if($student->status=="on_trial")-->
                                        <!--<a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>-->
                                        <!--@elseif($student->status=="pending")-->

                                        <!--@if(is_null($student->tutor_id))-->
                                        <!--<a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>-->
                                        <!--@else-->
                                        <!--<a href="{{ route('admin.shared.schedule.trial.class',$student->id) }}" class="btn btn-warning">Start Trial</a>-->
                                        <!--@endif-->

                                        <!--@endif-->

                                        <!--@if($student->status!="cancelled")-->
                                        <!--<button type="button" class="btn btn-danger" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')">Cancel</button>-->
                                        <!--@endif-->
                                        <button type="button" class="btn btn-dark" onclick="deleteAlert('{{ route('admin.inquiry.delete', $student->id) }}')">Delete</button>

                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="regular" aria-labelledby="regular-tab" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable">
                        <thead>
                            <th>
                                ID
                            </th>
                            <th>
                                Student Name
                            </th>
                            <th>
                                Mobile
                            </th>
                            <th>
                                Email
                            </th>
                            {{--<th>Tutor Name</th>
                            <th>Tutor Email</th>
                            <th>Tutor Phone</th>--}}
                            <th>
                                Inquiry Status
                            </th>
                            <th>
                                Action
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($regular as $student)
                            @if(empty($student->user))
                            @continue
                            @endif
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    <a href="{{--@if($student->status!=='pending') {{route('admin.student.edit.schedule',$student->id)}} @else # @endif --}}#" title="Edit Schedule"> {{$student->user->name ?? 'N / A'}}</a>
                                </td>
                                <td>
                                    {{$student->user->phone ?? 'N / A'}}
                                </td>
                                <td>
                                    {{$student->user->email ?? 'N / A'}}
                                </td>
                                {{--<td>@if(!empty($student->tutor)) {{$student->tutor->name ?? ''}} @endif</td>
                                <td>@if(!empty($student->tutor)) {{$student->tutor->email ?? ''}} @endif</td>
                                <td>@if(!empty($student->tutor)) {{$student->tutor->phone ?? ''}} @endif</td>--}}

                                <td width="20%">
                                    @if($student->status=="pending")
                                    <span class="badge badge-info">
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
                                <td>
                                    <div class="btn-group">
                                        
                                        
                                       <!--     <a href="{{route('admin.inquiry.detail',[$student->id])}}" class="btn btn-primary">Detail</a> -->
                                       <a href="{{route('admin.assign.tutors.list',[$student->id])}}" class="btn btn-primary">Assign Tutor</a>
                                        
                                        <!--@if($student->status=="on_trial")-->
                                        <!--<a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>-->
                                        <!--@elseif($student->status=="pending")-->

                                        <!--@if(is_null($student->tutor_id))-->
                                        <!--<a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>-->
                                        <!--@else-->
                                        <!--<a href="{{ route('admin.shared.schedule.trial.class',$student->id) }}" class="btn btn-warning">Start Trial</a>-->
                                        <!--@endif-->

                                        <!--@endif-->

                                        <!--@if($student->status!="cancelled")-->
                                        <!--<button type="button" class="btn btn-danger" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')">Cancel</button>-->
                                        <!--@endif-->
                                        <button type="button" class="btn btn-dark" onclick="deleteAlert('{{ route('admin.inquiry.delete', $student->id) }}')">Delete</button>

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
</div>
@stop
@section('js')
<script>
    $('.reset').click(function() {
        var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
            location.reload();
        }
    });
</script>
@endsection
