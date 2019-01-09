<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <title>Carousel Template for Bootstrap</title>         
        <!-- Bootstrap core CSS -->         
        <link href="/bootstrap/css/bootstrap.css" rel="stylesheet"> 
        <!-- Custom styles for this template -->         
        <link href="/carousel.css" rel="stylesheet"> 
        <link rel="stylesheet" href="/components/pg.blocks/css/blocks.css"> 
        <link rel="stylesheet" href="/components/pg.blocks/css/plugins.css"> 
        <link rel="stylesheet" href="/components/pg.blocks/css/style-library-1.css"> 
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700"> 
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic"> 
    </head>     
    <body> 
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> 
            <a href="#top"> 
                <a class="navbar-brand" href="/">EMS</a> 
            </a>             
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> 
                <span class="navbar-toggler-icon"></span> 
            </button>             
            <div class="collapse navbar-collapse" id="navbarCollapse"> 
                <ul class="navbar-nav mr-auto"> 
                    <li class="nav-item active"> 
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a> 
                    </li>                     
                    <li class="nav-item"> 
                        <a class="nav-link" href="/aboutus">About us</a> 
                    </li>                     
                    <li class="nav-item"> 
                        <a class="nav-link" href="/contactus">Contact us</a> 
                    </li>                     
                </ul>                 
                <form class="form-inline mt-2 mt-md-0"> 
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"> 
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>                     
                </form>                 
            </div>             
        </nav>         
        <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
            <ol class="carousel-indicators"> 
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>                 
                <li data-target="#myCarousel" data-slide-to="1"></li>                 
                <li data-target="#myCarousel" data-slide-to="2"></li>                 
            </ol>             
            <div class="carousel-inner"> 
                <div class="carousel-item active"> 
                    <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide"> 
                    <div class="container"> 
                        <div class="carousel-caption d-none d-md-block text-left"> 
                            <h1>Example headline.</h1> 
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p> 
                        </div>                         
                    </div>                     
                </div>                 
                <div class="carousel-item"> 
                    <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide"> 
                    <div class="container"> 
                        <div class="carousel-caption d-none d-md-block"> 
                            <h1>Another example headline.</h1> 
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p> 
                        </div>                         
                    </div>                     
                </div>                 
                <div class="carousel-item"> 
                    <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide"> 
                    <div class="container"> 
                        <div class="carousel-caption d-none d-md-block text-right"> 
                            <h1>One more for good measure.</h1> 
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p> 
                        </div>                         
                    </div>                     
                </div>                 
            </div>             
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> 
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> 
        </div>         
        <!-- Marketing messaging and featurettes
    ================================================== -->         
        <!-- Wrap the rest of the page in another container to center all the content. -->         
        <div class="container marketing"> 
            <!-- Three columns of text below the carousel -->             
            <div class="row"> 
                <div class="col-lg-4 col-xl-6"> 
                    <img class="rounded-circle" alt="Client Image" width="140" height="140" src="images/clientss.jpg"> 
                    <h2>Client</h2> 
                    <a class="btn btn-primary btn-lg btn-block" href="/client/login">Login</a> 
                    <a class="btn btn-secondary btn-lg btn-block" href="/client/register">Register</a> 
                </div>                 
                <div class="col-lg-4 col-xl-6"> 
                    <img class="rounded-circle" alt="Service Provider image" width="140" height="140" src="images/service provider2.png"> 
                    <h2>Service provider</h2> 
                    <a class="btn btn-primary btn-lg btn-block" href="/svp/login">Login</a> 
                    <a class="btn btn-secondary btn-lg btn-block" href="/svp/register">Register</a> 
                </div>                 
                <!-- /.col-lg-4 -->                 
                <!-- /.col-lg-4 -->                 
                <!-- /.col-lg-4 -->                 
            </div>             
            <!-- /.row -->             
            <!-- START THE FEATURETTES -->             
            <hr class="featurette-divider"> 
            <div class="row featurette"> 
                <div class="col-md-7"> 
                    <h2 class="featurette-heading">Vast range of pre-defined templates</h2> 
                    <p class="lead">Our system users can manage their event using our pre-defined templates in an easy and effiecient way. Even users without having any knowledge about event planing can also use our system to manage their event.</p> 
                    <p class="lead">Also you can edit or create&nbsp;</p> 
                </div>                 
                <div class="col-md-5"> 
                    <img class="featurette-image img-fluid mx-auto" style="width: 500px; height: 500px;" src="images/party template.jpg" data-holder-rendered="true" alt="Event template image"> 
                </div>                 
            </div>             
            <hr class="featurette-divider"> 
            <div class="row featurette"> 
                <div class="col-md-7 order-md-2"> 
                    <h2 class="featurette-heading">Everything you need at your at your finger tips</h2> 
                    <p class="lead">Our system has provide clients task based searching option where you can find relevent service providers for relevent tasks</p> 
                </div>                 
                <div class="col-md-5 order-md-1"> 
                    <img class="featurette-image img-fluid mx-auto" src="images/happy user.jpg" data-holder-rendered="true" style="width: 500px; height: 500px;" alt="Searching option image"> 
                </div>                 
            </div>             
            <hr class="featurette-divider"> 
            <div class="row featurette"> 
                <div class="col-md-7"> 
                    <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2> 
                    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p> 
                </div>                 
                <div class="col-md-5"> 
                    <img class="featurette-image img-fluid mx-auto" src="images/chatting people.jpg" data-holder-rendered="true" style="width: 500px; height: 500px;" alt="Chatting people image"> 
                </div>                 
            </div>             
            <hr class="featurette-divider"> 
            <!-- /END THE FEATURETTES -->             
            <!-- FOOTER -->             
            <footer> 
                <p class="float-right"><a href="#top">Back to top</a></p> 
                <p>Copyright © 2018 EMS. All rights reserved. · <a href="/privacy">Privacy</a> · <a href="/tos">Terms</a></p> 
            </footer>             
        </div>         
        <!-- /.container -->         
        <!-- Bootstrap core JavaScript
    ================================================== -->         
        <!-- Placed at the end of the document so the pages load faster -->         
        <script src="/assets/js/jquery.min.js"></script>         
        <script src="/assets/js/popper.js"></script>         
        <script src="/bootstrap/js/bootstrap.min.js"></script>         
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->         
        <script src="/assets/js/holder.min.js"></script>         
        <script type="text/javascript" src="/components/pg.blocks/js/plugins.js"></script>         
        <script type="text/javascript" src="/components/pg.blocks/js/bskit-scripts.js"></script>         
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>         
    </body>     
</html>