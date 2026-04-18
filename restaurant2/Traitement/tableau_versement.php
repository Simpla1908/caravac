<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

?>

<div class="box-header">
    <div class="col-md-9">
        <h3 class="box-title">
            Liste de versements
        </h3>
    </div>
    <div class="col-md-3">
        <div class="btn-group  btn-group-sm">
            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModalfiltrV" title="Filtrer la liste" >
                <i class="fa fa-hourglass-half"></i> Filtrer
            </a>
            <?php if (in_array('ER',$_SESSION['actions']['code_actions'])) { ?>
                <!--                            <a href="rec_reservation_multiple.php?hebergement=1" class="btn btn-success" title="Editer une Réservation" >
                                                <i class="fa fa-edit"></i>
                                            </a>-->
            <?php } ?>
           <?php if (in_array('AR9',$_SESSION['actions']['code_actions'])){?>     
            <a id="" href="#" class="btn btn-primary"  data-toggle="modal" data-target="#myModal_versement">
                <i class="fa fa-money"></i> Verser
            </a>
            <?php } ?>
            <?php if (in_array('ILR',$_SESSION['actions']['code_actions'])){?>
                <!--                            <a id="impression" href="#" class="btn btn-primary" title="Imprimer la liste">
                                                <i class="fa fa-print"></i> Imprimer
                                            </a>-->
            <?php } ?>
        </div>
    </div>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
            <th>#</th>
            <th>Utilisateur</th>
            <th>Date</th>
            <th>Montant versé USD</th>
            <th>Montant versé CDF</th>
            <th>Solde USD</th>
            <th>Solde CDF</th>
            <th>Etat</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="tb_contenu">
        <?php include('./dataversement.php'); ?>
        </tbody>
    </table>

</div>
<!-- /.box-body -->
<!-- Modal -->
<div class="modal fade" id="myModalfiltrV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel">Filtrage liste </h5>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6 form-group">
                                <label>Période du&nbsp;:</label>
                                <input class="form-control" id="datedebut" name="datedebut" required="required" value="<?php echo date('d/m/Y'); ?>">
                            </div>
                            <!-- /.col-lg-6 -->
                            <div class="col-lg-6 form-group">
                                <label>au&nbsp;:</label>
                                <input class="form-control" id="datefin" name="datefin" required="required" value="<?php echo date('d/m/Y'); ?>">
                            </div>
                            <!-- /.col-lg-6 -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary" id="btn_vers" data-dismiss="modal">&nbsp;Valider</button>
                     <span class="btn btn-danger hidden" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                     </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
include('./popup_versement.php');
?>
<!-- Date time picker -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datedebut').datetimepicker({format: 'd/m/Y'});
    $('#datefin').datetimepicker({format: 'd/m/Y'});
</script>
