@extends('admin.layouts.app')
@section('title', 'Inquiry In Detail')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-center mb-1">
                    <table>
                        <tr>
                            <td>
                                <h4>Name</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{$user->name ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Email</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{$user->email ?? ''}}
                            </td>
                        </tr>
                        <tr>

                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-center mb-1">
                    <table>
                        <tr>

                            <td>
                                <h4>Inuqiry</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{$inquiry->inquiry ?? ''}}
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
{{-- <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">

        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                </div>
            </div>
        </div>
    </div> --}}
<h4>Assign Tutor </h4>
<div class="content-body card">
    <!-- DataTable starts -->
    <div class="table-responsive card-body">
        <table class="table data-list-view">
            <thead>
                <tr>
                    <th></th>

                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>STATUS</th>
                    <th>ADDRESS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @if(count($tutors)>0)
                @foreach ($tutors as $tutor)
                <tr>
                    <td></td>
                    <td class="product-name">{{$tutor->name ?? ''}}</td>
                    <td class="product-category">{{$tutor->email ?? ''}}</td>
                    <td>

                        <div>{{$tutor->phone ?? ''}}</div>

                    </td>
                    <td>
                        <div class="chip chip-warning">
                            <div class="chip-body">
                                <?php $tutorstatus = App\Models\User::find($tutor->id)->tutor; ?>
                                <div class="chip-text">{{$tutorstatus->status ?? ''}}</div>
                            </div>
                        </div>
                    </td>
                    <td class="product-price">{{$tutorstatus->address ?? ''}}</td>
                    <td class="product-action">
                        <form action="{{url('payment_manager/create_appointment')}}" method="post">
                            @csrf
                            <input type="hidden" name="student_id" value="{{$user->id ?? ''}}">
                            <input type="hidden" name="tutor_id" value="{{$tutor->id ?? ''}}">
                            <button type="submit" class="btn btn-danger btn-sm">Assign Tutor</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- DataTable ends -->
    @stop