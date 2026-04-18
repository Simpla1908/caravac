<?php
session_start();
include './bdd/connexion.php';
if (isset($_GET['depot_id'])) {
    $requete = $bdd->prepare("SELECT * FROM  t_depot AS f WHERE f.hotel_id=:hotel_id AND f.id_depot=:depot_id ");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':depot_id',$_GET['depot_id']);
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
        <?php include('Rapport/liste_produit_famille.php'); ?>
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
                    <a class="navbar-brand" href="Traitement/operation_affichage.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>
                <?php include('./Traitement/dateUS_fr.php'); ?>

            </nav>
            <!-- /.navbar-top-links --> 
            <div id="affichage_before_impression">
                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">
                                Apercu sur un depot 
                            </h3>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <?php foreach ($depots as $d): ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="alert alert-success alert-dismissable msg_sup" style="display:none;">
                                            La suppression s'est effectué avec succès!
                                            </div>
                                                <div class="panel-heading barre-cmd">
                                                    <!--<a href="impression/examples/recu_bon_sortie.php?idfamille=<?php echo $fam->idfamille; ?>" title="Imprimer" class="btn btn-primary" id="btn_imprimer_be" target="_blank"><i class="fa fa-print fa-fw"></i> Imprimer</a>-->
                                                    <a href="depot_update.php?id_depot=<?php echo $d->id_depot; ?>&module=MS" title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Modifier</a>
                                                     <!--<a id="<?php echo $d->id_depot; ?>" title="Supprimer" class="btn btn-danger confirmModalLink3" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>-->
                                                </div>
                                            <div class="panel-body barre-cmd">
                                                <div class="row">
                                                    <form role="form" id="form" action="Traitement/operation_insertion.php">
                                                        <input type="hidden" name="entree" value="e">
                                                        <input type="hidden" name="sortie" value="sortie">
                                                        <input type="hidden" name="idoperation" value="">
                                                        <br/>
                                                        <div class="col-lg-12">

                                                            <div class="table-responsive" align="center">
                                                                <table width="874">
                                                                    <tr>
                                                                        <td width="130">Libelle&nbsp;&nbsp;</td>
                                                                        <td width="321">
                                                                            <?php
                                                                            echo ': ' .$d->libelle;
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr height="15">
                                                                        <td></td>
                                                                    </tr>
                                                                   
                                                                   

                                                                </table>
                                                            </div>

                                                        </div>
                                                    </form>
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
<?php endforeach; ?>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /#page-wrapper -->
            </div>
            <!-- /#affichage_before_impression-->
        </div>
        <!-- /#wrapper -->

<?php include('footer.php'); ?>

    </body>

</html>
