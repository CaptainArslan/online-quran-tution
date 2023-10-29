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
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">List of  Coupon</h4>
        <a href="{{route('admin.coupon')}}" class="btn btn-primary pull-right">+ Add New Coupon</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped datatable">
            <thead>
              <th>
                ID
              </th>
              <th>
                Name
              </th>
              <th>
                Code
              </th>
              <th>
                Discount Type
              </th>
              <th>
                Discount Value
              </th>
              <th>
                Mail Coupan
              </th>
              <th>
                Action
              </th>
            </thead>
            <tbody>
              @foreach ($coupons as $coupon)
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{$coupon->name?? ''}}
                </td>
                <td>
                  <span class="badge badge-square badge-info">{{$coupon->code?? ''}}</span>
                </td>
                <td>
                  {{$coupon->discount_type?? ''}}
                </td>
                <td>
                  <span class="badge badge-square badge-primary">{{$coupon->discount_value?? ''}}</span>
                </td>
                <td>
                  {{-- send coupan mail form --}}
                  <!-- Button trigger modal -->
                  <button data-toggle="modal" data-target="#Model{{ $coupon->id }}" class="btn btn-primary">Send Coupan</button>
                  <!-- Modal -->
                  <div class="modal fade" id="Model{{ $coupon->id }}" tabindex="-1" role="dialog" aria-labelledby="Model{{ $coupon->id }}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="Model{{ $coupon->id }}Label">Forward Coupan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ route('admin.email.coupon') }}">
                            @csrf
                            <div class="form-group">
                              <input type="email" name="email" class="form-control" placeholder="Email address" required>
                              <small class="form-text text-muted">enter email address to send coupan code to the user</small>
                            </div>
                            <div class="form-group">
                              <input type="text" readonly class="form-control font-weight-bold" name="coupon_code" value="{{$coupon->code}}">
                              <small class="form-text text-muted">Coupan Code</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Send Coupan</button>
                        </div>

                          </form>
                      </div>
                    </div>
                  </div>
                  {{-- end send coupan mail form --}}

                </td>
                <td>
                    <a href="{{url('admin/coupon/'.$coupon->id ?? '')}}" class="btn btn-success" style="border-radius: 0.4285rem 0 0 0.4285rem;">Edit</a>
                    <button type="button" onclick="deleteAlert('{{ route('admin.remove_coupon', $coupon->id) }}')" class="btn btn-danger">Delete</button>
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
