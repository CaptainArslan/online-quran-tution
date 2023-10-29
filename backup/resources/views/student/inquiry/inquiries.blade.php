@extends("student.layouts.app")
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading', 'My Inquiries')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <th>
                                #
                            </th>
                            <th>
                                Inq. Status
                            </th>
                            <th>
                                Payment Status
                            </th>
                            <th width="22%">
                                Action
                            </th>

                        </thead>
                        <tbody>
                            @foreach ($inquiries->sortByDesc("id") as $appointment)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$appointment->status?? ''}}
                                </td>
                                <td>
                                    @if($appointment->is_paid)
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-danger">Not Paid</span>
                                    @endif
                                </td>
                                <td width="25%" class="text-center">
                                    @php
                                        $diff = \Carbon\Carbon::now()->diffInDays($appointment->created_at);
                                    @endphp

                                    @if($diff < 3)

                                        @if($appointment->is_paid)
                                            @if($appointment->status == "pending")
                                            <span class="badge badge-warning">Inquiry Schedule Pending</span>
                                            @else
                                                <a href="{{route('student.session',['id'=>base64_encode($appointment->id)])}}" class="btn btn-success btn-block font-weight-bold">View Schedule</a>
                                            @endif
                                        @else
                                            @if($appointment->payment_method != null)
                                                <span class="badge badge-info">Check Your Mailbox for payment</span>
                                            @else
                                                <a href="{{ route('student.payments.index', ['id' => base64_encode($appointment->id)]) }}" class="btn btn-primary btn-block font-weight-bold">Pay Inquiry</a>
                                            @endif

                                        @endif

                                    @else
                                        <span class="badge badge-success mb-2">You are in trial</span>
                                        @if($appointment->status == "pending")
                                            <span class="badge badge-warning">Inquiry Schedule Pending</span>
                                            @else
                                                <a href="{{route('student.session',['id'=>base64_encode($appointment->id)])}}" class="btn btn-success btn-block font-weight-bold">View Schedule</a>
                                            @endif
                                    @endif
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
