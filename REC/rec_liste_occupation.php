<?php 

// Inclusion du fichier contenant la connexion à la base
	require '../bdd/connexion.php';
			include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
       
        <div id="page-wrapper" style="height:1500px;">
        					<div class="col-lg-12">
                                <h1 class="page-header">Occupation</h1>
                                    <div class="panel panel-default">
                                    	<!--Menu tabulation-->
                                            	<!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                	<li class="dropdown active"> <a  href="rec_liste_reservation.php"> Occupation en cours <b class="caret"></b></a></li>
                                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Occupation  périodique <b class="caret"></b></a>
                                                    	<ul class="dropdown-menu">
                                                            <li style="padding:10px;">
                                                            	<form action="rec_liste_reservation_periodique.php" method="post" name="periode">
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
                                                    <li class="dropdown"> <a  href="rec_liste_reservation_historique.php">Occupation  historique <b class="caret"></b></a></li>
                                                </ul>
                                            <!--/Menu tabulation-->
                                        <div class="panel-heading">
                                            <h4>Liste d'occupations du jour (le <?php echo date('d/m/Y'); ?>)</h4>
                                            <div style="margin-top:-40px; margin-left:720px;"><a class="btn btn-default btn-lg btn-block" href="rec_reservation_multiple.php?hebergement=1" style="width:130px;"><img src="../img/reservation.png">&nbsp;Réserver</a></div>
                                            <div style="margin-top:-46px; margin-left:860px;"><a class="btn btn-default btn-lg btn-block" href="../html2pdf/examples/imprime_liste_reservation.php?reservation=encours" target="_blank" style="width:120px;"><img src="../img/print.png">&nbsp;Imprimer</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        
                                        
                                        <!-- Div stratégique -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Nom du Client</th>
                                                        <th>Date d'occupation </th>
                                                        <th>Date de sortie </th>          
                                                        <th align="center">Actions</th>
                                                    </tr>
                                                </thead>
                                    			<tbody>
                                                <?php 
												$i=1;
												$type='reservation';
												
													/* Recuperation du paiement d'un client */
												$requete_reserv = $bdd->prepare("SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.date_occ, b.date_lib, b.dte_a, b.dte_s,b.occ_indirect FROM t_client AS a, t_reservation AS b WHERE a.id_client=b.id_client AND occ_indirect=1 ORDER BY b.dte_a");
												$requete_reserv->execute();
												while ($donnees = $requete_reserv->fetch()) 
												{
													$id_client=$donnees['id_client'];
													$nom_client=$donnees['nom_client'];
													$id_res=$donnees['id_res'];
													$num_reserv=$donnees['num_reserv'];
													$date_occ=$donnees['date_occ'];
													$date_lib=$donnees['date_lib'];
													$dte_a=$donnees['dte_a'];
													$dte_s=$donnees['dte_s'];
													
													$date_occ1=explode(' ',$date_occ);
													$date_occ_expl=$date_occ1[0];
													
													$date_occ1=explode('-',$date_occ);
													$date_occ1_Heure=explode(' ',$date_occ1[2]);
												
													$date_occ_expl=$date_occ1_Heure[0].'/'.$date_occ1[1].'/'.$date_occ1[0].' '.$date_occ1_Heure[1]; 
													
													$date_lib1=explode('-',$date_lib);
													$date_lib1_Heure=explode(' ',$date_lib1[2]);
												
													$date_lib_expl=$date_lib1_Heure[0].'/'.$date_lib1[1].'/'.$date_lib1[0].' '.$date_lib1_Heure[1]; 
													
													/*$date_res1=explode('-',$date_res);
													$date_res1_Heure=explode(' ',$date_res1[2]);
												
													$date_res_explode=$date_res1_Heure[0].'/'.$date_res1[1].'/'.$date_res1[0].' '.$date_res1_Heure[1]; */
                                                ?>
                                                
                                                <?php 
													//if($date_occ_expl==date('Y-m-d')){
												?>
												<?php 
													//Récuperation seulement du date occ 
													/*$date_occ_test1=explode(' ',$date_occ);
													$date_occ_test=$date_occ_test1[0];
													
													if((date('Y-m-d H:i:s')<$date_occ)&&($statut_res=='operationnel')){*/
												?>
                                                        
                                                    <tr style="color:#4949fa;">
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $nom_client;?></td>>
                                                        <td><?php echo $date_occ_expl;?></td>   
                                                        <td><?php echo $date_lib_expl; ?></td>
                                                        <td>
                                                            
                                                        	<a href="rec_ajout_occupation.php" title="Effectuer l'occupation"><i class="fa fa-sign-in"></i></a>
                                                            
                                                            &nbsp;&nbsp;&nbsp;
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
														//$i++;
														//}
												/* Fin de la Recuperation du paiement d'un client */
													?>
                                                    
                                                    <?php 
													$i++;
													}
												   ?>
                                            	</tbody>
                                            </table>
                                        </div>
                                        <!-- /.panel-body -->
                                        
                                    </div>
                                    <!-- / Div stratégique -->
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
	<?php include('rec_footer.php'); ?>
    
