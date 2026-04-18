			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); 
				 include '../bdd/connexion_mysql.php';
			if( isset($_GET['num_reserv'])&&isset($_GET['id_client'])&&isset($_GET['nom_client'])&&isset($_GET['id_res'])&&isset($_GET['date_res'])&&isset($_GET['date_occ'])&&isset($_GET['date_lib'])&&isset($_GET['dte_a'])&&isset($_GET['dte_s'])){
				
				
				$num_reserv = $_GET['num_reserv'];
				$id_client = $_GET['id_client'];
				$nom_client = $_GET['nom_client'];
				$id_res = $_GET['id_res'];
				$date_res = $_GET['date_res'];
				$date_occ = $_GET['date_occ'];
				$date_lib = $_GET['date_lib'];
				$dte_a = $_GET['dte_a'];
				$dte_s = $_GET['dte_s'];
				$_SESSION['id_res_client']=$id_client;
				
				$_SESSION['id_client']=$id_client;
				$_SESSION['nom_client']=$nom_client;
				$_SESSION['id_res']=$id_res;
			
			}else{
			header("Location:rec_liste_de_reservation.php");
			}
			
			
			?>
            
       

        <div id="page-wrapper">
        				 <!--<br>
<h1><b><center>--><?php //echo strtoupper($_SESSION['nom_hotel']); ?><!--</center></b></h1>-->
                        <div class="row">
                                <div class="col-lg-12">
                                <h3 class="page-header">Occupations</h3>
                                		<div style="margin-top:-55px; margin-left:965px; margin-bottom:15px;">
                                         	<a href="rec_detail_reservation_client.php?num_reserv=<?php echo $num_reserv;?>" title="Voir le detail sur cette réservation">
                                                <i class="fa fa-tasks fa-2x"></i>
                                            </a>
                                         </div>
                                         <div style="margin-top:-45px; margin-left:1025px; margin-bottom:15px;">
                                         	<a href="rec_liste_reservation.php" title="Voir la liste des réservations prévues pour une occupation">
                                                <i class="fa fa-list-ol fa-2x"></i>
                                            </a>
                                         </div> 
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Occupation de(s) Chambre(s) du client <span style="color:#4949fa; font-weight:bold;"><?php echo $nom_client; ?></span></h4>
                                        	
                                            <div style="margin-top:-40px; margin-left:600px; width:350px; ">
        <!-- Bloc de boutton -->                               
         <table width="264">
            <tr>
               
                <td> 
                	<a class="btn btn-primary" href="rec_ajout_client_en_charge.php?id_client=<?php echo $_SESSION['id_client'];?>&nom_client=<?php echo $_SESSION['nom_client'];?>&id_res=<?php echo $_SESSION['id_res'];?>" style="font-style:italic;">Ajouter un client</a>                     
					
  					
                </td>
                </tr>
              </table>
              <!-- / Bloc de boutton -->  
                                          </div>
                                            <div style="margin-top:-42px; margin-left:755px;"><a class="btn btn-default btn-lg btn-block"  href="rec_liste_reservation.php" style="width:270px;"><img src="../img/list.png">&nbsp;Liste Occupation chambres</a></div>
                                            
                                         </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:400px; border:1px solid #fff;">
                                        <BR>
                                           <form role="form" method="post" action="rec_ajout_occupation.php">
                                           <input id="id_res" type="hidden" value="<?php echo $id_res ;  ?>">
                                           <input id="num_reserv" type="hidden" value="<?php echo $num_reserv;  ?>">
                                           <input id="date_occ" type="hidden" value="<?php echo $date_occ;  ?>">
                                           <input id="date_lib" type="hidden" value="<?php echo $date_lib;  ?>">
                                           <fieldset>
                                          <table width="690" border="0" >
                                          <?php //if(date('Y-m-d')==$dte_a){ ?>
                                          <tr>
                                            <td width="52" align="right" ><label for="date">Client&nbsp;: </label></td>
                                             <td width="8"></td>
                                             
                                            <td width="197" align="center"> 
                                            	<select name="id_client"  id="id_client"  class="form-control">
                                                	<option></option>
                                                     <?php
$result=mysql_query("SELECT DISTINCT a.id_client, a.nom_client FROM t_client AS a, t_client_reserve AS b
WHERE a.id_client = b.id_client AND b.id_res ='$id_res' AND b.responsable !=3") or die(mysql_error());
													while( $row = mysql_fetch_array($result))
													{
														echo '<option value="'.$row['id_client'].'">'.$row['nom_client'].'</option>';
													 }
													 //$_SESSION['nbre_enreg']=$row['nbre'];
													 //$_SESSION['compteur']=0;
														mysql_free_result($result);
													?>
                                                </select>
                                            </td>
                                            <td width="13"></td>
                                            <td align="right" ><label for="date">Chambre&nbsp;: </label></td>
                                            <td width="29"></td>
                                            <td align="center"> 
                                            	<select name="id_chambre" id="id_chambre" class="form-control">
                                                	<option></option>
                                                     <?php
$result=mysql_query("SELECT rch.idchambre,ch.num_ch FROM t_chambre AS ch,t_reserve_chambre AS rch,t_reservation AS res 
                     WHERE rch.statut='reserve'	AND ch.id_ch=rch.idchambre AND  res.id_res=rch.idreserv AND  rch.idreserv='$id_res'") or die(mysql_error());
													while( $row = mysql_fetch_array($result))
													{
														echo '<option value="'.$row['idchambre'].'">'.'Ch '.$row['num_ch'].'</option>';
													 }
														mysql_free_result($result);
													?>
                                                </select>
                                            </td>
                                          </tr>
                                          <tr height="35">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ></td>
                                             <td width="8"></td>
                                             <td align="center"> 
                                            	
                                            </td>
                                            <td width="13"></td>
                                            <td width="161"></td>
                                            <td width="29"></td>
                                            <td width="200"></td>
                                          </tr>
                                          
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                              <td width="8"></td>
                                              <td width="197"></td>
                                            <td width="13"></td>
                                            <td width="161"></td>
                                            <td width="29"></td>
                                            <td align="right"> <button  id="valider_occup" name="valider" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Valider</button></td>
                                          </tr>
                                          <?php //} else {?>
                                          
                                          	<!--<script type="text/javascript">
												if(confirm("La d'occupation prévue doit etre égale à la date du jour")){
													location.href='rec_liste_reservation.php';
												}
											</script>-->
                                          
                                          <?php //} ?>
                                        </table>
                                         </fieldset>
                                                                                   
                                         </form>
										
                                         </div>
                                         <!-- Image Chambre -->
                                        
                                         
                                         </div>
                  
                                        </div>
                                        <!-- /.panel-body -->
                                       <div style="border:1px solid black;height:100px;" >
                  						<table width="690" border="1">
                                          <tr>
                                            <th scope="col">&nbsp;N°</th>
                                            <th scope="col">&nbsp;Client</th>
                                            <th scope="col">&nbsp;Chambre</th>
                                            <th scope="col">&nbsp;Action</th>
                                          </tr>
                                           <tbody id="contenu_tabl"></tbody>
                                        </table>

                                       </div> 
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
