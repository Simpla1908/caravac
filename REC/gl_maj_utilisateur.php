			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
            <?php include('../FUNCTION/checkpwd.php');
			include '../bdd/connexion_mysql.php';
			?>
            
            <?php 
			$id_user=$_GET['id_user']; 
			$result=mysql_query("SELECT u.id_user,u.nom_user,u.prenom_user,u.sexe_user,u.telephone_user,u.email_user,u.mdp_user,h.nom_hotel,h.id_hotel,d.id_droit,d.libe_droit FROM t_utilisateur u,t_hotel h,t_droit d WHERE u.id_hotel=h.id_hotel AND u.id_droit=d.id_droit AND u.id_user='$id_user' ") or die(mysql_error());
			while($rows=mysql_fetch_assoc($result)){
				
			$nom_user=$rows['nom_user']; 
			$prenom_user=$rows['prenom_user']; 
			$sexe_user=$rows['sexe_user'];
			$telephone_user=$rows['telephone_user'];
			$email_user=$rows['email_user']; 
			$mdp_user=$rows['mdp_user']; 
			$nom_hotel=$rows['nom_hotel'];
			$libe_droit=$rows['libe_droit'];
			$id_hotel=$rows['id_hotel'];
			$id_droit=$rows['id_droit'];
			}		   
			?>
     
        <div id="page-wrapper">
               <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Utilisateurs</h3>
                </div>
                <!-- /.col-lg-12 -->
              </div>
            <!-- /.row -->
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Création des utilisateurs</h4>
                                          <!--<div style="margin-top:-39px; margin-left:620px;"><a class="btn btn-default btn-lg btn-block"  href="#" style="width:130px;">Mise à jours</a></div>-->
                                          <div style="margin-top:-45px; margin-left:770px;"><a class="btn btn-default btn-lg btn-block"  href="gl_liste_utilisateur.php" style="width:230px;"><img src="../img/list.png">&nbsp;Liste des utilisateurs</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        <div style=" width:400px; border:1px solid #fff;">
                                        <BR>
                                           <form role="form" method="post" action="">
                                           <fieldset>
                                          <table width="460" border="0" >
                                          <tr>
                                            <td width="220" align="right" ><label>Nom&nbsp;: </label></td>
                                             <td width="67"></td>
                                            <td width="219" align="center"> <input type="text" class="form-control" name="nom_user" value="<?php echo $nom_user; ?>" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Prénom&nbsp;: </label></td>
                                             <td width="67"></td>
                                            <td align="center"> <input type="text" class="form-control" value="<?php echo $prenom_user; ?>" name="prenom_user" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Sexe&nbsp;: </label></td>
                                             <td width="67"></td>
                                            <td align="center"> 
                                            <select class="form-control" name="sexe_user">
                                             <?php
													$tab[0]='Masculin';
													$tab[1]='Feminin';
													for($i=0;$i<2;$i++)
														{
															if($sexe_user==$tab[$i])
														echo "<option selected>".$sexe_user."</option>";
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
                                            <td align="right" ><label>Téléphone&nbsp;: </label></td>
                                             <td width="67"></td>
                                            <td align="center"> <input type="tel" class="form-control" name="telephone_user" value="<?php echo $telephone_user; ?>" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Login&nbsp;: </label></td>
                                             <td width="67"></td>
                                            <td align="center"> <input value="<?php echo $email_user; ?>" type="text" class="form-control" name="email_user" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                           <tr>
                                            <td align="right" ><label>Mot de passe&nbsp;: </label></td>
                                             <td width="67"></td>
                                            <td align="center"> <input value="<?php echo $mdp_user; ?>" type="password" class="form-control" name="mdp_user" required></td>
                                          </tr>
                                            <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                            <tr>
                                            <td align="right" ><label>Confirmer Mot de passe&nbsp;: </label></td>
                                             <td width="67"></td>
                                            <td align="center"> <input type="password" value="<?php echo $mdp_user; ?>" class="form-control" name="mdp_user_" required></td>
                                          </tr>
                                          <tr height="15">
                                            <td></td>
                                            
                                          </tr>
                                          <tr>
                                            <td align="right" ><label>Fonction&nbsp;: </label></td>
                                             <td width="67"></td>
                                            <td align="center"> 
                                            <select class="form-control" name="id_droit">
                                                <option value="<?php echo $id_droit; ?>" selected><?php echo $libe_droit; ?></option>
                                                    <?php
$result=mysql_query("SELECT * FROM  t_droit d ORDER BY d.id_droit ASC") or die(mysql_error());
while( $row = mysql_fetch_array($result))
{

 	echo '<option value="'.$row['id_droit'].'">'.$row['libe_droit'].'</option>';
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
                                            <td align="right" ><label>Hôtel&nbsp;:</label></td>
                                            <td width="67"></td>
                                            <td align="center"> 
                                            <select class="form-control" name="id_hotel">
                                                <option value="<?php echo $id_hotel; ?>" selected><?php echo $nom_hotel; ?></option>
                                                    <?php
													$nom_hotel=$_SESSION['nom_hotel'];
$result=mysql_query("SELECT * FROM  t_hotel h ORDER BY h.id_hotel ASC") or die(mysql_error());
while( $row = mysql_fetch_array($result))
{

 	echo '<option value="'.$row['id_hotel'].'">'.$row['nom_hotel'].'</option>';
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
                                            <td>&nbsp;</td>
                                              <td width="67"></td>
                                              <td align="right"> <button type="submit" class="btn btn-primary" name="sauvegarder"><i class=" fa fa-save"></i>&nbsp;&nbsp;Sauvegarder</button></td>
                                          </tr>
                                        </table>
                                         </fieldset>
                                                                                   
                                         </form>
                                         <?PHP
if(isset($_POST['sauvegarder'])){
$nom_user=$_POST['nom_user'];
$prenom_user=$_POST['prenom_user'];
$sexe_user=$_POST['sexe_user'];
$telephone_user=$_POST['telephone_user'];
$email_user=$_POST['email_user'];
$mdp_user=$_POST['mdp_user'];
$mdp_user_=$_POST['mdp_user_'];
$id_hotel=$_POST['id_hotel'];
$id_droit=$_POST['id_droit'];

$booleen=checkpwd($mdp_user,$mdp_user_);
if($booleen=='true'){
//_requete
$req_sql=mysql_query("UPDATE t_utilisateur SET 
nom_user='".$nom_user."',
prenom_user='".$prenom_user."',
sexe_user='".$sexe_user."',
telephone_user='".$telephone_user."',
email_user='".$email_user."',
mdp_user='".$mdp_user."',
id_hotel='".$id_hotel."',
id_droit='".$id_droit."'
WHERE id_user='$id_user'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'".mysql_error()."'");
echo "<script>
			alert('La modification est éffectuée avec succès');
			document.location='gl_liste_utilisateur.php'
	</script>";
}
else{
	
	echo '<script>alert("Les deux mots de passe doivent etre identiques s.v.p");</script>';
	
	}

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

    <?php include('rec_footer.php'); ?>
