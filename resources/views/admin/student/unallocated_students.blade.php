@extends('admin.layouts.app')
@section('title', 'Unallocated Students List')

@section('content')
    <div class="col-12">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title text-uppercase">Unallocated Students</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover-animation datatable table-sm">
                            <thead>
                                <th>
                                    Main Account
                                </th>
                                <th>
                                    Child
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Skype ID
                                </th>
                                <th>
                                    Skype Assigned At
                                </th>
                                <th>
                                    Assign Skype ID
                                </th>
                                <th>
                                    Created
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($inquiries as $student)
                                    <tr>
                                        <td>
                                            {{ $student->user->name ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $student->child->name ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $student->user->email ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $student->child->skype_id ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $student->child->skype_assigned_at ?? 'N/A' }}
                                        </td>
                                        <td>
                                            <div>
                                                <button class="btn btn-info assignSkypeId" type="button"
                                                    data-user-id="{{ $student->child->id ?? 0 }}">Assign Skype</button>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $student->created_at->diffForHumans() ?? '' }}
                                        </td>
                                        <td class="">
                                            <span
                                                class="@if ($student->status == 'pending') badge badge-info 
                                    @elseif($student->status == 'on_trial') badge badge-secondry 
                                    @elseif($student->status == 'started') badge badge-success
                                    @elseif($student->status == 'cancelled') badge badge-danger
                                    @else badge badge-primary @endif
                                 
                                    ">
                                                {{ $student->status ?? 'N/A' }} </span>
                                        </td>

                                        <td width="25%" class="text-right">
                                            <div class="btn-group">
                                                @if ($student->is_interested == 0)
                                                    <a href="{{ route('admin.inquiry.interest', [$student->id, 1]) }}"
                                                        class="btn btn-success">Interested</a>
                                                    <a href="{{ route('admin.inquiry.interest', [$student->id, 0]) }}"
                                                        class="btn btn-danger">Cancelled</a>
                                                @else
                                                    <a href="{{ route('admin.inquiry.detail', [$student->id]) }}"
                                                        class="btn btn-primary">Detail</a>
                                                @endif


                                                <!--@if ($student->status != 'cancelled')
    -->

                                                <!--    <button class="btn btn-danger" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')">Cancel</button>-->
                                                <!--
    @endif-->
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
    </div>
    <script>
        $(document).ready(function() {
            // Select the button by its id
            var openModalButton = $('.assignSkypeId');

            // Add click event listener
            openModalButton.click(function() {
                var rowId = $(this).data('user-id');
                $('.user_id').val(rowId);
                // Show the modal
                $('.skype_modal').modal('show');
            });
        });
    </script>
@stop
