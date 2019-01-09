@extends('layouts.client')
@section('content')
@php
    use App\Http\Controllers\event\TemplateTasksController;
@endphp
<section class="au-breadcrumb2 pad-bottom5 pad15" data-pg-collapsed> 
        <div class="container"> 
            <div class="row"> 
                <div class="col-md-12"> 
                    <div class="au-breadcrumb-content"> 
                        <div class="au-breadcrumb-left" data-pg-collapsed> 
                            <span class="au-breadcrumb-span">You are here:</span> 
                            <ul class="list-unstyled list-inline au-breadcrumb__list"> 
                                <li class="list-inline-item"> 
                                    <a href="dash">Home</a> 
                                </li>         
                                <li class="list-inline-item seprate"> 
                                    <span>/</span> 
                                </li>         
                                <li class="list-inline-item">Template Selection</li>
                            </ul>     
                        </div>                     
                        <form class="au-form-icon--sm" action="/client/search" method="post">
                            {{ csrf_field() }} 
                            <input class="au-input--w300 au-input--style2" name = "data" type="text" placeholder="Find Services...."> 
                            <button class="au-btn--submit2" type="submit"> 
                                <i class="zmdi zmdi-search"></i> 
                            </button>                         
                        </form>                     
                    </div>                 
                </div>             
            </div>         
        </div>     
</section>
<hr/>
<section class="statistic statistic2 pad5" data-pg-collapsed>
    <div class="container"> 
        <div class="row">
            <div class="col-md-9">
                <form name="step1" id="step1">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">Event Name</label>
                            <input type="text" class="form-control" id="validationDefault01" placeholder="My First Event" name = "event_name" id="event_name" value="" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">Event Date</label>
                            <input type="date" class="form-control" id="validationDefault02" placeholder="" name = "event_date" id="event_date" value="" required>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">From</label>
                            <input type="time" class="form-control" id="validationDefault01" placeholder="My First Event" name = "event_stime" id="event_stime" value="" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">To</label>
                            <input type="time" class="form-control" id="validationDefault02" placeholder="" name = "event_etime" id="event_etime" value="" required>
                        </div>
                        <input type="hidden" name="event_id" id="event_id" value="0">
                    </div>
                    <p id="msgsuccess" style="display:none" class="text-success font-weight-bold mt-0 mb-0 ">Event Saved Successfully !</p>
                    <div class="row" data-pg-collapsed>
                        <button type="button" class="btn btn-secondary ml-3" name="save" id="save">Save Event</button>
                    </div>
                    <hr/>
                    <div class="row">
                        <h4><b>Template Selection</b></h4>
                    </div>
                    <div class="row">
                        <div class="alert alert-success col-md-10"> 
                            <strong>Select most suitable template for your event!</strong> or you can select tasks from different templates and create your 
                            <strong>own template</strong>.  
                            <br>N.B. You can change / add new tasks in next step :)
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="panels1" role="tablist"> 
                                @php
                                    $i = 1; 
                                @endphp
                                @foreach($templates as $template)
                                <div class="card"> 
                                    <div role="tab"> 
                                        <h5 class="mb-0 card-header"> <a data-toggle="collapse" href="#" aria-expanded="true" aria-controls="collapse1">{{$template->name}}</a> </h5> 
                                    </div>                                     
                                    <div id="collapse1" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#panels1"> 
                                        <div class="card-body">
                                            {{$template->description}}
                                            <div id="panels{{$i}}_2" role="tablist" class="mt-1"> 
                                                @php
                                                   $tasks = TemplateTasksController::getTasks($template->template_id); 
                                                   $j = 1;
                                                @endphp
                                                @foreach($tasks as $task)
                                                <div class="card"> 
                                                    <div role="tab" class="card-header pl-4"> 
                                                        <input class="form-check-input" type="checkbox" id="task_ids" name="task_ids[]" value="{{$task->task_id}}">
                                                    <h5 class="mb-0"> <a data-toggle="collapse" href="#collapse{{$i}}_{{$j}}" aria-expanded="true" aria-controls="collapse{{$i}}_{{$j}}">{{$task->name}}</a> </h5> 
                                                    </div>                                                     
                                                    <div id="collapse{{$i}}_{{$j++}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#panels{{$i}}_2"> 
                                                        <div class="card-body ">
                                                            {{$task->description}}
                                                        </div>                                                     
                                                </div>
                                                                                               
                                            </div>
                                            @endforeach 
                                            <button class="btn btn-primary ml-2 enableMe" onclick ="choose({{$template->template_id}})"type="button" disabled="true">Choose this template</button> 
                                            <script>
                                                function choose(id) {
                                                    var hiddenEventId = document.getElementById("event_id");
                                                    window.location.replace("/client/savenewtemplate/"+hiddenEventId.value+"/"+id);
                                                    }
                                            </script>
                                        </div>                                         
                                    </div>                                     
                                </div>                                
                            </div> 
                            @php
                              $i++;  
                            @endphp
                            @endforeach                             
                        </div>
                     </div>
                    </div>
                    <button class="btn btn-primary enableMe" type="button" name="create_own" id="create_own" disabled="true">create my own template</button>
                </form>
            </div>
            <!-- Right-Pane Ads with col-md-3-->
            @include('inc.rightAds')               
            <!-- End of Ads -->            
        </div>         
        <hr/> 
        <!-- Bottom-Pane Ads-->
            @include('inc.bottomAds')             
        <!-- End of Ads -->     
    </div>
</section>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
        var event_id = 0;
        $('#save').click(function(){
            if(event_id == 0)
            {
            $.ajax({
                    type:'POST',
                    url:'/client/saveevent',
                    data:$('#step1').serialize(),
                    success:function(data){
                        if(data==0)
                        {
                            alert("Please Name Your Event and Specify Event Date and Time");
                        }
                        else
                        {
                            event_id = data;
                            var hiddenEventId = document.getElementById("event_id");
                            hiddenEventId.value = event_id;
                            $('.enableMe').prop('disabled', false);
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

        $('#create_own').click(function(){
            $.ajax({
                type:'POST',
                url:'/client/saveown',
                data:$('#step1').serialize(),
                success:function(data3){
                    if(data3==0)
                    {
                        alert("Please Select at least a single task");
                    }
                    else
                    {
                        var hiddenEventId = document.getElementById("event_id");
                        window.location.replace("/client/ownstep2/"+hiddenEventId.value);
                    }
                }
            });

        });

        
    });
</script>
<hr/>
@endsection