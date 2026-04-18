  <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include '../bdd/connexion.php';
    include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
    include '../../FUNCTION/hebergement.php';
    include('../../FUNCTION/restaurant.php');

    ?>

  <?php
    $impr_row = 1;
    $compt_row = 4;
    // Liste des tickets pour chaque sous resto
    $requete = $bdd->prepare("SELECT  f.id_user,f.montant_total,f.mont_tva,f.mont_ttc,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,f.date_edition,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type,c.user_attente "
        . "FROM  t_reservation AS r,t_client AS c,t_facture AS f "
        . "WHERE f.type='restaurant' AND f.etat_cmd='1' AND f.id_client=c.id_client "
        . "AND r.id_res=f.id_res AND r.id_hotel=:hotel_id AND f.cuisine=0 AND f.preparer=0 ORDER BY r.id_res ASC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reservation_attente as $ra) {
        $id = $ra->id_res;
        $date_edition = $ra->date_edition;
        $id_fact = $ra->id_fact;
        $num_fact = $ra->num_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ht = 0;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        $cmd_num = $ra->num_reserv;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $typ = $ra->type;
        $user_attente = $ra->id_user;
        //infos serveur
        $datas = InfosUser($user_attente, $bdd);
        $nom_serveur = $datas['nom_user'];
        //infos serveur
        if (($typ == 'client') || ($typ == 'serveur')) {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Client occasionnel';
        }
    ?>
      <?php
        if ($impr_row == 1) {
            $impr_row = 0;
        ?>
          <div class="row">
          <?php }
        $impr = 0;
        ReimprimerBC2($id_fact, $impr, $bdd);
        $nbArticles = count($_SESSION['panier']['id_article']);
        $statut_cmd = 'En cours';
        if ($_SESSION['preparer'] == 1) {
            $statut_cmd = 'Servi';
        }
        if ($_SESSION['etat_cmd'] == 3) {
            $statut_cmd = 'Annulé';
        }
            ?>
          <div class="col-md-3">
              <!-- DIRECT CHAT PRIMARY -->
              <div class="box box-default direct-chat direct-chat-primary panel panel-default">
                  <div class="box-header with-border center" align="center">
                      <h3 class="box-title">N° FAC :<?php echo $num_fact; ?></h3><br>
                      <h3 class="box-title">SERVEUR :<?php echo $nom_serveur; ?></h3><br>
                      <h3 class="box-title">STATUT :<?php echo $statut_cmd; ?></h3><br>
                      <span data-toggle="tooltip" class="badge bg-green"><?php echo $cl_tbl; ?></span>
                  </div>
                  <table class="table table-hover table-condensed" id="tab_commandes">
                      <tbody>

                          <tr>

                              <th class='mailbox-subject'> DESIGNATION</th>
                              <th class='mailbox-attachment'>QTE</th>
                              <th></th>
                          </tr>


                          <?php
                            $total = 0;
                            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                $repas = $_SESSION['panier']['repas'][$i];
                                if ($repas == 0 || $repas == 3) {
                            ?>
                                  <tr>
                                      <td class='mailbox-subject'><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></td>
                                      <td class='mailbox-attachment'><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                      <td></td>

                                  </tr>
                          <?php
                                    $total = $total + $_SESSION['panier']['qte'][$i];
                                }
                            }
                            ?>
                          <tr>
                              <td><b>TOTAL</b></td>
                              <td><b><?php echo $total; ?></b></td>
                              <td></td>

                          </tr>

                      </tbody>
                      <tfoot>

                      </tfoot>
                  </table>
                  <div class="box-footer">
                      <button class="btn btn-default btn-block btn_vld_preparation" id="<?php echo $id_fact; ?>">
                          Valider
                      </button>
                  </div>
              </div>
              <!--/.direct-chat -->
          </div>
          <!-- /.col -->
          <?php
            $compt_row--;
            if ($compt_row == 0) {
                $impr_row = 1;
                $compt_row = 4;
            }
            if ($impr_row == 1) {
                $impr_row = 1;
            ?>
          </div>
      <?php
            }
        ?>
  <?php }
    ?>