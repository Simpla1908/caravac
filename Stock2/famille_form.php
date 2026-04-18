<!DOCTYPE html>
<html lang="fr">

<?php include('head.php'); ?>

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
                    <h2 class="page-header">Famille des produits</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span id="msg_alert">L'enrégistrement s'est effectué avec succès!</span>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                Ajout d'une famille
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="familles_view.php?module=MS" class="btn btn-primary" title="Afficher toutes les familles"><i class="fa fa-list"></i> Voir</a>
                                </div>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <BR>
                            <form id="form" method="post" action="Traitement/famille_insertion.php" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Désignation <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="designation" id="designation" required class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Type famille <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" id="familletype_id" name="familletype_id" required>
                                            <?php
                                            $requete = $bdd->prepare("SELECT * FROM  stk_familletype AS f WHERE f.sup=0 ORDER BY f.id");
                                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                            $requete->BindParam(':famille_id', $s_fam->id_s_fam);
                                            $requete->execute();
                                            $familletype = $requete->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($familletype  as $f) :
                                                echo '<option value=' . $f->id . '>' . $f->nom . '</option>';
                                            endforeach;
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                        <button type="submit" id="save_famille" class="btn btn-success">Sauvegarder</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                <!--                </form>-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include('footer.php'); ?>

</body>

</html>