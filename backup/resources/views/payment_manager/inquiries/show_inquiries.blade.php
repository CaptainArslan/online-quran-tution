@extends('admin.layouts.app')
@section('title', 'List of Inquiry')
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
                Status
              </th>
              <th>
                Action
              </th>
              <th>
                  Payment Link
                </th>
            </thead>
            <tbody>
              @foreach ($inquiries as $student)
              
              
              @if($student->user)
                <tr>
                <td>
                  {{$loop->iteration}}
                </td>
                <td>
                  {{$student->user->name ?? 'N/A'}}
                </td>
                <td>
                  {{$student->user->email ?? 'N/A'}}
                </td>
                <td>
                  {{$student->user->phone ?? "N/A"}}
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
                    <a href="{{ route('admin.shared.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>
                    @elseif($student->status=="pending")

                    @if(is_null($student->tutor_id))
                    <a href="{{ route('admin.shared.inquiry_forward', [$student->id]) }}" class="btn btn-success">Forward</a>
                    @else
                    <a href="{{route('admin.shared.schedule.trial.class',$student->id)}}" class="btn btn-warning "" >Start Trial</a>
                    @endif

                    @endif

                    @if($student->status!="cancelled")
                    <a href="{{ route('admin.shared.change.inquiry.status', [$student->id, 'cancelled']) }}" class="btn btn-danger ">Cancel</a>
                    @endif
                  </div>
                </td>
                <td>
                    @if($student->is_paid == 1)
                        <span class="badge badge-success">INQUIRY PAID</span>
                    @else
                        <a class="btn btn-info text-white payment-link" data-id="{{ $student->id }}" data-mail="{{ $student->user->email }}">Payment Link</a>
                    @endif
                    
                </td>
              </tr>
              @endif
              
              
              
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>






@stop
@section('js')

    <script>
        $(document).ready(function(){
           $('.schedule-trial').click(function(){
               let id=$(this).data('id');
               $('#inquiry_id').val(id);
               $('#schedule-modal').modal('show');
           }) ;
        });
    </script>

@endsection



