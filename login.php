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
  <style>

/* ===== FOND BLEU ===== */
body.login-page {
  background: linear-gradient(135deg, #2f6edb, #1e4db7);
  height: 100vh;
  position: relative;
  overflow: hidden;
}

/* effet décoratif léger */
body.login-page::before {
  content: "";
  position: absolute;
  width: 300px;
  height: 300px;
  background: rgba(255,255,255,0.05);
  top: -50px;
  left: -50px;
  transform: rotate(45deg);
}

/* ===== CENTRAGE ===== */
.login-box {
  position: absolute;
  top:35%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/* ===== CARTE ===== */
.login-box-body {
  background: #0f2a5c;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 15px 40px rgba(0,0,0,0.4);
  text-align: center;
}

/* ===== LOGO ===== */
.login-box-msg img {
  display: block;
  margin: 0 auto 15px;
  width: 120px;
}

/* ===== INPUT ===== */
.form-control {
  height: 50px;
  border-radius: 12px;
  border: none;
  background: #f8fafc;
  text-align: center;
  font-size: 18px;
  font-weight: bold;
  letter-spacing: 5px;
  box-shadow: inset 0 2px 6px rgba(0,0,0,0.2);
}

/* focus */
.form-control:focus {
  background: #fff;
  box-shadow: 0 0 8px rgba(255,255,255,0.3);
}

/* icône */
.form-control-feedback {
  color: #0f2a5c;
}

/* ===== BOUTON LOGIN (JAUNE) ===== */
.btn-primary {
  background: linear-gradient(135deg, #facc15, #f59e0b);
  border: none;
  border-radius: 30px;
  height: 50px;
  font-weight: 800;
  font-size: 16px;
  color: #1e293b;
  box-shadow: 0 8px 20px rgba(0,0,0,0.4);
  transition: all 0.3s ease;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.5);
}

/* ===== LOADER ===== */
#loader1 {
  border-radius: 25px;
}

/* ===== ERREUR ===== */
#alerte {
  margin-top: 15px;
  border-radius: 8px;
  background: #fecaca;
  color: #7f1d1d;
  border: none;
  text-align: center;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 480px) {
  .login-box {
    width: 90%;
  }
}
.login-box {
  transform: translate(-50%, -50%) scale(1.2);
}

.restaurant-title {
  color: #ffffff;
  font-size: 35px;
  font-weight: 900;
  letter-spacing: 3px;
  text-transform: uppercase;
  margin-bottom: 20px;
  text-shadow: 0 6px 20px rgba(0,0,0,0.6);
}

.user-icon {
  width: 140px;
  margin: 15px auto 25px;
  display: block;
  filter: drop-shadow(0 10px 20px rgba(0,0,0,0.4));
}
@media (max-width: 480px) {
  .login-box {
    transform: translate(-50%, -50%) scale(1);
  }
}
</style>
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
      <div class="restaurant-title">CARAVAC</div>
      <p class="login-box-msg">
         
          <img src="images/user.png" class="user-icon">
        
      </p>

    <form role="form" method="post" action="Authentification/verif.php" class="f">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="CODE" name="pseudo" id="pseudo" autofocus required>
       <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-3">
          <div id="loader" style="display: none"></div>
          </div>
        <!-- /.col -->
        <div class="col-xs-12">
            <button class="btn btn-danger hidden" id="loader1">
                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
            </button>
          <button type="submit" class="btn btn-primary btn-block"  name="btn_con" id="formulaire">
            LOGIN
          </button>

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
