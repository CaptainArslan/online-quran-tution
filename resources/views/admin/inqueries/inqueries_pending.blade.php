@extends('admin.layouts.app')
@section('title', 'Inquiry List')

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
            <div class="card-header">
                <h4>Pending PayPal Inquiries</h4>
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
                            <th>
                                Applied Coupon
                            </th>
                            <th>
                                Amount Paid
                            </th>
                            <th>
                                Payment Status
                            </th>
                            <th>
                                Inq. Status
                            </th>
                            <th>
                                Action
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($inquiries as $student)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$student->user->name ?? ''}}
                                </td>
                                <td>
                                    {{$student->user->email ?? ''}}
                                </td>
                                <td><strong>{{ $student->coupon ?? 'N / A'}}</strong></td>
                                <td><strong>{{ $student->price_paid ?? 'Not Paid'}}</strong></td>
                                

                                <td>
                                    @if($student->is_paid)
                                    <span class="badge badge-success">Paid</span>
                                    @else
                                    <span class="badge badge-danger">Not Paid</span>
                                    @endif
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

                                <td width="20%">
                                    <a class="btn btn-info btn-block text-white payment-link" data-id="{{ $student->id }}" data-mail="{{ $student->user->email }}">Send Payment Link</a>
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

<div class="modal" tabindex="-1" role="dialog" id="mail_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Payment Mail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.inquiries.paypal.mail') }}" method="post">
      <div class="modal-body">
            @csrf
            <input type="text" name="plan_id" placeholder="Enter Paypal Plan ID" class="form-control">
            <input type="hidden" name="email" id="inq_email">
            <input type="hidden" name="inquiry_id" id="inquiry_id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Send Now</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
  </form>
    </div>
  </div>
</div>


@section('js')
    <script>
        $(".payment-link").click(function(){
            $('#mail_modal').modal('show');            
            $('#inq_email').val($(this).attr('data-mail'));
            $('#inquiry_id').val($(this).attr('data-id'));
        });
    </script>
@endsection
@stop
