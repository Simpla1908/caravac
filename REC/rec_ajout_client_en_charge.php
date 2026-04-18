			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php');
			include '../bdd/connexion_mysql.php'; 
			if( isset($_GET['id_client'])&&isset($_GET['nom_client'])&&isset($_GET['id_res'])){

				$id_client = $_GET['id_client'];
				$nom_client = $_GET['nom_client'];
				$id_res = $_GET['id_res'];
                                
                                $num_reserv = $_GET['num_reserv'];
                                $date_res = $_GET['date_res'];
                                $date_occ = $_GET['date_occ'];
                                $date_lib = $_GET['date_lib'];
                                $dte_a = $_GET['dte_a'];
                                $dte_s = $_GET['dte_s'];
			
			}
			
			?>
     
        <div id="page-wrapper" style=" height:auto">
                        <div class="row">
                                <div class="col-lg-12">
                                <h3 class="page-header">Client</h3>
                                    <div class="panel panel-default">
                                    
                                        <div class="panel-heading">
                                            <h4>Ajout d'un client
                                                <div class="pull-right">
                                                    <a class="btn btn-primary btn-xs" href="rec_ajout_occupation.php?num_reserv=<?php echo $num_reserv; ?>&id_client=<?php echo $id_client; ?>&nom_client=<?php echo $nom_client; ?>&id_res=<?php echo $id_res; ?>&date_res=<?php echo $date_res; ?>&date_occ=<?php echo $date_occ; ?>&date_lib=<?php echo $date_lib; ?>&dte_a=<?php echo $dte_a; ?>&dte_s=<?php echo $dte_s; ?>"><i class="fa fa-arrow-circle-left"></i> Retour</a>
                                                    <a class="btn btn-primary btn-xs" href="rec_liste_clients.php"><i class="fa fa-list"></i> Liste des clients</a>
                                                </div>
                                            </h4>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:350px; border:1px solid #fff;">
                                        <BR>
                                           <form role="form" method="post" action="">
                                           <fieldset>
                                          <table width="450" border="0" >
                                          <tr>
                                            <td align="right" ><label>Noms clients&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"><input class="form-control" name="nom_client" id="nom_client"type="text" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Date de naissance&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"><input class="form-control" type="date" id="datetimepicker6" name="date_naiss_client" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Sexe&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            	<select class="form-control" name="sexe_client" id="sexe_client">
                                                    <option></option>
                                                    <option>Masculin</option>
                                                    <option>Feminin</option>
                                            	</select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Etat civil&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            	<select class="form-control" name="etat_civil_client" id="etat_civil_client">
                                                    <option></option>
                                                    <option>Marié</option>
                                                    <option>Célibataire</option>
                                                    <option>Divorcé</option>
                                            	</select>
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Nationalité&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"><input class="form-control" type="text" id="nationalite_client" name="nationalite_client" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Est pris en charge par&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            <select class="form-control" name="id_respo" id="id_client">
						<option value="<?php echo $id_client ;?>"><?php echo $nom_client ;?></option>
 
   
                                            	</select>
                                            	
                                            </td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          
                                          <tr style=" display: none">
                                            <td align="right" > <label>Pour la réservation N°&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                                <input class="form-control" type="hidden" id="id_reservation" name="id_respo" value="<?php echo $id_res ;?>">
                                            <select class="form-control" name="id_respo1" id="id_reservation1">
											
  <?php
$result=mysql_query("SELECT id_res, num_reserv FROM  t_reservation WHERE id_client='$id_client'") or die(mysql_error());
while( $row = mysql_fetch_array($result))
{

 	echo '<option selected value="'.$row['id_res'].'">'.$row['num_reserv'].'</option>';
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
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          </table>
                                         </div>
                                         <!-- Formulaire suite -->
                                         <div style=" width:400px; height:370px;margin-left:500px; margin-top:-370px; border:1px solid #fff;" >
                                         	<table width="450" border="0">
                                            <tr>
                                            <td align="right" > <label>Provenance&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"><input class="form-control" type="text" id="provenance_client" name="provenance_client"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                            <tr>
                                            <td align="right" > <label>N° Pièce identité&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input class="form-control" type="number"id="num_piece_identite_client"  name="num_piece_identite_client" min="0"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <tr>
                                            <td align="right" > <label>N° Passeport&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input class="form-control" type="number" id="num_passeport_client" name="num_passeport_client" min="0"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>N° Contact&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input class="form-control" type="tel" id="telephone_client" name="telephone_client" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Adresse Provenance&nbsp;:</label></td>
                                            <td width="30"></td>
                                            <td align="center"> <input class="form-control" type="text"id="adresse_provenance_client"   name="adresse_provenance_client"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>Adresse email&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input class="form-control" type="email" id="email_client" name="email_client"></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td align="right" > <label>N° Personne à contacter&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input class="form-control" type="tel" id="num_pers_contacter_client" name="num_pers_contacter_client" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                              <td width="30"></td>
                                              <td align="right"> <button  id="btn_save_client_encharge" name="sauvegarder" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Sauvegarder</button></td>
                                          </tr>
                                        </table>
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

    <script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-modal.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });

</script>
<!-- Authentification -->
	<!--<script src="../js_auth/jquery.js"></script>-->
	<script src="../Authentification/control_userAjax.js"></script>
    <!-- Reservation -->
    <script src="Traitement_reservation/verification_reservation.js"></script>
    <script src="Traitement_reservation/script_paie.js"></script>