@extends("student.layouts.app")
@section('content')
@include('admin.partials.success_message')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Appointments</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped datatable">
            <thead>
              <th>
                Student ID
              </th>
              <th>
               Inquiry
              </th>
              <th>
              Tutor ID
              </th>
              <th>
                Payment status
              </th>
              <th>
                Status
              </th>
              <th>
                From
              </th>
              <th>
                To
              </th>
              <th>
              Action
              </th>
              
            </thead>
            <tbody>
              @foreach ($inquiry as $appointment)
              <tr>
                <td>
                   {{$appointment->student_id}}
                </td>
                <td>
                   {{$appointment->inquiry}}
                </td>
                <td>
                  {{$appointment->tutor_id}}
                </td>
                <td>
                  @if($appointment->is_paid)
                  <span class="badge badge-success">Yes</span>
                  @else
                  <span class="badge badge-danger">No</span>
                  @endif
                </td>
                <td>
                  {{$appointment->status?? ''}}
                </td>
                <td>
                  {{$appointment->from?? ''}}
                </td>
                <td>

                  {{$appointment->to?? ''}}
                </td>
                <td>
                <a href="{{route('student.session',['id'=>$appointment->id])}}"><button class="btn btn-info">Session</button></a>
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