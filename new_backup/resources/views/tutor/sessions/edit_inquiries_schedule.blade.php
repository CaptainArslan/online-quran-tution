@extends("tutor.layouts.app")
@section('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    {{-- claender css --}}
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/vendors/css/forms/select/select2.min.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/css/core/colors/palette-gradient.css">
@endsection
@section('content')
    @include('admin.partials.success_message')
@section('topbar-heading', 'Update Inquiry Schedule')
{{-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('tutor.update.schedule')}}" method="post">
    @csrf
    <div class="row">
        <div class='col-sm-12'>
            <div class="form-group">
                <label>Select Weekly days for Session</label>
                <select class="select2 form-control" multiple="multiple" name="days[]">
                    <option value="1" selected>Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                    <option value="7">Sunday</option>
                </select>
            </div>
        </div>
        <div class='col-sm-12'>
            <div class="form-group">
                <label>Select Date & Time</label>
                <input type='time' name="time" class="form-control pickatime picker__input picker__input--active" id="P1203190736" autocomplete="off" />
            </div>
        </div>
        <div class="col-md-12">
            <input type="hidden" name="inquiry_id" value="{{$inquiry_id}}">
            <button class="btn btn-success">Create Session</button>
        </div>
    </div>
    </form>
    </div>
</div> --}}

<section>

       

    <form action="{{route('tutor.update.schedule')}}" method="post">
        @csrf
        <input type="hidden" name="inquiry" value="{{$inquiry->id}}">
        <div class="row mb-5">
            <div class="col-md-12 card">
                <h4 class="card-title text-center">Update Schedule</h4>
                <div class="wrapper card-body">
                    @php
                        $schedules=$inquiry->schedules;
                    @endphp
                    @foreach($schedules as $inquirySch)
                    <div class="element jumbotron">
                        <label>Selects day for Session</label>
                        <select class="form-control" name="day[]">
                            <option @if($inquirySch['day'] == 1) selected @endif value="1">Monday</option>
                            <option @if($inquirySch['day'] == 2) selected @endif value="2">Tuesday</option>
                            <option @if($inquirySch['day'] == 3) selected @endif value="3">Wednesday</option>
                            <option @if($inquirySch['day'] == 4) selected @endif value="4">Thursday</option>
                            <option @if($inquirySch['day'] == 5) selected @endif value="5">Friday</option>
                            <option @if($inquirySch['day'] == 6) selected @endif value="6">Saturday</option>
                            <option @if($inquirySch['day'] == 7) selected @endif value="7">Sunday</option>
                        </select>
                        <label for="">Select Time</label>
                        <input type='time' name="time[]" class="form-control" required value="{{$inquirySch['time']}}"/>
                    </div>
                    
                    @endforeach
                    
                    <div class="results"></div>


                    <div class="btn-group pull-right" style="color: #fff;">
                        <a class="clone btn btn-primary"> + Add More Days</a>
                     <!--   <a class="remove btn btn-danger"> Remove</a> -->
                    </div>
                </div>
                <div class="p-2">
                    <select name="duration" id="" class="form-control mb-2" required>
                        <option value="" hidden>Duration of Class</option>
                        @for($i = 15; $i <= 180; $i+=15)
                            <option {{$inquiry->duration==$i?'selected':''}} value="{{ $i }}">{{ $i }} Minutes</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-success">Update Schedule</button>
                </div>
            </div>
        </div>
    </form>
</section>

@section('js')
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/js/scripts/forms/select/form-select2.js"></script>
    <script type="text/javascript">
        $(function () {
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
        $('.wrapper').on('click', '.remove', function () {
            $('.remove').closest('.wrapper').find('.element').not(':first').last().remove();
        });
        $('.wrapper').on('click', '.clone', function () {
            $('.clone').closest('.wrapper').find('.element').first().clone().appendTo('.results');
        });
    </script>
@endsection
@stop
