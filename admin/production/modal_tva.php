<!-- Modal -->
<?php
include('../../bdd/connexion.php');
$tva=0;
$requete = $bdd->prepare("SELECT tva FROM reglage_systeme");
$requete->execute();
$parametres= $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($parametres as $p) {
$tva=$p->tva;
    }
?>
<form action="../parametrage/majtva.php" method="post" id="form_tva" name="form_tva">
    <div class="modal fade" id="myModaltva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel"><strong>MISE A JOUR TVA</strong></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                                <input required="required" class="form-control" id="tvaval" name="tvaval" value="<?php echo $tva;?>">
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="maj_tva"><i class="fa fa-print fa-fw"></i>&nbsp;Valider</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>