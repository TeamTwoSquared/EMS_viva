@php
 use App\Http\Controllers\ChatboxController;
 use App\Http\Controllers\client\ClientsController;
 use App\Client;
 $messages=ChatboxController::getMessages($my_event_id);
 $currentUser=ClientsController::getClient();
@endphp
<h3 class=" text-center chatbox-heading"><strong>CHAT BOX </strong> </h3>
<br>
<div class="row"> 
    <div class="chatbox">
        @foreach ($messages as $message)
        @php
            $client=Client::find($message->customer_id);
            $time = date('g:i A', strtotime($message->timestamp));
            $date = date('M j', strtotime($message->timestamp));
        @endphp
        @if($client!=$currentUser)
            <div class="incoming_msg">
                <div class="incoming_msg_img">
                    <img src="/storage/images/profile/{{$client->profilepic}}" alt="{{$client->name}}">
                </div>
                <div class="received_msg">
                    <div class="received_withd_msg">
                    <p>{{$message->message}}</p>
                    <span class="time_date"> {{$time}}   |    {{$date}}</span></div>
                </div>
            </div>
        @else
            <div class="outgoing_msg">
                    <div class="sent_msg">
                        <p>{{$message->message}}</p>
                        <span class="time_date"> {{$time}}    |    {{$date}}</span>
                    </div>
                </div>
        @endif            
        @endforeach
    </div>
</div>
<div class="row">
    <div class="type_msg">
        <div class="input_msg_write">
            <form action="sendMessage" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden"id="customer_id" name="customer_id" value="{{$currentUser->customer_id}}">
                <input type="hidden"id="event_id3" name="event_id" value="{{$my_event_id}}">
                <input type="text" id="message" name="message"class="write_msg" placeholder="Type a message" />
                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>
</div>