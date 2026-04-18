<!DOCTYPE html>
<html lang="fr">
    <?php 
    include('head.php'); 
    include '../FUNCTION/stock.php';
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
                    <a class="navbar-brand" href="Traitement/operation_affichage.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>

            </nav>
            <!-- /.navbar-top-links --> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                       <h2 class="page-header">Produits</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class=" fa fa-list"></i> Liste des produits
                            <a href="produit.php" class="btn btn-primary pull-right btn-xs" title="Ajouter un produit"><i class="fa fa-plus-circle"></i> Ajouter</a>
                        </div>
                        <div class="panel-body">
                          <!-- Affichage Operation-->
                           <?php include('Traitement/produits_affichage.php');?>
                             <div class="table-responsive" id="listproduit">
                                <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example4">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Code</th>
                                            <th>Désignation</th>
                                            <th>Prix d'achat</th>
<!--                                            <th>Prix de vente</th>-->
                                            <th>Qté Min</th>
                                            <th>Unité</th>
                                            <th>Sous Famille</th>
                                            <th>Famille</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $i=1;foreach($produits as $p):
                                           $pa=montant_equivalent_bdd_stk($p->monnaie,$m_insert,$tauxdollar,$p->pa);
                                        ?>
                                        <tr class="odd gradeX"> 	
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $p->code?></td>
                                            <td><?php echo ucfirst($p->produit)?></td>
                                            <td><?php echo $pa.' '.$m_insert?></td>
                                            <td><?php echo $p->qte_min?></td>
                                            <td><?php echo $p->unite?></td>
                                            <td><?php echo ucfirst($p->des)?></td>
                                            <td><?php echo ucfirst($p->designation)?></td>
                                             <td>
                                              <a href="produit_modif_form.php?code=<?php echo $p->idprod?>" id="<?php echo $p->code?>" class="btn btn-info btn-xs produit_detail222" title='Details'>
                                               <i class="fa fa-eye fa-fw "></i> Détails 
                                              </a>
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
