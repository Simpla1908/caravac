<?php
    session_start();
    //Fusion horaire
    date_default_timezone_set('Africa/Kinshasa');
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
                        <h3 class="page-header">Approvisionnement <?php echo date("l"); ?></h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="msg_grp" class="alert alert-danger alert-dismissable" style="display:none;">
                                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                <span id="msg_alert_grp">L'enrégistrement s'est effectué avec succès!</span>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>
                                    Détails
                                    <div class="pull-right">
                                        <a href="impression/bon_appro.php" target="_blank" class="btn btn-primary btn-sm" title="Imprimer bon"><i class="fa fa-print"></i> Imprimer</a>
                                    </div>
                                    </h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- title row -->
                                    <div class="row">
                                      <div class="col-xs-12">
                                        <h3 class="page-header">
                                          <i class="fa fa-file-text"></i> Bon n°: Fch00001
                                          <small class="pull-right">Date: 2/10/2014</small>
                                        </h3>
                                          <br><br>
                                      </div>
                                      <!-- /.col -->
                                    </div>

                                    <!-- Table row -->
                                    <div class="row">
                                      <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped">
                                          <thead>
                                          <tr>
                                            <th>N°</th>
                                            <th>Product</th>
                                            <th>Quantité</th>
                                            <th>Unité</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          <tr>
                                            <td>1</td>
                                            <td>Call of Duty</td>
                                            <td>455-981-221</td>
                                            <td>$64.50</td>
                                          </tr>
                                          <tr>
                                            <td>1</td>
                                            <td>Need for Speed IV</td>
                                            <td>247-925-726</td>
                                            <td>$50.00</td>
                                          </tr>
                                          <tr>
                                            <td>1</td>
                                            <td>Monsters DVD</td>
                                            <td>735-845-642</td>
                                            <td>$10.70</td>
                                          </tr>
                                          <tr>
                                            <td>1</td>
                                            <td>Grown Ups Blue Ray</td>
                                            <td>422-568-642</td>
                                            <td>$25.99</td>
                                          </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <br>
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
        
        <?php include('footer.php'); ?>

    </body>

</html>
