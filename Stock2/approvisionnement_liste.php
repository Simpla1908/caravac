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
                <?php include('menu.php'); 
                $_SESSION['p_debut']=date('d/m/Y');
                $_SESSION['p_fin']=date('d/m/Y');
                ?>
                
            </nav>
            <!-- /.navbar-top-links -->

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Approvisionnement</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                              <?php if(isset($_GET['msgapbr'])&&$_GET['msgapbr']==1){ ?>
                            <div id="msgapbr" class="alert alert-success alert-dismissable">
                                <span>Approbation effectuée avec succes!</span>
                            </div>
                            <?php
                        }
                        ?>
                            <div id="msg_grp" class="alert alert-danger alert-dismissable" style="display:none;">
                                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                <span id="msg_alert_grp">L'enrégistrement s'est effectué avec succès!</span>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>
                                    <span id="sous_titre">Liste</span><span id="titre"> du <?php echo $_SESSION['p_debut'].' au '.$_SESSION['p_fin'] ; ?></span>

                                        <div class="btn-group  btn-group-sm pull-right">
                                            <a href="approvisionnement.php" class="btn btn-danger" title="Approvisionner"><i class="fa fa-edit"></i> Approvisionner</a>
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#approvmodal" title="Filtrer"><i class="fa fa-calendar"></i> Filtrer</a>
                                        </div>
                                    </h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <br>                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example1">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Bon N°</th>
                                                    <th>Nbre produit</th>
                                                    <th>Motif</th>
                                                    <th>Date</th>
                                                    <th>Utilisateur</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dataappro">
                                            <?php include('appro_affichage.php'); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
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
        <!-- Modal -->
    <div class="modal fade" id="approvmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">Filtrage liste </h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 form-group">
                                    <label>Période du&nbsp;:</label>
                                    <input class="form-control" id="date1" name="datedebut" required="required" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6 form-group">
                                    <label>au&nbsp;:</label>
                                    <input class="form-control" id="date2" name="datefin" required="required" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="btn_appro_prev">&nbsp;Valider</button>
                     <span class="btn btn-danger hidden" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                     </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
        
        <?php include('footer.php'); ?>

    </body>

</html>
