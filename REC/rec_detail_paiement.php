<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); 
			include '../bdd/connexion_mysql.php';
			$nom_client=$_GET['nom_client'];
			$id_res=$_GET['id_res'];

			?>
       
        <div id="page-wrapper" style=" height:auto">
        				<br>
            			<h1><b><center><?php echo strtoupper($_SESSION['nom_hotel']); ?></center></b></h1>
                                <div class="col-lg-12">
                                <h1 class="page-header">Détails Paiement</h1>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Client(e)&nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $nom_client;?></b></h4>
                                            
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                           
                                            
                                            <?php 
echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>N°Facture</th>
                                                            <th>Montant</th>
                                                            <th>Mode règlement</th>
                                                            <th>Date</th>
														
                                                            
                                      
                                        </tr>
                                    </thead>
                                    <tbody>';
									
//requette_
 $compt=0;
 $tot=0;
//__requete_nbrjrs_reservation
$id_hotel=$_SESSION['id_hotel'];
$result=mysql_query("SELECT f.num_fact,t.montant,m.lib,t.date_regl FROM t_reservation r,t_facture f,t_reglement t,t_mode_reglement m WHERE r.id_res=f.id_res AND t.id_fact=f.id_fact AND t.id_mode_regl=m.id_mode_regl AND r.id_res='$id_res'") or die(mysql_error());
while($rows=mysql_fetch_assoc($result)){

 $compt++;    
$tot+=$rows['montant'];
                      					echo'   <tr>
                                            <td>'.$compt.'</td>
                                            <td>'.$rows['num_fact'].'</td>
                                            <td>'.$rows['montant'].'</td>
                                            <td class="center">'.$rows['lib'].'</td>
											<td class="center">'.$rows['date_regl'].'</td>
											
                                        </tr>';
	}	
	
                                        
  echo'                                  </tbody>
                                </table> </div>
								<h4 style="color:red; margin-left:300px;">Montant total&nbsp;&nbsp;:&nbsp;&nbsp;'.$tot.'&nbsp;&nbsp;$</h4>
								';
?>
                                        
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
	<?php include('rec_footer.php'); ?>
    
