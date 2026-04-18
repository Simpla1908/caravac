<?php 
if (isset($_GET['sous_id'])&& isset($_GET['hotel_id'])){ 
	include('./bdd/connexion.php');
	include './admin/traitement/fonctionalites.php';
	$souscript_id=$_GET['sous_id'];
	$type_souscription ='mensuel';
	$site_id = $_GET['hotel_id'];
	//Activation souscription
	ActivationSouscription($souscript_id,$type_souscription,$site_id,$bdd);
  } 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ebutelo | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Ionicons -->
  <!--<link rel="stylesheet" href="bootstrap/css/ionicons.min.css">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="bootstrap/css/AdminLTE.min.css">
  <!-- iCheck -->
  <!--<link rel="stylesheet" href="bootstrap/css/plugins/iCheck/square/blue.css">-->
  <link rel="shortcut icon" href="img/Iconebutelo.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
    
<div class="login-box">
  <div class="login-logo">
    <!--<a href="../../index2.html"><b>Connexion</b> </a>-->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
      <p class="login-box-msg">
          
          <img src="images/logo_ebutelo2.png" width="190" height="150"/>
          <BR><BR>
      </p>

    <form role="form" method="post" action="Authentification/verif.php" class="f">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="CODE" name="pseudo" id="pseudo" autofocus required>
       <span class="fa fa-lock form-control-feedback"></span>
      </div>
<!--      <div class="form-group has-feedback hidden">
        <input type="password" class="form-control" placeholder="Mot de Passe" name="motdepasse" id="motdepasse" required>
        <span class="fa fa-lock form-control-feedback"></span>
      </div>-->
      <div class="row">
        <div class="col-xs-3">
          <div id="loader" style="display: none"></div>
          </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <button class="btn btn-danger hidden" id="loader1">
                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
            </button>
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_con" id="formulaire">SE CONNECTER</button>
<!--            <span class="btn btn-danger hidden" id="loader1">
            <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours
            </span>-->
        </div>
        <div class="col-xs-3">
          <div id="loader" style="display: none"></div>
          </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
        <div id="alerte" class="alert-danger" style="display:none; border-radius:5px; height:40px; padding:10px;">
            <span id="text_msg">Nom d'utilisateur ou Mot de passe incorrect!</span>
        </div>
    </div>
    <!-- /.social-auth-links -->

    <!--<a href="#">Mot de passe oublié</a><br>-->                                               
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
<script src="bootstrap/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="bootstrap/js/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
     <!-- Authentification -->
	<script src="js_auth/jquery.js"></script>
	<script src="Authentification/control_userAjax.js"></script>
</body>
</html>
