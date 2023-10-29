@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    {{-- claender css --}}
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/vendors/css/calendars/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/vendors/css/calendars/extensions/daygrid.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/vendors/css/calendars/extensions/timegrid.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_theme')}}/app-assets/css/plugins/calendars/fullcalendar.css">
    <style>
        .fc-content .fc-time {
            font-size: 24px !important;
            text-align: center !important;
            color: white;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    @include('admin.partials.success_message')
    <div class="card">
        
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive" style="height: 500px;overflow:auto;">
                    <table class="table table-bordered table-hover table-sm" id="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Student Phone</th>
                            <th>Tutor Name</th>
                            <th>Tutor Email</th>
                            <th>Tutor Phone</th>
                            
                            <th>Action</th>
                            {{--<th>Status</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            
                        @foreach ($schedules as $student)
                            @if(empty($student->inquiry->user) || empty($student->inquiry))
                                @continue
                            @endif
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$student->inquiry->user->name ?? ''}}</td>
                                <td>{{$student->inquiry->user->email ?? ''}}</td>
                                <td>{{$student->inquiry->user->phone ?? ''}}</td>
                                <td>
                                    <a href={{url("/admin/tutor-specific-schedules-list/".$student->inquiry->tutor->id)}}>{{$student->inquiry->tutor->name ?? ''}}</a>
                                </td>
                                <td>{{$student->inquiry->tutor->email ?? ''}}</td>
                                <td>{{$student->inquiry->tutor->phone ?? ''}}</td>
                                
                                <td><a href="{{url('/admin/edit/inquiry-schedule/'.$student->inquiry->id)}}" class="btn btn-dark">Edit</a></td>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- calendar Modal starts-->
    <div class="modal fade text-left modal-calendar" tabindex="-1" role="dialog" aria-labelledby="cal-modal"
         aria-modal="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
            <div class="modal-content">
                <button type="button" class="close text-right pb-0" style="font-size: 25px;padding-right: 4px;"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-body pt-0">
                    <div class="text-cetner">
                        <button class="btn-block btn btn-success font-weight-bold p-1" id="btnSessionStart">Start your
                            Scheduled Session
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- calendar Modal ends-->
    </section>
    <!-- // Full calendar end -->
@section('js')
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/fullcalendar.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/daygrid.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/timegrid.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/interactions.min.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{asset('admin_theme')}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    {{-- <script src="{{asset('admin_theme')}}/app-assets/js/scripts/extensions/fullcalendar-custom.js"></script> --}}
    <script>
        $('#table').dataTable({
            "order": [
                [0, "asc"]
            ],
            "pageLength": 25
        });
    </script>
   

    <script>
        $("#btnSessionStart").click(function () {
            $(this).html('Creating Session...');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('tutor.session_create') }}",
                data: {
                    inquiry_id: {
                        $id
                    }
                },
            }).done(function (data) {
                window.location.href = data.msg;
            });
        });
    </script>
    <script type="text/javascript">
    </script>
@endsection
@stop
