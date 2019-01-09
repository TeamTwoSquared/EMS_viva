@extends('layouts.svp')

@section('content')
    

    <div class="container-fluid">

            <div class="row" data-pg-collapsed>
                <hr>
            </div>
            <div class="row" data-pg-collapsed> 
                <div class="col-md-9 ml-auto mr-auto"> 
                    <div class="card"> 
                        <div class="card-header">Request A Help</div>             
                        <div class="card-body card-block"> 
                            <form action="/svp/submitHelpRequest" method="post" data-pg-collapsed enctype="multipart/form-data"> 
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
                <div class="col-md-9 ml-auto mr-auto">
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
                <div class="col-md-9 ml-auto mr-auto">
                    <center>
                        <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm" style="margin:auto;display:block">Send support request</button>
                    </center>
                    </div>
                </div>
            </div>
        </form>
        
                     
@endsection