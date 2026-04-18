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
            <?php include('../FUNCTION/checkdates.php');
			include '../bdd/connexion_mysql.php';
			?>
          

        <div id="page-wrapper" style=" height:auto;">
                        <div class="row">
                                <div class="col-lg-12">
                                 <h2 class="page-header">Réservation Multi Chambres</h2>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Réservation</h4>
                                             
                                            <!--<div style="margin-top:-40px; margin-left:550px;"><a class="btn btn-default btn-lg btn-block"  href="rec_ajout_client.php" style="width:200px;"><img src="../img/ajouter-icone.png">&nbsp;Ajouter un Client</a></div>-->
                                          <div style="margin-top:-40px; margin-left:670px; width:350px; ">
                                          
                                          
                                          
                                          </div>
                                        </div>
                                       
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        
                                        <BR>
                                           <form role="form" method="post" action="rec_ajout_reservation.php">
                                           <fieldset>
                                         </div>
                                          <div id="panier">
                                         	<?php include('rec_panier_chambre.php'); ?>
                                           </div>
                                            
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
                                                    	<select class="form-control" name="id_modeP" id="mode">
                                                          <option selected="selected" value="0">Sélectionner un mode</option>
                                                            <?php
$result=mysql_query("SELECT * FROM  t_mode_reglement ") or die(mysql_error());
													while( $row = mysql_fetch_array($result))
													{
														echo '<option value="'.$row['id_mode_regl'].'">'.$row['lib'].'</option>';
													 }
														mysql_free_result($result);
													?>
                                                        </select>
                                                    </td>
                                                    <td width="72"><div id="lb_justif" style="display:none">Justification</div></td>
                                                    <td width="150"><input type="text" class="form-control"  name="justif" id="justif" style="display:none"></td>
                                                    <td width="182"><button  name="suivant" type="submit" class="btn btn-danger"><i class=" fa fa-arrow-right"></i>&nbsp;&nbsp;Suivant</button></td>
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
