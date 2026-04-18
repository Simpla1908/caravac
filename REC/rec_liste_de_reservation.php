<?php 
	
	// Inclusion du fichier contenant la connexion à la base
	require '../bdd/connexion.php';
	include('Receptionniste.php');
	include('headerRec.php'); 
	include('menu_Rec.php'); 
?>
        <div id="page-wrapper" style="height:1500px;">
        				<br>
                                <div class="col-lg-12">
                                <h3 class="page-header">Réservations</h3>
                                    <div class="panel panel-default">
                                    	
                                        <div class="panel-heading">
                                            <h4>Liste des réservations</h4>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Réservation N°</th>
                                                        <th>Nom du Client</th>
                                                        <th>Date prévue d'arrivée </th>
                                                        <th>Date prévue de sortie </th>
                                                        <th>Etat</th>           
                                                        <th align="center">Actions</th>
                                                    </tr>
                                                </thead>
                                    			<tbody>
                                                <?php 
												$type='reservation';
													/* Recuperation du paiement d'un client */
												$requete_reserv = $bdd->prepare("SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.date_occ, b.date_lib, b.statut_res FROM t_client AS a, t_reservation AS b WHERE a.id_client=b.id_client AND b.type=:type ORDER BY b.id_res DESC");
												$requete_reserv->BindParam(':type', $type);
												$requete_reserv->execute();
												while ($donnees = $requete_reserv->fetch()) 
												{
													$id_client=$donnees['id_client'];
													$nom_client=$donnees['nom_client'];
													$id_res=$donnees['id_res'];
													$num_reserv=$donnees['num_reserv'];
													$date_occ=$donnees['date_occ'];
													$date_lib=$donnees['date_lib'];
													$statut_res=$donnees['statut_res'];
													
													$date_occ1=explode('-',$date_occ);
													$date_occ1_Heure=explode(' ',$date_occ1[2]);
												
													$date_occ_expl=$date_occ1_Heure[0].'/'.$date_occ1[1].'/'.$date_occ1[0].' '.$date_occ1_Heure[1]; 
													
													$date_lib1=explode('-',$date_lib);
													$date_lib1_Heure=explode(' ',$date_lib1[2]);
												
													$date_lib_expl=$date_lib1_Heure[0].'/'.$date_lib1[1].'/'.$date_lib1[0].' '.$date_lib1_Heure[1]; 
                                                ?>
												<?php 
													//Récuperation seulement du date occ 
													$date_occ_test1=explode(' ',$date_occ);
													$date_occ_test=$date_occ_test1[0];
													
													if((date('Y-m-d H:i:s')<$date_occ)&&($statut_res=='operationnel')){
												?>
                                                        
                                                    <tr style="color:#4949fa;">
                                                        <td><?php echo $num_reserv;?></td>
                                                        <td><?php echo $nom_client;?></td>
                                                        <td><?php echo $date_occ_expl;?></td>   
                                                        <td><?php echo $date_lib_expl; ?></td>
                                                        <td><?php echo 'Opérationnelle';?></td>
                                                        <td>
                                                        	<a href="rec_reservation_multiple.php?hebergement=2" title="Effectuer l'occupation"><i class="fa fa-sign-in"></i></a>&nbsp;&nbsp;&nbsp;
                                                            
                                                            <a href="rec_detail_reservation_client.php?num_reserv=<?php echo $num_reserv;?>" title="Afficher le detail"><i class="fa fa-tasks fa-fw"></i></a>
                                                            &nbsp;&nbsp;
                                                            
                                                            <form role="form" method="post" action="Traitement_reservation/annulation_reservation.php">
                                                            <input name="id_res" id="id_res" type="hidden" value="<?php echo $id_res; ?>" />
                                                            <div style="margin-left:62px; margin-top:-23px;">
                                                            <button  name="annuler" id="annuler" type="submit" class="btn btn-danger" title="Annuler"><i class=" fa fa-pause"></i></button>
                                                            </div>
                                                            </form>
                                                      	</td>
                                                    </tr>
                                                  <?php 
													}else if((date('Y-m-d H:i:s')<$date_occ)&&($statut_res=='annulee')){
												  ?>
                                                  	
                                                	<tr style="color:#dd4f43;">
                                                        <td><?php echo $num_reserv;?></td>
                                                        <td><?php echo $nom_client;?></td>
                                                        <td><?php echo $date_occ_expl;?></td>   
                                                        <td><?php echo $date_lib_expl; ?></td>
                                                        <td><?php echo 'Annulée';?></td>
                                                        <td>
                                                        	<i class="fa fa-sign-in"></i> &nbsp;&nbsp;
                                                            <a href="rec_detail_reservation_client.php?num_reserv=<?php echo $num_reserv;?>" title="Afficher le detail"><i class="fa fa-tasks fa-fw"></i></a>
                                                            &nbsp;&nbsp;
                                                            <button disabled="disabled" name="annuler"  id="annuler" type="submit" class="btn btn-danger" title="Annuler"><i class=" fa fa-pause"></i></button>
                                                      	</td>
                                                    </tr>
                                                    <?php 
													}else if((date('Y-m-d H:i:s')<$date_occ)&&($statut_res=='effectuee')){
												   ?>
                                                   
                                                   		<tr style="color:#dd4f43;">
                                                        <td><?php echo $num_reserv;?></td>
                                                        <td><?php echo $nom_client;?></td>
                                                        <td><?php echo $date_occ_expl;?></td>   
                                                        <td><?php echo $date_lib_expl; ?></td>
                                                        <td><?php echo 'Effectée';?></td>
                                                        <td>
                                                        	<i class="fa fa-sign-in"></i> &nbsp;&nbsp;
                                                            <a href="rec_detail_reservation_client.php?num_reserv=<?php echo $num_reserv;?>" title="Afficher le detail"><i class="fa fa-tasks fa-fw"></i></a>
                                                            &nbsp;
                                                            <button disabled="disabled" name="annuler"  id="annuler" type="submit" class="btn btn-danger" title="Annuler"><i class=" fa fa-power-off"></i></button>
                                                      	</td>
                                                    </tr>
                                                   
                                                   <?php 
													}
												   ?>
                                                
                                                    
                                                    <?php
														//$i++;
														}
												/* Fin de la Recuperation du paiement d'un client */
													?>
                                            	</tbody>
                                            </table>
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
    
