@extends('admin.layouts.app')
@section('title', 'New Trials')

@section('content')
<div class="col-12">
  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif
</div>


    <div class="card col-md-12">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0 text-dark">Rs.{{number_format(\App\Models\PayOut::where('status','paid')->sum('amount_paid'),0)}}</h2>
                    <p class="text-dark">Total Paid</p>
                </div>
                <div class="avatar bg-rgba-success p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-server text-dark font-medium-5"></i>
                    </div>
                </div>
            </div>

    </div>


<div class="row">
  <div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
        <h4 class="card-title ">Tutor(s)</h4>
        <div class="pull-right">
          <form method="GET" action="{{route('admin.tutor_list')}}" class="filter-form">
            <div class="btn-group">
              
              <a href="{{route('admin.tutor')}}" class="btn btn-primary pull-right">+ Add New Teacher</a>
            </div>
          </form>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped datatable" zz>
            <thead>
              <th>
                ID
              </th>
              <th>
                Name
              </th>
              <th>
                Email
              </th>
              <th>
                Phone
              </th>
              <th>
                Salary
              </th>
              <th>
                Action
              </th>
              <th>
                Assigned Inquiries
              </th>
            </thead>
            <tbody>
              <?php $index_count = 1; ?>
              @if(count($tutor)>0)
              @foreach ($tutor as $student)

              <tr>
                <td>
                  <?php echo $index_count++ ?>
                </td>
                <td>
                  {{$student->name?? ''}}
                </td>
                <td>
                  {{$student->email?? ''}}
                </td>
                <td>
                  {{$student->phone?? ''}}
                </td>
                <th>
                  <u>Rs.{{$student->tutor->salary ?? '0' }}</u>
                </th>
                <td>
                  <div class="btn-group">
                      <a href="{{url('admin/tutor/'.$student->id ?? '')}}" class="btn btn-primary">View/Edit</a>
                    {{--<button type="button" class="btn btn-primary tutor-btn" data-id="{{$student->tutor->id ?? '' }}" data-toggle="modal" data-target="#salary_model">Salary</button>--}}
                    <a href="{{route('admin.shared.pay_out',$student->id)}}" class="btn btn-warning tutor-btn">Payout</a>
                    </div>
                </td>
                <td>
                  <a href="{{ route('admin.tutor.inquiries', $student->id) }}    " class="btn btn-success btn-block">Inquries</a>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>
                  No Record
                </td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal" id="salary_model">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Salary</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" action="{{route('admin.shared.tutor.salary')}}" class="form form-horizontal">
          @csrf
          <div class="form-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group row">
                  <div class="col-md-4">
                    <span>Salary Amount</span>
                  </div>
                  <div class="col-md-8">
                    <input type="number" min="0" id="first-name" class="form-control" name="salary" placeholder="Add Salary" required>
                    <input type="hidden" id="tutor_id" name="tutor_id">
                    @error('salary')
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
  @section('js')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".tutor-btn").click(function() {
        var tutor_id = ($(this).attr("data-id"));
        $('#tutor_id').val(tutor_id);
      });
    });
  </script>
  @stop
