			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
            <?php include('../FUNCTION/checkdates.php');?>
          <?php require '_header.php';?>
			<?php
			include '../bdd/connexion_mysql.php';
			if( isset($_GET['num_fact']) && ($_GET['nom_client']) && ($_GET['type']) && ($_GET['id_fact']) && ($_GET['reste']) && ($_GET['montant_tot']) ){
				$num_fact = $_GET['num_fact'];
				$id_fact=$_GET['id_fact'];
				$nom_client = $_GET['nom_client'];
				$type = $_GET['type'];
				$reste = $_GET['reste'];
				$montant_tot = $_GET['montant_tot'];
				
				
			}
			
            ?>
            
        <div id="page-wrapper" style=" height:auto;">
                        <div class="row">
                                <div class="col-lg-12">
                                 <h3 class="page-header">Paiement: <span style="color:#4949fa; font-weight:bold;"><?php if($_SESSION['type']=='reservation'){ echo 'réservation';}else{ echo 'Occupation';} ?></span></h3>
                                    <div class="panel panel-default">
                                       <div class="panel-heading">
                                            <h4>Modification de la Facture N° <span style="color:#4949fa; font-weight:bold;"><?php echo $_SESSION['num_fact']; ?></span></h4>
                                            </div>
                                             
                                       
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                           <form role="form" method="post" action="insert_reservation.php"  id="form_reservation_insert">
                                           <input name="reste" id="reste" type="hidden" value="<?php echo $_SESSION['reste']; ?>">
                                            <input name="num_fact" id="num_fact" type="hidden" value="<?php echo $_SESSION['num_fact']; ?>">
                                           <input name="montant_tot" type="hidden" value="<?php echo $_SESSION['montant_tot']; ?>">
                                           <fieldset>
                                           <table width="852" border="0"  style="margin-left:20px;">
                                           
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="left" > <label><strong>Client&nbsp;</strong></label></td>
                                             <td width="10" style="border-right:1px solid #000"></td>
                                            <td align="left">&nbsp;&nbsp;<?php echo $_SESSION['nom_client']; ?></td>
                                            <td width="50"></td>
                                            <td align="left" > <label><strong><!--Commissionnaire&nbsp;--></strong></label></td>
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
                                            <td align="left" > <label for="date"><strong>Montant total&nbsp;</strong></label></td>
                                            <td width="10" style="border-right:1px solid #000"></td>
                                            <td align="left">&nbsp;&nbsp;<span style="color:#d1312c; font-weight:bold;"><?php  echo $_SESSION['montant_tot'].' $';?></span></td>
                                            <td width="50"></td>
                                            <td align="right"> <label for="date"><strong>Reste&nbsp;</strong></label></td>
                                            <td width="10" style="border-right:1px solid #000"></td>
                                            <td align="left">&nbsp;&nbsp;<span style="color:#d1312c; font-weight:bold;"><?php echo $_SESSION['reste'].' $';?></span></td>
                                            <td width="30"></td>
                                          </tr>
                                          </table>
                                          <h4 class="page-header"></h4>
                                            <div style="margin-left:50px;">
                                                <table width="940" height="132" border="0">
                                                	
                                                  <tr align="center">
                                                    <td width="90">Monnaie&nbsp;:&nbsp;</td>
                                                    <td width="176">
                                                  <select class="form-control" name="monnaie" id="monnaie" requered>
                                                 <option value="<?php echo $id_droit; ?>"><?php echo $libe_droit; ?></option>
														<?php
                                                 $req = $bdd -> prepare('SELECT * FROM t_droit WHERE id_droit!=:id_droit');
                                                $req->BindParam(':id_droit', $id_droit);
                                                $req -> execute();
                                                $droits = $req -> fetchAll(PDO::FETCH_OBJ);
                                 
                                                foreach($droits as $droit){
                                
                                              echo '<option value="'.$droit->id_droit.'">'.$droit->libe_droit.'</option>';
                                                 }
                                    
                                                   ?>
                                                    	<option value="3">USD & FC </option>
                                                        </select>
                                                    </td>
                                                    <td width="8">&nbsp;</td>
                                                    <td width="29"><div id="lb_montant" style="display:none">Montant&nbsp;:</div></td>
                                                    <td width="139"><input type="number" min="0" class="form-control" name="montant" id="montant" style="display:none" required></td>
                                                    <td width="0">&nbsp;</td>
                                                    <td width="96"><div id="lb_montantUSD" style="display:block">Montant USD&nbsp;:</div></td>
                                                    <td width="110"><input type="number" min="0" class="form-control" name="montantUSD" id="montantUSD" style="display:block" required></td>
                                                    <td width="8">&nbsp;</td>
                                                    <td width="85"><div id="lb_montantFC" style="display:block">Montant FC&nbsp;:</div></td>
                                                    <td width="129"><input type="number" min="0" class="form-control" name="montantFC" id="montantFC" style="display:block" required></td>
                                                  </tr>
                                                  <tr align="center">
                                                    <td width="90">Mode paiement&nbsp;:</td>
                                                    <td width="176">
                                                    	<select class="form-control" name="id_modeP" id="mode" requered>
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
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td width="29"><div id="lb_justif" style="display:none">Justification&nbsp;:</div></td>
                                                    <td width="139"><textarea class="form-control"  name="justif" id="justif" style="display:none"></textarea></td>
                                                     <td width="0"><input type="text" class="form-control"  name="insert_rapide" id="insert_rapide" value="insertion_rapide" style="display:none"></td> 
                                                  </tr>
                                                </table>
											</div>
                                            <br>
                                            <div style="margin-left:70px;">
                                                <table width="937" height="50" border="0">
                                                  <tr valign="top">
                                                  	<td width="460">
                                                    	<a class="btn btn-primary" href="rec_detail_paiement _client.php?num_fact=<?php echo $_SESSION['num_fact'];?>&nom_client=<?php echo $_SESSION['nom_client'];?>&type=<?php echo $_SESSION['type'];?>&id_fact=<?php  echo $_SESSION['id_fact'];?>&reste=<?php echo $_SESSION['reste'];?>&montant_tot=<?php echo $_SESSION['montant_tot'];?>" style="font-style:italic;"><i class=" fa fa-arrow-left"></i>&nbsp;&nbsp;Précedent</a>
                                                    </td>
                                                    <td width="461" align="center">
                                                    	<button  name="sauvegarder" id="completer_paiement" type="submit" class="btn btn-danger"><i class=" fa fa-save"></i>&nbsp;&nbsp;Sauvegarder</button>
                                                        <div id="imprimer_fact" style="display:none;"><a href="../html2pdf/examples/recu_completer_paiement.php" target="_blank">Imprimer la facture</a></div>
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
 <script src="../Authentification/jquery-1.9.1.min.js"></script>  
 <script src="../Authentification/insertion_ajax.js"></script>

    <?php include('rec_footer.php'); ?>
