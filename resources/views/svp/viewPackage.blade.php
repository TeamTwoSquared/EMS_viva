@extends('layouts.svp')
@section('content')

<?php
   // dd($package_info);
?>

<div class="row" data-pg-collapsed>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header"><center><h3>Package informations</h3></center></div>
            <div class="card-body card-block">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i >Package ID</i>
                            </div>
                            <label class="form-control">{{$package_info[0]->package_id}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i >Package name</i>
                            </div>
                            <label class="form-control">{{$package_info[0]->name}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i >Package prices(Rs)</i>
                            </div>
                            <label class="form-control">{{$package_info[0]->price}}</label>
                        </div>
                    </div>
            </div>
        </div>
        
    </div>
</div>
<div class="row" data-pg-collapsed>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">Service package image</div>
            <div class="card-body card-block">
                    <div class="form-actions form-group">
                             <div class="col-md-4">
                                    <img src='\storage\images\services\{{$package_info[0]->imgurl}}'>  
                              </div> 
                    </div>
            </div>
        </div>
    </div>
</div>


<div class="row" data-pg-collapsed>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i >Package description</i>
                                    </div>
                                    <label class="form-control">{{$package_info[0]->description}}</label>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i >Package video URL</i>
                                    </div>
                                        <label class="form-control">{{$package_info[0]->videourl}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i >Service provider ID</i>
                                    </div>
                                    <label class="form-control">{{$package_info[0]->service_provider_id}}</label>
                                </div>
                            </div>
                </div>
            </div>
            
        </div>
</div>

<div class="row" data-pg-collapsed>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i >Package Keywords</i>
                                    </div>
                                    <label class="form-control">
                                            @foreach($package_keywords as $package_keyword)
                                                <span class="badge badge-pill badge-light">{{$package_keyword->keyword}}</span>
                                            @endforeach
                                    </label>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i >Branches</i>
                                    </div>
                                        <label class="form-control">
                                            @foreach($package_locations as $package_location)
                                                <span class="badge badge-pill badge-light">{{$package_location->location}}</span>
                                            @endforeach
                                        </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i >Package types</i>
                                    </div>
                                    <label class="form-control">
                                            @foreach($package_types as $package_type)
                                                <span class="badge badge-pill badge-light">{{$package_type->type}}</span>
                                            @endforeach
                                    </label>
                                </div>
                            </div>

                            <div class="form-actions form-group">
                                <a href="/svp/packageService">
                                    <button class="btn btn-success btn-sm" >< Back</button>
                                </a>
                            </div>
                </div>
            </div>
            
        </div>

</div>


@endsection