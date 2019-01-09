@extends('layouts.svp')
@section('content')

<head>
        <style>
                .contain {
                    display: block;
                    position: relative;
                    cursor: pointer;
                    font-size: 22px;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                }
        
                /* Hide the browser's default checkbox */
                .contain input {
                    position: absolute;
                    opacity: 0;
                    cursor: pointer;
                    height: 0;
                    width: 0;
                }
        
                /* Create a custom checkbox */
                .checkmark {
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 25px;
                    width: 25px;
                    background-color: #eee;
                }
        
                /* On mouse-over, add a grey background color */
                .contain:hover input ~ .checkmark {
                    background-color: #ccc;
                }
        
                /* When the checkbox is checked, add a blue background */
                .contain input:checked ~ .checkmark {
                    background-color: #2196F3;
                }
        
                /* Create the checkmark/indicator (hidden when not checked) */
                .checkmark:after {
                    content: "";
                    position: absolute;
                    display: none;
                }
        
                /* Show the checkmark when checked */
                .contain input:checked ~ .checkmark:after {
                    display: block;
                }
        
                /* Style the checkmark/indicator */
                .contain .checkmark:after {
                    left: 9px;
                    top: 5px;
                    width: 5px;
                    height: 10px;
                    border: solid white;
                    border-width: 0 3px 3px 0;
                    -webkit-transform: rotate(45deg);
                    -ms-transform: rotate(45deg);
                    transform: rotate(45deg);
                }
        
                .smallBox{
                    width: 25%;
                    padding: 10px 10px;
                    margin: 8px 0;
                    display: inline-block;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                }

                /*style sheet for image delete*/


                .con {
                    position: relative;
                    width: 100%;
                    }

                    .image {
                    opacity: 1;
                    display: block;
                    width: 100%;
                    height: auto;
                    transition: .5s ease;
                    backface-visibility: hidden;
                    }

                    .middle {
                    transition: .5s ease;
                    opacity: 0;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    -ms-transform: translate(-50%, -50%);
                    text-align: center;
                    }

                    .con:hover .image {
                    opacity: 0.3;
                    }

                    .con:hover .middle {
                    opacity: 1;
                    }

                    .text {
                    background-color: #4CAF50;
                    color: white;
                    font-size: 16px;
                    padding: 16px 32px;
                    }

        
            </style>
</head>
<div>
    <form action="/svp/updatePackage/{{$package_info[0]->package_id}}" method="post" data-pg-collapsed enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row" data-pg-collapsed>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header"><center><h3>Change the package details</h3></center></div>
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
                                        <i class="glyphicon glyphicon-folder-open">Package name</i>
                                    </div>
                                    <input type="text"  name="name" value="{{$package_info[0]->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-folder-open">Package prices(Rs.)-Optional</i>
                                        </div>
                                        <input type="number" name="price" value="{{$package_info[0]->price}}" min=0 class="form-control">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-folder-open">Description</i>
                                        </div>
                                        <input type="text" name="description" value="{{$package_info[0]->description}}" class="form-control">
                                    </div>
                            </div>
                    </div>
                </div>
                
            </div>
        </div>

       

        <div class="row" data-pg-collapsed>
            <div class="col-lg-9">
              <div class="card">
                <div class="card-header">Exsisting package image </small></div>
                @if(($package_info[0]->imgurl)!=null)
                        <div style="display:none" > {{$imageId= 0}}</div>
                                <div class="col-md-4" id="{{$imageId+=1}}" onclick="hideme({{$imageId}}) ">
                                    <div class="card mb-4 box-shadow" onclick="showme({{$imageId}})">
                                        <label class="contain">
                                          <div class="con">
                                            <input type="checkbox" id=" selected_images" name="picture[]" value="{{$package_info[0]->imgurl}}"><img src="\storage\images\services\{{$package_info[0]->imgurl}}" class="image"/>
                                            <div class="middle">
                                                    <div class="text">Delete</div>
                                            </div>
                                            <span class="checkmark" style="display: none;"></span>
                                          </div>
                                        </label>
                                    </div>
                                </div>
                       
                        </div>
                @endif
              </div>
            </div>
        </div>

        <div class="row" data-pg-collapsed>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">Change the package image<small>(Only one image is allowed !)</small></div>
                        <div class="card-body card-block">
                                <div class="form-actions form-group">
            
                                        <input type="file"  name="package_image" class="form-control-file">
                                </div>
                        </div>
                    </div>
                </div>
        </div>


        <!-- Locations   -->

        <div class="row" data-pg-collapsed>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">Branches</div>
                        <div class="card-body card-block">
                                
                                @if(count($package_locations)!=null)
                                    <div style="display:none" > {{$locationId= 1}}</div>
                                    @foreach($package_locations as $package_location)
                                        <input type="text" name="location{{$locationId }}" class="smallBox"  value="{{$package_location->location}}">
                                        <div style="display:none" > {{$locationId += 1}}</div>
                                    @endforeach
                                    @if($locationId != 6)
                                        @for($locationId;$locationId<7;$locationId++)
                                            <input type="text" name="location{{$locationId }}" class="smallBox"  placeholder="location {{$locationId}}">
                                        @endfor
                                    @endif
                                @else
                                    @for($i=1;$i<7;$i++)
                                        <input type="text" name="location{{$i}}" class="smallBox"  placeholder="location {{$i}}">
                                    @endfor
                                @endif
                        </div>
                    </div>
                </div>
        </div>

        <!-- Keywords -->


        <div class="row" data-pg-collapsed>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">Package Keywords</div>
                        <div class="card-body card-block">
                                
                                        @if(count($package_keywords)!=null)
                                            <div style="display:none" > {{$serviceKeywordId= 7}}</div>
                                            @foreach($package_keywords as $package_keyword)
                                                <input type="text" name="keyword{{$serviceKeywordId }}" class="smallBox"  value="{{$package_keyword->keyword}}">
                                                <div style="display:none" > {{$serviceKeywordId += 1}}</div>
                                            @endforeach
                                            @if($serviceKeywordId != 12)
                                                @for($serviceKeywordId;$serviceKeywordId<13;$serviceKeywordId++)
                                                    <input type="text" name="keyword{{$serviceKeywordId }}" class="smallBox"  placeholder="keyword {{($serviceKeywordId)-6}}">
                                                @endfor
                                            @endif
                                        @else
                                            @for($i=7;$i<13;$i++)
                                                <input type="text" name="keyword{{$i}}" class="smallBox"  placeholder="keyword {{$i-6}}">
                                            @endfor
                                        @endif
                        </div>
                    </div>
                </div>
        </div>
            

        <!-- types -->

        <div class="row" data-pg-collapsed>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">Package types</div>
                        <div class="card-body card-block">
                            @if(count($package_types)!=null)
                                <div style="display:none" > {{$serviceTypeId= 13}}</div>
                                @foreach($package_types as $package_type)
                                    <input type="text" name="type{{$serviceTypeId }}" class="smallBox"  value="{{$package_type->type}}">
                                    <div style="display:none" > {{$serviceTypeId += 1}}</div>    
                                @endforeach
                                @if($serviceTypeId != 18)
                                    @for($serviceTypeId;$serviceTypeId<19;$serviceTypeId++)
                                        <input type="text" name="type{{$serviceTypeId }}" class="smallBox"  placeholder="package type {{$serviceTypeId-12}}">
                                    @endfor
                                @endif
                            @else
                                @for($i=13;$i<19;$i++)
                                    <input type="text" name="type{{$i}}" class="smallBox"  placeholder="package type {{$i-12}}">
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
        </div>
        
        <div class="row" data-pg-collapsed>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body card-block">
                                <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-folder-open">Package video URL</i>
                                        </div>
                                        <input type="text" name="videorul" value="{{$package_info[0]->videourl}}" class="form-control">
                                </div>
                        </div>
                        <div class="card-body card-block">
                                <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-folder-open">Service provider ID</i>
                                        </div>
                                        <label class="form-control">{{$package_info[0]->service_provider_id}}</label>
                                </div>
                        </div>
                    </div>
                </div>
        </div>




        <div class="row" data-pg-collapsed>
                <div class="col-lg-9">
                    <center>
                        <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm" style="margin:auto;display:block">Update service package</button>
                    </center>
                    </div>
                </div>
        </div>
        
    </form>
</div>

<script>
        function hideme(id) {
    
            var i=0;
            i++;
            if(i)
            var element = document.getElementById(id);
            console.log(element);
            element.style.display="none";
            
            showme(id);
        }

        function showme(id){
            document.getElementById("id").innerHTML = "Hello World";
        }

</script>
   
            

@endsection



