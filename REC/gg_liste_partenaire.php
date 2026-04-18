			
<?php 
include('Gerant_global.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec_config.php'); ?>

        <div id="page-wrapper">
               <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Partenaires</h3>
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
                                                    <?php if (in_array('CAP',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                                                        <a href="gg_ajout_partenaire_hotel.php" class="btn btn-default" title="Ajouter Partenaire"><i class="fa fa-plus-circle"></i> Ajouter Partenaire</a>
                                                    <?php } ?>
                                                        <a href="impression/imprime_liste_partenaire.php" target="_blank" class="btn btn-default" title="Imprimer"><i class="fa fa-print"></i> Imprimer</a>
                                                </div>
                                            </h4>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <form method="post" action="gl_del_multi_utilisateur.php">
                                            <?php
                                                $responsable=new Partenaire("x","0","g","f","f");
                                                $responsable->consulterPartenaire();							
                                            ?>
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
    });
    </script>
</body>

</html>