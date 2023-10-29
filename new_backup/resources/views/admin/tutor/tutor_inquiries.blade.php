@extends('admin.layouts.app')
@section('title', 'Tutor | Inquiries List')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/calendars/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/calendars/extensions/daygrid.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/calendars/extensions/timegrid.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/core/menu/menu-types/horizontal-menu.css">
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/css/plugins/calendars/fullcalendar.css">
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
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>


<div class="row">
    <div class="col-sm-6 ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-info">{{ $total_appintments ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total Appintment(s)</h4>
          </div>
        </div>
      </div>
<div class="col-sm-6  ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-success">{{ $total_students ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total Student(s)</h4>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-info">{{ count($new) ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total New Trial(s)</h4>
          </div>
        </div>
      </div>
<div class="col-sm-6  ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-success">{{ count($regular) ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total Regular Classes</h4>
          </div>
        </div>
      </div>



</div>



<div class="row">
    
    
    
    
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Tutor Inquiries ({{$User->user->name ?? ""}} , {{$User->user->email ?? ""}} , {{$User->user->phone ?? ""}})</h4>

            </div>
            <div class="card-body">
                <ul class="nav nav-tabs mt-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" aria-controls="new" role="tab" aria-selected="true"><h5>New Trials</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="regular-tab" data-toggle="tab" href="#regular" aria-controls="regular" role="tab" aria-selected="true"><h5>Regular Classes</h5></a>
                        </li>
                    </ul>
                
                
                <div class="tab-content">
                    <div class="tab-pane active" id="new" aria-labelledby="new-tab" role="tabpanel">
                        <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable table-sm">
                        <thead>
                            <th>
                                ID
                            </th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Description</th>
                            <th>Payment Status</th>
                            <th>Inq. Status</th>
                            <th>Inq.Day</th>
                            <th>Created</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($new as $student)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$student->user->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->email ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->phone ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->inquiry ?? 'N/A'}}
                                </td>
                                <td>
                                    @if($student->is_paid)
                                    <span class="badge badge-success">Paid</span>
                                    @else
                                    <span class="badge badge-danger">Not Paid</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->status=="pending")
                                    <span class="badge badge-info">
                                        Pending {{ $student->tutor ? '(Tutor assigned)' : '' }}
                                    </span>
                                    @elseif($student->status=="started")
                                    <span class="badge badge-success">Started</span>
                                    @elseif($student->status=="cancelled")
                                    <span class="badge badge-danger">Cancel</span>
                                    @else
                                    <span class="badge badge-warning">On Trial</span>
                                    @endif
                                </td>
                                <td>{{$student->getInquiryDay($student['tutor_id'])}}</td>
                                <td width="12%">
                                    {{$student->created_at->diffForHumans()}}
                                </td>
                                <td width="30%">
                                    <div class="btn-group">
                                        <a href="{{route('admin.shared.edit.inquiry.schedule',$student->id)}}" class="btn btn-primary">Edit Schedule</a>
                                        @if($student->status=="on_trial")
                                        <a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>
                                        @elseif($student->status=="pending")

                                        @if(is_null($student->tutor_id))
                                        <a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>
                                        @else
                                        <a href="{{ route('admin.change.inquiry.status', [$student->id, 'on_trial']) }}" class="btn btn-warning">Start Trial</a>
                                        @endif
                                        @endif
                                        @if($student->status!="cancelled")
                                        <a href="#" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')" class="btn btn-danger">Cancel</a>
                                        @endif
                                        <a href="#" onclick="deleteAlert('{{ route('admin.remove.tutor.Inquiry', $student->id) }}')" class="btn btn-dark">Remove Tutor</a>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    </div>
                    <div class="tab-pane" id="regular" aria-labelledby="regular-tab" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable table-sm">
                        <thead>
                            <th>
                                ID
                            </th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Description</th>
                            <th>Payment Status</th>
                            <th>Inq. Status</th>
                            <th>Inq.Day</th>
                            <th>Created</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($regular as $student)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$student->user->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->email ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->user->phone ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$student->inquiry ?? 'N/A'}}
                                </td>
                                <td>
                                    @if($student->is_paid)
                                    <span class="badge badge-success">Paid</span>
                                    @else
                                    <span class="badge badge-danger">Not Paid</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->status=="pending")
                                    <span class="badge badge-info">
                                        Pending {{ $student->tutor ? '(Tutor assigned)' : '' }}
                                    </span>
                                    @elseif($student->status=="started")
                                    <span class="badge badge-success">Started</span>
                                    @elseif($student->status=="cancelled")
                                    <span class="badge badge-danger">Cancel</span>
                                    @else
                                    <span class="badge badge-warning">On Trial</span>
                                    @endif
                                </td>
                                <td>{{$student->getInquiryDay($student['tutor_id'])}}</td>
                                <td width="12%">
                                    {{$student->created_at->diffForHumans()}}
                                </td>
                                <td width="30%">
                                    <div class="btn-group">
                                        <a href="{{route('admin.shared.edit.inquiry.schedule',$student->id)}}" class="btn btn-primary">Edit Schedule</a>
                                        @if($student->status=="on_trial")
                                        <a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>
                                        @elseif($student->status=="pending")

                                        @if(is_null($student->tutor_id))
                                        <a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>
                                        @else
                                        <a href="{{ route('admin.change.inquiry.status', [$student->id, 'on_trial']) }}" class="btn btn-warning">Start Trial</a>
                                        @endif
                                        @endif
                                        @if($student->status!="cancelled")
                                        <a href="#" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')" class="btn btn-danger">Cancel</a>
                                        @endif
                                        <a href="#" onclick="deleteAlert('{{ route('admin.remove.tutor.Inquiry', $student->id) }}')" class="btn btn-dark">Remove Tutor</a>
                                        
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inquiry Schedule Detail</h5>
                        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="ajax_load">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="col-md-12">
                  <span  class="font-weight-bold btn btn-success" style="padding: 6px 22px;"></span><span class="">Regular Class</span>
                  <span  class="btn btn-primary font-weight-bold btn  ml-2"  style="padding: 6px 22px;"></span><span class="">Trial Class</span>
              </div>
            <div id='fc-default'></div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@section('js')
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/fullcalendar.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/daygrid.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/timegrid.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/interactions.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript">
    $(document).on('click', '#close', function(e) {
        $('#ajax_load').empty();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // color object for different event types
        var colors = {
            primary: "#7367f0",
            success: "#28c76f",
            danger: "#ea5455",
            warning: "#ff9f43"
        };

        // chip text object for different event types
        var categoryText = {
            primary: "Others",
            success: "Business",
            danger: "Personal",
            warning: "Work"
        };
        var categoryBullets = $(".cal-category-bullets").html(),
            evtColor = "",
            eventColor = "";

        // calendar init
        var calendarEl = document.getElementById('fc-default');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ["timeGrid", "interaction"],
            customButtons: {
                addNew: {
                    text: ' Add',
                    /* click: function() {
                               var calDate = new Date,
                               todaysDate = calDate.toISOString().slice(0, 10);
                               $(".modal-calendar").modal("show");
                               $(".modal-calendar .cal-submit-event").addClass("d-none");
                               $(".modal-calendar .remove-event").addClass("d-none");
                               $(".modal-calendar .cal-add-event").removeClass("d-none")
                               $(".modal-calendar .cancel-event").removeClass("d-none")
                               $(".modal-calendar .add-category .chip").remove();
                               $("#cal-start-date").val(todaysDate);
                               $("#cal-end-date").val(todaysDate);
                               $(".modal-calendar #cal-start-date").attr("disabled", false);
                           }*/
                }
            },


            header: {
                left: "",
                center: "",
                right: "prev,title,next"
            },
            displayEventTime: true,
            navLinks: true,
            editable: true,
            allDay: true,
            events: [
          
           @foreach($Events as $appointment)
            {
                
                start : '{{ $appointment['start'] }}',
                @if( $appointment['title'] =='(Regular)')
                    className: "bg-success",
                @endif
            },

           @endforeach
          ],


            // navLinkDayClick: function(date) {
            //
            //   $(".modal-calendar").modal("show");
            // },


            // dateClick: function(info) {
            //     //$(".modal-calendar #cal-start-date").val(info.dateStr).attr("disabled", true);
            //     //$(".modal-calendar #cal-end-date").val(info.dateStr);
            // },


            eventClick: function(info) {
                var schedules_id = info.event.extendedProps.schedules_id;
                var url_A = "{{ route('admin.tutor_inq_sch_detail') }}?id=";
                $.ajax({
                    type: "GET",
                    url: url_A + "" + schedules_id,
                    beforeSend: function() {
                        $('#ajax_load').append("<i class='fas fa-spinner fa-spin'></i> &nbsp; Processing...");
                        $('#exampleModal').modal('show');
                    },
                    success: function(response) {
                        $('#ajax_load').empty();
                        $("#ajax_load").html(response);
                    }
                });
            }
            // displays saved event values on click
            /* eventClick: function(info) {
               $(".modal-calendar").modal("show");
               $(".modal-calendar #cal-event-title").val(info.event.title);
               $(".modal-calendar #cal-start-date").val(moment(info.event.start).format('YYYY-MM-DD'));
               $(".modal-calendar #cal-end-date").val(moment(info.event.end).format('YYYY-MM-DD'));
               $(".modal-calendar #cal-description").attr("href", info.event.extendedProps.description);
               $(".modal-calendar .cal-submit-event").removeClass("d-none");
               $(".modal-calendar .remove-event").removeClass("d-none");
               $(".modal-calendar .cal-add-event").addClass("d-none");
               $(".modal-calendar .cancel-event").addClass("d-none");
               $(".calendar-dropdown .dropdown-menu").find(".selected").removeClass("selected");
               var eventCategory = info.event.extendedProps.dataEventColor;
               var eventText = categoryText[eventCategory]
               $(".modal-calendar .chip-wrapper .chip").remove();
               $(".modal-calendar .chip-wrapper").append($("<div class='chip chip-" + eventCategory + "'>" +
                 "<div class='chip-body'>" +
                 "<span class='chip-text'> " + eventText + " </span>" +
                 "</div>" +
                 "</div>"));
             },*/
        });

        // render calendar
        calendar.render();

        // appends bullets to left class of header
        $("#basic-examples .fc-right").append(categoryBullets);

        // Close modal on submit button
        $(".modal-calendar .cal-submit-event").on("click", function() {
            $(".modal-calendar").modal("hide");
        });

        // Remove Event
        $(".remove-event").on("click", function() {
            var removeEvent = calendar.getEventById('newEvent');
            removeEvent.remove();
        });


        // reset input element's value for new event
        if ($("td:not(.fc-event-container)").length > 0) {
            $(".modal-calendar").on('hidden.bs.modal', function(e) {
                $('.modal-calendar .form-control').val('');
            })
        }

        // remove disabled attr from button after entering info
        $(".modal-calendar .form-control").on("keyup", function() {
            if ($(".modal-calendar #cal-event-title").val().length >= 1) {
                $(".modal-calendar .modal-footer .btn").removeAttr("disabled");
            } else {
                $(".modal-calendar .modal-footer .btn").attr("disabled", true);
            }
        });

        // open add event modal on click of day
        $(document).on("click", ".fc-day", function() {
            //$(".modal-calendar").modal("show");
            $(".calendar-dropdown .dropdown-menu").find(".selected").removeClass("selected");
            $(".modal-calendar .cal-submit-event").addClass("d-none");
            $(".modal-calendar .remove-event").addClass("d-none");
            $(".modal-calendar .cal-add-event").removeClass("d-none");
            $(".modal-calendar .cancel-event").removeClass("d-none");
            $(".modal-calendar .add-category .chip").remove();
            $(".modal-calendar .modal-footer .btn").attr("disabled", true);
            evtColor = colors.primary;
            eventColor = "primary";
        });

        // change chip's and event's color according to event type
        $(".calendar-dropdown .dropdown-menu .dropdown-item").on("click", function() {
            var selectedColor = $(this).data("color");
            evtColor = colors[selectedColor];
            eventTag = categoryText[selectedColor];
            eventColor = selectedColor;

            // changes event color after selecting category
            $(".cal-add-event").on("click", function() {
                calendar.addEvent({
                    color: evtColor,
                    dataEventColor: eventColor,
                    className: eventColor
                });
            })

            $(".calendar-dropdown .dropdown-menu").find(".selected").removeClass("selected");
            $(this).addClass("selected");

            // add chip according to category
            $(".modal-calendar .chip-wrapper .chip").remove();
            $(".modal-calendar .chip-wrapper").append($("<div class='chip chip-" + selectedColor + "'>" +
                "<div class='chip-body'>" +
                "<span class='chip-text'> " + eventTag + " </span>" +
                "</div>" +
                "</div>"));
        });

        // calendar add event
        $(".cal-add-event").on("click", function() {
            $(".modal-calendar").modal("hide");
            var eventTitle = $("#cal-event-title").val(),
                startDate = $("#cal-start-date").val(),
                endDate = $("#cal-end-date").val(),
                eventDescription = $("#cal-description").val(),
                correctEndDate = new Date(endDate);
            calendar.addEvent({
                id: "newEvent",
                title: eventTitle,
                start: startDate,
                end: correctEndDate,
                description: eventDescription,
                color: evtColor,
                dataEventColor: eventColor,
                allDay: true
            });
        });

        // date picker
        $(".pickadate").pickadate({
            format: 'yyyy-mm-dd'
        });
    });
</script>

@endsection
