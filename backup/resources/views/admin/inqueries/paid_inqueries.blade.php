@extends('admin.layouts.app')
@section('title', 'Paid Inquiry List')
@section('heading', 'Paid Inquiries')
@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

<div class="row mb-1">
    <div class="col-sm-12 m-auto">
        <form method="GET" action="{{route('admin.paid_inquiries')}}" class="filter-form">
            <div class="input-group">
                <input type="text" name="from" class="form-control datepicker filter" value="{{ $req->from ?? '' }}" placeholder="From">
                <input type="text" name="to" class="form-control datepicker  filter" value="{{ $req->to ?? '' }}" placeholder="To">
                <select class="form-control filter" name="filter_type">
                    <option default selected>Select Filter</option>
                    <option @if($req->filter_type) {{$req->filter_type=='daily'?'selected':''}} @endif value="daily">Daily</option>
                    <option @if($req->filter_type) {{$req->filter_type=='weekly'?'selected':''}} @endif value="weekly">Weekly</option>
                    <option @if($req->filter_type) {{$req->filter_type=='monthly'?'selected':''}}  @endif  value="monthly">Monthly</option>
                </select>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary pl-2 pr-2">Filter</button>
                    <button type="button" class="btn btn-danger reset pl-1 pr-1">Reset</button>
                    <a href="{{route('admin.paid.inquiry.export')}}?from={{ $req->from }}&to={{ $req->to }}&filter_type={{$req->filter_type}}" class="btn btn-info">Export</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
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
                               Student Email
                            </th>
                            <th>
                               Student Phone
                            </th>
                            <th>
                                Inquiry Status
                            </th>
                            <th>
                                Action
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($data as $student)
                            @if(empty($student->user))
                            
                            @continue
                            @endif
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>{{$student->user->name ?? ''}}</td>
                                <td>{{$student->user->email ?? ''}}</td>
                                <td>{{$student->user->phone ?? ''}}</td>
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
                                <td width="25%">
                                    <div class="btn-group">
                                         @if($student->is_interested == 0)
                                            <a href="{{ route('admin.inquiry.interest', [$student->id, 1]) }}" class="btn btn-success">Interested</a>
                                            <a href="{{ route('admin.inquiry.interest', [$student->id, 0]) }}" class="btn btn-danger">Cancelled</a>
                                            
                                            @else
                                            <a href="{{route('admin.inquiry.detail',[$student->id])}}" class="btn btn-primary">Detail</a>
                                        @endif
                                        
                                        
                                        <!--@if($student->status=="on_trial")-->
                                        <!--<a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}"-->
                                        <!--    class="btn btn-success">Start</a>-->
                                        <!--    @elseif($student->status=="pending")-->

                                        <!--    @if(is_null($student->tutor_id))-->
                                        <!--    <a href="{{ route('admin.forward.inquiry', [$student->id]) }}"-->
                                        <!--        class="btn btn-success">Forward</a>-->
                                        <!--        @else-->
                                        <!--        <a href="{{  route('admin.shared.schedule.trial.class',$student->id) }}"-->
                                        <!--            class="btn btn-warning">Start Trial</a>-->
                                        <!--            @endif-->

                                        <!--            @endif-->

                                                    @if($student->status!="cancelled")
                                                    <button type="button"
                                                    class="btn btn-danger" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')">Cancel</button>
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
            @section('js')
            <script>
               $('.reset').click(function(){
                var uri = window.location.toString();
                if (uri.indexOf("?") > 0) {
                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                    window.history.replaceState({}, document.title, clean_uri);
                    location.reload();
                }
            });
        </script>
        @endsection
