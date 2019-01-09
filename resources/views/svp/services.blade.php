@extends('layouts.svp')

@php
use App\services;
use App\Http\Controllers\service\ServicesController;
use App\ServiceImage;
@endphp

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
                <style>
                    .buttn{
                        padding: 20px;
                    }
                </style>
            </head>
            <body>

            <main role="main">
                <div class="buttn" align="right">
                    <a href="/svp/addServices">
                        <button type="button" class="btn btn-success">+ Add new service</button>
                    </a>
                </div>
                <center><h3><i>Single services</i></h3></center>
                <div class="album py-5 bg-light">
                    <div class="container">
                        @if($svpServices->count() == 0)
                            <center><h2>No Services added yet !</h2></center>
                        @else
                         <div class="row">

                            @foreach($svpServices as $svpService)

                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">

                                        @php
                                            $serviceImg=ServiceImage::where('service_id',$svpService->service_id)->get();

                                        @endphp

                                        @if($serviceImg->count()==0)
                                            <img class="card-img-top" src="\storage\images\services\noImage.jpg"/>
                                        @else
                                            <img class="card-img-top" src="\storage\images\services\{{$serviceImg[0]->imgurl}}"/>
                                        @endif
                                            <div class="card-body">
                                                <center>
                                                    <h3>{{$svpService->name}}</h3>
                                                    <div class="d-flex justify-content-between align-items-center">

                                                         <div class="btn-group">
                                                             <a href="/svp/ViewService/{{$svpService->service_id}}">
                                                                 <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                             </a>
                                                             <a href="/svp/EditService/{{$svpService->service_id}}">
                                                                 <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                                             </a>
                                                             
                                                             <button type="button" class="btn btn-sm btn-outline-secondary" onclick="deleteMe({{$svpService->service_id}})">Delete</button>
                                                                    <script>
                                                                            function deleteMe(id) {
                                                                                if (confirm("Are you sure you want to delete this package !")) {
                                                                                    window.location.replace("/svp/DeleteService/"+id);
                                                                                } 
                                                                            }
                                                                    </script>
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>
                                    </div>
                                </div>

                            @endforeach

                          </div>
                        @endif

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




