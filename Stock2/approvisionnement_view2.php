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
                <?php include('menu.php'); ?>

            </nav>
            <!-- /.navbar-top-links --> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                       <h3 class="page-header">Sortie / Transfert</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                            Liste
                            <div class="btn-group  btn-group-sm pull-right">
                                <a href="mouvement.php?operation=sortie" class="btn btn-danger" title="Enregistrer une sortie"><i class="fa fa-edit"></i> Enregistrer</a>
                                <a href="#" class="btn btn-primary" title="Filtrer"><i class="fa fa-calendar"></i> Filtrer</a>
                            </div>
                            </h4>
                        </div>
                        <div class="panel-body">
                          <!-- Affichage Operation-->
                           <?php 
                            if(isset($_GET['depot_id'])){
                                $vue=0;
                                $libelle_depot=$_GET['depot_name'];
                                $requete = $bdd->prepare("SELECT  * FROM stk_produit AS prod, stk__mouvement AS m 
                                WHERE prod.idprod=m.produit_id AND m.type='appro' AND m.depot_id=:depot_id
                                AND prod.repas=0 AND m.hotel_id=:hotel_id ORDER BY prod.designation");
                                $requete->BindParam(':depot_id', $_GET['depot_id']);
                                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                $requete->execute();
                                $mouvements_depot_details = $requete->fetchAll(PDO::FETCH_OBJ);
                            }  else {
                                $vue=1;
                            }
                              include('Traitement/transfert_affichage.php');
                            ?>
                            
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="<?php if($vue==1){echo 'active';}?>"><a href="#home" data-toggle="tab">SORTIE</a>
                                </li>
                                <li class="<?php if($vue==0){echo 'active';}?>"><a href="#profile" data-toggle="tab">TRANSFERT</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade <?php if($vue==1){echo 'in active';}?>" id="home">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example2">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Bon n°</th>
                                                    <th>Nbre produit</th>
                                                    <th>Béneficiere</th>
                                                    <th>Date</th>
                                                    <th>Utilisateur</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX" id="">
                                                    <td>1</td>
                                                    <td>Fch0001</td>
                                                    <td>15</td>
                                                    <td>Mardo</td>
                                                    <td>23/11/2018 15:45:15</td>
                                                    <td>Mardo</td>
                                                    <td>
                                                        <a href="sortie_details.php?fiche_id=<?php echo "1" ?>"class="btn btn-info btn-xs" title='Details'>
                                                            <i class="fa fa-eye fa-fw"></i> Détails
                                                         </a>
                                                    </td>
                                                </tr>
                                               <?php  $i=1;foreach($mouvements as $ap):?>

                                                <tr class="odd gradeX" id="<?php echo $ap->idmvt;?>">
                                                    <td><?php echo $i ?></td>
                                                 <td><?php echo $ap->num_bon?></td>
                                                     <td><?php echo $ap->designation?></td>
                                                    <td>
                                                        <?php echo $ap->qte_sortie; ?>
                                                    </td>
                                                    <td><?php echo $ap->dte_appro_heure?></td>
                                                    <td>
                                                        <?php echo $ap->depot; ?>
                                                    </td>
                                                    <td>
                                                        <a href="operation_modif_form.php?numbon=<?php echo $ap->idmvt ?>&type=<?php echo $type ?>"class="btn btn-info btn-xs" title='Details'>
                                                            <i class="fa fa-list fa-fw"></i>
                                                         </a>
                                                    </td>
                                                </tr>
                                                <?php $i++;endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <div class="tab-pane fade <?php if($vue==0){echo 'in active';}?>" id="profile">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example22">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Bon n°</th>
                                                    <th>Point de vente</th>
                                                    <th>Nbre Produit</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX" id="">
                                                    <td>1</td>
                                                    <td>Fch0001</td>
                                                    <td>Mardo</td>
                                                    <td>15</td>
                                                    <td>23/11/2018</td>
                                                    <td>
                                                        <a href="transfert_details.php?fiche_id=<?php echo "1" ?>"class="btn btn-info btn-xs" title='Details'>
                                                            <i class="fa fa-eye fa-fw"></i> Détails
                                                         </a>
                                                    </td>
                                                </tr>
                                               <?php  $i=1;foreach($mouvements_depots as $ap):?>

                                                <tr class="odd gradeX" id="<?php echo $ap->depot_id;?>">
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $ap->libelle?></td>
                                                     <td><?php echo $ap->nbre_prod?></td>
                                                     <td><?php echo '23/11/2018'?></td>
                                                    <td>
                                                        <a href="transfert_details.php?fiche_id=<?php echo "1" ?>"class="btn btn-info btn-xs" title='Details'>
                                                            <i class="fa fa-eye fa-fw"></i> Détails
                                                         </a>
                                                    </td>
                                                </tr>

                                                <?php $i++;endforeach;?>
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

        <?php include('footer.php'); ?>

    </body>

</html>
