<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
$id_res = $_GET['id_res'];
$_SESSION['data']=getDataDetailPaiement($id_res,$tauxdollar,$taux_op,$m_affiche,$temps_sortie,$bdd);
$nbre_rows = count($_SESSION['data']['id']);
?>
<?php
$j = 1;
$montant_tot=0;
for ($i = 0; $i <= $nbre_rows - 1; $i++) {
    $numerofacture = $_SESSION['data']['numero'][$i];
    $dte = $_SESSION['data']['dte'][$i];
    $dtet = $_SESSION['data']['dtet'][$i];
    $type = $_SESSION['data']['type'][$i];
    $montant_paye =$_SESSION['data']['montant_paye'][$i];
    $taux_fact=$_SESSION['data']['taux'][$i];
    $nom_client=$_SESSION['data']['client'][$i];
    $num_recu=$_SESSION['data']['num_recu'][$i];
    $lib_mode=$_SESSION['data']['mode'][$i];
    if($lib_mode!='Credit'){
    ?>
    <tr class="odd gradeX">
        <td><?php echo $j ?></td>
        <td><?php
            if($dtet=='0000-00-00 00:00:00'){
                echo dateAffiche($dte);
            }else{
                echo dateAfficheForHr($dtet);
            }
            ?></td>
        <td><?php echo $numerofacture ?></td>
        <td><?php echo $num_recu ?></td>
        <td><?php echo $nom_client ?></td>
        <td><?php echo $type ?></td>
        <td><?php echo $lib_mode ?></td>
        <td><?php echo afficheMontant($m_affiche,$montant_paye) ?></td>
    </tr>
    <?php
    }
    $j++;
    $montant_tot+=$montant_paye;
}
?>
<tfoot>
<tr>

    <th colspan="7"></th>
    <th><?php echo afficheMontant($m_affiche,$montant_tot) ?></th>
</tr>
</tfoot>