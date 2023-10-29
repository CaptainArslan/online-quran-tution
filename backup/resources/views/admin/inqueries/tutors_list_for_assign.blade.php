@extends('admin.layouts.app')
@section('title', 'Tutor List')

@section('content')
<div class="col-12">
  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif
  @if(session()->has('error'))
  <div class="alert alert-danger">
    {{ session()->get('error') }}
  </div>
  @endif
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-striped datatable">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                  Profile
                </th>
                <th>
                  Name
                </th>
                <th>
                  Email
                </th>
                <th>
                  phone
                </th>
                
                
                <th>
                  Action
                </th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($tutors as $st)
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  <img src="{{ asset($st->avatar) }}" style="width:80px; border-radius:100px;">
                </td>
                <td>
                  {{$st->name ?? ''}}
                </td>
                <td>
                  {{$st->email ?? ''}}
                </td>
                <td>
                  {{$st->phone ?? ''}}
                </td>
                
            
                <td width="15%">
                  <a href="{{ route('admin.inquiry.tutor_schedules', ['inquiry'=>$inquiry,'tutor_id'=>$st->id]) }}" class="btn btn-success">Tutor Schedules</a>
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