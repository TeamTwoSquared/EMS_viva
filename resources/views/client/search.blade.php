@extends('layouts.client')
@section('content')
@php
    use App\Http\Controllers\service\ServicesController;
    use App\Http\Controllers\service\ServiceImagesController;
    use App\Http\Controllers\svp\SVPsController;
    use App\Http\Controllers\review\ReviewsController;
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
                                <li class="list-inline-item">Search Results</li>
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
            <div class="col-md-2 pl-4">
                <div class="row">
                    <h5 class="font-weight-bold">Refine Results</h5>
                </div>
                <div class="row">
                    <h6 class="font-weight-bold">Price Ranges</h6>
                </div>
                <div class="row">
                    <form role="form" class="col-md-12 p-1"> 
                        <div class="form-group"> 
                            <label class="pl-2">Rs.</label>
                            <input id="low" onchange="autoFilterPrice()" type="number" min="0" class="form-control" id="">
                            <label class="pl-2">to</label>
                            <input id="high" onchange="autoFilterPrice()" type="number" min="0" class="form-control" id="">
                            
                            <i id="btnSearch" class="fas fa-search pt-3 pl-3" style="cursor: pointer;"></i>
                        </div>                         
                    </form>
                </div>
                <hr/>
                <div class="row ">
                    <h6 class="font-weight-bold">Seller Level</h6>
                    <div class="form-check col-md-12 form-check-inline pl-2"> 
                        <input class="form-check-input" id="level_new" type="checkbox" onchange="filterByLevel()" id="formInput50" value="option1"> 
                        <label class="form-check-label" for="formInput50">New</label>                         
                    </div>
                    <div class="form-check col-md-12 form-check-inline pl-2"> 
                        <input class="form-check-input" id="level_1" type="checkbox" onchange="filterByLevel()" id="formInput50" value="option1"> 
                        <label class="form-check-label" for="formInput50">Level 1</label>                         
                    </div>
                    <div class="form-check col-md-12 form-check-inline pl-2"> 
                        <input class="form-check-input" id="level_2" type="checkbox" onchange="filterByLevel()" id="formInput50" value="option1"> 
                        <label class="form-check-label" for="formInput50">Level 2</label>                         
                    </div>
                    <div class="form-check col-md-12 form-check-inline pl-2"> 
                        <input class="form-check-input" id="level_top" type="checkbox" onchange="filterByLevel()" id="formInput50" value="option1"> 
                        <label class="form-check-label" for="formInput50">Top Rated</label>                         
                    </div>
                </div>
                <hr/>
                                 
            </div>
            <div class="col-md-10">
                @if(count($service_ids)>0)
                <div class="row">
                    
                    @foreach($service_ids as $service_id)
                    @php
                    $service = ServicesController::getService($service_id);
                    $svp = SVPsController::getSVP2($service->service_provider_id);
                    $randomImage=ServiceImagesController::getRandomImages($service->service_id);
                    $svp_star = ReviewsController::showStar($svp->star);
                    @endphp
                        <div class="card col-md-3 pt-1 mb-4">
                            <a href="/client/view/service/{{$service->service_id}}">
                             @if($randomImage->count()!=0)
                                <img class="card-img-top" alt="{{$service->name}}" src="/storage/images/services/{{$randomImage->imgurl}}"/>
                            @else
                                <img class="card-img-top" alt="{{$service->name}}" src="/storage/images/services/noimage.jpg"/>
                            @endif
                            </a>
                            <div class="card-body pt-2 ">
                                <div class="row">
                                    <div class="image col-md-3 pl-0 pr-0"> 
                                        <a href="/client/view/svp/{{$svp->service_provider_id}}"><img src="/storage/images/profile/{{$svp->profilepic}}" alt="{{$svp->username}}" class="rounded-circle"/></a>
                                    </div>
                                    <div class="image col-md-9 pr-0 pl-1 ">
                                    <p><a href="/client/view/svp/{{$svp->service_provider_id}}"><strong>{{$svp->username}}</strong></a> 
                                        @if($svp->level == 0) (New)
                                        @elseif($svp->level == 3) (Top Rated)
                                        @else 
                                        (Level {{$svp->level}})
                                        @endif
                                    </p> 
                                    </div>
                                </div>
                                <p class="card-text"><a href="/client/view/service/{{$service->service_id}}">{{$service->name}}</a></p>
                                <p class="card-text"><i class="fa fa-star"></i> {{$svp_star}}.0</p>
                                <p class="card-text"><i class="far fa-money-bill-alt"></i> {{$service->price}}</p>
                                
                            </div>
                        </div>
                    @endforeach
                    
                </div>  
                @else
                <div class="col-md-12 mt-5 pt-5"> 
                    <div class="row " data-pg-collapsed>
                        <img src="/images/noresult.png" class="ml-auto mr-auto w-25 h-25"/>
                    </div>
                </div>       
                @endif               
            </div>             
        </div>         
        <hr/> 
        <!-- Bottom-Pane Ads-->
        @include('inc.bottomAds')             
        <!-- End of Ads -->
    </div>     
</section>
<hr/>
<script>
$(document).ready(function(){
    $('#btnSearch').click(function(){
        var low,high,services;
        low = document.getElementById('low').value;
        high = document.getElementById('high').value;
        services = $('.card');
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[3];
            price = p.innerHTML.match(/\d+$/)[0];
            price = Number(price);
            if(low=="" && high==""){
                services[i].style.display = "";
            }
            else if(low=="" && price<=high){
                services[i].style.display = "";
            }
            else if(low=="" && price>high){
                services[i].style.display = "none";
            }
            else if(price>=low && high==""){
                services[i].style.display = "";
            }
            else if(price<low && high==""){
                services[i].style.display = "none";
            }
            else if((price>=low && price<=high))
            {
                services[i].style.display = "";
            }
            else
            {
                services[i].style.display = "none";
            }
        }
    });
});

function autoFilterPrice(){
    var low,high,services;
        low = document.getElementById('low').value;
        high = document.getElementById('high').value;
        services = $('.card');
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[3];
            price = p.innerHTML.match(/\d+$/)[0];
            price = Number(price);
            if(low=="" && high==""){
                services[i].style.display = "";
            }
            else if(low=="" && price<=high){
                services[i].style.display = "";
            }
            else if(low=="" && price>high){
                services[i].style.display = "none";
            }
            else if(price>=low && high==""){
                services[i].style.display = "";
            }
            else if(price<low && high==""){
                services[i].style.display = "none";
            }
            else if((price>=low && price<=high))
            {
                services[i].style.display = "";
            }
            else
            {
                services[i].style.display = "none";
            }
        }  
}

function filterByLevel(){
    var level_new = $('#level_new');
    var level_1 = $('#level_1');
    var level_2 = $('#level_2');
    var level_top = $('#level_top');
    services = $('.card');

    if(level_new.is(":checked") && level_1.is(":checked") && level_2.is(":checked") && level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            services[i].style.display = ""; 
        }
    }
    else if(level_new.is(":checked") && level_1.is(":checked") && level_2.is(":checked") && !level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(Top Rated)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(level_new.is(":checked") && level_1.is(":checked") && !level_2.is(":checked") && level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(Level 2)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(level_new.is(":checked") && level_1.is(":checked") && !level_2.is(":checked") && !level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(Level 2)" || p=="(Top Rated)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(level_new.is(":checked") && !level_1.is(":checked") && level_2.is(":checked") && level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(Level 1)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(level_new.is(":checked") && !level_1.is(":checked") && level_2.is(":checked") && !level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(Level 1)" || p=="(Top Rated)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(level_new.is(":checked") && !level_1.is(":checked") && !level_2.is(":checked") && level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(Level 1)" || p=="(Level 2)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(level_new.is(":checked") && !level_1.is(":checked") && !level_2.is(":checked") && !level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(Level 1)" || p=="(Level 2)" || p=="(Top Rated)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(!level_new.is(":checked") && level_1.is(":checked") && level_2.is(":checked") && level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(New)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(!level_new.is(":checked") && level_1.is(":checked") && level_2.is(":checked") && !level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(New)" || p=="(Top Rated)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(!level_new.is(":checked") && level_1.is(":checked") && !level_2.is(":checked") && level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(New)" || p=="(Level 2)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(!level_new.is(":checked") && level_1.is(":checked") && !level_2.is(":checked") && !level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(New)" || p=="(Level 2)" || p=="(Top Rated)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(!level_new.is(":checked") && !level_1.is(":checked") && level_2.is(":checked") && level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(New)" || p=="(Level 1)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(!level_new.is(":checked") && !level_1.is(":checked") && level_2.is(":checked") && !level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(New)" || p=="(Level 1)" || p=="(Top Rated)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(!level_new.is(":checked") && !level_1.is(":checked") && !level_2.is(":checked") && level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            p = services[i].getElementsByTagName("p")[0];
            p = p.textContent.split("                                         ")[1];
            p = p.trim();
            if(p=="(New)" || p=="(Level 1)" || p=="(Level 2)") services[i].style.display = "none";
            else services[i].style.display = "";
        }
        
    }
    else if(!level_new.is(":checked") && !level_1.is(":checked") && !level_2.is(":checked") && !level_top.is(":checked"))
    {
        for (i = 0; i < services.length; i++){
            services[i].style.display = ""; 
        }
    }
    

}

</script>

@endsection
