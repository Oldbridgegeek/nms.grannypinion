<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="utf-8">
  <title>Grannypinion</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  
  <meta property="og:title" content="">
  <meta property="og:type" content="website">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">
  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <!-- Styles -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900|Montserrat:400,700' rel='stylesheet' type='text/css'>
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/modernizr-2.7.1.js"></script>
  
</head>
<body>
  
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="logo" href="index.html"><img src="img/logo.png" alt="Logo" style="height:60px"></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{route('login')}}" class="scroll">Anmelden</a></li>
          <li><a href="#invite">Registrieren</a></li>
        </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    
    <header>
      <div class="container">
        <div class="row">
          <div class="col-xs-6">
            <a href="index.html"><img src="img/logo2.png" alt="Logo" style="height:150px;width:190px;"></a>
          </div>
          <div class="col-xs-6 signin text-right navbar-nav">
            <a href="{{route('login')}}">Anmelden</a> &nbsp; &nbsp; <a href="#invite">Registrieren</a>
          </div>
        </div>
        
        <div class="row header-info">
          <div class="col-sm-10 col-sm-offset-1 text-center">
            <h1 class="wow fadeIn">Dein anonymes Feedback und Bewertungsportal</h1>
            <br />
            <p class="lead wow fadeIn" data-wow-delay="0.5s">Finde heraus was deine Freunde und Bekannte wirklich über dich denken. Hole dir anonymes Feedback und lese die ungeschminkte Wahrheit.</p>
            <br />
            
            <div class="row">
              <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="row">
                  <div class="col-xs-6 text-right wow fadeInUp" data-wow-delay="1s">
                    <a href="#be-the-first" class="btn btn-secondary btn-lg scroll">Mehr erfahren</a>
                  </div>
                  <div class="col-xs-6 text-left wow fadeInUp" data-wow-delay="1.4s">
                    <a href="#invite" class="btn btn-primary btn-lg scroll">Registrieren</a>
                  </div>
                  </div><!--End Button Row-->
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </header>
      
      <div class="mouse-icon hidden-xs">
        <div class="scroll"></div>
      </div>
      
      <section id="be-the-first" class="pad-xl">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center margin-30 wow fadeIn" data-wow-delay="0.6s">
              <h2>Unsere Fehler.</h2>
              <p class="lead">Wir sollten von ihnen lernen. Doch oft fallen uns unsere eigenen Fehler nicht auf. Deine Freunde und Familie
              wollen deine Gefühle nicht verletzten und verschweigen sie dir. </p>
            </div>
          </div>
        </div>
      </section>
      
      <section id="main-info" class="pad-xl">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.4s">
              <hr class="line purple">
              <h3>Erhalte Bewertungen</h3>
              <p>Erhalte nach einem von uns konzipierten Formular anonym eine Bewertung auf dein Profil. Dein Profil ist privat, das heißt
              nur du kannst diese Bewertungen sehen. Wenn du das möchtest, kannst du dein Profil veröffentlichen, sodass jeder deine Bewertungen lesen kann.</p>
            </div>
            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.8s">
              <hr  class="line blue">
              <h3>Erstelle persönliche Umfragen und Feedbackbögen</h3>
              <p>Du möchtest die Meinung deiner Freunde und Familie zu einem bestimmten Thema wissen? Dann erstelle dein eigenes Umfrageformular und erhalte anonyme Zuschriften. </p>
            </div>
            <div class="col-sm-4 wow fadeIn" data-wow-delay="1.2s">
              <hr  class="line yellow">
              <h3>Anonyme Nachrichten verschicken</h3>
              <p>Verschicke anonyme Nachrichten an alle Benutzer der Plattform.</p>
            </div>
          </div>
        </div>
      </section>
      
      
      <!--Pricing-->
      <section id="pricing" class="pad-lg">
        <div class="container">
          <div class="row margin-40">
            <div class="col-sm-8 col-sm-offset-2 text-center">
              <h2 class="white">Alles kostenlos.</h2>
              <p class="white">Das Schönste daran? Es ist Alles kostenlos.</p>
            </div>
          </div>
        </section>
        
        
        <section id="invite" class="pad-lg light-gray-bg">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 text-center">
                <i class="fa fa-envelope-o margin-40"></i>
                <h2 class="black">Beta.</h2>
                <br />
                <p class="black">Zur Zeit läuft die Beta Version. Trage dich in den Newsletter ein und werde informiert
                sobald die Plattform für alle zugänglich ist.</p>
                <br />
                
                <div class="row">
                  <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <form role="form">
                      <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email eintragen">
                      </div>
                      <button type="submit" class="btn btn-primary btn-lg">Newsletter abonnieren</button>
                    </form>
                  </div>
                  </div><!--End Form row-->
                </div>
              </div>
            </div>
          </section>
          
          
          <footer>
            <div class="container">
              
              <div class="row">
                <div class="col-sm-8 margin-20">
                  <ul class="list-inline social">
                    <li>Gemeinsam sind wir stark <3 </li>
                    <li><a href="https://www.facebook.com/Grannypinion-284201705342315/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/grannypinion/"><i class="fa fa-instagram"></i></a></li>
                  </ul>
                </div>
                
                <div class="col-sm-4 text-right">
                  <p><small>Copyright &copy; 2017. All rights reserved. <br>
                    Erstellt von <a href="http://eneswitwit.com">Enes Witwit</a></small></p>
                  </div>
                </div>
                
              </div>
            </footer>
            
            
            <!-- Javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
            <script src="js/wow.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/main.js"></script>
            
          </body>
        </html>