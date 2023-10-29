@extends("student.layouts.app")
@section('content')
@include('admin.partials.success_message')

@section('css')
<style>
    .rate-stars
    {
        color:#FFCA08;
    }
</style>
@endsection
@section('topbar-heading', 'Reviews')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Tutor Name</th>
                            <th>Behaviour</th>
                            <th>Attention</th>
                            <th>Progress</th>
                            <th>Class Duration</th>
                            <th>Created</th>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    
                                        <td>{{$review->tutor->name ?? 'N / A'}}</td>
                                        <td>
                                            @for($i = 1; $i <= $review->behavior; $i++)
                                                <i class="fa fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            @for($i = 1; $i <= $review->attention; $i++)
                                                <i class="fa fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            @for($i = 1; $i <= $review->progress; $i++)
                                                <i class="fa fa-star rate-stars"></i>
                                            @endfor
                                        </td>
                                        <td>{{$review->class_duration.' Minutes'}}</td>
                                        <td>{{$review->created_at->diffFOrHumans()}}</td>
                                
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    

    
</div>

@endsection
