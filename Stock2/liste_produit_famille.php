<!DOCTYPE html>
<html lang="fr">
    <?php 
    if(isset($_GET['famille'])){
    $famille=$_GET['famille'];
    }
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
                <div id="liste" ></div>
                <div style="display: none;" id="view" >
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Produit par famille</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                <div class="row">
                   <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Liste des produits de la famille <span style="color:#1c94c4"><?php  echo $famille; ?></span></h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Affichage produit par famille -->
                            <?php include('./Traitement/liste_produit_famille_affichage.php');?>
                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered table-hover table-striped" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Code</th>
                                            <th>Désignation</th>
                                            <th>Initial</th>
                                            <th>Min</th>
                                            <th>P.A</th>
                                            <th>P.V</th>
                                            <th>Unité</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($produit_famille as $p_f):
                                            ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $p_f->code ?></td>
                                                <td><?php echo $p_f->designation ?></td>
                                                <td><?php echo $p_f->qte_initial ?></td>
                                                <td><?php echo $p_f->qte_min ?></td>
                                                <td><?php echo $p_f->pa ?> Fc</td>
                                                <td><?php echo $p_f->pv ?> Fc</td>
                                                <td><?php echo $p_f->unite ?></td>
                                            </tr>
                                    <?php $i++; endforeach; ?>
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
                <!-- /.view -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <?php include('footer.php'); ?>

    </body>

</html>
