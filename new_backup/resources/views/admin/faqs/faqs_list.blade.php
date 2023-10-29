@extends('admin.layouts.app')
@section('title', 'List Faqs')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

<div class="content-header row">
</div>
<div class="content-body">
    <div class="container-fluid">



        <div class="row">

            <div class=" col-md-12">

                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Faqs</h4>
                        <div class="text-right"><a href="{{route('admin.faqs.add')}}" class="btn btn-success">+ Add
                                Faqs</a></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-bordered table-striped datatable">
                            <thead class="text-warning">
                                <th>ID</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>

                            </thead>
                            <tbody>

                                @foreach($faqs as $faq)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$faq->question ?? ''}}</td>
                                    <td>{{$faq->answer ?? ''}}</td>
                                    <td>


                                        <div class="">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('admin.faqs.edit',['id'=>$faq->id] )}}"
                                                    class="btn btn-primary waves-effect waves-light">Edit</a>
                                                <button type="button"
                                                   onclick="deleteAlert('{{ route('admin.faqs.delete',['id'=>$faq->id] ) }}')" class="btn btn-danger waves-effect waves-light">Delete</button>
                                            </div>
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
</div>
@endsection