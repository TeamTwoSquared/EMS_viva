@extends('layouts.admin')
@section('content')


<div class="container">
          
    @foreach ($notfication_title as $notification)
        <div class="alert alert-info" role="alert" onclick="console.log('hi')"> 
        <a href="/admin/notification/{{$notification->notification_id}}">
                {{$notification->notification}}
            </a>
        </div>
    @endforeach

 <!-- support request comments-->

    @foreach ($support_comments as $comment)
        <div class="alert alert-info" role="alert"> 
        <a href="/admin/notification/{{$comment->notification_id}}">
                {{$comment->notification}}
            </a>
        </div>
    @endforeach
                   
</div>
@endsection 