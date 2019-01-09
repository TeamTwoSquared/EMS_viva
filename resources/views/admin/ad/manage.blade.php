@extends('layouts.admin')
@section('content')
@php
   use App\Http\Controllers\svp\SVPsController;
@endphp
<div class="row" data-pg-collapsed>
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Manage Adverisement</h3>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Advertisement Name</th>
                        <th>Service Provider</th>
                        <th>Type</th>
                        <th>Placement</th>
                        <th>Status</th>
                        <th>Price (Rs.)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Start TABLE ROW-->
                    @foreach($ads as $ad)
                    <tr class="tr-shadow">
                        <td>{{$ad->title}}</td>
                        <td>
                            {{SVPsController::getSVP2($ad->service_provider_id)->username}}
                        </td>
                        @if($ad->type == 0)
                        <td>Picture</td>
                        @elseif($ad->type == 1)
                        <td>Text</td>
                        @endif

                        @if($ad->position == 0)
                        <td>Bottom Pane</td>
                        @elseif($ad->position == 1)
                        <td>Right Pane</td>
                        @else
                        <td>Bottom & Right</td>
                        @endif

                        @if($ad->isapprove == 1)
                        <td><span class="status--process">online</span></td>
                        @elseif($ad->isapprove == 0)
                        <td><span class="status--pending">pending</span></td>
                        @elseif($ad->isapprove == 2)
                        <td><span class="status--denied">blocked</span></td>
                        @elseif($ad->isapprove == 3)
                        <td><strong>Payment in Process</strong></td>
                        @elseif($ad->isapprove == 4)
                        <td><span class="status--pending"><strong>EXPIRED</strong></span></td>
                        @endif
                        <td>{{$ad->price}}</td>
                        <td>
                            <div class="table-data-feature">
                                <a href="ad/view/{{$ad->ad_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                @if($ad->isapprove == 0)
                                <a href="ad/approve/{{$ad->ad_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </a>
                                @endif

                                @if($ad->isapprove == 2)
                                <a href="ad/unblock/{{$ad->ad_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Un-Block">
                                        <i class="fas fa-lock-open"></i>
                                    </button>
                                </a>
                                @else
                                <a href="ad/block/{{$ad->ad_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Block">
                                        <i class="fa fa-lock"></i>
                                    </button>
                                </a> 
                                @endif 
                                    <button onclick ="deleteMe({{$ad->ad_id}})" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                        <script>
                                            function deleteMe(id) {
                                                    if (confirm("Are you sure you want to delete this ad")) {
                                                        window.location.replace("ad/delete/"+id);
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