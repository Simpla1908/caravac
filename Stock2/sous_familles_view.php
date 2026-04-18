<!DOCTYPE html>
<html lang="fr">
    <?php include('head.php'); ?>

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
                        <h2 class="page-header">Sous-familles</h2>
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
                                Liste des sous-familles
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="sous_famille_form.php?module=MS" class="btn btn-primary" title="Ajouter la sous famille d'un produit"><i class="fa fa-plus-circle"></i> Ajouter</a>
                                </div>
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <!-- Affichage motif -->
                           <?php include('./Traitement/sous_familles_affichage.php');?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example6">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Sous_famille</th>
                                            <th>Famille</th>
                                            <th class="align-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;foreach($sous_familles as $f):?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $i?></td>
                                            <td v="<?php echo $f->id_s_fam?>" class="td_modif"><?php echo $f->des ?></td>
                                            <td><?php echo $f->designation?></td>
                                             <td class="align-center">
                                              <a href="s_fam_update.php?id_s_fam=<?php echo $f->id_s_fam?>&module=MS" id="<?php echo $f->id_s_fam?>" class="btn btn-primary btn-xs produit_detail222" title='Modifier'>
                                               <i class="fa fa-edit fa-fw"></i> Modifier 
                                              </a>
                                              <a id="<?php echo $f->id_s_fam; ?>" title="Supprimer" class="btn btn-danger btn-xs btnshowmodalsfam"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                            </td>
                                       
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
