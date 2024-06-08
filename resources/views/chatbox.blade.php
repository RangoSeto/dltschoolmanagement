<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Chat Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  
</head>
<body>

  <div>
    
    <div id="display">
        {{-- messages will show in here --}}
    </div>

    <input type="text" id="message" placeholder="Write Something..." />
    <button type="button" id="send">Send</button>

  </div>


  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>

    $(document).ready(function(){

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('a24ca07f1075421c571e', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('chat-channel');

        channel.bind('message-event', function(data) {
            // alert(JSON.stringify(data));
            console.log(data);
            $("#display").append('<p>'+data.message+'</p>');
        });



        $("#send").click(function(){
            const message = $("#message").val();
            // console.log(message);

            $.ajax({
                url: '/chatmessages',
                type:"POST",
                data:{
                    sms:message
                },
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    console.log(response);
                }
            });
        });


    });


    
  </script>
</body>
</html>
