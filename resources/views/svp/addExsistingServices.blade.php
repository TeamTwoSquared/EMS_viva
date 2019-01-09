@extends('layouts.svp')

@section('content')
<head> 
        <style>
                /* The container */
                .con {
                  display: block;
                  position: relative;
                  padding-left: 0px;
                  margin-bottom: 12px;
                  cursor: pointer;
                  font-size: 22px;
                  -webkit-user-select: none;
                  -moz-user-select: none;
                  -ms-user-select: none;
                  user-select: none;
                }
                
                /* Hide the browser's default checkbox */
                .con input {
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
                .con:hover input ~ .checkmark {
                  background-color: #ccc;
                }
                
                /* When the checkbox is checked, add a blue background */
                .con input:checked ~ .checkmark {
                  background-color: #2196F3;
                }
                
                /* Create the checkmark/indicator (hidden when not checked) */
                .checkmark:after {
                  content: "";
                  position: absolute;
                  display: none;
                }
                
                /* Show the checkmark when checked */
                .con input:checked ~ .checkmark:after {
                  display: block;
                }
                
                /* Style the checkmark/indicator */
                .con .checkmark:after {
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
        </style>
</head>



<div class="album py-5 bg-light">

        <div class="container">
            @if($service_info->count() == 0)
                <center><h3>No Single Services !</h3></center>
            @else
            <form action='/svp/package/addToPackage/{{$package_id}}' method="post"  data-pg-collapsed enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">

                        @foreach($service_info as $service)

                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">

                                        @php
                                        //   $packageImg=servicePackage::where('package_id',$package_info->package_id)->get();
                                            $serviceImg= DB::table('service_images')->where('service_id',$service->service_id)->value("imgurl");
                                        
                                        @endphp

                                        @if(($serviceImg)==null)
                                            <label class="con">
                                                    <input type="checkbox" value="{{$service->service_id}}" name="service[]">
                                                        <img class="card-img-top" src="\storage\images\services\noImage.jpg"/>
                                                    <span class="checkmark"></span>
                                            </label>
                                        @else
                                            <label class="con">
                                                    <input type="checkbox" value="{{$service->service_id}}" name="service[]">
                                                        <img class="card-img-top" src="\storage\images\services\{{$serviceImg}}"/>
                                                    <span class="checkmark"></span>
                                            </label>
                                                
                                        @endif
                                            <div class="card-body">
                                                
                                                    <h3>{{$service->name}}</h3>
                                            </div>
                                    </div>
                                </div>
                        @endforeach

                    </div>
                    <div class="row" data-pg-collapsed>
                            <div class="col-lg-9">
                                <center>
                                    <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-success btn-sm" style="margin:auto;display:block">Add To Package</button>
                                </center>
                                </div>
                            </div>
                    </div>
                @endif
                    
            </form>

        </div>
</div>
      
@endsection