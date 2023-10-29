@extends('admin.layouts.app')
@section('title', 'Regular Students')

@section('heading', 'Regular Classes')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

<div class="row mb-1">


</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.partials.table_view_append')
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
</script>
@endsection
