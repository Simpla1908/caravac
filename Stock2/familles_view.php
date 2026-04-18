<!DOCTYPE html>
<html lang="fr">
<?php
include('head.php');
include '../FUNCTION/stock.php';
?>

<body>
    <?php include('Rapport/liste_produit_famille.php'); ?>
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
                    <div class="panel panel-default">
                        <div class="alert alert-success alert-dismissable msg_sup" style="display:none;">
                            La suppression s'est effectué avec succès!
                        </div>
                        <div class="panel-heading">
                            <h4>
                                Liste des familles
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="famille_form.php?module=MS" class="btn btn-primary" title="Ajouter la famille d'un produit"><i class="fa fa-plus-circle"></i> Ajouter</a>
                                </div>
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Affichage motif -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example5">
                                    <?php include('./Traitement/familles_affichage.php'); ?>
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Désignation</th>
                                            <th>Vente</th>
                                            <?php if (in_array('VMR', $_SESSION['actions']['code_actions'])) { ?>
                                                <th>Fiche Tech.</th>
                                            <?php } ?>
                                            <th>Type famille</th>

                                            <th class="align-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($familles as $f) : ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $f->designation ?></td>
                                                <?php if ($f->affichage == 1) { ?>
                                                    <td><input type="checkbox" name="affichage_famille" class="affichage_famille" id="<?php echo $f->idfamille ?>" value="<?php echo $f->idfamille ?>" checked="checked"></td>
                                                <?php } else { ?>
                                                    <td><input type="checkbox" name="affichage_famille" class="affichage_famille" id="<?php echo $f->idfamille ?>" value="<?php echo $f->idfamille ?>"></td>
                                                <?php } ?>
                                                <?php if (in_array('VMR', $_SESSION['actions']['code_actions'])) { ?>
                                                    <?php if ($f->fiche_tech == 1) { ?>
                                                        <td><input type="checkbox" name="famille_fiche_tech" class="famille_fiche_tech" id="<?php echo $f->idfamille ?>" value="<?php echo $f->idfamille ?>" checked="checked"></td>
                                                    <?php } else { ?>
                                                        <td><input type="checkbox" name="famille_fiche_tech" class="famille_fiche_tech" id="<?php echo $f->idfamille ?>" value="<?php echo $f->idfamille ?>"></td>
                                                    <?php } ?>
                                                <?php } ?>
                                                <td><?php echo gettypefamillelib($bdd, gettypefamilleid($bdd, $f->idfamille)); ?></td>

                                                <td class="align-center">
                                                    <a href="fam_update.php?idfamille=<?php echo $f->idfamille ?>&module=MS" id="<?php echo $f->idfamille ?>" class="btn btn-primary btn-xs produit_detail222" title='Modifier'>
                                                        <i class="fa fa-edit fa-fw"></i> Modifier
                                                    </a>
                                                    <a id="<?php echo $f->idfamille; ?>" title="Supprimer" class="btn btn-danger btn-xs confirmModalLink3" data-toggle="modal" data-target="#myModalFAM"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                                </td>

                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
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