@extends('admin.layouts.app')
@section('title', 'List of Manager')

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
                <h4 class="card-title ">Payment Manager(s)</h4>
                <a href="{{url('admin/payment_manager')}}" class="btn btn-primary pull-right">+ Add New Manager</a>

            </div>
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
                                Email
                            </th>
                            <th>
                                phone
                            </th>
                            <th>
                                Address
                            </th>
                            <th>
                                Action
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($payment_managers as $st)

                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{$st->name?? ''}}
                                </td>
                                <td>
                                    {{$st->email?? ''}}
                                </td>
                                <td>
                                    {{$st->phone?? ''}}
                                </td>
                                <td>
                                    {{$st->payment_manager->address ?? ''}}
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('admin/payment_manager/'.$st->id ?? '')}}"
                                                class="btn btn-success" style="border-radius: 0.4285rem 0 0 0.4285rem;">View/Edit</a>
                                            <button type="submit" onclick="deleteAlert('{{ route('admin.remove_payment_manager', $st->id) }}')"
                                                class="btn btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    @stop
