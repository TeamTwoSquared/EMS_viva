@extends('layouts.svp')
@section('content')


<section class="au-breadcrumb2" data-pg-collapsed> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="au-breadcrumb-content"> 
                    <div class="au-breadcrumb-left"> 
                        <span class="au-breadcrumb-span">You are here:</span> 
                        <ul class="list-unstyled list-inline au-breadcrumb__list"> 
                            <li class="list-inline-item active"> 
                                <a href="#">Home</a> 
                            </li>                             
                            <li class="list-inline-item seprate"> 
                                <span>/</span> 
                            </li>                             
                            <li class="list-inline-item">Support Center</li>                             
                        </ul>                         
                    </div>                     
                                        
                </div>                 
            </div>             
        </div>         
    </div>     
</section>

    <div class="container"> 

            <div class="card bg-light mb-3">
                    <div class="card-header">Our Support Policy</div>
                    <div class="card-body" style="border-left:solid 20px white"> 
                        <h4 class="card-title">Our web site EMS is  committed to providing quality services to you and this policy outlines our ongoing obligations to you in respect of how we manage your Personal Information.</h4>

                        We collect your Personal Information for the primary purpose of providing our services to you, providing information to our clients and marketing. We may also use your Personal Information for secondary purposes closely related to the primary purpose, in circumstances where you would reasonably expect such use or disclosure. You may unsubscribe from our system at any time.
                        And we will make sure to protect your personel information and not to misuse them.
                        <br><br>  
                                <div> 
                                    <a href='/svp/getSupport'>
                                        <button  class="btn btn-primary btn-lg" role="button">Get A Support</button>
                                    </a>
                                </div>           
                    </div>
                    
                </div>
                
  
        <hr/> 
          
    </div>     


@endsection