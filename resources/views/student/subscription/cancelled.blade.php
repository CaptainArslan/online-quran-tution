@extends('student.layouts.app')
@section('css')

@endsection
@section('content')
@section('topbar-heading', 'Cancelled Subscription List')
<div class="col-12">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</div>
<div class="row mb-1">
    <div class="col-sm-6 m-auto">
        <h3>Cancelled Payments Subscription</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">List of Cancelled Payments</h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Payment Method
                                </th>
                                <th>Plan Name</th>
                                <th>Plan Amount</th>
                                <th>
                                    Created At
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($payments))
                                @foreach ($payments->records as $payment)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-primary">{{ $subscription->method ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            {{ $payment->description ?? 'N/A' }}
                                        </td>
                                        <td>
                                            <span class="badge badge-square badge-warning px-2">£
                                                {{ $payment->amount / 100 ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <?php
                                            $datetime = new DateTime($payment->created_at);
                                            $date = $datetime->format('d-m-Y');
                                            ?>
                                            {{ $date ?? 'N/A' }}
                                        </td>
                                        <td>
                                            <button type="submit"
                                                onclick="reInitiatePaymentAlert('{{ route('student.reinitiate.payment', $payment->id) }}')"
                                                class="btn btn-primary px-1">ReInitiate Payment</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')

@endsection
