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
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/chatbox.css') }}">
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
@section('topbar-heading', 'Session')


<!--
    <div class="col-md-12 mb-2 text-right">
        <a href="{{route('tutor.edit.schedule',$id)}}" class="btn btn-primary ">Edit Schedule</a>
    </div>
 -->
 
 @php $last_session=\App\Models\Inquiry_Session::where('inquiry_id',$id)->whereDate('created_at',today()->format('Y-m-d'))->orderBy('created_at','DESC')->first(); @endphp
 @if($last_session)
 @php
        $session_time=$last_session->created_at;
        $add_hour=$last_session->created_at->modify('+60 minutes');
        $date = new DateTime;
        $date->modify('-60 minutes');
        $formatted = $date->format('Y-m-d H:i:s');
    @endphp
 @if($last_session  &&  $last_session->created_at->format('Y-m-d')==now()->format('Y-m-d') )
 
    
    <div class="col-12 p-0">
        <div class="card">
            <div class="card-body bg-primary">
                    <div class="row">
                        <div class="col-md-8 col-8 " style="padding-top:8px;">
                            <input type="text" id="link" class="w-100" value="{{$last_session->join_url}}">
                        </div>
                        <div class="col-4 text-right">
                            <a href="javascript:;" class="btn btn-white" id="copy">Copy Student Link</a>
                        </div>

                    </div>

                </div>
        </div>
    </div>
 @endif
 @endif
@php $user=$std; @endphp
<div class="col-md-12 p-0">
    <div class="card">
        <div class="card-body">
            <table class="table dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($schedules as $schedule)
                    @php
                    $daynum = date("N", strtotime("wednesday"));
                        if ($schedule->day==1)
                            $day='Monday';
                        elseif($schedule->day==2)
                            $day='Tuesday';
                        elseif($schedule->day==3)
                            $day='Wednesday';
                        elseif($schedule->day==4)
                            $day='Thursday';
                        elseif($schedule->day==5)
                            $day='Friday';
                        elseif($schedule->day==6)
                            $day='Saturday';
                        elseif($schedule->day==7)
                            $day='Sunday';
                            
                            
                    @endphp
                    
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$day}}</td>
                        <td><span class="badge badge-dark">{{$schedule->time}}</span></td>
                        <td>
                            <button  class="btn btn-primary  start-session " type="button">Start</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>







<!-- Full calendar start -->
<section id="basic-examples">
{{--  <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-content">--}}
{{--                    <div class="card-body">--}}

{{--                          <div  class="text-center">--}}
{{--                            <h5>Student Information</h5>--}}
{{--                          </div>--}}

{{--                        <ul class="list-group">--}}
{{--                          <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                              <h5>Name:</h5>--}}
{{--                              <h5><span class="text-primary">{{ $std->name ?? 'N/A' }}</h5>--}}

{{--                          </li>--}}
{{--                            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                              <h5>Contact:</h5>--}}
{{--                              <a href="{{ route('messenger', $std->id ?? '' ) }}" target="_blank" class="btn btn-success">Send a message</a>--}}
{{--                          </li>--}}

{{--                        </ul>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class=" overflow-hidden shadow rounded-lg messenger mb-3">
        <!-- Chat Box-->
        <div class="col-12 px-0">
            <div class=" pl-2 message-layer">
                <h5 class="text-white pt-1 text-uppercase">{{ $user->role.': '.$user->name ?? '' }}</h5>
            </div>
            <div class="px-4 pt-1 chat-box bg-white render-messages" id="render-messages"></div>


            <div action="#" class="bg-light">
                <div class="input-group">
                    <input type="text" placeholder="Type a message" autocomplete="off" id="message" name="message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 bg-light message-input">
                    <input type="hidden" name="" value="{{ $conversation_id ?? '' }}" id="convo_id" name="convo_id">
                    <div class="input-group-append">
                        <button id="btnSend" type="button" class="btn rounded-0 btn-dark"> <i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div id='fc-default'></div>
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

@endsection
<!-- // Full calendar end -->
@section('js')

<script src="{{asset('admin_theme')}}/app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/fullcalendar.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/daygrid.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/timegrid.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/calendar/extensions/interactions.min.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{asset('admin_theme')}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>


<script>
    $( document ).ready(function() {
        scrollChat();
    })
</script>
<script>
    var config = {
        apiKey: "{{config('services.firebase.api_key')}}",
        authDomain: "{{config('services.firebase.auth_domain')}}",
        databaseURL: "{{config('services.firebase.database_url')}}",
        projectId: "{{config('services.firebase.project_id')}}",
        storageBucket: "{{config('services.firebase.storage_bucket')}}",
        messagingSenderId: "{{config('services.firebase.messaging_sender_id')}}"
    };
    firebase.initializeApp(config);

    var convo_id = '{{ $conversation_id }}';


    var initFirebase = function(){
        firebase.database().ref("/messages").orderByChild("conversation_id").equalTo(convo_id).on("value", function(snapshot) {

            reloadConversation();
        });
    }


    var reloadConversation = function(){
        $.get("{{ route('get.chat') }}?id="+convo_id, function(messages){

            $('.render-messages').html(messages);

            scrollChat();
        });
    }
    $("#btnSend").click(function(e) {

        var self = $(this);
        var message = $('#message').val();

        if(message == '')
        {
            alert('Enter message please');
            return false;
        }
        else if (/^[0-9]+(\.[0-9]+)?$/.test(message))
        {
            alert('Numbmer sharing is not allowed!');
            return false;
        }



        self.attr('disabled', true);


        $.ajax({
            url: '{{ route("save.messsage") }}',
            data: {
                message: message,
                con_id: {{ $conversation_id }},
                receiver_id: {{ $user->id }},
            },
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(response) {

                self.attr('disabled', false);
                $('#message').val('');
                initFirebase();
                reloadConversation();
                scrollChat();

            }
        });
    });
    initFirebase();
    reloadConversation();
</script>
<script>
    var scrollChat = function()
    {
        var objDiv = document.getElementById("render-messages");
        objDiv.scrollTop = objDiv.scrollHeight;
    }
</script>

<script>
    var input = document.getElementById("message");

    input.addEventListener("keyup", function(event) {

        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("btnSend").click();
        }
    });
</script>


{{-- <script src="{{asset('admin_theme')}}/app-assets/js/scripts/extensions/fullcalendar-custom.js"></script> --}}
<script>
    $(document).ready(function(){
       $('.cannot-start').click(function(){
           Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Cannot Start class untill student pay for the class!',

            })
       }) ;
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
      events: <?php echo json_encode($Events); ?>,
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
        inquiry_id:{{$id}},
      }
    }).done(function(data) {
      console.log(data.msg);

      if(data.code == 400)
      {
          toastr.error(data.msg);
          $('#btnSessionStart').html('Start your scheduled session');
        $(".modal-calendar").modal("hide");
      }
      else
      {
        window.location.href = data.msg;
      }


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
    $(document).on("click","#copy", function(event) {
        var elm = $(this).closest('.row').find('#link');
        $(elm).select();
        document.execCommand("copy");
        $('#copy').text('Copy');
        $(this).text('Copied');
    });
</script>





@endsection

