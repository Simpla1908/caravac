
<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../../FUNCTION/hebergement.php';
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


//     $requete = $bdd->prepare("
//                                SELECT a.taux_prix,a.monnaie,c.idprod,c.code, c.designation, SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode,a.dte_time
//                                 FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
//                                WHERE  b.produit_id = c.idprod  
//                                       AND a.id_fact=b.commande_id
//                                       AND a.mode IS NOT NULL
//                                       AND  b.dte BETWEEN :date_bd1 AND :date_bd2
//                                       AND b.hotel_id =:hotel_id 
//                                       GROUP BY c.idprod,a.mode 
//                                       ORDER BY c.designation");
//    $requete->BindParam(':date_bd1', $date_bd1);
//    $requete->BindParam(':date_bd2', $date_bd2);
//    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//    $requete->execute();
//    $articles2 = $requete->fetchAll(PDO::FETCH_OBJ);
//    
//    $requete = $bdd->prepare("SELECT a.taux_prix,a.monnaie,a.mode,c.idprod,c.code, c.designation, SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,f.lib
//                            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a, t_reglement As d, paiement AS e, t_mode_reglement AS f
//                            WHERE b.produit_id = c.idprod AND a.id_fact=b.commande_id 
//                            AND a.id_fact=d.id_fact AND e.id_mode_regl=f.id_mode_regl
//                            AND d.id_regl=e.regl_id
//                            AND a.mode IS NULL
//                            AND b.dte BETWEEN :date_bd1 AND :date_bd2
//                            AND b.hotel_id =:hotel_id 
//                            GROUP BY c.idprod, f.lib  
//                            ORDER BY c.designation");
//    $requete->BindParam(':date_bd1', $date_bd1);
//    $requete->BindParam(':date_bd2', $date_bd2);
//    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//    $requete->execute();
//    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    
    if (($_SESSION['test'] == 1) || (in_array('VFTSR', $_SESSION['actions']['code_actions']))) {
        if (isset($_POST['sresto_id'])) {
            $Sresto = $_POST['sresto_id'];
        } else {
            $Sresto = $_SESSION['id_sousresto'];
        }
        $_SESSION['sousresto_id'] = $Sresto;
        $sousresto = getNameSresto($Sresto, $bdd);
        foreach ($sousresto as $sr) {
            $resto_name = $sr->libelle;
            $_SESSION['libelle_resto'] = $resto_name;
        }
        if($Sresto==0){
            $requete = $bdd->prepare("SELECT d.libelle As nom_sresto, a.taux_prix,a.monnaie,c.idprod,c.code, c.designation, SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode,a.dte_time
            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a, t_sousresto AS d
            WHERE  b.produit_id = c.idprod  
            AND a.id_fact=b.commande_id AND a.id_sousresto=d.id_sousresto
            AND a.mode IS NOT NULL
            AND  b.dte BETWEEN :date_bd1 AND :date_bd2
            AND b.hotel_id =:hotel_id 
            GROUP BY c.idprod,a.mode 
            ORDER BY c.designation");
            $requete->BindParam(':date_bd1', $date_bd1);
            $requete->BindParam(':date_bd2', $date_bd2);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
            $articles2 = $requete->fetchAll(PDO::FETCH_OBJ);

            $requete = $bdd->prepare("SELECT g.libelle As nom_sresto,a.taux_prix,a.monnaie,a.mode,c.idprod,c.code, c.designation, SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,f.lib
            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a, t_reglement As d, paiement AS e, t_mode_reglement AS f, t_sousresto AS g
            WHERE b.produit_id = c.idprod AND a.id_fact=b.commande_id 
            AND a.id_fact=d.id_fact AND e.id_mode_regl=f.id_mode_regl
            AND d.id_regl=e.regl_id AND a.id_sousresto=g.id_sousresto
            AND a.mode IS NULL
            AND b.dte BETWEEN :date_bd1 AND :date_bd2
            AND b.hotel_id =:hotel_id 
            GROUP BY c.idprod, f.lib  
            ORDER BY c.designation");
            $requete->BindParam(':date_bd1', $date_bd1);
            $requete->BindParam(':date_bd2', $date_bd2);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
            $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
            
        }  else {
            $requete = $bdd->prepare("SELECT d.libelle As nom_sresto, a.taux_prix,a.monnaie,c.idprod,c.code, c.designation, SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode,a.dte_time
            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a, t_sousresto AS d
            WHERE  b.produit_id = c.idprod  
            AND a.id_fact=b.commande_id AND a.id_sousresto=d.id_sousresto
            AND a.mode IS NOT NULL
            AND  b.dte BETWEEN :date_bd1 AND :date_bd2
            AND b.hotel_id =:hotel_id AND a.id_sousresto=:id_sousresto
            GROUP BY c.idprod,a.mode 
            ORDER BY c.designation");
            $requete->BindParam(':date_bd1', $date_bd1);
            $requete->BindParam(':date_bd2', $date_bd2);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->BindParam(':id_sousresto', $Sresto);
            $requete->execute();
            $articles2 = $requete->fetchAll(PDO::FETCH_OBJ);

            $requete = $bdd->prepare("SELECT g.libelle As nom_sresto,a.taux_prix,a.monnaie,a.mode,c.idprod,c.code, c.designation, SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,f.lib
            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a, t_reglement As d, paiement AS e, t_mode_reglement AS f, t_sousresto AS g
            WHERE b.produit_id = c.idprod AND a.id_fact=b.commande_id 
            AND a.id_fact=d.id_fact AND e.id_mode_regl=f.id_mode_regl
            AND d.id_regl=e.regl_id AND a.id_sousresto=g.id_sousresto
            AND a.mode IS NULL
            AND b.dte BETWEEN :date_bd1 AND :date_bd2
            AND b.hotel_id =:hotel_id AND a.id_sousresto=:id_sousresto
            GROUP BY c.idprod, f.lib  
            ORDER BY c.designation");
            $requete->BindParam(':date_bd1', $date_bd1);
            $requete->BindParam(':date_bd2', $date_bd2);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->BindParam(':id_sousresto', $Sresto);
            $requete->execute();
            $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
        }
        
        
    }  else {
        $requete = $bdd->prepare("SELECT a.taux_prix,a.monnaie,c.idprod,c.code, c.designation, SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode,a.dte_time
        FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
        WHERE  b.produit_id = c.idprod  
        AND a.id_fact=b.commande_id
        AND a.mode IS NOT NULL AND a.id_sousresto IS NULL
        AND  b.dte BETWEEN :date_bd1 AND :date_bd2
        AND b.hotel_id =:hotel_id 
        GROUP BY c.idprod,a.mode 
        ORDER BY c.designation");
        $requete->BindParam(':date_bd1', $date_bd1);
        $requete->BindParam(':date_bd2', $date_bd2);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $articles2 = $requete->fetchAll(PDO::FETCH_OBJ);

        $requete = $bdd->prepare("SELECT a.taux_prix,a.monnaie,a.mode,c.idprod,c.code, c.designation, SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,f.lib
        FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a, t_reglement As d, paiement AS e, t_mode_reglement AS f
        WHERE b.produit_id = c.idprod AND a.id_fact=b.commande_id 
        AND a.id_fact=d.id_fact AND e.id_mode_regl=f.id_mode_regl
        AND d.id_regl=e.regl_id
        AND a.mode IS NULL AND a.id_sousresto IS NULL
        AND b.dte BETWEEN :date_bd1 AND :date_bd2
        AND b.hotel_id =:hotel_id 
        GROUP BY c.idprod, f.lib  
        ORDER BY c.designation");
        $requete->BindParam(':date_bd1', $date_bd1);
        $requete->BindParam(':date_bd2', $date_bd2);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    }
    
    foreach ($articles2 as $art2) {
        $tauxdollar1 = getTauxPrixFact($art2->monnaie, $tauxdollar, $art2->taux_prix);
        if (!in_array($art2->idprod, $_SESSION['prod']['id'])) {
            array_push($_SESSION['prod']['id'], $art2->idprod);
            array_push($_SESSION['prod']['des'], $art2->designation);
        }
        if ($art2->mode == 'Cash') {
            $_SESSION['cash']['qte'][$art2->idprod] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
            $_SESSION['cash']['pt'][$art2->idprod] = $art2->qte * $prix_u;
        } elseif ($art2->mode == 'Credit') {
            $_SESSION['credit']['qte'][$art2->idprod] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
            $_SESSION['credit']['pt'][$art2->idprod] = $art2->qte * $prix_u;
        }elseif ($art2->mode == 'Don'){
            $_SESSION['don']['qte'][$art2->idprod] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
            $_SESSION['don']['pt'][$art2->idprod] = $art2->qte * $prix_u;
        }
   }
   foreach ($articles3 as $art2) {
        $tauxdollar1 = getTauxPrixFact($art2->monnaie, $tauxdollar, $art2->taux_prix);
        if (!in_array($art2->idprod, $_SESSION['prod']['id'])) {
            array_push($_SESSION['prod']['id'], $art2->idprod);
            array_push($_SESSION['prod']['des'], $art2->designation);
        }
        if ($art2->lib == 'Cash') {
            $_SESSION['cash']['qte'][$art2->idprod] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
            $_SESSION['cash']['pt'][$art2->idprod] = $art2->qte * $prix_u;
        } elseif ($art2->lib == 'Credit') {
            $_SESSION['credit']['qte'][$art2->idprod] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
            $_SESSION['credit']['pt'][$art2->idprod] = $art2->qte * $prix_u;
        } elseif ($art2->lib == 'Don') {
            $_SESSION['don']['qte'][$art2->idprod] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
            $_SESSION['don']['pt'][$art2->idprod] = $art2->qte * $prix_u;
        }
    }
    $nbre_rows = count($_SESSION['prod']['id']);
}
?>

<div class="box-header">
    <div class="col-lg-10">
        <h3 class="box-title">
            Période de ventes: 
            <small>(du <?php echo $periode; ?>)</small>
        </h3>
    </div>
   <!--  <div class="col-lg-2 text-center">
        <a class="btn btn-default" href="impression/examples/rapport_detail_vente.php?date_bd1=<?php echo $date_bd1; ?>&date_bd2=<?php echo $date_bd2; ?>&periode=<?php echo $periode; ?>" target="_blank">
            <i class="fa fa-print fa-fw"></i>&nbsp;Imprimer
        </a>
    </div> -->
</div>
<!-- /.box-header -->
<div class="box-body table-responsive">
    <table id="example4" class="table table-bordered table-striped table-hover matable table-condensed">
        <tr>
            <th rowspan="2" style="text-align: center;">N°</th>
            <th valign="midle" colspan="2" rowspan="2" style="text-align: center;">DESIGNATION</th>
            <th colspan="2" style="text-align: center;">CASH</th>
            <th colspan="2" style="text-align: center;">CREDIT</th>
            <th colspan="2" style="text-align: center;">DON</th>
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
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_cash) ?></td>
                <td style="text-align: center;"><?php echo $qte_credit ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_credit) ?></td>
                <td style="text-align: center;"><?php echo $qte_don ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_don) ?></td>
            </tr>
                <?php
                $j++;
                $total += $pt_cash;
                $total1 += $pt_credit;
                $total2 += $pt_don;
                $tot_qte+=$qte_cash;
                $tot_qte1+=$qte_credit;
                $tot_qte2+=$qte_don;
            }
            ?> 
        <tr>
            <th colspan="3">Total</th> 
            <th style="text-align: center;"><?php //echo $tot_qte  ?></th>
            <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total) ?></th>
            <th style="text-align: center;"><?php //echo $tot_qte1   ?></th>
            <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total1) ?></th>
            <th style="text-align: center;"><?php //echo $tot_qte2   ?></th>
            <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total2) ?></th>
        </tr>

    </table>
</div>
<!-- /.box-body -->