@extends('layouts.svp')
@section('content')
        <!DOCTYPE html>
<html lang="en">
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
</head>
<body>
<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <ul class="list-group">
                <li class="list-group-item">Service ID           :<b>{{$service_info[0]->service_id}}</b></li>
                <li class="list-group-item">Service name         :{{$service_info[0]->name}}</li>
                <li class="list-group-item">About the service    :{{$service_info[0]->description}}</li>
                <li class="list-group-item">Price of the service :{{$service_info[0]->price}}</li>
                <li class="list-group-item">Service provider ID  :{{$service_info[0]->service_provider_id}}</li>
                @if(count($service_videos)==0)
                    <li class="list-group-item">Service video URL  : No URL </li>
                @else
                    <li class="list-group-item">Service video URL  :{{$service_videos[0]->videourl}}</li>
                @endif

                <li class="list-group-item">Branches     :
                    @foreach($service_locations as $serviceLocation)
                        <span class="badge badge-pill badge-light">{{$serviceLocation->location}}</span>
                    @endforeach
                </li>
                <li class="list-group-item">Service types    :
                    @foreach($service_types as $serviceType)
                        <span class="badge badge-pill badge-light">{{$serviceType->type}}</span>
                    @endforeach
                </li>
                <li class="list-group-item">Service Keywords    :
                    @foreach($service_keywords as $serviceKeyword)
                        <span class="badge badge-pill badge-light">{{$serviceKeyword->keyword}}</span>
                    @endforeach
                </li>

            </ul>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">

            </nav>
            <div class="row">
                @foreach($service_Images as $serviceImage)
                 <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="\storage\images\services\{{$serviceImage->imgurl}}"/>
                    </div>
                 </div>
                @endforeach
            </div>
            <a href="/svp/service" >
                <button type="button" class="btn btn-success" >OK</button>
            </a>
        </div>
    </div>
</main>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
@endsection