@extends("student.layouts.app")
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading', 'Previous Classes')
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
              <!-- <th>
               Inquiry ID
              </th> -->
              <th>
              Start Time
              </th>
              <th>
                Duration
              </th>
              <th>
               Join Url
              </th>

            </thead>
            <tbody>
              @foreach ($list as $appointment)

              <tr>
                <td>
                   {{$appointment->id}}
                </td>
                <!-- <td>
                   {{$appointment->inquiry_id}}
                </td> -->
                <td>
                  {{$appointment->start_time}}
                </td>
                <td>
                 {{$appointment->duration}}
                </td>
                <td>
                 <a href="{{$appointment->join_url?? ''}}"><button class="btn btn-info">Join</button></a>
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
