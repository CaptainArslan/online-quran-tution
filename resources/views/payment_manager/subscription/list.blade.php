@extends('payment_manager.layouts.app')
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading', 'Subscription List')
<div class="col-12">
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
                                Name
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Create
                            </th>
                            <th>
                                Mandate ID
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Start date
                            </th>
                            <th>
                                End Date
                            </th>
                            <th>
                                Count
                            </th>
                            <th>
                                Customer ID
                            </th>
                            <th>
                                Subscription Id
                            </th>
                            <th>
                                User Id
                            </th>
                            <th>
                                Plan ID
                            </th>
                            <th>
                                Inquiry ID
                            </th>

                        </thead>
                        <tbody>
                            @foreach ($subscription as $sub)
                            <tr>
                                <td>
                                    {{$sub->id}}
                                </td>
                                <td>
                                    {{$sub->subscription_name ?? ''}}
                                </td>
                                <td>
                                    {{$sub->amount ?? ''}}
                                </td>
                                <td>
                                    {{$sub->create_date}}
                                </td>
                                <td>
                                    {{$sub->mandate}}
                                </td>
                                <td>
                                    @if($sub->status== "cancelled")
                                    <span class="badge badge-danger">
                                        cancelled
                                    </span>
                                    @elseif($sub->status=='active')
                                    <span class="badge badge-succcess">
                                        active
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    {{$sub->start_date ?? ''}}
                                </td>
                                <td>
                                    {{$sub->end_date}}
                                </td>
                                <td>
                                    {{$sub->count}}
                                </td>
                                <td>
                                    {{$sub->customer_id ?? ''}}
                                </td>
                                <td>
                                    {{$sub->subscription_id ?? ''}}
                                </td>
                                <td>
                                    {{$sub->user_id}}
                                </td>
                                <td>
                                    {{$sub->plan_id}}
                                </td>
                                <td>
                                    {{$sub->inquiry_id}}
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
