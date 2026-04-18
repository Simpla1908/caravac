<?php include('Gerant_local.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('./menu_Rec_config.php');
if (isset($_GET['id_hotel'])) {
 $id_hotel=$_GET['id_hotel'];
}  else {
  //$id_hotel=0;
}?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Chambres</h3>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Liste de chambres
<!--                        <a class="btn btn-primary btn-xs pull-right"  href="#?id_hotel=--><?php //echo $id_hotel;?><!--&module=MH"><i class="fa fa-print"></i> Imprimer</a>-->
                        <a class="btn btn-primary btn-xs pull-right"  href="gl_ajout_chambre.php?module=MH"><i class="fa fa-plus-circle"></i> Ajouter</a>
                    </h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <?PHP
                        $ch = new chambre(0,'', 0,'','', '', '', 0, 0, 0, 0);
                        if(isset($_GET['id_ch'])){
                         $id_ch=$_GET['id_ch'];
                        $ch->delchambre($id_ch);
                        }   
                        $ch->consulterchambre($id_hotel);
                        ?>
                        <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>  <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
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
