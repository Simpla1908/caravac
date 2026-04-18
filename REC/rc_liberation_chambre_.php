			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
                  <?php include('../FUNCTION/reference.php'); 
			$id_ch=$_GET['id_ch'];
			$num_ch=$_GET['num_ch'];
			$id_client=$_GET['id_client'];
			$nom_client=$_GET['nom_client'];
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
                                          <tr>
                                            <td align="right" ><label>N° Chambre&nbsp;:</label></td>
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
                                            <td align="right" ><label>Nom Client&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"> 
                                          <select class="form-control" name="id_client">
                                            <option value="<?php echo $id_client;?>"><?php echo $nom_client;?></option>;
                                            </select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label for="date">Date libération: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input id="date" type="date" class="form-control" name="date_lib" value="<?php echo date('Y-m-d');?>"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label for="date">Heure libération&nbsp;: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input id="date" type="time" class="form-control" name="heure_lib" value="<?php echo gmstrftime("%H h %M m %S s",time()+7200);?>"></td>
                                          </tr>
                                          
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                              <td width="30"></td>
                                              <td align="right"> <button name="sauvegarder" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Valider</button></td>
                                          </tr>
                                        </table>
                                         </fieldset>
                                                                                   
                                         </form>
                                          <?PHP
if(isset($_POST['sauvegarder'])){

$id_client=$_POST['id_client'];
$id_ch=$_POST['id_ch'];
$date_lib=date('Y-m-d');;
$heure_lib=gmstrftime("%H h %M m %S s",time()+7200);
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
