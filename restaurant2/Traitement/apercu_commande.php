<?php
session_start();
include '../bdd/connexion.php';
include('../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
if (isset($_GET['numcom']) && !empty($_GET['numcom'])) {
    $num_reserv = $_GET['numcom'];
    $etatfact = $_GET['etat'];
    include './bc_commandes.php';
} else {
    $num_reserv = 0;
    include './bc_commandes.php';

}


foreach ($commandes1 as $commande) {
    $vendeur = $commande->user;
    $numcom = $commande->num_reserv;
    $nom_client = $commande->nom_client;
    $num_fact = $commande->num_fact;
    $dte = $commande->date_res;
    $designation = $commande->designation;
    $client_designation = $commande->client_designation;
    $montant_total = $commande->montant_total;
    $mont_tva = $commande->mont_tva;
    $mont_ttc = $commande->mont_ttc;
    $mont_ttc_remise = $commande->mont_ttc_remise;
    if ($m_affiche == 'USD') {
        $mont_ttc_remise_usd = $mont_ttc_remise;
        $mont_ttc_remise = $mont_ttc_remise;
    } else if ($m_affiche == 'CDF') {
        $mont_ttc_remise_usd = $mont_ttc_remise;
        $mont_ttc_remise = $mont_ttc_remise * $tauxdollar;
    }
    $remise = $commande->remise;
    $etat = $commande->etat;
    $id_fact = $commande->id_fact;
    $id_client = $commande->id_client;
    $id_res = $commande->id_res;
}
//Query Restaurant
$requete_resto = $bdd->prepare("SELECT c.id_fact,c.monnaie,c.mont_ttc_remise AS montant_resto,SUM(r.montant_dollar) AS montant_dollar,SUM(r.montant_fc) AS montant_fc
                                FROM t_reservation AS b, t_facture AS c,t_reglement AS r
                                WHERE b.id_res=c.id_res
                                AND b.id_hotel=:id_hotel 
                                AND c.id_fact=r.id_fact
                                AND b.type='commande' 
                                AND b.num_reserv=:num_reserv 
                                AND b.id_client=:client_id
                                AND r.rejete=0
                                GROUP BY c.id_fact");
$requete_resto->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_resto->BindParam(':client_id', $id_client);
$requete_resto->BindParam(':num_reserv', $num_reserv);
$requete_resto->execute();
$restaurant = $requete_resto->fetchAll(PDO::FETCH_OBJ);
$montant_resto = 0;
$montant_resto_fc = 0;
$montant_resto_usd = 0;
$factmonnaie = '';
$mont_paye_resto_tot = 0;
$montant_resto_tot = 0;
foreach ($restaurant as $resto) {
    $factmonnaie = $resto->monnaie;
    $montant_resto = $resto->montant_resto;
    $montant_resto_fc = $resto->montant_fc;
    $montant_resto_usd = $resto->montant_dollar;
    $comp = 1;
    //CALCUL MONTANT PAYE RESTO
    if ($factmonnaie == $m_affiche) {
        $montant_resto = $montant_resto;
    } else {
        if ($factmonnaie = 'USD' && $m_affiche == 'CDF') {
            $montant_resto = $montant_resto * $tauxdollar;
        } else {
            $montant_resto = $montant_resto * 1 / $tauxdollar;
        }
    }
    if ($m_affiche == 'USD') {
        $montantFCUSD = $montant_resto_fc * 1 / $tauxdollar;
        $mont_paye_resto = $montant_resto_usd + $montantFCUSD;
    } else if ($m_affiche == 'CDF') {
        $montantUSDFC = $montant_resto_usd * $tauxdollar;
        $mont_paye_resto = $montant_resto_fc + $montantUSDFC;
    }
    //FIN
    $montant_resto_tot += $montant_resto;
    $mont_paye_resto_tot += $mont_paye_resto;
}
$nap = round($montant_resto_tot, 2) - round($mont_paye_resto_tot, 2);
?>
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-10">
            Détails de la commande:&nbsp;<b><?php echo $numcom ?></b>
        </div>
        <div class="row">
            <div class="col-xs-1">
                <button type="button" class="btn btn-default" id="retour"><i class="ion-chevron-left"></i><i
                        class="ion-chevron-left"></i>Retour
                </button>
            </div>
            <div class="col-xs-1">
                <!--                    <a class="btn btn-success" href="../html2pdf/examples/recu_completer_paiement.php" target="_blank"><img src="../img/print.png">&nbsp;Imprimer la facture</a>-->
                <?php if ($etatfact != 'paye') { ?>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg"
                            id="paiement_additif">Payer
                    </button>
                <?php } ?>
                <form role="form" method="post" action="../restaurant/Traitement/reglement_commande_credit.php"
                      id="form" class="form-horizontal form-label-left">
                    <div class="modal fade bs-example-modal-lg" id="myModal_paie_resto" tabindex="-1" role="dialog"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                            aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Paiement</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div id="msg" class="alert alert-success alert-dismissable"
                                                 style="display:none;">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">&times;</button>
                                                <span id="msg_alert">L'enrégistrement s'est effectué avec succès!</span>
                                            </div>
                                            <div>

                                                <div class="panel-body">
                                                    <input name="taux" id="taux" type="hidden"
                                                           value=" <?php echo $tauxdollar; ?>"/>
                                                    <input name="id_fact" id="id_fact" type="hidden"
                                                           value="<?php echo $id_fact; ?>">
                                                    <input name="montant_tot" id="montant_tot" type="hidden"
                                                           value="<?php echo $mont_ttc_remise_usd; ?>">
                                                    <input name="id_client" id="client" type="hidden"
                                                           value="<?php echo $id_client; ?>">
                                                    <input name="id_res" id="id_res" type="hidden"
                                                           value="<?php echo $id_res; ?>">
                                                    <fieldset>
                                                        <div class="row invoice-info">

                                                            <div class="col-sm-4 invoice-col">
                                                                Client
                                                                <address>
                                                                    <strong>
                                                                        <?php
                                                                        if (empty($client_designation)) {
                                                                            echo $nom_client;
                                                                        } else {
                                                                            echo $client_designation;
                                                                        }
                                                                        ?>
                                                                    </strong><br>
                                                                </address>
                                                            </div>
                                                            <div class="col-sm-4 invoice-col">
                                                                Vendeur
                                                                <address>
                                                                    <strong><?php echo $vendeur ?></strong>
                                                                </address>
                                                            </div>
                                                            <div class="col-sm-4 invoice-col">
                                                                <b>Facture: <?php echo $num_fact ?></b><br>
                                                                <b>Montant à payer:</b> <?php
                                                                $mont_ttc_remise_lbl = 0;
                                                                if ($m_affiche == 'USD') {
                                                                    $mont_ttc_remise_lbl = round($mont_ttc_remise, 2);
                                                                    echo $mont_ttc_remise_lbl . ' ' . $m_affiche;
                                                                } else {
                                                                    echo $mont_ttc_remise . ' ' . $m_affiche;
                                                                }
                                                                ?><br>
                                                            </div>

                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        <br>
                                                        <div class="col-md-12 center-margin">
                                                            <div class="form-group">
                                                                <label>Montant en USD</label>
                                                                <input type="hidden" id="mont_usd_lbl"
                                                                       name="mont_usd_lbl"
                                                                       value="<?php echo $mont_ttc_remise_lbl; ?>">
                                                                <input type="text" class="form-control montant_py_resto"
                                                                       name="montantUSD" id="montantUSD"
                                                                       placeholder="Montant en Dollar">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Montant en CDF</label>
                                                                <input type="text" class="form-control montant_py_resto"
                                                                       name="montantFC" id="montantFC"
                                                                       placeholder="Montant en Franc Congolais">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Mode de paiement <span class="required">*</span></label>
                                                                <select class="form-control" name="mode" id="mode"
                                                                        requered>
                                                                    <?php
                                                                    $requete = $bdd->prepare("SELECT * FROM t_mode_reglement  WHERE id_mode_regl=2 ORDER BY lib");
                                                                    $requete->execute();
                                                                    $mode_regl = $requete->fetchAll(PDO::FETCH_OBJ);
                                                                    foreach ($mode_regl as $mg):
                                                                        echo '<option value=' . $mg->id_mode_regl . '>' . $mg->lib . '</option>';
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label id="lb_justif" style="display:none">Justification
                                                                    <span class="required">*</span></label>
                                                                <textarea style="display:none" name="justif" id="justif"
                                                                          class="form-control col-md-7 col-xs-12"></textarea>
                                                            </div>
                                                            <br>
                                                            <h4 class="box-title text-center">
                                                                Montant rendu : <b class="mont_rnd_cdf"> 0</b> CDF
                                                                <small> Soit</small>
                                                                <b class="mont_rnd_usd"> 0</b> USD
                                                            </h4>
                                                        </div>
                                                    </fieldset>

                                                </div>
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button name="sauvegarder" id="completer_paiement" type="submit"
                                            class="btn btn-danger"><i class=" fa fa-save"></i> Sauvegarder
                                    </button>
                                    <div id="imprimer_fact" style="display:none;"><a class="btn btn-success"
                                                                                     href="../html2pdf/examples/recu_completer_paiement.php"
                                                                                     target="_blank"><img
                                                src="../img/print.png">&nbsp;Imprimer la facture</a></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <div class="row invoice-info">

        <div class="col-sm-4 invoice-col">
            Client
            <address>
                <strong>
                    <?php
                    if (empty($client_designation)) {
                        echo $nom_client;
                    } else {
                        echo $client_designation;
                    }
                    ?>
                </strong><br>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            Vendeur
            <address>
                <strong><?php echo $vendeur ?></strong>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>Facture: <?php echo $num_fact ?></b><br>
            <b>Date:</b> <?php echo $dte ?><br>
            <b>Statut:</b> <?php
            if ($etatfact == 'paye') {
                echo 'Payée';
            } else if ($etatfact == 'ouverte') {
                echo 'Ouverte';
            } else {
                echo 'Non payée';
            }
            ?><br>
        </div>

    </div>

    <!-- Table row -->
    <div class="row" id="yyy">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $montant_total = 0;
                foreach ($commandes1 as $tbl):
                    //recuperation tva&remise de la commande & calcul
                    $tvalgcmd = $tbl->tva;
                    $remiselgcmd = $tbl->remise;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $tbl->designation ?></td>
                        <td><?php if ($m_affiche == 'USD') {
                                echo round($tbl->prix / $tauxdollar, 2) . ' ' . $m_affiche;
                            } else {
                                echo $tbl->prix . ' ' . $m_affiche;
                            } ?></td>
                        <td><?php echo $tbl->qte ?></td>
                        <td><?php if ($m_affiche == 'USD') {
                                echo round($tbl->qte * $tbl->prix / $tauxdollar, 2) . ' ' . $m_affiche;
                                $montant_cmd = ($tbl->qte * $tbl->prix) / $tauxdollar;
                            } else {
                                echo round($tbl->qte * $tbl->prix, 2) . ' ' . $m_affiche;
                                $montant_cmd = $tbl->qte * $tbl->prix;
                            } ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                    $montant_total += $montant_cmd;
                endforeach;
                 $mont_rmz = ($montant_total * $remiselgcmd) / 100;
                $mont_tva=($montant_total-$mont_rmz)* $tvalgcmd/100 ;
                $mont = $montant_total - $mont_rmz;
                $mont_ttc = $mont + $mont_tva
                ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-xs-6">

        </div>
        <div class="col-xs-6">
            <!--          <p class="lead">Amount Due 2/22/2014</p>-->

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width:50%">HT:</th>
                        <td><?php echo round($montant_total, 2) . ' ' . $m_affiche; ?></td>
                    </tr>
                    <tr>
                        <th>TVA:</th>
                        <td><?php echo round($mont_tva, 2) . ' ' . $m_affiche; ?></td>
                    </tr>
                    <?php if ($remise != 0.00) { ?>
                        <tr>
                            <th>Remise:</th>
                            <td><?php echo $remiselgcmd . '%'; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>TTC:</th>
                        <td><?php echo round($mont_ttc, 2) . ' ' . $m_affiche; ?></td>
                    </tr>
                    <tr>
                        <th>Acompte:</th>
                        <td><?php echo round($mont_paye_resto_tot, 2) . ' ' . $m_affiche; ?></td>
                    </tr>
                    <tr>
                        <th>Net à payer :</th>
                        <td><?php echo round($mont_ttc, 2) - round($mont_paye_resto_tot, 2) . ' ' . $m_affiche; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script>
    $(document).ready(function () {

        function effacer() {

            $(':input', '#form').not(':button,:submit,:reset,:hidden,\n\
                                   #optionsRadiosInline,#monnaie,#datebonentre,#optbanque')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
        }


        $('#retour').click(function (e) {
            $('#tab_com').load('./Traitement/listecommande.php');
        });
        $('#completer_paiement').click(function (e) {
            e.preventDefault();
//            var id_res=$("#id_res").val();
//            var id_fact=$("#id_fact").val();
//            var client=$("#client").val();
            var donnees = $('#form').serialize();
            $.ajax({
                url: '../restaurant/Traitement/reglement_commande_credit.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    if (data.message == 'succes') {
                        effacer();
//                        $('#msg').show()
//                                .addClass('alert-success')
//                                .removeClass('alert-danger');
//                        $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!");
                        $('#completer_paiement').attr('disabled', true);
                        $('#tab_com').load('./Traitement/listecommande.php');
                        $("#myModal_paie_resto").modal('hide');
                    } else if (data.message == 'modevide') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text("Vous avez oublié de selectionner le mode de paiement!");
                    } else if (data.message == 'montantvide') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text('Veuilez remplir les champs vides!');
                    } else if (data.message == 'montantinf') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text('veuillez vérifier le montant saisi!');
                    }

                }, dataType: 'json'
            });
        });
        $("#mode").change(onSelectChange);

        function onSelectChange() {
            var selected = $("#mode option:selected");
            $("#lb_justif").hide();
            $("#justif").hide();
            if (selected.val() != 0) {
                if (selected.val() == 1) {
                    $("#lb_justif").show();
                    $("#justif").show();
                } else {
                    $("#lb_justif").hide();
                    $("#justif").hide();
                }
            }


        }

        //Calcul montant rendu
        $('.montant_py_resto').keyup(function () {
            var mont_commandeUSD_tot = $("#montant_tot").val();
            var mont_commandeUSD = $("#montantUSD").val();
            var mont_commande = $("#montantFC").val();
            var taux = $("#taux").val();
            var donnees = " ";
            $.ajax({
                url: './traitement/montant_rendu.php?mont_commandeUSD_tot=' + mont_commandeUSD_tot + "&mont_commandeUSD=" + mont_commandeUSD + "&mont_commande=" + mont_commande + "&taux=" + taux,
                type: 'POST',
                data: donnees,
                success: function (data) {
                    $(".mont_rnd_cdf").empty().append(data.mont_rendu_cdf);
                    $(".mont_rnd_usd").empty().append(data.mont_rendu_usd);
                }, dataType: 'json'
            });
            return false;
        });
//fin calcul montant rendu

    });

</script>