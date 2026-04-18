<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/restaurant.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

$_SESSION['prod'] = array();
$_SESSION['prod']['id'] = array();
$_SESSION['prod']['des'] = array();
$_SESSION['cash'] = array();
$_SESSION['cash']['qte'] = array();
$_SESSION['cash']['pt'] = array();
$_SESSION['credit'] = array();
$_SESSION['credit']['qte'] = array();
$_SESSION['credit']['pt'] = array();
$_SESSION['don'] = array();
$_SESSION['don']['qte'] = array();
$_SESSION['don']['pt'] = array();
$_SESSION['prod']['codeprixtest'] = array();
$dte = date('Y-m-d');
$date_bd1 = $date_bd2 = date('Y-m-d');
$hr_1 = '00:00:00';
$hr_2 = '05:00:00';
$hr_operation = date('H:i:s');

$boisson_cash = 0;
$boisson_credit = 0;
$boisson_don = 0;

$nouriture_cash = 0;
$nouriture_credit = 0;
$nouriture_don = 0;
$extra_cash = 0;
$extra_credit = 0;
$extra_don = 0;
$emporte_cash = 0;
$emporte_credit = 0;
$emporte_don = 0;

//Ajustement pour des ventes tardives
if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
    $dte = ReduiceDaysToDate($dte, 1);
    $date_bd1 = $date_bd2 = $dte;
}

$nbrcouvert = NombreCouvert($date_bd1, $date_bd2, $bdd);
$_SESSION['nbrcouvert'] = $nbrcouvert;
$totalpaiecreance = PaiementCreance($date_bd1, $date_bd2, $bdd);
$_SESSION['totalpaiecreance'] = $totalpaiecreance;

$valcaisse = $_GET['caisse'];
if ($valcaisse == 4) {
    $date_bd1 = date('01-m-Y');
    $date_bd2 = date("Y-m-t");
}
/* 
if (in_array('RV', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) {
    $articles3 = DetailsVenteTout($date_bd1, $date_bd2, $bdd);
} elseif (in_array('VSV', $_SESSION['actions']['code_actions'])) {
    $articles3 = DetailsVenteByUser($_SESSION['id_sousresto'], $date_bd1, $date_bd2, $bdd);
} */
$idsite =  $_SESSION['id_hotel'];
$articles3 = DetailsVenteTout($date_bd1, $date_bd2, $bdd);
$mobilepaiements = getModesMobiles($bdd);
$pt = 0;
$qt = 0;
foreach ($articles3 as $art2) {
    $tauxdollar1 = $art2->taux_prix;
    $tx_remise = $art2->mont_ttc_remise;
    $prix_u = $art2->mont;
    $repas = $art2->repas;
    $nourt = $art2->familletype_id;
    $codeprixtest = $art2->idprod . $art2->code . $art2->prixremise;
    if (!in_array($codeprixtest, $_SESSION['prod']['codeprixtest'])) {
        array_push($_SESSION['prod']['id'], $codeprixtest);
        array_push($_SESSION['prod']['des'], $art2->designation);
        array_push($_SESSION['prod']['codeprixtest'], $codeprixtest);
    }
    if ($art2->lib == 'Cash') {
        $_SESSION['cash']['qte'][$codeprixtest] = $art2->qte;
        $_SESSION['cash']['pt'][$codeprixtest] = $prix_u;
        /*  $ptoffre = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->montof);
        $_SESSION['don']['qte'][$codeprixtest] = $art2->qteoffert;
        $_SESSION['don']['pt'][$codeprixtest] = $ptoffre; */
        if ($nourt == 1) {
            $boisson_cash += $prix_u;
        }
        if ($nourt == 2) {
            $nouriture_cash += $prix_u;
        }
        if ($nourt == 4) {
            $extra_cash += $prix_u;
        }
        if ($nourt == 3) {
            $emporte_cash += $prix_u;
        }
    } elseif ($art2->lib == 'Credit') {
        $_SESSION['credit']['qte'][$codeprixtest] = $art2->qte;
        $_SESSION['credit']['pt'][$codeprixtest] = $prix_u;
        /* $ptoffre = $prix_u;
        $_SESSION['don']['qte'][$codeprixtest] = $art2->qteoffert;
        $_SESSION['don']['pt'][$codeprixtest] = $ptoffre; */

        if ($nourt == 1) {
            $boisson_credit += $prix_u;
        }

        if ($nourt == 2) {
            $nouriture_credit += $prix_u;
        }

        if ($nourt == 4) {
            $extra_credit += $prix_u;
        }

        if ($nourt == 3) {
            $emporte_credit += $prix_u;
        }
    } elseif (in_array($art2->lib, $mobilepaiements)) {
        $_SESSION['don']['qte'][$codeprixtest] = $art2->qte;
        $_SESSION['don']['pt'][$codeprixtest] = $prix_u;

        if ($nourt == 1) {
            $boisson_don += $prix_u;
        }
        if ($nourt == 2) {
            $nouriture_don += $prix_u;
        }
        if ($nourt == 4) {
            $extra_don += $prix_u;
        }

        if ($nourt == 3) {
            $emporte_don += $prix_u;
        }
    }
}
$nbre_rows = count($_SESSION['prod']['id']);
?>

<div class="box-header">
    <div class="col-lg-10">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    Periode de ventes:
                    (Aujourd'hui <?php echo dateAffiche($date_bd1); ?>)
                </h3>
            </div>
            <div class="col-sm-6">Caissier: <?php echo 'Tout' ?></div>
        </div>
    </div>
    <div class="col-lg-2 text-center">
        <a class="btn btn-default" id="btn-impr-details-vente" href="impression/examples/rapport_detail_vente.php" target="_blank"><i class="fa fa-print fa-fw"></i>&nbsp;Imprimer</a>
    </div>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive">
    <table id="example4" class="table table-bordered table-striped table-hover matable table-condensed">
        <tr>
            <th rowspan="2" style="text-align: center;">N°</th>
            <th valign="midle" colspan="2" rowspan="2" style="text-align: center;">DESIGNATION</th>
            <th colspan="2" style="text-align: center;">CASH</th>
            <th colspan="2" style="text-align: center;">CREDIT</th>
            <th colspan="2" style="text-align: center;">MOBILE MONEY</th>
        </tr>
        <tr>
            <th style="text-align: center;">Quantité</th>
            <th style="text-align: center;">Prix Total</th>
            <th style="text-align: center;">Quantité</th>
            <th style="text-align: center;">Prix Total</th>
            <th style="text-align: center;">Quantité</th>
            <th style="text-align: center;">Prix Total</th>
        </tr>
        <?php
        $j = 1;
        $total = 0;
        $total1 = 0;
        $total2 = 0;
        $tot_qte = 0;
        $tot_qte1 = 0;
        $tot_qte2 = 0;
        $qte_cash = 0;
        $qte_credit = 0;
        $qte_don = 0;
        $pt_cash = 0;
        $pt_credit = 0;
        $pt_don = 0;

        for ($i = 0; $i <= $nbre_rows - 1; $i++) {
            $idprod = $_SESSION['prod']['id'][$i];
            $designation = $_SESSION['prod']['des'][$i];

            if (isset($_SESSION['cash']['qte'][$idprod])) {
                $qte_cash = $_SESSION['cash']['qte'][$idprod];
                $pt_cash = $_SESSION['cash']['pt'][$idprod];
            } else {
                $qte_cash = 0;
                $pt_cash = 0;
            }
            if (isset($_SESSION['credit']['qte'][$idprod])) {
                $qte_credit = $_SESSION['credit']['qte'][$idprod];
                $pt_credit = $_SESSION['credit']['pt'][$idprod];
            } else {
                $qte_credit = 0;
                $pt_credit = 0;
            }

            if (isset($_SESSION['don']['qte'][$idprod])) {
                $qte_don = $_SESSION['don']['qte'][$idprod];
                $pt_don = $_SESSION['don']['pt'][$idprod];
            } else {
                $qte_don = 0;
                $pt_don = 0;
            }


        ?>
            <tr>
                <th><?php echo $j ?></th>
                <th colspan="2"><?php echo $designation ?></th>
                <td style="text-align: center;"><?php echo $qte_cash ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2($m_affiche, $pt_cash) ?></td>
                <td style="text-align: center;"><?php echo $qte_credit ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2($m_affiche, $pt_credit) ?></td>
                <td style="text-align: center;"><?php echo $qte_don ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2($m_affiche, $pt_don) ?></td>
            </tr>
        <?php
            $j++;
            $total += $pt_cash;
            $total1 += $pt_credit;
            $total2 += $pt_don;
            $tot_qte += $qte_cash;
            $tot_qte1 += $qte_credit;
            $tot_qte2 += $qte_don;
        }
        $_SESSION['boisson_cash'] = $boisson_cash;
        $_SESSION['boisson_credit'] = $boisson_credit;
        $_SESSION['boisson_don'] = $boisson_don;
        $_SESSION['nouriture_cash'] = $nouriture_cash;
        $_SESSION['nouriture_credit'] = $nouriture_credit;
        $_SESSION['nouriture_don'] = $nouriture_don;
        $_SESSION['extra_cash'] = $extra_cash;
        $_SESSION['extra_credit'] = $extra_credit;
        $_SESSION['extra_don'] = $extra_don;
        $_SESSION['emporte_cash'] = $emporte_cash;
        $_SESSION['emporte_credit'] = $emporte_credit;
        $_SESSION['emporte_don'] = $emporte_don;
        $_SESSION['totalpaiecreance'] = $totalpaiecreance;
        ?>
        <?php
        $catVente = detailsSalesCategorie(
            $date_bd1,
            $date_bd2,
            $idsite,
            $bdd
        );
        $nbre_rows_catVente = count($catVente['numTarif']);
        $nbre_rows_catVente;
        for ($i = 0; $i <= $nbre_rows_catVente - 1; $i++) {
            $montant_don = 0;
            $montant_credit = 0;
            $montant_cash = 0;
            $familleTypeId = $catVente['numTarif'][$i];
            $designation = $catVente['categorieVente'][$familleTypeId];
            $designation = $catVente['categorieVente'][$familleTypeId];

            if (isset($catVente['montant_cash'][$familleTypeId])) {
                $montant_cash = $catVente['montant_cash'][$familleTypeId];
            }
            if (isset($catVente['montant_credit'][$familleTypeId])) {
                $montant_credit = $catVente['montant_credit'][$familleTypeId];
            }
            if (isset($catVente['montant_don'][$familleTypeId])) {
                $montant_don = $catVente['montant_don'][$familleTypeId];
            }

        ?>
            <tr>
                <th colspan="3"><?php echo $designation; ?></th>
                <th style="text-align: center;"><?php
                                                //echo $tot_qte
                                                ?></th>
                <th style="text-align: right;">
                    <?php echo afficheMontant2($m_affiche, $montant_cash); ?>
                </th>
                <th style="text-align: center;"><?php
                                                //echo $tot_qte1
                                                ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2(
                                                    $m_affiche,
                                                    $montant_credit
                                                ); ?></th>
                <th style="text-align: center;"><?php
                                                //echo $tot_qte2
                                                ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2(
                                                    $m_affiche,
                                                    $montant_don
                                                ); ?></th>
            </tr>
        <?php
        }
        ?>
        <tr>
            <th colspan="3">VENTE</th>
            <th style="text-align: center;"><?php //echo $tot_qte 
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $total) ?></th>
            <th style="text-align: center;"><?php //echo $tot_qte1 
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $total1) ?></th>
            <th style="text-align: center;"><?php //echo $tot_qte2 
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $total2) ?></th>
        </tr>
        <tr>
            <th colspan="3">PAIEMENT CREDIT</th>
            <th style="text-align: center;"><?php //echo $tot_qte 
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, 0) ?></th>
            <th style="text-align: center;"><?php //echo $tot_qte1 
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $totalpaiecreance) ?></th>
            <th style="text-align: center;"><?php //echo $tot_qte2 
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, 0) ?></th>
        </tr>
    </table>

    <div class="col-md-12" style='margin-top:30px;'>
        <p class="lead text-center">CHIFFRE D'AFFAIRE (CASH +CREDIT+MOBILE MONEY): <?php echo afficheMontant2(
                                                                                        $m_affiche,
                                                                                        $total + $total1 + $total2
                                                                                    ); ?> Soit <?php echo afficheMontant2(
                                                                                        'USD',montant_equivalent_bdd($m_affiche, getsymbole_devise(), $tauxdollar, $total + $total1 + $total2)
                                                                                    ); ?> </p>
        <p class="lead text-center">TOTAL PERCU (CASH + PAIEMENT CREDIT): <?php echo afficheMontant2(
                                                                                $m_affiche,
                                                                                $total + $totalpaiecreance
                                                                            ); ?> Soit <?php echo afficheMontant2(
                                                                                        'USD',montant_equivalent_bdd($m_affiche, getsymbole_devise(), $tauxdollar, $total + $totalpaiecreance)
                                                                                    ); ?></p>

    </div>
</div>
<!-- /.box-body -->