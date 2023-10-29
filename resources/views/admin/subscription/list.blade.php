@extends('admin.layouts.app')
@section('title', 'Subscription')

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
                <h4 class="card-title ">Subscription(s)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <th>
                                #
                            </th>
                            <th>
                                Sub. Provider
                            </th>
                            <th>
                                Plan ID
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Created
                            </th>
                            <th>
                                Start date
                            </th>
                            <th>
                                End Date
                            </th>
                            <th>
                                Status
                            </th>

                        </thead>
                        <tbody>
                            @foreach ($subscription as $sub)

                            @if($sub->method == "paypal")
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    <span class="badge badge-info">{{$sub->method}}</span>
                                </td>
                                <td>
                                    {{$sub->paypal_plan_id ?? ''}}
                                </td>
                                <td>
                                    ${{$sub->amount ?? ''}}
                                </td>
                                <td>
                                    {{ date('j F, Y', strtotime($sub->create_date)) }}
                                </td>
                                <td>
                                    {{ date('j F, Y', strtotime($sub->start_date)) }}
                                </td>
                                <td>
                                    @if($sub->end_date  === NULL)
                                        N / A
                                    @else
                                    {{ date('j F, Y', strtotime($sub->end_date)) }}
                                    @endif


                                </td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $sub->status }}
                                    </span>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{$sub->method}}</span>
                                </td>
                                <td>
                                    {{$sub->plan_id ?? ''}}
                                </td>
                                <td>
                                    ${{$sub->amount ?? ''}}
                                </td>
                                <td>
                                    {{ date('j F, Y', strtotime($sub->create_date)) }}
                                </td>
                                <td>
                                    {{ date('j F, Y', strtotime($sub->start_date)) }}
                                </td>
                                <td>
                                    @if($sub->end_date === NULL)
                                        N / A
                                    @else
                                    {{ date('j F, Y', strtotime($sub->end_date)) }}
                                    @endif
                                </td>
                                <td>
                                    @if($sub->status== "cancelled")
                                    <span class="badge badge-danger">
                                        Cancelled
                                    </span>
                                    @else($sub->status=='active')
                                    <span class="badge badge-success text-uppercase">
                                        {{ $sub->status }}
                                    </span>
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
