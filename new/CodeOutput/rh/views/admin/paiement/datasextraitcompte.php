<?php
if (!isset($_SESSION)) {
    session_start();
 }
 $idclient=post('idclient');
 $nom_client ='';
 $requete='SELECT a.*,a.id_client,a.nom_client
           FROM  t_client  AS a, t_hotel AS b
           WHERE a.id_hotel=b.id_hotel 
           AND a.id_client=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$idclient);
        try {
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        foreach ($result as $r) {
             $nom_client = $r->nom_client;     
        }
?>

<!-- <div class="row">
     <div class="col-xs-6">
     <div class="row">
     <div class="col-xs-3">
      </div>
       <div class="col-xs-6">
      <?php 
         // echo '<img height="150" width="150" class="img-responsive" src="public/uploads/'.$_SESSION['company_logo'].'"/>';
     ?>
     </div>
      <div class="col-xs-3">
      </div>
     </div>

     </div>
    <div class="col-xs-6">
        <div class="box-body">
              <table class="table table-bordered no-border">
                <tr>
                  <td><span style="font-weight: bold;font-size:11pt;">ENTREPRISE</span></td>
                  <td>
                   : <span style="font-size:11pt;"><?php// echo  strtoupper($_SESSION['company_name']); ?></span>

                  </td>
                </tr>
                <tr>
                  <td><span style="font-weight: bold;font-size:11pt;">RCCM</span></td>
                  <td>
                   : <span style="font-size:11pt;"><?php //echo  strtoupper($_SESSION['rccm']); ?></span>


                  </td>
                </tr>
                <tr>
                  <td><span style="font-weight: bold;font-size:11pt;">Id.nat</span></td>
                  <td>
                   : <span style="font-size:11pt;"><?php //echo  strtoupper($_SESSION['idnat']); ?></span>



                  </td>
                </tr>
                <tr>
                  <td>
                   <span style="font-weight: bold;font-size:11pt;">Adresse</span>
                  </td>
                  <td>
                   : <span style="font-size:11pt;"><?php //echo  strtoupper($_SESSION['adresse_hotel']); ?></span>
                  </td>
                </tr>
                <tr>
                  <td>
                   <span style="font-weight: bold;font-size:11pt;">CLIENT </span>
                  </td>
                  <td>
                   : <span style="font-size:11pt;"><?php //echo  strtoupper($nom_client); ?></span>
                  </td>
                </tr>
              </table>
            </div>
     </div>

</div> -->
<!-- <div class="row">
    <div class="col-xs-4">

     </div>
     <div class="col-xs-4">
            <span style="font-weight: bold;font-size:18pt;"><?php //echo 'EXTRAIT DE COMPTE'; ?></span>
     </div>
     <div class="col-xs-4">
    
     </div>
</div>
<hr /> -->
<div class="row">
  <div class="col-xs-12">
     <?php
   $datedebut=dateToformatBdd(post('datedebut'));
   $datefin=dateToformatBdd(post('datefin'));
   // echo '$idclient'.$idclient;
   // echo '$datedebut'.$datedebut;
   // echo '$datefin'.$datefin;
   $sql="SELECT a.id_fact,a.num_fact,a.mont_ttc_remise,b.id_regl,b.numero,b.dte,c.montant,c.montantusd,c.montantcdf,c.taux,d.id_mode_regl,d.lib,e.id_client,e.nom_client,c.justification
         FROM t_facture AS a, t_reglement AS b, paiement AS c,t_mode_reglement AS d, t_client AS e
         WHERE  a.id_fact=b.id_fact
               AND b.id_regl=c.regl_id
               AND c.id_mode_regl=d.id_mode_regl
               AND e.id_client=a.id_client
               AND a.type='facturation'
               AND b.dte BETWEEN :datedebut AND :datefin
               AND e.id_client=:id_client
               AND a.id_hotel=:id_hotel
               ORDER BY b.dte,a.num_fact ASC";
        $requete = HDB::hus()->prepare($sql);
        $requete->BindParam(':datedebut',$datedebut);
        $requete->BindParam(':datefin',$datefin);
        $requete->BindParam(':id_client',$idclient);
        $requete->BindParam(':id_hotel',$_SESSION['idsite']);
        try {
          $requete->execute();
          $result=$requete->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
  // var_dump($result);
     $_SESSION['idclient_extrcompte']=$idclient;
     $_SESSION['dte1_extrcompte']=dateAffiche($datedebut);
     $_SESSION['dte2_extrcompte']=dateAffiche($datefin);
?>
<table data-page="false" class="table table-bordered table-hover table-striped table-condensed" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE;?>" data-page-previous-text="<?php echo LANG_PREVIOUS;?>" data-page-next-text="<?php echo LANG_NEXT;?>">
  <thead>
    <tr>
      <th>#</th>
      <th>Date</th>
      <th>N° Facture</th>
    <th data-hide="phone,tablet">N° Réçu</th>
    <th data-hide="phone,tablet">Débit</th>
    <th data-hide="phone,tablet">Crédit</th>
    <th data-hide="phone,tablet">Observation</th>
  </tr>
  </thead>
  <tbody> 
 <?php
 //Mise en session pour impression
 $_SESSION['rows_extrcompte'] = array();
  $_SESSION['rows_extrcompte']['i'] = array();
 $_SESSION['rows_extrcompte']['date'] = array();
 $_SESSION['rows_extrcompte']['num_facture'] = array();
 $_SESSION['rows_extrcompte']['num_recu'] = array();
 $_SESSION['rows_extrcompte']['debit'] = array();
 $_SESSION['rows_extrcompte']['credit'] = array();
 $_SESSION['rows_extrcompte']['observ'] = array();
 //Fin mise en session
 $tdebit=0;
 $tcredit=0;
 $i=1;
 if(!empty($result)){
  $_SESSION['facture_ids'] = array();
  $_SESSION['facture_ids']['id'] = array();
  foreach ($result as $rows) {
  $debit=0;
  $credit=0;
  if (!in_array($rows->id_fact, $_SESSION['facture_ids']['id'])) {
  array_push($_SESSION['facture_ids']['id'],$rows->id_fact);
  $debit=montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux,$rows->mont_ttc_remise);
  }
  $credit=montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux,$rows->montant);
  $tdebit+=$debit;
  $tcredit+=$credit;
  ?>
  <tr>
     <td><?php echo $i;?></td>
  <td><?php echo dateAffiche($rows->dte);?></td>
  <td><?php echo $rows->num_fact;?></td>
  <td><?php echo $rows->numero;?></td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $debit);?></td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $credit);?></td>
  <td><?php echo $rows->justification;?></td>
  </tr>
 <?php
 //Mise en session pour impression
 array_push($_SESSION['rows_extrcompte']['i'],$i);
  array_push($_SESSION['rows_extrcompte']['date'],dateAffiche($rows->dte));
  array_push($_SESSION['rows_extrcompte']['num_facture'], $rows->num_fact);
  array_push($_SESSION['rows_extrcompte']['num_recu'], $rows->numero);
  array_push($_SESSION['rows_extrcompte']['debit'], afficheMontant($_SESSION['Paie_affiche'], $debit));
  array_push($_SESSION['rows_extrcompte']['credit'],afficheMontant($_SESSION['Paie_affiche'], $credit));
  array_push($_SESSION['rows_extrcompte']['observ'],$rows->justification);
  //Fin mise en session
    $i++;

}
 
}
       
?>
  </tbody>
<tfoot>
          <tr>
          <th colspan="4">Total</th>
           <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$tdebit);?></td>
          <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$tcredit);?></td>
          <td></td>
          </tr>
          <tr>
          <th colspan="5">Solde</th>
           <td>
            <strong>
            <?php 
            $solde=$tdebit-$tcredit;
           echo afficheMontant($_SESSION['Paie_affiche'],$solde);
           ?>
         </strong>

         </td>
         <td></td>

          </tr>
        </tfoot>
</table>
<?php 
    //Mise en session pour impression
    $_SESSION['datedebut']=post('datedebut');
    $_SESSION['datefin']=post('datefin');
    $_SESSION['tdebit']=afficheMontant($_SESSION['Paie_affiche'],$tdebit);
    $_SESSION['tcredit']=afficheMontant($_SESSION['Paie_affiche'],$tcredit);
    $_SESSION['solde']=afficheMontant($_SESSION['Paie_affiche'],$solde);
    //Fin mise en session
?>
</div>
</div>
