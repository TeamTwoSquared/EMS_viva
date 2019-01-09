@extends('layouts.admin')
@section('content')
@php
    use App\Http\Controllers\svp\SVPsController;
    use App\Http\Controllers\ad\AdsController;
    use App\Http\Controllers\ad\AdImagesController;
    $bottomAds = AdsController::getBottomAds();

    $rightAds = AdsController::getRightAds();
@endphp

<div class="row" data-pg-collapsed>
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-pg-collapsed>
                        <strong>View</strong> An Advertisement
                    </div>
                    <div class="card-body card-block">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" data-pg-collapsed>
                            {{ csrf_field() }}
                            <div class="row form-group" data-pg-collapsed>
                                <div class="col col-md-3">
                                    <label for="text-input" class="form-control-label">Advertisement Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                <input type="text" readonly id="name" name="name" placeholder="Name your advertisement" class="form-control" value="{{$ad->title}}">
                                </div>
                            </div>
                            
                            
                            <div class="row form-group" data-pg-collapsed>
                                <div class="col col-md-3">
                                    <label for="text-input" class="form-control-label">Placement</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="btn-group" data-toggle="buttons"> 

                                        @if($ad->position == 2)
                                            <label class="btn btn-secondary active"> 
                                                <input type="checkbox" name="position[]" id="position" value="0" checked autocomplete="off" readonly> Bottom Pane             
                                            </label>                                 
                                            <label class="btn btn-secondary"> 
                                                <input type="checkbox" name="position[]" id="position" value="1" checked autocomplete="off" readonly> Right Pane                
                                            </label>
                                        @elseif($ad->position == 0)
                                            <label class="btn btn-secondary active"> 
                                                <input type="checkbox" name="position[]" id="position" value="0" checked autocomplete="off" readonly> Bottom Pane             
                                            </label>                                 
                                            <label class="btn btn-secondary"> 
                                                <input type="checkbox" name="position[]" id="position" value="1" autocomplete="off" readonly> Right Pane                
                                            </label>
                                        @else
                                            <label class="btn btn-secondary active"> 
                                                <input type="checkbox" name="position[]" id="position" value="0" autocomplete="off" readonly> Bottom Pane             
                                            </label>                                 
                                            <label class="btn btn-secondary"> 
                                                <input type="checkbox" name="position[]" id="position" value="1" checked autocomplete="off" readonly> Right Pane                
                                            </label>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row form-group" data-pg-collapsed>
                                <div class="col col-md-3">
                                    <label for="text-input" class="form-control-label">Advertisement URL</label>
                                </div>
                                <div class="col-12 col-md-9">
                                <input type="text" readonly id="ad_url" name="ad_url" placeholder="" class="form-control" value="{{$ad->ad_url}}">
                                </div>
                            </div>
                            <div class="row form-group" data-pg-collapsed>
                                <div class="col col-md-3">
                                    <label for="text-input" class="form-control-label">Impressions</label>
                                </div>
                                <div class="col-12 col-md-9">
                                <input type="text" readonly id="" name="" placeholder="" class="form-control" value="{{$ad->impressions}}">
                                </div>
                            </div>
                            <div class="row form-group" data-pg-collapsed>
                                <div class="col col-md-3">
                                    <label for="text-input" class="form-control-label">Clicks</label>
                                </div>
                                <div class="col-12 col-md-9">
                                <input type="text" readonly id="" name="" placeholder="" class="form-control" value="{{$ad->numberOfclicks}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class="form-control-label">Calculated Price Rs. (Monthly)</label>
                                </div>
                                <div class="col-12 col-md-9">
                                <input type="text" id="price" name="price" placeholder="Price to pay for the advertisement" class="form-control" readonly="readonly" value="{{$ad->price}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                @if($ad->position==0)
                                    <div class="col col-md-3" data-pg-collapsed>
                                        <label class="form-control-label">Bottom Ad Images</label>
                                    </div>
                                    <div class="form-check" data-pg-collapsed>
                                        <section class="content-block gallery-2">
                                            <div class="container">
                                             <div class="row" data-pg-collapsed>
                                                    @php
                                                    $adImages =  AdImagesController::getImages($ad->ad_id)    
                                                    @endphp
                                                    @foreach($adImages as $adImage)
                                                    <div class="col-md-4"> 
                                                        @if($adImage->imgurl=="noimg.jpg")
                                                            <img src="/storage/images/ad/noimage.jpg"/>
                                                        @else
                                                            <img src="/storage/images/ad/{{$adImage->imgurl}}"/>
                                                        @endif
                                                        <hr>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.container -->
                                        </section>
                                    </div>
                                @elseif($ad->position==1)
                                    <div class="col col-md-3" data-pg-collapsed>
                                        <label class="form-control-label">Right Ad Images</label>
                                    </div>
                                    <div class="form-check" data-pg-collapsed>
                                        <section class="content-block gallery-2">
                                            <div class="container">
                                                <div class="row" data-pg-collapsed>
                                                    @php
                                                    $adImages =  AdImagesController::getImages($ad->ad_id)    
                                                    @endphp
                                                    @foreach($adImages as $adImage)
                                                    <div class="col-md-4"> 
                                                        @if($adImage->imgurl=="noimg.jpg")
                                                            <img src="/storage/images/ad/noimage.jpg"/>
                                                        @else
                                                            <img src="/storage/images/ad/{{$adImage->imgurl}}"/>
                                                        @endif
                                                        <hr>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.container -->
                                        </section>
                                    </div>
                                @else
                                    <div class="col col-md-3" data-pg-collapsed>
                                        <label class="form-control-label">Bottom Ad Images</label>
                                    </div>
                                    <div class="form-check" data-pg-collapsed>
                                        <section class="content-block gallery-2">
                                            <div class="container">
                                             <div class="row" data-pg-collapsed>
                                                    @php
                                                    $adImages =  AdImagesController::getBottomImages($ad->ad_id)    
                                                    @endphp
                                                    @foreach($adImages as $adImage)
                                                    <div class="col-md-4"> 
                                                        @if($adImage->imgurl=="noimg.jpg")
                                                            <img src="/storage/images/ad/noimage.jpg"/>
                                                        @else
                                                            <img src="/storage/images/ad/{{$adImage->imgurl}}"/>
                                                        @endif
                                                        <hr>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.container -->
                                        </section>
                                    </div>
                                    <br>
                                        <div class="col col-md-3" data-pg-collapsed>
                                            <label class="form-control-label">Right Ad Images</label>
                                        </div>
                                        <div class="form-check" data-pg-collapsed>
                                            <section class="content-block gallery-2">
                                                <div class="container">
                                                    <div class="row" data-pg-collapsed>
                                                        @php
                                                        $adImages =  AdImagesController::getRightImages($ad->ad_id)    
                                                        @endphp
                                                        @foreach($adImages as $adImage)
                                                        <div class="col-md-4"> 
                                                            @if($adImage->imgurl=="noimg.jpg")
                                                                <img src="/storage/images/ad/noimage.jpg"/>
                                                            @else
                                                                <img src="/storage/images/ad/{{$adImage->imgurl}}"/>
                                                            @endif
                                                            <hr>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.container -->
                                            </section>
                                        </div> 
                                @endif
                                </div><!-- and of row -->
                            <div class="card-footer" data-pg-collapsed>
                                <a href="/admin/ad">
                                <button class="btn btn-primary btn-sm">
                                        <i class="fas fa-chevron-circle-left"></i> Go Back
                                </button>
                                </a>
                                @if($ad->isapprove == 0)
                                    <a href="/admin/ad/approve/{{$ad->ad_id}}">
                                        <button class="btn btn-primary btn-sm">
                                                <i class="fas fa-check"></i> Approve
                                        </button>
                                    </a>
                                @endif
                                @if($ad->isapprove == 2)
                                    <a href="/admin/ad/unblock/{{$ad->ad_id}}">
                                        <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-lock-open"></i> Un-Block
                                        </button>
                                    </a>
                                @else
                                    <a href="/admin/ad/block/{{$ad->ad_id}}">
                                        <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-lock"></i> Block
                                        </button>
                                    </a> 
                                @endif
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>

@endsection