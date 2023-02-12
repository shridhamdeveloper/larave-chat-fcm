@extends('layouts.app')

@section('content')
<style type="text/css">
    .chat-container{
        display: flex;
        flex-direction: column;
    }
    .chat {
        border: 1px solid gray;
        border-radius: 3px;
        width: 50%;
        padding: 0.5em;
    }
    .chat-left{
        background-color: white;
        align-self: flex-start;
    }
    .chat-right{
        background-color: #adff2f7f;
        align-self: flex-end;
    }
    .message-input-container{
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: white;
        border: 1px solid gray;
        padding: 1em;
    }
</style>
<div class="container" style="margin-bottom: 480px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="chat-container">
                        @if(count($chats) === 0)
                            <p>There is no chat yet.</p>
                        @endif
                        @if(!empty($chats))
                            @foreach($chats as $chat)
                                @if($chat->sender_id === Auth::user()->id)
                                    <p class="chat chat-right">
                                        <b>{{$chat->sender_name}} :</b> </br>
                                        {{$chat->message}}
                                    </p>
                                @else
                                    <p class="chat chat-left">
                                        <b>{{$chat->sender_name}} :</b> </br>
                                        {{$chat->message}}
                                    </p>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="message-input-container">
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label>Message</label>
            <input type="text" name="message" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">SEND MESSAGE</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script type="module">
    // Import the functions you need from the SDKs you need
      import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
      import { getMessaging, getToken, onMessage} from "https://www.gstatic.com/firebasejs/9.17.1/firebase-messaging.js";
      // TODO: Add SDKs for Firebase products that you want to use
      // https://firebase.google.com/docs/web/setup#available-libraries

      // Your web app's Firebase configuration
      const firebaseConfig = {
        apiKey: "AIzaSyA8a-DXtzqupLMU5UJuTuQ2N1PAy7PLGwA",
        authDomain: "chatsi-realtime-laravel-3ee6e.firebaseapp.com",
        projectId: "chatsi-realtime-laravel-3ee6e",
        storageBucket: "chatsi-realtime-laravel-3ee6e.appspot.com",
        messagingSenderId: "755761302018",
        appId: "1:755761302018:web:fd11c184a8a7819700751b"
      };

      // Initialize Firebase
      const firebase = initializeApp(firebaseConfig);

    const messaging = getMessaging(firebase);
    // getToken({vapidKey: "BDgYewWdsGICqMGBsC_HpJkqRw1yVD7w8rVw2BV4gOhYElJLBQ5pj0aEclrd1DpcV0JcksboSGuYmM6Oza8czFE"});
    // messaging.usePublicVapidKey("BDgYewWdsGICqMGBsC_HpJkqRw1yVD7w8rVw2BV4gOhYElJLBQ5pj0aEclrd1DpcV0JcksboSGuYmM6Oza8czFE");

    function sendTokenToServer(fcm_token){
        const user_id = '{{Auth::user()->id}}';
        axios.post('/api/save-token',{
            fcm_token, user_id
        }).then(res => {
            console.log(res);
        })
    }

    function retrieveToken(){
        getToken(messaging, { vapidKey: "BDgYewWdsGICqMGBsC_HpJkqRw1yVD7w8rVw2BV4gOhYElJLBQ5pj0aEclrd1DpcV0JcksboSGuYmM6Oza8czFE" })
                    .then((currentToken) => {
            if (currentToken) {
                sendTokenToServer(currentToken);
                // updateUIForPushEnabled(currentToken);
            } else {
                // Show permission request.
                // console.log('No Instance ID token available. Request permission to generate one.');
                // Show permission UI.
                // updateUIForPushPermissionRequired();
                // setTokenSentToServer(false);
                alert('You should allow notification!');
            }
        }).catch((err) => {
            console.log(err.message);
            // showToken('Error retrieving Instance ID token. ', err);
            // setTokenSentToServer(false);
        });
    }

    retrieveToken();

    // onNewToken(() => {
    //     retrieveToken();
    // });

    onMessage(messaging, (payload) => {
      console.log('Message received. ', payload);
      // ...
    });
</script>
@endsection
