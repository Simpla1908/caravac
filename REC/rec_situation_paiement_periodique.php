<?php 
	
	// Inclusion du fichier contenant la connexion à la base
	require '../bdd/connexion.php';
	include('Receptionniste.php');
	include('headerRec.php'); 
	include('menu_Rec.php'); 
?>
        <div id="page-wrapper" style="height:1100px;">
                                <div class="col-lg-12">
                                <h3 class="page-header">Paiements</h3>
                                    <div class="panel panel-default">
                                    	<!--Menu tabulation-->
                                            	<!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                	<li class="dropdown"> <a  href="rec_situation_paiement.php"> Situation en cours <b class="caret"></b></a></li>
                                                    <li class="dropdown active"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Situation périodique <b class="caret"></b></a>
                                                    	<ul class="dropdown-menu">
                                                            <li style="padding:10px;">
                                                            	<form action="rec_situation_paiement_periodique.php" method="post" name="periode">
                                                                <fieldset>
                                                                	<div style="border:1px solid #dddddd; padding:10px;">
                                                                	<table width="300" border="0">
                                                                	<tr>
                                                                    <td width="120"> <label for="date">Date de debut&nbsp;:</label></td>
                                                                     <td width="5"></td>
                                                                    <td><input id="datetimepickerOcc"  type="date" class="form-control"  name="date_d" required >
                                                                    </td>
                                                                    </tr>
                                                                   <tr>
                                                                    <tr height="15">
                                                                    <td></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td> <label for="date">Date de fin&nbsp;:</label></td>
                                                                     <td width="5"></td>
                                                                    <td>
                                                                         <input id="datetimepickerLib"  type="date" class="form-control"  name="date_f" required >
                                                                    </td>
                                                                  </tr>
                                                                  <tr height="15">
                                                                    <td></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>&nbsp;</td>
                                                                      <td width="5"></td>
                                                                      <td align="left"> <button  name="sauvegarder" type="submit" class="btn btn-primary">Valider</button></td>
                                                                  </tr>
                                                                </table>
                                                                </div>
                                                                 </fieldset>
                                                                 </form>
                                                              </li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown"> <a  href="rec_situation_paiement_historique.php">Situation historique <b class="caret"></b></a></li>
                                                </ul>
                                            <!--/Menu tabulation-->
                                            <?php 
												if(isset($_POST['sauvegarder'])){
												$date_d=$_POST['date_d'];
												$date_f=$_POST['date_f'];
												$_SESSION['date_d']=$date_d;
												$_SESSION['date_f']=$date_f;
												
												$date_d1=explode(' ', $date_d);
												$date_d_expl1=explode('/', $date_d1[0]);
												
												$date_d_expl=$date_d_expl1[2].'-'.$date_d_expl1[1].'-'.$date_d_expl1[0]; 
												
												$date_f1=explode(' ', $date_f);
												$date_f_expl1=explode('/', $date_f1[0]);
												
												$date_f_expl=$date_f_expl1[2].'-'.$date_f_expl1[1].'-'.$date_f_expl1[0]; 
												}
											?>
                                        <div class="panel-heading">
                                            <h4>Situation Paiements du <?php echo $date_d1[0].' '.'au'.' '.$date_f1[0]; ?></h4>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Motif</th>
                                                        <th>Clients</th>
                                                        <th>Montant Total</th>
                                                        <th>Montant payé (USD)</th>
                                                        <th>Montant payé (FC)</th>
                                                        <th>Reste</th> 
                                                        <th>Etat</th>           
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                    			<tbody>
                                                <?php 
												$i=1;
												$som_tot=0;
												$som_paye=0;
												$som_paye_fc=0;
												$som_reste=0;
													/* Recuperation du paiement d'un client */
												$requete_paie = $bdd->prepare("SELECT a.nom_client, b.num_reserv,b.type,
												 c.num_fact,c.id_fact, c.montant_total, SUM(d.montant_dollar) AS montantUSD,
											     SUM(d.montant_fc) AS montantFC,d.date_regl 
												 FROM t_client AS a,t_reservation AS b, t_facture AS c, t_reglement AS d 
												 WHERE a.id_client=b.id_client 
												 AND b.id_res=c.id_res 
												 AND c.id_fact=d.id_fact 
												 AND d.id_hotel =:id_hotel
												 GROUP BY c.num_fact ORDER BY c.num_fact DESC");
												$requete_paie->BindParam(':id_hotel',$_SESSION['id_hotel']);
												$requete_paie->execute();
												while ($donnees = $requete_paie->fetch()) 
												{
                                                ?>
												<?php 
													$monnaie=1;
													$montantUSD=$donnees['montantUSD'];
													$montantFC=$donnees['montantFC'];
													$montant_tot=$donnees['montant_total'];
													$num_fact=$donnees['num_fact'];
													$id_fact=$donnees['id_fact'];
													$nom_client=$donnees['nom_client'];
													$type=$donnees['type'];
													$date_regl=$donnees['date_regl'];
													
													
													$date_regl1=explode(' ',$date_regl);
													$date_regl_expl=$date_regl1[0];
													
													//Selection  du taux de la monnaie dans la base
													$taux = $bdd->prepare("SELECT taux FROM ` monnaie` 
																		   WHERE id_monnaie=:id_monnaie");
													$taux->BindParam(':id_monnaie', $monnaie);
													$taux->execute();
													
													while ($donnees = $taux->fetch())
													{						
														$toDujr = $donnees['taux'];
													}
													//conversion montant FC en USD
													$montantFC_en_USD=round($montantFC/$toDujr,2);
													
													//calcul du montant payer à partir du montantFC convertit en USD
													$montant_paye=$montantUSD+$montantFC_en_USD
													
												?>
                                                <?php 
													if(($date_regl_expl>=$date_d_expl)&&($date_regl_expl<=$date_f_expl)){
												?>
												<?php 
													$reste=$montant_tot-$montant_paye;
													if($reste!=0){
												?>
                                                        
                                                    <tr style="color:#4949fa;">
                                                    	<td><?php echo $i;?></td>
                                                        <td>
															<?php 
																if($type=='reservation'){
																	echo 'Paiement réservation chambre';
																}else{
																	echo 'Paiement occupation chambre';
																}
															?>
                                                        </td>
                                                        <td><?php echo $nom_client;?></td>
                                                        <td><?php echo $montant_tot.'$';?></td>   
                                                        <td><?php echo $montantUSD.'$'; ?></td>
                                                        <td><?php echo $montantFC.'FC'; ?></td>
                                                        <td><?php echo $reste.'$';?></td>
                                                        <td><?php echo 'Ouverte';?></td>
                                                        <td align="center">
                                                        	<a href="rec_paiement_additif_facture.php?num_fact=<?php echo $num_fact;?>&nom_client=<?php echo $nom_client;?>&type=<?php echo $type;?>&id_fact=<?php echo $id_fact;?>&reste=<?php echo $reste;?>&montant_tot=<?php echo $montant_tot;?>"><i class="fa fa-money fw-fa" title="Effectuer le paiement"></i></a>&nbsp;&nbsp;&nbsp;
                                                            <a href="rec_detail_paiement _client.php?num_fact=<?php echo $num_fact;?>&nom_client=<?php echo $nom_client;?>&type=<?php echo $type;?>"><i class="fa fa-tasks fw-fa"></i></a>
                                                      	</td>
                                                    </tr>
                                                  <?php 
													}else{
												  ?>
                                                  	
                                                	<tr>
                                                    	<td><?php echo $i;?></td>
                                                        <td>
															<?php 
																if($type=='reservation'){
																	echo 'Paiement réservation chambre';
																}else{
																	echo 'Paiement occupation chambre';
																}
															?>
                                                        </td>
                                                        <td><?php echo $nom_client;?></td>
                                                        <td><?php echo $montant_tot.'$';?></td>   
                                                        <td><?php echo $montantUSD.'$'; ?></td>
                                                        <td><?php echo $montantFC.'FC'; ?></td>
                                                        <td><?php echo '-';?></td>
                                                        <td><?php echo 'Soldée';?></td>
                                                        <td align="center">
                                                        	<i class="fa fa-money fw-fa" title="Effectuer le paiement"></i>&nbsp;&nbsp;&nbsp;
                                                            <a href="rec_detail_paiement _client.php?num_fact=<?php echo $num_fact;?>&nom_client=<?php echo $nom_client;?>&type=<?php echo $type;?>" title="Voir Details"><i class="fa fa-tasks fw-fa"></i></a>
                                                      </td>
                                                    </tr>
                                                    <?php 
													}
												   ?>
                                                    
                                                    <?php
														$som_tot+=$montant_tot;
												        $som_paye+=$montant_paye;
														$som_paye_fc+=$montantFC;
												        $som_reste+=$reste;
														$i++;
														
														}
												/* Fin de la Recuperation du paiement d'un client */
													?>
                                                    <?php 
													}
												   ?>
                                            	</tbody>
                                                </tfoot>
                                                	<tr style="color:#ff1b2d;">
                                                    	<th colspan="3"></th>
                                                        <th><?php echo $som_tot.' $'; ?></th>
                                                        <th><?php echo $som_paye.' $'; ?></th>
                                                        <th><?php echo $som_paye_fc.' FC'; ?></th>
                                                        <th><?php echo $som_reste.' $'; ?></th> 
                                                        <th colspan="2"></th>           
                                                    </tr>
                                                </tfoot>
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
<!-- jQuery -->
	<script src="../datepicker/jquery.js"></script>
	<script src="../datepicker/jquery.datetimepicker.js"></script>
    <script>
    $('#datetimepicker6').datetimepicker();
	$('#datetimepickerOcc').datetimepicker();
	$('#datetimepickerLib').datetimepicker();
	$('#datetimepickerLib1').datetimepicker();
    </script>

     <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>

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
