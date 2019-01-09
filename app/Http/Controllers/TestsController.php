<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\EventTemplateTask;
use App\Task;

class TestsController extends Controller
{
    public function ajaxRequestPost(Request $request)
    {
        $number = count($request->name);
        if ($number > 1 )
        {
            for($i=0;$i<$number;$i++)
            {
                if(trim($request->name[$i]) != '')
                {
                    $test = new Test();
                    $test->name = $request->name[$i];
                    $test->save();
                    
                }
            }
            
            echo "Data Inserted";
        }
        else
        {
            echo "Enter name";
        }
         
    }

    public function add2(Request $request)
    {
        //$input = request()->all();
        $number = count($request->name);
        if ($number > 2 ){
        return response()->json(['success'=>$request->name[1] ]);
        }
        return response()->json(['success'=>'qqqqqq']);
    }

    public function orderdata(Request $request)
    {
        if(!isset($request->event_name)) {return 2;}
        $default_task_ids = $request->default_task_id;
        $new_tasks = $request->new_task;

        array_splice($default_task_ids,0,1);
        array_splice($new_tasks,0,1);
        
        $default_number = count($default_task_ids);
        $new_number = count($new_tasks);

        $removedTasks = EventTemplateTask::select('task_id')->where('event_id',22)->whereNotIn('task_id',$default_task_ids)->get();
        
        Task::whereIn('task_id',$removedTasks)->where('istemp',1)->delete();

        return $removedTasks;
    }
}
