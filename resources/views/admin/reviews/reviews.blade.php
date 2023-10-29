@extends('admin.layouts.app')
@section('title', 'Reviews')


@section('css')
<style>
    .starrating > input {display: none;}
.starrating > label:before {
content: "\f005";
margin: 2px;
font-size: 20px;
font-family: FontAwesome;
display: inline-block;
cursor: pointer;
}
.starrating > label { color: #222222;}
.starrating > input:checked ~ label { color: #ffca08 ; }
.starrating > input:hover ~ label{ color: #ffca08 ;  }
.rate-stars{color: #ffca08 ; }
</style>
@endsection

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

<div class="content-header row">
</div>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">

                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Review</h4>
                        <div class="text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    + Add New Rating
                                </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-bordered table-striped datatable">
                            <thead class="text-warning">
                                <th>ID</th>
                                <th>Feedback</th>
                                <th>Rating</th>
                                <th width="10%">Action</th>

                            </thead>
                            <tbody>

                                @foreach($reviews as $review)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$review->comment ?? 'N / A'}}</td>
                                    <td>
                                        @for($i = 1; $i <= $review->rating; $i++)
                                            <i class="fas fa-star rate-stars"></i>
                                        @endfor
                                    </td>
                                    <td>
                                        <a href="{{route('admin.reviews.destroy',$review->id )}}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
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
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog card" role="document">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 class="modal-title">Rate and Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-1 pt-0">

                <form action="{{ route('admin.reviews.store') }}" method="POST">
                    @csrf
                    <div class="form-group p-0 m-0">
                        <textarea class="form-control" name="comment" placeholder="Your message here (optional)"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Suggest a rating</label>
                        <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                            <input type="radio" id="star5" name="rating" value="5" required /><label for="star5" title="5 star"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary bt-sm">Rate Now!</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
