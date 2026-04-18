			<?php include('Gerant_local.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('./menu_Rec_config.php'); ?>

        <div id="page-wrapper">        
              <div class="row">
                <div class="col-lg-12">
                 <h3 class="page-header">Categorie</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                Liste des Categories
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="ajout_categorie.php?module=MH" class="btn btn-default" title="Ajouter une categorie"><i class="fa fa-plus-circle"></i> Ajouter</a>
                                </div>
                            </h4>
			</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="post" action="#">
				 <?PHP
                                    $cat= new categorie("",$id_hotel);
                                    if(isset($_GET['id_cat'])){
                                     $id_cat=$_GET['id_cat'];
                                    $cat->delcategorie($id_cat);
                                    }   
                                    $cat->consultercategorie($id_hotel);								
                                 ?>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>  <!-- /.row -->
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
<script src="js/script.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
</body>

</html>

