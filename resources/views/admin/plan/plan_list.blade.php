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
        <h4 class="card-title ">List of Plan</h4>
        <a href="{{route('admin.plan_add_form')}}" class="btn btn-primary pull-right">+ Add New Plan</a>

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
                Price
              </th>
              <th>
                Discount
              </th>
              <th>
                Week Days
              </th>
              <th>
                Monthly class
              </th>
              <th>
                Duration
              </th>
              <th>
                Price Per Month
              </th>
              <th>
                Country Name
              </th>
              <th>
                Action
              </th>
            </thead>
            <tbody>
              @foreach ($plan as $st)
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{$st->name}}
                </td>
                <td>
                  {{$st->price}}
                </td>
                <td>
                  {{$st->discount}}
                </td>
                <td>

                  {{$st->days_in_week}}
                </td>
                <td>{{$st->classes_in_month}}</td>
                <td>{{$st->duration}}</td>
                <td>{{$st->price_per_month}}</td>
                <td>{{$st->country->name}}</td>
                <td>
                  <a href="{{route('admin.plan_edit',['id'=>$st->id])}}"><button class="btn btn-info">Edit</button></a>
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
