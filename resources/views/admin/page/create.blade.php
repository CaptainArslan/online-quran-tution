@extends('admin.layouts.app')
@section('title', 'Add Pages')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Page</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{url('admin/add_page')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Name" name="heading" value="{{$page->heading ?? ''}}">
                                            <label for="first-name-column">Heading</label>
                                            @error('heading')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="last-name-column" class="form-control" placeholder="Title" name="title" value="{{$page->title ?? ''}}">
                                            <label for="last-name-column">Title</label>
                                            @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="city-column" class="form-control" placeholder="Meta Title" name="meta_title" value="{{$page->meta_title ?? ''}}">
                                            <label for="city-column">Meta Title</label>
                                            @error('meta_title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="country-floating" class="form-control" value="{{$page->meta_desc ?? ''}}" name="meta_desc" placeholder="Meta Description">
                                            <label for="country-floating">Meta Description</label>
                                            @error('meta_desc')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            {{-- <input type="text" id="company-column" class="form-control" name="description" value="{{$page->description ?? ''}}" placeholder="Description"> --}}
                                            <textarea name="content">

                                                {!! $page->description ?? '' !!}
                                                
                                                </textarea>
                                            <script>
                                                CKEDITOR.replace('content');
                                            </script>

                                            <label for="content">Content</label>

                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$page->id ?? '0'}}" name="id">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1" onclick="goPrev()">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic Floating Label Form section end -->
<script>
    function goPrev() {
        window.history.back();
    }
</script>



@stop