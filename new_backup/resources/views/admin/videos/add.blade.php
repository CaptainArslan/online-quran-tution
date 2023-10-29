@extends('admin.layouts.app')
@section('title', 'Add Videos')

@section('content')


    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Add Video For Home Page</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.store.video')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Video URL ID</label>
                                    <input type="text" value="https://www.youtube.com/embed/"  class="form-control @error('url') is-invalid @enderror" required name="url" placeholder="https://www.youtube.com/embed/5A2cm_ayeFg">
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
                                    <input type="file"  class="form-control @error('image') is-invalid @enderror" required name="image" >
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-success">Add Video</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endsection
