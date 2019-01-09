@php
//Comes service_id, svp_id from controller
use App\Http\Controllers\service\ServicesController;
use App\Http\Controllers\svp\SVPsController;
use App\Event;
use App\EventTemplateTask;
use App\Task;
    $event = session()->get('default_event','NULL');
    if($event!='NULL')
    {
        $currentEvent = Event::find($event);
        if($task_id!=0) 
        {
            $ett = EventTemplateTask::where('event_id',$event)->whereNotIn('task_id',Array($task_id))->get();
        }
        else 
        {
            $ett = EventTemplateTask::where('event_id',$event)->get();
        }
    }
    $service = ServicesController::getService($service_id);
    $service_name = $service->name;
    $svp = SVPsController::getSVP2($service_provider_id);
@endphp
@if($event == "NULL")
<div class="row ml-auto mr-auto">
        <div class="col-md-12 pl-5 pr-5 pt-2">
            <div class="row">
                <div class="alert alert-success col-md-12" data-pg-collapsed> 
                    <strong>As per the policy of EMS!</strong> A reservation could be made with respect to an event. Let's make a simple event to make this reservation.          
                </div>
            </div>
            <!-- Event Form -->
            <form name="step1" id="step1">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">Event Name</label>
                        <input type="text" class="form-control" placeholder="My Temporary Event" name = "event_name" id="event_name" value="{{$service_name}}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">Event Date</label>
                            <input type="date" class="form-control" placeholder="" name = "event_date" id="event_date" value="" required>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="validationDefault01">From</label>
                            <input type="time" class="form-control" placeholder="My First Event" name = "event_stime" id="event_stime" value="" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationDefault02">To</label>
                            <input type="time" class="form-control" placeholder="" name = "event_etime" id="event_etime" value="" required>
                        </div>
                        <input type="hidden" name="event_id" id="event_id" value="0">
                        <input name="task_id" id="task_id" type="radio" class="custom-control-input taskRadio" value="0" checked style="display: none;">
                    </div>
                    <p id="msgsuccess" style="display:none" class="text-success font-weight-bold mt-0 mb-0 ">Event Saved Successfully !</p>
                    <div class="row" data-pg-collapsed>
                        <button type="button" class="btn btn-secondary ml-3" name="save" id="save">Save Event</button>
                    </div>
            </form>
            <!-- Event Form Ends -->
            <div id="bookingSection" class="row" style="display: none;">
                <div class="alert alert-success col-md-12">
                    <div class="row pl-3"> 
                        <strong> Please confirm</strong> &nbsp;the reservation for service "{{$service->name}}" for Rs. {{$service->price}}/= provided by "{{$svp->username}}".            
                    </div>
                    <button id="confirmBooking" class="btn btn-primary btn-sm">
                            <i class="far fa-check-circle"></i> Confirm
                    </button>
                </div>

            </div>
            <div id="bookingAfterSection" class="row" style="display: none;">
                 <div class="alert alert-success col-md-12"> 
                    <strong>Your reservation is placed</strong> and you'll recieve a notification when service provider approves your booking. You can view your booking status by visiting the created event at My Event section.           
                </div>
            </div>
            <div id="bookingAfterSectionError" class="row" style="display: none;">
                 <div class="alert alert-danger col-md-12"> 
                    <strong>An unexpected error has occured</strong> please try again later.           
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>         
        </div>
</div>
@else
    @if($task_id!=0)
    <div class="row ml-auto mr-auto">
            <div class="col-md-12 pl-5 pr-5 pt-2">
                <!-- Event Form -->
                <form name="step1" id="step1">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault01">Event Name</label>
                            <input type="text" class="form-control-plaintext" placeholder="My Temporary Event" name = "event_name" id="event_name" value="{{$currentEvent->name}}" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02">Event Date</label>
                                <input type="date" class="form-control-plaintext" placeholder="" name = "event_date" id="event_date" value="{{$currentEvent->date}}" readonly>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="validationDefault01">From</label>
                                <input type="time" class="form-control-plaintext" placeholder="My First Event" name = "event_stime" id="event_stime" value="{{$currentEvent->stime}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault02">To</label>
                                <input type="time" class="form-control-plaintext" placeholder="" name = "event_etime" id="event_etime" value="{{$currentEvent->etime}}" readonly>
                            </div>
                            <input type="hidden" name="event_id" id="event_id" value="{{$event}}">
                        </div>
                        <div class="row">
                                <!-- Default unchecked -->
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">Please select the relevant task</h6>
                                    @php
                                       $task = Task::find($task_id);
                                    @endphp
                                    <div class="custom-control custom-radio" data-pg-collapsed> 
                                    <input name="task_id" id="{{$task_id}}" type="radio" class="custom-control-input taskRadio" value="{{$task_id}}" checked> 
                                        <label class="custom-control-label" for="{{$task->task_id}}">{{$task->name}}</label>             
                                    </div>
                                    @foreach($ett as $t)
                                    @php
                                        $task = Task::find($t->task_id);
                                    @endphp
                                        <div class="custom-control custom-radio mt-1" data-pg-collapsed> 
                                        <input name="task_id" id="{{$task->task_id}}" type="radio" class="custom-control-input taskRadio" value="{{$task->task_id}}"> 
                                            <label class="custom-control-label" for="{{$task->task_id}}">{{$task->name}}</label>          
                                        </div>   
                                    @endforeach      
                                </div>
                        </div>
                </form>
                <!-- Event Form Ends -->
                <div id="bookingSection" class="row">
                    <div class="alert alert-success col-md-12">
                        <div class="row pl-3"> 
                            <strong> Please confirm</strong> &nbsp;the reservation for service "{{$service->name}}" for Rs. {{$service->price}}/= provided by "{{$svp->username}}".            
                        </div>
                        <button id="confirmBooking" class="btn btn-primary btn-sm">
                                <i class="far fa-check-circle"></i> Confirm
                        </button>
                    </div>
    
                </div>
                <div id="bookingAfterSection" class="row" style="display: none;">
                     <div class="alert alert-success col-md-12"> 
                        <strong>Your reservation is placed</strong> and you'll recieve a notification when service provider approves your booking. You can view your booking status by visiting the created event at My Event section.           
                    </div>
                </div>
                <div id="bookingAfterSectionError" class="row" style="display: none;">
                     <div class="alert alert-danger col-md-12"> 
                        <strong>An unexpected error has occured</strong> please try again later.           
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>         
            </div>
    </div> 
    @else
    <div class="row ml-auto mr-auto">
            <div class="col-md-12 pl-5 pr-5 pt-2">
                <!-- Event Form -->
                <form name="step1" id="step1">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault01">Event Name</label>
                            <input type="text" class="form-control-plaintext" placeholder="My Temporary Event" name = "event_name" id="event_name" value="{{$currentEvent->name}}" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02">Event Date</label>
                                <input type="date" class="form-control-plaintext" placeholder="" name = "event_date" id="event_date" value="{{$currentEvent->date}}" readonly>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="validationDefault01">From</label>
                                <input type="time" class="form-control-plaintext" placeholder="My First Event" name = "event_stime" id="event_stime" value="{{$currentEvent->stime}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault02">To</label>
                                <input type="time" class="form-control-plaintext" placeholder="" name = "event_etime" id="event_etime" value="{{$currentEvent->etime}}" readonly>
                            </div>
                            <input type="hidden" name="event_id" id="event_id" value="{{$event}}">
                        </div>
                        <div class="row">
                                <!-- Default unchecked -->
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">Please select the relevant task</h6>
                                    @foreach($ett as $t)
                                    @php
                                        $task = Task::find($t->task_id);
                                        $i=0;
                                    @endphp
                                    @if($i==0)
                                        <div class="custom-control custom-radio mt-1" data-pg-collapsed> 
                                        <input name="task_id" id="{{$task->task_id}}" type="radio" class="custom-control-input taskRadio" value="{{$task->task_id}}" checked> 
                                            <label class="custom-control-label" for="{{$task->task_id}}">{{$task->name}}</label>          
                                        </div>
                                    @else
                                        <div class="custom-control custom-radio mt-1" data-pg-collapsed> 
                                        <input name="task_id" id="{{$task->task_id}}" type="radio" class="custom-control-input taskRadio" value="{{$task->task_id}}"> 
                                            <label class="custom-control-label" for="{{$task->task_id}}">{{$task->name}}</label>          
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach      
                                </div>
                        </div>
                </form>
                <!-- Event Form Ends -->
                <div id="bookingSection" class="row">
                    <div class="alert alert-success col-md-12">
                        <div class="row pl-3"> 
                            <strong> Please confirm</strong> &nbsp;the reservation for service "{{$service->name}}" for Rs. {{$service->price}}/= provided by "{{$svp->username}}".            
                        </div>
                        <button id="confirmBooking" class="btn btn-primary btn-sm">
                                <i class="far fa-check-circle"></i> Confirm
                        </button>
                    </div>
    
                </div>
                <div id="bookingAfterSection" class="row" style="display: none;">
                     <div class="alert alert-success col-md-12"> 
                        <strong>Your reservation is placed</strong> and you'll recieve a notification when service provider approves your booking. You can view your booking status by visiting the created event at My Event section.           
                    </div>
                </div>
                <div id="bookingAfterSectionError" class="row" style="display: none;">
                     <div class="alert alert-danger col-md-12"> 
                        <strong>An unexpected error has occured</strong> please try again later.           
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>         
            </div>
    </div>
    @endif

@endif
<script>
$(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var event_id = 0;
        var svp_id = {{$service_provider_id}}
        var service_id = {{$service_id}}
        var service_name = $('#event_name').val();
        $('#save').click(function(){
            if(event_id == 0)
            {
            $.ajax({
                    type:'POST',
                    url:'/client/saveevent/'+service_name,
                    data:$('#step1').serialize(),
                    success:function(data){
                        if(data==0)
                        {
                            alert("Please Name Your Event and Specify Event Date and Time");
                        }
                        else
                        {
                            event_id = data[0];
                            var hiddenEventId = document.getElementById("event_id");
                            hiddenEventId.value = event_id;
                            $("input[name='task_id']:checked").val(data[1]);
                            $('#bookingSection').show();
                            $('#msgsuccess').show(500); 
                            setTimeout(function() { 
                                $('#msgsuccess').fadeOut(500); 
                            }, 3500);
                        }   
                    }
                });
            }
            else
            {
                $.ajax({
                    type:'POST',
                    url:'/client/saveeventagain',
                    data:$('#step1').serialize(),
                    success:function(data2){
                        if(data2==2)
                        {
                            alert("Please Name Your Event and Specify Event Date and Time");
                        }
                        else
                        {
                            $('#msgsuccess').show(500); 
                            setTimeout(function() { 
                                $('#msgsuccess').fadeOut(500); 
                            }, 3500);
                        }
                    }
                }); 
            }
            
        });

        $('#confirmBooking').click(function(){
            new_event_id = $('#event_id').val();
            new_task_id = $("input[name='task_id']:checked").val();
            $.ajax({
                    type:'GET',
                    url:'/client/makereserve/'+new_event_id+'/'+new_task_id+'/'+svp_id+'/'+service_id,
                    success:function(data3){
                        if(data3==1){
                            $('#bookingSection').hide();
                            $('#bookingAfterSection').show();
                            $('#save').prop('disabled', true);
                        }
                        else
                        {
                            $('#bookingSection').hide();
                            $('#bookingAfterSectionError').show();
                            $('#save').prop('disabled', true);
                        }
                    }
                });
        });
        
});
</script>