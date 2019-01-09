@extends('layouts.client')
@section('content')
@php
 use App\helpModel;
 use Illuminate\Support\Facades\DB;
@endphp
  
        <div class="container"> 
            <!-- Example row of columns -->             
            <div class="col-sm-offset-1 col-md-12  pl-auto pr-auto pt-5"> 
                <div class="underlined-title"> 
                    <h1>We are happy to answer any questions you have</h1> 
                </div>                         
               
                                <div class="row" data-pg-collapsed>
                                    <div class="col-md-9 mr-auto ml-auto">
                                        <div class="card">
                                            <div class="card-header">We are ready to provide you with more information and answer any question you have.</div>
                                            <div class="card-body card-block">
                                                <span class="fa fa-envelope"></span> 
                                                <a href="mailto:buyme@example.com">emsbyucsc@gmail.com</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                     
        
                            <div class="container-fluid">
                                <div class="row" data-pg-collapsed> 
                                    <div class="col-md-9 mr-auto ml-auto"> 
                                        <div class="card"> 
                                            <div class="card-header">Request A Help</div>             
                                            <div class="card-body card-block"> 
                                                <form action="/client/submitHelpRequest" method="post" data-pg-collapsed enctype="multipart/form-data"> 
                                                {{ csrf_field() }}
                                                    <div class="form-group" data-pg-collapsed> 
                                                        <label for="inputAddress">What Kind Of Issue</label>                         
                                                        <select name='issue_type'>
                                                            <?php
                                                                $Issue = DB::table('support_request_type')->get();
                                                            ?>
                                                                @foreach($Issue as $x)
                                                                    <option >{{$x->type}}</option>
                                                                @endforeach
                                                        </select> 
                                                    </div>
                                                    <div class="form-group"> 
                                                        <label for="inputAddress">Description Of Your Issue</label>                         
                                                        <textarea class="form-control"  name="description" placeholder="Type here.." ></textarea>
                                                    </div>                 
                                            </div>             
                                        </div>         
                                    </div>     
                                </div>
                    
                                 <div class="row" data-pg-collapsed>
                                    <div class="col-md-9 mr-auto ml-auto">
                                        <div class="card">
                                            <div class="card-header">Images Of The Issue - <small>(Maximmum 6 Images Are Allowed !)</small></div>
                                            <div class="card-body card-block">
                    
                                                    <div class="form-actions form-group">
                                                        <input type="file"  name="issue_image[]" class="form-control-file" multiple>
                                                    </div>
                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                               
                                   
                                <div class="row" data-pg-collapsed>
                                    <div class="col-md-9 mr-auto ml-auto">
                                        <center>
                                            <div class="form-actions form-group">
                                            <button type="submit" class="btn btn-success btn-sm active" style="margin:auto;display:block">Send Support Request</button>
                                        </center>
                                        </div>
                                    </div>
                                </div>
                              </form>
                                                                                
                </div>                 
                <!-- /.form-container -->                 
            </div>             
            <hr> 
                     
        </div>         
       
   
@endsection