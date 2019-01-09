@extends('layouts.admin')
@section('content')

<div class="row" data-pg-collapsed>
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Manage Clients</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left"></div>
            <div class="table-data__tool-right">
                <a href="client/add"> 
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="fas fa-plus-circle"></i>add client&nbsp;
                    </button>
                </a>
                
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>username</th>
                        <th>e-mail</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Start TABLE ROW-->
                    @foreach($customers as $customer)
                    <tr class="tr-shadow">
                        <td>{{$customer->username}}</td>
                        <td>{{$customer->email}}</td>

                        @if($customer->isverified == 1)
                        <td><span class="status--process">verified</span></td>
                        @elseif($customer->isverified == 0)
                        <td><span class="status--pending">pending</span></td>
                        @else
                        <td><span class="status--denied">blocked</span></td>
                        @endif

                        
                        <td>
                            <div class="table-data-feature">
                                <a href="client/edit/{{$customer->customer_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                @if($customer->isverified == 1)
                                <a href="client/block/{{$customer->customer_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Lock">
                                        <i class="fa fa-lock"></i>
                                    </button>
                                </a>
                                @elseif($customer->isverified == 0)
                                <a href="client/block/{{$customer->customer_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </a>
                                @else
                                <a href="client/block/{{$customer->customer_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Un-Lock">
                                        <i class="fas fa-lock-open"></i>
                                    </button>
                                </a>
                                @endif
                                
                                    <button onclick ="deleteMe({{$customer->customer_id}})" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                        <script>
                                            function deleteMe(id) {
                                                    if (confirm("Are you sure you want to delete this customer!")) {
                                                        window.location.replace("client/delete/"+id);
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