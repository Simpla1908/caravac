<?php
session_start();
include './bdd/connexion.php';
include '../FUNCTION/stock.php';
include './Traitement/fam_motif_edit.php';
if (isset($_GET['idfamille'])) {
    $fam_motifs = getfam_motif($_GET['idfamille'], $bdd);
    $requete = $bdd->prepare("SELECT * FROM  stk_familletype AS f WHERE f.sup=0 ORDER BY f.id");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':famille_id', $s_fam->id_s_fam);
    $requete->execute();
    $familletype = $requete->fetchAll(PDO::FETCH_OBJ);
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
                <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png" /></a>
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
                                        <a href="familles_view.php?module=MS" class="btn btn-primary" title="Vue liste"><i class="fa fa-list"></i> Voir</a>
                                    </div>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <?php
                                    foreach ($fam_motifs as $fam) :
                                        $famtypid = gettypefamilleid($bdd, $fam->idfamille);
                                    ?>
                                        <form role="form" id="form" action="Traitement/fam_modifier.php" method="post">
                                            <input type="hidden" name="idfamille" value="<?php echo $fam->idfamille; ?>">
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
                                                        <td width="247"><input type="text" class="form-control" name="designation" id="designation" value="<?php echo $fam->designation; ?>">
                                                            <input type="hidden" class="form-control" name="designation_ex" id="designation" required value="<?php echo $fam->designation; ?>">
                                                        </td>
                                                        </td>
                                                    </tr>
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="128" align="right">Type famille&nbsp;&nbsp;</td>
                                                        <td width="13"></td>
                                                        <td width="247">
                                                            <select class="form-control" id="familletype_id" name="familletype_id" required>
                                                                <?php
                                                                foreach ($familletype  as $f) :
                                                                    if ($f->id == $famtypid) {
                                                                        echo '<option selected="selected" value=' . $f->id . '>' . $f->nom . '</option>';
                                                                    } else {
                                                                        echo '<option value=' . $f->id . '>' . $f->nom . '</option>';
                                                                    }
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