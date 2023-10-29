@extends('admin.layouts.app')
@section('title', 'Videos')

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
                    <h4 class="card-title ">Videos For Home Page</h4>
                    <div class="pull-right">
                        <div class="col-sm-12 m-auto">
                            <a href="{{route('admin.add.video')}}" class="btn btn-primary">+ Add Video Url</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>URL</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($videos as $video)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$video->url}}</td>
                                    <td><img src="{{asset($video->image)}}" alt="video image" style="height: 90px;"></td>
                                    <td>
                                        <a href="{{route('admin.edit.video',$video->id )}}" title="Edit Video"  class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        <a href="{{route('admin.delete.video',$video->id )}}" title="Delete Video" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
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



    @endsection
