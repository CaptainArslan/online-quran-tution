@extends("tutor.layouts.app")
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
{{-- claender css --}}
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
@section('topbar-heading', 'My Appointments')
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
      <div class="col-sm-6  ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-info">{{  $paid_students ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Converted Student(s)</h4>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6  ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold text-success">{{ $total_trails_in_month ?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Total Trail(s) in this month</h4>
          </div>
        </div>
      </div>

      <div class="col-sm-12  ">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="font-weight-bold {{ ($convershion_rate >= 0.5 && $convershion_rate <= 1) ? 'text-success' : 'text-danger' }}">{{ $convershion_rate?? '0' }}</h1>
            <h4 class="font-weight-bolder"> Conversion Rate</h4>
          </div>
        </div>
      </div>



</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="text-center  pt-1">
                <h3 class="text-uppercase text-info mb-0">My Appointments</h3>
            </div>
            <div class="card-body ">

                <ul class="nav nav-tabs mt-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" aria-controls="new" role="tab" aria-selected="true"><h5>New Trials</h5></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="regular-tab" data-toggle="tab" href="#regular" aria-controls="regular" role="tab" aria-selected="true"><h5>Regular Classes</h5></a>
                    </li>
                </ul>
                <div class="tab-content tutor-unread-messages">
                    
                </div>                
            </div>
        </div>
    </div>
    
    @if(count(auth()->user()->schedules)>0)
    <div class="col-md-12">
        <div class="card">
            <div class="text-center  pt-1">
                <h3 class="text-uppercase text-info mb-0">My Schedules</h3>
            </div>
            <div class="card-body">
                 <table class="table table-bordered table-striped datatable table-sm">
                        <thead>
                            <th>SR#</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Student Name</th>
                            <th>Child Profile</th>
                            <th>Skype Id</th>
                      
                            
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->schedules as $schedule)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
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
                                <td>
                                    {{$schedule->time}}
                                </td>
                                <td>{{$schedule->inquiry->user->name}}</td>
                                <td>{{$schedule->inquiry->child->name}}</td>
                                <td>{{ $schedule->inquiry->child->skype_id }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
    </div>
    
</div>
    @endif
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
    </div>
  </div>




    @if(isset($student->name))
        <input type="hidden" id="session_zoom" value="{{$session_zoom}}">
        <div class="modal fade text-left review_modal" tabindex="-1" role="dialog" aria-labelledby="cal-modal" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reviews to {{$student->name}}</h4>
                        <button type="button" class="close text-right pb-0" style="font-size: 25px;padding-right: 4px;" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <form action="{{route('tutor.review.student')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tutor_id" value="{{auth()->user()->id}}">
                            <input type="hidden" name="student_id" value="{{$student->id}}">
                            <input type="hidden" name="inquiry_session_id" value="{{$session}}">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="form-group mb-0" style="padding-top: 7px!important;">
                                        <h5 class="mb-0">Behavior</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="starrating risingstar float-left d-flex justify-content-center flex-row-reverse  ">
                                        <input type="radio" id="behavior5" name="behavior" value="5" required /><label for="behavior5" title="5 star"></label>
                                        <input type="radio" id="behavior4" name="behavior" value="4" /><label for="behavior4" title="4 star"></label>
                                        <input type="radio" id="behavior3" name="behavior" value="3" /><label for="behavior3" title="3 star"></label>
                                        <input type="radio" id="behavior2" name="behavior" value="2" /><label for="behavior2" title="2 star"></label>
                                        <input type="radio" id="behavior1" name="behavior" value="1" /><label for="behavior1" title="1 star"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="form-group mb-0" style="padding-top: 7px!important;">
                                        <h5 class="mb-0">Attention</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="starrating risingstar float-left d-flex justify-content-center flex-row-reverse  ">
                                        <input type="radio" id="attention5" name="attention" value="5" required /><label for="attention5" title="5 star"></label>
                                        <input type="radio" id="attention4" name="attention" value="4" /><label for="attention4" title="4 star"></label>
                                        <input type="radio" id="attention3" name="attention" value="3" /><label for="attention3" title="3 star"></label>
                                        <input type="radio" id="attention2" name="attention" value="2" /><label for="attention2" title="2 star"></label>
                                        <input type="radio" id="attention1" name="attention" value="1" /><label for="attention1" title="1 star"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="form-group mb-0" style="padding-top: 7px!important;">
                                        <h5 class="mb-0">Progress</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="starrating risingstar float-left d-flex justify-content-center flex-row-reverse  ">
                                        <input type="radio" id="progress5" name="progress" value="5" required /><label for="progress5" title="5 star"></label>
                                        <input type="radio" id="progress4" name="progress" value="4" /><label for="progress4" title="4 star"></label>
                                        <input type="radio" id="progress3" name="progress" value="3" /><label for="progress3" title="3 star"></label>
                                        <input type="radio" id="progress2" name="progress" value="2" /><label for="progress2" title="2 star"></label>
                                        <input type="radio" id="progress1" name="progress" value="1" /><label for="progress1" title="1 star"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center" style="margin-top: 12px;">
                                <div class="col-md-4">
                                    <h5 class="mb-0">Duration of Class(minutes)</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" required min="0" name="class_duration" class="form-control">
                                </div>
                            </div>
                            <div class="row justify-content-center" style="margin-top: 12px;">
                                <div class="col-md-4">
                                    <h5 class="mb-0" style="padding-top: 7px;">Screenshot</h5>
                                </div>
                                <div class="col-md-8" >
                                    <input type="file"  name="screenshot" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2 btn-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                        <div class="text-cetner">

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif



@stop
@section('js')

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
          click: function() {
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
          }
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
      
     
      navLinkDayClick: function(date) {
        $(".modal-calendar").modal("show");
      },


      dateClick: function(info) {
        //$(".modal-calendar #cal-start-date").val(info.dateStr).attr("disabled", true); 
        //$(".modal-calendar #cal-end-date").val(info.dateStr);
      },
      // displays saved event values on click
      eventClick: function(info) {
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
      },
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
        $(document).ready(function () {

            $('.start-session').click(function () {
                $(".modal-calendar").modal("show");
            });

        });
    </script>
    
    <script>
            $(document).ready(function () {
                console.log($('#session_zoom').val());
                if ($('#session_zoom').val()==1)
                {
                    $('.review_modal').modal('show');
                }

            });
        </script>

@endsection




