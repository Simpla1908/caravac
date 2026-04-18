<?php include('Receptionniste.php'); ?>
<?php include('./head.php'); ?>
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
                        echo 'Réservation';
                    } else {
                        echo 'Occupation';
                    }
                }
                ?>
            </h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    /* Test d'affichage d'Occupation ou reservation à h2 */
                    if (isset($_GET['hebergement'])) {
                        $hebergement = $_GET['hebergement'];
                        if ($hebergement == 1) {
                            echo '<i class="fa fa-eye"></i> Aperçu';
                        } else {
                            echo '<i class="fa fa-eye"></i> Sélection Chambres';
                        }
                    }
                    ?>
                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">
                    <BR>
                    <form role="form" method="post" action="" id="">
                        <fieldset>
                            <input name="time_checkin" id="time_checkin" type="hidden" value="<?php echo $checkin; ?>">
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
                           
                        </fieldset>
                        <!-- /fieldse -->
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.panel-body -->            
            </div> 
            <!-- /.panel panel-default -->
            
            <div class="row" id="panier">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-check-square-o"></i> Liste de chambres
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div id="total_chambre" class="col-lg-12">
                                    <div class="col-md-4">Total chambre: <?php echo count($_SESSION['panier']['id']) ?></div>
                                    <div class="col-md-5">
                                        Total à payer pour <?php echo $_SESSION['nbre_jr']; ?> jour(s):
                                        <?php
                                        
                                         if(isset($_SESSION['panier'])){
                                             $nbArticles = count($_SESSION['panier']['id']); 
                                             if($nbArticles==0){
                                                  $som = 0;
                                             }  else {
                                                 $som = 0;
                                                 for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                                     $tarif=$_SESSION['panier']['prix'][$i];
                                                     $monnaie=$_SESSION['panier']['monnaie'][$i];
                                                      $tarif_ch =montant_equivalent_bdd($monnaie,$m_affiche,$tauxdollar,$tarif);
                                                      $som+=$tarif_ch;
                                                 }
                                             }
                                         }
                                       
                                        $_SESSION['montant_nuite'] = $som;
                                        $_SESSION['total'] = $som * $_SESSION['nbre_jr'];
                                        echo afficheMontant($m_affiche,$_SESSION['total']);
                                        ?>
                                    </div>
                                    <div class="col-md-3">
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
                            </div>
                            <br>
                            <?php
                            $requete_chambre = $bdd->prepare("SELECT ch.id_ch,ch.tarif_ch,ch.num_ch,ch.monnaie, niv.lib_niv_cha, cat.lib_cat_cha                                               
                            FROM t_chambre AS ch
                            INNER JOIN categorie_chambre AS cat
                            ON ch.categorie=cat.id_cat_cha 
                            INNER JOIN niveau_chambre AS niv
                            ON ch.niveau=niv.id_niv_cha
                            WHERE ch.id_hotel=:id_hotel
                            AND ch.del=0");

                            $requete_chambre->BindParam(':id_hotel', $_SESSION['id_hotel']);
                            $requete_chambre->execute();
                            $chambres = $requete_chambre->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <div class="table-responsive">
                                <input id="m_affiche" type="hidden" value="<?php  echo $m_affiche; ?>">
                                <table class="table_chambre table table-striped table-bordered table-hover table-condensed">
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
                                    <tbody>
                                        <?php
                                        $indisponibles=getchambreIndisponibles($_SESSION['id_hotel'],$_SESSION['date_a'],$_SESSION['date_s'],$checkin,$temps_sortie,$hrs_sys,$bdd);
                                        $i = 1;
                                        foreach ($chambres as $ch){
                                            $idch=$ch->id_ch;
                                            $tarif_ch =montant_equivalent_bdd($ch->monnaie,$m_affiche,$tauxdollar,$ch->tarif_ch);
                                            
                                         if (!in_array($idch, $indisponibles['chambres']['id'])) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td>
                                                    <input type="hidden" id="nom<?php  echo $ch->id_ch; ?>"  value="<?php  echo 'Ch ' . $ch->num_ch; ?>">
                                                    <?php echo 'Ch ' . $ch->num_ch ?>
                                                </td>
                                                <td>
                                                        <div class="col-xs-8 input-group">
                                                            <input id="tarif<?php  echo $ch->id_ch; ?>" id1="<?php  echo $ch->id_ch; ?>" class="form-control prix_chambre" type="number" min="1" value="<?php  echo arrondir($tarif_ch); ?>">
                                                            <span class="input-group-addon"><?php  echo $m_affiche; ?></span>
                                                        </div>
                                                    <?php // echo afficheTarif($m_affiche,$tarif_ch,$tva); ?>
                                                </td>
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
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                            <br>
                            <div id="msg" class="alert alert-danger alert-dismissable" style="display: none">
                                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                            </div>
                            <div class="row" >
                                <div class="col-lg-12">
                                    <div class="box-footer">
                                        <?php if ($hebergement == 1) { ?>
                                            <a class="btn btn-default" href="rec_reservation_multiple.php?hebergement=1"><i class="fa fa-angle-double-left"></i> Précedent</a>
                                        <?php } ?>
                                        <?php if ($hebergement == 2) { ?>
                                            <a class="btn btn-default" href="rec_reservation_multiple.php?hebergement=2"><i class="fa fa-angle-double-left"></i> Précedent</a>
                                        <?php } ?>
                                        <span class="btn btn-danger pull-right hidden" id="loader"> <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez... </span>
                                        <button name="suivant" id="suivant2" type="submit" class="btn btn-primary pull-right">Suivant <i class="fa fa-angle-double-right"></i></button>
                                    </div>
                                    <!-- /.box-footer -->
                                </div>
                            </div>
                            <!-- /.row -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            
            
            
            
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
        $(".prix_chambre").keyup(function () {
            var idchambre = $(this).attr('id1');
//            alert(idchambre);
            $("#"+idchambre).prop('checked', false)
//            $("#"+idchambre).attr('checked','false');
      });
        $(".checkbox_chambre").click(function () {
            var action='del';
            if($(this).prop('checked')){
                action='add';
            }
            var monnaie = $("#m_affiche").val();
            var idchambre = $(this).attr('id');
            var tarif = $("#tarif"+idchambre).val();
            var nom = $("#nom"+idchambre).val();
            var donnees = $('#form_chambres').serialize();
            $.ajax({
                url: 'php/ajout_chambre_panier.php?idchambre=' + idchambre +'&action='+action
                        +'&tarif='+tarif +'&nom='+nom+'&monnaie='+monnaie,
                type: 'POST',
                data: donnees,
                success: function (data) {
                    $("#total_chambre").empty().append(data);
                }
            });

        });
        $(".table_chambre").on('click', '.checkbox_chambre_h2', function () {
            var action='del';
            if($(this).prop('checked')){
                action='add';
            }
            var monnaie = $("#m_affiche").val();
            var idchambre = $(this).attr('id');
            var tarif = $("#tarif"+idchambre).val();
            var nom = $("#nom"+idchambre).val();
            var donnees = $('#form_chambres').serialize();
            $.ajax({
                url: 'php/verif_occup_ch.php?idchambre=' + idchambre,
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#suivant2").addClass('hidden');
                },
                success: function (data) {
                  //  alert(data.bool_chamb_occup);
                    if(data.bool_chamb_occup==1){
                        $('#msg').show()
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text('Le client devra occuper cette chambre à partir de '+$('#time_checkin').val());
                        $('#'+idchambre).replaceWith('<input name="chambre[]" type="radio" value="'+idchambre+'" id="'+idchambre+'" class="checkbox_chambre_h2" />');
                    }else {
                        $('#msg').hide();
                        $.ajax({
                            url: 'php/ajout_chambre_panier.php?idchambre=' + idchambre +'&action='+action+'&tarif='+tarif +'&nom='+nom+'&monnaie='+monnaie+'&videpanier=ok',
                            type: 'POST',
                            data: donnees,
                            success: function (data1) {
                             //   alert(data1);
                                $("#total_chambre").empty().append(data1);
                            }
                        });
                    }

                    bool = true;
                }, complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                        $("#suivant2").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }, dataType: 'json'
            });

        });
    });

</script>
<!-- Reservation -->
<script src="Traitement_reservation/verification_reservation.js"></script>
<script src="Traitement_reservation/script_paie.js"></script>

<?php
// include('rec_footer.php'); ?>