<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
require '../FUNCTION/hebergement.php';

if (in_array('VSPRCT', $_SESSION['actions']['code_actions'])){
    $requete = $bdd->prepare
    ("SELECT re.dte,pa.montantusd,pa.montantcdf,fa.taux_prix,fa.taux,fa.monnaie,
             fa.type,fa.num_fact,cl.nom_client,re.numero AS num_recu,ut.nom_user,pa.taux AS txpaie,pa.rendu
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_facture AS fa, t_client AS cl,t_utilisateur AS ut
        WHERE re.id_regl=pa.regl_id 
        AND  mo.id_mode_regl=pa.id_mode_regl 
        AND  re.id_fact=fa.id_fact AND fa.id_client=cl.id_client 
        AND  re.id_user=ut.id_user 
        AND re.id_user=:id_user 
        AND re.id_hotel=:id_hotel
        AND mo.lib='Cash' AND cl.type='client'
        AND re.dte=:date
        ");
    $requete->BindParam(':id_user', $_SESSION['id_user']);
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->BindParam(':date', $date);
    $requete->execute();
}  elseif (in_array('VTRCT', $_SESSION['actions']['code_actions'])) {
    $requete = $bdd->prepare
            ("SELECT re.dte,pa.montantusd,pa.montantcdf,fa.taux_prix,fa.taux,fa.monnaie,
             fa.type,fa.num_fact,cl.nom_client,re.numero AS num_recu,ut.nom_user,pa.taux AS txpaie,pa.rendu
        FROM t_reglement AS re,paiement AS pa,
        t_mode_reglement AS mo,t_facture AS fa, t_client AS cl,t_utilisateur AS ut
        WHERE re.id_regl=pa.regl_id 
        AND  mo.id_mode_regl=pa.id_mode_regl 
        AND  re.id_fact=fa.id_fact
        AND fa.id_client=cl.id_client 
        AND  re.id_user=ut.id_user 
        AND re.id_hotel=:id_hotel
        AND mo.lib='Cash' AND cl.type='client'
        AND re.dte=:date
        ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->BindParam(':date', $date);
    $requete->execute();
}
    

$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$i =-1;
$_SESSION['data1'] = array();
$_SESSION['data1']['type'] = array();
$_SESSION['data1']['montant'] = array();
$montant_tot= 0;
$montant=0;
$i = 1;
foreach ($result as $r) {
    $type=$r->type;
    $num_fact=$r->num_fact;
    $num_recu=$r->num_recu;
    $nom_client=$r->nom_client;
    $nom_user=$r->nom_user;
    $montant_cdf=($r->montantcdf+$r->montantusd*$r->txpaie)-$r->rendu;
    $montant_usd=($r->montantusd+$r->montantcdf/$r->txpaie)-$r->rendu;
    if($m_affiche==getsymbole_devise()){
        $montant=$montant_usd;
    }
    else{
        $montant=$montant_cdf;
    }
    $montant_tot+=$montant;  

?>


    <tr>
        <td><?php echo $i ?></td>
       <?php if (in_array('VTRCT', $_SESSION['actions']['code_actions'])) {?>
        <td><?php echo ucfirst($nom_user); ?></td>
       <?php }?>
        <td><?php echo ucfirst($num_fact); ?></td>
         <td><?php echo ucfirst($num_recu); ?></td>
        <td><?php echo ucfirst($nom_client); ?></td>
        <td><?php echo ucfirst($type); ?></td>
        <td>
            <?php
            echo afficheMontant($m_affiche,$montant);
            ?>
        </td>
    </tr>
    <?php
    $i++;
}
 
?>
    <tfoot>
<tr>
    <th colspan="6"> <span class="pull-right">Total</span></th>
    <th><?php echo afficheMontant($m_affiche,$montant_tot); ?></th>
</tr>
</tfoot>