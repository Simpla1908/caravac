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

$tempsdujr = gmstrftime("%H:%M", time() + 3600);

if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];
    $fact = $_GET['fact'];

    //Query Restaurant
    $requete_resto = $bdd->prepare("SELECT SUM(mont_ttc_remise) AS montant_resto
FROM t_reservation AS b, t_facture AS c
WHERE b.id_res=c.id_res
AND b.id_hotel=:id_hotel 
AND b.type='commande' 
AND b.etat_credit='credit'
AND b.id_client=:client_id ");
    $requete_resto->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete_resto->BindParam(':client_id', $client_id);
    $requete_resto->execute();
    $restaurant = $requete_resto->fetchAll(PDO::FETCH_OBJ);
    $comp = $requete_resto->fetchColumn();
    foreach ($restaurant as $resto) {
        $montant_resto = $resto->montant_resto;
        $comp = 1;
    }
    //Query Hebergement
    $requete_paie = $bdd->prepare("SELECT a.id_client,a.nom_client,a.id_respo,b.id_res,b.num_reserv,b.date_occ, b.date_lib,b.remise,b.mont_par_chambre,b.dte_a,b.dte_s,c.id_ch,c.num_ch,c.tarif_ch,d.mont_paye_heb,d.mont_paye_resto,e.num_fact,e.id_fact, e.montant_total, SUM(f.montant_dollar) AS montantUSD, SUM(f.montant_fc) AS montantFC,b.type, g.id_respo AS respo_id,g.entreprise
FROM t_client AS a,t_reservation AS b,t_chambre AS c, t_reserve_chambre AS d,t_facture AS e, t_reglement AS f, t_responsable AS g 
WHERE a.id_client=d.id_client
AND b.id_res=d.idreserv AND c.id_ch=d.idchambre
AND b.id_res=e.id_res
AND e.id_fact=f.id_fact 
AND a.id_respo=g.id_respo 
AND d.statut='occupe' 
AND b.id_hotel=:id_hotel
AND b.id_client=:client_id
GROUP BY a.id_client");
    $requete_paie->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete_paie->BindParam(':client_id', $client_id);
    $requete_paie->execute();
    $hebergement = $requete_paie->fetchAll(PDO::FETCH_OBJ);
    foreach ($hebergement as $heb) {
        $id_res = $heb->id_res;
        $num_reserv = $heb->num_reserv;
        $id_client = $heb->id_client;
        $id_ch = $heb->id_ch;
        $num_ch = $heb->num_ch;
        $tarif_ch = $heb->tarif_ch;
        $mont_paye_heb = $heb->mont_paye_heb;
        $mont_paye_resto = $heb->mont_paye_resto;
        $num_fact = $heb->num_fact;
        $id_fact = $heb->id_fact;
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
        $Nombres_jours = NbJours($dte_a, $dte_now);
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

        //Calcul des montants

        $montant_resto_usd = $montant_resto / $tauxdollar;

        $montant_paye = $mont_paye_heb + $mont_paye_resto;
        $tarif_net = $tarif_ch * $nbre_jr;
        $montant_a_paye = $tarif_net - ($tarif_net * $remise) / 100;
        $reste = $montant_a_paye - $montant_paye;

        $total = $tarif_net + $montant_resto_usd;
        $net_a_payer = ($tarif_net + $montant_resto_usd) - $montant_paye;

    }
}
?>
    <div id="page-wrapper" style="height:670px;">
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
                            <small class="pull-right">Editer le, <?php echo date('d/m/Y'); ?></small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Client(s):
                        <address>
                            <b><?php echo strtoupper($nom_client); ?></b><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Reservation</b>:
                        <address>
                            Date d'arrivée: <b><?php echo $date_occ_expl; ?></b><br>
                            Date de sortie: <b><?php echo $date_lib_expl; ?></b><br>
                            Nombre de jours prévu: <b><?php echo $nbre_jr_p; ?></b><br>
                            Nombre de jours restants: <b><?php echo $nbre_jr_rst; ?></b><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>N° Chambre : <?php echo 'CH' . $num_ch; ?></b><br>
                        <br>
                        <?php
                        if ($net_a_payer < 0) {
                            ?>
                            <b>Statut:</b> <span class="label label-success">Libérable</span><br>
                            <b>Obsérvation:</b> <span style="color: green">Autorisé à sortir</span><br>
                            <?php
                        } else if ($net_a_payer > 0) {
                            ?>
                            <b>Statut:</b> <span class="label label-success">Non Libérable</span><br>
                            <b>Obsérvation:</b> <span style="color: red">Client en litige</span><br>
                            <?php
                        } else {
                            ?>
                            <b>Statut:</b> <span class="label label-success">Libérable</span><br>
                            <b>Obsérvation:</b> Autorisé à sortir <br>
                            <?php
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
                        <table class="table table-striped">
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
                                <td><?php echo round($tarif_net, 2); ?>$</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Restauration</td>
                                <td>
                                    <?php
                                    if ($comp == 0) {
                                        echo '0.00$';
                                    } else {
                                        echo round($montant_resto_usd, 2);
                                    }
                                    ?>$
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!--accepted payments column-->
                    <div class="col-xs-6">
                        <p class="lead">Mode de paiement:</p>
                        <!--          <img src="../../dist/img/credit/visa.png" alt="Visa">
                                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">-->

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango
                            imeem plugg
                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <p class="lead">Situation Générale</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Total:</th>
                                    <td><?php echo round($total, 2); ?>$</td>
                                </tr>
                                <tr>
                                    <th>Montant payé:</th>
                                    <td><?php echo round($montant_paye, 2); ?>$</td>
                                </tr>
                                <tr>
                                    <th>Net à payer:</th>
                                    <?php
                                    if ($net_a_payer < 0) {
                                        $mont_remboursable = round($net_a_payer, 2);
                                        ?>
                                        <td><?php echo abs(round($net_a_payer, 2)); ?>$<span style="color: red"> (Remboursable)</span>
                                        </td>
                                        <?php
                                    } else if ($net_a_payer > 0) {
                                        ?>
                                        <td><?php echo abs(round($net_a_payer, 2)); ?>$<span style="color: red"> (Redevable)</span>
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td><?php // echo abs($net_a_payer);?><span> 0.00$</span></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <?php if (in_array('IMPRCLSS', $_SESSION['actions']['code_actions'])) { ?>
                            <a href="invoice-print.php" target="_blank" class="btn btn-default"><i
                                    class="fa fa-print"></i> Imprimer</a>
                        <?php } ?>
                        <?php
                        if ($net_a_payer < 0) {
                            ?>
                            <?php if (in_array('EL', $_SESSION['actions']['code_actions'])) { ?>
                                <a href="rec_ajout_liberation.php?id_client=<?php echo $id_client; ?>&id_res=<?php echo $id_res; ?>&num_reserv=<?php echo $num_reserv; ?> &nom_client=<?php echo $nom_client; ?> &id_ch=<?php echo $id_ch; ?> &num_ch=<?php echo $num_ch; ?> &mont_remboursable=<?php echo $mont_remboursable; ?>"
                                   class="btn btn-primary pull-right" style="margin-right: 5px;">
                                    <i class="fa fa-sign-out"></i> Effectuer la sortie
                                </a>
                            <?php } ?>
                            <a href="#" class="btn btn-success pull-right" disabled="disabled"><i
                                    class="fa fa-credit-card"></i> Payer
                            </a>
                            <?php
                        } else if ($net_a_payer > 0) {
                            ?>
                            <?php if (in_array('EL', $_SESSION['actions']['code_actions'])) { ?>
                                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"
                                        disabled="disabled">
                                    <i class="fa fa-sign-out"></i> Effectuer la sortie
                                </button>
                            <?php } ?>
                            <a href="rec_paiement_additif_facture.php?num_fact=<?php echo $num_fact; ?>&nom_client=<?php echo $nom_client; ?>&id_fact=<?php echo $id_fact; ?>&type=<?php echo $type; ?>&reste=<?php echo $net_a_payer; ?>&montant_tot=<?php echo $total; ?>&id_ch=<?php echo $id_ch; ?>&id_res=<?php echo $id_res; ?>&id_client=<?php echo $id_client; ?>"
                               class="btn btn-success pull-right">
                                <i class="fa fa-credit-card"></i> Payer
                            </a>
                            <?php
                        } else {
                            ?>
                            <?php if (in_array('EL', $_SESSION['actions']['code_actions'])) { ?>
                                <a href="rec_ajout_liberation.php?id_client=<?php echo $id_client; ?>&id_res=<?php echo $id_res; ?>&num_reserv=<?php echo $num_reserv; ?> &nom_client=<?php echo $nom_client; ?> &id_ch=<?php echo $id_ch; ?> &num_ch=<?php echo $num_ch; ?> &mont_remboursable=0"
                                   class="btn btn-primary pull-right" style="margin-right: 5px;">
                                    <i class="fa fa-sign-out"></i> Effectuer la sortie
                                </a>
                            <?php } ?>
                            <a href="#" class="btn btn-success pull-right" disabled="disabled">
                                <i class="fa fa-credit-card"></i> Payer
                            </a>
                            <?php
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