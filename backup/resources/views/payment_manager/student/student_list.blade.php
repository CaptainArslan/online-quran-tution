@extends('payment_manager.layouts.app')
@section('content')
@section('topbar-heading', 'Student List')
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
                   Email
                  </th>
                  <th>
                    Phone
                  </th>
                  <th>
                   Role
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
                 <td>
                    {{$student->role}}
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
@stop
