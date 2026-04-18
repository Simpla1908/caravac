<?php
session_start();
//include('bdd/connexion.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creative One Page Parallax Template">
        <meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" />
        <meta name="author" content="">
        <title>ebutelo</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/prettyPhoto.css" rel="stylesheet">
        <!--<link href="css/font-awesome.min.css" rel="stylesheet">-->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]> <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script> <![endif]-->
        <!--<link rel="shortcut icon" href="images/ico/favicon.png">-->
        <link rel="shortcut icon" href="img/Iconebutelo2.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->
    <body>
        <div class="preloader">
            <div class="preloder-wrap">
                <div class="preloder-inner">
                    <div class="ball"></div>
                    <div class="ball"></div>
                    <div class="ball"></div>
                    <div class="ball"></div>
                    <div class="ball"></div>
                    <div class="ball"></div>
                    <div class="ball"></div>
                </div>
            </div>
        </div><!--/.preloader-->
        <header id="navigation" class="section_page cachediv">
            <div class="navbar navbar-inverse navbar-fixed-top" role="banner">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><h1><img src="images/ebutelo_logo.png" alt="logo"></h1></a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right cachediv">
                            <li class="scroll active"><a href="#navigation">Accueil</a></li>
                            <!--<li class="scroll"><a href="#about-us">About Us</a></li>-->
                            <li class="scroll"><a href="#about-us">A propos</a></li>
                            <!--<li class="scroll"><a href="#our-team">Our Team</a></li>-->
                            <li class="scroll"><a href="#portfolio">Modules</a></li>
                            <!--<li class="scroll"><a href="#clients">Clients</a></li>-->
                            <li class="scroll"><a href="#clients">Tarification</a></li>
                            <li ><a href="login.php">Login</a></li>
                            <li class="scroll"><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div><!--/navbar-->
        </header> <!--/#navigation-->
        
        
        <!-- Top content -->
        <div class="top-content" style="display:none" id="compteform">

            <div class="inner-bg">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-3">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Créer votre compte</h3>
                                        <p>30 jours d'essai gratuit</p>
                                    </div>
                                    <div class="form-top-right">
                                        <a class="navbar-brand" href="index.php"><h1><img src="images/ebutelo_logo.png" alt="logo"></h1></a>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form name="contact-form" id="contact-form" role="form" action="souscription/souscription_traitement.php" method="post" class="registration-form">
                                        <input type="hidden" name="pack_id" id="pack_id" value="0">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-first-name">Nom</label>
                                            <input type="text" name="nom" placeholder="Nom..." class="form-first-name form-control" id="nom">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Prenom</label>
                                            <input type="text" name="prenom" placeholder="Prenom..." class="form-last-name form-control" id="prenom">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Téléphone</label>
                                            <input type="text" name="tel" placeholder="Téléphone..." class="form-last-name form-control" id="tel">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Email</label>
                                            <input type="text" name="email" placeholder="Email..." class="form-email form-control" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Login</label>
                                            <input type="text" name="login" placeholder="Login..." class="form-last-name form-control" id="login">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Mot de passe</label>
                                            <input type="password" name="mdp" placeholder="Mot de passe..." class="form-last-name form-control" id="mdp">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Entreprise / Sotièté</label>
                                            <input type="text" name="compagnie" placeholder="Entreprise / Sotièté..." class="form-last-name form-control" id="compagnie">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                              <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="tc"> J'ai lu et j'accepte les <a href="termes.php" target="_blank">termes et conditions</a>
                                                </label>
                                              </div>
                                            </div>
                                          </div>
                                        <button type="submit" id="enregistrer_souscription" class="btn">Valider </button>
                                         <span class="btn btn-danger hidden" id="loader1">
                                            <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours
                                        </span>
                                    </form>
                                </div>
                            </div>
                              <div class="status alert alert-danger col-md-12" id='msg' style="display:none">
                                <i class="fa fa-info-circle"></i> Veuillez remplir ces champs vides
                            </div>
                        </div>
                        <!--<div class="col-sm-1"></div>-->

                        
                    </div>

                </div>
            </div>

        </div>
        
        
        
        
        <div class="section_page cachediv">

            <section id="home">
                <div class="home-pattern"></div>
                <div id="main-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#main-carousel" data-slide-to="1"></li>
                        <!-- <li data-target="#main-carousel" data-slide-to="2"></li>
                        <li data-target="#main-carousel" data-slide-to="3"></li>-->
                        <!--                        <li data-target="#main-carousel" data-slide-to="3"></li>-->
                    </ol><!--/.carousel-indicators-->
                    <div class="carousel-inner">
                        <!-- <div class="item active" style="background-image: url(images/slider/slide1.jpg)">
                            <div class="carousel-caption">
                                <div>
                                    <h2 class="heading animated bounceInDown" style="color:#ffffff">Un atout pour la progression <br> de vos activités</h2>
                                    <p class="animated bounceInUp" style="color:#ffffff">Décuplez vos activités avec notre logiciel&nbsp;</p>
                                    <!--<a class="btn btn-default slider-btn animated fadeIn" href="#clients">Essai gratuit</a>
                                </div>
                            </div>
                        </div>-->
                        <div class="item active" style="background-image: url(images/slider/slide2.jpg)">
                            <div class="carousel-caption"> <div>
                                    <h2 class="heading animated bounceInDown" style="color:#ffffff">Un logiciel à l'echelle de vos besoins</h2>
                                    <p class="animated bounceInUp" style="color:#ffffff">Simple, intuitif et facile à utiliser </p> 
                                    <!--<a class="btn btn-default slider-btn animated fadeIn" href="#clients">Essai gratuit</a>-->
                                </div>
                            </div>
                        </div>
                        <div class="item img-responsive" style="background-image: url(images/slider/slide4.jpg)">
                            <div class="carousel-caption" style="margin-left: 250px;">
                                <div>
                                    <h2 class="heading animated bounceInDown" style="color:#ffffff">La gestion au bout <br> des doigts</h2>
                                    <p class="animated bounceInUp" style="color:#ffffff">&nbsp;</p>
                                    <!--<a class="btn btn-default slider-btn animated fadeIn" href="#clients">Essai gratuit</a>-->
                                </div>
                            </div>
                        </div>
                        <!--<div class="item" style="background-image: url(images/slider/slide3.jpg)">
                            <div class="carousel-caption">
                                <div>
                                    <h2 class="heading animated bounceInRight" style="color:#ffffff">Au bureau ou ailleurs</h2>
                                    <p class="animated bounceInLeft" style="color:#ffffff">Sur ordinateur, tablette, ou smartphone.<br> Vos données sont accessibles à tout temps<br></p>
                                    <!--<a class="btn btn-default slider-btn animated fadeIn" href="#clients">Essai gratuit</a>
                                </div>
                            </div>
                        </div>-->
                    </div><!--/.carousel-inner-->

                    <a class="carousel-left member-carousel-control hidden-xs" href="#main-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="carousel-right member-carousel-control hidden-xs" href="#main-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
                </div>

            </section><!--/#home-->


            <section id="about-us" class="parallax-section">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-sm-8 col-sm-offset-2">
                            <h2 class="title-one">A propos d'ebutelo</h2>
                            <p>
                                <b>Ebutelo</b> signifie <i>échelle</i> en français.<br><br>
                                Un logiciel <b>ERP</b> de gestion pour différents type d'entreprise: les hôtels, les restaurants et aussi le commerce de détail. 
                                Ce logiciel est reparti en plusieurs modules; accessibles en ligne ou en local.<br><br>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 style="color: black;"></h3>
                            <div>
                                <div class="media">
                                    <img class="pull-left media-object" src="images/about-us/about.jpg" width="370" height="280" alt="about us">
                                    <div class="media-body" style="text-align: justify;">
                                        <p>
                                            Notre logiciel répond à tous vos soucis en vous donnant les outils nécessaires dont vous avez besoin pour l'exécution des diverses opérations.<br><br>
                                            Conçu sur base des réalités aux quelles les firmes font face quotidiennement, les fonctionnalités d'<b>Ebutelo</b> répondent à tout besoin spécifique pour un établissement simple ou multi-sites.<br><br>
                                            Le contrôle étant rassuré, <b>Ebutelo</b> vous permet de décider quelle information vous désirez mettre à la portée des travailleurs grâce à son système de droit d'accès qui vous permet d'avoir le contrôle sur toutes les activités.<br><br>
                                            L'objectif d'<b>Ebutelo</b> est d'optimiser votre lot de travail afin que vous puissiez vous concentrer sur l'essentiel.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/#service-->

            <section id="portfolio">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-sm-8 col-sm-offset-2">
                            <h2 class="title-one">Modules</h2>
                            <p>Décuplez vos activités avec nos modules en ligne.</p>
                        </div>
                    </div>
                    <!-- Start Pricing Page -->
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="feature-2">
                                <i class="fa fa-stack-overflow"></i>    
                                <h4>Comptabilité</h4>
                                <p>
                                    Votre comptabilité en ligne pour toutes vos activités... <br><br>
                                    <a href="#">Détails</a>
                                </p>       
                                <a href="#" id="1" class="btn1 btn-lg btn-main btnesgrat">Essai Gratuit</a>
                            </div>
                        </div><!-- /.col-md-3 -->

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="feature-2">
                                <i class="fa fa-home"></i>    
                                <h4>Hebergement</h4>
                                <p>
                                    Gérer votre Guesthouse, Hôtel, auberge ou maison de vacances partout avec aisance... 
                                    <a href="#">Détails</a>
                                </p>       
                                <a href="#" id="4" class="btn1 btn-lg btn-main btnesgrat">Essai Gratuit</a>
                            </div>
                        </div><!-- /.col-md-3 -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="feature-2">
                                <i class="fa fa-user"></i>    
                                <h4>Ress. Humaines</h4>
                                <p>
                                    Du recrutement jusqu'au congé,gerer tout le processus de la gestion du personnel en ligne... 
                                    <a href="#">Détails</a>
                                </p>       
                                <a href="#" id="7" class="btn1 btn-lg btn-main btnesgrat">Essai Gratuit</a>
                            </div>
                        </div><!-- /.col-md-3 -->

                         <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="feature-2">
                                <i class="fa fa-database"></i>   
                                <h4>Stock</h4>
                                <p>
                                    La gestion de votre stock en un clic. <br>De l'approvisionnement à l'inventaire!... 
                                    <a href="#">Détails</a>
                                </p>       
                                <a href="#" id="2" class="btn1 btn-lg btn-main btnesgrat">Essai Gratuit</a>
                            </div>
                        </div><!-- /.col-md-3 -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="feature-2">
                                <i class="fa fa-hospital-o"></i>    
                                <h4>EBU - Hôtel</h4>
                                <p>
                                    Tout en un! Gerer votre établissement hotellière <br>en un clic... <br><br>
                                    <a href="#">Détails</a>
                                </p>       
                                <a href="#" id="6" class="btn1 btn-lg btn-main btnesgrat">Essai Gratuit</a>
                            </div>
                        </div><!-- /.col-md-3 -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="feature-2">
                                <i class="fa fa-cutlery"></i>    
                                <h4>EBU - Restaurant</h4>
                                <p>
                                    Un ERP idéal pour la gestion de votre restaurant. De l'achat à la vente... <br><br>
                                    <a href="#">Détails</a>
                                </p>       
                                <a href="#" id="5" class="btn1 btn-lg btn-main btnesgrat">Essai Gratuit</a>
                            </div>
                        </div><!-- /.col-md-3 -->

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="feature-2">
                                <i class="fa fa-clipboard"></i>    
                                <h4>EBU - Pos</h4>
                                <p>
                                    Pharmacie, Boutique ou Alimentation, gerer facilement vos achats, ventes et crédit accorder au client au bout des doigts... 
                                    <a href="#">Détails</a>
                                </p>       
                                <a href="#" id="30" class="btn1 btn-lg btn-main btnesgrat">Essai Gratuit</a>
                            </div>
                        </div><!-- /.col-md-3 -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="feature-2">
                                <i class="fa fa-file-text-o"></i>    
                                <h4>EBU - Facturation</h4>
                                <p>
                                    L'envoi de vos proforma et factures ainsi que les paiements en quelques clis par telephone ou ordinateur... 
                                    <a href="#">Détails</a>
                                </p>       
                                <a href="#" id="29" class="btn1 btn-lg btn-main btnesgrat">Essai Gratuit</a>
                            </div>
                        </div><!-- /.col-md-3 -->
                        
                    </div><!-- /.row -->
                    <!-- End Pricing Page -->
<!--                    <div class="row">
                        <div class="col-md-12">
                            <a href="#clients" class="btn-system btn-small commande">
                                <img class="img-responsive" src="images/banniere.jpg" alt="about us">
                            </a>
                        </div>
                    </div>-->
                </div>

            </section> <!--/#portfolio-->
            
            <section id="clients" class="parallax-section">
            <div class="container section_page">
                <div class="row text-center clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="contact-heading">
                            <h2 class="title-one">Tarification</h2>
                            <p>Essai gratuit 30 Jours. Pas de frais d'installation.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="contact-details">
                    <div class="pattern"></div>
                    <!-- Start Pricing Page -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pricing-section-2">
                                <br>
                                <div class="row">
                                    <div class="pricing">

                                        <div class="col-md-3 col-sm-6">
                                            <div class="pricing-table-2">
                                                <div class="plan-name">
                                                    <h3>Comptabilité</h3>
                                                </div>
                                                <div class="plan-price">
                                                    <div class="price-value">25$</div>
                                                    <div class="interval">par mois</div>
                                                </div>
                                                <div class="plan-list">
                                                    <ul>
                                                        <li>15 Utilisateurs</li>
                                                        <li>Formation</li>
                                                        <li>3 Sociètés Max</li>
                                                    </ul>
                                                </div>
                                                <div class="plan-signup">
                                                    <a href="#" id="1" class="btn-system btn-small btnesgrat">Souscrivez</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="pricing-table-2">
                                                <div class="plan-name">
                                                    <h3>Hebergement</h3>
                                                </div>
                                                <div class="plan-price">
                                                    <div class="price-value">45$</div>
                                                    <div class="interval">par mois</div>
                                                </div>
                                                <div class="plan-list">
                                                    <ul>
                                                        <li>15 Utilisateurs</li>
                                                        <li>Formation</li>
                                                        <li></li>
														<li></li>
                                                    </ul>
                                                </div>
                                                <div class="plan-signup">
                                                    <a href="#" id="4" class="btn-system btn-small btnesgrat">Souscrivez</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="pricing-table-2">
                                                <div class="plan-name">
                                                    <h3>Ress. Humaines</h3>
                                                </div>
                                                <div class="plan-price">
                                                    <div class="price-value">3$<span> <= 499 </span></div>
                                                    <div class="interval">par Employé / mois</div>
                                                </div>
												<div class="plan-price">
                                                    <div class="price-value">2$ <span> >= 500 </span></div>
                                                    <div class="interval">par Employé / mois</div>
                                                </div>
                                                <div class="plan-list">
                                                    <ul>
                                                        <li>15 Utilisateurs</li>
                                                        <li>Formation</li>
                                                    </ul>
                                                </div>
                                                <div class="plan-signup">
                                                    <a href="#" id="7" class="btn-system btn-small btnesgrat">Souscrivez</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="pricing-table-2">
                                                <div class="plan-name">
                                                    <h3>Stock</h3>
                                                </div>
                                                <div class="plan-price">
                                                    <div class="price-value">9$</div>
                                                    <div class="interval">par mois</div>
                                                </div>
                                                <div class="plan-list">
                                                    <ul>
                                                        <li>15 Utilisateurs</li>
                                                        <li>Formation</li>
                                                        <li></li>
														<li></li>
                                                    </ul>
                                                </div>
                                                <div class="plan-signup">
                                                    <a href="#"  id="2" class="btn-system btn-small btnesgrat">Souscrivez</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    
                                </div>
                                <div class="row">
                                    <br><br>
                                        <div class="pricing">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="pricing-table-2">
                                                <div class="plan-name">
                                                    <h3>EBU - Hôtel</h3>
                                                </div>
                                                <div class="plan-price">
                                                    <div class="price-value">75$</div>
                                                    <div class="interval">par mois </div>
                                                </div>
                                                <div class="plan-list">
                                                    <ul>
                                                        <li>15 Utilisateurs</li>
                                                        <li>Formation</li>
                                                        <li>Hebergement</li>
                                                        <li>Restaurant inclus</li>
                                                        <li>Achat & Stock inclus</li>
                                                    </ul>
                                                </div>
                                                <div class="plan-signup">
                                                    <a href="#" id="6" class="btn-system btn-small btnesgrat">Souscrivez</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="pricing-table-2">
                                                <div class="plan-name">
                                                    <h3>EBU - Restaurant</h3>
                                                </div>
                                                <div class="plan-price">
                                                    <div class="price-value">33$</div>
                                                    <div class="interval">par mois </div>
                                                </div>
                                                <div class="plan-list">
                                                    <ul>
                                                        <li>15 Utilisateurs</li>
                                                        <li>Formation</li>
                                                        <li>Restaurant</li>
                                                        <li>Achat & Stock inclus</li>
														<li>Nbre caisse illimité</li>
                                                    </ul>
                                                </div>
                                                <div class="plan-signup">
                                                    <a href="#" id="5" class="btn-system btn-small btnesgrat">Souscrivez</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="pricing-table-2">
                                                <div class="plan-name">
                                                    <h3>EBU - Pos</h3>
                                                </div>
                                                <div class="plan-price">
                                                    <div class="price-value">15$</div>
                                                    <div class="interval">par mois </div>
                                                </div>
                                                <div class="plan-list">
                                                    <ul>
                                                        <li>15 Utilisateurs</li>
                                                        <li>Formation</li>
                                                        <li>POS</li>
                                                        <li>Achat & Stock inclus</li>
														<li>Nbre caisse illimité</li>
                                                    </ul>
                                                </div>
                                                <div class="plan-signup">
                                                    <a href="#" id="30" class="btn-system btn-small btnesgrat">Souscrivez</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="pricing-table-2">
                                                <div class="plan-name">
                                                    <h3>EBU - Facturation</h3>
                                                </div>
                                                <div class="plan-price">
                                                    <div class="price-value">12$</div>
                                                    <div class="interval">par mois</div>
                                                </div>
                                                <div class="plan-list">
                                                    <ul>
                                                        <li>15 Utilisateurs</li>
                                                        <li>Formation</li>
                                                        <li>Achat inclus</li>
														<li>Stock inclus</li>
														<li></li>
														<li></li>
                                                    </ul>
                                                </div>
                                                <div class="plan-signup">
                                                    <a href="#" id="29" class="btn-system btn-small  btnesgrat">Souscrivez</a>
                                                </div>
                                            </div>
                                        </div>
                                        </div>    
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Pricing Page -->
                </div>
            </div>
        </section> <!--/#contact-->
        </div>
        

        <div class="section_page ">

            <div class="section_page cachediv">

                <section id="contact">
                    <div class="container">
                        <div class="row text-center clearfix">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="contact-heading">
                                    <h2 class="title-one">contactez-nous</h2>
                                    <p style="font-weight:300; font-size:17px">
                                        Notre service client est disponible du lundi au samedi de 8h30 à 17h30
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="contact-details">
                            <div class="pattern"></div>
                            <div class="row text-center clearfix">
                                <!--<div class="col-sm-6">
                                    <div class="contact-address"><address><p>EBUTELO</p><strong>273 Nyangwe C/ Lingwala<br>Kinshasa - RDC<br> +243 85 464 66 79 <br> contact@etsb-k.com</strong><br><small>( Contactez-nous aussi par des réseaux sociaux )</small></address>
                                        <div class="social-icons">
                                            <a href="https://www.facebook.com/bkservi/" target="_blanck"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a><a href="#"><i class="fa fa-dribbble"></i></a>
                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="pricing-section-2">
                                        <div class="status alert alert-success" style="display: none"></div>
                                        <form id="contact-form2" class="contact" name="contact-form2" method="post" action="send-mail.php">
										<br>
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control name-field" required="required" placeholder="Nom"></div>
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control mail-field" required="required" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="phone" name="phone" class="form-control mail-field" required="required" placeholder="Téléphone">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Envoyer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> <!--/#contact-->
            </div>
            <footer id="footer">
                <div class="container">
                    <div class="text-center">
                        <p>Copyright &copy; 2016 - <a href="index.php">ebutelo.com</a> | All Rights Reserved</p>
                    </div>
                </div>
            </footer> <!--/#footer-->
        </div>        
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/smoothscroll.js"></script>
            <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
            <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
            <script type="text/javascript" src="js/jquery.parallax.js"></script>
            <script type="text/javascript" src="js/main.js"></script>
            <script type="text/javascript" src="souscription/souscription_js.js"></script>
    
       
        </body>
</html>
