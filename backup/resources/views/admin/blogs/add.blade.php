@extends('admin.layouts.app')
@section('title', 'Add Blog')
@section('css')

<link href="{{asset('admin_theme/summarnote/summernote.min.css')}}" rel="stylesheet">
@endsection
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
    <div class="col-12">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        @if (count($errors) > 0)
                            <div class="col-sm-12 mb-3 data-field-col">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add Blog</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.blogs.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title"
                                        value="{{old('meta_title')}}">
                                    @if($errors->has('meta_title'))
                                    {{ $errors->first('meta_title') }}
                                    @endif
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta keywords</label>
                                    <input type="text" class="form-control" name="meta_keywords"
                                        value="{{old('meta_keywords')}}">
                                    @if($errors->has('meta_keywords'))
                                    {{ $errors->first('meta_keywords') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Meta Description*</label>
                                    <textarea type="text" rows="2" cols="8" class="form-control" name="meta_description"
                                        >{!! old('meta_description') !!}</textarea>
                                    @if($errors->has('meta_description'))
                                    {{ $errors->first('meta_description') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="title" value="{{old('title')}}">
                                    @if($errors->has('title'))
                                    {{ $errors->first('title') }}
                                    @endif
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image<span class="text-danger">*</span></label>
                                    <input type="file"  required  class="form-control dropify" name="image"
                                        value="{{old('image')}}">
                                    @if($errors->has('image'))
                                    {{ $errors->first('image') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Written By</label>
                                    <input type="text" class="form-control" name="written_by"
                                        value="{{old('written_by')}}">
                                    @if($errors->has('written_by'))
                                    {{ $errors->first('written_by') }}
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description*</label>
                                    <textarea type="text"    id="summernote" class="form-control" name="description"
                                        >{!! old('description') !!}</textarea>
                                    @if($errors->has('description'))
                                    {{ $errors->first('description') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        





                        <button type="submit" class="btn btn-primary pull-left">Save</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')


    

    <script src="{{asset('admin_theme/summarnote/summernote.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote();
            $('.summernoteedit').summernote();
        });
    </script>
    @endsection