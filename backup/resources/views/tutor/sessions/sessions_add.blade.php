@extends("tutor.layouts.app")
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
{{-- claender css --}}
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/forms/select/select2.min.css">
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/core/colors/palette-gradient.css">
@endsection
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading', 'Create Session')


<section>
    <form action="{{route('tutor.inquiry_schedule_create')}}" method="post">


        @csrf
        <input type="hidden" name="inquiry_id" value="{{$inquiry_id}}">

        <div class="row mb-5">
            <div class="col-md-4 card">
                <div class="card-body">
                    <h4 class="alert alert-warning">Read carefully before schedule set</h4>
                    <hr>
                    <ul>
                        <li>Check your availability from your daily routine</li>
                        <li>Select the week days at which you are available</li>
                        <li>Select time of days when you are comfortable</li>
                        <li>Set time duration of class regarding this inquiry</li>
                        <li>Set schdeule</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8 card">
                <div class="wrapper card-body">
                    <div class="element jumbotron">
                        <label>Select day for Session</label>
                        <select class="form-control" name="days[]">
                            <option value="1" selected>Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                            <option value="7">Sunday</option>
                        </select>
                        <label for="">Select Time</label>
                        <input type='time' name="time[]" class="form-control" required />
                    </div>
                    <div class="results"></div>


                    <div class="btn-group pull-right" style="color: #fff;">
                        <a class="clone btn btn-primary"> + Add More Days</a>
                        <a class="remove btn btn-danger"> Remove</a>
                    </div>
                </div>
                <div class="p-2">

                    <select name="duration" id="" class="form-control mb-2" required>
                        <option value="" hidden>Duration of Class</option>
                        @for($i = 15; $i <= 180; $i+=15)
                            <option value="{{ $i }}">{{ $i }} Minutes</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-success">Create Schedule</button>
                </div>
            </div>
        </div>
    </form>
</section>

@section('js')
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/js/scripts/forms/select/form-select2.js"></script>
<script type="text/javascript">
    $(function() {
        // $('#datetimepicker1').datetimepicker();
        var tomorrow = moment().add(1, 'days');
        $('#datetimepicker1').datetimepicker({
            minDate: moment(),
            ignoreReadonly: true,
            allowInputToggle: true,
            defaultDate: null,
            useCurrent: false
        });
    });
</script>
<script>
    $('.wrapper').on('click', '.remove', function() {
        $('.remove').closest('.wrapper').find('.element').not(':first').last().remove();
    });
    $('.wrapper').on('click', '.clone', function() {
        $('.clone').closest('.wrapper').find('.element').first().clone().appendTo('.results');
    });
</script>
@endsection
@stop
