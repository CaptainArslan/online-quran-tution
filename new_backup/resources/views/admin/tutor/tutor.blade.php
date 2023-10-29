@extends('admin.layouts.app')
@section('title', 'Tutor List')
@section('heading', 'Tutors List')
@section('content')
    <div class="col-12">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>



    <div class="card col-md-12">
        <div class="card-header d-flex align-items-start pb-0">
            <div>
                <h2 class="text-bold-700 mb-0 text-dark">
                    Rs.{{ number_format(\App\Models\PayOut::where('status', 'paid')->sum('amount_paid'), 0) }}</h2>
                <p class="text-dark">Total Paid</p>
            </div>
            <div class="avatar bg-rgba-success p-50 m-0">
                <div class="avatar-content">
                    <i class="feather icon-server text-dark font-medium-5"></i>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Tutor(s)</h4>
                    <div class="pull-right">
                        <form method="GET" action="{{ route('admin.tutor_list') }}" class="filter-form">
                            <div class="btn-group">
                                <button type="submit" name="export" value="export"
                                    class="btn btn-info pl-2 pr-2">Export</button>
                                <a href="{{ route('admin.tutor') }}" class="btn btn-primary pull-right">+ Add New
                                    Teacher</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Profile
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Skype ID
                                    </th>
                                    <th>
                                        Conversion Rate
                                    </th>
                                    <th>
                                        phone
                                    </th>
                                    <th>Salary</th>
                                    <th>
                                        Action
                                    </th>
                                    <th>Payout</th>
                                    <th>
                                        Assigned Inquiries
                                    </th>
                                    <th>Doc.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $st)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <img src="{{ asset($st->avatar) }}" style="width:80px; border-radius:100px;">
                                        </td>
                                        <td>
                                            {{ $st->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $st->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $st->skype_id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach ($tutor_data as $tutor)
                                                @if ($tutor['tutor_id'] == $st->id)
                                                    {{ $tutor['conversion_rate'] }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $st->phone ?? '' }}
                                        </td>
                                        <td>Rs{{ $st->tutor->salary ?? '0' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ url('admin/tutor/' . $st->id ?? '') }}"
                                                    class="btn btn-primary">View/Edit</a>
                                                <button type="button"
                                                    onclick="deleteAlert('{{ route('admin.remove_tutor', $st->id) }}')"
                                                    class="btn btn-danger">Delete</button>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tutor.payout', $st->id) }}"
                                                class="btn btn-info">Payout</a>
                                        </td>
                                        <td width="15%">
                                            <a href="{{ route('admin.tutor.inquiries', $st->id) }}"
                                                class="btn btn-success">Inquiries</a>
                                        </td>
                                        <td class="text-center">
                                            @if (isset($st->tutor->document))
                                                <a href="{{ asset($st->tutor->document) }}" target="_blank"
                                                    title="Download Documents"><i
                                                        class="fas fa-file fa-2x text-info"></i></a>
                                            @else
                                                <span class="badge badge-danger">N/A</span>
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
