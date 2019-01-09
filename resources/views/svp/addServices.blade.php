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

    </style>
</head>


<section class="statistic"> 
    <div class="section__content section__content--p30"> 
        <div class="container-fluid">
            <div class="row" data-pg-collapsed> 
                <div class="col-lg-9"> 
                    <div class="card"> 
                        <div class="card-header"><center><h3><i>Add your new service</i></h3></center></div>             
                        <div class="card-body card-block"> 
                            <form action="/svp/submitService" method="post" data-pg-collapsed enctype="multipart/form-data"> 
                            {{ csrf_field() }}
                                <div class="form-group" data-pg-collapsed> 
                                    <label for="inputAddress">Service name</label>                         
                                <input type="text" class="form-control" name="name" placeholder="Name"> 
                                </div>
                                <div class="form-group"> 
                                    <label for="inputAddress">Prices(Rs.)-Optional</label>                         
                                    <input type="number" class="form-control"  name="price" min="0" placeholder="Price Your Service ">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">Description</label>
                                    <input type="text" class="form-control"  name="description" placeholder="Maximum 100 characters ">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput2">Service keywords</label><br>
                                        @for($i=1;$i<7;$i++)
                                            <input type="text" name="keyword{{$i}}" class="smallBox"  placeholder="Keyword {{$i}}">
                                        @endfor
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput2">Branches</label><br>
                                        @for($i=7;$i<13;$i++)
                                            <input type="text" name="location{{$i}}" class="smallBox"  placeholder="location {{$i-6}}">
                                        @endfor
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput2">Service types</label><br>
                                        @for($i=13;$i<19;$i++)
                                            <input type="text" name="type{{$i}}" class="smallBox"  placeholder="Service Type {{$i-12}}">
                                        @endfor
                                </div>
                                
                                                 
                        </div>             
                    </div>         
                </div>     
            </div>



            <div class="row" data-pg-collapsed>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">Images of your service - <small>(Maximmum 6 images are allowed !)</small></div>
                        <div class="card-body card-block">

                                <div class="form-actions form-group">
                                    <input type="file"  name="service_image[]" class="form-control-file" multiple>
                                </div>
        
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" data-pg-collapsed>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">Video clip of your service</div>
                            <div class="card-body card-block">
                                
                                    <div class="form-actions form-group">
                                        <input type="text" class="form-control"  name="service_video_url" placeholder=" URL of your video clip " >
                                    </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
               
            <div class="row" data-pg-collapsed>
                <div class="col-lg-9">
                    <center>
                        <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm" style="margin:auto;display:block">Add your new service</button>
                    </center>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </div>
</section>            
@endsection