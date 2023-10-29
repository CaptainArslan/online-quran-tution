@extends('admin.layouts.app')
@section('title', 'List of Country')

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
                <h4 class="card-title ">List of Country</h4>
                <a href="{{route('admin.country_add')}}" class="btn btn-primary pull-right">+ Add New Country</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <th>
                                ID
                            </th>
                            <th>
                                Code
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Currency
                            </th>
                            <th>
                                Action
                            </th>
                        </thead>
                        <tbody>
                            <?php $index_count = 1; ?>
                            @if(count($country)>0)
                            @foreach ($country as $st)

                            <tr>
                                <td>
                                    <?php echo $index_count++ ?>
                                </td>
                                <td>
                                    {{$st->code}}
                                </td>
                                <td>
                                    {{$st->name}}
                                </td>
                                <td>
                                    {{$st->currency}}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('admin.country_edit',['id'=>$st->id])}}"
                                            class="btn btn-info">Edit</a>
                                        <button type="button"
                                            class="btn btn-danger" onclick="deleteAlert('{{ route('admin.country_delete',['id'=>$st->id]) }}')">Delete</button>
                                    </div>
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
