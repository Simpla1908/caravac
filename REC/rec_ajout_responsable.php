			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); 
			$idhotel=1;
			
			?>
            

        <div id="page-wrapper">
        				<br>
            			
                       	 <h1><b><center>KA-BE DE LUXE LIMETE</center></b></h1>
                      
                 
                        <div class="row">
                                <div class="col-lg-12">
                                 <h1 class="page-header">Responsables</h1>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Ajout d'un responsable</h4>
                                    <!-- <div class="success" style="margin-top:-40px; margin-left:90px;">Une chambre ajoutée avec succes</div>-->
                                          <div style="margin-top:-40px; margin-left:790px;"><a class="btn btn-default btn-lg btn-block"  href="rec_consultation_responsable.php" style="width:205px;">Liste des  responsables</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:400px; border:1px solid #fff;">
                                        <BR>
                                           <form role="form" method="post"  action="">
                                           <fieldset>
                                          <table width="400" border="0" >
                                          <tr>
                                            <td align="right" > <label>Nom</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input name="nom_respo" class="form-control"  type="text" ></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Telephone</label></td>
                                            <td width="30"></td>
                                            <td align="center"> 
                                            <input name="telephone_respo" class="form-control"  type="tel" >
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right"><label>Adresse</label></td>
                                              <td width="30"></td>
                                            <td>
                                            <input name="adresse_respo" class="form-control" type="text" >
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          
                                          <tr>
                                            <td>&nbsp;</td>
                                              <td width="30"></td>
                                            <td> <button name="sauvegarder" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;Sauvegarder</button></td>
                                          </tr>
                                        </table>
                                         </fieldset>
                                                                                   
                                         </form>
<?PHP
if(isset($_POST['sauvegarder'])){
$nom_respo=$_POST['nom_respo'];	
$telephone_respo=$_POST['telephone_respo'];
$adresse_respo=$_POST['adresse_respo'];

$rec= new Responsable($nom_respo,$telephone_respo,$adresse_respo,$idhotel);
$rec->ajouterresponsable();
								}

?>
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

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    
     <!-- DataTables JavaScript -->
    <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>
