			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); 
			include '../bdd/connexion_mysql.php';
			?>
     
        <div id="page-wrapper" style=" height:auto">
                        <div class="row">
                                <div class="col-lg-12">
                                <h3 class="page-header">Client</h3>
                                    <div class="panel panel-default">
                                    
                                        <div class="panel-heading">
                                            <h4>Ajout d'un client</h4>
                                            <div style="margin-top:-45px; margin-left:830px;"><a class="btn btn-default btn-lg btn-block"  href="rec_liste_clients.php" style="width:180px;"><img src="../img/list.png">&nbsp;Liste des clients</a></div>
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
                                                    <option>Marie</option>
                                                    <option>Celibataire</option>
                                                    <option>Divorce</option>
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
                                          
                                         
                                          <tr height="15">
                                            <td></td>
                                          </tr>
                                           <tr>
                                            <td align="right" > <label>Pris en charge par &nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center">
                                            <select class="form-control" name="id_respo" id="id_respo">
											  <?php
$result=mysql_query("SELECT DISTINCT r.id_respo,r.nom_respo,r.entreprise FROM  t_responsable r WHERE r.filtre!=1") or die(mysql_error());
while( $row = mysql_fetch_array($result))
{

 	echo '<option value="'.$row['id_respo'].'">'.$row['entreprise'].'</option>';
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
                                            <td align="right" > <label>Provenance&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"><input class="form-control" type="text" id="provenance_client" name="provenance_client"></td>
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
                                         <div style=" width:400px; height:350px;margin-left:500px; margin-top:-350px; border:1px solid #fff;" >
                                         	<table width="450" border="0">
                                            <tr>
                                            <td align="right" > <label>N° Pièce identité&nbsp;:</label></td>
                                             <td width="30"></td>
                                            <td align="center"> <input class="form-control" type="number" id="num_piece_identite_client"  name="num_piece_identite_client" min="0"></td>
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
                                              <td align="right"> <button  id="btn_save_client" name="sauvegarder" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Sauvegarder</button></td>
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

    <?php include('gl_footer.php'); ?>
