			<?php include('Receptionniste.php');?>
            <?php include('head.php'); ?>
			<?php include('menu_Rec_config.php'); 
			include '../bdd/connexion_mysql.php';
			?>
            
            <?php 
			$id_rep=$_GET['id_rep']; 
			$result=mysql_query("SELECT c.id_respo,c.nom_respo,c.telephone_respo,c.adresse_respo,c.entreprise FROM  t_responsable c WHERE c.id_respo='$id_rep' ") or die(mysql_error());
			while($rows=mysql_fetch_assoc($result)){
				
			$nom_respo=$rows['nom_respo']; 
			$telephone_respo=$rows['telephone_respo']; 
			$entreprise=$rows['entreprise'];
			$adresse_respo=$rows['adresse_respo'];
			}		   
			?>
     
        <div id="page-wrapper">
               <div class="row">
                <div class="col-lg-12">
                      <h3 class="page-header">Partenaire</h3>
                </div>
                <!-- /.col-lg-12 -->
              </div>
            <!-- /.row -->
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>
                                                Modification
                                                <div class="btn-group  btn-group-sm pull-right">
                                                    <a href="gg_liste_partenaire.php" class="btn btn-default" title="Liste des partenaires"><i class="fa fa-list"></i> Liste des partenaires</a>
                                                </div>
                                            </h4>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            
                                            <br />
                    <form method="post"  action=""  data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Nom Entreprise <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nomE" value="<?php echo $entreprise; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adresse_hotel">Adresse <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="adresseE" value="<?php echo $adresse_respo; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="province_hotel" class="control-label col-md-3 col-sm-3 col-xs-12">Responsable</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="respo" value="<?php echo $nom_respo; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="contact" value="<?php echo $telephone_respo; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                <button type="submit" name="send" class="btn btn-success">Sauvegarder</button>
                            </div>
                        </div>

                    </form>
                    <?php
if(isset($_POST['send'])) {

$nom_respo = $_POST['respo'];
$telephone_respo = $_POST['contact'];
$entreprise = $_POST['nomE'];
$adresse_respo = $_POST['adresseE'];
//_requete
$req_sql = mysql_query("UPDATE t_responsable SET 
nom_respo='" . $nom_respo . "',
telephone_respo='" . $telephone_respo . "',
adresse_respo='" . $adresse_respo . "',
entreprise='" . $entreprise . "'
WHERE id_respo='$id_rep'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
                        echo "<script>
alert('La modification est éffectuée avec succès');
document.location='gg_liste_partenaire.php'</script>";
                    }
                    ?>
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
