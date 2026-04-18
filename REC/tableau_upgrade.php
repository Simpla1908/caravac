 <?php 
 session_start ();
 include("../bdd/connexion.php"); 
 include("../admin/traitement/fonctionalites.php"); 
 include '../FUNCTION/hebergement.php';
 $id=$_GET['id'];
 $lib=$_GET['lib'];
 $type="mensuel";
 $nbrejr=1;
 $dtepaie=AddMonthToDate(date('Y-m-d'),$nbrejr);
 $dtepaie=dateAffiche($dtepaie);
 $result =LigneSouscription2($id,$type,$bdd);
//var_dump($result);
 ?>
 <div class="feature-2">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> <b>EBU - Upgrade</b> <span class="fa fa-external-link"></span></h4>
Migrer à une souscription payante pour bénéficier de toutes nos meilleures fonctionnalités.<br>
</div>
                <div class="modal-body">
 <form method="post" action="Traitement/upgrade_traitement.php" data-parsley-validate class="form-horizontal form-label-left" name="frmvldupgrade">

 <div class="row">

    <div class="form-group">
       <input value="<?php echo $id;?>" type="hidden" id="id" name="id">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="module">Designation :
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input value="<?php echo $lib;?>" type="text" id="designation" name="designation" required disabled="disabled" class="form-control col-md-7 col-xs-12">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mode Souscription : 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control col-md-7 col-xs-12" id="mode_souscription" name="mode_souscription">
                <option value="mensuel">Mensuel</option>
                <option value="annuel">Annuel</option>
            </select>
        </div>
    </div>
    <!-- Table row -->
    <!--<div class="row">-->
    <div class="col-xs-12 table-responsive">
        <br>
        <table class="table table-striped table-bordered table-condensed" id="tabmajupgrad">
            <thead>
                <tr>
                    <th>Designation</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody >
                 <?php
                 $tot=0;
                 $maffiche='USD';
                foreach ($result as $r) {                
                ?>
                <tr>
                    <td><?php echo $r->libelle;?></td>
                    <td>1</td>
                    <td><?php echo afficheMontant($maffiche,$r->prix_user);?></td>
                    <td><?php echo afficheMontant($maffiche,$r->prix_user);?></td>
                </tr>
                  <?php
                   $tot=$tot+$r->prix_user;
                 }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Montant Total:</th>
                    <td>
                        <input value="<?php echo $tot;?>" type="hidden" id="tot" name="tot">
                        <?php echo afficheMontant($maffiche,$tot);?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.col -->
    <!--</div>-->
    <!-- /.row -->
    <div class="col-xs-12">
        <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Une facture vous sera envoyé le <?php echo $dtepaie; ?>
            <br>
            <b>NB:</b> Vous avez 7 jours de regularisation de la reception de cette facture. Depasser cette date, votre compte sera desactivé. Merci !!!
        </div>
    </div>

</div>

 </form>
  </div>
    <div class="modal-footer btn-center">
        <button type="submit" name="valider_upgrade" id="valider_upgrade" class="btn btn-success"><i class="fa fa-external-link"></i> Upgrade </button>
    </div>
