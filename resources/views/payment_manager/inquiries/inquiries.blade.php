@extends('payment_manager.layouts.app')
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
        <h4 class="card-title ">Inquiry List</h4>
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
              <th>
                Email
              </th>
              <th>Phone</th>
              <th>
                Plan
              </th>
              <th>
                Status
              </th>
              <th>
                Action
              </th>
            </thead>
            <tbody>
              @foreach ($students as $student)
              <tr>
                <td>
                  {{$student->id}}
                </td>
                <td>
                  {{$student->user->name ?? ''}}
                </td>
                <td>
                  {{$student->user->email ?? ''}}
                </td>
                <td>
                  {{$student->user->phone ?? ""}}
                </td>
                <td>
                  {{$student->plan->name}}
                </td>
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
                <td>
                  <div class="btn-group">
                    @if($student->status=="on_trial")
                    <a href="{{ route('payment_manager.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>
                    @elseif($student->status=="pending")

                    @if(is_null($student->tutor_id))
                    <a href="{{ route('payment_manager.inquiry_forward', [$student->id]) }}" class="btn btn-success">Forward</a>
                    @else
                    <a href="{{ route('admin.shared.schedule.trial.class', [$student->id, 'on_trial']) }}" class="btn btn-warning">Start Trial</a>
                    @endif

                    @endif

                    @if($student->status!="cancelled")
                    <a href="{{ route('payment_manager.change.inquiry.status', [$student->id, 'cancelled']) }}" class="btn btn-danger ">Cancel</a>
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