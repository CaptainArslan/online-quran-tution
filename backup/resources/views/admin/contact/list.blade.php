@extends('admin.layouts.app')
@section('title', 'List of Plan')

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
        <h4 class="card-title ">List of Contact Messages</h4>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped datatable">
            <thead>
              <th>
                ID
              </th>
              <th>
                Name
              </th>
              <th>
                Email
              </th>
              <th>
                Subject
              </th>
              <th>
                Message
              </th>
            </thead>
            <tbody>
              @foreach ($list as $st)
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{$st->name}}
                </td>
                <td>
                  {{$st->email}}
                </td>
                <td>

                  {{$st->subject}}
                </td>
                <td>{{$st->message}}</td>
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