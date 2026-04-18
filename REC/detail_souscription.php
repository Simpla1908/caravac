 <?php 
 session_start ();
 include("../bdd/connexion.php"); 
 include("../admin/traitement/fonctionalites.php"); 
 include '../FUNCTION/hebergement.php';
 $id=$_GET['id'];
 $lib=$_GET['lib'];
 $type=$_GET['type'];
 $dtesous=$_GET['dtesous'];
 $statut=$_GET['statut'];
 $libstatut='Demo';
 if($statut=='abonne'){
 $libstatut='Abonné';
 }elseif($statut=='desactive'){
 $libstatut='Desactivé';
 }
 $result =LigneSouscription($id,$bdd);
 ?>
 <div class="feature-2">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> <b>Souscription  <?php echo $lib;?></b></h4>
<label class="control-label col-xs-12" align="left">Statut : <?php echo $libstatut;?></label>
<label class="control-label col-xs-12" align="left">Date  : <?php echo $dtesous;?> </label>
<label class="control-label col-xs-12" align="left">Mode Souscription : <?php echo $type;?></label>
<br>
<br>
<br>
</div>
<div class="modal-body">
 <div class="row">
    <!-- Table row -->
    <!--<div class="row">-->
    <div class="col-xs-12 table-responsive">
        <br>
        <table class="table table-striped table-bordered">
           <thead>
                <tr>
                    <th>Pack/Module</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody >
                 <?php
                 $tot=0;
                 $maffiche='USD';
                 $prix_pack=0;
                foreach ($result as $r) { 
                $data=ReturnPrixPack($r->id,$type,$bdd);    
                $prix_pack=$data['prix_user'];       
                ?>
                <tr>
                    <td><?php echo $r->libelle;?></td>
                    <td>1</td>
                    <td><?php echo afficheMontant($maffiche,$prix_pack);?></td>
                    <td><?php echo afficheMontant($maffiche,$prix_pack);?></td>
                </tr>
                  <?php
                   $tot=$tot+$prix_pack;
                 }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Montant Total:</th>
                    <td>
                        <?php echo afficheMontant($maffiche,$tot);?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
  </div>
