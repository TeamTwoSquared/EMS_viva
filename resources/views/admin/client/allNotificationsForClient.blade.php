@extends('layouts.client')
@section('content')


<div class="container" data-pg-collapsed>
    <hr>
        <div class="row pg-empty-placeholder"></div>
        <div class="row" data-pg-collapsed>
            <div class="col-md-2" data-pg-collapsed>
                <div class="card bg-dark text-white" data-pg-collapsed>
                    <img class="card-img" alt="Card image" src="http://pinegrow.com/placeholders/img11.jpg"/>    
                </div>             
                
                <div class="card bg-dark text-white" data-pg-collapsed>
                        <img class="card-img" alt="Card image" src="http://pinegrow.com/placeholders/img11.jpg"/>    
                </div>             
               
                <div class="card bg-dark text-white" data-pg-collapsed>
                        <img class="card-img" alt="Card image" src="http://pinegrow.com/placeholders/img11.jpg"/>    
                </div>             
             
                <div class="card bg-dark text-white" data-pg-collapsed>
                        <img class="card-img" alt="Card image" src="http://pinegrow.com/placeholders/img11.jpg"/>    
                </div>             
            </div>
            <div class="col-md-7" data-pg-collapsed> 
                
                <!-- start notification container-->

                    <div class="container">
          
                            @foreach ($notfication_title as $notification)
                                <div class="alert alert-info" role="alert"> 
                                <a href="/client/notification/{{$notification->notification_id}}">
                                        <h5>EMS Support Center</h5>
                                    </a>
                                </div>
                            @endforeach
                        
                            <!-- help request comment notifications -->
                        
                            @foreach ($help_comment as $comment)
                                <div class="alert alert-info" role="alert"> 
                                <a href="/client/notification/{{$comment->notification_id}}">
                                        <h5>EMS Support Center</h5>
                                    </a>
                                </div>
                            @endforeach
                                           
                        </div>

                <!--end-->

            </div>
            <div class="col-md-2" data-pg-collapsed>
                    <div class="card bg-dark text-white" data-pg-collapsed>
                        <img class="card-img" alt="Card image" src="http://pinegrow.com/placeholders/img11.jpg"/>    
                    </div>             
                    
                    <div class="card bg-dark text-white" data-pg-collapsed>
                            <img class="card-img" alt="Card image" src="http://pinegrow.com/placeholders/img11.jpg"/>    
                    </div>             
                   
                    <div class="card bg-dark text-white" data-pg-collapsed>
                            <img class="card-img" alt="Card image" src="http://pinegrow.com/placeholders/img11.jpg"/>    
                    </div>             
                 
                    <div class="card bg-dark text-white" data-pg-collapsed>
                            <img class="card-img" alt="Card image" src="http://pinegrow.com/placeholders/img11.jpg"/>    
                    </div>             
            </div>
        </div>
    </div>
@endsection 