<?php include('Receptionniste.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); 

if (isset($_GET['id_ch']) && isset($_GET['num_ch'])) {
    $id_ch=$_GET['id_ch'];
    $num_ch=$_GET['num_ch'];
}
?>
 <!-- Modal -->
<form action="" method="post" target="_blank">
<div class="modal fade" id="myM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 >Reclamation</h3>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer cet élément ?</p>
            </div>
            <div class="modal-footer">
                 <a href="#" class="btn" id="confirmModalNo">Non</a>
            <a href="#" class="btn btn-primary" id="confirmModalYes">Oui</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</form>
<div id="page-wrapper" style=" height:650px;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Réclamations view detail</h3>
            <div class="panel panel-default">

                <div class="panel-heading">
                    Les réclamations: Chambre <a href="#"><?php echo strtoupper($num_ch);?></a>
                        <a class="btn btn-primary btn-xs pull-right"  href="reclamations_view.php"><i class="fa fa-reply-all"></i> &nbsp;Retour</a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Réclamations</th>
<!--                                <th>Statut</th>-->
                                <th align="center">Utilisateur</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    $i=1;
                    include '../bdd/connexion.php';

                    $requete = $bdd->prepare("SELECT * FROM t_suggestion AS su, t_utilisateur AS ut
                                            WHERE su.id_util=ut.id_user 
                                            AND chambre_id=:id_ch AND hotel_id=:hotel_id ORDER BY su.datesug");
                    $requete->BindParam(':id_ch', $id_ch);
                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                    $requete->execute();
                    $operation_sug = $requete->fetchAll(PDO::FETCH_OBJ);
                    
                    
                    foreach ($operation_sug  as $sug):
                        $date_occ1 = explode('-', $sug->datesug);
                        $date_occ1_Heure = explode(' ', $date_occ1[2]);
                        $date_occ_expl = $date_occ1_Heure[0] . '/' . $date_occ1[1] . '/' . $date_occ1[0].' '.$date_occ1_Heure[1] ;
                       
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $date_occ_expl; ?></td>
                        <td>
                            <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $i; ?>" aria-expanded="false" aria-controls="collapseTwo">
                          Lire réclamation
                        </a>
                        <div id="collapseTwo<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                            <p>
                                <?php echo $sug->textsug; ?>
                            </p>
                          </div>
                        </div>
                            
<!--                        <a class="label label-warning confirmModalLink" data-toggle="modal" data-target="#myM">Entier</a>-->
                        
                        </td>
<!--                        <td><span class="label label-warning"><?php // echo $sug->statut; ?></span> Résoudré <input type="checkbox" name="hobbies[]" id="hobby1" /></td>-->
                        <td><?php echo $sug->nom_user.' '.$sug->prenom_user; ?></td>
                    </tr>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                  </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-modal.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });

</script>
