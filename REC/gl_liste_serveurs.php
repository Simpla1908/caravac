<?php
include('Gerant_local.php');

?>
<?php include('head.php');
$requete = $bdd->prepare("SELECT nbre_user,nbre_user_add,state_paie_user FROM t_hotel WHERE id_hotel=:id_hotel");
$requete->BindParam(':id_hotel', $id_hotel);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $op) {
    $nbre_user = $op->nbre_user;
    $_SESSION['nbre_user'] = $nbre_user;
}

//Serveurs
$requete = $bdd->prepare("SELECT * FROM serveurs WHERE site_id=:site_id AND psedo=0 ORDER BY nom");
$requete->BindParam(':site_id', $id_hotel);
$requete->execute();
$serveurs = $requete->fetchAll(PDO::FETCH_OBJ);

?>
<?php include('menu_Rec_config.php'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Serveurs</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Liste
                        <div class="btn-group  btn-group-sm pull-right">
                            <?php if (in_array('CAU', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                <a href="serveurcreate.php" class="btn btn-default" title="Vue Formulaire"><i class="fa fa-plus"></i> Ajouter</a>
                            <?php } ?>
                        </div>
                    </h4>
                    <!--                    <div style="margin-top:-45px; margin-left:870px;"><a class="btn btn-default btn-lg btn-block" href="../html2pdf/examples/imprime_liste_utilisateur.php" target="_blank" style="width:130px;"><img src="../img/print.png">&nbsp;Imprimer</a></div>-->
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Sexe</th>
                                    <th>Telephone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($serveurs as $s) : ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $s->nom ?></td>
                                        <td><?php echo $s->prenom ?></td>
                                        <td><?php echo $s->sexe ?></td>
                                        <td><?php echo $s->tel ?></td>
                                        <td>
                                            <a href="serveurupdate.php?id=<?php echo $s->id ?>" class="btn btn-primary btn-xs" title="Modifier">
                                                <i class="fa fa-edit fa-fw"></i> Modifier
                                            </a>
                                            <a id="<?php echo $s->id ?>" title="Supprimer" class="btn btn-danger btn-xs confirmModalserveur" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <i class="fa fa-warning fa-fw"></i> Suppression
            </div>
            <div class="modal-body">
                <input value="" name="serveur_id"  id="serveur_id" type="hidden">
                <h4>Etes-vous sûr de vouloir supprimer cet élément ?</h4>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="confirmModalYesServeur">Oui</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /#wrapper -->
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
    $(document).ready(function() {
        $('#dataTables-example').dataTable();

        $(".confirmModalserveur").click(function(e) {
            var id=$(this).attr('id');
            $('#serveur_id').val(id);
           
        });

        $("#confirmModalYesServeur").click(function(e) {
            var id= $('#serveur_id').val();
            $.ajax({
                url: 'utilisateur/delete_serveur.php?id='+ id,
                type: 'POST',
                success: function(html) {
                    $("#myModal").modal("hide");
                    window.location.href = "gl_liste_serveurs.php"; 
                }
            });
        });
    });
</script>
</body>

</html>