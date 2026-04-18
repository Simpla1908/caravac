<?php include('Receptionniste.php'); ?>
<?php include('./headerRec_popup.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php include('../FUNCTION/checkdates.php'); ?>
<?php include('../FUNCTION/hebergement.php'); ?>
<?php require '_header.php'; ?>
<?php 
include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; 
$hrs_sys = date('H:i:s');
?>


<div id="page-wrapper" style=" height:auto;">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <?php
                /* Test d'affichage d'Occupation ou reservation à h2 */
                if (isset($_GET['hebergement'])) {
                    $hebergement = $_GET['hebergement'];
                    if ($hebergement == 1) {
                        echo 'Réservation '.$hrs_sys;
                    } else {
                        echo 'Occupation';
                    }
                }
                ?>
            </h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        <?php
                        /* Test d'affichage d'Occupation ou reservation à h2 */
                        if (isset($_GET['hebergement'])) {
                            $hebergement = $_GET['hebergement'];
                            if ($hebergement == 1) {
                                echo 'Sélection Chambres';
                            } else {
                                echo 'Sélection Chambres';
                            }
                        }
                        ?>
                    </h4>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <BR>
                    <form role="form" method="post" action="" id="">
                        <fieldset>
                            <input name="heberge" id="hebergement" type="hidden" value="<?php echo $hebergement; ?>">
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <br>
                                    Client:
                                    <address>
                                        <strong><?php echo ucfirst($_SESSION['nom_client']); ?></strong><br>
                                        Type client:<br>
                                        <?php echo ucfirst($_SESSION['type_cl']); ?>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <br>
                                    <address>
                                        <strong>Détails</strong><br>
                                        Date prévue d'arrivée: <?php echo $_SESSION['date_arrive']; ?><br>
                                        Date prévue de sortie: <?php echo $_SESSION['date_sorti']; ?><br>
                                        <font color="#FF0000">Soit <?php echo $_SESSION['nbre_jr']; ?> Jour(s)</font>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <span class="">Date: <?php echo $_SESSION['date_res']; ?> </span><br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            </div>
                            <div id="panier">
                                <div class="accordion panel panel-body" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel">
                                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h4 class="panel-title">Liste de chambres</h4>
                                        </a>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <div id="total_chambre" class="col-lg-12">
                                                    <div class="col-lg-6 pull-left">Total chambre&nbsp;:&nbsp;<?php echo count($_SESSION['panier']) ?></div>

                                                    <div class="col-lg-4 text-right">
                                                        Total à payer pour <?php echo $_SESSION['nbre_jr']; ?> jour(s):
                                                        <?php
                                                        if (empty($_SESSION['panier'])) {
                                                            $som = 0;
                                                        } else {
                                                            $som = 0;
                                                            $ids = array_keys($_SESSION['panier']);

                                                            $req = $bd->prepare('SELECT id_ch, num_ch, tarif_ch,monnaie FROM t_chambre WHERE id_ch in (' . implode(',', $ids) . ')');
                                                            $req->execute();
                                                            $chambre = $req->fetchAll(PDO::FETCH_OBJ);

                                                            foreach ($chambre as $ch):
                                                                // Affichage selon monnaie d'affichage définie                                   
                                                                if ($ch->monnaie == $m_affiche) {
                                                                    $tarif_ch = $ch->tarif_ch;
                                                                } else {
                                                                    if ($ch->monnaie = 'USD' && $m_affiche == 'CDF') {
                                                                        $tarif_ch = round($ch->tarif_ch * $tauxdollar, 2);
                                                                    } else {
                                                                        $tarif_ch = round($ch->tarif_ch * 1 / $tauxdollar, 2);
                                                                    }
                                                                }
                                                                $som+=$tarif_ch;
                                                            endforeach;
                                                        }


                                                        $_SESSION['montant_nuite'] = $som;
                                                        $_SESSION['total'] = $som * $_SESSION['nbre_jr'];
                                                        echo $_SESSION['total'] . ' ' . $m_affiche;
                                                        ?> 
                                                    </div>
                                                    <div class="col-lg-2 text-right">
                                                        <select name="remise" id="rem" class="form-control col-md-7 col-xs-12" required>
                                                            <?php
                                                            if (isset($_GET['rem'])) {
                                                                if ($_GET['rem'] == 0) {
                                                                    ?>
                                                                    <option value="0">0%</option>
                                                                    <option value="<?php echo $remise; ?>"><?php echo $remise; ?>%</option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $remise; ?>"><?php echo $remise; ?>%</option>
                                                                    <option value="0">0%</option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="0">Remise</option>
                                                                <option value="0">0%</option>
                                                                <option value="<?php echo $remise; ?>"><?php echo $remise; ?>%</option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                    </div> 
                                                </div> 
                                                <p>
                                                    <br>
                                                    <?php
                                                    $requete_chambre = $bdd->prepare("SELECT ch.id_ch,ch.tarif_ch,ch.num_ch,ch.monnaie, niv.lib_niv_cha, cat.lib_cat_cha                                               
                                                    FROM t_chambre AS ch
                                                    INNER JOIN categorie_chambre AS cat
                                                    ON ch.categorie=cat.id_cat_cha 
                                                    INNER JOIN niveau_chambre AS niv
                                                    ON ch.niveau=niv.id_niv_cha
                                                    WHERE ch.id_hotel=:id_hotel");

                                                    $requete_chambre->BindParam(':id_hotel', $_SESSION['id_hotel']);
                                                    $requete_chambre->execute();
                                                    $chambres = $requete_chambre->fetchAll(PDO::FETCH_OBJ);
                                                    ?>
                                                <table width="200" class="table_chambre table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>N° Chambre</th>
                                                            <th>Tarif</th>
                                                            <th>Catégorie</th>
                                                            <th>Niveau</th>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $indisponibles=getchambreIndisponibles($_SESSION['id_hotel'],$_SESSION['date_a'],$_SESSION['date_s'],$checkin,$temps_sortie,$hrs_sys,$bdd);
                                                    $i = 1;
                                                    foreach ($chambres as $ch){
                                                        $idch=$ch->id_ch;
                                                                         
                                                        if ($ch->monnaie == $m_affiche) {
                                                            $tarif_ch = $ch->tarif_ch;
                                                        } else {
                                                            if ($ch->monnaie = 'USD' && $m_affiche == 'CDF') {
                                                                $tarif_ch = round($ch->tarif_ch * $tauxdollar, 2);
                                                            } else {
                                                                $tarif_ch = round($ch->tarif_ch * 1 / $tauxdollar, 2);
                                                            }
                                                        }
                                                     if (!in_array($idch, $indisponibles['chambres']['id'])) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo 'Ch ' . $ch->num_ch ?></td>
                                                            <td><?php echo $tarif_ch . ' ' . $m_affiche ?></td>
                                                            <td><?php echo $ch->lib_cat_cha ?></td>
                                                            <td><?php echo $ch->lib_niv_cha ?></td>
                                                            <td><?php if ($hebergement == 1) { ?>
                                                                <input name="chambre[]" type="checkbox" value="<?php echo $ch->id_ch ?>" id="<?php echo $ch->id_ch ?>" class="checkbox_chambre" <?php if (isset($_SESSION['panier'][$ch->id_ch])) { ?> checked="checked" <?php } ?>/>
                                                                <?php } ?>
                                                                <?php if ($hebergement == 2) { ?>
                                                                    <input name="chambre[]" type="radio" value="<?php echo $ch->id_ch ?>" id="<?php echo $ch->id_ch ?>" class="checkbox_chambre_h2" <?php if (isset($_SESSION['panier'][$ch->id_ch])) { ?> checked="checked" <?php } ?>/>
                                                                <?php } ?>
                                                            </td>
                                                            <td style="display: none"><input id="hebergement" type="hidden" value="<?php echo $_SESSION['hebergement']; ?>"/></td>
                                                        </tr>
                                                    <?php 
                                                     }
                                                     $i++;
                                                     }
                                                    ?>
                                                </table>
                            <!--                    <input class="form-control" type="submit" name="send" id="add15" value="Ajouter"/>-->

                                                </p>
                                            </div>
                                            </form>

                                        </div>

                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                            </div>
                            <?php // include('rec_panier_chambre.php');  ?>
                            </div>

                            <div style="margin-left:70px;">
                                <table width="937" height="50" border="0">
                                    <tr valign="top">
                                        <td width="460">
                                            <?php if ($hebergement == 1) { ?>
                                                <a class="btn btn-primary" href="rec_reservation_multiple.php?hebergement=1" style="font-style:italic;"><i class=" fa fa-arrow-left"></i>&nbsp;&nbsp;Précedent</a>
                                            <?php } ?>
                                            <?php if ($hebergement == 2) { ?>
                                                <a class="btn btn-primary" href="rec_reservation_multiple.php?hebergement=2" style="font-style:italic;"><i class=" fa fa-arrow-left"></i>&nbsp;&nbsp;Précedent</a>
                                            <?php } ?>
                                        </td>
                                        <td width="182" align="right">
                                            <button  name="suivant" id="suivant2" type="submit" class="btn btn-primary"><i class=" fa fa-arrow-right"></i>&nbsp;&nbsp;Suivant</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>

                    </form>

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
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-modal.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });

</script>
<!-- Authentification -->
        <!--<script src="../js_auth/jquery.js"></script>-->
<script src="../Authentification/control_userAjax.js"></script>
<script>
    $(document).ready(function () {
//        alert('bon');
        $(".checkbox_chambre").click(function () {
            //            alert('bon2');
            var idchambre = $(this).attr('id');
            //             alert(idchambre);
            var donnees = $('#form_chambres').serialize();
            $.ajax({
                url: 'php/ajout_chambre_panier.php?idchambre=' + idchambre,
                type: 'POST',
                data: donnees,
                success: function (data) {
                    $("#total_chambre").empty().append(data);
                }
            });

        });
        $(".checkbox_chambre_h2").click(function () {
            //            alert('bon2');
            var idchambre = $(this).attr('id');
            //             alert(idchambre);
            var donnees = $('#form_chambres').serialize();
            $.ajax({
                url: 'php/ajout_chambre_panier_h2.php?idchambre=' + idchambre,
                type: 'POST',
                data: donnees,
                success: function (data) {
                    $("#total_chambre").empty().append(data);
                }
            });

        });
    });

</script>
<!-- Reservation -->
<script src="Traitement_reservation/verification_reservation.js"></script>
<script src="Traitement_reservation/script_paie.js"></script>

<?php
// include('rec_footer.php'); ?>