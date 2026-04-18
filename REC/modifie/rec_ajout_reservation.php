

<?php
if(isset($_GET['id_ch'])&&isset($_GET['num_ch'])&&isset($_GET['date_res'])&&isset($_GET['tarif_ch'])){
	$id_ch=$_GET['id_ch'];
	$num_ch=$_GET['num_ch'];
	$tarif_ch=$_GET['tarif_ch'];
	$date_res=$_GET['date_res'];
}
?>
			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
            <?php include('../FUNCTION/checkdates.php');?>
          

        <div id="page-wrapper" style=" height:auto;">
        				<br>
            		<h2><b><center><?php echo strtoupper($_SESSION['nom_hotel']); ?></center></b></h2>
                        <div class="row">
                                <div class="col-lg-12">
                                 <h2 class="page-header">Réservation des Chambres</h2>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Réservation</h4>
                                             
                                            <!--<div style="margin-top:-40px; margin-left:550px;"><a class="btn btn-default btn-lg btn-block"  href="rec_ajout_client.php" style="width:200px;"><img src="../img/ajouter-icone.png">&nbsp;Ajouter un Client</a></div>-->
                                            <div style="margin-top:-45px; margin-left:770px; width:200px;">
                                            <form role="form"  action="chambre_libre_en_fx_date.php" method="post">
                                            
                                            	<input type="date" class="form-control" style=" height:45px;" name="date_fx" placeholder="Chambres disponibles" required>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default"  type="submit" style="margin-top:-45px; margin-left:200px;height:45px;" name="search">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </span> 
                                            </form>
                                            </div>
                                        </div>
                                       
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        
                                        <BR>
                                           <form role="form" method="post" action="rec_ajout_reservation.php">
                                           <fieldset>
                                          <table width="500" border="0" >
                                          <tr>
                                            <td align="right" > <label for="date">Date&nbsp;/&nbsp;Heure&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            
                                            	 <input type="text" class="form-control"  name="date_res" id="datetimepicker6"  value="<?php echo $date_res?>&nbsp;&nbsp;<?php echo gmstrftime("%H:%M",time()+7200);?>"required>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Client&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> 
                                            	<select class="form-control" name="id_client" id="id_client">
                                                	<option ></option>
                                                    <?php
													$connection=mysql_connect("localhost","root","") OR die("impossible de se connecter.<br>\n Erreur MySQL'".mysql_error()."'");
													mysql_select_db('kabe_hotel_db') OR die("impossible de selectionner la base spécifiée.<br>\n Erreur MySQL'".mysql_error()."'");
													$result=mysql_query("SELECT * FROM  t_client c WHERE c.id_hotel='$id_hotel' ORDER BY c.id_client ASC LIMIT 5") or die(mysql_error());
													while( $row = mysql_fetch_array($result))
													{
														echo '<option value="'.$row['id_client'].'">'.$row['nom_client'].'</option>';
													 }
														mysql_free_result($result);
													?>
                                                    <!--<option>--------------------------------------------------</option>
                                                    <option value="tableaudebordRec.php" onClick="javascript:location=this.value" style="color:red; font-style:italic;">Chercher plus</option>
                                                    
                                                    
                                                    <option value="rec_ajout_client.php" onClick="javascript:location=this.value" style="color:red; font-style:italic;">Ajouter un client</option>
                                                    <option></option>-->
                                            	</select>
                                            </td>
                                            
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Commissionnaire&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            	<select class="form-control" name="id_ch">
                                                	<option></option>
                                            	</select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label for="date">Date&nbsp;/&nbsp;Heure d'occupation&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            
                                            	 <input type="text" class="form-control"  name="date_res" id="datetimepickerOcc" required>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                           <tr>
                                            <td align="right" > <label for="date">Date&nbsp;/&nbsp;Heure libération&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            
                                            	 <input type="text" class="form-control"  name="date_res" id="datetimepickerLib">
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                           <tr>
                                            <td align="right" > <label for="date">N°Chambre&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            	<input  type="hidden" class="form-control"  name="id_ch" id="id_ch" value="<?php echo $id_ch?>">
                                            	 <input type="text" class="form-control"  name="num_ch" id="num_ch" value="<?php echo $num_ch?>" disabled>
                                                  <input type="hidden" class="form-control"  name="tarif_ch" id="tarif_ch" value="<?php echo $tarif_ch?>">
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          </table>
                                          <div style=" width:400px; height:200px; margin-left:525px; margin-top:-195px; border:1px solid #fff;">
                                         	<table width="400" border="0">
                                              <tr>
                                                <td width="131">
                                                	<div class="modal" id="rech_client" style="width:600px; height:400px; background-color:#FFF; margin:auto;">
                                                        <div class="modal-header"> 
                                                        <a class="close" data-dismiss="modal">×</a>
                                                        <h3>Liste des Chambres</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                        <p>
                                                            
                                                                <input name="val" type="text" id="val_client">
                                                                <input name="valider" type="button" value="valider" id="valider_client">
                                                            
                                                        </p>
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-primary" data-toggle="modal" href="#rech_client" style="font-style:italic;">Chercher plus</a>
                                                </td>
                                                <td width="253">
                                                	<?php include('rec_modal_ajout_client.php'); ?>
                                                </td>
                                              </tr>
                                              <tr>
                                              	<td height="12"></td>
                                                <td></td>
                                              </tr>
                                              <tr>
                                              	<td></td>
                                                <td></td>
                                              </tr>
                                              <tr>
                                                <td>
                                                	<div class="modal" id="infos3" style="width:600px; height:400px; background-color:#FFF; margin:auto;">
                                                        <div class="modal-header"> 
                                                        <a class="close" data-dismiss="modal">×</a>
                                                        <h3>Liste des Chambres</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                        <p>
                                                            kkkkkkkkkkkkkkkkk
                                                                <input name="val" type="text" id="val">
                                                                <input name="valider" type="button" value="valider" id="valider">
                                                            
                                                        </p>
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-primary" data-toggle="modal" href="#infos3" style="font-style:italic;">Chercher plus</a>
                                                </td>
                                                <td>
                                                	<?php include('rec_modal_ajout_commissionaire.php'); ?>
                                                </td>
                                              </tr>
                                            </table>
                                         </div>
                                          
                                         	<?php include('rec_panier_chambre.php'); ?>
                                            
                                            
                                            <h4 class="page-header">Paiement</h4>
                                            <div style="margin-left:50px;">
                                                <table width="737" height="132" border="0">
                                                  <tr align="center">
                                                    <td width="115">Montant USD&nbsp;:</td>
                                                    <td width="184"><input type="text" class="form-control"  name="montantUSD" required></td>
                                                    <td width="72">&nbsp;</td>
                                                    <td width="150">Montant FC&nbsp;:</td>
                                                    <td width="182"><input type="text" class="form-control"  name="montantFC" required></td>
                                                  </tr>
                                                  <tr align="center">
                                                    <td width="115"></td>
                                                    <td width="184"></td>
                                                    <td width="72">&nbsp;</td>
                                                    <td width="150"></td>
                                                    <td width="182"></td>
                                                  </tr>
                                                  <tr align="center" >
                                                    <td width="115">Remise&nbsp;:</td>
                                                    <td width="184"><input type="text" class="form-control"  name="remise"></td>
                                                    <td width="72">&nbsp;</td>
                                                    <td width="150"></td>
                                                    <td width="182"></td>
                                                  </tr>
                                                  <tr align="center">
                                                    <td width="115"></td>
                                                    <td width="184"></td>
                                                    <td width="72">&nbsp;</td>
                                                    <td width="150"></td>
                                                    <td width="182"></td>
                                                  </tr>
                                                  <tr align="center">
                                                    <td width="115">Majoration&nbsp;:</td>
                                                    <td width="184"><input type="text" class="form-control"  name="majoration" id="client" ></td>
                                                    <td width="72">&nbsp;</td>
                                                    <td width="150"></td>
                                                    <td width="182"></td>
                                                  </tr>
                                                  <tr align="center">
                                                    <td width="115"></td>
                                                    <td width="184"></td>
                                                    <td width="72">&nbsp;</td>
                                                    <td width="150"></td>
                                                    <td width="182"></td>
                                                  </tr>
                                                  <tr align="center">
                                                    <td width="115">Mode paiement&nbsp;:</td>
                                                    <td width="184">
                                                    	<select class="form-control" name="id_modeP">
                                                            <option></option>
                                                            <?php
													$connection=mysql_connect("localhost","root","") OR die("impossible de se connecter.<br>\n Erreur MySQL'".mysql_error()."'");
													mysql_select_db('kabe_hotel_db') OR die("impossible de selectionner la base spécifiée.<br>\n Erreur MySQL'".mysql_error()."'");
													$result=mysql_query("SELECT * FROM  t_mode_reglement ") or die(mysql_error());
													while( $row = mysql_fetch_array($result))
													{
														echo '<option value="'.$row['id_mode_regl'].'">'.$row['lib'].'</option>';
													 }
														mysql_free_result($result);
													?>
                                                        </select>
                                                    </td>
                                                    <td width="72">&nbsp;</td>
                                                    <td width="150"></td>
                                                    <td width="182"><button  name="sauvegarder" type="submit" class="btn btn-danger"><i class=" fa fa-save"></i>&nbsp;&nbsp;Sauvegarder</button></td>
                                                  </tr>
                                                </table>
											</div>
                                            <br>
                                         </fieldset>
                                                                                   
                                         </form>
                                    <?PHP
										if(isset($_POST['sauvegarder'])){
										
										$id_client=$_POST['id_client'];
										$id_ch=$_POST['id_ch'];
										$date_res=date('Y-m-d');
										$date_occ=$_POST['date_occ'];
										$date_lib=$_POST['date_lib'];
										$statut_res='opérationnel';
										$booleen=checkdates($date_res,$date_occ,$date_lib);
											if($booleen=='true'){
												
										$res= new Reservation($date_res,$date_occ,$date_lib,$statut_res,$id_ch,$id_client);
										$res->reserver();
												}
											else{
												
											echo '<script>alert("Veuillez vérifier toutes vos dates saisies s.v.p");</script>';
												}
										
										
											}
										
										?>
 										<!-- Image Chambre -->
                                         
                               				<div class="welll">
                                     
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
