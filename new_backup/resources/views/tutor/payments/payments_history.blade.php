@extends("tutor.layouts.app")
@section('content')
    @include('admin.partials.success_message')
@section('topbar-heading', 'Payments')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    {{-- <button type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#payout_modal">PayOut</button> --}}
                    <table class="table table-bordered table-striped datatable">
                        <thead>

                        <th>
                            Status
                        </th>
                        <th>
                            Amount To Pay
                        </th>
                        <th>
                            Amount Paid
                        </th>
                        <th>
                            Paid At
                        </th>
                        <th>
                            bonus
                        </th>


                        </thead>
                        <tbody>
                        @isset($pay_outs)
                            @foreach ($pay_outs as $pay)
                                <tr>

                                    <td>
                                        @if($pay->status == 'paid')
                                            <span class="badge badge-success">{{ $pay->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $pay->status }}</span>
                                        @endif

                                    </td>
                                    <td>
                                        {{$pay->amount_to_pay?? ''}}
                                    </td>
                                    <td>
                                        <u><strong>{{$pay->amount_paid?? ''}}</strong></u>
                                    </td>
                                    <td>
                                        {{$pay->paid_at?? ''}}
                                    </td>
                                    <td>{{@$pay->bonus}}</td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
