@extends('admin.layouts.app')
@section('title', 'Failed Inquiry List')

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
                <h4 class="card-title ">List of Failed Inquiry</h4>

            </div>
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
                            <th>Tutor Name</th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Created
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$student->user->name ?? ''}}
                                </td>
                                <td>
                                    @if(!empty($student->tutor->name))
                                        {{$student->tutor->name ?? ""}}
                                    @else
                                        N / A
                                    @endif
                                    
                                </td>
                                <td>
                                    {{$student->user->email ?? ''}}
                                </td>
                                <td>
                                    {{$student->user->phone ?? 'N / A'}}
                                </td>
                                <td>
                                    {{$student->created_at ?? ""}}
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
