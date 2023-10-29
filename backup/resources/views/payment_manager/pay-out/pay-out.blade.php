@extends('admin.layouts.app')
@section('title', 'List of Payouts')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#payout_modal">Add PayOut</button>
        <div class="table-responsive">
          <table class="table table-bordered table-striped datatable">
            <thead>
              <th>
                Tutor ID
              </th>
              <th>
                Manager ID
              </th>
              <th>
                Status
              </th>
              <th>
                Amount To Pay
              </th>
              <th>
                Amount Paid
              </th>
              <th>Bonus</th>
              <th>
                Paid At
              </th>
            </thead>
            <tbody>
              @isset($pay_outs)
              @foreach ($pay_outs as $pay)
              <tr>
                <td>
                  {{$pay->tutor->name}}
                </td>
                <td>
                  {{$pay->manager->name}}
                </td>
                <td>
                  @if($pay->status == 'paid')
                  <span class="badge badge-success">Paid</span>
                  @else
                  <span class="badge badge-warning">Pending</span>
                  @endif
                </td>
                <td>
                  {{$pay->amount_to_pay?? ''}}
                </td>
                <td>
                  {{$pay->amount_paid?? ''}}
                </td>
                <td>
                  {{ $pay->bonus ?? 'N/A' }}
                </td>
                <td>
                  {{$pay->paid_at?? ''}}
                </td>
              </tr>
              @endforeach
              @endisset
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="payout_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">PayOut</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" action="{{route('admin.shared.payment')}}" class="form form-horizontal">
          @csrf
          <div class="form-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group row">
                  <div class="col-md-4">
                    <span>Hourly Rate</span>
                  </div>
                  <div class="col-md-8 mb-2">
                      
                    <input type="number" min="0" id="first-name" class="form-control" name="amount_to_pay" value="{{ $tutor->tutor->hourly_rate ?? '' }}" @if(isset($tutor->tutor->hourly_rate)) readonly @endif required>
                    <input type="hidden" id="tutor_id" value="{{$tutor_id}}" name="tutor_id">

                    @error('payment_amount')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                    <div class="col-md-4">
                        <span>Hours</span>
                    </div>
                    <div class="col-md-8 mb-2">
                        <input type="number" min="0" id="first-name" class="form-control" name="hours" placeholder="hours" required>

                        @error('bonus')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                  <div class="col-md-4">
                    <span>Bonus</span>
                  </div>
                  <div class="col-md-8 mb-2">
                    <input type="number" min="0" id="first-name" class="form-control" name="bonus" placeholder="Bonus" required>

                    @error('bonus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <span>Note(Optional)</span>
                  </div>
                  <div class="col-md-8">
                    <input type="text" id="first-name" class="form-control" name="note" placeholder="Note">
                    @error('note')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @stop
