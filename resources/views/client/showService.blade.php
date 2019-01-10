@extends('layouts.client')
@section('content')
@php
    use App\Http\Controllers\service\ServicesController;
    use App\Http\Controllers\service\ServiceImagesController;
    use App\Http\Controllers\svp\SVPsController;
    use App\Http\Controllers\service\ServiceVideosController;
    use App\Http\Controllers\service\ServiceTypesController;
    use App\Http\Controllers\service\ServiceLocationsController;
    use App\Http\Controllers\review\ReviewsController;

    $service = ServicesController::getService($service_id);
    $svp = SVPsController::getSVP2($service->service_provider_id);
    $AllImages=ServiceImagesController::getAllImages($service->service_id);
    $service_types = ServiceTypesController::getTypes($service->service_id);
    $service_locations = ServiceLocationsController::getLocations($service->service_id);
    $Videos = ServiceVideosController::getVideos($service->service_id);
    $other_services = ServicesController::getServicesExceptOne($service->service_provider_id,$service->service_id);//Getting 4 services
    $svp_star = ReviewsController::showStar($svp->star);
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
                                <li class="list-inline-item">View Service : {{$service->name}} of {{$svp->username}}</li>
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
            <div class="col-md-9 pl-4">
                <div class="row">
                    <div class="col-md-12 pl-5"> 
                        <div class="row pl-3">
                            <h3 class="font-weight-bold">{{$service->name}}</h3>
                        </div>
                        <div class="row justify-content-center">
                            <div id="carousel1" class="carousel slide col-md-8" data-ride="carousel"> 
                                @php
                                   $count=0; 
                                @endphp
                                <ol class="carousel-indicators"> 
                                    @foreach($AllImages as $img)
                                        <li data-target="#carousel1" data-slide-to="{{$count++}}" class="active"></li> 
                                    @endforeach                                                                       
                                </ol>   
                                @php
                                   $count=1; 
                                @endphp
                                <div class="carousel-inner"> 
                                    @if($AllImages->count() == 0)
                                        <div class="carousel-item active"> 
                                            <img class="d-block w-100" src="/storage/images/services/noimage.jpg" alt="{{$count}} slide"> 
                                        </div> 
                                    @else
                                        @foreach($AllImages as $img)
                                        @if($count == 1)
                                            <div class="carousel-item active"> 
                                                <img class="d-block w-100" src="/storage/images/services/{{$img->imgurl}}" alt="{{$count++}} slide"> 
                                            </div> 
                                        @else
                                            <div class="carousel-item"> 
                                                <img class="d-block w-100" src="/storage/images/services/{{$img->imgurl}}" alt="{{$count++}} slide"> 
                                            </div>
                                        @endif
                                        @endforeach 
                                    @endif                                                                      
                                </div>                                 
                                <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> 
                                <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> 
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="card col-md-12">
                                <div class="card-header">
                                    About this Service
                                </div>
                                <div class="card-body pt-1 pb-1">
                                    <blockquote class="blockquote mb-0">
                                        <p class="mb-2">{{$service->description}}</p>
                                        @if($service_locations->count()!=0)
                                        <p class="mb-1 mt-0 font-weight-bold">Available at :</p>
                                            <ul style="list-style-type: circle;" class="ml-3"> 
                                                @foreach($service_locations as $service_location)
                                                    <li>{{$service_location->location}}</li> 
                                                @endforeach    
                                            </ul>
                                        @endif
                                        @if($service_types->count()!=0)
                                        <p class="mb-1 mt-0 font-weight-bold">Related to :</p>
                                        <ul style="list-style-type: circle;" class="ml-3" data-pg-collapsed> 
                                            @foreach($service_types as $service_type)
                                                <li>{{$service_type->type}}</li>   
                                            @endforeach
                                        </ul>
                                        @endif
                                        @foreach($Videos as $video)
                                            <p class="card-text">Video URL: <a href="#" data-toggle="modal" data-target="#videoModal" data-theVideo="{{$video->videourl}}">{{$video->videourl}}</a></p>
                                        @endforeach
                                        <footer class="blockquote-footer">Price : 
                                            <cite title="Source Title">Rs. {{$service->price}} /=</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                                <div class="row">
                                @if(isset($task_id))
                                <button type="button" id="reserve" class="btn btn-light bg-secondary col-md-3 ml-3" data-url="/client/reserve/{{$service->service_id}}/{{$svp->service_provider_id}}/{{$task_id}}" data-toggle="modal" data-target=".bd-reservation-modal-lg">Reserve</button>
                                @else
                                    <button type="button" id="reserve" class="btn btn-light bg-secondary col-md-3 ml-3" data-url="/client/reserve/{{$service->service_id}}/{{$svp->service_provider_id}}" data-toggle="modal" data-target=".bd-reservation-modal-lg">Reserve</button>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($other_services->count()!=0)
                <div class="row">
                    <h4 class="font-weight-bold">Some other services of {{$svp->username}}</h4>
                </div>
                <div class="row">
                    @foreach($other_services as $service)
                    @php
                       $randomImage=ServiceImagesController::getRandomImages($service->service_id); 
                    @endphp
                    <div class="card col-md-3 mb-4 pt-2">
                        <a href="/client/view/service/{{$service->service_id}}">
                            @if($randomImage->count()!=0)
                                <img class="card-img-top" alt="{{$service->name}}" src="/storage/images/services/{{$randomImage->imgurl}}"/>
                            @else
                                <img class="card-img-top" alt="{{$service->name}}" src="/storage/images/services/noimage.jpg"/>
                            @endif
                        </a>
                        <div class="card-body pt-2 ">
                            <p class="card-text"><a href="/client/view/service/{{$service->service_id}}">{{$service->name}}</a></p>
                            <p class="card-text"><i class="far fa-money-bill-alt"></i> {{$service->price}}</p>
                            
                        </div>
                    </div>
                    @endforeach
                </div> 
                @endif                
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block" src="/storage/images/profile/{{$svp->profilepic}}" alt="{{$svp->username}}">
                                    <h5 class="text-sm-center mt-2 mb-1"><a href="/client/view/svp/{{$svp->service_provider_id}}"><strong>{{$svp->username}}</strong></a></h5>
                                    <div class="location text-sm-center">
                                        <i class="fa fa-map-marker"></i> {{$svp->city}}
                                    </div>
                                    <div class="location text-sm-center mt-2">
                                        <i class="fas fa-envelope"></i> {{$svp->email}}
                                    </div>
                                    <p class="card-text text-sm-center">
                                        @for ($i = 0; $i < $svp_star; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        {{$svp_star}}.0
                                    </p>
                                    <p class="card-text text-sm-center">
                                        @if($svp->level == 0) (New)
                                        @elseif($svp->level == 3) (Top Rated)
                                        @else 
                                        (Level {{$svp->level}})
                                        @endif
                                    </p>
                                    
                                    <button type="button" onclick="showtel()" class="btn btn-light float-none text-body btn-block active asbestos-hover">Contact Me</button>
                                    <button id = "telNo" type="button" style="display:none" class="btn float-none btn-block active text-white btn-dark">{{$svp->phone}}</button>
                                </div>
                                <hr>
                                <h6 class="text-sm-center" >Memeber Since :
                                    @php
                                        $datetime = explode(" ",$svp->reg_date);
                                        echo $datetime[0];
                                    @endphp 
                                    </h6>
                            </div>
                        </div>
                    </div>
                </div>
                 

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
        autoPlayYouTubeModal();

        $(document).on('click', '#reserve', function(e){
            e.preventDefault();
            var url = $(this).data('url');

            $('#dynamic-content-reserve').html(''); // leave it blank before ajax call
            $('#modal-loader-reserve').show();      // load ajax loader

            $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
            })
            .done(function(data){
            console.log(data);  
            $('#dynamic-content-reserve').html('');    
            $('#dynamic-content-reserve').html(data); // load response 
            $('#modal-loader-reserve').hide();        // hide ajax loader   
            })
            .fail(function(){
            $('#dynamic-content-reserve').html('&nbsp;&nbsp;&nbsp;<i class="fas fa-info-circle"></i> Something went wrong, Please try again...');
            $('#modal-loader-reserve').hide();
            });
              
        });

    });
    function autoPlayYouTubeModal(){
        var trigger = $("body").find('[data-toggle="modal"]');
        trigger.click(function() {
            var theModal = $(this).data( "target" ),
            videoSRC = $(this).attr( "data-theVideo" ),
            videoSRCauto = videoSRC+"?autoplay=1" ;
            $(theModal+' iframe').attr('src', videoSRCauto);
            $(theModal+' button.close').click(function () {
                $(theModal+' iframe').attr('src', videoSRC);
            });   
        });
    }

    function showtel(){
        $('#telNo').show();
    }

</script>
@endsection