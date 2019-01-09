@php
use App\Http\Controllers\svp\SVPsController;
if((SVPsController::checkLogged(1))){
    header("Location: /svp/dash");
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
        <link href="/svp/css/font-face.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        
        <!-- Bootstrap core CSS -->
        <link href="/svp/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="/svp/style.css" rel="stylesheet">
        
        <!-- Bootstrap CSS-->
        <link href="/svp/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
        <!-- Vendor CSS-->
        <link href="/svp/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="/svp/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
        <!-- Main CSS-->
        <link href="/svp/css/theme.css" rel="stylesheet" media="all">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    </head>
    <body class="animsition">
            <div class="page-wrapper">
                <div class="page-content--bge5 bg-white">
                    <div class="container bg-white">
                        @include('inc.messages')
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- Jquery JS-->
            <script src="/svp/vendor/jquery-3.2.1.min.js"></script>
            <!-- Bootstrap JS-->
            <script src="/svp/vendor/bootstrap-4.1/popper.min.js"></script>
            <script src="/svp/vendor/bootstrap-4.1/bootstrap.min.js"></script>
            <!-- Vendor JS       -->
            <script src="/svp/vendor/slick/slick.min.js">
        </script>
            <script src="/svp/vendor/wow/wow.min.js"></script>
            <script src="/svp/vendor/animsition/animsition.min.js"></script>
            <script src="/svp/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
            <script src="/svp/vendor/counter-up/jquery.waypoints.min.js"></script>
            <script src="/svp/vendor/counter-up/jquery.counterup.min.js">
        </script>
            <script src="/svp/vendor/circle-progress/circle-progress.min.js"></script>
            <script src="/svp/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="/svp/vendor/chartjs/Chart.bundle.min.js"></script>
            <script src="/svp/vendor/select2/select2.min.js">
        </script>
            <!-- Main JS-->
            <script src="/svp/js/main.js"></script>
        </body>
    </html>
    <!-- end document-->