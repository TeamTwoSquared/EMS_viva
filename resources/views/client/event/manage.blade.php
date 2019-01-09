@extends('layouts.client')
@section('content')
<style type="text/css">
    a.disableLink {
        pointer-events: none;
        cursor: default;
    }
</style>
@php
 use App\Http\Controllers\event\TemplatesController;
 use App\Http\Controllers\event\TemplateTasksController;
 use App\Http\Controllers\event\TemplateImagesController;
 use App\Http\Controllers\event\EventTemplateTasksController;
 use App\Http\Controllers\event\EventsController;
 use App\Http\Controllers\review\ReviewsController;

 $default_template = session()->get('default_template');

 
$i = 1; //to number rows
$is_old = 2; //Specify whether event is old or not
$my_event_id=$event_id; //Current event id is recieved
$my_event = EventsController::getEvent($my_event_id);
$default_tasks = EventTemplateTasksController::getTasks($my_event_id);

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
                                    <a href="/client/dash">Home</a> 
                                </li>         
                                <li class="list-inline-item seprate"> 
                                    <span>/</span> 
                                </li>         
                                <li class="list-inline-item">
                                    <a href="/client/myevents">My Events</a>
                                </li>
                                <li class="list-inline-item seprate"> 
                                    <span>/</span> 
                                </li>         
                                <li class="list-inline-item">Manage Event : {{$my_event->name}}</li>
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
        <div class="row pl-2">
            <div class="col-md-9"> 
                @if($is_old==0)         
                <div class="row">
                    <div class="alert font-weight-bold" role="alert">
                        Managing Event: {{$my_event->name}}
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button id="invite" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter">
                            Invite</button>
                    </div>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><strong>Invite Friends</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="store" method="post" enctype="multipart/form-data" class="form-horizontal">
                                {{ csrf_field() }} 
                                <div class="modal-body">                                   
                                    <div class="row form-group">
                                        <div class="col col-md-2 col-xl-2 "> 
                                            <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Email address</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="emailtag">
                                                <div id="tags" name="tags">
                                                    <input type="email" value="" id="email" name="email">
                                                    <input type="hidden" id="emails" name="emails" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                     
                                </div>
                                <input type="hidden" id="event_id2"name="event_id" value="{{$my_event->event_id}}" >
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" onclick="setEmail()">Invite</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <form name="edit_tasks" id="edit_tasks">
                            
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault01">Event Name</label>
                                <input type="text" class="form-control" placeholder="My First Event" name = "event_name" id="event_name" value="{{$my_event->name}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02">Event Date</label>
                                    <input type="date" class="form-control" placeholder="" name = "event_date" id="event_date" value="{{$my_event->date}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02">From</label>
                                    <input type="time" class="form-control" placeholder="" name = "event_stime" id="event_stime" value="{{$my_event->stime}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02">To</label>
                                    <input type="time" class="form-control" placeholder="" name = "event_etime" id="event_etime" value="{{$my_event->etime}}" required>
                                </div>
                                <input type="hidden" name="event_id" id="event_id" value="{{$my_event->event_id}}">
                            
                            
                        <table class="table" id="dynamic_field">
                            <thead> 
                                <tr> 
                                     
                                    <th>Task</th>
                                    <th>Service Providers</th>
                                    @if($my_event->date > date("Y-m-d"))
                                        <th>Rate</th>
                                    @endif
                                    <th></th> 
                                </tr>                                 
                            </thead>                             
                            <tbody> 
                                <input type="hidden" id="task_id" name="default_task_id[]" value="1"/>
                                <input type="hidden" name="new_task[]" value="0"/>
                                
                                @foreach($default_tasks as $default_task)
                                <tr id="row{{$i}}" class="MoveableRow table table-bordered bg-clouds shadow"> 
                                     
                                    <td><input type="text" readonly value="{{$default_task->name}}" class="form-control-plaintext name_list"/> <input type="hidden" id="task_id{{$i}}" name="default_task_id[]" value="{{$default_task->task_id}}"/></td>
                                    <td id="data{{$i}}" class="align-middle" data-pg-collapsed><a href="/client/search2/{{$default_task->task_id}}" target="_blank"><strong>Search for Service Providers</strong>&nbsp;<i class="fa fa-search"></i></a></td>
                                    @if($my_event->date > date("Y-m-d"))
                                        @if(ReviewsController::israted($event_id,$default_task->task_id) == 1)
                                            <td>
                                                <button class="btn btn-success btn-sm" id="rate" data-url="/client/review/get/{{$event_id}}/{{$default_task->task_id}}" data-toggle="modal" data-target="#rateModal" disabled>Rated</button>
                                            </td>
                                        @elseif(ReviewsController::israted($event_id,$default_task->task_id) == 0)
                                            <td>
                                                <button class="btn btn-success btn-sm" id="rate" data-url="/client/review/get/{{$event_id}}/{{$default_task->task_id}}" data-toggle="modal" data-target="#rateModal">Place</button>
                                            </td>
                                        @else
                                            <td>
                                                <button class="btn btn-success btn-sm" disabled>Place</button>
                                            </td>
                                        @endif
                                    @endif
                                    <td>
                                        <div class="table-data-feature flex-row-reverse">
                                            <button type="button" name="remove" id="{{$i++}}" class="item btn_remove" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>  
                                @endforeach                               
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
                <p id="msginfo" style="display:none" class="text-primary font-weight-bold mt-0 mb-0 ">Please Save Your Newly Added Task, Before Searching for Service Providers!</p>
                <div class="row" data-pg-collapsed>
                        <button type="button" name="add" id="add" onclick="showMsg()" class="btn btn-secondary btn-outline-secondary active btn-block">Add New Task</button>
                </div>
                <div class="row">
                    <button type="button" name="save" id="save" class="btn btn-primary">Save Changes</button>
                </div>
                @include('client.event.chat2')
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
        function setEmail() {
            document.getElementById('emails').value=document.getElementById('emails').value+" "+document.getElementById('email').value;
        }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
</script>
<script src="/client/taginput.js"></script>
<script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var is_old = {{$is_old}};
            var i={{$i}};
            i--;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'" class="table table-bordered bg-clouds shadow MoveableRow">'+
                                    '<td><input type="text" name="new_task[]" id="new_task'+i+'"placeholder="Enter a Task" class="form-control name_list"/></td>'+
                                    '<td class="align-middle" data-pg-collapsed><a class = "disableLink" id="'+i+'" onClick="a(this);" style="cursor: pointer; cursor: hand;"><strong>Search for Service Providers</strong>&nbsp;<i class="fa fa-search"></a></i></td>'+
                                    '<td>'+
                                        '<div class="table-data-feature flex-row-reverse">'+
                                                '<button type="button" name="down" id="down" class="item down_button" title="Move Down">'+
                                                    '<i class="fa-chevron-down fa"></i>'+
                                                '</button>'+
                                            '&nbsp;'+
                                                '<button type="button" name="up" id="up" class="item up_button" title="Move Up">'+
                                                    '<i class="fa fa-chevron-up"></i>'+
                                                '</button>'+
                                            '&nbsp;'+
                                            '<button type="button" name="remove" id="'+i+'" class="item btn_remove" title="Delete">'+
                                                '<i class="zmdi zmdi-delete"></i>'+
                                            '</button>'+
                                        '</div>'+
                                    '</td>'+
                                '</tr>');
            });

            $(document).on('click','.down_button', function(){
                var rowToMove = $(this).parents('tr.MoveableRow:first');
                var next = rowToMove.next('tr.MoveableRow')
                if (next.length == 1) { next.after(rowToMove); }

            });

            $(document).on('click','.up_button', function(){
                var rowToMove = $(this).parents('tr.MoveableRow:first');
                var prev = rowToMove.prev('tr.MoveableRow')
                if (prev.length == 1) { prev.before(rowToMove); }

            });



            $(document).on('click','.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();

            });
            $('#save').click(function(){
                if(is_old==0)
                {
                    $.ajax({
                        type:'POST',
                        url:'/client/savenewtemplate',
                        data:$('#edit_tasks').serialize(),
                        success:function(data)
                        {
                            if(data==2) alert("Please Name Your Event");
                            else if(data==1) 
                            {
                                alert("Event Created Successfully");
                                is_old = 1;
                            }
                            else if(data==0) alert("Please add atleast one task for the event");
                            
                            //$('#edit_tasks')[0].reset(); //redirect to myevent/eventid 
                        }
                    });
                }
                else if(is_old==1)
                {
                    $.ajax({
                        type:'POST',
                        url:'/client/savetemplate1',
                        data:$('#edit_tasks').serialize(),
                        success:function(data)
                        {
                            alert(data);
                            //$('#edit_tasks')[0].reset(); //redirect to myevent/eventid
                        }
                    });
                }
                else if(is_old==2)
                {
                    $.ajax({
                        type:'POST',
                        url:'/client/savetemplate2',
                        data:$('#edit_tasks').serialize(),
                        success:function(data)
                        {
                            if(data==2) alert("Please Name Your Event and Specify Event Date");
                            else if(data==1) 
                            {
                                alert("Event Saved Successfully");
                                is_old = 1;
                            }
                            else if(data==0) alert("Please add atleast one task for the event");
                            else alert(data);
                            //$('#edit_tasks')[0].reset(); //redirect to myevent/eventid
                            // url:'/client/savetemplate2',
                        }
                    }); 
                }
                $('.disableLink').removeClass("disableLink");              
            });
            
            $(document).on('click', '#rate', function(e){
            e.preventDefault();
            var url = $(this).data('url');

            $('#dynamic-content-rate').html(''); // leave it blank before ajax call
            $('#modal-loader-rate').show();      // load ajax loader

            $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
            })
            .done(function(data){
            console.log(data);  
            $('#dynamic-content-rate').html('');    
            $('#dynamic-content-rate').html(data); // load response 
            $('#modal-loader-rate').hide();        // hide ajax loader   
            })
            .fail(function(){
            $('#dynamic-content-rate').html('&nbsp;&nbsp;&nbsp;<i class="fas fa-info-circle"></i> Something went wrong, Please try again...');
            $('#modal-loader-rate').hide();
            });
              
            });
            
        });
        function a(obj){
            var text = document.getElementById("new_task"+obj.id);
            if(text.value=="") alert("Some tasks are unnamed, they will be discarded");
            else window.open("/client/search1/"+text.value,'_blank');
            window.location.replace("/client/myevents/"+{{$my_event_id}});
        }
        
        function showMsg(){
            $('#msginfo').show(500); 
            setTimeout(function() { 
                $('#msginfo').fadeOut(500); 
            }, 3500);
        }
        setInterval ("listen()",10000);
        j = 1;
        var my_rows = {{$i}};
        var event_id={{$event_id}};//constant
            function listen()
            { 
                if(j<my_rows)
                {
                    task_id = $('#task_id'+j+'').val();
                        $.ajax({
                            type:'GET',
                            url:'/client/manage/listen/'+event_id+'/'+task_id,
                            success:function(data){
                                if(data==0){}
                                else
                                {
                                    var service_id = data[0];
                                    var service_name = data[1];
                                    var svp_id = data[2];
                                    if(svp_id)
                                    {
                                        var svp_name = data[3];
                                        var status = data[4];
                                        var html = '<a href="/client/view/service/'+service_id+'" target="_blank">'+String(service_name)+'</a> of service provider '+'<a href="/client/view/svp/'+String(svp_id)+'"target="_blank">'+String(svp_name)+'</a> : Status ';
                                        if(status) html = html+"<b>approved</b>";
                                        else html = html+"<b>pending</b>";
                                    }
                                    else //SVP has cancelled booking from his side
                                    {
                                        var html = "Your booking for service <a href='/client/view/service/"+String(service_id)+"' target='_blank' >"+String(service_name)+"</a> has been <b>canceled</b>"+" <a href='/client/search2/"+String(task_id)+"'target='_blank'><strong>Search for Service Providers</strong>&nbsp;<i class='fa fa-search'></i></a>";
                                    }
                                    $('#data'+j+'').html(html);
                                } 
                                j++;
                                listen();
                            }
                        });
                }
                else{
                    j=1;
                }
            }

</script>
<hr/>
@endsection