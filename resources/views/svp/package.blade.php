@extends('layouts.svp')

@php
use App\services;
use App\Http\Controllers\service\ServicesController;
use App\ServiceImage;
use App\servicePackage;
use App\PackageKeyword;
use App\PackageLocation;
use App\PackageType;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
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
                    <a href="/svp/addpackageService">
                        <button type="button" class="btn btn-success">+ Add new service package</button>
                    </a>
                </div>
                <center><h3><i>Package services</i></h3></center>
                <div class="album py-5 bg-light">
                    <div class="container">
                        @if($packageService->count() == 0)
                            <center><h2>No Service packages added yet !</h2></center>
                        @else
                         <div class="row">

                            @foreach($packageService as $package_info)

                                <a href='/svp/packageService/{{$package_info->package_id}}'>
                                    <div class="col-md-4">
                                        <div class="card mb-4 box-shadow" >

                                            @php
                                            //   $packageImg=servicePackage::where('package_id',$package_info->package_id)->get();
                                                $packageImg= DB::table('package_service')->where('package_id',$package_info->package_id)->value("imgurl");
                                            
                                            @endphp

                                            @if(($packageImg)==null)
                                                <img class="card-img-top" src="\storage\images\services\noImage.jpg"/>
                                            @else
                                                <img class="card-img-top" src="\storage\images\services\{{$packageImg}}"/>
                                            @endif
                                                <div class="card-body">
                                                    
                                                        <h3>{{$package_info->name}}</h3>
                                                        <div class="d-flex justify-content-between align-items-center">

                                                            <div class="btn-group">
                                                                <a href="/svp/ViewPackage/{{$package_info->package_id}}">
                                                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                                </a>
                                                                <a href="/svp/EditPackage/{{$package_info->package_id}}">
                                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                                                </a> 
                                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="deleteMe({{$package_info->package_id}})">Delete</button>
                                                                    <script>
                                                                            function deleteMe(id) {
                                                                                if (confirm("Are you sure you want to delete package!")) {
                                                                                    window.location.replace("/svp/DeletePackage/"+id);
                                                                                } 
                                                                            }
                                                                    </script>
                                                                </div>
                                                        </div>
                                                 
                                                </div>
                                        </div>
                                    </div>
                                </a>
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

