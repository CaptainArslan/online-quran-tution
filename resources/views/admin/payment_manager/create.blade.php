@extends('admin.layouts.app')
@section('title', 'Payment Manager')

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
                    <h4 class="card-title">Save Payment Manager</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{url('admin/add_payment_manager')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Name" name="name" value="{{$payment_manager->name ?? old('name')}}">
                                            <label for="first-name-column">Name</label>
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="email" id="last-name-column" class="form-control"
                                                placeholder="Email" name="email"
                                                value="{{$payment_manager->email ?? old('email')}}">
                                            <label for="last-name-column">Email</label>
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="city-column" class="form-control" placeholder="Phone"
                                                name="phone" value="{{$payment_manager->phone ?? old('phone')}}">
                                            <label for="city-column">Phone</label>
                                            @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="password" id="country-floating" class="form-control"
                                                value="" name="password"
                                                placeholder="Password">
                                            <label for="country-floating">Password</label>
                                            @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="company-column" class="form-control" name="address"
                                                value="{{$address ?? old('address')}}" placeholder="Address">
                                            <label for="company-column">Address</label>
                                            @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                    </div>
                                    <input type="hidden" value="{{$payment_manager->id ?? '0'}}" name="id">
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-danger"
                                                onclick="goPrev()">Cancel</button>
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
