@extends('layouts.admin')
@section('content')
@php
use App\Http\Controllers\event\TemplateTasksController;

@endphp
<div class="row" data-pg-collapsed>
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Manage Tasks</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left"></div>
            <div class="table-data__tool-right">
                <a href="task/add"> 
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="fas fa-plus-circle"></i>add task&nbsp;
                    </button>
                </a>
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>description</th>
                        <th>status</th>
                        <th>templates</th>
                        
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Start TABLE ROW-->
                    @foreach($tasks as $task)
                    <tr class="tr-shadow">
                        <td>{{$task->name}}</td>
                        <td>{{$task->description}}</td>
                        @if($task->istemp == 0)
                        <td><span class="status--process">active</span></td>
                        @elseif($task->istemp == 1)
                        <td><span class="status--pending">pending</span></td>
                        @else
                        <td><span class="status--denied">blocked</span></td>
                        @endif

                        <td class="desc">
                            @php
                            $template_names=TemplateTasksController::getTemplates($task->task_id);
                                foreach($template_names as $template_name)
                                {
                                    echo $template_name;
                                    echo '  ';
                                }
                            @endphp

                        </td>
                       
                        <td>
                            <div class="table-data-feature">
                                <a href="task/edit/{{$task->task_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                @if($task->istemp == 0)
                                <a href="task/block/{{$task->task_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Lock">
                                        <i class="fa fa-lock"></i>
                                    </button>
                                </a>
                                @elseif($task->istemp == 1)
                                <a href="task/block/{{$task->task_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </a>
                                @else
                                <a href="task/block/{{$task->task_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Un-Lock">
                                        <i class="fas fa-lock-open"></i>
                                    </button>
                                </a>
                                @endif
                                <button onclick ="deleteMe({{$task->task_id}})" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                    <script>
                                        function deleteMe(id) {
                                                if (confirm("Are you sure you want to delete this task!")) {
                                                    window.location.replace("task/delete/"+id);
                                                } 
                                            }
                                    </script>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach
                    <!-- END TABLE ROW-->
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>
@endsection