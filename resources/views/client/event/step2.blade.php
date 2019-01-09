@extends('layouts.client')
@section('content')
@php
    use App\Http\Controllers\event\TemplateTasksController;
@endphp
<section class="au-breadcrumb2 pad-bottom5 pad15" data-pg-collapsed> 
        <div class="container"> 
            <div class="row"> 
                <div class="col-md-12"> 
                    <div class="au-breadcrumb-content"> 
                        <div class="au-breadcrumb-left" data-pg-collapsed> 
                            <span class="au-breadcrumb-span">You are here:</span> 
                            <ul class="list-unstyled list-inline au-breadcrumb__list"> 
                                <li class="list-inline-item"> 
                                    <a href="dash">Home</a> 
                                </li>         
                                <li class="list-inline-item seprate"> 
                                    <span>/</span> 
                                </li>         
                                <li class="list-inline-item">Template Selection</li>
                                <li class="list-inline-item seprate"> 
                                    <span>/</span> 
                                </li>         
                                <li class="list-inline-item">Step 2</li>
                            </ul>     
                        </div>                     
                        <form class="au-form-icon--sm" action="/client/search" method="post">
                            {{ csrf_field() }} 
                            <input class="au-input--w300 au-input--style2" name = "data" type="text" placeholder="Find Services...."> 
                            <button class="au-btn--submit2" type="submit"> 
                                <i class="zmdi zmdi-search"></i> 
                            </button>                         
                        </form>                     
                    </div>                 
                </div>             
            </div>         
        </div>     
</section>
<hr/>
<section class="statistic statistic2 pad5" data-pg-collapsed>
    <div class="container"> 
        <div class="row">
            <div class="col-md-9 " data-pg-collapsed>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        <strong>Your Event is created successfully</strong> with the selected template. Now its' time to find service providers for your Event.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-center" data-pg-collapsed="">
                            <div class="card-header">Next Step&nbsp;
                                <i class="fa fa-hand-peace-o"></i>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Visit My Events</h4>
                                <p class="card-text">See your newly created event in my event listing</p>
                                <a href="/client/myevents" class="btn btn-primary">Visit</a>
                            </div>
                            <div class="card-footer text-muted">
                                <br>
                            </div>
                        </div>             
                    </div>
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">Next Step&nbsp;
                                <i class="fa fa-hand-peace-o"></i>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Find Service Providers</h4>
                                <p class="card-text">You can find service providers for the tasks in your event</p>
                            <a href="/client/myevents/{{$event_id}}" class="btn btn-primary">Find</a>
                            </div>
                            <div class="card-footer text-muted">
                                <br>
                            </div>
                        </div>             
                    </div>
                </div>
            </div>
            <!-- Right-Pane Ads with col-md-3-->
            @include('inc.rightAds')               
            <!-- End of Ads -->            
        </div>         
        <hr/> 
        <!-- Bottom-Pane Ads-->
            @include('inc.bottomAds')             
        <!-- End of Ads -->     
    </div>
</section>
<hr/>
@endsection