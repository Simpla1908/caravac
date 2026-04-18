<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
       
        <div id="page-wrapper" style=" height:auto">
        				<br>
            			<h1><b><center><?php echo strtoupper($_SESSION['nom_hotel']); ?></center></b></h1>
                                <div class="col-lg-12">
                                <h1 class="page-header">Paiement</h1>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Paiements clients logés</h4>
                                            
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                           
                                            
                                            <?php 
include '../bdd/connexion_mysql.php';
echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>Client</th>
                                                            <th>N° Chambre</th>
                                                            <th>Tarif</th>
                                                            <th>Date d\'entrée</th>
															<th>Date de sortie</th>
                                                            <th>Montant</th>
															<th>Montant payé</th>
															<th>Reste</th>
                                                            
											 <th>Etat</th>
											 <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
									
//requette_
 $compt=0;
 $tot=0;
//__requete_nbrjrs_reservation
$id_hotel=$_SESSION['id_hotel'];
$result=mysql_query("SELECT r.id_res,DATEDIFF(r.date_lib,r.date_occ) AS jrs,c.tarif_ch,c.id_ch,c.num_ch,r.date_occ,r.date_lib,z.id_client,z.nom_client,SUM(t.montant) AS montant FROM t_reservation r,t_chambre c,t_client z,t_facture f,t_reglement t WHERE r.id_ch=c.id_ch AND r.id_client=z.id_client AND r.id_res=f.id_res AND f.id_fact=t.id_fact AND c.id_hotel='$id_hotel' GROUP BY  r.id_res") or die(mysql_error());
while($rows=mysql_fetch_assoc($result)){
$id_ch=$rows['id_ch'];
$id_client=$rows['id_client'];
$id_res=$rows['id_res'];
$njrs=$rows['jrs'];
$tarif=$rows['tarif_ch'];
$num_ch=$rows['num_ch'];
$date_occ=$rows['date_occ'];
$date_lib=$rows['date_lib'];
$nom_client=$rows['nom_client'];
if($njrs==0)$njrs=1;
$montanttot=$njrs*$tarif;
$montant=$rows['montant'];
$reste=$montanttot-$montant;
$tot+=$montant; 
 $compt++;    
if($reste<=0){
                      					echo'   <tr>
                                            <td>'.$compt.'</td>
                                            <td>'.$nom_client.'</td>
                                            <td>'.$num_ch.'</td>
                                            <td class="center">'.$tarif.'&nbsp;$</td>
											<td class="center">'.$date_occ.'</td>
											<td class="center">'.$date_lib.'</td>
											<td class="center">'.$montanttot.'&nbsp;$</td>
											<td class="center">'.$montant.'&nbsp;$</td>
											<td class="center">'.$reste.'&nbsp;$</td>
											 
	<td><img src="../img/ok.png"></td>
	<td> <a onClick="document.location=\'gl_detail_paiement.php?id_res='.$rows['id_res'].'&nom_client='.$nom_client.'\'">Voir détails</a></td>										 
                                        </tr>';
	
	
	}	
	else{
		
		                      				echo'   <tr>
                                            <td>'.$compt.'</td>
                                            <td>'.$nom_client.'</td>
                                            <td>'.$num_ch.'</td>
                                            <td class="center">'.$tarif.'&nbsp;$</td>
											<td class="center">'.$date_occ.'</td>
											<td class="center">'.$date_lib.'</td>
											<td class="center">'.$montanttot.'&nbsp;$</td>
											<td class="center">'.$montant.'&nbsp;$</td>
											<td class="center">'.$reste.'&nbsp;$</td>
	<td><a title="Paiement"><img src="../img/nonok.png"></a></td>
	<td><a onClick="document.location=\'gl_detail_paiement.php?id_res='.$rows['id_res'].'&nom_client='.$nom_client.'\'">Voir détails</a></td>											 
                                        </tr>';
	
		
		
		}
	
	
	
	
	}							   
									   
				   
									   
									   
                                        
  echo'                                  </tbody>
                                </table> </div>
								<h4 style="color:red; margin-left:500px;">Total montant payé&nbsp;:&nbsp;'.$tot.'&nbsp;&nbsp;$</h4> 
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
	<?php include('gl_footer.php'); ?>
    
