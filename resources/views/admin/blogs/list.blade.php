@extends('admin.layouts.app')
@section('title', 'Blogs List')

@section('content')
{{-- <div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div> --}}

<div class="content-header row">
</div>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
        </div>


        <div class="row">

            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Blogs List</h4>
                        <a href="{{ route('admin.blogs.add') }}" class="btn btn-success pull-right">+ Add Blog</a>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-bordered table-striped datatable">
                            <thead class="text-warning">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>

                            </thead>
                            <tbody>

                                @foreach($blogs as $blog)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$blog->title ?? ''}}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($blog->description ?? '', 165, $end='...') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('admin.blogs.edit',['id'=>$blog->id] )}}"
                                                class="btn btn-warning action_btn">Edit</a>
                                            <button type="button"
                                                onclick="deleteAlert('{{ route('admin.blogs.delete',['id'=>$blog->id] ) }}')" class="btn btn-danger  action_btn del-btn">Delete</button>
                                            @if($blog->visibility == "hidden")
                                            <a href="{{route('admin.blogs.change.visibility', [$blog->id, 'showed'] )}}"
                                                class="btn btn-info action_btn ">Show</a>
                                            @else
                                            <a href="{{route('admin.blogs.change.visibility', [$blog->id, 'hidden'] )}}"
                                                class="btn btn-info action_btn ">Hide</a>
                                            @endif
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