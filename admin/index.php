<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ebutelo! | </title>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="images/ico/favicon.png"> 
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="f" role="form" method="post" action="traitement/access.php">
              <h1>Login Admin</h1>
              <div>
                <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="motdepasse" id="motdepasse" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="submit" class="btn btn-default" value="Log in" name="login" id="formulaire">
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>
              <div class="clearfix"></div>

              <div class="separator">
<!--                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>-->

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-signal"></i>  ebutelo</h1>
<!--                  <p>©2017 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
-->                </div>
              </div>
            </form>
            <div id="alerte" class="alert-danger" style="display:none;border-radius:5px; height:40px; padding:10px;">
              <span id="text_msg">Nom d'utilisateur ou Mot de passe incorrect!</span>

            </div>
          </section>
        </div>

        <div id="formulaire" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i></h1>
                  <p></p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
<script src="vendors/jquery/dist/jquery.js"></script>
<script>
$(document).ready(function () {
  $('#formulaire').click(function (event) {
    event.preventDefault();
    var bool = false;
    var donnees = $('.f').serialize();
    var url = $('.f').attr('action');
    var method = $('.f').attr('method');
//             $('#loader').addClass('loader').show();
    $.ajax({
      url: url,
      async: true,
      type: method,
      data: donnees,
      beforeSend: function () {
        $('#loader').addClass('loader').show();
      },
      success: function (data) {
        if (data == 'succes') {
          location.href = 'production/index.php';
        }
        else if (data == 'echec') {
          $('#text_msg').text("Nom d'utilisateur ou Mot de passe incorrect!");
          $('#alerte').show();

        }
        bool = true;
      },
      error: function (resultat, statut, erreur) {
        alert(erreur);
      },
      complete: function () {
        if (bool) {
          $('#loader').addClass('loader').hide();
        } else {
          $('#loader').addClass('loader').show();
        }
      }
    });

    return false;
  });
});
</script>