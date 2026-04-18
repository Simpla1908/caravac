			
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>

        <div id="page-wrapper">
               <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Hôtels</h1>
                </div>
                <!-- /.col-lg-12 -->
              </div>
            <!-- /.row -->
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Ajout d'un hôtel</h4>
                                          <!--<div style="margin-top:-39px; margin-left:620px;"><a class="btn btn-default btn-lg btn-block"  href="#" style="width:130px;">Mise à jours</a></div>-->
                                          <div style="margin-top:-40px; margin-left:820px;"><a class="btn btn-default btn-lg btn-block"  href="gg_hotel.php" style="width:200px;"><img src="../img/list.png">&nbsp;Liste des hôtels</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:400px; border:1px solid #fff;">
                                        <BR>
                                           <form role="form">
                                           <fieldset>
                                          <table width="400" border="0" >
                                          <tr>
                                            <td align="right" ><label>Nom&nbsp;: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input type="text" class="form-control"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Adresse&nbsp;: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input type="text" class="form-control"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Province&nbsp;: </label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input type="text" class="form-control"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Ville&nbsp;: </label></td>
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
                                         <div style=" width:400px; height:250px;margin-left:500px; margin-top:-250px; border:1px solid #FFF;" >
                                         	<img src="../img/hotel.png">
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
	
   <?php include('gg_footer.php'); ?>
