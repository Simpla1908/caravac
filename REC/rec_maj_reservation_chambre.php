				<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
            <?php include('../FUNCTION/reference.php'); ?>
             <?php 
			 include '../bdd/connexion_mysql.php';
			$id_hotel=$_SESSION['id_hotel'];
			 ?>
<?php 
if(isset($_GET['id_res'])){
$id_res=$_GET['id_res']; 
$result=mysql_query("SELECT r.symbolemon,r.date_res,r.date_occ,r.pmt,r.montantpaye,r.conversion,r.id_ch,r.id_client FROM  t_reservation r WHERE r.id_res='$id_res'") or die(mysql_error());
while($rows=mysql_fetch_assoc($result)){
$symbolemon=$rows['symbolemon']; 
$date_res=$rows['date_res'];
$date_occ=$rows['date_occ'];
$pmt=$rows['pmt'];
$montantpaye=$rows['montantpaye'];
$conversion=$rows['conversion'];
$id_ch=$rows['id_ch'];
$id_client=$rows['id_client'];
}
}
		   
?>


        <div id="page-wrapper">
        				<br>
            			
                       	 <h1><b><center>KA-BE DE LUXE LIMETE</center></b></h1>
                      
                 
                        <div class="row">
                                <div class="col-lg-12">
                                 <h1 class="page-header">Chambres</h1>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Mise à jours</h4>
                                    <!-- <div class="success" style="margin-top:-40px; margin-left:90px;">Une chambre ajoutée avec succes</div>-->
                                          <div style="margin-top:-40px; margin-left:790px;"><a class="btn btn-default btn-lg btn-block"  href="rec_reservation_chambre.php" style="width:320px;"><img src="../img/print.png">&nbsp;Situation réservation chambres</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:400px; border:1px solid #fff;">
                                       <BR>
                                           <form role="form" method="post" action="">
                                           <fieldset>
                                           <input type="hidden" name="id_res"  value="<?php echo $id_res;?>">
                                          <table width="500" border="0" >
                                          <tr>
                                            <td align="right" ><label>Symbole Mon.&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"> 
                                            <select class="form-control" name="symbolemon">
                                            <?php
                                            $tab[0]='FC';
										    $tab[1]='$';
											for($i=0;$i<2;$i++)
												{
													if($symbolemon==$tab[$i])
												echo "<option selected>".$symbolemon."</option>";
													else
													echo "<option>".$tab[$i]."</option>";
												}
										
											?>
                                            </select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
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
if($id_client==$row['id_client'])
 echo '<option value="'.$row['id_client'].'" selected>'.$row['nom_client'].'</option>';
else
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
                                                <option></option>
                                                                                                       <?php
$result=mysql_query("SELECT c.id_ch,c.num_ch,c.type_ch,c.etat_ch,c.tarif_ch FROM  t_chambre c WHERE c.id_hotel='$id_hotel' ORDER BY c.id_ch ASC") or die(mysql_error());
while( $row = mysql_fetch_array($result))
{
if($id_ch==$row['id_ch'])
 	echo '<option value="'.$row['id_ch'].'" selected>'.$row['num_ch'].'</option>';
	else
	echo '<option value="'.$row['id_ch'].'">'.$row['num_ch'].'</option>';
	
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
                                            <td align="right" > <label for="date">Date réservation&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            
                                            	 <input id="date"  type="date" class="form-control"  name="date_res" value="<?php echo $date_res;?>" required>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                           <tr>
                                            <td align="right" > <label for="date">Date occupation&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            	 <input id="date"  type="date" class="form-control"  name="date_occ" value="<?php echo $date_occ;?>" required>
                                            </td>
                                          </tr>
                                          
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Type PMT&nbsp;:</label> </td>
                                             <td width="30"></td>
                                            <td align="center"> 
                                            	<select class="form-control" name="pmt">
                                       
                                                    <?php
                                            $tab[0]='CASH';
										    $tab[1]='CREDIT';
											$tab[2]='DON';
											for($i=0;$i<3;$i++)
												{
													if($pmt==$tab[$i])
												echo "<option selected>".$pmt."</option>";
												
													else
													echo "<option>".$tab[$i]."</option>";}
											
										
											?>
                                            </select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                           <tr>
                                            <td align="right" > <label>Montant payé&nbsp;:</label> </td>
                                             <td width="30"></td>
                                           <td align="center" >  <div class="form-group input-group"> <span class="input-group-addon">$(FC)</span><input type="number" min="1" name="montantpaye" class="form-control" required value="<?php echo $montantpaye;?>"> <span class="input-group-addon">.00</span></div></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Taux de change&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input class="form-control" id="disabledInput" type="text" placeholder="940.00" disabled></td>
                                          </tr>
                                         <tr height="15">
                                            <td></td>
                                          </tr>
                                      
                                       <tr>
                                            <td align="right" width="200" > <label>Conversion&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center" >  <div class="form-group input-group"> <span class="input-group-addon">$(FC)</span><input type="number" min="1" name="conversion" class="form-control" required value="<?php echo $conversion;?>"> <span class="input-group-addon">.00</span></div></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                              <td width="30"></td>
                                              <td align="right"> <button  name="sauvegarder" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Sauvegarder</button></td>
                                          </tr>
                                        </table>
                                         </fieldset>
                                                                                   
                                         </form>
                                    <?PHP
if(isset($_POST['sauvegarder'])){
$symbolemon=$_POST['symbolemon'];	
$id_client=$_POST['id_client'];
$id_ch=$_POST['id_ch'];
$date_res=$_POST['date_res'];
$date_occ=$_POST['date_occ'];
$pmt=$_POST['pmt'];
$montantpaye=$_POST['montantpaye'];
$conversion=$_POST['conversion'];
$res= new Reservation('',$symbolemon,$date_res,$date_occ,'',$pmt,$montantpaye,$conversion,$id_ch,$id_client);
$res->maj_reservation_chambre($id_res);
								}

?>  </div>
                                         
                                         
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
