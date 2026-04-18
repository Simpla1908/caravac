			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); 
			include '../bdd/connexion_mysql.php';
			?>
            
       

        <div id="page-wrapper">
        				<br>
 <h1><b><center><?php echo strtoupper($_SESSION['nom_hotel']); ?></center></b></h1>
                        <div class="row">
                                <div class="col-lg-12">
                                <h1 class="page-header">Libération des Chambres</h1>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Libération</h4>
                                        
                                            <div style="margin-top:-42px; margin-left:470px;"><a class="btn btn-default btn-lg btn-block"  href="rec_situation_liberation.php" style="width:295px;"><img src="../img/list.png">&nbsp;Situation Libération chambres</a></div>
                                            <div style="margin-top:-44px; margin-left:780px;"><a class="btn btn-default btn-lg btn-block"  href="rec_liste_paiement_client_loge.php" style="width:230px;"><img src="../img/paie.png">&nbsp;Paiement clients logés</a></div>
                                         </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:400px; border:1px solid #fff;">
                                        <BR>
                                           <form role="form" method="post" action="rc_liberation_chambre.php">
                                           <fieldset>
                                          <table width="400" border="0" >
                                       
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Nom Client&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"> 
                                           <select class="form-control" name="id_client">
                                                   <option></option>
                                                    <?php
$result=mysql_query("SELECT c.nom_client, c.id_client FROM  t_client c,t_occupation o, t_chambre b WHERE c.id_hotel='$id_hotel' AND c.id_client=o.id_client  AND b.id_ch=o.id_ch AND b.occupe='oui'  GROUP BY c.id_client ASC") or die(mysql_error());
while( $row = mysql_fetch_array($result))
{

 	echo '<option value="'.$row['id_client'].'">'.$row['nom_client'].'</option>';
 }
	mysql_free_result($result);
	?></select>
                                            </td>
                                          </tr>
                                             <tr>
                                            <td align="right" ><label>N° Chambre&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"> 
                                         <select class="form-control" name="id_ch">
                      <option></option>
                                                                                                       <?php
$result=mysql_query("SELECT c.id_ch,c.num_ch FROM  t_chambre c WHERE c.id_hotel='$id_hotel' AND c.occupe='oui' ORDER BY c.id_ch ASC") or die(mysql_error());
while( $row = mysql_fetch_array($result))
{

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
                                            <td align="right" ><label for="date">Date libération: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input id="date" type="date" class="form-control" name="date_lib"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label for="date">Heure libération&nbsp;: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input id="date" type="time" class="form-control" name="heure_lib"></td>
                                          </tr>
                                          
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                              <td width="30"></td>
                                              <td align="right"> <button name="sauvegarder" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Sauvegarder</button></td>
                                          </tr>
                                        </table>
                                         </fieldset>
                                                                                   
                                         </form>
                                          <?PHP
if(isset($_POST['sauvegarder'])){

$id_client=$_POST['id_client'];
$id_ch=$_POST['id_ch'];
$date_lib=$_POST['date_lib'];
$heure_lib=$_POST['heure_lib'];
$lib= new Liberation($id_client,$id_ch,$date_lib,$heure_lib);
$lib->liberer();
								}

?>
                                         </div>
                                         <!-- Image Chambre -->
                                        
                                         
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
