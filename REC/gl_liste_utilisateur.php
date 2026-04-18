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
    $_SESSION['nbre_user']=$nbre_user;
}


 ?>
<?php include('menu_Rec_config.php'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Utilisateurs</h3>
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
                            <?php if (in_array('CVU',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                            <a href="gl_liste_utilisateur.php" class="btn btn-default" title="Vue Liste"><i class="fa fa-bars"></i></a>
                            <?php }?>
                                <?php if (in_array('CAU',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                            <a href="gl_ajouter_utilisateur_form.php" class="btn btn-default" title="Vue Formulaire"><i class="fa fa-edit"></i></a>
                            <?php }?>
                        </div>
                    </h4>
<!--                    <div style="margin-top:-45px; margin-left:870px;"><a class="btn btn-default btn-lg btn-block" href="../html2pdf/examples/imprime_liste_utilisateur.php" target="_blank" style="width:130px;"><img src="../img/print.png">&nbsp;Imprimer</a></div>-->
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $user = new Utilisateur('', '', '', '', '', '', 0, 0);
                        $user->lister_utilisateur();
                        ?>

                    </div>
                    <!-- /.table-responsive -->
                    <!--<div style="margin-top:-20px; margin-left:720px; width:200px;"><h4>Total Général&nbsp;:&nbsp;<b>44500 $</b></h4></div>-->

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


