<?php
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
include('../../FUNCTION/hebergement.php');
include('../../FUNCTION/restaurant.php');
include('../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
$periode = $_POST['periode'];
/* Conversion periode */
$transpostion_periode = explode(' ', $periode);
$date1 = $transpostion_periode[0];
$caractere = $transpostion_periode[1];
$date2 = $transpostion_periode[2];
/* Conversion date1 */
$transpostion_date1 = explode('/', $date1);
$jour = $transpostion_date1[0];
$mois = $transpostion_date1[1];
$annee = $transpostion_date1[2];
$date_bd1 = $annee . '-' . $mois . '-' . $jour;
/* Conversion date2 */
$transpostion_date2 = explode('/', $date2);
$jour2 = $transpostion_date2[0];
$mois2 = $transpostion_date2[1];
$annee2 = $transpostion_date2[2];
$date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
$_SESSION['date_bd1'] = $date_bd1;
$_SESSION['date_bd2'] = $date_bd2;



$impr_row = 1;
$compt_row = 4;
// Liste des tickets pour chaque sous resto
$requete = $bdd->prepare("SELECT f.id_user,f.etat_cmd, f.preparer,f.montant_total,f.mont_tva,f.mont_ttc,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,f.date_edition,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type,f.nomcaisse "
    . "FROM  t_reservation AS r,t_client AS c,t_facture AS f "
    . "WHERE f.type='restaurant' AND f.id_client=c.id_client "
    . "AND r.id_res=f.id_res AND r.id_hotel=:hotel_id AND f.cuisine=1 AND f.preparer=1 AND (f.date_edition BETWEEN :date_bd1 AND :date_bd2) ORDER BY r.id_res,f.preparer ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':date_bd1', $date_bd1);
$requete->BindParam(':date_bd2', $date_bd2);
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
        ?>
        <div class="col-md-3">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-default direct-chat direct-chat-primary panel panel-default">
                <div class="box-header with-border center" align="center">
                    <h3 class="box-title">N° FAC :<?php echo $num_fact; ?></h3><br>
                    <h3 class="box-title">SERVEUR :<?php echo $nom_serveur; ?></h3><br>
                    <h3 class="box-title">STATUT :<?php echo $_SESSION['statut_cmd']; ?></h3><br>
                    <span data-toggle="tooltip" class="badge bg-green"><?php echo $cl_tbl; ?></span>
                </div>
                <table class="table table-hover table-condensed" id="tab_commandes">
                    <tbody>
                        <?php if ($_SESSION['entree'] == 1) { ?>
                            <tr>
                                <td align="center" colspan="3">
                                    <b>ENTREES</b>
                                </td>

                            </tr>
                            <tr>

                                <th class='mailbox-subject'> DESIGNATION</th>
                                <th class='mailbox-attachment'>QTE</th>
                                <th></th>
                            </tr>


                            <?php
                            $compteur_entree = 0;
                            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                $repas = $_SESSION['panier']['repas'][$i];
                                $genre = $_SESSION['panier']['genre'][$i];

                                if ($repas == 1 && $genre == 1) {
                            ?>
                                    <tr>
                                        <td class='mailbox-subject'><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></td>
                                        <td class='mailbox-attachment'><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                        <td></td>

                                    </tr>
                            <?php
                                    $compteur_entree = $compteur_entree + $_SESSION['panier']['qte'][$i];
                                }
                            }
                            ?>
                            <tr>
                                <td><b>TOTAL ENTREES</b></td>
                                <td><b><?php echo $compteur_entree; ?></b></td>
                                <td></td>

                            </tr>
                        <?php } ?>
                        <?php if ($_SESSION['plats'] == 1) { ?>
                            <tr>
                                <td align="center" colspan="3">
                                    <b>PLATS</b>
                                </td>

                            </tr>
                            <tr>

                                <th class='mailbox-subject'> DESIGNATION</th>
                                <th class='mailbox-attachment'>QTE</th>
                                <th></th>
                            </tr>


                            <?php
                            $des_plt = '';
                            $kt = 0;
                            $compteur_plat = 0;
                            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                $repas = $_SESSION['panier']['repas'][$i];
                                $genre = $_SESSION['panier']['genre'][$i];
                                $des_plt = $_SESSION['panier']['description'][$i];
                                $plat_idc = $_SESSION['panier']['id_article'][$i];

                                if ($repas == 1 && $genre == 0) {
                            ?>
                                    <tr>
                                        <td class='mailbox-subject'><?php echo ucfirst($_SESSION['panier']['nom'][$i] . '</br>' . ' ' . $des_plt); ?></td>
                                        <td class='mailbox-attachment'><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                        <td></td>

                                    </tr>
                            <?php
                                    $compteur_plat = $compteur_plat + $_SESSION['panier']['qte'][$i];
                                }
                            }
                            ?>
                            <tr>
                                <td><b>TOTAL PLATS</b></td>
                                <td><b><?php echo $compteur_plat; ?></b></td>
                                <td></td>

                            </tr>
                        <?php } ?>
                        <?php if ($_SESSION['dessert'] == 1) { ?>
                            <tr>
                                <td align="center" colspan="3">
                                    <b>DESSERTS</b>
                                </td>

                            </tr>
                            <tr>

                                <th class='mailbox-subject'> DESIGNATION</th>
                                <th class='mailbox-attachment'>QTE</th>
                                <th></th>
                            </tr>


                            <?php
                            $compteur_dessert = 0;
                            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                $repas = $_SESSION['panier']['repas'][$i];
                                $genre = $_SESSION['panier']['genre'][$i];

                                if ($repas == 1 && $genre == 0) {

                            ?>
                                    <tr>
                                        <td class='mailbox-subject'><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></td>
                                        <td class='mailbox-attachment'><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                        <td></td>

                                    </tr>
                            <?php
                                    $compteur_dessert = $compteur_dessert + $_SESSION['panier']['qte'][$i];
                                }
                            }
                            ?>
                            <tr>
                                <td><b>TOTAL DESSERT</b></td>
                                <td><b><?php echo $compteur_dessert; ?></b></td>
                                <td></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                <div class="box-footer">
                    <button class="btn btn-default btn-block btn_print_bon" id="<?php echo $id_fact; ?>" n="<?php echo $cl_tbl; ?>">
                        Imprimer
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