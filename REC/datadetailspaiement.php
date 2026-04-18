<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
$id_res = 0;
if (isset($_GET['id_res'])) {
    $id_res = $_GET['id_res'];
}  else {
    if(isset($_POST['id_res'])){
         $id_res = $_POST['id_res'];
    }
}
$_SESSION['data']=getlistpaiementDetails($id_res,$tauxdollar,$taux_op,$m_affiche,$temps_sortie,$bdd);
$nbre_rows = count($_SESSION['data']['id']);
?>
<?php
$j = 1;
for ($i = 0; $i <= $nbre_rows - 1; $i++) {
    $id = $_SESSION['data']['id'][$i];
    $numero = $_SESSION['data']['numero'][$i];
    $dte = $_SESSION['data']['dte'][$i];
    $type = $_SESSION['data']['type'][$i];
    $montant_total =$_SESSION['data']['montant_total'][$i];
    $montant_paye =$_SESSION['data']['montant_paye'][$i];
    $restefact = $montant_total - $montant_paye;
    $etat_fact = 'ok';
    $taux_fact=$_SESSION['data']['taux'][$i];
    $montant_total=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$taux_fact,$montant_total);
    $montant_paye=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$taux_fact,$montant_paye);
    $reste=$montant_total-$montant_paye;
    ?>
    <tr class="odd gradeX">
        <td><?php echo $j ?></td>
        <td><?php echo dateAffiche($dte) ?></td>
        <td><?php echo $numero ?></td>
        <td><?php echo $type ?></td>
        <td><?php echo afficheMontant($m_affiche, $montant_total) ?></td>
        <td><?php echo afficheMontant($m_affiche, $montant_paye) ?></td>
        <td><?php echo afficheMontant($m_affiche, abs($reste)) ?></td>
        <td>
            <?php if ($reste > 0) {
                $reste_af=afficheMontant($m_affiche, arrondir($reste));
                $etat_fact = 'regler'; ?>
                <a 
                   id_fact="<?php echo $id; ?>"
                   service="<?php echo $type; ?>"
                   montant_fact="<?php echo $restefact; ?>"
                   montant_paye="<?php echo $_SESSION['data']['montant_paye'][$i]; ?>"
                   montant_fact_af="<?php echo $reste_af;?>"
                   taux_fact="<?php echo $taux_fact;?>"
                   etat_fact="<?php echo $etat_fact; ?>"
                   id_res="<?php echo $id_res; ?>"
                   href="#" data-toggle="modal" data-target="#myModal2"
                   title="enregistrer le paiement"
                   class="btn btn-info btn-xs btn_modal_payer"><i class="fa fa-check-circle fa-fw"></i> Régler
                </a>
            <?php } ?>
    <?php if ($reste < 0) {
        $etat_fact = 'rembourser'; ?>
                <a data-res="<?php echo $id; ?>"
                   href="#" data-toggle="modal" data-target="#myModal3"
                   title="enregistrer le remboursement"
                   class="btn btn-info btn-xs">Rembourser
                </a>
    <?php } ?>
        </td>
    </tr>
    <?php
    $j++;
}
?>