<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ebutelo | wait activation</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <!--<link rel="shortcut icon" href="assets/ico/favicon.png">-->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top text-center">
                                <h3 class="text-center">Connexion à <span style="color: blue;">Ebutelo</span></h3>
                            </div>
                            <div class="form-bottom">
                                <p align="center" style="font-size: 32px;">
                                    <i class="fa fa-info-circle"></i> <b>Votre compte n'a pas encore été activé </b>
                                </p>
                                <br>
                                <p align="center">
                                    Un email contenant le lien d'activation de votre compte vous a 
                                    été envoyé à l'adresse email <b style="color: blue;"><?php echo $_SESSION['ebumail_to'];?></b> saisie lors de la création.
                                </p>
                                <p align="center">
                                    Si vous ne l'avez pas reçu dans votre boite de reception, 
                                    veuillez patienté au moins 15 minutes ou vérifier votre dossier 
                                    de courrier indésirable. Pour Gmail, 
                                    vérifiez l'onglet "Promotions"
                                </p>
                                
                            </div>
                            <div class="form-top1">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="social-login-buttons">
                                            <a class="btn btn-danger" id="renvoyermail" href="#">
                                                <i class="fa fa-paper-plane-o"></i> Renvoyer le mail
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="social-login-buttons ">
                                            <a class="btn btn-success" href="login.php">
                                                <i class="fa fa-sign-in"></i> Se connecter
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script type="text/javascript" src="souscription/souscription_js.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>