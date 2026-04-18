<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
$id_res = $_GET['id_res'];
$_SESSION['data']=getlistpaiementDetails($id_res,$tauxdollar,$taux_op,$m_affiche,$temps_sortie,$bdd);
$nbre_rows = count($_SESSION['data']['id']);
?>
    <label>Factures</label>
<select name="slctfact" class="form-control " style="width: 100%;" id="slctfact">
    <option></option>
<?php
for ($i = 0; $i <= $nbre_rows - 1; $i++) {
    $id = $_SESSION['data']['id'][$i];
    $numero = $_SESSION['data']['numero'][$i];
    $dte = $_SESSION['data']['dte'][$i];
    $type = $_SESSION['data']['type'][$i];
    $montant_total =$_SESSION['data']['montant_total'][$i];
    $montant_paye =$_SESSION['data']['montant_paye'][$i];
    $restefact = $montant_total - $montant_paye;
    $etat_fact = 'regler2';
    $taux_fact=$_SESSION['data']['taux'][$i];
    $montant_total=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$taux_fact,$montant_total);
    $montant_paye=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$taux_fact,$montant_paye);
    $reste=$montant_total-$montant_paye;
    $reste_af=afficheMontant($m_affiche, arrondir($reste));
    if ($reste > 0) {?>
        <option id_fact="<?php echo $id; ?>"
                service="<?php echo $type; ?>"
                montant_fact="<?php echo $restefact; ?>"
                montant_paye="<?php echo $montant_paye; ?>"
                montant_tot="<?php echo $montant_total; ?>"
                montant_fact_af="<?php echo $reste_af;?>"
                taux_fact="<?php echo $taux_fact;?>"
                etat_fact="<?php echo $etat_fact; ?>"
                id_res="<?php echo $id_res; ?>" value="<?php echo $id;?>"><?php echo $numero.' '.$type; ?></option>
 <?php }
}
?>
</select>
