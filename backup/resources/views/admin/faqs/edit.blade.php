@extends('admin.layouts.app')
@section('title', 'Edit Faq')

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
        <div class="col-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Edit FAQ</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.faqs.store',['id'=>$faq->id])}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Question *</label>
                                        <input type="text" class="form-control" name="question"
                                            value=" {{$faq->question}}">
                                        @if($errors->has('question'))
                                        {{ $errors->first('question') }}
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Answer *</label>
                                        <input type="text" class="form-control" name="answer"
                                            value="{{$faq->answer}}">
                                        @if($errors->has('answer'))
                                        {{ $errors->first('answer') }}
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