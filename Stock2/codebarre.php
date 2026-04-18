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
                        <h2 class="page-header">Articles</h2>
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
                                    Générer code barre
                                    <div class="btn-group  btn-group-sm pull-right">
                                        <a href="impression/codebarre.php" class="btn btn-primary" title="Afficher toutes les familles"><i class="fa fa-list"></i> Voir</a>
                                    </div>
                            </div>
                            <div class="panel-body">
                                <BR>
                                <form id="form111" method="post" action="impression/codebarre.php" target="_blank"  data-parsley-validate class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Article <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select class="form-control" id="produit_id" name="produit_id">
                                                <option>  </option>
                                                <?php
                                                include('./Traitement/produit_combo.php');
                                                foreach ($produits  as $prod):
                                                    echo '<option value=' . $prod->idprod.'>' . ucfirst($prod->designation).'</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                            <button type="submit" id="genere_code11" class="btn btn-success">Générer</button>
                                        </div>
                                    </div>
                                    
<!--                                    <div class="col-md-9 col-sm-9 col-xs-9 col-md-offset-3">
                                        <br>
                                        <svg id="barcode"></svg>
                                        <br>
                                    </div>-->

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
