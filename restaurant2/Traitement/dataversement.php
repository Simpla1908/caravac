<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
require '../../FUNCTION/hebergement.php';
$musd='USD';
$mcdf='CDF';
$mont_cdf=0;
$mont_usd=0;
$solde_cdf=0;
$solde_usd=0;
$fond_cdf=0;
$fond_usd=0; 
$percu_cdf=0;
$percu_usd=0;
$rendu_cdf=0;
$rendu_usd=0;
$result=array();
if (isset($_POST['datedebut']) && isset($_POST['datefin'])) {
    $datedebut = dateToformatBdd($_POST['datedebut']);
    $datefin = dateToformatBdd($_POST['datefin']);
}else{
  $datedebut =date('Y-m-d');
  $datefin =date('Y-m-d');  
}
    
    if (in_array('VTVS', $_SESSION['actions']['code_actions'])||$_SESSION['type_user'] == 1){
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte BETWEEN :p_debut AND :p_fin 
        AND hotel_id=:id_hotel AND sousresto_id=:id_sousresto GROUP BY user_id,dte");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
           $fond_cdf=$r->fond_cdf;
           $fond_usd=$r->fond_usd;
        }
        
         $requete = $bdd->prepare("SELECT SUM(b.montantcdf) AS percu_cdf,SUM(b.montantusd) AS percu_usd,
       SUM(b.rendu_cdf) AS rendu_cdf,SUM(b.rendu_usd) AS rendu_usd,
       SUM(c.montant_vers) AS mont_cdf,SUM(c.montantusd) AS mont_usd,c.date_vers,c.user_vers,d.nom_user,d.prenom_user
        FROM t_reglement AS a,paiement AS b,t_versement AS c,t_utilisateur AS d
        WHERE a.id_regl=b.regl_id AND c.user_vers=a.id_user
             AND c.user_vers=d.id_user
	     AND b.id_sousresto=:id_sousresto 
             AND c.date_vers BETWEEN :p_debut AND :p_fin 
        GROUP BY c.date_vers,c.user_vers");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_sousresto',$_SESSION['id_sousresto']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);

    }
    elseif(in_array('VSPVS', $_SESSION['actions']['code_actions'])){
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte BETWEEN :p_debut AND :p_fin AND user_id=:id_user
        AND hotel_id=:id_hotel AND sousresto_id=:id_sousresto  GROUP BY dte");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->BindParam(':id_user',$_SESSION['id_user']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
           $fond_cdf=$r->fond_cdf;
           $fond_usd=$r->fond_usd;
        }
        $requete = $bdd->prepare("SELECT SUM(b.montantcdf) AS percu_cdf,SUM(b.montantusd) AS percu_usd,
       SUM(b.rendu_cdf) AS rendu_cdf,SUM(b.rendu_usd) AS rendu_usd,
       SUM(c.montant_vers) AS mont_cdf,SUM(c.montantusd) AS mont_usd,c.date_vers,c.user_vers,d.nom_user,d.prenom_user
        FROM t_reglement AS a,paiement AS b,t_versement AS c,t_utilisateur AS d
        WHERE a.id_regl=b.regl_id AND c.user_vers=a.id_user
             AND c.user_vers=d.id_user
	     AND b.id_sousresto=:id_sousresto 
              AND c.user_vers=:id_user 
             AND c.date_vers BETWEEN :p_debut AND :p_fin 
        GROUP BY c.date_vers");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_sousresto',$_SESSION['id_sousresto']);
        $requete->BindParam(':id_user',$_SESSION['id_user']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    }
  
?>
<?php
$i = 1;
$totcdf=0;
$totusd=0;
$totcdf1=0;
$totusd1=0;
foreach ($result as $r) {
    $percu_cdf=$r->percu_cdf;
    $percu_usd= $r->percu_usd;
    $rendu_cdf= $r->rendu_cdf;
    $rendu_usd= $r->rendu_usd;
    $averser_cdf=($fond_cdf+$percu_cdf)-$rendu_cdf;
    $averser_usd=($fond_usd+$percu_usd)-$rendu_usd;
    $solde_usd=$averser_usd-$r->mont_usd;
    $solde_cdf=$averser_cdf-$r->mont_cdf;
    $noms_user =$r->prenom_user.' '.$r->nom_user;
    $totcdf+=$solde_cdf;
    $totusd+=$solde_usd;
    $totcdf1+=$averser_cdf;
    $totusd1+=$averser_usd;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $noms_user ?></td>
        <td><?php echo dateAffiche($r->date_vers) ?></td>
        <td><?php echo afficheMontant($musd,$r->mont_usd) ?></td>
        <td><?php echo afficheMontant($mcdf,$r->mont_cdf) ?></td>
        <td><?php echo afficheMontant($musd,$solde_usd) ?></td>
        <td><?php echo afficheMontant($mcdf,$solde_cdf) ?></td>
        <td>
            <?php 
            if($solde_usd==$averser_usd&&$solde_cdf==$averser_cdf){
                echo 'Pas versé';
            }
            else if($solde_usd==0&&$solde_cdf==0){
                echo 'Versé';              
            }else {
                echo 'En cours';                
            }
            ?>
        </td>
        <td>
        <a class="btn btn-info btn-xs" title='Details' href="details_versement.php?noms_user=<?php echo $noms_user; ?>&user=<?php echo $r->user_vers; ?>&dte=<?php echo $r->date_vers; ?>&fond_usd=<?php echo $fond_usd; ?>&fond_cdf=<?php echo $fond_cdf; ?>&percu_cdf=<?php echo $percu_cdf; ?>&percu_usd=<?php echo $percu_usd; ?>&rendu_usd=<?php echo $rendu_usd; ?>&rendu_cdf=<?php echo $rendu_cdf; ?>&averser_usd=<?php echo $averser_usd; ?>&averser_cdf=<?php echo $averser_cdf; ?>&verser_usd=<?php echo $r->mont_usd; ?>&verser_cdf=<?php echo $r->mont_cdf; ?>">
           <i class="fa fa-eye fa-fw"></i> Détails
        </a> 
        </td>

    </tr>
    <?php
    $i++;
}
?>
<tr>
    <td colspan="3"><b>Total</b></td>
    <td><b><?php echo afficheMontant($mcdf,$totusd1) ?></b></td>
    <td><b><?php echo afficheMontant($mcdf,$totcdf1) ?></b></td>
    <td><b><?php echo afficheMontant($musd,$totusd) ?></b></td>
    <td><b><?php echo afficheMontant($mcdf,$totcdf) ?></b></td>
    <td></td>
    <td> </td>
 </tr>
