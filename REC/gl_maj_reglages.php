			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec_config.php');
			
			include '../bdd/connexion_mysql.php'; ?>
            
            <?php 
			$id_regl=$_GET['id_regl'];
                        $company_id= $_SESSION['company_id'];
			$result=mysql_query("SELECT * FROM  t_reglage c WHERE c.id_regl='$id_regl' AND c.company_id='$company_id'") or die(mysql_error());
			while($rows=mysql_fetch_assoc($result)){
				
			$id_regl=$rows['id_regl']; 	
			$remise=$rows['remise']; 
			$majoration=$rows['majoration'];
                        $tauxdollar=$rows['tauxdollar'];
                        $tva=$rows['tva'];
			$date_regl=$rows['date_regl'];
			$dte=explode("-",$date_regl);
			$dte_regl=$dte[2].'/'.$dte[1].'/'.$dte[0];
			$temps_regl=$rows['temps_regl'];
			}		   
			?>
     
        <div id="page-wrapper">
        		 <div class="row">
                                <div class="col-lg-12">
                                 <h3 class="page-header">Réglages</h3>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Modification du réglage</h4>
                                          <div style="margin-top:-40px; margin-left:790px;"><a class="btn btn-default btn-lg btn-block"  href="gg_voirreglages.php" style="width:180px;">Voir réglages</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:400px; border:1px solid #fff;">
                                        <BR>
                                           <form role="form" method="post"  action="">
                                           <fieldset>
                                          <table width="400" border="0" >
                                           <tr>
                                            <td align="right" > <label>Taux $ -> FC</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input name="tauxdollar" value="<?php echo $tauxdollar; ?>" class="form-control"  type="number" min="1.0" ></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                           <tr>
                                            <td align="right" > <label>TVA en %</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input name="tva" value="<?php echo $tva; ?>" class="form-control"  type="number" min="1.0" ></td>
                                          </tr>
                                          
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Rémise en %</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input name="remise" value="<?php echo $remise; ?>" class="form-control"  type="number" min="1.0" ></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Majoration en %</label></td>
                                            <td width="30"></td>
                                            <td align="center"> 
                                            <input name="majoration" class="form-control" value="<?php echo $majoration; ?>" type="number" min="1.0" value="">
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td> 
                                            
                                          </tr>
                                          <tr>
                                            <td align="right"><label>Date</label></td>
                                              <td width="30"></td>
                                            <td>
                                            <input name="date_regl" class="form-control" value="<?php echo $dte_regl; ?>" type="text"  value="" id="datetimepicker6">
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right"><label>Temps de la nuité</label></td>
                                              <td width="30"></td>
                                            <td>
                                              
                                            <input name="temps_regl"  type="time" class="form-control" value="<?php echo $temps_regl; ?>">
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

$remise=$_POST['remise']; 
$tauxdollar =$_POST['tauxdollar']; 
$tva=$_POST['tva']; 
$majoration=$_POST['majoration']; 
$date_regl=$_POST['date_regl'];
$date=explode(' ',$date_regl);
$date_reg=$date[0];
$dte_reg=explode('/',$date_reg);
$date_reglage=$dte_reg[2].'-'.$dte_reg[1].'-'.$dte_reg[0];
$temps_regl=$_POST['temps_regl'];

//_requete
$req_sql=mysql_query("UPDATE t_reglage SET 
remise='".$remise."',
majoration='".$majoration."',
date_regl='".$date_reglage."',
tauxdollar='".$tauxdollar."',
tva='".$tva."',
temps_regl='".$temps_regl."'
WHERE id_regl='$id_regl'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'".mysql_error()."'");
echo "<script>
alert('La modification est éffectuée avec succès');
document.location='gg_voirreglages.php'</script>";

}

?>
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

   <script src="../datepicker/jquery.js"></script>
	<script src="../datepicker/jquery.datetimepicker.js"></script>
    <script>
    $('#datetimepicker6').datetimepicker();
	$('#datetimepickerOcc').datetimepicker();
	$('#datetimepickerLib').datetimepicker();
    </script>
  <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
