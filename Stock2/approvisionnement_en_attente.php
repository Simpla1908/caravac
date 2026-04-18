<?php
    session_start();
    //Fusion horaire
    date_default_timezone_set('Africa/Kinshasa');
    include('../bdd/connexion.php');
    $id_fiche = $_GET['id_fiche'];
    $num_bon = $_GET['num_bon'];
    $depot_id = $_GET['depot_id'];

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
            </nav>
            <!-- /.navbar-top-links -->

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Approvisionnement en attente</h3>
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
                            <form role="form" id="form" action="Traitement/appro_validation.php" method="post">
                            <input type="hidden" min="1" value="<?php echo $id_fiche; ?>" name="id_fiche">
                            <input type="hidden" min="1" value="<?php echo $num_bon; ?>" name="num_bon">
                            <input type="hidden" min="1" value="<?php echo $depot_id; ?>" name="depot_id">

                                <div class="panel-heading">
                                    <h4>
                                        Bon de livraison n° : <?php echo $num_bon; ?>
                                        <button id="appro_validate" type="submit" class="btn btn-danger btn-sm pull-right"><i class="fa fa-check"></i> Approuver</button>
                                         <span class="btn btn-danger hidden" id="loader"><i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...</span>
                                    </h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <br>                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example01">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>PRODUIT</th>
                                                    <th>QUANTITE ENVOYEE</th>
                                                    <th>QUANTITE RECUE</th>
                                                    <th>ECART</th>
                                                    <th>UNITE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                         <?php include('appro_attente.php'); ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                                 </form>
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
