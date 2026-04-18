			
			
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
             <?php
			include '../bdd/connexion_mysql.php';
				$result=mysql_query("SELECT COUNT(c.id_ch) as cho FROM  t_chambre c WHERE c.occupe='oui' ORDER BY c.id_ch ASC") or die(mysql_error());		
				while($rows=mysql_fetch_assoc($result))$cho=$rows['cho'];
			?>

        <div id="page-wrapper">
        				<br>
            		<h1><b><center><?php echo strtoupper($_SESSION['nom_hotel']); ?></center></b></h1>
                      
                        <div class="row">
                <div class="col-lg-12">
                 <h1 class="page-header">Chambres occupées</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <table width="1150" border="0">
  <tr>
    <td width="700"><h4>Liste des chambres occupées&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;<span style="color:red;"><b><?php echo $cho;?></b></span>&nbsp;)</h4></td>
    
    
  </tr>
</table>

                 <div style="margin-top:-45px; margin-left:880px;"><a class="btn btn-default btn-lg btn-block" href="#" style="width:130px;"><img src="../img/print.png">&nbsp;Imprimer</a></div>              

                                            
                                 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           
						 <?PHP
                        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Numéro</th>
											<th>Tarif</th>
											 <th>Date occupation</th>
                                            <th>Noms client</th>
											 <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>';
									
//requette_
 $compt=0;
$result=mysql_query("SELECT c.id_ch,c.num_ch,c.tarif_ch,s.id_client,s.nom_client,o.date_occ FROM  t_chambre c,t_client s,t_occupation o WHERE c.id_hotel='$id_hotel' AND c.id_ch=o.id_ch AND s.id_client=o.id_client AND c.occupe='oui' ORDER BY o.id_occ ASC") or die(mysql_error());
while($rows=mysql_fetch_assoc($result)){
$compt++;	
echo'                                        <tr>
                                           <td>'.$compt.'</td>
                                            <td>'.$rows['num_ch'].'</td>
                                            <td>'.$rows['tarif_ch'].'&nbsp;$</td>
											<td>'.$rows['date_occ'].'</td>
                                            <td >'.$rows['nom_client'].'</td>
                                             <td class="center"><a onClick="document.location=\'rc_liberation_chambre_.php?id_ch='.$rows['id_ch'].'&id_client='.$rows['id_client'].'&nom_client='.$rows['nom_client'].'&num_ch='.$rows['num_ch'].'\'"><i class="fa fa-edit fa-fw"></i>&nbsp;&nbsp;Libérer</a>
											 
											 </td>
                                        </tr>';}
                                       
                                        
  echo'                                  </tbody>
                                </table> </div>';
																
                        ?>
                           
                       
                     
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
