@extends('student.layouts.app')
@section('css')

@endsection
@section('content')
    @include('admin.partials.success_message')
@section('topbar-heading', 'Children List')
<div class="col-12">
</div>
<div class="row">
    <div class="col-md-12 pull-right">
        <div class="mb-5">
            <a href="{{ route('student.add.children') }}" class="btn btn-primary pull-right">+ Add New Children</a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <th>
                                #
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Age
                            </th>
                            <th>
                                Payment Status
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Schedual
                            </th>
                            <th>
                                Actions
                            </th>

                        </thead>
                        <tbody>
                            @foreach ($children as $child)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $child->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $child->age ?? '' }}
                                    </td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{ $child->inquiry->is_paid == 0 ? 'Unpaid' : 'paid' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($child->inquiry->status == 'pending')
                                            <span class="badge badge-danger">
                                                {{ $child->inquiry->status }}
                                            </span>
                                        @else
                                            <span class="badge badge-success text-uppercase">
                                                {{ $child->inquiry->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="buttonDiv">
                                            <a class="btn btn-success"
                                                href="{{ route('student.child.schedule', ['id' => base64_encode($child->id)]) }}">View Schedule</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="buttonDiv d-flex justify-content-around align-items-center">
                                            <a href="{{ route('student.update.children', ['id' => base64_encode($child->id)]) }}"><i class="feather icon-edit" style="font-size: 24px; color: royalblue"></i></a>
                                            <a onclick="deleteAlert('{{ route('student.delete.children', $child->id) }}')"><i class="feather icon-trash-2" style="font-size: 24px; color: royalblue"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Login to yours child account</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="contactForm" method="post" action="{{ route('student.child.login') }}">
                                        @csrf
                                        <input type="hidden" class="child_id" name="child_id" value="">
                                        <div class="form-group">
                                            <label>Enter Your Email</label>
                                            <input type="text"
                                                class="form-control borderBottomClass @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" id="email"
                                                autocomplete="email" autofocus placeholder="Email" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Enter Your Password</label>
                                            <input type="password"
                                                class="form-control borderBottomClass @error('password') is-invalid @enderror"
                                                name="password" autocomplete="current-password" id="password"
                                                placeholder="Password" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" style="border-radius: 2px;">
                                        </div>
                                        {{-- <button type="submit" class="btn btn-primary">Login</button> --}}
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.openModalButton').click(function() {
            var rowId = $(this).data('child-id');
            $('.child_id').val(rowId);
            // Show the modal
            $('.modal').modal('show');
        });
    });
</script>

@stop
