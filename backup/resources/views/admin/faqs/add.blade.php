@extends('admin.layouts.app')
@section('title', 'Create Faq')

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
    
   
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Question Answers</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.faqs.store')}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Question *</label>
                                        <input type="text" class="form-control" name="question"
                                            value="{{old('question')}}">
                                        @if($errors->has('question'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('question') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Answer *</label>
                                        <input type="text" class="form-control" name="answer"
                                            value="{{old('answer')}}">
                                        @if($errors->has('answer'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('answer') }}
                                        </div>
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