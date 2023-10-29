@extends('admin.layouts.app')
@section('title', 'Add Coupon')

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
                    <h4 class="card-title">Add Coupon</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{url('admin/add_coupon')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Name" name="name" value="{{$coupon->name ?? ''}}">
                                            <label for="first-name-column">Name</label>
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="last-name-column" class="form-control" placeholder="Code" name="code" minlength="6" value="{{$coupon->code ?? ''}}">
                                            <label for="last-name-column">Code</label>
                                            @error('code')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="city-column" class="form-control" placeholder="Discount Type" name="discount_type" value="{{$coupon->discount_type ?? ''}}">
                                            <label for="city-column">Discount Type</label>
                                            @error('discount_type')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="number" id="country-floating" class="form-control" value="{{$coupon->discount_value ?? ''}}" name="discount_value" placeholder="Discount Value">
                                            <label for="country-floating">Discount Value</label>
                                            @error('discount_value')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <input type="hidden" value="{{$coupon->id ?? '0'}}" name="id">
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-danger" onclick="goPrev()">Cancel</button>
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
<script>
    function goPrev() {
        window.history.back();
    }
</script>

@stop
