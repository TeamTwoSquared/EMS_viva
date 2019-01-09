@php
use App\Http\Controllers\client\ClientsController;
if(!(ClientsController::checkLogged(0))){
header("Location: /client/login");
die();
}
$client=ClientsController::getClient();                      
@endphp
<!DOCTYPE html> 
<html lang="en">
    <head> 
        <!-- Required meta tags-->         
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <meta name="description" content="This is an Web Based Event Management System"> 
        <meta name="author" content="TeamTwoSquared"> 
        <meta name="keywords" content="ems event management template">
        <meta name="csrf-token" content="{{ csrf_token() }}" /> 
        <!-- Title Page-->         
        <title>EMS</title>         
        <!-- Fontfaces CSS-->         
        <link href="/client/css/font-face.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all"> 
        <!-- Custom styles for this template -->         
        <link href="/client/style.css" rel="stylesheet">
        <!-- Bootstrap CSS-->         
        <link href="/client/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all"> 
        <!-- Vendor CSS-->         
        <link href="/client/vendor/animsition/animsition.min.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/wow/animate.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/slick/slick.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/select2/select2.min.css" rel="stylesheet" media="all"> 
        <link href="/client/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all"> 
        <!-- Main CSS-->         
        <link href="/client/css/theme.css" rel="stylesheet" media="all"> 
        <link rel="stylesheet" href="/client/components/pg.blocks/css/blocks.css">
        <link rel="stylesheet" href="/client/components/pg.blocks/css/plugins.css">
        <link rel="stylesheet" href="/client/components/pg.blocks/css/style-library-1.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <!-- Tag input CSS-->
        <link rel="stylesheet" media="all" type="text/css" href="/client/taginput.css">
        
    </head>     
    <body class="animsition"> 
        <!-- MODALS -->
        @include('inc.modals')
        <!-- END MODALS -->
        <div class="page-wrapper"> 
            <!-- HEADER DESKTOP-->             
            <header class="header-desktop3 d-none d-lg-block bg-ems-admin"> 
                <div class="section__content section__content--p35"> 
                    <div class="header3-wrap"> 
                        <div class="header__logo"> 
                            <a href="/client/dash"> 
                                <img src="/client/images/icon/logo-client.png" alt="ClientDash"/> 
                            </a>                             
                        </div>                         
                        <div class="header__navbar"> 
                            <ul class="list-unstyled"> 
                                <li> 
                                    <a href="/client/dash"> <i class="fas fa-tachometer-alt"></i> <span class="bot-line"></span>Dashboard</a> 
                                </li>                                 
                                <li> 
                                    <a href="/client/myevents"> <i class="fas fa-chart-bar"></i> <span class="bot-line"></span>My Events</a> 
                                </li>
                                
                                <li> 
                                    <a href="/client/help"> <i class="fas fa-life-ring fa"></i> <span class="bot-line"></span>Support Center</a> 
                                </li>                                 
                            </ul>                             
                        </div> 
                         <?php
                             //   $newNotificationForHelp = DB::table('notifications')->where('is_read',0)->where('type',1)->where('customer_id',session()->get('customer_id'))->get();
                                $newCommentNotificationForHelp = DB::table('notifications')->where('is_read',0)->where('type',2)->where('to_whome',2)->where('customer_id',session()->get('customer_id'))->get();
                                $allNotificationsForClient=(count($newCommentNotificationForHelp));
                                
                        ?>                       
                        <div class="header__tool"> 
                            <div class="header-button-item has-noti js-item-menu"> 
                                <i class="zmdi zmdi-notifications"></i> 
                                <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown"> 
                                    <div class="notifi__title"> 
                                        <p>You have {{$allNotificationsForClient}} Notifications</p> 
                                    </div>                                     
                                     
                                        <!--support center notification box-->
                                            @include('layouts.client_help_notification')
                                        <!--end-->        

                                    <div class="notifi__footer"> 
                                        <a href="#">All notifications</a> 
                                    </div>                                     
                                </div>                                 
                            </div>                             
                            <div class="account-wrap"> 
                                <div class="account-item account-item--style2 clearfix js-item-menu"> 
                                    <div class="image"> 
                                        <img src="/storage/images/profile/{{$client->profilepic}}" alt="{{$client->username}}"/> 
                                    </div>                                     
                                    <div class="content"> 
                                        <a class="js-acc-btn" href="#">{{$client->username}}</a> 
                                    </div>                                     
                                    <div class="account-dropdown js-dropdown"> 
                                        <div class="info clearfix"> 
                                            <div class="image"> 
                                                <a href="#"> 
                                                    <img src="/storage/images/profile/{{$client->profilepic}}" alt="{{$client->username}}"/> 
                                                </a>                                                 
                                            </div>                                             
                                            <div class="content"> 
                                                <h5 class="name"> <a href="#">{{$client->username}}</a> </h5> 
                                                <span class="email">{{$client->email}}</span> 
                                            </div>                                             
                                        </div>                                         
                                        <div class="account-dropdown__body"> 
                                            <div class="account-dropdown__item"> 
                                                <a href="/client/profile"> <i class="zmdi zmdi-account"></i>Account</a> 
                                            </div>                                             
                                                                                         
                                                                                         
                                        </div>                                         
                                        <div class="account-dropdown__footer"> 
                                            <a href="/client/logout"> <i class="zmdi zmdi-power"></i>Logout</a> 
                                        </div>                                         
                                    </div>                                     
                                </div>                                 
                            </div>                             
                        </div>                         
                    </div>                     
                </div>                 
            </header>             
            <!-- END HEADER DESKTOP-->             
            <!-- HEADER MOBILE-->             
            <header class="header-mobile header-mobile-2 d-block d-lg-none"> 
                <div class="header-mobile__bar bg-ems-admin"> 
                    <div class="container-fluid"> 
                        <div class="header-mobile-inner"> 
                            <a class="logo" href="/client/dash"> 
                                <img src="/client/images/icon/logo-client.png" alt="ClientDash"/> 
                            </a>                             
                            <button class="hamburger hamburger--slider" type="button"> 
                                <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> 
                            </button>                             
                        </div>                         
                    </div>                     
                </div>                 
                <nav class="navbar-mobile"> 
                    <div class="container-fluid"> 
                        <ul class="navbar-mobile__list list-unstyled bg-ems-admin"> 
                            <li> 
                                <a href="/client/dash"> <i class="fas fa-tachometer-alt"></i>Dashboard</a> 
                            </li>                             
                            <li> 
                                <a href="/client/myevents"> <i class="fas fa-chart-bar"></i>My Events</a> 
                            </li>                             
                                                        
                            <li> 
                                <a href="/client/help"> <i class="fas fa-life-ring fa"></i>Support Center</a> 
                            </li>                             
                        </ul>                         
                    </div>                     
                </nav>                 
            </header>             
            <div class="sub-header-mobile-2 d-block d-lg-none"> 
                <div class="header__tool"> 
                    <div class="header-button-item has-noti js-item-menu"> 
                        <i class="zmdi zmdi-notifications"></i> 
                        <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown"> 
                            <div class="notifi__title"> 
                                <p>You have 3 Notifications</p> 
                            </div>                             
                            <div class="notifi__item"> 
                                <div class="bg-c1 img-cir img-40"> 
                                    <i class="zmdi zmdi-email-open"></i> 
                                </div>                                 
                                <div class="content"> 
                                    <p>You got a email notification</p> 
                                    <span class="date">April 12, 2018 06:50</span> 
                                </div>                                 
                            </div>                             
                            <div class="notifi__item"> 
                                <div class="bg-c2 img-cir img-40"> 
                                    <i class="zmdi zmdi-account-box"></i> 
                                </div>                                 
                                <div class="content"> 
                                    <p>Your account has been blocked</p> 
                                    <span class="date">April 12, 2018 06:50</span> 
                                </div>                                 
                            </div>                             
                            <div class="notifi__item"> 
                                <div class="bg-c3 img-cir img-40"> 
                                    <i class="zmdi zmdi-file-text"></i> 
                                </div>                                 
                                <div class="content"> 
                                    <p>You got a new file</p> 
                                    <span class="date">April 12, 2018 06:50</span> 
                                </div>                                 
                            </div>                             
                            <div class="notifi__footer"> 
                                <a href="#">All notifications</a> 
                            </div>                             
                        </div>                         
                    </div>                     
                    <div class="account-wrap"> 
                        <div class="account-item account-item--style2 clearfix js-item-menu"> 
                            <div class="image"> 
                                <img src="/storage/images/profile/{{$client->profilepic}}" alt="{{$client->username}}"/> 
                            </div>                             
                            <div class="content"> 
                                <a class="js-acc-btn" href="#">{{$client->username}}</a> 
                            </div>                             
                            <div class="account-dropdown js-dropdown"> 
                                <div class="info clearfix"> 
                                    <div class="image"> 
                                        <a href="#"> 
                                            <img src="/storage/images/profile/{{$client->profilepic}}" alt="{{$client->username}}"/> 
                                        </a>                                         
                                    </div>                                     
                                    <div class="content"> 
                                        <h5 class="name"> <a href="#">{{$client->username}}</a> </h5> 
                                        <span class="email">{{$client->email}}</span> 
                                    </div>                                     
                                </div>                                 
                                <div class="account-dropdown__body"> 
                                    <div class="account-dropdown__item"> 
                                        <a href="/client/profile"> <i class="zmdi zmdi-account"></i>Account</a> 
                                    </div>                                     
                                                                      
                                </div>                                 
                                <div class="account-dropdown__footer"> 
                                    <a href="/client/logout"> <i class="zmdi zmdi-power"></i>Logout</a> 
                                </div>                                 
                            </div>                             
                        </div>                         
                    </div>                     
                </div>                 
            </div>             
            <!-- END HEADER MOBILE -->             
            <!-- PAGE CONTENT-->             
            <div class="page-content--bgf7"> 
                @include('inc.messages')
                @yield('content')                
                <section class="p-t-60 p-b-20"> 
                    <div class="container"> 
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="copyright"> 
                                    <p>Copyright © 2019 EMS. All rights reserved.</p> 
                                </div>                                 
                            </div>                             
                        </div>                         
                    </div>                     
                </section>                 
                <!-- END COPYRIGHT-->                 
            </div>             
        </div>         
        <!-- Jquery JS-->         
        <script src="/client/vendor/jquery-3.2.1.min.js"></script>         
        <!-- Bootstrap JS-->         
        <script src="/client/vendor/bootstrap-4.1/popper.min.js"></script>         
        <script src="/client/vendor/bootstrap-4.1/bootstrap.min.js"></script>         
        <!-- Vendor JS       -->         
        <script src="/client/vendor/slick/slick.min.js">
    </script>         
        <script src="/client/vendor/wow/wow.min.js"></script>         
        <script src="/client/vendor/animsition/animsition.min.js"></script>         
        <script src="/client/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>         
        <script src="/client/vendor/counter-up/jquery.waypoints.min.js"></script>         
        <script src="/client/vendor/counter-up/jquery.counterup.min.js">
    </script>         
        <script src="/client/vendor/circle-progress/circle-progress.min.js"></script>         
        <script src="/client/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>         
        <script src="/client/vendor/chartjs/Chart.bundle.min.js"></script>         
        <script src="/client/vendor/select2/select2.min.js">
    </script>         
        <!-- Main JS-->         
        <script src="/client/js/main.js"></script>         
        <script type="text/javascript" src="/client/components/pg.blocks/js/plugins.js"></script>
        <script type="text/javascript" src="/client/components/pg.blocks/js/bskit-scripts.js"></script>
        <!-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script> -->
    </body>     
</html> 
<!-- end document-->