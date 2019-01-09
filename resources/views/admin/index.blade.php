@extends('layouts.admin')
@php
  use App\Http\Controllers\svp\SVPsController;
  use App\Http\Controllers\client\ClientsController;
  use App\Http\Controllers\ad\AdsController;
  use App\Http\Controllers\service\ServicesController;
  $count_svp = SVPsController::getAllSVPCount();
  $count_client = ClientsController::getAllClientCount();
  $count_ad = AdsController::getAllCount();
  $count_service = ServicesController::getAllCount();
@endphp
@section('content')
<div class="row" data-pg-collapsed> 
    <div class="col-md-12"> 
        <div class="overview-wrap"> 
            <h2 class="title-1">overview</h2>             
        </div>         
    </div>     
</div>
<div class="row m-t-25" data-pg-collapsed> 

    <div class="col-sm-6 col-lg-3"> 
        <div class="overview-item overview-item--c1"> 
            <div class="overview__inner"> 
                <div class="overview-box clearfix"> 
                    <div class="icon"> 
                        <i class="zmdi zmdi-account-o"></i> 
                    </div>
                    <a href="/admin/svp">                      
                    <div class="text"> 
                        <h2>{{$count_svp}}</h2> 
                        <span>Service Providers</span> 
                    </div> 
                </a>                    
                </div>                 
                <div class="overview-chart"> 
                                         
                </div>                 
            </div>             
        </div>         
    </div>
    
    <div class="col-sm-6 col-lg-3"> 
        <div class="overview-item overview-item--c2"> 
            <div class="overview__inner"> 
                <div class="overview-box clearfix"> 
                    <div class="icon"> 
                        <i class="zmdi zmdi-account"></i> 
                    </div>  
                    <a href="/admin/client">                   
                    <div class="text"> 
                        <h2>{{$count_client}}</h2> 
                        <span>Customers</span> 
                    </div>
                    </a>                     
                </div>                 
                <div class="overview-chart"> 
                                    
                </div>                 
            </div>             
        </div>         
    </div>

    <div class="col-sm-6 col-lg-3"> 
        <div class="overview-item overview-item--c3"> 
            <div class="overview__inner"> 
                <div class="overview-box clearfix"> 
                    <div class="icon"> 
                        <i class="fab fa-buysellads"></i>
                    </div>   
                    <a href="/admin/ad">                  
                    <div class="text"> 
                        <h2>{{$count_ad}}</h2> 
                        <span>Total Ads</span> 
                    </div>  
                </a>                   
                </div>                 
                <div class="overview-chart"> 
                                    
                </div>                 
            </div>             
        </div>         
    </div>     
    <div class="col-sm-6 col-lg-3"> 
        <div class="overview-item overview-item--c4"> 
            <div class="overview__inner"> 
                <div class="overview-box clearfix"> 
                    <div class="icon"> 
                            <i class="fas fa-cube"></i> 
                    </div>                     
                    <div class="text"> 
                        <h2>{{$count_service}}</h2> 
                        <span>Registered Services</span> 
                    </div>                     
                </div>                 
                <div class="overview-chart"> 
                    <canvas id="widgetChart4"></canvas>                     
                </div>                 
            </div>             
        </div>         
    </div>     
</div>
<div class="row" data-pg-collapsed> 
    
</div>
@endsection