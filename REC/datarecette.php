<?php
 if (!isset($_SESSION)) {
    session_start();
    }
require '../bdd/connexion.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
require '../FUNCTION/hebergement.php';

if (isset($_POST['datedebut']) && isset($_POST['datefin'])) {
    $datedebut = dateToformatBdd($_POST['datedebut']);
    $datefin = dateToformatBdd($_POST['datefin']);
   //VOIR SES PROPRES RECETTES
    if (in_array('VSPRCT', $_SESSION['actions']['code_actions'])){
        $requete = $bdd->prepare
        ("SELECT re.dte,pa.montantusd,pa.montantcdf,fa.taux_prix,fa.taux,fa.monnaie,fa.type,pa.taux AS txpaie,pa.rendu
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_facture AS fa, t_client AS cl
        WHERE re.id_regl=pa.regl_id 
        AND  mo.id_mode_regl=pa.id_mode_regl 
        AND  re.id_fact=fa.id_fact AND fa.id_client=cl.id_client 
        AND re.id_user=:id_user 
        AND re.id_hotel=:id_hotel
        AND mo.lib='Cash' AND cl.type='client'
        AND re.dte BETWEEN :p_debut AND :p_fin
        ORDER BY re.dte ASC");
        $requete->BindParam(':id_user', $_SESSION['id_user']);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->execute();
    }elseif (in_array('VTRCT', $_SESSION['actions']['code_actions'])) {
       $requete = $bdd->prepare
        ("SELECT re.dte,pa.montantusd,pa.montantcdf,fa.taux_prix,fa.taux,fa.monnaie,fa.type,pa.taux AS txpaie,pa.rendu
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_facture AS fa, t_client AS cl
        WHERE re.id_regl=pa.regl_id 
        AND  mo.id_mode_regl=pa.id_mode_regl 
        AND  re.id_fact=fa.id_fact AND fa.id_client=cl.id_client 
        AND re.id_hotel=:id_hotel
        AND mo.lib='Cash' AND cl.type='client'
        AND re.dte BETWEEN :p_debut AND :p_fin
        ORDER BY re.dte ASC");
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->execute(); 
    }
} else {
     if (in_array('VSPRCT', $_SESSION['actions']['code_actions'])){
            $requete = $bdd->prepare
            ("SELECT re.dte,pa.montantusd,pa.montantcdf,fa.taux_prix,fa.taux,fa.monnaie,fa.type,pa.taux AS txpaie,pa.rendu
                FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_facture AS fa, t_client AS cl
                WHERE re.id_regl=pa.regl_id 
                AND  mo.id_mode_regl=pa.id_mode_regl 
                AND  re.id_fact=fa.id_fact AND fa.id_client=cl.id_client 
                AND re.id_user=:id_user 
                AND re.id_hotel=:id_hotel
                AND mo.lib='Cash' AND cl.type='client'
                ORDER BY re.dte ASC");
            $requete->BindParam(':id_user', $_SESSION['id_user']);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->execute();
     }elseif (in_array('VTRCT', $_SESSION['actions']['code_actions'])){
            $requete = $bdd->prepare
            ("SELECT re.dte,pa.montantusd,pa.montantcdf,fa.taux_prix,fa.taux,fa.monnaie,fa.type,pa.taux AS txpaie,pa.rendu
                FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_facture AS fa, t_client AS cl
                WHERE re.id_regl=pa.regl_id 
                AND  mo.id_mode_regl=pa.id_mode_regl 
                AND  re.id_fact=fa.id_fact AND fa.id_client=cl.id_client 
                AND re.id_hotel=:id_hotel
                AND mo.lib='Cash' AND cl.type='client'
                ORDER BY re.dte ASC");
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->execute();
     }
}
$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$i =-1;
$_SESSION['data'] = array();
$_SESSION['data']['date'] = array();
$_SESSION['data']['montant'] = array();
$montant_tot= 0;
$montant=0;
foreach ($result as $r) {
    $date=$r->dte;
    $type=$r->type;
    $montant_cdf=($r->montantcdf+$r->montantusd*$r->txpaie)-$r->rendu;
    $montant_usd=($r->montantusd+$r->montantcdf/$r->txpaie)-$r->rendu;
    if($m_affiche==getsymbole_devise()){
        $montant=$montant_usd;
    }
    else{
        $montant=$montant_cdf;
    }
    $montant_tot+=$montant;  
      if (!in_array($date, $_SESSION['data']['date'])) {
          $i++; 
        array_push($_SESSION['data']['date'],$date);
        array_push($_SESSION['data']['montant'],$montant);
      }else{
      $_SESSION['data']['montant'][$i]+=$montant;
      }
}
?>
<?php 
    $j = 1;
    $nbre_lgne =COUNT($_SESSION['data']['date']);
    for ($i = 0; $i <= $nbre_lgne - 1; $i++) {
   ?>
    <tr>
        <td><?php echo $j ?></td>
        <td><?php echo dateAffiche($_SESSION['data']['date'][$i]) ?></td>
        <td>
            <?php
            echo afficheMontant($m_affiche,$_SESSION['data']['montant'][$i]);
            ?>
        </td>
        <td>
            <a href="details_recettes.php?dte=<?php echo $_SESSION['data']['date'][$i] ?>" title="Détails recette du <?php echo dateAffiche($_SESSION['data']['date'][$i]) ?>"
            class="btn btn-primary btn-xs"> <i class="fa fa-list fa-fw"></i> Détail
         </a>
    </td>
    </tr>
    <?php
     $j++;
}
?>
<tr>
    <th></th>
    <th>Total</th>
    <th><?php echo afficheMontant($m_affiche,$montant_tot); ?></th>
    <th></th>
</tr>
