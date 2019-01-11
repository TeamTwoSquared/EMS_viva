@extends('layouts.svp')
@section('content')
@php
use App\Http\Controllers\service\ServicesController;
use App\Http\Controllers\svp\SVPsController;
$svp=SVPsController::getSVP();
$services = ServicesController::getServices($svp->service_provider_id);
$i=1; //use to have checkbox number   
@endphp
<div class="row" data-pg-collapsed> 
    <div class="col-xl-12"> 
        <div class="card">              
            <div class="card-header">
                <strong>Create</strong> Booking
            </div>
            <div class="card-body card-block"> 
                <form action="store" method="post" enctype="multipart/form-data" class="form-horizontal"> 
                    {{ csrf_field() }}
                    <div class="row form-group"> 
                        <div class="col col-md-3 col-xl-3"> 
                            <label for="text-input" class="form-control-label">Event Date</label>                             
                        </div>                         
                        <div class="col-12 col-md-4"> 
                                <input id="datepicker" name="date" readonly/>
                                <script>
                                    $('#datepicker').datepicker({
                                        format: 'yyyy-mm-dd',
                                        minDate: function() {
                                        var date = new Date();
                                        date.setDate(date.getDate()+1);
                                        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
                                    },
                                        maxDate: function() {
                                            var date = new Date();
                                            date.setFullYear(date.getFullYear()+4);
                                            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
                                            },
                                        uiLibrary: 'bootstrap4'
                                    });
                                </script>
                        </div>
                    </div>
                    <div class="row form-group"> 
                        <div class="col col-md-3 col-xl-3"> 
                            <label for="text-input" class="form-control-label">Start Time</label>                             
                        </div>                         
                        <div class="col-12 col-md-4">
                                <input id="s_time" name="start_time"readonly/>
                                <script>
                                    $('#s_time').timepicker({
                                        uiLibrary: 'bootstrap4'
                                    });
                                </script> 
                        </div>                           
                    </div>
                    <div class="row form-group"> 
                        <div class="col col-md-3 col-xl-3"> 
                            <label for="text-input" class="form-control-label">End Time</label>                             
                        </div>                         
                        <div class="col-12 col-md-4">
                                <input id="e_time" name="end_time" readonly/>
                                <script>
                                    $('#e_time').timepicker({
                                        close: function (e) {
                                            var startTime = $('#s_time').val();   
                                            var endTime   = $('#e_time').val();    
                                            if (startTime > endTime) 
                                            {
                                                alert('End time always greater then start time.');
                                                $('#e_time').val('');
                                            }
                                        },
                                        uiLibrary: 'bootstrap4'
                                    });
                                </script> 
                        </div>                           
                    </div>                    
                    <div class="row form-group"> 
                        <div class="col col-md-3">Services</div>                         
                        <div class="col-12 col-md-9">
                            <div class="form-check">
                                @foreach($services as $service)
                                    <div class="checkbox">
                                    <label for="checkbox_{{$i}}" class="form-check-label">
                                            <input type="checkbox" id="services" name="services[]" value="{{$service->service_id}}" class="form-check-input">{{$service->name}}
                                        </label>
                                    </div>
                                    @php
                                        $i++;  
                                    @endphp
                                @endforeach
                            </div>
                        </div>                        
                    </div>
                    <div class="row form-group"> 
                        <div class="col col-md-3 col-xl-3"> 
                            <label for="text-input" class="form-control-label">Client's Email</label>                             
                        </div>                         
                        <div class="col-12 col-md-9"> 
                            <input type="email" id="client" name="client" placeholder="" class="form-control"> 
                        </div> 
                    </div>                                
                    <div class="card-footer"> 
                        <button type="submit" class="btn btn-primary btn-sm"> 
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>                 
                        <button type="reset" class="btn btn-danger btn-sm"> 
                            <i class="fa fa-ban"></i> Reset
                        </button>                 
                    </div>
                </form>             
            </div>         
        </div>     
    </div>
</div>

@endsection