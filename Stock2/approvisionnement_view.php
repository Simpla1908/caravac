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
                    <a class="navbar-brand" href="Traitement/operation_affichage.php"><img src="images/logoKB1.png"/></a>
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
                        <h3 class="page-header">Sortie</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                            <span id="sous_titre">Liste</span><span id="titre"> du <?php echo $_SESSION['p_debut'].' au '.$_SESSION['p_fin'] ; ?></span>

                            <div class="btn-group  btn-group-sm pull-right">
                                <a href="mouvement.php?operation=sortie" class="btn btn-danger" title="Enregistrer une sortie"><i class="fa fa-edit"></i> Enregistrer</a>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#sortimodal" title="Filtrer"><i class="fa fa-calendar"></i> Filtrer</a>
                            </div>
                            </h4>
                        </div>
                        <div class="panel-body">
                          <!-- Affichage Operation-->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" id="tabsortie">SORTIE</a>
                                </li>
                                <!-- <li><a href="#profile" data-toggle="tab" id="tabtransfert">TRANSFERT</a>
                                </li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example2">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Bon n°</th>
                                                    <!--<th>Nbre produit</th>-->
                                                    <th>Béneficiere</th>
                                                    <th>Date</th>
                                                    <th>Utilisateur</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="odd gradeX" id="datasorti">
                                                <?php
                                                include('sorti_affichage.php');
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example22">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Bon n°</th>
                                                    <th>Point de vente</th>
                                                    <!--<th>Nbre Produit</th>-->
                                                    <th>Date</th>
                                                    <th>Utilisateur</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="odd gradeX" id="datatransfert">
                                               <?php
                                               include('transfert_affichage.php');
                                                 ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            
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
    <div class="modal fade" id="sortimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">Filtrage liste </h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form">
                    <input  id="typesorti" name="typesorti" value="sorti" type="hidden">
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
                    <button type="submit" class="btn btn-primary" id="btn_sorti_prev">&nbsp;Valider</button>
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
