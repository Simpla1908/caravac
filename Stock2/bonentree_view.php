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
                        
                       <h2 class="page-header">Liste des entrées</h2>
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <a href="bon_entre.php" title="Creer" class="btn btn-danger"> Créer</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Affichage Operation -->
                           <?php include('./Traitement/operation_affichage.php');?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>N° Bon</th>
                                            <th>Libellé</th>
                                            <th>Motif</th>
                                            <th>Montant</th>
                                            <th>Provenance</th>
                                            <th>Date</th>
                                            <th>Caisse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $i=1;foreach($operations as $operation):?>
                                        <tr class="odd gradeX"> 	
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $operation->numBon?></td>
                                             <td><?php echo $operation->libelle?></td>
                                            <td><?php echo $operation->designation?></td>
                                            <td><?php echo $operation->montantUSD.'$'.' & '.$operation->montantFC.'FC'?></td>
                                            <td><?php echo $operation->beneficiaire?></td>
                                            <td><?php echo $operation->date_heure_bon?></td>
                                            <td><?php echo $operation->mode_operation?></td>
                                            
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
