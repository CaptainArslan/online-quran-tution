@extends('admin.layouts.app')
@section('title', 'Ticket(s)')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>



<div class="">

    <div class="row">
        <div class="col-sm-12">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="text-center pt-2 ">
                        <h2>Inquiry Tickets</h2>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Open</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="bookings" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">Closed</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                                <section id="basic-datatable">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body card-dashboard">
                                                        <div class="table-responsive">
                                                            <table class="table zero-configuration table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Enquiry Type</th>
                                                                        <th>Ticket ID</th>
                                                                        <th>From</th>
                                                                        <th>Phone</th>
                                                                        <th>Subject</th>
                                                                        <th>Last Updated</th>
                                                                        <th class="text-right">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($open_tickets as $ot)
                                                                    <tr>
                                                                        <td>{{ $ot->enquiry_type }}</td>
                                                                        <td><span class="font-weight-bold text-primary" style="font-style:italic; display:block;">#{{ $ot->ticket_id }}</span></td>
                                                                        <td>{{ $ot->user->email }}</td>
                                                                        <td>{{ $ot->user->phone }}</td>
                                                                        <td> {{ $ot->subject }}</td>
                                                                        <td>{{ $ot->updated_at }}</td>
                                                                        <td class="pull-right">
                                                                            <a href="{{ route('admin.support.enquiry_detail', $ot->ticket_id) }}" class="btn btn-primary">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                                                            </a>
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
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                <section id="basic-datatable">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body card-dashboard">
                                                        <div class="table-responsive">
                                                            <table class="table zero-configuration table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Enquiry Type</th>
                                                                        <th>Ticket ID</th>
                                                                        <th>From</th>
                                                                        <th>Phone</th>
                                                                        <th>Subject</th>
                                                                        <th>Ticket ID</th>
                                                                        <th class="text-right">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($close_tickets as $ct)
                                                                    <tr>
                                                                        <td>{{ $ct->enquiry_type }}</td>
                                                                        <td><span class="font-weight-bold text-primary" style="font-style:italic; display:block;">#{{ $ct->ticket_id }}</span></td>
                                                                        <td>{{ $ct->user->email ?? ""}}</td>
                                                                        <td>{{ $ct->user->phone ?? ""}}</td>
                                                                        <td> {{ $ct->subject }}</td>
                                                                        <td>{{ $ct->updated_at }}</td>
                                                                        <td>

                                                                        <td>
                                                                            <a href="{{ route('admin.support.enquiry_detail', $ct->ticket_id) }}" class="btn btn-primary">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                                                            </a>
                                                                        </td>
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
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@stop