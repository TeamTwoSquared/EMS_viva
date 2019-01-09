@extends('layouts.svp')

@section('content')


<div class="container">
          
    @foreach ($notfication_title as $notification)
        <div class="alert alert-info" role="alert"> 
        <a href="/svp/notification/{{$notification->notification_id}}">
                <p>EMS Support Center</p>
            </a>
        </div>
    @endforeach

 <!-- support request comments-->

    @foreach ($help_comment as $comment)
        <div class="alert alert-info" role="alert"> 
        <a href="/svp/notification/{{$comment->notification_id}}">
                <p>EMS Support Center</p>
            </a>
        </div>
    @endforeach
                   
</div>

 
@endsection 