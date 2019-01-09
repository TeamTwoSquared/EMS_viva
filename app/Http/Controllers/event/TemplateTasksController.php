<?php

namespace App\Http\Controllers\event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Template;
use App\Task;
use App\TemplateTask;

class TemplateTasksController extends Controller
{
    public static function getTemplates($task_id)
    {
        //Use to return a template name set when a task Id is provided
        $template_tasks = TemplateTask::where('task_id',$task_id)->get();
        $template_names = Array();
        foreach($template_tasks as $template_task)
        {
            $template =  Template::where('template_id',$template_task->template_id)->get();
            $template =  $template[0];
            $template_names = array_prepend($template_names,$template->name);
        }
        return $template_names;
        

    }

    public static function getTasks($template_id)
    {
        //Use to return a tasks name set when a template Id is provided
        $template_tasks = TemplateTask::select('task_id')->where('template_id',$template_id)->get();
        $tasks = Array();
        foreach($template_tasks as $template_task)
        {
            $task =  Task::where('task_id',$template_task->task_id)->get();
            if($task[0]->istemp==0)
            {
                $task =  $task[0];
                $tasks = array_prepend($tasks,$task);
            }
        }
        return $tasks;
        

    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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


    public static function taskDestroy($id)
    {
       // remove all templates belong to a task
       return TemplateTask::where('task_id',$id)->delete();
    }
    public static function getTemplatesTask($task_id)
    {
        $template_tasks = TemplateTask::where('task_id',$task_id)->get();
        $template_all = Array();
        foreach($template_tasks as $template_task)
        {
            $template = Template::where('template_id',$template_task->template_id)->get();
            $template = $template[0];
            $template_all = array_prepend($template_all,$template);
        }
        return $template_all;
    }
}