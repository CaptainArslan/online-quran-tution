@extends('admin.layouts.app')
@section('title', 'Trial Inquiries List')
@section('heading', 'On Trial Inquiries')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<div class="row mb-1">
    <div class="col-sm-12 m-auto">
        <form method="GET" action="{{route('admin.trial.inquiries')}}" class="filter-form">
            <div class="input-group">
                <input type="text" name="from" class="form-control datepicker filter" value="{{ $req->from ?? '' }}" placeholder="From">
                <input type="text" name="to" class="form-control datepicker  filter" value="{{ $req->to ?? '' }}" placeholder="To">
                <select class="form-control filter" name="filter_type">
                    <option default selected>Select Filter</option>
                    <option @if($req->filter_type) {{$req->filter_type=='daily'?'selected':''}} @endif value="daily">Daily</option>
                    <option @if($req->filter_type) {{$req->filter_type=='weekly'?'selected':''}} @endif value="weekly">Weekly</option>
                    <option @if($req->filter_type) {{$req->filter_type=='monthly'?'selected':''}}  @endif  value="monthly">Monthly</option>
                </select>
                <div class="input-group-append">
                    <button type="submit" name="filter" value="filter" class="btn btn-primary pl-2 pr-2">Filter</button>
                    <button type="button" class="btn btn-danger reset pl-1 pr-1">Reset</button>
                    <button type="submit" name="export" value="export" class="btn btn-info pl-2 pr-2">Export</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">List of Trial Inquiries</h4>

            </div>
            <div class="card-body">



                    <div class="overlay-bg d-none"></div>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <span>Show </span>
                            <select name="table_length_limit" class="table_length_limit">
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span>entries</span>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span>Search: </span>
                            <input type="text" name="table_filter_search" class="table_filter_search" value="{{ $request->table_filter_search ?? '' }}" class="">
                        </div>
                    </div>
                    <!--RECORD WILL BE APPEND HERE in #append-record FROM RENDERED VIEW VIA AJAX-->
                    <div id="append-record"></div>


            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
 $('.reset').click(function(){
    var uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
        var clean_uri = uri.substring(0, uri.indexOf("?"));
        window.history.replaceState({}, document.title, clean_uri);
        location.reload();
    }
});
</script>
@endsection
