@extends('admin.layouts.app')
@section('title', 'Add Plan')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
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
                    <h4 class="card-title">Create Plan</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{route('admin.plan_create')}}" method="post">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Name" name="name" value="{{ old('name') }}">
                                            <label for="first-name-column">Name</label>
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <select id="" class="form-control selectpicker" data-live-search="true"
                                                name="country_id">  
                                                <option selected disabled>Select Country</option>
                                                @foreach($country as $c)        
                                                <option value="{{$c->id}}" {{ old('country_id') == $c->id ? 'selected' : '' }}>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="last-name-column">Country</label>
                                            @error('country_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Price" name="price" value="{{ old('price') }}">
                                            <label for="last-name-column">Price</label>
                                            @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="city-column" class="form-control"
                                                placeholder="Discount" name="discount" value="{{ old('discount') }}">
                                            <label for="city-column">Price after discount</label>
                                            @error('discount')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="country-floating" class="form-control" value="{{ old('days_in_week') }}"
                                                name="days_in_week" placeholder="No. of days in week">
                                            <label for="country-floating">Days_in_week</label>
                                            @error('days_in_week')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="company-column" class="form-control"
                                                name="classes_in_month" value="{{ old('classes_in_month') }}" placeholder=" No. classes in month">
                                            <label for="company-column">classes_in_month</label>
                                            @error('classes_in_month')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="company-column" class="form-control" name="duration"
                                                value="{{ old('duration') }}" placeholder="Duration">
                                            <label for="company-column">Duration</label>
                                            @error('duration')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="company-column" class="form-control"
                                                name="price_per_month" value="{{ old('price_per_month') }}" placeholder="Price Per Month">
                                            <label for="company-column">price per month</label>
                                            @error('price_per_month')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="company-column" class="form-control" name="note"
                                                value="{{ old('note') }}" placeholder="Note">
                                            <label for="company-column">note</label>
                                            @error('note')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="company-column" class="font-weight-bold">is_private</label>
                                            <input type="checkbox" id="checkbox" class="ml-2"  name="is_private"
                                                value="1" >
                                            
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-danger" href="{{route('admin.plan_list')}}">Cancel</a>
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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });

</script>
@endsection
