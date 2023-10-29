@extends('admin.layouts.app')
@section('title', 'All Inquiry List')

@section('heading', 'All Inquiries')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

<div class="row mb-1">

    <div class="col-sm-12">
        <form method="GET" action="{{route('admin.all_inquiries')}}" class="filter-form">
            <div class="row">
                <div class="col-sm-4 mb-2">
                    <input type="text" name="from" class="form-control datepicker filter" value="{{ $req->from ?? '' }}" placeholder="From">
                </div>

                <div class="col-sm-4 mb-2">
                    <input type="text" name="to" class="form-control datepicker  filter" value="{{ $req->to ?? '' }}" placeholder="To">
                </div>
                <div class="col-sm-4 mb-2">
                    <select class="form-control filter" name="filter_type">
                        <option default selected value="">Select Filter</option>
                        <option @if($req->filter_type) {{$req->filter_type=='daily'?'selected':''}} @endif value="daily">Daily</option>
                        <option @if($req->filter_type) {{$req->filter_type=='weekly'?'selected':''}} @endif value="weekly">Weekly</option>
                        <option @if($req->filter_type) {{$req->filter_type=='monthly'?'selected':''}} @endif value="monthly">Monthly</option>
                    </select>
                </div>
                <div class="col-sm-4 mb-2">
                    <select class="form-control filter" name="status">
                        <option default selected value="">All</option>
                        <option @if($req->status) {{$req->status=='on_trial'?'selected':''}} @endif value="on_trial">Trial</option>
                        <option @if($req->status) {{$req->status=='pending'?'selected':''}} @endif value="pending">Pending</option>
                        <option @if($req->status) {{$req->status=='started'?'selected':''}} @endif value="started">Started</option>
                        <option @if($req->status) {{$req->status=='not_start'?'selected':''}} @endif value="not_start">Not Started</option>
                        <option @if($req->status) {{$req->status=='cancelled'?'selected':''}} @endif value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-sm-4 mb-2">
                    <select name="duration" id="" class="form-control">
                        <option value="{{ $req->duration ?? '' }}" hidden>{{ $req->duration.' Minutes' ?? 'Duration of Class' }}</option>
                        <option value=""></option>
                        @for($i = 15; $i <= 180; $i+=15)
                            <option value="{{ $i }}">{{ $i }} Minutes</option>
                        @endfor
                    </select>
                </div>
                <div class="col-sm-4 mb-2 text-right">
                    <div class="btn-group">
                        <button type="submit" value="filter" name="action" class="btn btn-primary">Filter</button>
                        <button type="button" class="btn btn-danger reset">Reset</button>
                        <button type="submit" value="export" name="action" class="btn btn-info">Export</button>
                    </div>
                </div>










            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.inquiryes.bulk.del')}}" id="bulk-delete" method="get">
                    @csrf
                    <div class="mb-2">
                        <button type="submit" id="bulk-delete-button" class="btn btn-danger">Delete</button>
                    </div>

                    @include('admin.partials.table_view_append')

                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $('.reset').click(function() {
        var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
            location.reload();
        }
    });
    $(document).ready(function(){
        
        $(document).on("keydown", "#bulk-delete", function(event) { 
    return event.key != "Enter";
});
        
        
        
       $('#bulk-delete-button').click(function(e){
           e.preventDefault();
           Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                $('#bulk-delete').submit();
              }
            })
       }) ;
    });
</script>




@endsection
