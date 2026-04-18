			<?php include('Gerant_local.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec_config.php'); ?>

        <div id="page-wrapper">        
              <div class="row">
                <div class="col-lg-12">
                 <h3 class="page-header">Niveau ou Etage des chambres</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                Liste des niveaux
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="ajout_niveau.php?module=MH" class="btn btn-default" title="Ajouter un niveaux"><i class="fa fa-plus-circle"></i> Ajouter</a>
                                </div>
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="post" action="#">
								 <?PHP
                                    $niv= new Niveau("",$id_hotel);
                                    if(isset($_GET['id_niv'])){
                                     $id_niv=$_GET['id_niv'];
                                    $niv->delniveau($id_niv);
                                    }   
                                    $niv->consulterniveau($id_hotel);								
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

   <?php include('gl_footer.php'); ?>
