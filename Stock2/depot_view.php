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

            </nav>
            <!-- /.navbar-top-links --> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Depôt d'approvisionnement</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                Liste des depôts
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="depot_form.php?module=MS" class="btn btn-primary" title="Ajouter un depot"><i class="fa fa-plus-circle"></i> Ajouter</a>
                                </div>
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <!-- Affichage motif -->
                           <?php include('./Traitement/depot_affichage.php');?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example55">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Libellé</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;foreach($depots as $d):?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $i ?></td>
                                            <td v="<?php echo $d->id_depot?>" class="td_modif"><?php echo $d->libelle?></td>
                                        </tr>
                                        <?php $i++;endforeach;?>
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

        <?php include('footer.php'); ?>

    </body>

</html>
