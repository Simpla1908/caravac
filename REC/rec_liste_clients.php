<?php include('Receptionniste.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Clients</h3>
            <div  class="alert alert-success alert-dismissable msg_sup" style="display:none;">
                La suppression s'est effectué avec succès!
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                        <i class="fa fa-list"></i> Liste de clients
                        <?php if (in_array('IMPRCLI',$_SESSION['actions']['code_actions'])){?>
                    <a class="btn btn-primary btn-xs pull-right"  href="impression/imprime_liste_client.php" target="_blank"><i class="fa fa-print"></i> Imprimer</a>
                    <?php }?>
                    <?php if (in_array('AJTCL',$_SESSION['actions']['code_actions'])) { ?>
<!--                    <a class="btn btn-primary btn-sm pull-right"  href="rec_ajout_client.php"><i class="fa fa-plus-circle"></i> Ajouter</a>
-->                    <?php } ?>
                    
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <form method="post" action="">
                        <?PHP
//                        $cl = new Client('', '', '', '', '', '', 0, 0, '', '', '', '', 0, 0);
//                        $cl->consulterclient($id_hotel)
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Clients</th>
                                        <th>Respo.</th>
                                        <th>Sexe</th>
                                        <th>Etat civil</th>
                                        <th>Adresse</th>
                                        <th>Tél</th>
                                        <th>Email</th>         
                                        <th align="center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_contenu" class="table_occup_prev">
                                    <?php include('data_liste_client.php'); ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
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
<!-- /#wrapper -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    //Suppression sortie
        var id;
        $(".confirmModalLink1").click(function (e) {
            e.preventDefault();
    //        alert('ff');
            id = $(this).attr("id");
    //        alert(id);
    //        $("#myModal").modal("show");
        });
    $("#confirmModalNo").click(function (e) {
        $(".myModal").modal("hide");
    });
    $("#confirmModalYes").click(function (e) {
        $.ajax({
            url: 'Traitement/suppression_client.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $(".myModal").modal("hide");
                $(".msg_sup").show().fadeOut(8000);
                $("#tb_contenu").load('data_liste_client.php');
                
            }
        });
        
//window.location.href ="approvisionnement_view.php?operation=appro";

    });
</script>
<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

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


</body>

</html>

