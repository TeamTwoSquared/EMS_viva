@extends('layouts.client')
@section('content')

<head>
    
</head>


<!--start content-->


<div style="border-left:solid 20px white ; border-left:solid 20px white">
    <hr>
        <div class="row" data-pg-collapsed>
            <div class="col-md-1" data-pg-collapsed>
                <img  140x140 class="img-circle img-responsive" src="\storage\images\profile\{{$customer_info[0]->profilepic}}">
            </div>
            <div class="col-md-11" data-pg-collapsed>
                <h4>{{$customer_info[0]->name}}</h4>              
            </div>
        </div>

        <div class="row" data-pg-collapsed>
            <div class="col-md-1">
            </div>
            
            <div class="col-md-10" data-pg-collapsed> 
                    <div class="container">
                            <ul class="list-group">
                                <li class="list-group-item">Support Type -  {{$issue_type[0]->type}} </li>
                                <li class="list-group-item">Support Request  - {{$help_info[0]->request}}</li>
                                <li class="list-group-item">Customer ID - {{$help_info[0]->customer_id}} </li>
                                <li class="list-group-item">Service Provider ID - {{$help_info[0]->service_provider_id}} </li>
                            </ul>
                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                
                            </nav>

                                    <!-- Button trigger modal -->

                            <div class="row">
                                @if(count($issue_image) != 0)
                                    @foreach($issue_image as $image)
                                        <div class="col-md-4">
                                        <div class="card mb-4 box-shadow">
                                            <a data-toggle="modal" data-target=".bd-example-modal-lg">
                                                <img   src="\storage\images\services\{{$image->attachement_url}}" />
                                            </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                    </div>
            </div>
        </div>
    </div>

    @if((count($_comment) !=0))
            @foreach($_comment as $cmt)
                <!-- starting comment -->
                <div style="border-left:solid 20px white">
                        <div class="row" data-pg-collapsed>
                            <div class="col-md-3"> 
                            </div>

                            @if(($cmt->from_whome)==1)
                                <div class="col-md-1" data-pg-collapsed>
                                    <img  140x140 class="img-circle img-responsive" src="\storage\images\profile\admin.jpg">
                                </div>
                            @else
                                <div class="col-md-1" data-pg-collapsed>
                                    <img  140x140 class="img-circle img-responsive" src="\storage\images\profile\{{$customer_info[0]->profilepic}}">
                                </div>
                            @endif

                            
                            @if(($cmt->from_whome)==1)
                                <div class="col-md-7" data-pg-collapsed>
                                    <h4>EMS Admin</h4> 
                                </div>
                            @else
                                <div class="col-md-7" data-pg-collapsed>
                                    <h4>{{$customer_info[0]->name}}</h4> 
                                </div>
                            @endif


                        </div>

                        <div class="row" data-pg-collapsed>
                            <div class="col-md-3"> 
                            </div>
                            <div class="col-md-1"> 
                            </div>

                            <div class="col-md-7">
                                <dl data-pg-collapsed id="x"> 
                                <p>{{$cmt->comment}}</p>                                  
                                </dl>             
                            </div>
                        </div>
                </div>
                <!-- ending comment -->

            @endforeach
        @endif    
    </div>

    <div class="row" data-pg-collapsed style="border-left:solid 20px white">
                    <div class="col-md-1" data-pg-collapsed>
                        <img  140x140 class="img-circle img-responsive" src="\storage\images\profile\{{$customer_info[0]->profilepic}}">
                    </div>
                    <div class="col-md-11" data-pg-collapsed>
                        <h4>{{$customer_info[0]->name}}</h4>              
                    </div>
    </div>

    <div>
        <form action="/client/notification/sendReply/{{$help_info[0]->support_request_id}}" method="POST" data-pg-collapsed enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row" data-pg-collapsed>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10" data-pg-collapsed> 
                            <div class="container">
                                    <!--Textarea with icon prefix-->
                                    <div class="md-form">
                                        <i class="fas fa-pencil-alt prefix"></i><label for="form10"><h5><b><i>Reply here</i></b></h5></label>
                                        <textarea  name="comment" class="md-textarea form-control" rows="10" cols="10"></textarea>
                                    </div>
                                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                    </nav>                      
                            </div>
                            <button type="submit" class="btn btn-success btn-sm" style="float: right;">Send</button>
                        </div>
                </div>
        </form>
    </div>
</div>

<!--- end content-->
    
@endsection