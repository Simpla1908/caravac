<?php
session_start();
include './bdd/connexion.php';
include './Traitement/s_fam_motif_edit.php';
if (isset($_GET['id_s_fam'])) {
    $s_fam_motifs = gets_fam_motif($_GET['id_s_fam'], $bdd);
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
                        <h2 class="page-header">
                            Sous-famille
                        </h2>
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
                                <h4>
                                    Modification
                                    <div class="btn-group  btn-group-sm pull-right">
                                        <a href="sous_familles_view.php?module=MS" class="btn btn-primary" title="Vue liste"><i class="fa fa-list"></i> Voir</a>
                                    </div>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                      <?php
                                        foreach ($s_fam_motifs as $s_fam):
                                       ?>
                                    <form  role="form" id="form" action="Traitement/s_fam_modifier.php" method="post">
                                        <input type="hidden" name="id_s_fam" value="<?php echo $s_fam->id_s_fam; ?>">
                                      <div class="table-responsive">
                                                <table width="874">
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="128" align="right">Sous Famille&nbsp;&nbsp;</td>
                                                        <td width="13"></td>
                                                        <td width="247"><input type="text" class="form-control" name="designation" id="designation"  value="<?php echo $s_fam->des; ?>">
                                                            <input type="hidden" class="form-control" name="designation_ex" id="designation"  value="<?php echo $s_fam->des; ?>">
                                                        </td>  
                                                    </tr>
                                                     <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                       <tr>
                                                        <td width="128" align="right">Famille&nbsp;&nbsp;</td>
                                                        <td width="13"></td>
                                                        <td width="247">
                                                <select class="form-control" id="famille_id" name="famille_id" required>
                                                                  <?php
                                                echo '<option value='.$s_fam->idfamille .'>'.$s_fam->designation. '</option>';											
						include('Traitement/famille_combo2.php');
                                                foreach ($familles  as $f):
                                                echo '<option value='. $f->idfamille. '>'. $f->designation .'</option>';
                                                endforeach;
                                                ?>
                                                </select>
                                                        </td>  
                                                    </tr>
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="128"></td>
                                                        <td width="13"></td>
                                                        <td width="247" align="right">
                                                            <button type="submit" class="btn btn-primary" id="update_s_famille">
                                                                <i class=" fa fa-save"></i>&nbsp;&nbsp;Modifier
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>
                                    </form>
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
