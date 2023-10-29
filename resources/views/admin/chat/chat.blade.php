@extends('admin.layouts.app')
@section('title', 'Chat')
@section('heading', 'Chat')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="pt-2 text-center">
                <h4>Recent Inquiries</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>
                                #
                            </th>

                            <th>
                                Sender Name
                            </th>

                            <th>
                                Receiver Name
                            </th>
                            <th>
                                Chat Created
                            </th>
                            <th>
                                Action
                            </th>


                        </thead>
                        <tbody>
                            @foreach($conversations as $conversation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $conversation->sender->name ?? 'N/A' }}</td>
                                    <td>{{ $conversation->receiver->name ?? 'N/A' }}</td>
                                    <td>{{ $conversation->created_at->diffForHumans() ?? 'N/A' }}</td>
                                    <td><a href="{{ route('admin.conversation', $conversation->id) }}" class="btn btn-dark">Report</a></td>
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
