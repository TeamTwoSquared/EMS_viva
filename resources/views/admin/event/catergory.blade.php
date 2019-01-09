@extends('layouts.admin')
@section('content')
@php
use App\Catergory;
use App\Http\Controllers\event\CatergoriesController;
use App\Http\Controllers\event\CatergoryTemplatesController;

@endphp
<div class="row" data-pg-collapsed>
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Manage Catergory</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left"></div>
            <div class="table-data__tool-right">
                <a href="catergory/add"> 
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="fas fa-plus-circle"></i> Add Category&nbsp;
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
                        <th>number of templates</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Start TABLE ROW-->
                    @foreach($catergories as $catergory)
                    <tr class="tr-shadow">
                        <td>{{$catergory->name}}</td>
                        <td>{{$catergory->description}}</td>
                        <td>{{CatergoryTemplatesController::getTemplateCount($catergory->catergory_id)}}</td> 
                        <td>
                            <div class="table-data-feature">
                                <a href="catergory/edit/{{$catergory->catergory_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                
                                    <button onclick ="deleteMe({{$catergory->catergory_id}})" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                        <script>
                                            function deleteMe(id) {
                                                    if (confirm("Are you sure you want to delete this catergory!")) {
                                                        window.location.replace("catergory/delete/"+id);
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