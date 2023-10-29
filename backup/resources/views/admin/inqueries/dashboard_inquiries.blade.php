@extends('admin.layouts.app')
@section('title', 'Inquiry List')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title text-uppercase"><strong class="text-success">{{ $request->q ?? '' }}</strong> Inquiries</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover-animation datatable table-sm">
                        <thead>
                            <th>
                                Student Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Created
                            </th>
                            <th>
                                Status
                            </th>
                            
                            <th>
                                Action
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($inquiries as $student)
                            <tr>
                                <td>
                                    {{$student->user->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->email ?? 'N/A'}}
                                </td>
                                <td>
                                    {{ $student->created_at->diffForHumans()  ?? ''}}
                                </td>
                                <td class="">
                                    <span class="@if($student->status=='pending')badge badge-info 
                                    @elseif($student->status=='on_trial') badge badge-secondry 
                                    @elseif($student->status=='started') badge badge-success
                                    @elseif($student->status=='cancelled') badge badge-danger
                                    @else badge badge-primary
                                    @endif
                                 
                                    "> {{$student->status ?? 'N/A'}} </span> 
                                </td>

                                <td width="25%" class="text-right">
                                    <div class="btn-group">
                                        @if($student->is_interested == 0)
                                            <a href="{{ route('admin.inquiry.interest', [$student->id, 1]) }}" class="btn btn-success">Interested</a>
                                            <a href="{{ route('admin.inquiry.interest', [$student->id, 0]) }}" class="btn btn-danger">Cancelled</a>
                                            
                                            @else
                                            <a href="{{route('admin.inquiry.detail',[$student->id])}}" class="btn btn-primary">Detail</a>
                                        @endif
                                        
                                        
                                        <!--@if($student->status!="cancelled")-->
                                    
                                        <!--    <button class="btn btn-danger" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')">Cancel</button>-->
                                        <!--@endif-->

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
