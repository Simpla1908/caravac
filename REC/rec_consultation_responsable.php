			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); 
			$idhotel=1;
			
			?>
            
        <div id="page-wrapper">
        				<br>
            		<h1><b><center>KA-BE DE LUXE LIMETE</center></b></h1>
                      
                        <div class="row">
                <div class="col-lg-12">
                 <h1 class="page-header">Responsables</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <table width="1150" border="0">
  <tr>
    <td width="700"><h4>Liste des responsables</h4></td>
    <td width="225"  align="right"><a class="btn btn-default btn-lg btn-block" href="rec_ajout_responsable.php" style="width:100px;">Ajouter</a></td>
    <td width="225" align="center"> <a class="btn btn-default btn-lg btn-block"  href="#" style="width:100px;">Imprimer</a></td>
  </tr>
</table>

                            
                                            
                                 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="post" action="">
						 <?PHP
                        
                        $rec= new Responsable('','','',0);
                        $rec->consulterresponsable($idhotel);								
                        ?>
                           
                       
                          <div class="well">
                                
                                <button  type="submit" class="btn btn-default btn-lg btn-block" target="_blank"><img src="../img/drop.png">&nbsp;&nbsp;Supprimer pour la selection</button>
                               
                                <a class="btn btn-default btn-lg btn-block" target="_blank"   href=""><i class="fa fa-trash-o"></i>&nbsp;&nbsp;Supprimer tout</a>
                                
                            </div>
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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
</body>

</html>
