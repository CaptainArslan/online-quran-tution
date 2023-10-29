@extends("tutor.layouts.app")
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading', 'Sessions List')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped datatable">
            <thead>
              <th>
                Inquiry ID
              </th>
              <th>
                start_time
              </th>
              <th>
                duration
              </th>
              <th>
                start_url
              </th>
            </thead>
            <tbody>
              @foreach ($in_session as $in)
              <tr>
                <td>
                  {{$in->inquiry_id}}
                </td>
                <td>
                  {{$in->start_time}}
                </td>
                <td>
                  {{$in->duration}}
                </td>
                <td>
                  <a href="{{$in->start_url}}" target="_blank"><button class="btn btn-info">Start Class</button></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @stop
