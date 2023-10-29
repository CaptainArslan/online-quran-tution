@extends('admin.layouts.app')
@section('title', 'Total Payment')

@section('content')
@include('admin.partials.success_message')
<div class="row mt-3 mb-1">
    <div class="col-sm-6 m-auto">
        <h3>Payment</h3>
    </div>
    <div class="col-sm-6 m-auto">
        <form method="GET" action="{{route('admin.pending.payments')}}" class="filter-form">
            <div class="input-group">
                <input type="text" name="from" class="form-control datepicker filter" value="{{ $request->from ?? '' }}" placeholder="From">
                <input type="text" name="to" class="form-control datepicker  filter" value="{{ $request->to ?? '' }}" placeholder="To">
                <input type="hidden" value="{{$request->status ?? ''}}" name="status">
                <div class="input-group-append">
                    <button type="submit" name="filter" value="filter" class="btn btn-primary pl-2 pr-2">Filter</button>
                    <button type="button" class="btn btn-danger reset pl-1 pr-1">Reset</button>
                    <button type="submit" name="export" value="export" class="btn btn-info pl-2 pr-2">Export</button>
                </div>
            </div>
        </form>
    </div>
</div>
<hr class="mt-0">
<div class="row">
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-info">{{count($pay_outs) ?? ""}}</h2>
                        <p class="text-info">Payments</p>
                    </div>
                    <div class="avatar bg-rgba-info p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-alert-octagon text-info font-medium-5"></i>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
{{--    <div class="col-lg-3 col-sm-6 col-12">--}}
{{--        <div class="card">--}}
{{--            <a href="">--}}
{{--                <div class="card-header d-flex align-items-start pb-0">--}}
{{--                    <div>--}}
{{--                        <h2 class="text-bold-700 mb-0 text-primary">--}}
{{--                            Rs {{$pay_outs->sum('amount_to_pay') ?? ""}}</h2>--}}
{{--                        <p class="text-primary">Amount To Pay</p>--}}
{{--                    </div>--}}
{{--                    <div class="avatar bg-rgba-warning p-50 m-0">--}}
{{--                        <div class="avatar-content">--}}
{{--                            <i class="feather icon-alert-octagon text-primary font-medium-5"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-info">Rs {{$pay_outs->sum('bonus') ?? ""}}</h2>
                        <p class="text-info">Bonus Amount</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-alert-octagon text-info font-medium-5"></i>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0 text-success">Rs {{$pay_outs->sum('amount_paid') ?? ""}}</h2>
                        <p class="text-success">Amount Paid</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-alert-octagon text-success font-medium-5"></i>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>
                                    Tutor Name
                                </th>
                                <th>
                                    Tutor Email
                                </th>
                                <th>
                                    Tutor Phone
                                </th>
                                <th>
                                    Manager
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Amount To Pay
                                </th>
                                <th>Bonus</th>
                                <th>
                                    Amount Paid
                                </th>
                                <th>
                                    Paid At
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($pay_outs)
                            @foreach ($pay_outs as $pay)
                            <tr>
                                <td>
                                    {{$pay->tutor->name ?? ""}}
                                </td>
                                <td>
                                    {{$pay->tutor->email ?? ""}}
                                </td>
                                <td>
                                    {{$pay->tutor->phone ?? ""}}
                                </td>
                                <td>
                                    {{$pay->manager->name ?? ""}}
                                </td>
                                <td>
                                    <span class="badge badge-info">{{$pay->status}}</span>
                                </td>

                                <td>
                                    <em>Rs{{$pay->amount_to_pay ?? ''}}</em>
                                </td>
                                <td>Rs{{$pay->bonus ?? "0"}}</td>
                                <td>
                                    <strong><u>Rs{{$pay->amount_paid ?? ''}}</u></strong>
                                </td>
                                <td>
                                    {{$pay->paid_at ?? 'N/A'}}
                                </td>
                                @if($pay->status == "pending")
                                <td>
                                    <button type="button" class="btn btn-warning btn-block payment-btn" payment_id="{{$pay->id}}" data-toggle="modal" data-target="#pay">Pay</button>
                                </td>
                                @endif
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
<!-- The Modal -->
<div class="modal" id="pay">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Payment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{route('admin.payment')}}" class="form form-horizontal">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Payment</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="first-name" class="form-control" name="amount_to_pay" placeholder="Payment Amount" required>
                                        @error('payment_amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br /><br />
                                    <div class="col-md-4">
                                        <span>Bonus</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="first-name" class="form-control" name="bonus" placeholder="Bonus Amount" required>
                                        @error('bonus')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br /><br />
                                    <div class="col-md-4">
                                        <span>Paid At</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" id="first-name" class="form-control" name="paid_at" placeholder="Date" required>
                                        @error('paid_at')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br /><br />

                                    <div class="col-md-4">
                                        <span>Note(Optional)</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="first-name" class="form-control" name="note" placeholder="Note">


                                        @error('note')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <input type="hidden" id="payment_id" name="id">
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop
@section('js')
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
<script>
    $(document).ready(function() {
        $(".payment-btn").click(function() {
            var payment_id = ($(this).attr("payment_id"));
            $('#payment_id').val(payment_id);
        });
    });
    $('.reset').click(function() {
        var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?status={{$request->status ?? ''}}"));
            window.history.replaceState({}, document.title, clean_uri);
            location.reload();
        }
    });
</script>
@endsection
