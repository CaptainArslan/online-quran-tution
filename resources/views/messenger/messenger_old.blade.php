<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chatbox.css') }}">
    <title>Messenger</title>
  </head>
  <body>
      <header class="text-center p-2 bg-white mb-2">
        
        <a href="{{ route('index') }}">
          <img alt="" class="img-fluid" width="140" src="{{asset('/images/logo.png')}}">
        </a>
      </header>
    <div class="container ">

      <div class="row rounded-lg overflow-hidden shadow messenger p-2 mb-3">
        <div class="col-lg-4 mb-3 p-0">
          <div class="card card-help profile-box" style="border-right:1px solid #ccc !important;">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <div class="mt-3">
                  <h4>{{ $user->name ?? '' }}</h4>
                  <p class="text-secondary mb-1 font-weight-bold text-uppercase">{{ $user->role ?? '' }}</p>
                  <p class="text-muted font-size-sm">Member Since: {{ $user->created_at->diffForHumans() ?? '' }}</p>
                  <hr>
                  <div class="btn-group">
                    <a href="{{ route('index') }}" class="btn btn-primary">Go Home</a>

                    @if(Auth::User()->role == 'student')
                      <a href="{{ route('student.dashboard') }}" class="btn btn-dark">Go to dashbaord</a>
                    @else
                      <a href="{{ route('tutor.appointments') }}" class="btn btn-dark">Go to dashbaord</a>
                    @endif

                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Chat Box-->
        <div class="col-lg-8 px-0">
          <div class="p-2 message-layer">
            <h5 class="text-white pt-1">Messages</h5>
          </div>
          <div class="px-4 chat-box bg-white render-messages pt-2" id="render-messages"></div>


          <div action="#" class="bg-light">
            <div class="input-group">
              <input type="text" placeholder="Type a message" id="message" name="message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 bg-light message-input">
              <input type="hidden" name="" value="{{ $conversation_id ?? '' }}" id="convo_id" name="convo_id">
              <div class="input-group-append">
                <button id="btnSend" type="button" class="btn rounded-0 btn-dark"> <i class="fa fa-paper-plane"></i> Send</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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

    var convo_id = {{ $conversation_id }};


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
  </body>
</html>