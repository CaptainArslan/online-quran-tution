@extends('payment_manager.layouts.app')
@section('content')
@section('topbar-heading', 'Inquiries Status')
<div class="row">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <tr>
                <th>Pending</th>

              </tr>
            </thead>
            <tbody>


              @foreach ($pending as $pen)
              <tr>
                <td>
                  {{$pen->status ?? ''}}<button type="button" class="btn btn-primary btn-sm" style="margin-left:100px">Start Trial</button>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header card-header-primary">
        {{-- <h4 class="card-title ">Inquiries Status</h4> --}}

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table>
            <thead class="text-primary">
              <tr>

                <th>Active</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($active as $act)
              <tr>
                <td>
                  {{$act->status ?? ''}}<button type="button" class="btn btn-danger btn-sm" style="margin-left:100px">Cancel</button>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-header card-header-primary">
        {{-- <h4 class="card-title ">Inquiries Status</h4> --}}

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table>
            <thead class="text-primary">
              <tr>

                <th>On Trial</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($on_trial as $act)
              <tr>
                <td>
                  {{$act->status ?? ''}}<button type="button" class="btn btn-success btn-sm" style="margin-left:100px">Active</button>
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