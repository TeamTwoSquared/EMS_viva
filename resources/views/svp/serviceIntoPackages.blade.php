@extends('layouts.svp')

@php
use App\Service;
use App\Http\Controllers\service\ServicesController;
use App\ServiceImage;
@endphp

@section('content')
            <head>
                <style>
                    .buttn{
                        padding: 20px;
                    }
                </style>
            </head>
            <body>

            <main role="main">
                <div class="buttn" align="right">
                <a href="/svp/package/addServices/{{$package_id}}">
                        <button type="button" class="btn btn-success">+ Add new service</button>
                    </a>
                    <a href="/svp/package/addExsistingServices/{{$package_id}}">
                        <button type="button" class="btn btn-success">+ Add exsisting service</button>
                    </a>
                </div>
               
                <div class="album py-5 bg-light">
                    <div class="container">
                        @if($package_service_info->count() == 0)
                            <center><h2>No Services added yet !</h2></center>
                        @else
                         <div class="row">

                            @foreach($package_service_info as $svpService)

                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">

                                        @php
                                            $serviceImg=ServiceImage::where('service_id',$svpService->service_id)->get();
                                            $serviceInfo=Service::where('service_id',$svpService->service_id)->get();
                                           //dd($svpService);
                                        @endphp

                                        @if($serviceImg->count()==0)
                                            <img class="card-img-top" src="\storage\images\services\noImage.jpg"/>
                                        @else
                                            <img class="card-img-top" src="\storage\images\services\{{$serviceImg[0]->imgurl}}"/>
                                        @endif
                                            <div class="card-body">
                                                <center>
                                                    <h4>{{$serviceInfo[0]->name}}</h4>
                                                    <div class="d-flex justify-content-between align-items-center">

                                                         <div class="btn-group">
                                                             <a href="/svp/package/ViewService/{{$package_id}}/{{$serviceInfo[0]->service_id}}">
                                                                 <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                             </a>
                                                             <a href="/svp/package/EditService/{{$package_id}}/{{$serviceInfo[0]->service_id}}">
                                                                 <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                                             </a>
                                                             <a href="/svp/package/DeleteService/{{$package_id}}/{{$serviceInfo[0]->service_id}}">
                                                                 <button type="button" class="btn btn-sm btn-outline-secondary">Delete</button>
                                                             </a>
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

