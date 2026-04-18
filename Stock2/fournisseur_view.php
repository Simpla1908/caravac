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
                        <h2 class="page-header">
                            <?php 
                            if(isset($_GET['partenaire'])){ 
                                if ($_GET['partenaire']=='fournisseur') {
                                    echo 'Fournisseur';
                                } else {
                                    echo 'Bénéficiaire';
                                }
                            } 
                            ?>
                        </h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php 
                            if(isset($_GET['partenaire'])){ 
                                if ($_GET['partenaire']=='fournisseur') {
                                    echo '<a href="fournisseur_form.php?partenaire=fournisseur" title="Creer" class="btn btn-danger"><i class="fa fa-save"></i> Enregistrer</a>';
                                } else {
                                    echo '<a href="fournisseur_form.php?partenaire=beneficiaire" title="Creer" class="btn btn-danger"><i class="fa fa-save"></i> Enregistrer</a>';
                                }
                            } 
                            ?>
                           
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <!-- Affichage fournisseur -->
                           <?php 
                           if(isset($_GET['partenaire'])){ 
                                if ($_GET['partenaire']=='fournisseur') {
                                    include('./Traitement/fournisseur_affichage.php');
                                } else {
                                    include('./Traitement/beneficiaire_affichage.php');
                                }
                            } 
                           ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-condensed table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Noms</th>
                                            <th>Contacts</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;foreach($fournisseurs as $fournisseur):?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $fournisseur->nom_client?></td>
                                            <td><?php echo $fournisseur->telephone_client?></td>
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
