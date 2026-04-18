<?php
    session_start();
    //Fusion horaire
    date_default_timezone_set('Africa/Kinshasa');
    include('../bdd/connexion.php');
    include '../FUNCTION/stock.php';
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
                <?php include('menu.php'); ?>
                <?php 
                $fiche_id=$_GET['fiche_id'];
                $fiche_num=$_GET['fiche_num'];
                $fiche_dte=$_GET['fiche_dte'];
                $user=$_GET['user'];
                $approuve=$_GET['approuve'];
                $statut='Non approuvé';
                if($approuve==1){
                   $statut='Approuvé';  
                }
                $pos=$_GET['pos'];
                $requete = $bdd->prepare("SELECT  * FROM t_validation AS a,skt_fiche AS b,stk_produit AS c WHERE c.idprod=a.produit_id AND a.fiche_id=b.id_fiche AND a.hotel_id=:hotel_id AND a.fiche_id=:fiche_id ORDER BY c.designation ASC");
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':fiche_id', $fiche_id);
                $requete->execute();
                $mouvements = $requete->fetchAll(PDO::FETCH_OBJ);
                ?>
            </nav>
            <!-- /.navbar-top-links -->

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Sortie / transfert</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div id="msg_grp" class="alert alert-danger alert-dismissable" style="display:none;">
                            <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                            <span id="msg_alert_grp">L'enrégistrement s'est effectué avec succès!</span>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                Détails
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="approvisionnement_view.php?operation=sortie" class="btn btn-danger" title="Liste"><i class="fa fa-bars"></i> Liste</a>
                                    <a href="impression/bon_transfert.php" target="_blank" class="btn btn-primary btn-sm" title="Imprimer bon"><i class="fa fa-print"></i> Imprimer</a>
                                </div>
                                </h4>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <!-- title row -->
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3 class="page-header">
                                      <i class="fa fa-file-text"></i> Bon de transfert n°: <?php echo $fiche_num; ?>
                                      <small class="pull-right">Date: <?php echo $fiche_dte; ?></small>
                                    </h3>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                  <div class="col-sm-4 invoice-col">
                                    Point de vente
                                    <address>
                                      <strong><?php echo $pos; ?></strong><br>
                                    </address>
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 invoice-col">
                                    Utilisateur
                                    <address>
                                      <strong><?php echo $user; ?></strong><br>
                                    </address>
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 invoice-col">
                                      <b>Statut: <span class="label label-danger"><?php if($approuve==1){echo 'Approuvé';}else{echo 'Non approuvé';}?></span></b><br>
                                    <br>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <!-- Table row -->
                                <div class="row">
                                  <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                      <tr>
                                        <th>N°</th>
                                        <th>Product</th>
                                        <th>Qté envoyée</th>
                                        <th>Qté reçue</th>
                                        <th>Ecart</th>
                                        <th>Unité</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                         <?php
                                              //Mise en session pour impression
                                                $_SESSION['fiche'] = array();
                                                $_SESSION['fiche']['produit_id'] = array();
                                                $_SESSION['fiche']['designation'] = array();
                                                $_SESSION['fiche']['qte_env'] = array();
                                                $_SESSION['fiche']['qte_recue'] = array();
                                                $_SESSION['fiche']['ecart'] = array();
                                                $_SESSION['fiche']['unite'] = array();
                                                $_SESSION['fiche']['obs'] = array();

                                               //Fin mise en session
                                             $i=1;
                                             sessionInfoBon($fiche_num, $fiche_dte,$user, $pos, $statut);
                                             foreach($mouvements as $tr):
                                                 $ecart=$tr->qte_envoye-$tr->qte_verif;
                                                   //Mise en session pour impression
                                                    sessionDetailsBon($tr->produit_id, $tr->designation,$tr->qte_envoye,$tr->qte_verif,$ecart, $tr->unite,' ');
                                                   //Fin mise en session
                                                 ?>
                                             
                                                <tr class="odd gradeX">
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $tr->designation?></td>
                                                    <td>
                                                        <?php echo $tr->qte_envoye; ?>
                                                    </td>
                                                    <td><?php echo $tr->qte_verif;?></td>
                                                    <td><?php echo $ecart;?></td>
                                                     <td><?php echo $tr->unite;?></td>
                                                </tr>
                                                <?php 
                                                 $i++;
                                                 endforeach;
                                                 ?>
                                     
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <br>
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
        <!-- /.modal -->
        <?php include('footer.php'); ?>

    </body>

</html>
