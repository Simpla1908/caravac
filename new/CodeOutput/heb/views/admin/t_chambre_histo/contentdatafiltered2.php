 <table id="example4" class="table table-bordered table-striped table-hover matable table-condensed">
        <tr>
            <th rowspan="2" style="text-align: center;">N°</th>
            <th colspan="2" style="text-align: center;">SERVICE</th>
            <th colspan="2" style="text-align: center;">CASH</th>
            <th colspan="2" style="text-align: center;">CREDIT</th>
            <th colspan="2" style="text-align: center;">DON</th>
        </tr>
        <tr>
            <th style="text-align: center;">Désignation</th> 
            <th style="text-align: center;">Prix</th> 
            <th style="text-align: center;">Quantité</th> 
            <th style="text-align: center;">Prix Total</th> 
            <th style="text-align: center;">Quantité</th> 
            <th style="text-align: center;">Prix Total</th> 
            <th style="text-align: center;">Quantité</th> 
            <th style="text-align: center;">Prix Total</th>
        </tr>
        <?php
    $m_affiche = $_SESSION['Paie_affiche'];
    $taux = $_SESSION['Paie_taux'];
    $hrs_sys = date('H:i:s');
    $checkout = $_SESSION['checkout'];
    $j = 1;
	$c=0;
    $nuites_cash = 0;
    $prix_total_cash = 0;
    $nuites_credit = 0;
    $prix_total_credit = 0;
    $nuites_don = 0;
    $prix_total_don = 0;
    $total_cash = 0;
    $total_credit = 0;
    $total_don = 0;
    //Mise en session pour impression
    $_SESSION['detailnuite'] = array();
    $_SESSION['detailnuite']['i'] = array();
    $_SESSION['detailnuite']['chambre'] = array();
    $_SESSION['detailnuite']['tarif'] = array();
    $_SESSION['detailnuite']['nuites_cash'] = array();
    $_SESSION['detailnuite']['prix_total_cash'] = array();
    $_SESSION['detailnuite']['nuites_credit'] = array();
    $_SESSION['detailnuite']['prix_total_credit'] = array();
    $_SESSION['detailnuite']['nuites_don'] = array();
    $_SESSION['detailnuite']['prix_total_don'] = array();
    //Fin mise en session
   
    for ($k = 0; $k <= $nbArticles2 - 1; $k++){
        $key=$saleServices['numTarif'][$k];
        $chambre =$saleServices['chambre'][$key];
        $monnaie = getsymbole_local();
        $taux=$saleServices['taux'][$key];
        $tarif = montant_equivalent_bdd($monnaie, $m_affiche, $taux,$saleServices['tarif'][$key]);
        $nuites_cash=$saleServices['nuites_cash'][$key];
        $nuites_credit=$saleServices['nuites_credit'][$key];
        $nuites_don=$saleServices['nuites_don'][$key];
        $prix_total_cash = montant_equivalent_bdd($monnaie, $m_affiche, $taux,$saleServices['prix_total_cash'][$key]);
        $prix_total_credit = montant_equivalent_bdd($monnaie, $m_affiche, $taux,$saleServices['prix_total_credit'][$key]);
        $prix_total_don = montant_equivalent_bdd($monnaie, $m_affiche, $taux,$saleServices['prix_total_don'][$key]);
        
            array_push($_SESSION['detailnuite']['i'], $j);
            array_push($_SESSION['detailnuite']['chambre'],$chambre);
            array_push($_SESSION['detailnuite']['tarif'], afficheMontant($m_affiche, $tarif));
            array_push($_SESSION['detailnuite']['nuites_cash'], $nuites_cash);
            array_push($_SESSION['detailnuite']['prix_total_cash'], afficheMontant($m_affiche, $prix_total_cash));
            array_push($_SESSION['detailnuite']['nuites_credit'], $nuites_credit);
            array_push($_SESSION['detailnuite']['prix_total_credit'], afficheMontant($m_affiche, $prix_total_credit));
            array_push($_SESSION['detailnuite']['nuites_don'], $nuites_don);
            array_push($_SESSION['detailnuite']['prix_total_don'], afficheMontant($m_affiche, $prix_total_don));
            ?>
            <tr>
                <th><?php echo $j ?></th>
                <td style="text-align: center;"><?php echo $chambre ?></th>
                <td style="text-align: center;"><?php echo afficheMontant($m_affiche, $tarif) ?></td>
                <td style="text-align: center;"><?php echo $nuites_cash ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $prix_total_cash) ?></td>
                <td style="text-align: center;"><?php echo $nuites_credit ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $prix_total_credit) ?></td>
                <td style="text-align: center;"><?php echo $nuites_don ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $prix_total_don) ?></td>


            </tr>
        <?php
        $total_cash += $prix_total_cash;
        $total_credit += $prix_total_credit;
        $total_don += $prix_total_don;
        $j++;
        
}

$_SESSION['total_cash'] = afficheMontant($m_affiche, $total_cash);
$_SESSION['total_credit'] = afficheMontant($m_affiche, $total_credit);
$_SESSION['total_don'] = afficheMontant($m_affiche, $total_don);
$_SESSION['datedebut'] = $datedebut;
$_SESSION['datefin'] = $datefin;
?>

    <tr>
        <th colspan="4">Total</th> 
        <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total_cash) ?></th>
        <th colspan="1"></th>
        <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total_credit) ?></th>
        <th colspan="1"></th>
        <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total_don) ?></th>
    </tr>

    </table>