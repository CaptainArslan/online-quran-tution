@extends("student.layouts.app")
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/chatbox.css') }}">
@endsection
@section('content')

@section('topbar-heading', 'Messenger')
<div class="container">
    <div class="row overflow-hidden shadow rounded-lg messenger mb-3">
        <!-- Chat Box-->
        <div class="col-lg-12 px-0">
          <div class=" pl-2 message-layer">
            <h5 class="text-white pt-1 text-uppercase">{{ $user->role.': '.$user->name ?? '' }}</h5>
          </div>
          <div class="px-4 pt-1 chat-box bg-white render-messages" id="render-messages"></div>


          <div action="#" class="bg-light">
            <div class="input-group">
              <input type="text" autocomplete="off" placeholder="Type a message" id="message" name="message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 bg-light message-input">
              <input type="hidden" name="" value="{{ $conversation_id ?? '' }}" id="convo_id" name="convo_id">
              <div class="input-group-append">
                <button id="btnSend" type="button" class="btn rounded-0 btn-dark"> <i class="fa fa-paper-plane"></i> Send</button>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('js')
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
    <script>
    $( document ).ready(function() {
    scrollChat();
    })
    </script>
    <script>
        $( document ).ready(function() {
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


            var initFirebase = function () {
                firebase.database().ref("/messages").orderByChild("conversation_id").equalTo(convo_id).on("value", function (snapshot) {

                    reloadConversation();
                });
            }


            var reloadConversation = function () {
                $.get("{{ route('get.chat') }}?id=" + convo_id, function (messages) {
                    $('.render-messages').html(messages);
                    scrollChat();
                });
            }
            $("#btnSend").click(function (e) {

                var self = $(this);
                var message = $('#message').val();

                if (message == '') {
                    alert('Enter message please');
                    return false;
                } else if (/^[0-9]+(\.[0-9]+)?$/.test(message)) {
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
                    success: function (response) {

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
        });
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
@endsection
