@extends('admin.layouts.app')
@section('title', 'List of Student')

@section('content')
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
                    <h4 class="card-title ">Student(s)</h4>
                    <div class="pull-right">
                        <form method="GET" action="{{route('admin.student_all')}}" class="filter-form">
                            <button type="submit" name="export" value="export" class="btn btn-info btn-block">Export</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.partials.table_view_append')
                </div>
            </div>
        </div>
    </div>
@stop
