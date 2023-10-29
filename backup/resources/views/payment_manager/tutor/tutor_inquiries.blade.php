@extends('admin.layouts.app')
@section('content')
@section('topbar-heading', 'Tutor Inquiries')
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable table-sm">
                        <thead>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($inquiries as $student)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$student->user->name ?? ''}}
                                </td>
                                <td>
                                    {{$student->user->email ?? ''}}
                                </td>
                                </td>
                                </td>
                                <td width="15%">
                                    {{$student->created_at->diffForHumans()}}
                                </td>
                                <td>
                                     <a href="{{route('admin.shared.edit.inquiry.schedule',$student->id)}}" class="btn btn-primary">Edit Schedule</a>
                                     <a href="#" onclick="removeTutor('{{route('admin.shared.tutor.remove',$student->id)}}')" class="btn btn-danger">Remove Tutor</a>
                             <!--   <a href="#" onclick="deleteAlert('{{ route('admin.remove.tutor.Inquiry', $student->id) }}')" class="btn btn-dark">Remove Student</a> -->
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



<!-- The Modal -->
<div class="modal" id="salary_model">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Salary</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{route('admin.shared.tutor.salary')}}" class="form form-horizontal">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Salary Amount</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="first-name" class="form-control" name="salary" placeholder="Add Salary" required>
                                        <input type="hidden" id="tutor_id" name="tutor_id">
                                        @error('salary')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
    @stop
    @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".tutor-btn").click(function() {
                var tutor_id = ($(this).attr("tutor_id"));
                $('#tutor_id').val(tutor_id);
            });
        });
    </script>

    @endsection