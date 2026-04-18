<?php
if (!isset($_SESSION)) {
    session_start();
 }
include_once './bdd/connexion.php';
include_once '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../FUNCTION/hebergement.php';
 $dte1=dateToformatBdd($_POST['dte1']);
 $dte2=dateToformatBdd($_POST['dte2']);
 $_SESSION['dte1']=$_POST['dte1'];
 $_SESSION['dte2']=$_POST['dte2'];
 $filtre=1;
 if (in_array('VTCR', $_SESSION['actions']['code_actions'])){
     $result=getFactureGlobaleByDte($_SESSION['id_hotel'],'restaurant',$dte1,$dte2,$filtre,$bdd);
  }elseif(in_array('VSPCER', $_SESSION['actions']['code_actions'])){
    $result=getFactureGlobaleByUserByDte($_SESSION['id_hotel'],$_SESSION['id_user'],'restaurant',$dte1,$dte2,$filtre,$bdd);
  }
 $_SESSION['factures3']=$result; 
?>

    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
<!--            <th>Vendeur</th>
            <th>Client</th>-->
            <th>N° Facture</th>
            <th>Mode</th>
            <th>Montant Total</th>
            <th>T.V.A</th>
<!--            <th>Statut</th>
            <th>Action</th>-->
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
           $mont_paye=montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,totalMontantPayeFacture($id_fact,$bdd));
           $mont_tva= montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,arrondir($r->mont_tva));
           $valetat=$r->etat_fact;
           if($r->dte_timef==''){
               $dte=  dateAffiche($r->date_edition);
            }else{
               $dte=  dateAfficheForHr($r->dte_timef);
            }
            $nom_cl=$r->nom_client;
            if(empty($nom_cl)){
              $nom_cl=$r->designation;  
            }
            $mode=$r->modef;
            
           $user=$r->nom_user;
          $etat=getEtatCommande($r->etat_fact);
     ?>
    <tr id1="<?php echo $r->id_res  ?>"
        id2="<?php echo $r->id_fact  ?>"
        id3="<?php echo  $r->res_ch_id  ?>">
        <td><?php echo $i  ?></td>
        <td><?php echo $dte; ?></td>
<!--        <td><?php echo $user; ?></td>
         <td><?php echo $nom_cl  ?> </td>-->
         <td><?php echo $r->num_fact  ?></td>
         <td><?php echo $mode  ?></td>
        <td><?php echo afficheMontant($m_affiche,$mont_tot);  ?></td>
        <td><?php echo afficheMontant($m_affiche,$mont_tva); ?> </td>
<!--        <td><?php  echo $etat; ?></td>
        <td>
            <a  id="<?php echo $r->id_fact; ?>" class="btn btn-info btn-xs btn_details_com">
                 Détails
            </a>
        </td>-->
    </tr>
    <?php
        $i++;
        $total_fact+=$mont_tot;
        $total_paye+=$mont_tva;
       }
     ?>
     </tbody>
     <tfoot>
      <td></td>
      <td></td>
       <td></td>
        <td></td>
        <td><?php echo afficheMontant($m_affiche,$total_fact); ?></td>
        <td><?php echo afficheMontant($m_affiche,$total_paye); ?></td>
        
    </tfoot> 
