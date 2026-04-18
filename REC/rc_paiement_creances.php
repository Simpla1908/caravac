			
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>

        <div id="page-wrapper">
        				<br>
            			<div align="center" style="width:350px; height:37px; border:1px solid #999; padding-top:-10px; margin:auto;">
                       	 <h4><b>KA-BE DE LUXE LIMETE</b></h4>
                        </div>
                        <br>
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Paiements créances clients</h4>
                                           
                                          <div style="margin-top:-40px; margin-left:670px;"><a class="btn btn-default btn-lg btn-block"  href="rec_liste_paiement_creance_client.php" style="width:350px;"><img src="../img/list.png">&nbsp;Liste des paiements créances clients</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:400px; border:1px solid #fff;">
                                        <BR>
                                           <form role="form">
                                           <fieldset>
                                          <table width="400" border="0" >
                                          <tr>
                                            <td align="right" ><label>Dévise&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"> 
                                            <select class="form-control">
                                                <option>USD</option>
                                                <option>FC</option>
                                                <option>EUR</option>
                                            </select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Taux de change&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"> <input type="text" class="form-control" value="940.00"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label for="date">N° Piece&nbsp;: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input type="text" class="form-control"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Client&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"> 
                                            <select class="form-control">
                                            	<option></option>
                                                <option>KAMBWA SHABANTU MARCEL</option>
                                                <option>BUKASA KAZADI GLODY</option>
                                                <option>LANDU TAMBA SIMPLICE</option>
                                            </select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label for="date">Montant&nbsp;: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input type="text" class="form-control"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                              <td width="30"></td>
                                              <td align="right"> <button type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Sauvegarder</button></td>
                                          </tr>
                                        </table>
                                         </fieldset>
                                                                                   
                                         </form>
                                         </div>
                                         <!-- Image Chambre -->
                                         <div style=" width:400px; height:300px;margin-left:500px; margin-top:-300px; border:1px solid #000;" >
                                         
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
