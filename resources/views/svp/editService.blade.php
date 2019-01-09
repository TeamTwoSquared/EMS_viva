@extends('layouts.svp')
@section('content')

<!DOCTYPE html>
<div lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Album example for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">

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

<div role="main">
    <form class="album py-5 bg-light" method="POST" action="/svp/updateService" data-pg-collapsed enctype="multipart/form-data">
        <div class="container">
                <center><h3><i>Change the service details</i></h3></center>
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="number" class="form-control" name='serviceID' id="formGroupExampleInput"  value="{{$serviceID}}" style="display: none;" />
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput">Service name </label>
                    <input type="text" class="form-control" name='sName' id="formGroupExampleInput"  value="{{$service_info->name}}"/>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Service price(Rs)-Optional</label>
                    <input type="number" class="form-control" id="formGroupExampleInput2" name='price'  min=0 placeholder="" value="{{$service_info->price}}"/>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">About the service</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" name='description' placeholder="" value="{{$service_info->description}}"/>
                </div>
<!-- Locations   -->

                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Branches</label><br>

                    @if(count($service_locations)!=null)
                        <div style="display:none" > {{$locationId= 1}}</div>
                        @foreach($service_locations as $service_location)
                            <input type="text" name="location{{$locationId }}" class="smallBox"  value="{{$service_location->location}}">
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

<!-- Keywords -->

                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Service keywords</label><br>

                    @if(count($service_keywords)!=null)
                        <div style="display:none" > {{$serviceKeywordId= 7}}</div>
                        @foreach($service_keywords as $service_keyword)
                            <input type="text" name="keyword{{$serviceKeywordId }}" class="smallBox"  value="{{$service_keyword->keyword}}">
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

<!-- types -->
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Service types</label><br>
                    @if(count($service_types)!=null)
                        <div style="display:none" > {{$serviceTypeId= 13}}</div>
                        @foreach($service_types as $service_type)
                            <input type="text" name="type{{$serviceTypeId }}" class="smallBox"  value="{{$service_type->type}}">
                            <div style="display:none" > {{$serviceTypeId += 1}}</div>    
                        @endforeach
                        @if($serviceTypeId != 18)
                            @for($serviceTypeId;$serviceTypeId<19;$serviceTypeId++)
                                <input type="text" name="type{{$serviceTypeId }}" class="smallBox"  placeholder="service type {{$serviceTypeId-12}}">
                            @endfor
                        @endif
                    @else
                        @for($i=13;$i<19;$i++)
                            <input type="text" name="type{{$i}}" class="smallBox"  placeholder="service type {{$i-12}}">
                        @endfor
                    @endif
                </div>
<!-- service url-->
               
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Service video URL</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" name='url' placeholder="Video URL" value="{{$service_videos}}"/>
                </div>

<!-- service images -->

                <div class="row">
                    @if(count($service_images)!=null)
                            <div style="display:none" > {{$imageId= 0}}</div>
                                @foreach($service_images as $serviceImage)
                                    <div class="col-md-4" id="{{$imageId+=1}}"  onclick="hideme({{$imageId}})">
                                        <div class="card mb-4 box-shadow" >
                                            <label class="contain">
                                                <div class="con">
                                                    <input type="checkbox" id=" selected_images" name="picture[]" value="{{$serviceImage->imgurl}}"><img src="\storage\images\services\{{$serviceImage->imgurl}}" class="image" onmouseover= "deleteMe({{$imageId}})"/>
                                                    <div class="middle">
                                                            <div class="text">Delete</div>
                                                    </div>
                                                   <span class="checkmark" style="display: none;"></span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    @endif
                </div>

                <div class="form-group">
                    <div class="row" >
                        <div class="col-lg-9">
                            <div class="card">
                            <div class="card-header">Choose your new images -<small><?php 
                                                                                if($service_img==0){
                                                                                    echo("(Maximumm 6 Photos Can Upload)");
                                                                                } 
                                                                                else if($service_img==6){
                                                                                    echo("(Alrady Uploaded 6 Photos ! )");
                                                                                }
                                                                                else { 
                                                                                    echo ("(Maximumm ".(6-$service_img)." Photos Can Update)");
                                                                                } 
                                                                            ?> </small> </div>
                                <div class="card-body card-block">
        
                                        <div class="form-actions form-group">
                                            <input type="file"  name="newImage[]" class="form-control-file" multiple>
                                        </div>
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                        <button type="submit" class="btn btn-success" style="margin:auto;display:block">Update your service</button>
                </div>

        </div>
    </form>
</div>

</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- delete selected items -->
<script>
    function hideme(id) {

        var i=0;
        i++;
        if(i)
        var element = document.getElementById(id);
        console.log(element);
        element.style.display="none";
    }

    function deleteMe(id){
       
    }

</script>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

@endsection