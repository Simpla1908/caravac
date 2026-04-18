<?php
session_start();
include('bdd/connexion.php');
include('souscription/site_modules.php');
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/prettyPhoto.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]> <script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script> <![endif]-->
        <link rel="shortcut icon" href="images/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    </head>
    <!--/head-->

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
        </div>
        <!--/.preloader-->


        <section id="clients" class="parallax-section">
            <div class="col-sm-12 text-center">
                <a class="" href="index.php">
                    <h1><img src="images/ebutelo_logo.png" alt="logo"></h1>
                </a>
                <!--<br>--> 
                <h2 class="title-one2">App Store</h2>
            </div>
            <div class="container section_page">
                <div class="row text-center clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="contact-heading">
                            <a class="navbar-brand" href='REC/gg_consultation_hotel.php'><i class="fa fa-angle-double-left"></i> Retour</a>
                        </div>
                        <div class="status alert alert-info" style="display: block">
                            <h5 class="title-one3">
                            <i class="fa fa-info-circle"></i>
                            <?php
                            $nbre_mod = count($IDMODULES['module']['id']);
                            if ($nbre_mod == 4) {
                                echo "Aucun module n'est disponible";
                            } else if ($nbre_mod < 4) {
                                echo "Applications disponibles!";
                            }
                            ?>
                            </h5>
                        </div>
                        <br>
                        <div class="status alert alert-success" id='msg' style="display:none"><i class="fa fa-info-circle"></i> Enregistrement effectué avec succes</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="contact-details">
                    <div class="pattern"></div>
                    <div class="row text-center clearfix">
                        <div id="form_souscri">
                            <form id="contact-form" class="contact" name="contact-form" method="post" action="souscription/souscription_traitement_apstor.php">
                                <div class="col-sm-12">

                                    <div id="contact-form-section">
                                        <!--<h4>Souscription Application</h4>-->
                                        <div class="status alert alert-success" style="display: none"></div>
                                        <div class="table-responsive">
                                            <?php
                                            $nbre_mod=count($IDMODULES['module']['id']);
                                            if($nbre_mod==4){
//                                                echo "Appstore vide";
                                            } else if($nbre_mod < 4){
                                              ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Applications</th>
                                                        <th>Nombre Utilisateur</th>
                                                        <th>Souscription</th>
                                                        <th>Tarif</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $module =21;
                                                    $requete = $bdd->prepare("SELECT prix_user FROM  prix WHERE module_id=:module AND souscription=:souscription");
                                                    $souscription ='mensuel';
                                                    if(!in_array($module,$IDMODULES['module']['id'])){
                                                        $requete->BindParam(':module',$module);
                                                        $requete->BindParam(':souscription',$souscription);
                                                        $requete->execute();
                                                        $prix= $requete->fetchAll(PDO::FETCH_OBJ);
                                                        foreach ($prix as $prix) $prix = $prix->prix_user;

                                                    ?>
                                                        <tr>
                                                            <td align="left">
                                                                <h4><input name="modules_nom21" type="hidden" value="caisse">
                                                                    <input id="cb_caisse" name="modules[]" type="checkbox" class="flat elmt_checked" value="21"> Caisse</h4>
                                                            </td>
                                                            <td width="50">
                                                                <input id="txt_caisse" name="users21" type="number" value="3" class="form-control input_txt" min="3">
                                                            </td>
                                                            <td>
                                                                <select id="slt_caisse" name="licence21" class="form-control">
                                                                <option value="mensuel">Mensuel</option>
                                                                <option value="annuel">Annuel</option>
                                                            </select>
                                                            </td>
                                                            <td align="left">

                                                                <label><div id='lbl_caisse'>$<?php echo $prix;?></div></label>
                                                                <input id="prix_caisse" name="prix21" type="hidden" value="0">

                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    $module =24;
                                                    if(!in_array($module,$IDMODULES['module']['id'])){
                                                    $requete->BindParam(':module',$module);
                                                    $requete->BindParam(':souscription',$souscription);
                                                    $requete->execute();
                                                    $prix= $requete->fetchAll(PDO::FETCH_OBJ);
                                                    foreach ($prix as $prix) $prix = $prix->prix_user;
                                                    ?>
                                                            <tr>
                                                                <td align="left">
                                                                    <h4><input name="modules_nom24" type="hidden" value="stock">
                                                                        <input id="cb_stock" name="modules[]" type="checkbox" class="flat elmt_checked" value="24"> Stock </h4>

                                                                </td>
                                                                <td width="50">
                                                                    <input id="txt_stock" name="users24" type="number" value="3" class="form-control input_txt" min="3">
                                                                </td>
                                                                <td>
                                                                    <select id="slt_stock" name="licence24" class="form-control">
                                                                <option value="mensuel">Mensuel</option>
                                                                <option value="annuel">Annuel</option>
                                                            </select>
                                                                </td>
                                                                <td align="left"><label><div id='lbl_stock'>$<?php echo $prix;?></div></label>
                                                                    <input id="prix_stock" name="prix24" type="hidden" value="0">

                                                                </td>
                                                            </tr>
                                                            <?php }
                                                    $module =22;
                                                    if(!in_array($module,$IDMODULES['module']['id'])){
                                                    $requete->BindParam(':module',$module);
                                                    $requete->BindParam(':souscription',$souscription);
                                                    $requete->execute();
                                                    $prix= $requete->fetchAll(PDO::FETCH_OBJ);
                                                    foreach ($prix as $prix) $prix = $prix->prix_user;
                                                    ?>
                                                            <tr>
                                                                <td align="left">
                                                                    <h4><input name="modules_nom22" type="hidden" value="restaurant">
                                                                        <input id="cb_restaurant" name="modules[]" type="checkbox" class="flat elmt_checked" value="22"> Restaurant</h4>
                                                                </td>
                                                                <td width="50">
                                                                    <input id="txt_restaurant" name="users22" type="number" value="3" class="form-control input_txt" min="3">
                                                                </td>
                                                                <td>
                                                                    <select id="slt_restaurant" name="licence22" class="form-control">
                                                                <option value="mensuel">Mensuel</option>
                                                                <option value="annuel">Annuel</option>
                                                            </select>
                                                                </td>
                                                                <td align="left"><label><div id='lbl_restaurant'>$<?php echo $prix;?></div></label>
                                                                    <input id="prix_restaurant" name="prix22" type="hidden" value="0">
                                                                </td>
                                                            </tr>
                                                            <?php
                                                    }
                                                    $module =23;
                                                    if(!in_array($module,$IDMODULES['module']['id'])){
                                                    $requete->BindParam(':module',$module);
                                                    $requete->BindParam(':souscription',$souscription);
                                                    $requete->execute();
                                                    $prix= $requete->fetchAll(PDO::FETCH_OBJ);
                                                    foreach ($prix as $prix) $prix = $prix->prix_user;
                                                    ?>
                                                                <tr>
                                                                    <td align="left">
                                                                        <h4><input name="modules_nom23" type="hidden" value="hebergement">
                                                                            <input id="cb_hebergement" name="modules[]" type="checkbox" class="flat elmt_checked" value="23"> Hébergement</h4>
                                                                    </td>
                                                                    <td width="50">
                                                                        <input id="txt_hebergement" name="users23" type="number" value="3" class="form-control input_txt" min="3">
                                                                    </td>
                                                                    <td>
                                                                        <select id="slt_hebergement" name="licence23" class="form-control">
                                                                <option value="mensuel">Mensuel</option>
                                                                <option value="annuel">Annuel</option>
                                                            </select>
                                                                    </td>
                                                                    <td align="left"><label><div id='lbl_hebergement'>$<?php echo $prix;?></div></label>
                                                                        <input id="prix_hebergement" name="prix23" type="hidden" value="0">
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3">Total à payer</th>
                                                        <th colspan="1" align="left" id='tot_souscri'>$0.00</th>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div id="contact-form-section1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" id="enregistrer_souscription">Valider et Payer</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                        <div id='resume_souscri' style="display:none">
                            <div class="col-sm-12">
                                <div id="contact-form-section2">
                                    <h4 class="">Résumé de votre commande</h4><br>
                                    <div class="status alert alert-success" style="display: none"></div>
                                    <div class="table-responsive" id="resume_tbl">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Applications</th>
                                                    <th>Nombre utilisateur</th>
                                                    <th>Souscription</th>
                                                    <th>Tarif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td align="left">
                                                        <samp>Caisse</samp>
                                                    </td>
                                                    <td align="left">
                                                        <samp>3</samp>
                                                    </td>
                                                    <td align="left">
                                                        <samp>Mensuel</samp>
                                                    </td>
                                                    <td align="left"><samp>$100.00</samp></td>
                                                </tr>
                                                <tr>
                                                    <td align="left">
                                                        <samp>Stock</samp>
                                                    </td>
                                                    <td align="left">
                                                        <samp>3</samp>
                                                    </td>
                                                    <td align="left">
                                                        <samp>Mensuel</samp>
                                                    </td>
                                                    <td align="left"><samp>$100.00</samp></td>
                                                </tr>
                                                <tr>
                                                    <td align="left">
                                                        <samp>Restaurant</samp>
                                                    </td>
                                                    <td align="left">
                                                        <samp>3</samp>
                                                    </td>
                                                    <td align="left">
                                                        <samp>Mensuel</samp>
                                                    </td>
                                                    <td align="left"><samp>$100.00</samp></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3">Total</th>
                                                    <th colspan="1" align="center">$446.00</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            <div class="row text-center clearfix">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <br>
                                    <div class="status alert alert-success" style="display: block"><i class="fa fa-info-circle"></i> Selectionner le mode de paiement de votre souscription!</div>
                                </div>
                            </div>
                            <form id="contact-form" class="contact" name="contact-form" method="post" action="souscription/valider_souscription_apstor.php">
                                <div class="col-sm-6">
                                    <div id="contact-form-section2">
                                        <h2><input id="mode_banque" name="mode_paie" type="radio" class="flat mode_paie" value="banque">&nbsp;&nbsp;&nbsp; paiement banquaire</h2>
                                        <div class="blog-content">
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                        </div>
                                        <ul class="post-meta">
                                            <li><strong> Nom de la banque:</strong> TMB</li>
                                            <li><strong> Numéro du compte:</strong> 1452689-56 USD</li>
                                            <li><strong> Nom de l'entreprise:</strong> BK SERVICES</li>
                                            <li><strong> Numéro:</strong> 1452689-56 USD</li>
                                            <li><strong> Swif:</strong> 243</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="contact-form-section2">
                                        <h2><input id="mode_cash" name="mode_paie" type="radio" class="flat mode_paie" value="cash" checked="checked">&nbsp;&nbsp;&nbsp; paiement sur place</h2>
                                        <div class="blog-content">
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                        </div>
                                        <ul class="post-meta">
                                            <li><strong> Nom de la banque:</strong> TMB</li>
                                            <li><strong> Numéro du compte:</strong> 1452689-56 USD</li>
                                            <li><strong> Nom de l'entreprise:</strong> BK SERVICES</li>
                                            <li><strong> Numéro:</strong> 1452689-56 USD</li>
                                            <li><strong> Swif:</strong> 243</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="contact-form-section1">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" id="annuler_souscription">Annuler</button>
                                            <button type="submit" class="btn btn-primary" id="valider_souscription">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="row text-center clearfix">
                            <div class="col-sm-8 col-sm-offset-2">
                                <br>
                                <div class="status alert alert-success mail_activ" style="display:none">
                                    <i class="fa fa-info-circle"></i> <b>Accès à votre solution :</b><br>Un email contenant le lien d'activation vous sera envoyé à votre adresse email dans un délai maximum d’une journée.<br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/#contact-->
        <div class="container mail_activ" style="display:none">
            <div class="text-center">
                <p>Cliquer <a href="REC/gg_maj_hotel.php?id_hotel=<?php echo $_SESSION['id_hotel'];?>">ici</a> pour continuer.</p>
            </div>
        </div>
<!--        <footer id="footer">
            <div class="container">
                <div class="text-center">
                    <p>Copyright &copy; 2016- <a href="#">NTC</a> | All Rights Reserved</p>
                </div>
            </div>
        </footer>-->
        <!--/#footer-->

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/smoothscroll.js"></script>
        <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
        <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="js/jquery.parallax.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="souscription/souscription_js_apstor.js"></script>
    </body>

    </html>
