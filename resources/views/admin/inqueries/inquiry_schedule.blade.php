@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
{{-- claender css --}}
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
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
@include('admin.partials.success_message')
@section('topbar-heading', 'My Session')
<section>

  <div class="row mb-1 mt-3">
    <div class="col-sm-6 m-auto">
       <div class="card">
        <a href="">
          <div class="card-header d-flex align-items-start pb-0">
            <div>
              <h2 class="text-bold-700 mb-0 text-dark" style="padding: 5px 0px 25px 0px;">Inquiry Schedule</h2>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <a href="">
          <div class="card-header d-flex align-items-start pb-0">
            <div>
              <h2 class="text-bold-700 mb-0 text-info">{{count($final_classes) ?? ""}}</h2>
              <p class="text-info">Class Schedule</p>
            </div>
            <div class="avatar bg-rgba-warning p-50 m-0">
              <div class="avatar-content">
                <i class="feather icon-alert-octagon text-info font-medium-5"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>

      <div class="col-sm-4">
          <div class="card">
              <a href="#">
                  <div class="card-header d-flex align-items-start pb-0">
                      <div>
                          <h2 class="text-bold-700 mb-0 text-info">{{count($no_of_students)}}</h2>
                          <p class="text-info">No of Students</p>
                      </div>
                      <div class="avatar bg-rgba-warning p-50 m-0">
                          <div class="avatar-content">
                              <i class="feather icon-user-check text-info font-medium-5"></i>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
      </div>
      <div class="col-sm-4">
          <div class="card">
              <a href="#">
                  <div class="card-header d-flex align-items-start pb-0">
                      <div>
                          @php
                          $co=0;
                          $final=0;
                            foreach ($final_classes as $sch)
                                {
                                    if ($sch->inquiry->is_paid==false && $sch->inquiry->status != 'cancelled')
                                        {
                                            $co++;
                                        }
                                    else if($sch->inquiry->status=='started' ){
                                        $final++;
                                    }
                                }
                          @endphp
                          <h2 class="text-bold-700 mb-0 text-info">{{$co}}</h2>
                          <p class="text-info">New Trials</p>
                      </div>
                      <div class="avatar bg-rgba-warning p-50 m-0">
                          <div class="avatar-content">
                              <i class="feather icon-inbox text-info font-medium-5"></i>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
      </div>
      <div class="col-sm-4">
          <div class="card">
              <a href="#">
                  <div class="card-header d-flex align-items-start pb-0">
                      <div>

                          <h2 class="text-bold-700 mb-0 text-info">{{$final}}</h2>
                          <p class="text-info">Regular Classes</p>
                      </div>
                      <div class="avatar bg-rgba-warning p-50 m-0">
                          <div class="avatar-content">
                              <i class="feather icon-check-circle text-info font-medium-5"></i>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
      </div>


    <div class="col-sm-12 m-auto">
      <div class="card">
        <div class="card-body">
          <form method="GET" action="{{route('admin.inquiry.schedule')}}/{{$id ?? ''}}" class="filter-form">
        <div class="input-group">
          <input type="text" name="from" class="form-control datepicker filter" value="{{ $req->from ?? '' }}" placeholder="From">
          <input type="text" name="to" class="form-control datepicker  filter" value="{{ $req->to ?? '' }}" placeholder="To">
          <select class="form-control filter" name="filter_type">
            <option default selected>Select Filter</option>
            <option @if($req->filter_type) {{$req->filter_type=='daily'?'selected':''}} @endif value="daily">Today</option>
          </select>
          <div class="input-group-append">
            <button type="submit" name="filter" value="filter" class="btn btn-primary pl-2 pr-2">Filter</button>
            <button type="button" class="btn btn-danger reset pl-1 pr-1">Reset</button>
            <button type="submit" name="export" value="export" class="btn btn-info pl-2 pr-2">Export</button>
          </div>
        </div>
      </form>
        </div>
      </div>
    </div>
  </div>





  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12" id="">
              <div class="form-group">
                <strong>Selet Tutor</strong>
                <select name="" class="form-control select2" onchange="document.location=this.options[this.selectedIndex].value">
                  <option selected="" disabled="">Choose Tutuor</option>
                  @foreach($tutors as $inq)
                  <option value="{{ route('admin.inquiry.schedule',$inq->user_id ) }}?from={{$req->from ?? ''}}&to={{$req->to ?? ''}}" {{ $inq->user_id == $id ? 'selected' : '' }}>
                    {{ $inq->user->name ?? ''}}-({{$inq->user->email ?? ""}})
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Full calendar start -->
<section id="basic-examples">
  <div class="row">
    <div class="col-12">
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

          <div class="card">
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
                                        <table class="table table-bordered table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Day</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    @php $co=1;  @endphp
                                    @foreach($sched_calendar as $trial)
                                        @if($trial->inquiry->is_paid == false && $trial->inquiry->status != 'cancelled')
                                            @php $schedule = $trial; @endphp
                                           <tr>
                                           <td>{{$co++}}</td>
                                           <td>
                                                @if($schedule->day==1)
                                                    Monday
                                                @elseif($schedule->day==2)
                                                    Tuesday
                                                @elseif($schedule->day==3)
                                                    Wednesday
                                                @elseif($schedule->day==4)
                                                    Thursday
                                                @elseif($schedule->day==5)
                                                    Friday
                                                @elseif($schedule->day==6)
                                                    Saturday
                                                @elseif($schedule->day==7)
                                                    Sunday
                                                @endif
                                               </td>
                                           <td>{{$schedule->time}}</td>

                                       </tr>
                                        @endif

                                   @endforeach

                                </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="regular" aria-labelledby="regular-tab" role="tabpanel">
                                <table class="table table-bordered table-hover table-sm">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Day</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>

                                    @php $c=1;  @endphp
                                    @foreach($sched_calendar as $trial)
                                        @if($trial->inquiry->status == 'started' && $trial->inquiry->is_paid == true)
                                            @php $schedule = $trial; @endphp


                                            <tr>
                                           <td>{{$c++}}</td>
                                           <td>
                                                @if($schedule->day==1)
                                                    Monday
                                                @elseif($schedule->day==2)
                                                    Tuesday
                                                @elseif($schedule->day==3)
                                                    Wednesday
                                                @elseif($schedule->day==4)
                                                    Thursday
                                                @elseif($schedule->day==5)
                                                    Friday
                                                @elseif($schedule->day==6)
                                                    Saturday
                                                @elseif($schedule->day==7)
                                                    Sunday
                                                @endif
                                               </td>
                                           <td>{{$schedule->time}}</td>

                                       </tr>

                                        @endif
                                   @endforeach

                                </table>
                                </div>
                                </table>
                            </div>
                        </div>
              </div>
          </div>
    </div>

          <div class="card">
              <div class="card-content">
                  <div class="card-body">
                      <div class="table-responsive" style="height: 500px;overflow:auto;">
                          <table class="table table-bordered table-hover table-sm" id="table">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Tutor Name</th>
                                  <th>Tutor Email</th>
                                  <th>Tutor Phone</th>
                                  {{--    <th>Time</th>
                                      <th>Day</th>   --}}
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach ($schedules as $student)
                                  @if(empty($student->inquiry->user) || empty($student->inquiry))
                                      @continue
                                  @endif
                                  <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$student->inquiry->tutor->name ?? ''}}</td>
                                      <td>{{$student->inquiry->tutor->email ?? ''}}</td>
                                      <td>{{$student->inquiry->tutor->phone ?? ''}}</td>
                                      {{--     <td>{{$student->time}}</td>
                                           <td>

                                               @if($student->day == 1)
                                                   Monday
                                               @elseif($student->day == 2)
                                                   Tuesday
                                               @elseif($student->day == 3)
                                                   Wednesday
                                               @elseif($student->day == 4)
                                                   Thursday
                                               @elseif($student->day == 5)
                                                   Friday
                                               @elseif($student->day == 6)
                                                   Saturday
                                               @else
                                                   Sunday
                                               @endif

                                           </td>  --}}
                                      @if(isset($student->inquiry->tutor->id))
                                          <td><a class="btn btn-dark" href="{{url("/admin/tutor-specific-schedules-list/".$student->inquiry->tutor->id ?? '' )}}">View/Update Schedule</a></td>
                                      @else
                                          <td>N/A</td>
                                  @endif

                              @endforeach
                              </tbody>

                          </table>
                      </div>
                  </div>
              </div>
          </div>
      
  </div>
  <!-- calendar Modal starts-->
  <div class="modal fade text-left modal-calendar" tabindex="-1" role="dialog" aria-labelledby="cal-modal" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
      <div class="modal-content">
        <button type="button" class="close text-right pb-0" style="font-size: 25px;padding-right: 4px;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <div class="modal-body pt-0">
          <div class="text-cetner">
            <button class="btn-block btn btn-success font-weight-bold p-1" id="btnSessionStart">Start your Scheduled Session</button>
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
  $('.reset').click(function() {
    var uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
      var clean_uri = uri.substring(0, uri.indexOf("?"));
      window.history.replaceState({}, document.title, clean_uri);
      location.reload();
    }
  });
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
      events: [ @foreach($Events as $appointment)
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


      dateClick: function(info) {
        //$(".modal-calendar #cal-start-date").val(info.dateStr).attr("disabled", true);
        //$(".modal-calendar #cal-end-date").val(info.dateStr);
      },
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
      $(".modal-calendar").modal("show");
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

<script>
  $("#btnSessionStart").click(function() {
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
    }).done(function(data) {
      window.location.href = data.msg;
    });
  });
</script>
<script type="text/javascript">
</script>
@endsection
@stop
