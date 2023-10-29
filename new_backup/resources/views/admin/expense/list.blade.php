@extends('admin.layouts.app')
@section('title', 'Expense List')

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
    <h3>Expenses Statement</h3>
  </div>
  <div class="col-sm-6 m-auto">
    <form method="GET" action="{{ route('admin.expense.list') }}" class="filter-form">
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
          <button type="submit" name="export" value="export" class="btn btn-info reset pl-1 pr-1">Export</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-sm-6 col-12">
    <div class="card">

      <div class="card-header d-flex align-items-start pb-0">
        <div>
          <h2 class="text-bold-700 mb-0 text-info">Rs {{$totalWeeklyExpenses ?? ""}}</h2>
          <p class="text-info">Total Weekly Expenses</p>
        </div>
        <div class="avatar bg-rgba-info p-50 m-0">
          <div class="avatar-content">
            <i class="feather icon-alert-octagon text-info font-medium-5"></i>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col-lg-4 col-sm-6 col-12">
    <div class="card">

      <div class="card-header d-flex align-items-start pb-0">
        <div>
          <h2 class="text-bold-700 mb-0 text-info">Rs {{$totalMonthlyExpenses ?? ""}}</h2>
          <p class="text-info">Total Monthly Expenses</p>
        </div>
        <div class="avatar bg-rgba-info p-50 m-0">
          <div class="avatar-content">
            <i class="feather icon-alert-octagon text-info font-medium-5"></i>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col-lg-4 col-sm-6 col-12">
    <div class="card">

      <div class="card-header d-flex align-items-start pb-0">
        <div>
          <h2 class="text-bold-700 mb-0 text-info">Rs {{$totalExpenses ?? ""}}</h2>
          <p class="text-info">Total Expenses</p>
        </div>
        <div class="avatar bg-rgba-info p-50 m-0">
          <div class="avatar-content">
            <i class="feather icon-alert-octagon text-info font-medium-5"></i>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Expense(s)</h4>
        <a href="{{route('admin.expense.add')}}" class="btn btn-primary pull-right">+ Add New Expense</a>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-striped datatable">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                  Date
                </th>
                <th width="30%">
                  Description
                </th>
                <th>
                  Amount
                </th>
                <th>
                  Receipt
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($expense as $ex)
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{ \Carbon\Carbon::parse($ex->date)->format('M d, Y') }}
                </td>
                <td>
                  {{ Str::limit($ex->description ?? 'N/A', 70) }}
                </td>
                <td>
                  <strong class="text-danger"><em>Rs{{$ex->amount ?? ''}}</em></strong>
                </td>
                <td>
                  @if(isset($ex->receipt))

                  <a href="{{ asset($ex->receipt) ?? '' }}" target="_blank"><img src="{{ asset($ex->receipt) ?? '' }}" style="width: 120px;height: 120px;"></a>
                  @else
                  N/A
                  @endif
                </td>
                <td>
                  <div class="btn-group pull-right">
                    <a href="{{ route('admin.expense.edit', $ex->id) }}" class="btn btn-primary">Edit</a>
                    <button type="button" onclick="deleteAlert('{{ route('admin.expense.delete', $ex->id) }}')" class="btn btn-danger">Delete</button>
                  </div>
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