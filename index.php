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
    <style type="text/css">
      .decompte
      {
        height: 100%;
        width: 100%;
        z-index: 999;
        position: fixed;
        font-size: 210px;
        text-align: center;
        color: red;
        padding-top: 10%;
        background-color: rgba(255, 255, 255, 0.83);
        display: none;
      }
    </style>
  </head>
  <body>
  <div class="decompte">
    <div class="decompteNumerique"></div>
    <div class="progress progress-striped active">
      <div class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%" id="progressBarFire">
      </div>
    </div>
    <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4"><button name="Relancer" id="NewFire" style="display:none" class="buttonInd btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-refresh"> Relancer</span></button></div>
  </div>
  <!-- navbar -->
    <nav class="navbar navbar-default navbar-fixed-top alert navbarNotif" role="navigation" style="display:none">
      <div class="container">
        <span class="texteNotif"></span>
      </div>
    </nav>
  <!-- navbar -->

  <h1>Canon électromagnétique <small>Interface de contrôle</small></h1>
    <div class="well">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4"><button name="haut" class="buttonDirection btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-up"></span></button></div>
        </div>
        <div class="row">
          <div class="col-md-4 col-xs-4"><button name="gauche" class="buttonDirection btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-left"></span></button></div>
          <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4"><button name="droite" class="buttonDirection btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-right"></button></div>
        </div>
        <div class="row">
          <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4"><button name="bas" class="buttonDirection btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-down"></button></div>
        </div>
        <div>
          <br/><button class="btn btn-warning btn-lg btn-block boutonFire"><span class="glyphicon glyphicon-fire"> Fire</button>
        </div>
        <div style = "display: none" class = "divBoutonFire2">
          <br/><button class="btn btn-danger btn-lg btn-block boutonFire2"><span class="glyphicon glyphicon-fire"> Fire</button>
        </div>
      </div>
    </div>

    <!-- Modal bootstrap pour mot de passe -->
    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Confirmez le mot de passe</h4>
          </div>
          <div class="modal-body">
            <label>Mot de passe : <input type="password" id="MdP"></label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" id="confirmModal">Confirmer</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin modal bootstrap pour mot de passe -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

      var one = 0;

      $(document).ready(function() 
      {
        rebindEventsKeyPress();
        rebindEventsKeyDown();
        rebindEventsKeyUp();
        var timeout, clicker = $('.buttonDirection');
        clicker.mousedown(function(event) 
        {
          var direction = $(this).attr('name');
          timeout = setInterval(function()
          {
              $.ajax(
              {
                url: 'traitement.php',
                type: 'POST',
                data: {bouton: direction},
              })
              .done(function(valeurRetour) 
              {
                $("body").append(valeurRetour);
              });
          }, 100);          
        });

        $('.decompte').click(function(event) {
          location.reload();
        });

        $(document).mouseup(function()
        {
            clearInterval(timeout);
            return false;
        });
          
        $('#modalPassword').on('shown.bs.modal', function (e) 
        {
          $('#MdP').focus();
        })

        $('.boutonFire').click(function(event) 
        {
            /**var voix = new SpeechSynthesisUtterance();
            voix.lang = 'fr-FR';
            voix.text = "Veuillez rentrer votre mot de passe";
            speechSynthesis.speak(voix);*/

            if ($('.divBoutonFire2').is(":visible")) 
            {
              $('.divBoutonFire2').hide();
              rebindEventsKeyDown();
            }
            else
            {
              $('#modalPassword').modal();
              $(document).unbind('keydown');
            }         
        });

        $('.boutonFire2').click(function(event) 
        {
          $(document).unbind('keypress');
          $(document).unbind('keyup');
          /**var voix = new SpeechSynthesisUtterance();
          voix.lang = 'fr-FR';
          voix.text = "Mise à feu enclenchée.";
          speechSynthesis.speak(voix);*/
          $('.decompte').fadeIn('slow');
          counter($('.decompteNumerique'), 20);   
        });

        $('#NewFire').click(function(event) 
        {
          location.reload();
        });

        function counter($el, n) 
        {
          (function loop() 
          {
            $(document).one('keypress', function(event) 
            {
              $('#NewFire').trigger('click');
              return;
            });
            $el.html(Math.ceil(n/4));
            var pourcent = 5*n;
            var pourcent2 = pourcent + "%";
            $('#progressBarFire').css('width', pourcent2);
            if (n--) 
            {
              setTimeout(loop, 250);
            }
            else
            {
              $('#NewFire').show();
              return;
            }
          })();       
        }

        function rebindEventsKeyPress()
        {
          $(document).keypress(function(event) 
          {
            if (event.which == 13) 
            {
              event.preventDefault();
              if($('#MdP').val() != "")
              {
                $('#confirmModal').trigger('click');
              }
              else if($('.boutonFire2').is(':visible'))
              {
                $('.boutonFire2').trigger('click');
              }
            }
            else if (event.which == 53) 
            {
              $('.boutonFire').trigger('click');
            }
          });
        }

        function rebindEventsKeyDown()
        {
          $(document).keydown(function(event) 
          {
            if (one == 0) 
            {
              if (event.which == 104) 
              {
                 $('[name="haut"]').trigger('mousedown');
                 one = 1;
              }
              else if (event.which == 100) 
              {
                $('[name="gauche"]').trigger('mousedown');
                one = 2;
              }
              else if (event.which == 102) 
              {
                $('[name="droite"]').trigger('mousedown');
                one = 3;
              }
              else if (event.which == 98) 
              {
                $('[name="bas"]').trigger('mousedown');
                one = 4;
              }
            }
          });
        }

        function rebindEventsKeyUp()
        {
          $(document).keyup(function(event) 
          {
            if (event.which == 104 && one == 1) 
            {
              $('[name="haut"]').trigger('mouseup');
              one = 0;
            }
            else if (event.which == 100 && one == 2) 
            {
              $('[name="gauche"]').trigger('mouseup');
              one = 0;
            }
            else if (event.which == 102 && one == 3) 
            {
              $('[name="droite"]').trigger('mouseup');
              one = 0;
            }
            else if (event.which == 98 && one == 4) 
            {
              $('[name="bas"]').trigger('mouseup');
              one = 0;
            }
          });
        }

        $('#confirmModal').click(function(event) 
        {
          $('#modalPassword').modal('hide');
          var MdP = $('#MdP').val();
          $('#MdP').val("");
          if(MdP != "azerty")
          {
            $(".texteNotif").text("Mot de passe incorrect");
            $(".navbarNotif").addClass('alert-danger');
            $(".navbarNotif").show("slow");
            setTimeout(function() 
            {
              $(".navbarNotif").hide("slow");
              $(".navbarNotif").removeClass('alert-danger');
            }, 3000);
            rebindEventsKeyDown();
            return;
          }
          $(".texteNotif").text("La mise à feu est désormais disponible");
          $(".navbarNotif").addClass('alert-success');
          $(".navbarNotif").show("slow");
          setTimeout(function() 
          {
            $(".navbarNotif").hide("slow");
            $(".navbarNotif").removeClass('alert-success');
          }, 3000);
          $('.divBoutonFire2').toggle();
        });
      });
    </script>
  </body>
</html>