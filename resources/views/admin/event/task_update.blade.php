@extends('layouts.admin')
@section('content')
@php
use App\Task;
use App\TaskKeyword;
use App\TemplateTask;
use App\Http\Controllers\event\TemplatesController;
use App\Http\Controllers\event\TemplateTasksController;
$savedTemplates=TemplateTasksController::getTemplatesTask($task->task_id);
$allTemplates = TemplatesController::getTemplates();
$i=1; //use to have checkbox number
@endphp
<div class="row" data-pg-collapsed>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <strong>Update</strong> Task
            </div>
            <div class="card-body card-block">
                <form  onsubmit="return confirm('Do you really want to update the task {{$task->name}}')" action="update/{{$task->task_id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class="form-control-label">Task Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name"value="{{$task->name}}" maxlength="60" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">Description</div>
                        <div class="col-12 col-md-9">
                            <textarea name="description" id="description" rows="3" maxlength="250" class="form-control">{{$task->description}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">Keywords</div>
                        <div class="col-12 col-md-9">
                            <textarea style="text-transform:uppercase" name="keywords" id="keywords" rows="3"  class="form-control">@foreach($taskKeywords as $taskKeyword){{$taskKeyword->keyword}}{{" "}}@endforeach</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class="form-control-label">Time Duration</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="time_duration" name="time_duration" value="{{$task->timeduration}}" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class="form-control-label">Templates</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-check">
                                 @foreach($allTemplates as $template)
                                    <div class="checkbox">
                                        <label for="checkbox_{{$i}}" class="form-check-label">
                                                <input type="checkbox" id="{{$template->name}}" name="templates[]" value="{{$template->template_id}}" class="form-check-input" >{{$template->name}}
                                         </label>
                                    </div>
                                    @php
                                    $i++;  
                                    @endphp
                                @endforeach
                                @foreach($savedTemplates as $template)
                                    <script>
                                        document.getElementById("{{$template->name}}").checked = true;
                                    </script>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                            <button type="update" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Update
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