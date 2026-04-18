			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
              <?php include('../FUNCTION/checkdates.php');?>
           <?php include('../FUNCTION/reference.php'); 
			include '../bdd/connexion_mysql.php';
			$id_ch=$_GET['id_ch'];
			$num_ch=$_GET['num_ch'];
			
			?>
            
        

       <div id="page-wrapper" style=" height:auto">
        				<br>
            		<h1><b><center><?php echo strtoupper($_SESSION['nom_hotel']); ?></center></b></h1>
                        <div class="row">
                                <div class="col-lg-12">
                                 <h1 class="page-header">Réservation des Chambres</h1>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Réservation</h4>
                                             
                                            <div style="margin-top:-40px; margin-left:550px;"><a class="btn btn-default btn-lg btn-block"  href="rec_ajout_client.php" style="width:200px;"><img src="../img/ajouter-icone.png">&nbsp;Ajouter un Client</a></div>
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
                                            <td align="right" > <label>Nom client&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> 
                                            	 <select class="form-control" name="id_client">
                                                <option></option>
                                                    <?php
													
													$result=mysql_query("SELECT * FROM  t_client c WHERE c.id_hotel='$id_hotel' ORDER BY c.id_client ASC") or die(mysql_error());
													while( $row = mysql_fetch_array($result))
													{
														echo '<option value="'.$row['id_client'].'">'.$row['nom_client'].'</option>';
													 }
														mysql_free_result($result);
														?>
                                            	</select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>N° Chambre à reserver&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            	<select class="form-control" name="id_ch">
                                            <option value="<?php echo $id_ch;?>"><?php echo $num_ch;?></option>;
                                            </select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label for="date">Date réservation&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            
                                            	 <input id="date"  type="text" class="form-control"  name="date_res" value="<?php echo date('d/m/Y');?>" disabled>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                           <tr>
                                           
                                            <td align="right" > <label for="date">Date occupation&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            	 <input id="date"  type="date" class="form-control"  name="date_occ" required >
                                            </td>
                                          </tr>
                                           <tr>
                                            <tr height="15">
                                            <td></td>
                                          </tr>
                                            <td align="right" > <label for="date">Date libération&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            	 <input id="date"  type="date" class="form-control"  name="date_lib" required >
                                            </td>
                                          </tr>
                                          
                                          
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                              <td width="30"></td>
                                              <td align="right"> <button  name="sauvegarder" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Valider</button></td>
                                          </tr>
                                           <tr height="15">
                                            <td></td>
                                          </tr>
                                        </table>
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
                               <div class="well">
                                     
                                            	<a class="btn btn-default btn-lg btn-block" href="rec_reservation_chambre.php"><img src="../img/list.png">&nbsp;Situation réservation chambres</a>
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
