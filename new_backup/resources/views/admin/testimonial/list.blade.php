@extends('admin.layouts.app')
@section('title', 'Testimonial List')

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
        <h4 class="card-title ">Testimonial(s)</h4>
        <a href="{{route('admin.testimonial.add')}}" class="btn btn-primary pull-right">+ Add New Testimonial</a>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-striped datatable">
            <thead>
              <th>
                #
              </th>
              <th>
                Date
              </th>
              <th>
                Name
              </th>
              <th>
                Review
              </th>
              <th>
                Rating
              </th>
              <th>
                Status
              </th>
              <th>
                Action
              </th>
            </thead>
            <tbody>
              @foreach ($testimonial as $ts)
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{ \Carbon\Carbon::parse($ts->review_date)->format('M d, Y') }}
                </td>
                <td>
                  {{$ts->name ?? ''}}
                </td>
                <td>
                  {{$ts->review ?? ''}}
                </td>
                <td>
                  {{$ts->rating ?? ''}}
                </td>
                <td>
                  @if($ts->status == 1)
                    <span class="badge badge-success">Visible</span>
                  @else
                    <span class="badge badge-primary">Hidden</span>
                  @endif
                </td>
                <td>
                    <div class="btn-group">
                        @if($ts->status == 1)
                        <a href="{{ route('admin.testimonial.status', $ts->id) }}" class="btn btn-warning">Hide</a>
                    @else
                        <a href="{{ route('admin.testimonial.status', $ts->id) }}" class="btn btn-warning">Show</a>
                    @endif
                    <a href="{{ route('admin.testimonial.edit', $ts->id) }}" class="btn btn-primary">Edit</a>
                    <button type="button" onclick="deleteAlert('{{ route('admin.testimonial.delete', $ts->id) }}')" class="btn btn-danger">Delete</button>
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
