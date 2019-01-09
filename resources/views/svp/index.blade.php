@php
  header("Location: /svp/service");
die();  
@endphp
@extends('layouts.svp')
@section('content')

 <!-- STATISTIC-->                 
 <section class="statistic"> 
    <div class="section__content section__content--p30"> 
        <div class="container-fluid"> 
            <div class="row"> 
                <div class="col-md-6 col-lg-3"> 
                    <div class="statistic__item"> 
                        <h2 class="number">10,368</h2> 
                        <span class="desc">members online</span> 
                        <div class="icon"> 
                            <i class="zmdi zmdi-account-o"></i> 
                        </div>                                         
                    </div>                                     
                </div>                                 
                <div class="col-md-6 col-lg-3"> 
                    <div class="statistic__item"> 
                        <h2 class="number">388,688</h2> 
                        <span class="desc">items sold</span> 
                        <div class="icon"> 
                            <i class="zmdi zmdi-shopping-cart"></i> 
                        </div>                                         
                    </div>                                     
                </div>                                 
                <div class="col-md-6 col-lg-3"> 
                    <div class="statistic__item"> 
                        <h2 class="number">1,086</h2> 
                        <span class="desc">this week</span> 
                        <div class="icon"> 
                            <i class="zmdi zmdi-calendar-note"></i> 
                        </div>                                         
                    </div>                                     
                </div>                                 
                <div class="col-md-6 col-lg-3"> 
                    <div class="statistic__item"> 
                        <h2 class="number">$1,060,386</h2> 
                        <span class="desc">total earnings</span> 
                        <div class="icon"> 
                            <i class="zmdi zmdi-money"></i> 
                        </div>                                         
                    </div>                                     
                </div>                                 
            </div>                             
        </div>                         
    </div>                     
</section>                 
<!-- END STATISTIC-->
<section> 
    <div class="section__content section__content--p30"> 
        <div class="container-fluid"> 
            <div class="row"> 
                <div class="col-xl-8"> 
                    <!-- RECENT REPORT 2-->                                     
                    <div class="recent-report2"> 
                        <h3 class="title-3">recent reports</h3> 
                        <div class="chart-info"> 
                            <div class="chart-info__left"> 
                                <div class="chart-note"> 
                                    <span class="dot dot--blue"></span> 
                                    <span>products</span> 
                                </div>                                                 
                                <div class="chart-note"> 
                                    <span class="dot dot--green"></span> 
                                    <span>Services</span> 
                                </div>                                                 
                            </div>                                             
                            <div class="chart-info-right"> 
                                <div class="rs-select2--dark rs-select2--md m-r-10"> 
                                    <select class="js-select2" name="property"> 
                                        <option selected="selected">All Properties</option>                                                         
                                        <option value="">Products</option>                                                         
                                        <option value="">Services</option>                                                         
                                    </select>                                                     
                                    <div class="dropDownSelect2"></div>                                                     
                                </div>                                                 
                                <div class="rs-select2--dark rs-select2--sm"> 
                                    <select class="js-select2 au-select-dark" name="time"> 
                                        <option selected="selected">All Time</option>                                                         
                                        <option value="">By Month</option>                                                         
                                        <option value="">By Day</option>                                                         
                                    </select>                                                     
                                    <div class="dropDownSelect2"></div>                                                     
                                </div>                                                 
                            </div>                                             
                        </div>                                         
                        <div class="recent-report__chart"> 
                            <canvas id="recent-rep2-chart"></canvas>                                             
                        </div>                                         
                    </div>                                     
                    <!-- END RECENT REPORT 2             -->                                     
                </div>                                 
                <div class="col-md-6 col-lg-4"> 
                    <!-- TOP CAMPAIGN-->                                     
                    <div class="top-campaign"> 
                        <h3 class="title-3 m-b-30">top campaigns</h3> 
                        <div class="table-responsive"> 
                            <table class="table table-top-campaign"> 
                                <tbody> 
                                    <tr> 
                                        <td>1. Australia</td> 
                                        <td>$70,261.65</td> 
                                    </tr>                                                     
                                    <tr> 
                                        <td>2. United Kingdom</td> 
                                        <td>$46,399.22</td> 
                                    </tr>                                                     
                                    <tr> 
                                        <td>3. Turkey</td> 
                                        <td>$35,364.90</td> 
                                    </tr>                                                     
                                    <tr> 
                                        <td>4. Germany</td> 
                                        <td>$20,366.96</td> 
                                    </tr>                                                     
                                    <tr> 
                                        <td>5. France</td> 
                                        <td>$10,366.96</td> 
                                    </tr>                                                     
                                </tbody>                                                 
                            </table>                                             
                        </div>                                         
                    </div>                                     
                    <!-- END TOP CAMPAIGN-->                                     
                </div>                                 
            </div>                             
        </div>                         
    </div>                     
</section>
@endsection