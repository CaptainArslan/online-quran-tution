@extends('admin.layouts.app')
@section('title', 'Edit Testimonial')

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
                    <h4 class="card-title">Edit Testimonial</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{route('admin.testimonial.save', $testimonial->id)}}" method="post">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Name" name="name" value="{{ $testimonial->name }}">
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" id="review_date" class="form-control datepicker" name="review_date" value="{{ $testimonial->review_date }}">
                                            @error('review_date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label>Review</label>
                                            <textarea name="review" id="review" class="form-control" rows="5" name="review">{{ $testimonial->review }}</textarea>
                                            @error('review')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label>Rating</label><br>
                                            <fieldset class="rating-stars">
                                                <input type="radio" id="star5" {{ $testimonial->rating == "5" ? 'checked' : '' }} name="rating" value="5"/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4half" {{ $testimonial->rating == "4.5" ? 'checked' : '' }} name="rating" value="4.5"/><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                <input type="radio" id="star4" {{ $testimonial->rating == "4" ? 'checked' : '' }} name="rating" value="4"/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3half" {{ $testimonial->rating == "3.5" ? 'checked' : '' }} name="rating" value="3.5"/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                <input type="radio" id="star3" {{ $testimonial->rating == "3" ? 'checked' : '' }} name="rating" value="3"/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2half" {{ $testimonial->rating == "2.5" ? 'checked' : '' }} name="rating" value="2.5"/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                <input type="radio" id="star2" {{ $testimonial->rating == "2" ? 'checked' : '' }} name="rating" value="2"/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1half" {{ $testimonial->rating == "1.5" ? 'checked' : '' }} name="rating" value="1.5"/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                <input type="radio" id="star1" {{ $testimonial->rating == "1" ? 'checked' : '' }} name="rating" value="1"/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-danger" href="{{route('admin.testimonial.list')}}">Cancel</a>
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
