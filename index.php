<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pi-Project</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
  <h1>Canon électromagnétique <small>Contrôle</small></h1>
    <div class="well">
      Interface de contrôle
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4"><button class="btn btn-primary btn-lg btn-block boutonHaut"><span class="glyphicon glyphicon-arrow-up"></span></button></div>
        </div>
        <div class="row">
          <div class="col-md-4 col-xs-4"><button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-left"></span></button></div>
          <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4"><button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-right"></button></div>
        </div>
        <div class="row">
          <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4"><button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-down"></button></div>
        </div>
        <div>
          <br/><button class="btn btn-warning btn-lg btn-block boutonFire"><span class="glyphicon glyphicon-fire"> Fire</button>
        </div>
        <div style = "display: none" class = "divBoutonFire2">
          <br/><button class="btn btn-danger btn-lg btn-block boutonFire2"><span class="glyphicon glyphicon-fire"> Fire</button>
        </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.boutonHaut').click(function(event) {
          $(this).attr('disabled', 'disabled');
        });
        $('.boutonFire').click(function(event) {
          if(!$('.boutonFire2').is(":visible"))
          {
            var MdP = prompt("Entrer le mot de passe pour pouvoir tirer :");
            if(MdP != "azerty")
            {
              alert("Mot de passe incorrect.")
              return;
            }
            alert("Attention la mise à feu est désormais disponible.");
          }
            $('.divBoutonFire2').toggle();
        });
      });
    </script>
  </body>
</html>