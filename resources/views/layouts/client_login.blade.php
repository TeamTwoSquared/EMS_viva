@php
use App\Http\Controllers\client\ClientsController;
if((ClientsController::checkLogged(1))){
    header("Location: /client/dash");
    die();
}                          
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

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Title Page-->
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fontfaces CSS-->
        <link href="/client/css/font-face.css" rel="stylesheet" media="all">
        <link href="/client/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="/client/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="/client/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        
        <!-- Bootstrap core CSS -->
        <link href="/client/bootstrap/css/bootstrap.css" rel="stylesheet">
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
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    </head>
    <body class="animsition">
            <div class="page-wrapper">
                <div class="page-content--bge5">
                    <div class="container">
                        @include('inc.messages')
                        @yield('content')
                    </div>
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
        </body>
    </html>
    <!-- end document-->