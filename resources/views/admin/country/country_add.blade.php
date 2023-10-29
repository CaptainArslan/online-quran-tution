@extends('admin.layouts.app')
@section('title', 'Add Country')

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
                    <h4 class="card-title">Add Country</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{route('admin.country_store')}}" method="post">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Code" name="code" value="">
                                            <label for="first-name-column">Code</label>
                                            @error('code')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Name" name="name" value="">
                                            <label for="last-name-column">Name</label>
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="city-column" class="form-control"
                                                placeholder="Capital three Character like, USD" name="currency"
                                                value="">
                                            <label for="city-column">Currency</label>
                                            @error('currency')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-danger" href="{{route('admin.country_list')}}">Cancel</a>
                                        </div>
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


@stop
