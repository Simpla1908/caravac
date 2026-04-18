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
        <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png" /></a>
      </div>
      <!-- /.navbar-header -->

      <?php include('navigation.php'); ?>
      <?php include('menu.php'); ?>
      <?php
      $fiche_id = $_GET['fiche_id'];
      $fiche_num = $_GET['fiche_num'];
      $fiche_dte = $_GET['fiche_dte'];
      $user = $_GET['user'];
      $beneficiere = $_GET['beneficiere'];
      $requete = $bdd->prepare("SELECT  * FROM stk_produit AS prod, stk__mouvement AS m,t_motif_sortie AS s WHERE prod.idprod=m.produit_id AND m.motif_sortie_id=s.id_motif_sortie AND m.type='sortie' AND (m.qte_sortie>0 OR m.qte_declasse>0) AND m.hotel_id=:hotel_id AND m.fiche_id=:fiche_id ORDER BY prod.designation ASC");
      $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
      $requete->BindParam(':fiche_id', $fiche_id);
      $requete->execute();
      $mouvements = $requete->fetchAll(PDO::FETCH_OBJ);
      $requete = $bdd->prepare("SELECT  * FROM skt_fiche  WHERE id_fiche=:id_fiche");
      $requete->BindParam(':id_fiche', $fiche_id);
      $requete->execute();
      $fiche = $requete->fetch(PDO::FETCH_OBJ);
      $motifappro = $fiche->motifappro;
      $_SESSION['motifappro'] = $motifappro;
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
                <div class="pull-right">
                  <a href="approvisionnement_view.php?operation=sortie" class="btn btn-danger btn-sm" title="Liste"><i class="fa fa-bars"></i> Liste</a>
                  <a href="impression/bon_sortie.php" target="_blank" class="btn btn-primary btn-sm" title="Imprimer bon"><i class="fa fa-print"></i> Imprimer</a>
                  <?php if (in_array('SORM', $_SESSION['actions']['code_actions'])) { ?>
                    <a href="sortie_update.php?fiche_id=<?php echo $fiche_id; ?>&fiche_num=<?php echo $fiche_num; ?>&fiche_dte=<?php echo $fiche_dte; ?>&user_name=<?php echo $user; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Modifier</a>
                  <?php } ?>
                  <?php if (in_array('SORS', $_SESSION['actions']['code_actions'])) { ?>
                    <a op="sortie" id="<?php echo $fiche_id; ?>" href="#" class="btn btn-danger btn-sm btn_del_mvmt"><i class="fa fa-trash-o"></i> Supprimer</a>
                    <button class="btn btn-sm btn-danger hidden loader">
                      <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </button>
                  <?php } ?>

                </div>
                <div class="pull-right">

                </div>
              </h4>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h3 class="page-header">
                    <i class="fa fa-file-text"></i> Bon de sortie n°: <?php echo $fiche_num; ?>
                    <small class="pull-right">Date: <?php echo $fiche_dte; ?></small>
                  </h3>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Béneficière :
                  <address>
                    <strong><?php echo $beneficiere ?></strong><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Utilisateur :
                  <address>
                    <strong><?php echo $user ?></strong><br>
                  </address>
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
                        <th>Quantité</th>
                        <th>Unité</th>
                        <th>Motif</th>
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
                      $i = 1;
                      $benef = "";
                      $statut = 1;
                      sessionInfoBon($fiche_num, $fiche_dte, $user, $beneficiere, $statut);
                      foreach ($mouvements as $so) :
                        $qte = $so->qte_sortie;
                        if ($so->qte_declasse > 0) {
                          $qte = $so->qte_declasse;
                        }

                        //Mise en session pour impression
                        sessionDetailsBon($so->produit_id, $so->designation, $qte, 0, 0, $so->unite, $so->libelle);
                        //Fin mise en session

                      ?>
                        <tr class="odd gradeX">
                          <td><?php echo $i ?></td>
                          <td><?php echo $so->designation ?></td>
                          <td>
                            <?php echo $qte; ?>
                          </td>
                          <td><?php echo $so->unite ?></td>
                          <td><?php echo $so->libelle ?></td>

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