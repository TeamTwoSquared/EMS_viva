<?php

namespace App\Http\Controllers\event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Task;
use App\EventTemplateTask;
use App\Service;
use App\SVP;
use App\Booking;

class EventTemplateTasksController extends Controller
{
    public static function getTasks($event_id)
    {
        //Use to return a tasks of Clients+Defaults when a event ID and template ID is provided
        $event_tasks = EventTemplateTask::select('task_id')->where('event_id',$event_id)->get();
        $tasks = Array();
        foreach($event_tasks as $event_task)
        {
            $task =  Task::where('task_id',$event_task->task_id)->get();
            $task =  $task[0];
            $tasks = array_prepend($tasks,$task);
            
        }
        return $tasks;
        

    }

    public function listenForBooking($event_id, $task_id)
    {
        $obj = EventTemplateTask::where('event_id',$event_id)->where('task_id',$task_id)->get()[0];
        $service = null; $booking=null; $svp=null;

        if ($obj->service_id) $service = Service::find($obj->service_id);
        if($obj->booking_id){
            $booking = Booking::find($obj->booking_id);
            $svp = SVP::find($booking->service_provider_id);
        }

        $data = Array();
        if($service!=null) {
            array_push($data,$service->service_id,$service->name);
        }
        else {
            return 0;
        }

        if($svp!=null) {
            array_push($data,$svp->service_provider_id,$svp->name,$booking->status);
        }
        else {
            array_push($data,0);
        }

        return $data;
    }
}
