<?php
if (!isset($_SESSION)) {
    session_start();
 }
include_once './bdd/connexion.php';
include_once '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../FUNCTION/hebergement.php';
 $dte1=dateToformatBdd($_POST['dte1_annul']);
 $dte2=dateToformatBdd($_POST['dte2_annul']);
 $_SESSION['dte1']=$_POST['dte1_annul'];
 $_SESSION['dte2']=$_POST['dte2_annul'];
 $filtre=3;
 if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
    if(isset($_POST['sousresto_id'])){
        $Sresto=$_POST['sousresto_id'];
    }else{
        $Sresto=$_SESSION['id_sousresto'];
    }
    $_SESSION['Asousresto_id']=$Sresto;
    $sousresto=getNameSresto($Sresto,$bdd);
    foreach ($sousresto as $sr) {
        $resto_name = $sr->libelle;
        $_SESSION['libelle_restoA']=$resto_name;
    }

}

if (in_array('VTCR', $_SESSION['actions']['code_actions'])){
    if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
        $result=getFactureGlobaleByDteSresto($_SESSION['id_hotel'],$Sresto,'restaurant',$dte1,$dte2,$filtre,$bdd);
    }  else {
        $result=getFactureGlobaleByDte($_SESSION['id_hotel'],'restaurant',$dte1,$dte2,$filtre,$bdd);
    }
 }elseif(in_array('VSPCER', $_SESSION['actions']['code_actions'])){
     if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
         $result=getFactureGlobaleByUserByDteSresto($_SESSION['id_hotel'],$Sresto,$_SESSION['id_user'],'restaurant',$dte1,$dte2,$filtre,$bdd);
     }  else {
         $result=getFactureGlobaleByUserByDte($_SESSION['id_hotel'],$_SESSION['id_user'],'restaurant',$dte1,$dte2,$filtre,$bdd);
     }
 }
 $_SESSION['factures_annul']=$result;
?>

    <thead>
        <tr>
            <th>#</th>
            <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
            <th>Resto</th>
            <?php }  ?>
            <th>Date</th>
            <th>Vendeur</th>
            <th>Client</th>
            <th>N° Facture</th>
            <th>Montant Total</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
    </thead>
<tbody>
    <?php
        $monnaie_local=getsymbole_local();
        $i = 1;
        $total_fact=0;
        $total_paye=0;
        $total_tva=0;
        foreach ($result as $r){
           $id_fact=$r->id_fact;
           $taux_op= getTauxFacture($r->type,$r->monnaie,$tauxdollar,$taux_op,$r->taux);
           $mont_tot= montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,$r->mont_ttc);
           if($r->dte_time==''){
               $dte=  dateAffiche($r->date_edition);
            }else{
               $dte=  dateAfficheForHr($r->dte_time);
            }
            $nom_cl=$r->nom_client;
            if(empty($nom_cl)){
              $nom_cl=$r->designation;  
            }            
           $user=$r->nom_user;
     ?>
    <tr id1="<?php echo $r->id_res  ?>"
        id2="<?php echo $r->id_fact  ?>"
        id3="<?php echo  $r->res_ch_id  ?>">
        <td><?php echo $i  ?></td>
        <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
        <td class='text-danger'><?php echo $r->resto; ?></td>
        <?php } ?>
        <td><?php echo $dte; ?></td>
        <td><?php echo $user; ?></td>
         <td><?php echo $nom_cl  ?> </td>
         <td><?php echo $r->num_fact  ?></td>
        <td><?php echo afficheMontant($m_affiche,$mont_tot);  ?></td>
        <td><span class="text-red">Annulée</span></td>
        <td>
            <a  id="<?php echo $r->id_fact; ?>" class="btn btn-info btn-xs btn_details_com_annul">
                 Détails
            </a>
        </td>
    </tr>
    <?php
        $i++;
        $total_fact+=$mont_tot;
       }
     ?>
     </tbody>
     <tfoot>
      <td></td>
      <td></td>
      <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
        <td></td>
        <?php } ?>
       <td></td>
       <td></td>
       <td></td>
        <td><?php echo afficheMontant($m_affiche,$total_fact); ?></td>
        <td></td>
    </tfoot> 
