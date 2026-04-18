<!DOCTYPE html>
<html lang="fr">
<?php
include('head.php');
include '../FUNCTION/stock.php';
$depot = ListPOS($_SESSION['id_hotel'], $bdd);
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
                <a class="navbar-brand" href="Traitement/operation_affichage.php"><img src="images/logoKB1.png" /></a>
            </div>
            <!-- /.navbar-header -->

            <?php include('navigation.php'); ?>
            <?php include('menu.php'); ?>

        </nav>
        <!-- /.navbar-top-links -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"> Fiche de stock</h3>
                    <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Veuillez selectionner un catégorie et une date SVP!!!
                    </div>
                    <form class="form-inline" method="post" action="fiche_stock_view.php">
                        <div class="form-group">
                            <label for="ex3">Période du&nbsp;</label>
                            <input type="text" name="date_rapport" id="date_rapport" value="<?php echo date('d/m/Y') ?>" class="form-control" placeholder=" " style="width: 100px;">
                        </div>
                        <div class="form-group">
                            <label for="ex4">&nbsp;au&nbsp;</label>
                            <input type="text" name="date_PF" id="date_PF" value="<?php echo date('d/m/Y') ?>" class="form-control" placeholder=" " style="width: 100px;">
                        </div>
                        <div class="form-group">
                            <label for="ex4">&nbsp;Famille&nbsp;</label>
                            <select class="form-control" id="famille_id" name="famille_id" required>
                                <option value="0">Tout</option>
                                <?php
                                $requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
                                    . " WHERE f.hotel_id=:hotel_id AND f.plat=0 ORDER BY designation");
                                //session à enlever
                                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                $requete->execute();
                                $s_familles = $requete->fetchAll(PDO::FETCH_OBJ);

                                foreach ($s_familles  as $f) :
                                    echo '<option value=' . $f->idfamille . '>' . ucfirst($f->designation) . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <?php // if($visible==1){ 
                        ?>
                        <div class="form-group">
                            <label for="ex4">&nbsp;Dépôt&nbsp;</label>
                            <select class="form-control" id="depot_id" name="depot_id" required>
                                <?php
                                //Point de vente
                                foreach ($depot as $p) { ?>
                                    <option value='<?php echo $p->depot_id ?>' posname="<?php echo ucfirst($p->libelle) ?>"><?php echo ucfirst($p->libelle) ?> </option>;
                                <?php } ?>
                                <!-- <option value='0' posname="Tout">Tout</option>; -->
                            </select>
                        </div>
                        <?php // }
                        ?>
                        <button name="valider" id="valider" type="submit" class="btn btn-primary">Valider</button>
                        <span class="btn btn-danger hidden" id="loader">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                        </span>
                    </form>
                    <br>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" id="table_article">
                <?php include './tableau_stock_article.php'; ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php include('footer.php'); ?>

</body>

</html>