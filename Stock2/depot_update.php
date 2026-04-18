<?php
session_start();
include './bdd/connexion.php';
include './Traitement/fam_motif_edit.php';
if (isset($_GET['id_depot'])) {
    $requete = $bdd->prepare("SELECT * FROM  t_depot AS f WHERE f.hotel_id=:hotel_id AND f.id_depot=:depot_id ");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':depot_id',$_GET['id_depot']);
    $requete->execute();
    $depots = $requete->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="fr">
    <?php
    include('head.php');
    ?>

    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>
                <?php include('Fonctions/fx_.php'); ?>
            </nav>
            <!-- /.navbar-top-links -->


           <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Famille</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div id="affichage_before_impression">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                            <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                            <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Modification
                                    <div class="btn-group  btn-group-sm pull-right">
                                        <a href="depot_view.php?module=MS" class="btn btn-primary" title="Vue liste"><i class="fa fa-list"></i> Voir</a>
                                    </div>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                      <?php
                                        foreach ($depots as $d):
                                       ?>
                                    <form id="form" method="post" action="Traitement/depot_modifier.php"  data-parsley-validate class="form-horizontal form-label-left">
                                    <input type="hidden" name="id_depot" value="<?php echo $d->id_depot; ?>">
                                        <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Libellé <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="libelle_depot" id="libelle_depot" required class="form-control col-md-7 col-xs-12" value="<?php echo $d->libelle; ?>">
                                            <input type="hidden" class="form-control" name="libelle_depot_ex" id="libelle_depot" required value="<?php echo $d->libelle; ?>">
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                            <button type="submit" id="update_depot" class="btn btn-success">Modifier</button>
                                        </div>
                                    </div>

                                </form>
<!--                                    <form  role="form" id="form" action="Traitement/fam_modifier.php" method="post">
                                        <input type="hidden" name="id_depot" value="<?php echo $d->id_depot; ?>">
                                      <div class="table-responsive">
                                                <table width="874">
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="128" align="right">Désignation&nbsp;&nbsp;</td>
                                                        <td width="13">
                                                          <td width="247"><input type="text" class="form-control" name="designation" id="designation" value="<?php echo $d->libelle; ?>">
                                                              <input type="hidden" class="form-control" name="designation_ex" id="designation" required value="<?php echo $d->libelle; ?>">
                                                          </td>  
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="128"></td>
                                                        <td width="13"></td>
                                                        <td width="247" align="right">
                                                            <button type="submit" class="btn btn-primary" id="update_famille">
                                                                <i class=" fa fa-save"></i>&nbsp;&nbsp;Modifier
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>
                                    </form>-->
                                    <?php endforeach; ?>
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
               </div>
                <!-- /#affichage_before_impression -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

<?php include('footer.php'); ?>

    </body>

</html>
