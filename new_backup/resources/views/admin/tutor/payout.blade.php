@extends('admin.layouts.app')
@section('title', 'Tutor Payout')

@section('content')
<div class="col-12">
  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif
  @if(session()->has('error'))
  <div class="alert alert-danger">
    {{ session()->get('error') }}
  </div>
  @endif
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">{{$user->name ?? ""}} Payouts ({{$user->email ?? ""}})</h4>
        <div class="pull-right">
          <div class="col-sm-12 m-auto">
            <form method="GET" action="{{route('admin.tutor.payout',$id)}}" class="filter-form">
              <div class="input-group">
                <input type="text" name="from" class="form-control datepicker filter" value="{{ $request->from ?? '' }}" placeholder="From">
                <input type="text" name="to" class="form-control datepicker  filter" value="{{ $request->to ?? '' }}" placeholder="To">
                <div class="input-group-append">
                  <button type="submit" name="filter" value="filter" class="btn btn-primary pl-2 pr-2">Filter</button>
                  <button type="button" class="btn btn-danger reset pl-1 pr-1">Reset</button>
                  <button type="submit" name="export" value="export" class="btn btn-info pl-2 pr-2">Export</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-striped datatable">
            <thead>
              <tr>
                <th>Phone</th>
                <th>Status</th>
                <th>Amount Paid</th>
                <th>Amount To Pay</th>
                <th>Manager Name</th>
                <th>Manager Email</th>
                <th>Manager Phone</th>
                <th>Bonus</th>
                <th>Admin Note</th>
                <th>Manager Note</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pay_outs as $item)
              <tr>
                <td>{{$user->phone ?? ""}}</td>
                <td>
                  {{$item->status ?? ''}}
                </td>
                <td>
                  Rs{{$item->amount_paid ?? ''}}
                </td>
                <td>Rs{{$item->amount_to_pay ?? ""}}</td>
                <td>
                  {{$item->manager->name ?? ""}}
                </td>
                <td>{{$item->manager->email ?? ""}}</td>
                <td>{{$item->manager->phone ?? ""}}</td>
                <td>Rs{{$item->bonus ?? "0"}}</td>
                <td>{{$item->admin_note ?? ""}}</td>
                <td>{{$item->manager_note ?? ""}}</td>
                <td>
                  {{$item->created_at ?? ''}}
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
<script type="text/javascript">
  $('.reset').click(function() {
    var uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
      var clean_uri = uri.substring(0, uri.indexOf("?"));
      window.history.replaceState({}, document.title, clean_uri);
      location.reload();
    }
  });
</script>
</script>
@endsection