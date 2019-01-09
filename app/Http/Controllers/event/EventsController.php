<?php

namespace App\Http\Controllers\event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Event;
use App\ClientEvent;
use App\EventTemplateTask;

use App\Http\Controllers\event\TasksController;
use App\Http\Controllers\event\TemplateTasksController;


class EventsController extends Controller
{

    public function client_index()
    {
        $client = session()->get('customer_id');
        $event_ids = ClientEvent::select('event_id')->where('customer_id',$client)->get();
        $events = Event::wherein('event_id',$event_ids)->get();
        return view('client.event.myevents')->with('events',$events);
    }

    public static function getEvent($id)
    {
        $event = Event::find($id);
        return $event;
    }


    public function create()
    {
        //
    }

    public function store_step1(Request $request)
    {
            if(!(isset($request->event_name) && isset($request->event_date) && isset($request->event_stime) && isset($request->event_etime))) {return 0;}
            
            
            $event = new Event();
            $event->name = $request->event_name;
            $event->date = $request->event_date;
            $event->stime = $request->event_stime;
            $event->etime = $request->event_etime;
            $event->template_id = 1;
            $event->save();

            //Relate customer and event
            $client_event = new ClientEvent();
            $client_event->customer_id = session()->get('customer_id');
            $client_event->event_id = $event->event_id;
            $client_event->save();
            return $event->event_id;
    }

    public function store_step1_again(Request $request)
    {
            if(!(isset($request->event_name) && isset($request->event_date) && isset($request->event_stime) && isset($request->event_etime))) {return 2;}
            
            
            $event = Event::find($request->event_id);
            $event->name = $request->event_name;
            $event->date = $request->event_date;
            $event->stime = $request->event_stime;
            $event->etime = $request->event_etime;
            $event->save();
    }

    public function reserve_event_save(Request $request,$service)
    {
            if(!(isset($request->event_name) && isset($request->event_date) && isset($request->event_stime) && isset($request->event_etime))) {return 0;}
            
            
            $event = new Event();
            $event->name = $request->event_name;
            $event->date = $request->event_date;
            $event->stime = $request->event_stime;
            $event->etime = $request->event_etime;
            $event->template_id = 1;
            $event->save();

            //Relate customer and event
            $client_event = new ClientEvent();
            $client_event->customer_id = session()->get('customer_id');
            $client_event->event_id = $event->event_id;
            $client_event->save();

            $task = new Task();
            $task->name = $service;
            $task->istemp=1;
            $task->save();

            //Update EventTemplateTask
            $event_template_task = new EventTemplateTask();
            $event_template_task->event_id = $event->event_id;
            $event_template_task->task_id = $task->task_id;
            $event_template_task->save();

            $data = Array($event->event_id, $task->task_id);
            return $data;
            
    }

    
    public function store_template($event_id, $template_id)
    {
        $tasks = TemplateTasksController::getTasks($template_id);
        $event = Event::find($event_id);
            foreach($tasks as $task)
            {
             $event_template_task = new EventTemplateTask();
             $event_template_task->event_id = $event_id;
             $event_template_task->task_id = $task->task_id;
             $event_template_task->save();
            }  
            $event->template_id = $template_id;
            $event->save();
            return view('client.event.step2')->with('event_id',$event_id);

    }

    public function store_own(Request $request)
    {
        if($request->task_ids==NULL) {return 0;}
        $event = Event::find($request->event_id);
        foreach($request->task_ids as $task_id)
        {
            $event_template_task = new EventTemplateTask();
            $event_template_task->event_id = $request->event_id;
            $event_template_task->task_id = $task_id;
            $event_template_task->save();
        }
        $event->template_id = 2;
        $event->save();
        return 3;//Return 3 on success

    }

    public function clientOwn_step2($event_id)
    {
        return view('client.event.step2')->with('event_id',$event_id);
    }


    public function store1(Request $request)
    {
        if(!(isset($request->event_name) && isset($request->event_date) && isset($request->event_stime) && isset($request->event_etime))) {return "Please Name Your Event and Specify Event Date";}
        $default_task_ids = $request->default_task_id;
        $new_tasks = $request->new_task;

        array_splice($default_task_ids,0,1);
        array_splice($new_tasks,0,1);

        $default_number = count($default_task_ids);
        $new_number = count($new_tasks);
        

        if ($default_number + $new_number  > 0 )
        {
            
            $event = Event::find($request->event_id);
            $event->name = $request->event_name;
            $event->date = $request->event_date;
            $event->stime = $request->event_stime;
            $event->etime = $request->event_etime;
            $event->save();

            TasksController::destroyTemps2($event->event_id,$default_task_ids); // Delete all associated previous UNNECCESSARY temporary tasks
            EventTemplateTask::where('event_id',$event->event_id)->delete();//Delete all records from EventTempateTask before adding

            foreach($default_task_ids as $task_id)
            {
             $event_template_task = new EventTemplateTask();
             $event_template_task->event_id = $event->event_id;
             $event_template_task->task_id = $task_id;
             $event_template_task->save();
            }

            for($i=0;$i<$new_number;$i++)
            {
                if(trim($new_tasks[$i]) != '')
                {
                    //Add new Task to DB
                    $task = new Task();
                    $task->name =  $new_tasks[$i];
                    $task->istemp=1;
                    $task->save();

                    //Update EventTemplateTask
                    $event_template_task = new EventTemplateTask();
                    $event_template_task->event_id = $event->event_id;
                    $event_template_task->task_id = $task->task_id;
                    $event_template_task->save();
                    
                }
            }
            
            echo "Event Saved Successfully";
        }
        else
        {
            echo "Please add atleast one task for the event";
        }
    }

    public function store2(Request $request)
    {
        if(!(isset($request->event_name) && isset($request->event_date) && isset($request->event_stime) && isset($request->event_etime))) {return 2;}
        $default_task_ids = $request->default_task_id;
        $new_tasks = $request->new_task;

        array_splice($default_task_ids,0,1);
        array_splice($new_tasks,0,1);
        
        $default_number = count($default_task_ids);
        $new_number = count($new_tasks);
        

        if ($default_number + $new_number  > 0 )
        {
            
            $event = Event::find($request->event_id);
            $event->name = $request->event_name;
            $event->date = $request->event_date;
            $event->stime = $request->event_stime;
            $event->etime = $request->event_etime;
            $event->save();
            
            TasksController::destroyTemps2($event->event_id,$default_task_ids);
            
            //We can change this to delete only relevent tasks in destroyTemps2, but not implemented
            EventTemplateTask::where('event_id',$event->event_id)->delete();//Delete all records from EventTempateTask before adding

            

            foreach($default_task_ids as $task_id)
            {
             $event_template_task = new EventTemplateTask();
             $event_template_task->event_id = $event->event_id;
             $event_template_task->task_id = $task_id;
             $event_template_task->save();
            }

            for($i=0;$i<$new_number;$i++)
            {
                if(trim($new_tasks[$i]) != '')
                {
                    //Add new Task to DB
                    $task = new Task();
                    $task->name =  $new_tasks[$i];
                    $task->istemp=1;
                    $task->save();

                    //Update EventTemplateTask
                    $event_template_task = new EventTemplateTask();
                    $event_template_task->event_id = $event->event_id;
                    $event_template_task->task_id = $task->task_id;
                    $event_template_task->save();
                    
                }
            }
            
            return 1;
        }
        else
        {
            return 0;
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        TasksController::destroyTemps1($id);
        $event = Event::find($id);
        $event->delete();
    }
}