<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <title>Jumbotron Template for Bootstrap</title>         
        <!-- Bootstrap core CSS -->         
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet"> 
        <!-- Custom styles for this template -->         
        <link href="jumbotron.css" rel="stylesheet"> 
        <link rel="stylesheet" href="components/pg.blocks/css/blocks.css">
        <link rel="stylesheet" href="components/pg.blocks/css/plugins.css">
        <link rel="stylesheet" href="components/pg.blocks/css/style-library-1.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">
    </head>     
    <body>          
        <!-- Main jumbotron for a primary marketing message or call to action -->                  
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
        <div class="container"> 
            <!-- Example row of columns -->                          
            <div class="col-sm-offset-1 col-sm-12">
                <div class="underlined-title">
                    <h1>Contact Us</h1>
                    <hr>
                    <h2>we are readty to provide you with more information ,asn</h2>
                </div>
                <p>Cras mattis consectetur purus sit amet fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod. Nulla vitae elit libero, a pharetra augue. Aenean eu leo quam. Pellentesque ornare sem lacinia.</p>
                <ul class="contact-info">
                    <li>
                        <span class="fa fa-map-marker"></span>
                        <wp-span>16 Queen's Mews, Covent Garden, London, LO2 4ON</wp-span>
                    </li>
                    <li>
                        <span class="fa fa-phone"></span>
                        <wp-span>+44 (0) 1234 5678</wp-span>
                    </li>
                    <li>
                        <span class="fa fa-envelope"></span>
                        <a href="mailto:buyme@example.com">buyme@example.com</a> 
                    </li>
                </ul>
                <div id="contact" class="form-container">
                    <div id="message"></div>
                    <form method="post" action="js/contact-form.php" name="contactform" id="contactform">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="name" id="name" type="text" value="" placeholder="Name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="email" id="email" type="text" value="" placeholder="Email" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="phone" id="phone" type="text" value="" placeholder="Phone" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="form-group">
                            <textarea name="comments" id="comments" class="form-control" rows="3" placeholder="Message" id="textArea"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" id="cf-submit" name="submit">Send</button>
                        </div>
                    </form>
                </div>
                <!-- /.form-container -->
            </div>
            <hr> 
            <footer>                  
                <p class="float-right"><a href="#top">Back to top</a></p>
                <p>Copyright © 2018 EMS. All rights reserved. · <a href="/privacy">Privacy</a> · <a href="/tos">Terms</a></p> 
            </footer>             
        </div>         
        <!-- /container -->         
        <!-- Bootstrap core JavaScript
    ================================================== -->         
        <!-- Placed at the end of the document so the pages load faster -->         
        <script src="assets/js/jquery.min.js"></script>         
        <script src="assets/js/popper.js"></script>         
        <script src="bootstrap/js/bootstrap.min.js"></script>         
        <script type="text/javascript" src="components/pg.blocks/js/plugins.js"></script>
        <script type="text/javascript" src="components/pg.blocks/js/bskit-scripts.js"></script>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    </body>     
</html>