		<?php 
			include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
            <?php 
			include '../bdd/connexion_mysql.php';
				// récuperation des infos de reseervation n°1

			if (isset($_POST['id_res']) && isset($_POST['num_reserv']) && isset($_POST['date_res']) 
					&& isset($_POST['id_client']) && isset($_POST['nom_client']) 
					&& isset($_POST['date_occ']) && isset($_POST['date_lib']) 
					&& isset($_POST['adulte']) && isset($_POST['enfant'])) {
			
			 $id_res= $_POST['id_res'];
			 $_SESSION['id_res']=$id_res;
			 $num_reserv=$_POST['num_reserv'];
			 $_SESSION['num_reserv']=$num_reserv;
			 $date_res=$_POST['date_res'];
			 $_SESSION['date_res']=$date_res;
			 $date_occ= $_POST['date_occ'];
			 $_SESSION['date_occ']=$date_occ;
			 $date_lib=$_POST['date_lib'];
			 $_SESSION['date_lib']=$date_lib;
			 $adulte=$_POST['adulte'];
			 $_SESSION['adulte']=$adulte;
			 $enfant= $_POST['enfant'];
			 $_SESSION['enfant']=$enfant;
			 $id_client=$_POST['id_client'];
			 $_SESSION['id_client']=$id_client;
			 $nom_client=$_POST['nom_client'];
			 $_SESSION['nom_client']=$nom_client;
			 
			 //Changement du format des dates
			 	$date_res1=explode('-',$date_res);
				$date_res1_Heure=explode(' ',$date_res1[2]);
			
				$date_res_expl=$date_res1_Heure[0].'/'.$date_res1[1].'/'.$date_res1[0].' '.$date_res1_Heure[1];
				$_SESSION['$date_res_expl']=$date_res_expl;
				
				$date_occ1=explode('-',$date_occ);
				$date_occ1_Heure=explode(' ',$date_occ1[2]);
			
				$date_occ_expl=$date_occ1_Heure[0].'/'.$date_occ1[1].'/'.$date_occ1[0].' '.$date_occ1_Heure[1]; 
				$_SESSION['$date_occ_expl']=$date_res_expl;
				
				$date_lib1=explode('-',$date_lib);
				$date_lib1_Heure=explode(' ',$date_lib1[2]);
			
				$date_lib_expl=$date_lib1_Heure[0].'/'.$date_lib1[1].'/'.$date_lib1[0].' '.$date_lib1_Heure[1];
				$_SESSION['$date_lib_expl']=$date_lib_expl; 
			
			}
			
			?>
          

        <div id="page-wrapper" style=" height:auto;">
                        <div class="row">
                                <div class="col-lg-12">
                                 <h3 class="page-header">Réservation </h3>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Modification de la réservation N° <span style="color:#4949fa; font-weight:bold;"><?php echo $_SESSION['num_reserv']; ?></span></h4>
                                            
                                        </div>
                                       
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        
                                        <BR>
                                           <form role="form" method="post" action="php/addpanier2.php">
                                           
                                           <input name="id_res" type="hidden" value="<?php echo $_SESSION['id_res']; ?>" />
                                            <input name="num_reserv" type="hidden" value="<?php echo $_SESSION['num_reserv']; ?>" />
                                            
                                           <fieldset>
                                           <table width="852" border="0"  style="margin-left:20px;">
                                          <tr>
                                            <td align="left" > <label for="date"><b>Date&nbsp;</b></label></td>
                                             <td width="10" style="border-right:1px solid #fff"></td>
                                            <td align="left"><input type="text" class="form-control"  name="date_res" id="datetimepicker6"  value="<?php echo $_SESSION['$date_res_expl']; ?>" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="left" > <label><strong>Client&nbsp;</strong></label></td>
                                             <td width="10" style="border-right:1px solid #fff"></td>
                                            <td align="left">
                                            	<select class="form-control" name="id_client" id="id_client">
                                                	<option value="<?php echo $_SESSION['id_client']; ?>" selected><?php echo $_SESSION['nom_client']; ?></option>
                                                    <?php
													
													$result=mysql_query("SELECT * FROM  t_client c WHERE c.id_hotel='$id_hotel' ORDER BY c.id_client ASC LIMIT 5") or die(mysql_error());
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
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="left" > <label for="date"><strong>Date prévue d'arrivée&nbsp;</strong></label></td>
                                            <td width="10" style="border-right:1px solid #fff"></td>
                                            <td align="left"><input type="text" class="form-control"  name="date_arrive" id="datetimepickerOcc" value="<?php echo $_SESSION['$date_occ_expl']; ?>" required></td>
                                            <td width="50"></td>
                                            <td align="right" > <label for="date"><strong>Date prévue de sortie&nbsp;</strong></label></td>
                                            <td width="10" style="border-right:1px solid #fff"></td>
                                            <td align="left"><input type="text" class="form-control"  name="date_sortie" id="datetimepickerLib" value="<?php echo $_SESSION['$date_lib_expl']; ?>" required></td>
                                            <td width="30"></td>
                                            <td align="left"><font color="#FF0000"><strong>&nbsp;<!--Soit--> <?php //echo $_SESSION['nbre_jr'];?> <!--Jour(s)--></strong></font></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          </table>
                                         </div>
                                          <div id="panier">
                                         	<?php include('rec_panier_chambre _modification.php'); ?>
                                           </div>
                                            
                                            <div style="margin-left:70px;">
                                                <table width="937" height="50" border="0">
                                                  <tr valign="top">
                                                  	<td width="182">
                                                    </td>
                                                    <td width="182" align="right">
                                                    	<button  name="suivant" id="suivant2" type="submit" class="btn btn-primary"><img src="../img/edit.png">&nbsp;Modifier</button>
                                                    </td>
                                                  </tr>
                                                </table>
											</div>
                                         </fieldset>
                                                                                   
                                         </form>
                                  
                                         
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