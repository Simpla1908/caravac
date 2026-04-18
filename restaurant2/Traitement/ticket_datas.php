<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include './Panier.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/restaurant.php';
?>
<div class="row" id="monitoring_bloc">

</div>
<div class="active tab-pane fade in alltickets" id="tab1">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">TICKETS EN ATTENTE
                <button type="button" class="btn btn-default pull-right" id="annuler"><i class="ion-chevron-left"></i><i class="ion-chevron-left"></i> Retour
                </button>
            </h2>
        </div>
    </div>
    <?php
    $impr_row = 1;
    $compt_row = 4;
    $monnaie = $m_affiche;

    // Liste des tickets pour chaque sous resto
    if (in_array('AR7', $_SESSION['actions']['code_actions'])) {
        $requete = $bdd->prepare("SELECT  f.nbrcouvert,f.taux_prix,f.monnaie,f.montant_total,f.mont_tva,f.mont_ttc,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,f.date_edition,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type,c.user_attente  "
            . "FROM  t_reservation AS r,t_client AS c,t_facture AS f "
            . "WHERE f.type='restaurant' AND f.etat_cmd='1' AND f.id_client=c.id_client "
            . "AND r.id_res=f.id_res AND r.id_hotel=:hotel_id AND f.id_sousresto=:id_sousresto ORDER BY r.id_res ASC");
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->execute();
    } elseif (in_array('VSPTA', $_SESSION['actions']['code_actions'])) {
        $requete = $bdd->prepare("SELECT f.nbrcouvert,f.monnaie,f.montant_total,f.mont_tva,f.mont_ttc,f.mont_ttc_remise,f.taux,f.taux_prix,f.tva,f.id_fact,f.num_fact,f.date_edition,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type,c.user_attente "
            . "FROM  t_reservation AS r,t_client AS c,t_facture AS f "
            . "WHERE f.type='restaurant' AND f.etat_cmd='1' AND f.id_client=c.id_client "
            . "AND r.id_res=f.id_res AND r.id_hotel=:hotel_id AND f.id_sousresto=:id_sousresto AND f.id_user=:id_user ORDER BY r.id_res ASC");
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->BindParam(':id_user', $_SESSION['id_user']);
        $requete->execute();
    }
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
        $monnaie = $ra->monnaie;
        $tauxdollar = $ra->taux_prix;
        $user_attente = $ra->user_attente;
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
        $nbrcouvert = $ra->nbrcouvert;
    ?>
        <?php
        if ($impr_row == 1) {
            $impr_row = 0;
        ?>
            <div class="row">
            <?php }
            ?>
            <div class="col-md-3">
                <!-- DIRECT CHAT PRIMARY -->
                <div class="box box-default direct-chat direct-chat-primary panel panel-default">
                    <div class="box-header with-border center" align="center">
                        <h3 class="box-title">N° FAC :<?php echo $num_fact; ?></h3><br>
                        <h3 class="box-title">SERVEUR :<?php echo $nom_serveur; ?></h3><br>
                        <span data-toggle="tooltip" class="badge bg-green"><?php echo $cl_tbl; ?></span><br>
                        <h3 class="box-title">COUVERTS :<?php echo $nbrcouvert; ?></h3><br>
                    </div>
                    <?php
                    $cmd_num = $id_fact;
                    $cmd_id = 0;
                    $requete = $bdd->prepare("SELECT  p.idprod,l.qte,l.prix,p.designation,l.accomp,p.monnaie,l.commande_id FROM  lignes_commandes AS l,stk_produit As p WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id AND l.hotel_id=:hotel_id");
                    $requete->BindParam(':cmd_id', $cmd_num);
                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                    $requete->execute();
                    $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <table class="table table-hover table-condensed" id="tab_commandes">
                        <thead>
                            <th></th>
                            <th><a href='#'></a></th>
                            <th class='mailbox-attachment'>Qté</th>
                            <th class='mailbox-subject'> Désignation</th>
                            <th class='mailbox-attachment'></th>
                            <th class='mailbox-date text-right'>Prix</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($reservation_l_attente as $r) {

                                $tarif = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $r->prix) * $r->qte;
                                $mont_ht = $mont_ht + $tarif;
                                $cmd_id = $r->commande_id;
                                $description = $r->accomp;
                            ?>
                                <tr>
                                    <td></td>
                                    <td><a href='#'></a></td>
                                    <td class='mailbox-attachment' id="<?php echo $r->idprod ?>"><?php echo $r->qte ?></td>
                                    <td class='mailbox-subject'> <?php echo $r->designation . '</br>' . ' ' . $description; ?>
                                    </td>
                                    <td class='mailbox-attachment'></td>
                                    <td class='mailbox-date text-right'><?php echo afficheMontant2($m_affiche, $tarif) ?></td>
                                </tr>
                            <?php
                            };
                            $total1 = $mont_ht;
                            $total = total($mont_ht, $tva, $remise_fact);
                            $mont_ht = ht($total, $tva_fact, $remise_fact);
                            $mont_rmz = remise($total1, $tva_fact, $remise_fact);
                            $mont_tva = tva($total, $tva_fact, $remise_fact);
                            $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class='mailbox-attachment' colspan="5">Montant HT</th>
                                <th class="text-right">
                                    <i>
                                        <?php
                                        echo afficheMontant2($m_affiche, $mont_ht);
                                        ?>
                                    </i>

                                </th>
                            </tr>
                            <tr>
                                <th class='mailbox-attachment' colspan="5">TVA(<?php echo $tva_fact . ' %'; ?>)</th>
                                <th class="text-right">
                                    <i>
                                        <?php
                                        echo afficheMontant2($m_affiche, $mont_tva);
                                        ?>
                                    </i>

                                </th>
                            </tr>
                            <tr>
                                <th class='mailbox-attachment' colspan="5">Montant TTC</th>
                                <th class="text-right">
                                    <i>
                                        <?php
                                        echo afficheMontant2($m_affiche, $ttc);
                                        $mont_tot_panier_devise = montant_equivalent_bdd($m_affiche, getsymbole_devise(), $taux_op, montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $mont_ttc));
                                        $mont_tot_panier_devise_af = afficheMontant(getsymbole_devise(), $mont_tot_panier_devise);
                                        ?>
                                    </i>
                                </th>
                            </tr>
                            <tr>
                                <th class='mailbox-attachment' colspan="5">
                                    Remise(<?php echo arrondir($remise_fact) . ' %'; ?>)
                                </th>
                                <th class="text-right">
                                    <i>
                                        <?php
                                        echo afficheMontant2($m_affiche, $mont_rmz);
                                        ?>
                                    </i>
                                </th>
                            </tr>
                            <tr>
                                <th class='mailbox-attachment' colspan="5">NET A PAYER</th>
                                <th class="text-right">
                                    <i>
                                        <?php
                                        echo afficheMontant2($m_affiche, $ttc-$mont_rmz);
                                        ?>
                                    </i>

                                </th>
                            </tr>

                        </tfoot>
                    </table>
                    <input type="hidden" name="mont_tot_panier_devise" id="mont_tot_panier_devise" value="<?php echo $mont_tot_panier_devise; ?> ">
                    <input type="hidden" name="mont_tot_panier_devise_af" id="mont_tot_panier_devise_af" value="<?php echo $mont_tot_panier_devise_af; ?> ">
                    <input type="hidden" name="mont_tot_panier" id="mont_tot_panier" value="<?php echo $mont_ttc; ?> ">
                    <input type="hidden" name="mont_tot_panier_af" id="mont_tot_panier_af" value="<?php echo afficheMontant($m_affiche, montant_equivalent_bdd(getsymbole_devise(), $m_affiche, $tauxdollar, $mont_ttc)) ?> ">
                    <div class="box-footer">
                        <button class="btn btn-default btn-block monitorigFacture" id1="<?php echo $id; ?>" id2="<?php echo $cl_tbl; ?>" id3="<?php echo $id_cl; ?>" id4="<?php echo $cmd_id; ?>" id5="<?php echo $typ; ?>" id6="<?php echo $date_edition; ?>" id7="<?php echo $num_fact; ?>">Monitoring
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


</div>
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script>
    // JavaScript Document
    $(document).ready(function() {
        $("#annuler").click(function(e) {
            $("#c1").show();
            $("#c3").hide();
            $("#monitoring_bloc").hide();
        });
        $(".re_cmd").click(function(e) {
            var id1 = $(this).attr("id1");
            var id2 = $(this).attr("id2");
            var id3 = $(this).attr("id3");
            var id4 = $(this).attr("id4");
            var id5 = $(this).attr("id5");
            var id6 = $(this).attr("id6");
            $.ajax({
                url: 'Traitement/produits_panier.php',
                async: true,
                type: 'POST',
                data: "id1=" + id4,
                global: false,
                cache: false,
                success: function(html) {
                    //alert(html);
                    $("#cl_chxi").empty().append(id2);
                    $('#affiche_commandes').empty().append(html);
                    $("#c1").show();
                    $("#c3").hide();
                    $("#id_cmd").val(id1);
                    $("#client_id1").val(id3);
                    $("#idfactcl").val(id4);
                    $("#attente").val('attente');
                    $("#type_client").val(id5);
                    $("#dte_edite").val(id6);

                }
            });
        });

        $(".monitorigFacture").click(function(e) {

            $("#monitoring_bloc").show();
            $(".alltickets").hide();
            var id4 = $(this).attr("id4");
            var id6 = $(this).attr("id6");
            var id2 = $(this).attr("id2");
            var numfact = $(this).attr("id7");
            $.ajax({
                url: 'Traitement/monitoringdetails.php',
                async: true,
                type: 'POST',
                data: "cmd_id=" + id4 + "&dte_cmd=" + id6 + "&client=" + id2 + "&numfact=" +
                    numfact,
                global: false,
                cache: false,
                success: function(html) {
                    $('#monitoring_bloc').empty().append(html);
                }
            });
        });

        $("#monitoring_bloc").on('click', '#retourListTicket', function() {
            $(".alltickets").show();
            $("#monitoring_bloc").hide();
        });

        $("#monitoring_bloc").on('click', '#btn_impression_monitoring', function(e) {
            e.preventDefault();
            var cmd_id = $("#cmd_id").val();
            var dte_cmd = $("#dte_cmd").val();
            var client = $("#client").val();
            var numfact = $("#numfact").val();
            window.open('impression/examples/monitoring.php?cmd_id=' + cmd_id + '&dte_cmd=' + dte_cmd +
                '&numfact=' + numfact + '&client=' + client);

        });

    });
</script>