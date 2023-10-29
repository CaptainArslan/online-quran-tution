@extends('admin.layouts.app')
@section('title', 'Forward Inquiry')

@section('content')
@include('admin.partials.success_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="text-center pt-2">
                <h4 class="m-0">Forward Inquiry</h4>
            </div>
            <div class="card-body">
                
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Student Name
                    <span class="font-weight-bold">{{ $user->name ?? 'N/A' }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Student Email
                    <span class="font-weight-bold">{{ $user->email ?? 'N/A' }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Student Phone
                    <span class="font-weight-bold">{{ $user->phone ?? 'N/A' }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Student Skype ID
                    <span class="font-weight-bold">{{ $user->skype_id ?? 'N/A' }}</span>
                  </li>
                </ul>
                
                
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Assign Tutor </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tutors as $tutor)
                            <tr>
                                <td class="product-name">{{$tutor->name ?? ''}}</td>
                                <td class="product-category">{{$tutor->email ?? ''}}</td>
                                <td>{{$tutor->phone ?? ''}}</td>
                                <td class="product-action">
                                    <form action="{{url('admin/create_appointment')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="inquiry_id" value="{{$id}}">
                                        <input type="hidden" name="student_id" value="{{$user->id}}">
                                        <input type="hidden" name="tutor_id" value="{{$tutor->id}}">
                                        <button type="submit" class="btn btn-dark">Assign Tutor</button>
                                    </form>
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
