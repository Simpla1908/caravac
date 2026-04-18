<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
include('headerRec.php');
include('menu_Rec.php');
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
/* calcul du nombre du jour */
function NbJours($dte_a, $dte_now)
{

    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    return (($diff / 86400) + 1);
}

$tempsdujr =date('H:i:s');

if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];
    $fact = $_GET['fact'];
    $idch = $_GET['idch'];
    $typcl = $_GET['typcl'];
    $boolpayer=$_GET['boolpayer'];
    $dtes=$_GET['dtes'];
    //Query Restaurant
    $montant_resto = 0;
    $montant_resto_fc = 0;
    $montant_resto_usd = 0;
    $factmonnaie = '';
    $mont_paye_resto_tot = 0;
    $montant_resto_tot = 0;
    //calcul montant total resto
    $requete_resto = $bdd->prepare("SELECT b.chambr_id,c.id_fact,c.monnaie,c.mont_ttc_remise AS montant_resto
                                FROM t_reservation AS b, t_facture AS c
                                WHERE b.id_res=c.id_res
                                AND b.id_hotel=:id_hotel 
                                AND b.type='commande' 
                                AND b.id_client=:client_id
                                AND b.chambr_id=:chambr_id");
    $requete_resto->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete_resto->BindParam(':client_id', $client_id);
    $requete_resto->BindParam(':chambr_id', $idch);
    $requete_resto->execute();
    $restaurant = $requete_resto->fetchAll(PDO::FETCH_OBJ);
   //var_dump($restaurant);
    $comp = $requete_resto->fetchColumn();
    foreach ($restaurant as $resto) {
        $factmonnaie = $resto->monnaie;
        $montant_resto = $resto->montant_resto;
        $comp = 1;
        if ($factmonnaie == $m_affiche) {
            $montant_resto = $montant_resto;
        } else {
            if ($factmonnaie = 'USD' && $m_affiche == 'CDF') {
                $montant_resto = $montant_resto * $tauxdollar;
            } else {
                $montant_resto = $montant_resto * 1 / $tauxdollar;
            }
        }
        $montant_resto_tot += $montant_resto;
       }
    //fin
    //calcul montant paye resto
    $requete_resto = $bdd->prepare("SELECT b.chambr_id,c.id_fact,c.monnaie,r.montant_dollar AS montant_dollar,r.montant_fc AS montant_fc
                                FROM t_reservation AS b, t_facture AS c,t_reglement AS r
                                WHERE b.id_res=c.id_res
                                AND b.id_hotel=:id_hotel 
                                AND c.id_fact=r.id_fact
                                AND b.type='commande' 
                                AND b.id_client=:client_id
                                AND b.chambr_id=:chambr_id
                                AND r.rejete=0");
    $requete_resto->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete_resto->BindParam(':client_id', $client_id);
    $requete_resto->BindParam(':chambr_id', $idch);
    $requete_resto->execute();
    $restaurant = $requete_resto->fetchAll(PDO::FETCH_OBJ);
    //var_dump($restaurant);
    $comp = $requete_resto->fetchColumn();
    foreach ($restaurant as $resto) {
        $montant_resto_fc = $resto->montant_fc;
        $montant_resto_usd = $resto->montant_dollar;
        $comp = 1;
        if ($m_affiche == 'USD') {
            $montantFCUSD = $montant_resto_fc * 1 / $tauxdollar;
            $mont_paye_resto = $montant_resto_usd + $montantFCUSD;
        } else if ($m_affiche == 'CDF') {
            $montantUSDFC = $montant_resto_usd * $tauxdollar;
            $mont_paye_resto = $montant_resto_fc + $montantUSDFC;
        }
        $mont_paye_resto_tot += $mont_paye_resto;
    }
    //fin
    //Query Hebergement
    $montant_heb = 0;
    $montant_heb_fc = 0;
    $montant_heb_usd = 0;
    $factmonnaie = '';
    $mont_paye_heb_tot = 0;
    $montant_heb_tot = 0;
    $mont_rmz =0;
    //calcul montant total heb
    $requete_paie = $bdd->prepare("SELECT a.id_client,a.nom_client,a.id_respo,b.id_res,b.num_reserv,b.date_occ, b.date_lib,b.remise,b.mont_par_chambre,b.dte_a,b.dte_s,c.id_ch,c.num_ch,c.tarif_ch,c.monnaie,d.mont_paye_heb,d.mont_paye_resto,d.statut,e.num_fact,e.id_fact,e.montant_total AS montant_total,b.type, g.id_respo AS respo_id,g.entreprise
FROM t_client AS a,t_reservation AS b,t_chambre AS c, t_reserve_chambre AS d,t_facture AS e, t_responsable AS g 
WHERE a.id_client=d.id_client
AND b.id_res=d.idreserv 
AND c.id_ch=d.idchambre
AND b.id_res=e.id_res
AND a.id_respo=g.id_respo 
AND b.id_hotel=:id_hotel
AND b.id_client=:client_id
AND e.res_ch_id=d.id
AND e.res_ch_id=:res_ch_id");
    $requete_paie->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete_paie->BindParam(':client_id', $client_id);
    $requete_paie->BindParam(':res_ch_id', $fact);
    $requete_paie->execute();
    $hebergement = $requete_paie->fetchAll(PDO::FETCH_OBJ);
   // var_dump($hebergement);
    foreach ($hebergement as $heb) {
        $id_res = $heb->id_res;
        $num_reserv = $heb->num_reserv;
        $id_client = $heb->id_client;
        $id_ch = $heb->id_ch;
        $num_ch = $heb->num_ch;
        $tarif_ch = $heb->tarif_ch;
        $statut_ch= $heb->statut;
        $chmonnaie = $heb->monnaie;
        $mont_paye_heb = $heb->mont_paye_heb;
        $mont_paye_resto = $heb->mont_paye_resto;
        $num_fact = $heb->num_fact;
        $id_fact = $heb->id_fact;
        $montant_tot = $heb->montant_total;
        $type = $heb->type;
        $mont_par_chambre = $heb->mont_par_chambre;
        $remise = $heb->remise;
        $entreprise = $heb->entreprise;
        $nom_client = $heb->nom_client;
        $date_occ = $heb->date_occ;
        $date_lib = $heb->date_lib;
        $dte_a = $heb->dte_a;
        $dte_s = $heb->dte_s;
        date_default_timezone_set('Europe/Paris');
        $dte = date('H:i:s');
        $temps_actuel = $dte;
        if ($temps_actuel >= $temps_sortie) {
            $dte_now = date('Y-m-d', time() + 86400);
        } else {
            $dte_now = date('Y-m-d');
        }
        $date_occ1 = explode('-', $date_occ);
        $date_occ1_Heure = explode(' ', $date_occ1[2]);

        $date_occ_expl = $date_occ1_Heure[0] . '/' . $date_occ1[1] . '/' . $date_occ1[0] . ' ' . $date_occ1_Heure[1];

        $date_lib1 = explode('-', $date_lib);
        $date_lib1_Heure = explode(' ', $date_lib1[2]);

        $date_lib_expl = $date_lib1_Heure[0] . '/' . $date_lib1[1] . '/' . $date_lib1[0] . ' ' . $date_lib1_Heure[1];

        /* Nombre de jour effectué */
        //Empecher incrementation de jour pour client libere chambre
        if($statut_ch=='occupe'){
            $Nombres_jours = NbJours($dte_a, $dte_now);
        }else{
            $Nombres_jours = NbJours($dte_a, $dte_s);
        }
        $nb_jrs = $Nombres_jours;
        $nb_jr = $nb_jrs - 1;
        if ($nb_jr == 0) {
            $nb_jr++;
        }
        $nbre_jr = $nb_jr;
        /* Fin Nombre de jour effectué*/

        /* Nombre de jour restant */
        $Nbj_rst = NbJours($dte_now, $dte_s);
        $nb_jrs_rst = $Nbj_rst;
        $nb_jr_rst = $nb_jrs_rst - 1;
        if ($nb_jr_rst == 0) {
            $nb_jr_rst++;
        }
        $nbre_jr_rst = $nb_jr_rst;
        /* Fin Nombre de jour restant*/

        $Nombres_jours_p = NbJours($dte_a, $dte_s);
        $nb_jrs_p = $Nombres_jours_p;
        $nb_jr_p = $nb_jrs_p - 1;
        if ($nb_jr_p == 0) {
            $nb_jr_p++;
        }
        $nbre_jr_p = $nb_jr_p;
        //Conversion tarif chambre par rapport monnaie affichage
        if ($chmonnaie == $m_affiche) {
            $tarif_ch = $tarif_ch;
        } else {
            if ($chmonnaie = 'USD' && $m_affiche == 'CDF') {
                $tarif_ch = round($tarif_ch * $tauxdollar, 2);
            } else {
                $tarif_ch = round($tarif_ch * 1 / $tauxdollar, 2);
            }
        }
        $tarif_net = $tarif_ch * $nbre_jr;
        $mont_rmz = ($tarif_net*$remise)/100;
        $mont_ttc_ch = $tarif_net-$mont_rmz;
        $montant_heb+= $mont_ttc_ch;
    }
    $montant_heb_tot=$montant_heb;
    //fin
    //calcul montant paye heb
    $requete_paie = $bdd->prepare("SELECT e.montant_total AS montant_total,f.montant_dollar AS montantUSD,f.montant_fc AS montantFC,b.type, g.id_respo AS respo_id,g.entreprise
FROM t_client AS a,t_reservation AS b,t_chambre AS c, t_reserve_chambre AS d,t_facture AS e, t_reglement AS f, t_responsable AS g 
WHERE a.id_client=d.id_client
AND b.id_res=d.idreserv 
AND c.id_ch=d.idchambre
AND b.id_res=e.id_res
AND e.id_fact=f.id_fact 
AND a.id_respo=g.id_respo 
AND b.id_hotel=:id_hotel
AND b.id_client=:client_id
AND e.res_ch_id=d.id
AND e.res_ch_id=:res_ch_id
AND f.rejete=0");
    $requete_paie->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete_paie->BindParam(':client_id', $client_id);
    $requete_paie->BindParam(':res_ch_id', $fact);
    $requete_paie->execute();
    $hebergement = $requete_paie->fetchAll(PDO::FETCH_OBJ);
    foreach ($hebergement as $heb) {
        $montantUSD = $heb->montantUSD;
        $montantFC = $heb->montantFC;
        $montant_tot = $heb->montant_total;
        //Calcul des montants
        //DEBUT
        //CALCUL MONTANT PAYE HEB

        if ($m_affiche == 'USD') {
            $montantFCUSD = round($montantFC * 1 / $tauxdollar, 2);
            $mont_paye_heb = $montantUSD + $montantFCUSD;
        } else if ($m_affiche == 'CDF') {
            $montantUSDFC = round($montantUSD * $tauxdollar, 2);
            $mont_paye_heb = $montantFC + $montantUSDFC;
        }
        //FIN
        $mont_paye_heb_tot += $mont_paye_heb;
    }
    //fin
    //Les calculs
    $montant_a_paye=$montant_heb_tot + $montant_resto_tot;
    $montant_paye = $mont_paye_heb_tot + $mont_paye_resto_tot;
    $reste = $montant_a_paye - $montant_paye;
    $net_a_payer = $montant_a_paye- $montant_paye;
}
?>
    <div id="page-wrapper" class="pages-wrappers" style="height:900px;">
        <br>
        <div class="col-lg-12">
            <!--        <h3 class="page-header">Classeur d'une chambre</h3>-->
            <!--<div class="panel panel-default">-->

            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> Facture.
                            <small class="pull-right">Editée le, <?php echo date('d/m/Y'); ?></small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <b> Client :<?php echo ' ' . strtoupper($nom_client); ?></b><br>
                         Type :<?php echo ' ' . $typcl ?>
                        <address>
                            <?php if ($entreprise != $nom_client) { ?>
                                <?php // echo strtoupper($entreprise); ?>
                                <!--                                <small class="text-blue"> (<b>Résponsable</b>)</small><br>-->
                            <?php } ?>
                            <br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Reservation</b>:
                        <address>
                            N°Réservation: <b><?php echo $num_reserv; ?></b><br>
                            Date d'arrivée: <b><?php echo $date_occ_expl; ?></b><br>
                            Date de sortie: <b><?php echo $date_lib_expl; ?></b><br>
                            Nombre de jours prévu: <b><?php echo $nbre_jr_p; ?></b><br>
                            Rémise Hebergement: <b><?php echo $mont_rmz.' '.$m_affiche; ?></b><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>N° Chambre : <?php echo 'CH' . $num_ch; ?></b><br>
                        <br>
                        <?php
                        if($boolpayer=='occupe'){
                            if ($net_a_payer < 0) {
                                ?>
                                <b>Statut:</b> <span class="label label-success">Libérable</span><br>
                                <b>Obsérvation:</b> <span style="color: green">Autorisé à Sortir</span><br>
                                <?php
                            } else if ($net_a_payer > 0) {
                                ?>
                                <b>Statut:</b> <span class="label label-success">Non Libérable</span><br>
                                <b>Obsérvation:</b> <span style="color: red">Client en Litige</span><br>
                                <?php
                            } else {
                                ?>
                                <b>Statut:</b> <span class="label label-success">Libérable</span><br>
                                <b>Obsérvation:</b> Autorisé à Sortir <br>
                                <?php
                            }
                        }
                        ?>
                        Nombre de jours effectués: <b><?php echo $nbre_jr; ?></b><br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>N°</th>
                                <th>Services</th>
                                <th>Sous-total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hébergement</td>
                                <td><?php echo round($montant_heb_tot, 2) . ' ' . $m_affiche; ?></td>
                            </tr>
                            <?php
                            if ($comp != 0) {
                                ?>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        Restauration
                                       <!-- <a class="panel-heading collapsed" title="Rélèver du client" role="tab"
                                           id="headingTwo1" data-toggle="collapse" data-parent="#accordion"
                                           href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fa fa-sort"></i>
                                        </a>-->
                                    </td>
                                    <td>
                                        <?php
                                        if ($comp == 0) {
                                            echo '0.00' . ' ' . $m_affiche;;
                                        } else {
                                            echo round($montant_resto_tot, 2) . ' ' . $m_affiche;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <h4>Rélèver du Client</h4>

                        <table class="table table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Désignation</th>
                                <th>Quantité</th>
                                <th>Prix Total</th>
                            </tr>
                            </thead>
                            <?php include 'Traitement/affichage_relever_client.php' ?>
                            <tbody>
                            <?php $i = 1;
                            $som = 0;
                            $nbr_row = count($operations);
                            if ($nbr_row != 0) {
                                foreach ($operations as $operation):
                                    //recuperation tva&remise de la commande & calcul
                                    $tvalgcmd = $operation->tva;
                                    $remiselgcmd = $operation->remise;
                                    //fin
                                    if ($m_affiche == 'CDF') {
                                        $pu = $operation->pu;
                                    } else {
                                        $pu = $operation->pu * 1 / $tauxdollar;
                                    }
                                    $pt = $pu * $operation->qte;
                                    ?>

                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $operation->dte_h; ?></td>
                                        <td><?php echo $operation->designation; ?></td>
                                        <td><?php echo $operation->qte; ?></td>
                                        <td><?php echo round($pt, 2) . ' ' . $m_affiche; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                    $som = $som + $pt;
                                endforeach;
                                $mont_tva = ($som * $tvalgcmd) / 100;
                                $mont_rmz = (($mont_tva+$som )* $remiselgcmd) / 100;
                                $mont_ttc = ($som + $mont_tva) - $mont_rmz;
                            } else {
                                ?>
                                <tr>
                                    <th colspan="5"><i>Pas d'information</i></th>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="4">HT</th>
                                <th><?php echo round($som, 2) . ' ' . $m_affiche; ?></th>
                            </tr>
                            <tr>
                                <th colspan="4">TVA</th>
                                <th><?php echo round($mont_tva, 2) . ' ' . $m_affiche; ?></th>
                            </tr>
                            <tr>
                                <th colspan="4">Rémise</th>
                                <th><?php echo round($remiselgcmd, 2) . '%'; ?></th>
                            </tr>
                            <tr>
                                <th colspan="4">TTC</th>
                                <th><?php echo round($mont_ttc, 2) . ' ' . $m_affiche; ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr/>
                <div class="ttl-amts">
                    <h5><b>Montant Total</b> : <?php echo round($montant_a_paye, 2) . ' ' . $m_affiche; ?></h5>
                </div>
                <hr/>
                <div class="ttl-amts">
                    <h5><b>Montant Payé</b> : <?php echo round($montant_paye, 2) . ' ' . $m_affiche; ?> </h5>
                </div>
                <hr/>
                <div class="ttl-amts">
                    <h4>
                        <strong>
                            <?php
                            if($boolpayer=='occupe'){
                                if ($net_a_payer < 0) {
                                    $mont_remboursable = round($net_a_payer, 2);
                                    ?>
                                    <?php echo 'Net à Payer : ' . abs(round($net_a_payer, 2)) . ' ' . $m_affiche; ?> <span
                                        style="color: red"> (Remboursable)</span>
                                    <?php
                                } else if ($net_a_payer > 0) {
                                    ?>
                                    <?php echo 'Net à Payer : ' . abs(round($net_a_payer, 2)) . ' ' . $m_affiche; ?><span
                                        style="color: red"> (Redevable)</span>
                                    <?php
                                }
                            }
                            ?>
                        </strong>
                    </h4>
                </div>
                <div class="row pad-top-botm">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <hr/>
                        <?php if (in_array('IMPRCLSS', $_SESSION['actions']['code_actions'])) { ?>
                           <!-- <a href="#" target="_blank" class="btn btn-default" title="Imprimer"><i
                                    class="fa fa-print"></i> Imprimer</a>-->
                        <?php } ?>
                        <?php
                        if ($typcl == "client occasionnel") {

                            if ($net_a_payer < 0) {
                                ?>
                                <?php if (in_array('EL', $_SESSION['actions']['code_actions'])) {
                                    if($boolpayer=='occupe'){?>
                                    <a href="rec_ajout_liberation.php?id_client=<?php echo $id_client; ?>&id_res=<?php echo $id_res; ?>&num_reserv=<?php echo $num_reserv; ?> &nom_client=<?php echo $nom_client; ?> &id_ch=<?php echo $id_ch; ?> &num_ch=<?php echo $num_ch; ?> &mont_remboursable=<?php echo $mont_remboursable; ?>&fact=<?php echo $fact; ?> "
                                       class="btn btn-primary pull-right" style="margin-right: 5px;">
                                        <i class="fa fa-sign-out"></i> Effectuer la sortie
                                    </a>
                                <?php }} ?>
                                <a href="#" class="btn btn-success pull-right" disabled="disabled"><i
                                        class="fa fa-credit-card"></i> Payer
                                </a>
                                <?php
                            } else if ($net_a_payer > 0) {
                                ?>
                                <?php if (in_array('EL', $_SESSION['actions']['code_actions'])) {
                                    if($boolpayer=='occupe') {
                                        ?>
                                        <button type="button" class="btn btn-primary pull-right"
                                                style="margin-right: 5px;"
                                                disabled="disabled">
                                            <i class="fa fa-sign-out"></i> Effectuer la sortie
                                        </button>
                                        <?php
                                    }
                                    } ?>
                                <a href="rec_paiement_additif_facture.php?num_fact=<?php echo $num_fact; ?>&nom_client=<?php echo $nom_client; ?>&id_fact=<?php echo $id_fact; ?>&type=<?php echo $type; ?>&reste=<?php echo $net_a_payer; ?>&montant_tot=<?php echo $montant_a_paye; ?>&id_ch=<?php echo $id_ch; ?>&id_res=<?php echo $id_res; ?>&id_client=<?php echo $id_client; ?>&typcl=<?php echo $typcl; ?>"
                                   class="btn btn-success pull-right">
                                    <i class="fa fa-credit-card"></i> Payer
                                </a>
                                <?php
                            } else {
                                ?>
                                <?php if (in_array('EL', $_SESSION['actions']['code_actions'])) {
                                    if($boolpayer=='occupe') {
                                        ?>
                                    <a href="rec_ajout_liberation.php?id_client=<?php echo $id_client; ?>&id_res=<?php echo $id_res; ?>&num_reserv=<?php echo $num_reserv; ?> &nom_client=<?php echo $nom_client; ?> &id_ch=<?php echo $id_ch; ?> &num_ch=<?php echo $num_ch; ?>&dtes=<?php echo $dtes; ?> &mont_remboursable=0&fact=<?php echo $fact; ?> "
                                       class="btn btn-primary pull-right" style="margin-right: 5px;">
                                        <i class="fa fa-sign-out"></i> Effectuer la sortie
                                    </a>
                                <?php }
                                }
                                ?>
                                <a href="#" class="btn btn-success pull-right" disabled="disabled">
                                    <i class="fa fa-credit-card"></i> Payer
                                </a>
                                <a href="#" class="btn btn-success pull-right">
                                    <i class="fa fa-print"></i> Imprimer
                                </a>
                                <?php
                            }
                        } else {
                            if($boolpayer=='occupe'){
                            if (in_array('EL', $_SESSION['actions']['code_actions'])) {
                                ?>
                                <a href="rec_ajout_liberation.php?id_client=<?php echo $id_client; ?>&id_res=<?php echo $id_res; ?>&num_reserv=<?php echo $num_reserv; ?> &nom_client=<?php echo $nom_client; ?> &id_ch=<?php echo $id_ch; ?> &num_ch=<?php echo $num_ch; ?>&dtes=<?php echo $dtes; ?>&mont_remboursable=0&fact=<?php echo $fact; ?> "
                                   class="btn btn-primary pull-right" style="margin-right: 5px;">
                                    <i class="fa fa-sign-out"></i> Effectuer la sortie
                                </a>
                            <?php }
                                if ($net_a_payer==0){
                                ?>

                            <a href="rec_paiement_additif_facture.php?num_fact=<?php echo $num_fact; ?>&nom_client=<?php echo $nom_client; ?>&id_fact=<?php echo $id_fact; ?>&type=<?php echo $type; ?>&reste=<?php echo $net_a_payer; ?>&montant_tot=<?php echo $montant_a_paye; ?>&id_ch=<?php echo $id_ch; ?>&id_res=<?php echo $id_res; ?>&id_client=<?php echo $id_client; ?>&typcl=<?php echo $typcl; ?>"
                               class="btn btn-success pull-right" disabled="disabled">
                                <i class="fa fa-credit-card"></i> Payer
                            </a>
                            <?php
                                }else{
                                    ?>
                                    <a href="rec_paiement_additif_facture.php?num_fact=<?php echo $num_fact; ?>&nom_client=<?php echo $nom_client; ?>&id_fact=<?php echo $id_fact; ?>&type=<?php echo $type; ?>&reste=<?php echo $net_a_payer; ?>&montant_tot=<?php echo $montant_a_paye; ?>&id_ch=<?php echo $id_ch; ?>&id_res=<?php echo $id_res; ?>&id_client=<?php echo $id_client; ?>&typcl=<?php echo $typcl; ?>"
                                       class="btn btn-success pull-right">
                                        <i class="fa fa-credit-card"></i> Payer
                                    </a>
                                    <?php
                                }
                        }
                        }

                        ?>

                    </div>
                </div>

            </section>
            <!--</div>-->
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include('gl_footer.php'); ?>