@extends('admin.layouts.app')
@section('title', 'List of Pages')

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
        <h4 class="card-title ">List of Pages</h4>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped datatable">
            <thead>
              <th>
                ID
              </th>
              <th>
                Title
              </th>
              <th>
                Heading
              </th>


              <th>
                Meta Title
              </th>

              <th>
                Meta Description
              </th>

              <th>
                Action
              </th>

            </thead>
            <tbody>
              @foreach ($pages as $page)

              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{$page->title?? ''}}
                </td>
                <td>
                  {{$page->heading?? ''}}
                </td>
                <td>
                  {{$page->meta_title?? ''}}
                </td>
                <td>
                  {{$page->meta_desc?? ''}}
                </td>


                <td>
                  <div class="btn-group">
                    <a href="{{url('admin/page/'.$page->id ?? '')}}"><button type="button" class="btn btn-success btn-sm">Edit</button></a>
                    <form action="{{url('admin/remove_page')}}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$page->id ?? ''}}">
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" style="margin-left:10px">Delete</button>

                    </form>
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