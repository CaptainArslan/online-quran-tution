@extends('admin.layouts.app')
@section('title', 'Cancel Subscription List')

@section('content')
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<div class="row mb-1">
    <div class="col-sm-6 m-auto">
        <h3>Cancel Subscription</h3>
    </div>
    <div class="col-sm-6 m-auto">
        <form method="GET" action="{{route('admin.cancel.subscription')}}" class="filter-form">
            <div class="input-group">
                <input type="text" name="from" class="form-control datepicker filter" value="{{ $req->from ?? '' }}" placeholder="From">
                <input type="text" name="to" class="form-control datepicker  filter" value="{{ $req->to ?? '' }}" placeholder="To">
                <select class="form-control filter" name="filter_type">
                    <option default selected>Select Filter</option>
                    <option @if($req->filter_type) {{$req->filter_type=='daily'?'selected':''}} @endif value="daily">Daily</option>
                    <option @if($req->filter_type) {{$req->filter_type=='weekly'?'selected':''}} @endif value="weekly">Weekly</option>
                    <option @if($req->filter_type) {{$req->filter_type=='monthly'?'selected':''}} @endif value="monthly">Monthly</option>
                </select>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary pl-2 pr-2">Filter</button>
                    <button type="button" class="btn btn-danger reset pl-1 pr-1">Reset</button>
                    <a href="{{route('admin.cancelSub.inquiry.export')}}?from={{ $req->from }}&to={{ $req->to }}" class="btn btn-info">Export</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">List of Cancel Subscription</h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Std Name
                                </th>
                                <th>Child Profile</th>
                                <th>Std Email</th>
                                <th>Std Phone</th>
                                <th>Tutor Name</th>
                                <th>Tutor Email</th>
                                <th>Tutor Phone</th>
                                <th>
                                    Created
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$student->user->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->child->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->email ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->phone ?? 'N/A'}}
                                </td>
                                <td>
                                    @if(!empty($student->tutor->name))
                                    {{$student->tutor->name ?? "N/A"}}
                                    @else
                                    N / A
                                    @endif

                                </td>
                                <td>
                                    {{$student->tutor->email ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->tutor->phone ?? 'N / A'}}
                                </td>
                                <td>
                                    {{$student->created_at ?? "N/A"}}
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