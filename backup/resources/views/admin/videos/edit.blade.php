@extends('admin.layouts.app')
@section('title', 'Edit Videos')

@section('content')


    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Edit Video For Home Page</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.update.video')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$video->id}}">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Video URL ID</label>
                                    <input type="text" value="{{$video->url}}"  class="form-control @error('url') is-invalid @enderror" required name="url" placeholder="https://www.youtube.com/embed/5A2cm_ayeFg">
                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" value="{{$video->image}}"  class="form-control @error('image') is-invalid @enderror"  name="image" >
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-success">Update Video</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

