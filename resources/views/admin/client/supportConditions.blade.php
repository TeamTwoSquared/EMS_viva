@extends('layouts.client')
@section('content')


<section class="au-breadcrumb2 pad-bottom5 pad15" data-pg-collapsed> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="au-breadcrumb-content"> 
                    <div class="au-breadcrumb-left" data-pg-collapsed> 
                        <span class="au-breadcrumb-span">You are here:</span> 
                        <ul class="list-unstyled list-inline au-breadcrumb__list"> 
                            <li class="list-inline-item active"> 
                                <a href="dash">Home</a> 
                            </li>          
                            <li class="list-inline-item seprate"> 
                                <span>/</span> 
                            </li>         
                            <li class="list-inline-item">
                                <a href="/client/myevents">Support</a>
                            </li>
                        </ul>     
                    </div>                     
                    <form class="au-form-icon--sm" action="/client/search" method="post">
                        {{ csrf_field() }} 
                        <input class="au-input--w300 au-input--style2" name = "data" type="text" placeholder="Find Services...."> 
                        <button class="au-btn--submit2" type="submit"> 
                            <i class="zmdi zmdi-search"></i> 
                        </button>                         
                    </form>                     
                </div>                 
            </div>             
        </div>         
    </div>     
</section>
<section class="statistic statistic2" data-pg-collapsed> 
    <div class="container"> 
        <div class="row" data-pg-collapsed> 
            <div class="col-md-9">
                <div class="row pr-2">
                        <div class="jumbotron"> 
                                <h1>Our Support Policy</h1>  
                                Our web site EMS is  committed to providing quality services to you and this policy outlines our ongoing obligations to you in respect of how we manage your Personal Information.<br><br>
We collect your Personal Information for the primary purpose of providing our services to you, providing information to our clients and marketing. We may also use your Personal Information for secondary purposes closely related to the primary purpose, in circumstances where you would reasonably expect such use or disclosure. You may unsubscribe from our system at any time.
And we will make sure to protect your personel information and not to misuse them.

                                <a href='/client/getSupport'>
                                    <button  class="btn btn-primary btn-lg" role="button">Get A Support</button>
                                </a>
                                 
                        </div>
                </div>          
            </div>     
            @include('inc.rightAds')             
        </div>         
        <hr/> 
        @include('inc.bottomAds')         
    </div>     
</section>

@endsection