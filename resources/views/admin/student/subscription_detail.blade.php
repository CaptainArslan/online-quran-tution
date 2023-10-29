@extends('admin.layouts.app')
@section('title', 'Subscription detail')

@section('content')

<div class="row mt-3">
  <div class="col-md-8 offset-md-2">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title text-uppercase"><span class="text-success">Subscription Detail</h4>


      </div>
      <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Method
              <strong>{{ $data['type'] ?? 'N/A' }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Amount
              <strong class="badge badge-primary">{{ $data['currency'] ?? 'N/A' }} {{ $data['amount'] ?? 'N/A' }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Start Date
              <strong>{{ $data['start_date'] ?? 'N/A' }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Status
              <strong>{{ $data['status'] ?? 'N/A' }}</strong>
            </li>

          </ul>
      </div>
    </div>
  </div>
</div>
@stop
