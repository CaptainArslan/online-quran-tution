@extends('admin.layouts.app')
@section('title', 'Cancel Subscription List')

@section('content')
    <div class="col-12">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
    <div class="row mb-1">
        <div class="col-sm-6 m-auto">
            <h3>Pending Payments Subscription</h3>
        </div>
        {{--        <div class="col-sm-6 m-auto"> --}}
        {{--            <form method="GET" action="{{route('admin.cancel.subscription')}}" class="filter-form"> --}}
        {{--                <div class="input-group"> --}}
        {{--                    <input type="text" name="from" class="form-control datepicker filter" value="{{ $req->from ?? '' }}" placeholder="From"> --}}
        {{--                    <input type="text" name="to" class="form-control datepicker  filter" value="{{ $req->to ?? '' }}" placeholder="To"> --}}
        {{--                    <select class="form-control filter" name="filter_type"> --}}
        {{--                        <option default selected>Select Filter</option> --}}
        {{--                        <option @if ($req->filter_type) {{$req->filter_type=='daily'?'selected':''}} @endif value="daily">Daily</option> --}}
        {{--                        <option @if ($req->filter_type) {{$req->filter_type=='weekly'?'selected':''}} @endif value="weekly">Weekly</option> --}}
        {{--                        <option @if ($req->filter_type) {{$req->filter_type=='monthly'?'selected':''}} @endif value="monthly">Monthly</option> --}}
        {{--                    </select> --}}
        {{--                    <div class="input-group-append"> --}}
        {{--                        <button type="submit" class="btn btn-primary pl-2 pr-2">Filter</button> --}}
        {{--                        <button type="button" class="btn btn-danger reset pl-1 pr-1">Reset</button> --}}
        {{--                        <a href="{{route('admin.cancelSub.inquiry.export')}}?from={{ $req->from }}&to={{ $req->to }}" class="btn btn-info">Export</a> --}}
        {{--                    </div> --}}
        {{--                </div> --}}
        {{--            </form> --}}
        {{--        </div> --}}
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">List of Pending Payments</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Std Name
                                    </th>
                                    <th>Std Email</th>
                                    <th>Std Phone</th>
                                    <th>
                                        Created
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments->records as $payment)
                                    @php
                                        $i = 1;
                                        $details = getCustomerName($payment->links->mandate);
                                        if (empty($details)) {
                                            continue;
                                        } elseif ($details['status'] != 'pending');
                                    @endphp
                                        <tr>
                                            <td>
                                                {{ $details['id'] ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $details['name'] ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $details['email'] ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $details['phone'] ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $details['created_at'] ?? 'N/A' }}
                                            </td>
                                            <td>
                                                @if ($payment->status == 'cancelled')
                                                    <div class="btn-group">
                                                        <button type="submit"
                                                            onclick="reInitiatePaymentAlert('{{ route('admin.reinitiate.payment', $payment->id) }}')"
                                                            class="btn btn-primary">ReInitiate Payment</button>
                                                    </div>
                                                @elseif ($payment->status == 'pending_submission')
                                                    <div class="btn-group">
                                                        <button type="submit"
                                                            onclick="canclePaymentAlert('{{ route('admin.cancle.payment', $payment->id) }}')"
                                                            class="btn btn-danger">Cancle Payment</button>
                                                    </div>
                                                @else
                                                    <span
                                                        class="@if ($payment->status == 'submitted') badge badge-success
                                                @elseif($payment->status == 'failed') badge badge-warning
                                                @else badge badge-secondry @endif">
                                                        {{ $payment->status ?? 'N/A' }} </span>
                                                @endif
                                            </td>
                                            @php
                                                $i++;
                                            @endphp

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

@section('js')
    <script>
        $('.reset').click(function() {
            var uri = window.location.toString();
            if (uri.indexOf("?") > 0) {
                var clean_uri = uri.substring(0, uri.indexOf("?"));
                window.history.replaceState({}, document.title, clean_uri);
                location.reload();
            }
        });
    </script>

    <script>
        $(document).off('click', '.delete_action').on('click', '.cancel_payment', function(e) {
            let id = $(this).attr('rel');
            e.preventDefault();
            swal({
                title: "Are you sure to cancle the selected Payment?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0,
                closeOnConfirm: false
            }).then(function(e) {
                if (e.value) {
                    $.ajax({
                        type: 'POST',
                        url: "delete",
                        data: {
                            'id': id,
                            "_token": "{{ csrf_token() }}",
                        },
                        async: false,
                        success: function(data) {
                            swal(data?.message);
                            location.reload();
                        },
                        error: function(data) {
                            swal("Error!", data?.message, "danger");
                        }
                    });
                    swal(data?.message);
                }
                if ("cancel" === e.dismiss)
                    swal("Cancelled", "Item is safe :)", "error");
            });
        });
    </script>
@endsection
