@extends('layouts.svp')
@section('content')
@php
use App\Http\Controllers\svp\SVPBookingServicesController;
use App\Http\Controllers\service\ServiceCustomerBookingsController;
@endphp
<div class="row" data-pg-collapsed>
    <div class="col-md-12 pl-5 pr-5 mt-3">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Manage Booking</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
            </div>
            <div class="table-data__tool-right">
                <a href="booking/add"> 
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add Booking&nbsp;
                    </button>
                </a>
                
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>status</th>
                        <th>services</th>
                        <th>Client</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Start TABLE ROW-->
                    @foreach($bookings as $booking)
                    <tr class="tr-shadow">
                        <td class="agenda-date" class="active" rowspan="1">
                            @php
                            $date = new DateTime($booking->date);                                
                            @endphp 
                            {{$booking->date}}
                        </td>
                        <td class="agenda-time">
                            <div>{{$booking->stime}}</div>
                            <div>to</div>
                            <div>{{$booking->etime}}</div> 
                        </td> 
                        @if($booking->status == 1)
                        <td><span class="status--process">active</span></td>
                        @else
                        <td><span class="status--denied">pending</span></td>
                        @endif
                        <td class="active" rowspan="1">
                            @php
                                $services=SVPBookingServicesController::getServices($booking->booking_id);
                            @endphp
                            @foreach ($services as $service)
                                <div>{{$service->name}}</div> 
                            @endforeach
                        </td>
                        <td class="active" rowspan="1">
                            @php
                                $clients=ServiceCustomerBookingsController::getClients($booking->booking_id);
                            @endphp
                                @foreach ($clients as $client)
                                    <div>{{$client->name}}</div>
                                @endforeach
                        </td>  
                        <td>
                            <div class="table-data-feature">
                                @if($booking->status == 0)
                                <a href="booking/block/{{$booking->booking_id}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Active">
                                        <i class="fa fa-check-circle"></i>
                                    </button>
                                </a>
                                @endif                                
                                <button onclick ="deleteMe({{$bookings[0]->booking_id}})" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                    <script>
                                        function deleteMe(id) 
                                        {
                                            if (confirm("Are you sure you want to delete this booking!")) 
                                            {
                                                window.location.replace("booking/delete/"+id);
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