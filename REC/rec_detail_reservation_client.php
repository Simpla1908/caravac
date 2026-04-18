<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
?>
<?php include('./headerRec_popup.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; ?>
<?php
include('../FUNCTION/checkdates.php');

function NbJours($date_a, $date_s)
{

    $tDeb = explode("-", $date_a);
    $tFin = explode("-", $date_s);

    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);

    return (($diff / 86400) + 1);
}

//Fusion horaire
date_default_timezone_set('Europe/Paris');

if (isset($_GET['num_reserv'])) {
    $num_reserv = $_GET['num_reserv'];
    $page = 'reservation';
} else {
    header("Location:rec_liste_reservation.php");
}
?>

<?php
$requete_paie = $bdd->prepare("SELECT c.num_fact,c.id_fact FROM t_reservation AS b, t_facture AS c
				WHERE b.id_res=c.id_res
				AND b.num_reserv=:num_reserv");
$requete_paie->BindParam(':num_reserv', $num_reserv);
$requete_paie->execute();
while ($donnees = $requete_paie->fetch()) {
    $num_fact = $donnees['num_fact'];
    $id_fact = $donnees['id_fact'];
}
?>


<?php
/* Recuperation de la réservation d'un client */
$requete_res = $bdd->prepare("SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv,b.type, b.date_res, b.date_occ, b.date_lib, b.statut_res,b.dte_a,b.dte_s FROM t_client AS a, t_reservation AS b
			WHERE a.id_client=b.id_client
			AND b.num_reserv=:num_reserv
			AND b.id_hotel=:id_hotel");
$requete_res->BindParam(':num_reserv', $num_reserv);
$requete_res->BindParam(':id_hotel', $id_hotel);
$requete_res->execute();
while ($donnees = $requete_res->fetch()) {
    $id_client = $donnees['id_client'];
    $_SESSION['id_client'] = $id_client;

    $nom_client = $donnees['nom_client'];
    $_SESSION['nom_client'] = $nom_client;

    $id_res = $donnees['id_res'];
    $_SESSION['id_res'] = $id_res;

    $num_reserv = $donnees['num_reserv'];
    $_SESSION['num_reserv'] = $num_reserv;

    $date_res = $donnees['date_res'];
    $_SESSION['date_res'] = $date_res;

    $date_occ = $donnees['date_occ'];
    $_SESSION['date_occ'] = $date_occ;

    $date_lib = $donnees['date_lib'];
    $_SESSION['date_lib'] = $date_lib;

    $statut_res = $donnees['statut_res'];
    $_SESSION['statut_res'] = $statut_res;

    $type = $donnees['type'];
    $_SESSION['type'] = $type;

    $dte_a = $donnees['dte_a'];
    $_SESSION['dte_a'] = $dte_a;

    $dte_s = $donnees['dte_s'];
    $_SESSION['dte_s'] = $dte_s;
    //$statut = $donnees['statut'];


    $Nombres_jours = NbJours($dte_a, $dte_s);
    $nb_jrs = $Nombres_jours;
    $nb_jr = $nb_jrs - 1;
    if ($nb_jr == 0) {
        $nb_jr++;
    }

    $nbre_jr = $nb_jr;
    $_SESSION['nbre_jr'] = $nbre_jr;


    //Changement du format des dates

    $date_res1 = explode('-', $date_res);
    $date_res1_Heure = explode(' ', $date_res1[2]);

    $date_res_expl = $date_res1_Heure[0] . '/' . $date_res1[1] . '/' . $date_res1[0] . ' ' . $date_res1_Heure[1];

    //Date de reservation pour la comparaison avec la date du jour
    $date_res_comp = explode(' ', $date_res);
    $date_res_comp1 = $date_res_comp[0];
    //Fin

    $date_occ1 = explode('-', $date_occ);
    $date_occ1_Heure = explode(' ', $date_occ1[2]);

    $date_occ_expl = $date_occ1_Heure[0] . '/' . $date_occ1[1] . '/' . $date_occ1[0] . ' ' . $date_occ1_Heure[1];

    $date_lib1 = explode('-', $date_lib);
    $date_lib1_Heure = explode(' ', $date_lib1[2]);

    $date_lib_expl = $date_lib1_Heure[0] . '/' . $date_lib1[1] . '/' . $date_lib1[0] . ' ' . $date_lib1_Heure[1];


    /* $date_annule_res1=explode('-',$date_annule_res);
      $date_annule_res1_Heure=explode(' ',$date_annule_res1[2]);

      $date_annule_res_expl=$date_annule_res1_Heure[0].'/'.$date_annule_res1[1].'/'.$date_annule_res1[0].' '.'à'.' '.$date_annule_res1_Heure[1]; */
}
?>

<div id="page-wrapper" style=" height:auto;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                <div>
                    Réservation
                    <a class="pull-right btn btn-warning btn-xs" href="rec_liste_reservation.php"
                       title="Voir la liste des réservations">
                        <i class="fa fa-reply-all "></i> Retour
                    </a>
                </div>
                <div style="margin-top:30px;">
                    <?php if ($statut_res == 'operationnel') { ?>
                        <?php if ((date('Y-m-d') == $date_res_comp1) && (in_array('MR', $_SESSION['actions']['code_actions']))) { ?>
                            <form method="post" action="rec_modification_reservation_client.php">

                                <input name="id_res" id="id_res" type="hidden" value="<?php echo $id_res; ?>"/>
                                <input name="num_reserv" type="hidden" value="<?php echo $num_reserv; ?>"/>
                                <input name="date_res" type="hidden" value="<?php echo $date_res; ?>"/>
                                <input name="date_occ" type="hidden" value="<?php echo $date_occ; ?>"/>
                                <input name="date_lib" type="hidden" value="<?php echo $date_lib; ?>"/>
                                <input name="id_client" type="hidden" value="<?php echo $id_client; ?>"/>
                                <input name="nom_client" type="hidden" value="<?php echo $nom_client; ?>"/>

                                <!--                                <button type="submit" class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                                                    <img src="../img/edit.png">&nbsp;Modifier
                                                                </button>-->
                            </form>


                        <?php } else if ((date('Y-m-d') != $date_res_comp1) && (in_array('MR', $_SESSION['actions']['code_actions']))) { ?>
                            <form method="post" action="">
                                <!--                                <button type="submit" class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                                                    <img src="../img/edit.png">&nbsp;Modifier
                                                                </button>-->
                            </form>
                        <?php } else { ?>
                            <form method="post" action="">
                                <!--                                <button disabled class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                                                    <img src="../img/edit.png">&nbsp;Modifier
                                                                </button>-->
                            </form>
                        <?php } ?>

                        <div style="margin-top:-20px; margin-left:850px;">

                        </div>
                    <?php } else if ($statut_res == 'annulee') { ?>
                        <?php if ((date('Y-m-d') == $date_res_comp1) && (in_array('MR', $_SESSION['actions']['code_actions']))) { ?>
                            <form method="post" action="">
                                <!--                                <button type="submit" class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                                                    <img src="../img/edit.png">&nbsp;Modifier
                                                                </button>-->
                            </form>
                        <?php } else if ((date('Y-m-d') != $date_res_comp1) && (in_array('MR', $_SESSION['actions']['code_actions']))) { ?>
                            <form method="post" action="">
                                <!--                                <button type="submit" class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                                                    <img src="../img/edit.png">&nbsp;Modifier
                                                                </button>-->
                            </form>
                        <?php } else { ?>
                            <form method="post" action="">
                                <!--                                <button disabled class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                                                    <img src="../img/edit.png">&nbsp;Modifier
                                                                </button>-->
                            </form>
                        <?php } ?>

                    <?php } else { ?>
                        <form method="post" action="">
                            <!--                            <button disabled class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                                            <img src="../img/edit.png">&nbsp;Modifier
                                                        </button>-->
                        </form>

                    <?php } ?>
                </div>
            </h3>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>Detail de la réservation N° 
                        <span style="color:#4949fa; font-weight:bold;">
                            <?php
                            echo $num_reserv . ' ';
                            ?>
                        </span>
                        <?php
                        if (in_array('AR', $_SESSION['actions']['code_actions'])) {
                            $date_jr = date('Y-m-d');
                            //$date_occ=date('Y-m-d H:i:s');
                            if ($date_jr <= $dte_a && $statut_res == 'operationnel') {
                                ?>
                                <div class="pull-right" id="btn_annuler">
                                    <form method="post" action="Traitement_reservation/annulation_reservation.php">
                                        <input name="id_res" id="id_res" type="hidden" value="<?php echo $id_res; ?>"/>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target=".bs-example-modal-lg" style="border:1px solid #d1d1d1;">
                                            <img src="../img/drop.png">&nbsp;Annuler
                                        </button>
                                    </form>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <BR>
                    <form role="form" method="post" action="php/addpanier2.php">
                        <fieldset>
                            <table width="852" border="0" style="margin-left:20px;">
                                <tr>
                                    <td align="left"><label for="date"><b>Date&nbsp;</b></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $date_res_expl; ?> </td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="left"><label><strong>Client&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $nom_client; ?></td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="left"><label for="date"><strong>Date prévue
                                                d'arrivée&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $date_occ_expl; ?></td>
                                    <td width="50"></td>
                                    <td align="right"><label for="date"><strong>Date prévue de
                                                sortie&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $date_lib_expl; ?></td>
                                    <td width="30"></td>
                                    <td align="left"><font color="#FF0000"><strong>
                                                &nbsp;Soit <?php echo $_SESSION['nbre_jr']; ?> Jour(s)</strong></font>
                                    </td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                            </table>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel-body">
                                        <div class="panel-group" id="accordion">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseOne">Liste des chambres</a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse in">
                                                    <div class="panel-body">
                                                        <div id="panier">
                                                            <div class="table-responsive">
                                                                <table width="100"
                                                                       class="table table-striped table-bordered table-condensed"
                                                                       id="dataTables-example11">
                                                                    <thead>
                                                                    <tr>
                                                                        <th width="20">N°</th>
                                                                        <th width="30">Chambre N°</th>
                                                                        <th width="30">Tarif</th>
                                                                        <th width="30">Categorie</th>
                                                                        <th width="30">Niveau</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <?php
                                                                    $i = 1;
                                                                    //test du statut 
                                                                    if ($statut_res == 'annulee') {
                                                                        $statut = 'libre';
                                                                    } else {
                                                                        $statut = 'reserve';
                                                                    }

                                                                    /* Recuperation du paiement d'un client */
                                                                    $requete_reserv = $bdd->prepare("SELECT c.id_ch,c.capacite, c.num_ch,c.tarif_ch,c.monnaie, d.statut, e.lib_niv_cha, f.lib_cat_cha FROM categorie_chambre AS f, niveau_chambre AS e, t_reservation AS b, t_chambre AS c, t_reserve_chambre AS d "
                                                                        . "WHERE b.id_res=d.idreserv AND d.idchambre=c.id_ch AND f.id_cat_cha=c.categorie AND e.id_niv_cha=c.niveau AND b.num_reserv=:num_reserv  AND b.id_hotel=:id_hotel");
                                                                    $requete_reserv->BindParam(':num_reserv', $num_reserv);
                                                                    $requete_reserv->BindParam(':id_hotel', $id_hotel);
                                                                    $requete_reserv->execute();
                                                                    while ($donnees = $requete_reserv->fetch()) {
                                                                        $id_ch = $donnees['id_ch'];
                                                                        $num_ch = $donnees['num_ch'];
                                                                        $lib_niv_cha = $donnees['lib_niv_cha'];
                                                                        $lib_cat_cha = $donnees['lib_cat_cha'];
                                                                        $tarif_ch = $donnees['tarif_ch'];
                                                                        $statut = $donnees['statut'];
                                                                        $capacite = $donnees['capacite'];

                                                                        if ($donnees['monnaie'] == $m_affiche) {
                                                                            $tarif_ch = $tarif_ch;

                                                                        } else {
                                                                            if ($ch->monnaie = 'USD' && $m_affiche == 'CDF') {
                                                                                $tarif_ch = round($tarif_ch * $tauxdollar, 2);
                                                                            } else {
                                                                                $tarif_ch = round($tarif_ch * 1 / $tauxdollar, 2);

                                                                            }
                                                                        }

                                                                        $_SESSION['panier'][$id_ch] = 1;
                                                                        ?>

                                                                        <tr <?php
                                                                        if ($statut_res == 'annulee') {
                                                                            echo 'class="text-danger"';
                                                                        }
                                                                        ?> >
                                                                            <td><?php echo $i; ?></td>
                                                                            <td><?php echo 'Ch ' . $num_ch; ?></td>
                                                                            <td><?php echo $tarif_ch . ' ' . $m_affiche; ?></td>
                                                                            <td><?php echo $lib_cat_cha; ?></td>
                                                                            <td><?php echo $lib_niv_cha; ?></td>
                                                                        </tr>

                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                    ?>

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default hidden">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapseTwo">Paiement</a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <?php include('rec_detail_paiement _client_donnee.php'); ?>

                                                        <?php if (($statut_res == 'operationnel') && ($reste != 0)) { ?>
                                                            <div>
                                                                <a href="rec_paiement_additif_facture.php?num_fact=<?php echo $num_fact; ?>&nom_client=<?php echo $nom_client; ?>&type=<?php echo $type; ?>&id_fact=<?php echo $id_fact; ?>&reste=<?php echo $reste; ?>&montant_tot=<?php echo $montant_tot; ?>"
                                                                   class="btn btn-primary btn-xl">
                                                                    <i class="fa fa-money"></i> Payer
                                                                </a>
                                                            </div>

                                                        <?php } else { ?>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Collapsible Group Item #3</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                        </div>
                                                    </div>
                                                </div>-->
                                        </div>
                                    </div>
                                    <!-- .panel-body -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /.row -->
                </div>
            </div>

            <?php
            $date_res1 = explode('-', $date_res);
            $date_res1_Heure = explode(' ', $date_res1[2]);

            $date_res_expl_user = $date_res1_Heure[0] . '/' . $date_res1[1] . '/' . $date_res1[0] . ' ' . 'à' . ' ' . $date_res1_Heure[1];
            /* Recuperation du user qui a cree la réservation */
            $requete_use = $bdd->prepare("SELECT CONCAT(c.nom_user,' ', c.prenom_user) AS emploiye, d.libe_droit FROM t_reservation AS a, t_facture AS b, t_utilisateur AS c, t_droit AS d WHERE a.id_res=b.id_res AND b.id_user=c.id_user AND d.id_droit=c.id_droit AND a.num_reserv=:num_reserv");
            $requete_use->BindParam(':num_reserv', $num_reserv);
            $requete_use->execute();
            while ($donnees = $requete_use->fetch()) {
                $emploiye = $donnees['emploiye'];
                $libe_droit1 = $donnees['libe_droit'];
            }


            /* Recuperation du fonction du user */
            $requete_droit = $bdd->prepare("SELECT b.libe_droit FROM t_utilisateur AS a, t_droit AS b WHERE a.id_droit=b.id_droit AND a.id_user=:id_user");
            $requete_droit->BindParam(':id_user', $id_user);
            $requete_droit->execute();
            while ($donnees = $requete_droit->fetch()) {
                $libe_droit = $donnees['libe_droit'];
            }
            ?>

            <div class="panel panel-default" style="height:110px;">
                <div style="border-right:1px solid #e2e2e2; height:110px; width:500px;">
                    <div id="gauche" style="border:1px solid #fff; height:110px; width:495px;">
                        <div id="titre1" style="height:25px; padding-left:15px; width:500px;">
                            <h5><strong>Crée le <span style="color:#dd4f43;"><?php echo $date_res_expl_user; ?></span>
                                    par:</strong></h5>
                        </div>
                        <div id="contenu1" style="padding-left:15px; height:80px; width:500px;">
                            <div id="img1"><img src="../img/users.PNG"></div>
                            <div id="user1" style="width:170px; height:45px; margin-top:-45px; margin-left:50px;">
                                <?php echo strtoupper($emploiye); ?><br>
                                <span style="color:#4949fa;"><i><?php //echo $libe_droit1; ?></i></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->

</div>
<!-- /.row -->


</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- Modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Annuler la réservation </h4>
            </div>
            <form method="post" action="Traitement_reservation/annulation_reservation.php" name="entreprise-form"
                  id="entreprise-form" class="form-horizontal">
                <input name="id_res" id="id_res" type="hidden" value="<?php echo $id_res; ?>"/>
                <input name="id_regl" id="id_regl" type="hidden" value="<?php echo $id_regl; ?>"/>
                <div class="modal-body">
                    <div class="col-md-12 reglage">
                        <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                            <span id="msg_alert">Votre annulation est effectuée avec succes!</span>
                        </div>
                        <p class="font-gray-dark">
                            Date du jour: <span class="text-danger"><?php echo date('d/m/Y H:i:s'); ?></span> &nbsp;&nbsp;
                            Date de réservation: <span class="text-danger"><?php echo $date_res_expl; ?></span>
                        </p>
                    </div>
                    <?php
                    include './Traitement/calcul_montant_remboursse.php';
                    ?>
                    <input name="montant_pourcentage" id="montant_pourcentage" type="hidden"
                           value="<?php echo $montant_pourcentage; ?>"/>
                    <div class="col-md-12" id="div_personalise" style="padding-left: 50px;">
                        <br>
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <i class="fa fa-square blue"></i> Nombre d'heures
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group demo2">
                                    <?php
                                    if ($nbr_heures == 0) {
                                        ?>
                                        <input type="text" class="form-control col-md-9 col-xs-12"
                                               value="<?php echo $minite . ' Minite(s)'; ?>" id="nbr_heure"
                                               name="nbr_heure" disabled='disabled'/>
                                        <span class="input-group-addon"><?php echo 'Ou 1 jour'; ?></span>

                                    <?php } else {
                                        ?>
                                        <input type="text" class="form-control col-md-9 col-xs-12"
                                               value="<?php echo $nbr_heures . ' Heure(s)'; ?>" id="nbr_heure"
                                               name="nbr_heure" disabled='disabled'/>
                                        <span
                                            class="input-group-addon"><?php echo 'Ou ' . $nbre_jr . ' jour(s)'; ?></span>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <i class="fa fa-square blue"></i> Pourcentage à retirer
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12"
                                           value="<?php echo $poucentage; ?>" id="pour_48" name="pour_48"
                                           disabled='disabled'/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <i class="fa fa-square blue"></i> Montant payé
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12"
                                           value="<?php echo $som_mont_p; ?>" id="pour_72" name="pour_72"
                                           disabled='disabled'/>
                                    <span class="input-group-addon"><?php echo $m_affiche ?></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <i class="fa fa-square blue"></i> Montant à rembourser
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12"
                                           value="<?php echo $mont_remb; ?>" id="montant_rembourseUSD"
                                           name="montant_rembourseUSD"/>
                                    <span class="input-group-addon">USD</span>
                                </div>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" value="0"
                                           id="montant_rembourseCDF" name="montant_rembourseCDF"/>
                                    <span class="input-group-addon">CDF</span>
                                </div>

                            </div>
                        </div>
                        <!-- <div class="col-md-5">
                                <div class="checkbox">
                                    <label>
                                        <i class="fa fa-square blue"></i> Montant à rembourser
                                    </label>
                                </div>
                                    <div class="form-group">
                                        <div class="input-group demo2">
                                            <input type="hidden"  value="<?php /*echo $mont_remb; */ ?>" id="montant_rembourse" name="montant_rembourse"/>
                                            <input type="text" class="form-control col-md-9 col-xs-12" value="<?php /*echo $mont_remb; */ ?>" id="pour_sup_72" name="pour_sup_72" disabled='disabled'/>
                                            <span class="input-group-addon"><?php /*echo $m_affiche */ ?></span>
                                        </div>
                                        <div class="input-group demo2">
                                            <input type="hidden"  value="<?php /*echo $mont_remb; */ ?>" id="montant_rembourse" name="montant_rembourse"/>
                                            <input type="text" class="form-control col-md-9 col-xs-12" value="<?php /*echo $mont_remb; */ ?>" id="pour_sup_72" name="pour_sup_72" disabled='disabled'/>
                                            <span class="input-group-addon"><?php /*echo $m_affiche */ ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>-->
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <br><br>
                        <button type="submit" id="save" class="btn btn-danger"><i class="fa fa-check-square"></i>
                            Confirmer
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!--<script src="../js/bootstrap-modal.js"></script>-->
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
//        $('#dataTables-example').dataTable();

        $("#save").click(function (e) {
            e.preventDefault();

            var id_res = $('#id_res').val();
            var id_regl = $('#id_regl').val();
            var montant_pourcentage = $('#montant_pourcentage').val();
            var montant_rembourseUSD = $('#montant_rembourseUSD').val();
            var montant_rembourseCDF = $('#montant_rembourseCDF').val();
            $.post('Traitement_reservation/annulation_reservation.php',
                {
                    id_res: id_res,
                    id_reglement: id_regl,
                    montant_pourcentage: montant_pourcentage,
                    montant_rembourseUSD: montant_rembourseUSD,
                    montant_rembourseCDF: montant_rembourseCDF
                }, function (data) {
                    //alert(data);
                    if (data == 'succes') {
                        $('#msg').show().fadeOut(5000);
                        setTimeout(function () {
                            $(".bs-example-modal-lg").modal("hide");
                        }, 4000);
                        location.href = 'rec_liste_reservation.php';
                    }else {
                        $('#msg_alert').empty().text(data);
                        $('#msg').show();
                    }

                },
                'text');

            return false;
        });
    });

</script>