		<?php 
			// Inclusion du fichier contenant la connexion à la base
			require '../bdd/connexion.php';
			include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
            <?php include('../FUNCTION/checkdates.php');
		
		if( isset($_GET['num_reserv'])){
		$num_reserv = $_GET['num_reserv'];
		$page='reservation';
		
		}else{
		header("Location:liste_occupation.php");
		}
			?>
            
            <?php
		 		$requete_paie = $bdd->prepare("SELECT c.num_fact,c.id_fact FROM t_reservation AS b, t_facture AS c
				WHERE b.id_res=c.id_res
				AND b.num_reserv=:num_reserv");
				$requete_paie->BindParam(':num_reserv', $num_reserv);
				$requete_paie->execute();
				while ($donnees = $requete_paie->fetch()) 
				{
					$num_fact=$donnees['num_fact'];
					$id_fact=$donnees['id_fact'];
				}
		 ?>
            
            
          <?php 
			/* Recuperation de la réservation d'un client */
			$requete_res = $bdd->prepare("SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv,b.type, b.date_res, b.date_occ, b.date_lib, b.statut_res,b.dte_a,b.dte_s FROM t_client AS a, t_reservation AS b
			WHERE a.id_client=b.id_client 
			AND b.num_reserv=:num_reserv
			AND b.id_hotel=:id_hotel");
			$requete_res->BindParam(':num_reserv', $num_reserv);
			$requete_res->BindParam(':id_hotel', $id_hotel);
			$requete_res->execute();
			while ($donnees = $requete_res->fetch()) 
			{
				$id_client=$donnees['id_client']; 
				$_SESSION['id_client']=$id_client;
				
				$nom_client=$donnees['nom_client']; 
				$_SESSION['nom_client']=$nom_client;
				
				$id_res=$donnees['id_res']; 
				$_SESSION['id_res']=$id_res;
				
				$num_reserv=$donnees['num_reserv']; 
				$_SESSION['num_reserv']=$num_reserv;
				
				$date_res=$donnees['date_res']; 
				$_SESSION['date_res']=$date_res;
				
				$date_occ=$donnees['date_occ']; 
				$_SESSION['date_occ']=$date_occ;
				
				$date_lib=$donnees['date_lib']; 
				$_SESSION['date_lib']=$date_lib;
				
				$statut_res=$donnees['statut_res'];
				$_SESSION['statut_res']=$statut_res;
				
				$type=$donnees['type']; 
				$_SESSION['type']=$type;
				
				$dte_a=$donnees['dte_a']; 
				$_SESSION['dte_a']=$dte_a;
				
				$dte_s=$donnees['dte_s']; 
				$_SESSION['dte_s']=$dte_s;
				
				$date_now=date('Y-m-d');
				
				function NbJours($date_a,$date_s) {

							$tDeb = explode("-",$date_a);
							$tFin = explode("-", $date_s);

							$diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
							mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);

							  return(($diff / 86400)+1);

				     	  }
						
						 $Nombres_jours = NbJours($dte_a,$date_now);
			             $nb_jrs=$Nombres_jours;
						 $nb_jr= $nb_jrs- 1;
					     if( $nb_jr==0)
						 {
						 $nb_jr++;
						 }
			 
			       $nbre_jr=$nb_jr;
				   $_SESSION['nbre_jr']= $nbre_jr;
				
				//Changement du format des dates
				
				$date_res1=explode('-',$date_res);
				$date_res1_Heure=explode(' ',$date_res1[2]);
			
				$date_res_expl=$date_res1_Heure[0].'/'.$date_res1[1].'/'.$date_res1[0].' '.$date_res1_Heure[1];
				
				//Date de reservation pour la comparaison avec la date du jour
				$date_res_comp=explode(' ',$date_res);
				$date_res_comp1=$date_res_comp[0];
				//Fin
				
				$date_occ1=explode('-',$date_occ);
				$date_occ1_Heure=explode(' ',$date_occ1[2]);
			
				$date_occ_expl=$date_occ1_Heure[0].'/'.$date_occ1[1].'/'.$date_occ1[0].' '.$date_occ1_Heure[1]; 
				
				$date_lib1=explode('-',$date_lib);
				$date_lib1_Heure=explode(' ',$date_lib1[2]);
			
				$date_lib_expl=$date_lib1_Heure[0].'/'.$date_lib1[1].'/'.$date_lib1[0].' '.$date_lib1_Heure[1]; 
				
				
			}
		?>

        <div id="page-wrapper" style=" height:auto;">
                        <div class="row">
                                <div class="col-lg-12">
                                 <h3 class="page-header">
                                 	<div>Occupation</div>
                                    <div style="margin-top:30px;">
                                    	<?php if($statut_res=='operationnel'){?>
                                        <?php if((date('Y-m-d')==$date_res_comp1)&&($_SESSION['libe_droit']=='Receptionniste')){?>
                                        <form method="post" action="rec_modification_reservation_client.php">
                                        
                                        	<input name="id_res" id="id_res" type="hidden" value="<?php echo $id_res; ?>" />
                                            <input name="num_reserv" type="hidden" value="<?php echo $num_reserv; ?>" />
                                            <input name="date_res" type="hidden" value="<?php echo $date_res; ?>" />
                                            <input name="date_occ" type="hidden" value="<?php echo $date_occ; ?>" />
                                            <input name="date_lib" type="hidden" value="<?php echo $date_lib; ?>" />
                                            <input name="id_client" type="hidden" value="<?php echo $id_client; ?>" />
                                            <input name="nom_client" type="hidden" value="<?php echo $nom_client; ?>" />
                                            
                                    		<button type="submit" class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                            	<img src="../img/edit.png">&nbsp;Modifier
                                            </button>
                                         </form>
                                         <?php }else{ ?>
                                         	<form method="post" action="rec_modification_reservation_client.php">
                                        
                                        	<input name="id_res" id="id_res" type="hidden" value="<?php echo $id_res; ?>" />
                                            <input name="num_reserv" type="hidden" value="<?php echo $num_reserv; ?>" />
                                            <input name="date_res" type="hidden" value="<?php echo $date_res; ?>" />
                                            <input name="date_occ" type="hidden" value="<?php echo $date_occ; ?>" />
                                            <input name="date_lib" type="hidden" value="<?php echo $date_lib; ?>" />
                                            <input name="id_client" type="hidden" value="<?php echo $id_client; ?>" />
                                            <input name="nom_client" type="hidden" value="<?php echo $nom_client; ?>" />
                                            
                                    		<button type="submit" class="btn btn-primary" style="border:1px solid #d1d1d1;">
                                            	<img src="../img/edit.png">&nbsp;Modifier
                                            </button>
                                         </form>
                                         <?php }?>
                                         <div style="margin-top:-30px; margin-left:1005px;">
                                         	<a href="liste_occupation.php" title="Voir la liste des occupations">
                                                <i class="fa fa-tasks fa-fw"></i>
                                            </a>
                                         </div>
                                         <?php }?>
                                   </div>
                                 </h3>
                                    <div class="panel panel-default">
                                
                                        <div class="panel-heading">
                                            <h4>Detail de l'occupation </h4>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        
                                        <BR>
                                           <form role="form" method="post" action="php/addpanier2.php">
                                           <fieldset>
                                           <table width="852" border="0"  style="margin-left:20px;">
                                          <tr>
                                            <td align="left" > <label><strong>Client&nbsp;</strong></label></td>
                                             <td width="10" style="border-right:1px solid #000"></td>
                                            <td align="left">&nbsp;&nbsp;<?php echo $nom_client;?></td>
                                            <td width="50"></td>
                                            <td align="right" > <label><strong><!--Commissionnaire&nbsp;--></strong></label></td>
                                             <td width="10" style="border-right:1px solid #fff"></td>
                                            <td align="left">&nbsp;&nbsp;<?php //echo $_SESSION['nom_commissionnaire'];?></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="left" > <label for="date"><strong>Date d'occupation&nbsp;</strong></label></td>
                                            <td width="10" style="border-right:1px solid #000"></td>
                                            <td align="left">&nbsp;&nbsp;<?php  echo $date_occ_expl;?></td>
                                            <td width="50"></td>
                                            <td align="right" > <label for="date"><strong>Séjour&nbsp;</strong></label></td>
                                            <td width="10" style="border-right:1px solid #000"></td>
                                            <td align="left">&nbsp;&nbsp;<font color="#FF0000"><strong>&nbsp; <?php echo $_SESSION['nbre_jr'];?> Jour(s)</strong></font></td>
                                            <td width="30"></td>
                                            <td align="left"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                           
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          </table>
                                         </div>
                                         <div  style="margin-left:30px; color:#4949fa;"><h3><strong>Liste des chambres</strong></h3></div>
                                          <div id="panier">
                                          	<div class="table-responsive">
                                         	<table width="100" class="table table-striped table-bordered table-condensed" id="dataTables-example">
                                            <thead>
                                              <tr>
                                                <th width="20">N°</th>
                                                <th width="30">Type</th>
                                                <th width="30">Chambre N°</th>
                                                <th width="30">Tarif</th>
                                              </tr>
                                              </thead>
                                              <?php
											  	$i=1;
												//$num_reserv = 'R/00107';
												$statut='occupe';
												//$id_hotel=1;
													/* Recuperation du paiement d'un client */
												$requete_reserv = $bdd->prepare("SELECT c.id_ch, c.num_ch, c.type_ch,c.tarif_ch, d.statut 
																				FROM t_reservation AS b, t_chambre AS c, t_reserve_chambre AS d 
																				WHERE b.id_res=d.idreserv AND d.idchambre=c.id_ch 
																				AND b.num_reserv=:num_reserv AND d.statut=:statut 
																				AND b.id_hotel=:id_hotel");
												$requete_reserv->BindParam(':num_reserv', $num_reserv);
												$requete_reserv->BindParam(':id_hotel', $id_hotel);
												$requete_reserv->BindParam(':statut', $statut);
												$requete_reserv->execute();
												while ($donnees = $requete_reserv->fetch()) 
												{
													$id_ch=$donnees['id_ch'];
													$num_ch=$donnees['num_ch'];
													$type_ch=$donnees['type_ch'];
													$tarif_ch=$donnees['tarif_ch'];
													$statut=$donnees['statut']; 
													
													$_SESSION['panier'][$id_ch]=1;
											  ?>
                                              
                                              <tr>
                                              	<td><?php echo $i;?></td>
                                                <td><?php echo $type_ch;?></td>
                                                <td><?php echo 'Ch '.$num_ch;?></td>
                                                <td><?php echo $tarif_ch.' '.'$';?></td>
                                              </tr>
                                              
                                              <?php 
												$i++;
												}
												?>
                                                
                                            </table>
                                            </div>
                                          </div>
                                           
                                         </fieldset>
                                                                                   
                                         </form>
                                         </div>
                                         
                                         <div class="panel panel-default" style="">
                                         	<div  style="margin-left:30px; color:#4949fa;"><h3><strong>Paiement</strong></h3></div>
                                         	<!--les différent Paiement du client-->
                                         	<?php include('rec_detail_paiement _client_donnee.php'); ?>
                                            
                                            <?php if(($statut_res=='operationnel')&&($reste!=0)){?>
                                            
                                            <div style=" margin-left:17px; margin-bottom:15px; margin-top:-20px;">
                                            <a href="rec_paiement_additif_facture.php?num_fact=<?php echo $num_fact;?>&nom_client=<?php echo $nom_client;?>&type=<?php echo $type;?>&id_fact=<?php echo $id_fact;?>&reste=<?php echo $reste;?>&montant_tot=<?php echo $montant_tot;?>" class="btn btn-primary">
                                            	<img src="../img/paie.png">&nbsp;Payer
                                            </a>
                                         	</div>
                                            
                                         <?php }else{?>
                                         
                                         	<div style=" margin-left:17px; margin-bottom:15px; margin-top:-20px;">
                                            <a class="btn btn-primary">
                                            	<img src="../img/paie.png">&nbsp;Payer
                                            </a>
                                         	</div>
                                         
                                         <?php }?>
                                         </div>
                                         
                                         <?php 
										 
										$date_res1=explode('-',$date_res);
										$date_res1_Heure=explode(' ',$date_res1[2]);
									
										$date_res_expl_user=$date_res1_Heure[0].'/'.$date_res1[1].'/'.$date_res1[0].' '.'à'.' '.$date_res1_Heure[1];
												/* Recuperation du user qui a cree la réservation */
												$requete_use = $bdd->prepare("SELECT CONCAT(c.nom_user,' ', c.prenom_user) AS emploiye, d.libe_droit FROM t_reservation AS a, t_facture AS b, t_utilisateur AS c, t_droit AS d WHERE a.id_res=b.id_res AND b.id_user=c.id_user AND d.id_droit=c.id_droit AND a.num_reserv=:num_reserv");
												$requete_use->BindParam(':num_reserv', $num_reserv);
												$requete_use->execute();
												while ($donnees = $requete_use->fetch()) 
												{
													$emploiye=$donnees['emploiye'];
													$libe_droit1=$donnees['libe_droit'];
													
												}
												
												
												/* Recuperation du fonction du user */
												$requete_droit = $bdd->prepare("SELECT b.libe_droit FROM t_utilisateur AS a, t_droit AS b WHERE a.id_droit=b.id_droit AND a.id_user=:id_user");
												$requete_droit->BindParam(':id_user', $id_user);
												$requete_droit->execute();
												while ($donnees = $requete_droit->fetch()) 
												{
													$libe_droit=$donnees['libe_droit'];
												}
										?>
                                         
                                         <div class="panel panel-default" style="height:110px;">
                            				<div  style="border-right:1px solid #fff; height:110px; width:500px;" >
                                            	<div id="gauche" style="border:1px solid #fff; height:110px; width:495px;">
                                                	<div id="titre1" style="height:25px; padding-left:15px; width:500px;">
                                                		<h5><strong>Crée le <span style="color:#dd4f43;"><?php echo $date_res_expl_user;?></span> par:</strong></h5>
                                            		</div>
                                                    <div id="contenu1" style="padding-left:15px; height:80px; width:500px;">
                                                		<div id="img1"><img src="../img/users.PNG"></div>
                                                        <div id="user1" style="width:170px; height:45px; margin-top:-45px; margin-left:50px;">
                                                        	<?php echo strtoupper($emploiye);?><br>
                                                            <span style="color:#4949fa;"><i><?php echo $libe_droit1;?></i></span>
                                                        </div>
                                            		</div>
                                            	</div>
                                                
                                            </div>
                            			 </div>
                                         	
                                            
                                            
                                            
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