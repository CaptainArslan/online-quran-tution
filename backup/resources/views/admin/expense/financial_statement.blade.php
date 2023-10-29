@extends('admin.layouts.app')
@section('title', 'List of Coupon')
@section('content')
<div class="col-12">
  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif
</div>
<div class="row mb-1">
  <div class="m-auto">
    <h3>Financial Statement</h3>
  </div>
  
  <div class="col-sm-12 m-auto">
    <form method="GET" action="{{ route('admin.financial.statement') }}" class="filter-form">
      <div class="input-group">
        <input type="text" name="from" class="form-control datepicker filter" value="{{ $request->from ?? '' }}" placeholder="From">
        <input type="text" name="to" class="form-control datepicker  filter" value="{{ $request->to ?? '' }}" placeholder="To">
        <select class="form-control filter" name="filter_type">
          <option default selected>Select Filter</option>
          <option @if($request->filter_type) {{$request->filter_type=='daily'?'selected':''}} @endif value="daily">Daily</option>
          <option @if($request->filter_type) {{$request->filter_type=='weekly'?'selected':''}} @endif value="weekly">Weekly</option>
          <option @if($request->filter_type) {{$request->filter_type=='monthly'?'selected':''}} @endif value="monthly">Monthly</option>
        </select>
        <div class="input-group-append">
          <button type="submit" class="btn btn-primary pl-2 pr-2">Filter</button>
          <button type="button" class="btn btn-info reset pl-1 pr-1">Reset</button>
          <button type="submit" name="expense" value="expense" class="btn btn-danger pl-2 pr-2">Expense Export</button>
          @if(auth()->user()->role=='admin')
          <button type="submit" name="revenue" value="revenue" class="btn btn-success pl-2 pr-2">Revenue Export</button>
          @endif
        </div>
      </div>
    </form>
  </div>
</div>
<hr class="mt-0">
<div class="row">
    
    <div class=" @if(auth()->user()->role=='manager') col-lg-12 @else col-lg-6 @endif col-md-6 col-12">
    <div class="card">
      
        <div class="card-header d-flex align-items-start pb-0">
          <div>
            <h2 class="text-bold-700 mb-0 text-danger">{{ $payouts->sum('amount_paid') + $expenses->sum('amount') }} PKR</h2>
            <p class="text-danger">Financial Expenses</p>
          </div>
          <div class="avatar bg-rgba-warning p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-alert-octagon text-danger font-medium-5"></i>
            </div>
          </div>
        </div>
     
    </div>
  </div>
   @if(auth()->user()->role=='admin')
  <div class="col-lg-6  col-md-6 col-12">
    <div class="card">
      
        <div class="card-header d-flex align-items-start pb-0">
          <div>
            <h2 class="text-bold-700 mb-0 text-success">&pound;{{ $subscriptions->sum('amount') ?? '0' }}</h2>
            <p class="text-success">Financial Revenue</p>
          </div>
          <div class="avatar bg-rgba-warning p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-alert-octagon text-success font-medium-5"></i>
            </div>
          </div>
        </div>
      
    </div>
  </div>
  @endif
    
    <div class="col-md-12">
        <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Finencial Expence</a>
                </li>
                @if(auth()->user()->role=='admin')
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">Financial Revenue</a>
                </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                     <div class="table-responsive" style="height: 500px;overflow:auto;">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <th>
              Summary
            </th>
            <th>
              Amount
            </th>
            <th>
              Date
            </th>
          </thead>
          <tbody>
            @forelse ($payouts as $payout)
            <tr>
              <td>{{ Str::limit($payout->admin_note ?? 'N/A', 35) }}</td>
              <td class="text-danger"><em><strong>{{$payout->amount_paid  ?? '0' }} PKR</strong></em></td>
              <td>{{ $payout->created_at ?? 'N/A' }}</td>
            </tr>
            @empty
            <h3 class="alert alert-warning">No record found</h3>
            @endforelse
            
            @foreach ($expenses as $ex)
              <tr>
                <td>
                  {{ Str::limit($ex->description ?? 'N/A', 50) }}
                </td>
                <td>
                  <strong class="text-danger"><em>{{$ex->amount ?? ''}} PKR</em></strong>
                </td>
              
                  <td>{{ $ex->created_at ?? 'N/A' }}</td>
              </tr>
              @endforeach
            
            
          </tbody>
        </table>
      </div>
                </div>
                <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                    <table class="table table-bordered table-hover table-sm">
        <thead>
          <th>
            #
          </th>
          <th>
            Summary
          </th>
          <th>
            Amount
          </th>
          <th>
            Date
          </th>
        </thead>
        <tbody>
          @forelse ($subscriptions as $subscription)
          <tr>
            <th>{{ $loop->iteration }}</th>
            <td>Paid via {{ $subscription->method ?? 'N/A' }} Payment Systems</td>
            <td class="text-success"><em><strong>&pound;{{ $subscription->amount  ?? '0' }}</strong></em></td>
            <td>{{$subscription->created_at->todatestring() ?? 'N/A'}}</td>
          </tr>
          @empty
          <h3 class="alert alert-warning">No record found</h3>
          @endforelse

        </tbody>
      </table>
                </div>
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
