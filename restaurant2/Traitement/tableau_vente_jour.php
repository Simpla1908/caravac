<?php
// Initialisation de la session
session_start();
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/restaurant.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
$_SESSION['prod'] = [];
$_SESSION['prod']['id'] = [];
$_SESSION['prod']['des'] = [];
$_SESSION['cash'] = [];
$_SESSION['cash']['qte'] = [];
$_SESSION['cash']['pt'] = [];
$_SESSION['credit'] = [];
$_SESSION['credit']['qte'] = [];
$_SESSION['credit']['pt'] = [];
$_SESSION['don'] = [];
$_SESSION['don']['qte'] = [];
$_SESSION['don']['pt'] = [];
$_SESSION['prod']['codeprixtest'] = [];
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
$nbrcouvert = 0;
$serveur_id = $_POST['serveur_id'];
$caissier_id = $_POST['caissier_id'];
$caissier_name=$_POST['caissier_name'];
/* $date_bd1=$date_bd2=  date('Y-m-d');
  $_SESSION['produit']=  VenteJournaliere($_SESSION['id_hotel'], $date_bd1, $date_bd2, $tauxdollar, $m_affiche, $bdd);
  $nbre_rows = count($_SESSION['produit']['code']); */
$idsite = $_SESSION['id_hotel'];
if (isset($_POST['periode'])) {
    $periode = $_POST['periode'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $date_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
    $periode = 'du ' . $date1 . ' au ' . $date2;
    if ($serveur_id == 0) {
        $nbrcouvert = NombreCouvert($date_bd1, $date_bd2, $bdd);
    } else {
        $nbrcouvert = NombreCouvertServeur(
            $date_bd1,
            $date_bd2,
            $serveur_id,
            $bdd
        );
    }
    $_SESSION['nbrcouvert'] = $nbrcouvert;
} else {
    $date_bd1 = $date_bd2 = date('Y-m-d');
    $periode = "Aujourd'hui , le " . $date_bd1;
}

$totalpaiecreance = PaiementCreance3($caissier_id,$date_bd1, $date_bd2,$bdd);
$_SESSION['totalpaiecreance'] = $totalpaiecreance;
/*  $articles3="";
 if($serveur_id==0){
    $articles3=DetailsVenteTout($date_bd1,$date_bd2,$bdd);
    }else{
    $articles3= DetailsVenteServeur($date_bd1,$date_bd2,$serveur_id,$bdd);    
} */

//$articles3 = DetailsVenteTout($date_bd1, $date_bd2, $bdd);
$articles3 = DetailsVenteTout3($caissier_id,$serveur_id,$date_bd1, $date_bd2,$bdd);
$mobilepaiements = getModesMobiles($bdd);
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
                    Periode de ventes:(<?php echo $periode; ?>)
                </h3>
            </div>
            <div class="col-sm-6">Caissier: <?php echo $caissier_name ?></div>
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
                <th><?php echo $j; ?></th>
                <th colspan="2"><?php echo $designation; ?></th>
                <td style="text-align: center;"><?php echo $qte_cash; ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2(
                                                    $m_affiche,
                                                    $pt_cash
                                                ); ?></td>
                <td style="text-align: center;"><?php echo $qte_credit; ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2(
                                                    $m_affiche,
                                                    $pt_credit
                                                ); ?></td>
                <td style="text-align: center;"><?php echo $qte_don; ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2(
                                                    $m_affiche,
                                                    $pt_don
                                                ); ?></td>
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
        ?>
        <?php
        $catVente = detailsSalesCategorie3($caissier_id,$date_bd1, $date_bd2, $idsite, $bdd);
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
            <th style="text-align: center;"><?php
                                            //echo $tot_qte
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2(
                                                $m_affiche,
                                                $total
                                            ); ?></th>
            <th style="text-align: center;"><?php
                                            //echo $tot_qte1
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2(
                                                $m_affiche,
                                                $total1
                                            ); ?></th>
            <th style="text-align: center;"><?php
                                            //echo $tot_qte2
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2(
                                                $m_affiche,
                                                $total2
                                            ); ?></th>
        </tr>
        <tr>
            <th colspan="3">PAIEMENT CREDIT</th>
            <th style="text-align: center;"><?php
                                            //echo $tot_qte
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2(
                                                $m_affiche,
                                                0
                                            ); ?></th>
            <th style="text-align: center;"><?php
                                            //echo $tot_qte1
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2(
                                                $m_affiche,
                                                $totalpaiecreance
                                            ); ?></th>
            <th style="text-align: center;"><?php
                                            //echo $tot_qte2
                                            ?></th>
            <th style="text-align: right;"><?php echo afficheMontant2(
                                                $m_affiche,
                                                0
                                            ); ?></th>
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