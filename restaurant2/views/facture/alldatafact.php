<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" class="facture" mode="cash">Factures Cash</a></li>
        <li><a href="#tab_mobile_money" data-toggle="tab" class="mobilemoney" mode="mobile">Factures Mobile money</a></li>
        <li><a href="#tab_2" data-toggle="tab" class="facture" mode="credit">Factures crédit</a></li>
        <!-- <li><a href="#tab_4" data-toggle="tab" class="facture" mode="don">Factures Don</a></li> -->
        <li><a href="#tab_3" data-toggle="tab" class="facture" mode="annuelees">Factures annulées</a></li>
        <li><a href="#tab_f" data-toggle="tab" class="facture" mode="fusion">Factures fusionnées</a></li>
        <li><a href="#tab_s" data-toggle="tab" class="facture" mode="bnsup">Bons de suppression</a></li>
        <input type="hidden" id="mode" name="mode" value="cash">
        <a href="#" class="btn btn-primary btn-sm pull-right" id="print_fact_all"><i class="fa fa-print"></i> facture crédit</a>
        <a href="#" class="btn btn-danger btn-sm" id="print_fact_alls"><i class="fa fa-print"></i> suppressions</a>

        <!-- <a href="#" class="btn btn-primary btn-sm pull-right" id="print_fact"><i class="fa fa-print"></i> Imprimer</a> -->
    </ul>
    <?php
    InitializePrintFacture();
    ?>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <table id="example1" class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Serveur</th>
                        <th>Date</th>
                        <th>Mode</th>
                        <th>Montant total</th>
                        <th>Montant Payé</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $totcash = 0;
                    $totdon = 0;
                    $tot1 = 0;
                    $tot2 = 0;
                    foreach ($result as $facture) {
                        $mode = $facture->mode;
                        if ($mode == 'Cash') {
                            $id_fact = $facture->id_fact;
                            $num_fact = $facture->num_fact;
                            $nom_client = $facture->nom_client;
                            if (empty($nom_client)) {
                                $nom_client = $facture->designation;
                            }
                            $nom_user = $facture->nom_user;
                            $date_edition = $facture->date_edition;
                            $mont_ttc = $facture->mont_ttc;
                            $taux_op = $facture->taux;
                            $taux_prix = $facture->taux_prix;
                                                
                            $mont_tot = $mont_ttc;
                            $p = TotPayeCommande2($id_fact, $bdd);
                            $mont_paye = montant_equivalent_bdd('CDF', $m_affiche, $taux_op, $p['paye']);
                            if ($mont_paye > $mont_tot) {
                                $mont_paye = $mont_tot;
                            }
                            //Mise en session pour impression
                            sessionPrintFacture($id_fact, $num_fact, $nom_client, $nom_user, $date_edition, $mode, $mont_paye, $mont_tot);
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo $nom_client ?></td>
                                <td><?php echo $nom_user ?></td>
                                <td><?php echo dateAffiche($date_edition) ?></td>
                                <td><?php echo $mode ?></td>
                                <td><?php echo afficheMontant2($m_affiche, $mont_tot); ?></td>
                                <td><?php echo afficheMontant2($m_affiche, $mont_paye); ?></td>
                                <td>
                                    <a class="btn btn-info btn-xs " href="?p=facture&d=details&id=<?php echo $id_fact ?>">
                                        <i class="fa fa-list"></i> Détails
                                    </a>
                                </td>
                            </tr>
                    <?php
                            $tot1 += $mont_tot;
                            $tot2 += $mont_paye;
                            $i++;
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6"><span class="pull-right">Total</span></th>
                        <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                        <th><?php echo afficheMontant2($m_affiche, $tot2); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <table class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Serveur</th>
                        <th>Date</th>
                        <!--<th>Mode</th>-->
                        <th>Montant total</th>
                        <th>Montant Payé</th>
                        <th>Solde</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $totcash = 0;
                    $totdon = 0;
                    $tot1 = 0;
                    $tot2 = 0;
                    foreach ($credits as $facture) {
                        $mode = $facture->mode;
                        $id_fact = $facture->id_fact;
                        $num_fact = $facture->num_fact;
                        $nom_client = $facture->nom_client;
                        if (empty($nom_client)) {
                            $nom_client = $facture->designation;
                        }
                        $nom_user = $facture->nom_user;
                        $date_edition = $facture->date_edition;
                        $mont_ttc = $facture->mont_ttc;
                        $taux_op = $facture->taux;
                        $taux_prix = $facture->taux_prix;
                        //                            $mont_tot = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $mont_ttc);
                        //                            $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, TotPayeCommande($id_fact, $bdd));
                        $mont_tot = round($mont_ttc, 2);
                        $p = TotPayeCommande2($id_fact, $bdd);
                        $mont_paye = montant_equivalent_bdd('CDF', $m_affiche, $taux_op, $p['paye']);
                        $solde = $mont_tot - $mont_paye;
                        $m_eqvt = getsymbole_devise();
                        if ($m_affiche == getsymbole_devise()) {
                            $m_eqvt = getsymbole_local();
                        }
                        $solde_eqv = montant_equivalent_bdd($m_affiche, $m_eqvt, $taux_op, $solde);
                        $resch_id = $facture->res_ch_id;
                        //Mise en session pour impression
                        sessionPrintFactureCredit($id_fact, $num_fact, $nom_client, $nom_user, $date_edition, $mode, $mont_paye, $mont_tot);
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $num_fact ?></td>
                            <td><?php echo $nom_client ?></td>
                            <td><?php echo $nom_user ?></td>
                            <td><?php echo dateAffiche($date_edition) ?></td>
                            <!--<td><?php // echo $mode  
                                    ?></td>-->

                            <td><?php echo afficheMontant2($m_affiche, $mont_tot); ?></td>
                            <td><?php echo afficheMontant2($m_affiche, $mont_paye); ?></td>
                            <td><?php echo afficheMontant2($m_affiche, $solde); ?></td>
                            <td>
                                <div style="display:inline-flex;">
                                    <a class="btn btn-info btn-xs" href="?p=facture&d=details&id=<?php echo $id_fact ?>">
                                        <i class="fa fa-list"></i> Détails
                                    </a>
                                    <?php if ($solde > 0) { ?>
                                        <button style="margin-left:10px;" type="button" class="btn btn-success btn-xs" id="btn_regler_credit_line" fact="<?php echo $id_fact ?>"><i class="fa fa-credit-card"></i> Payer</button>
                                        <input type="hidden" name="montant_fact" id="montant_fact<?php echo $id_fact ?>" value="<?php echo afficheMontant2($m_affiche, $solde) ?>">
                                        <input type="hidden" name="mont_equivalent" id="mont_equivalent<?php echo $id_fact ?>" value="<?php echo afficheMontant2($m_eqvt, $solde_eqv) ?>">
                                        <input type="hidden" name="resch_id" class="resch_id<?php echo $id_fact ?>" value="<?php echo $resch_id ?>">
                                        <input type="hidden" name="montant_tot" class="montant_tot<?php echo $id_fact ?>" value="<?php echo $solde ?>">
                                    <?php } ?>
                                </div>

                            </td>
                        </tr>
                    <?php
                        $tot1 += $mont_tot;
                        $tot2 += $mont_paye;
                        $i++;
                    }
                    $totsolde = $tot1 - $tot2;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"><span class="pull-right">Total</span></th>
                        <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                        <th><?php echo afficheMontant2($m_affiche, $tot2); ?></th>
                        <th><?php echo afficheMontant2($m_affiche, $totsolde); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
            <table class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Serveur</th>
                        <th>Date</th>
                        <th>Montant total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $totcash = 0;
                    $totdon = 0;
                    $tot1 = 0;
                    $tot2 = 0;
                    foreach ($result as $facture) {
                        $mode = $facture->mode;
                        $annule = $facture->etat_cmd;
                        if ($annule == '3') {
                            $id_fact = $facture->id_fact;
                            $num_fact = $facture->num_fact;
                            $nom_client = $facture->nom_client;
                            if (empty($nom_client)) {
                                $nom_client = $facture->designation;
                            }
                            $nom_user = $facture->nom_user;
                            $date_edition = $facture->date_edition;
                            $mont_ttc = $facture->mont_ttc;
                            $taux_op = $facture->taux;
                            $taux_prix = $facture->taux_prix;
                            $mont_tot = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $mont_ttc);
                            $mont_paye = 0;
                            //Mise en session pour impression
                            sessionPrintFactureAnnulee($id_fact, $num_fact, $nom_client, $nom_user, $date_edition, $mode, $mont_paye, $mont_tot);
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo $nom_client ?></td>
                                <td><?php echo $nom_user ?></td>
                                <td><?php echo dateAffiche($date_edition) ?></td>
                                <td><?php echo afficheMontant2($m_affiche, $mont_tot); ?></td>
                                <td>
                                    <a class="btn btn-info btn-xs " href="?p=facture&d=details&id=<?php echo $id_fact ?>">
                                        <i class="fa fa-list"></i> Détails
                                    </a>
                                </td>
                            </tr>
                    <?php
                            $tot1 += $mont_tot;
                            $i++;
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"><span class="pull-left">Total</span></th>
                        <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
            <table class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Serveur</th>
                        <th>Date</th>
                        <!--<th>Mode</th>-->
                        <th>Montant total</th>
                        <th>Montant Payé</th>
                        <th>Solde</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $totcash = 0;
                    $totdon = 0;
                    $tot1 = 0;
                    $tot2 = 0;
                    foreach ($result as $facture) {
                        $mode = $facture->mode;
                        if ($mode == 'Don') {
                            $id_fact = $facture->id_fact;
                            $num_fact = $facture->num_fact;
                            $nom_client = $facture->nom_client;
                            if (empty($nom_client)) {
                                $nom_client = $facture->designation;
                            }
                            $nom_user = $facture->nom_user;
                            $date_edition = $facture->date_edition;
                            $mont_ttc = $facture->mont_ttc;
                            $taux_op = $facture->taux;
                            $taux_prix = $facture->taux_prix;
                            //                            $mont_tot = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $mont_ttc);
                            //                            $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, TotPayeCommande($id_fact, $bdd));
                            $mont_tot = $mont_ttc;
                            $p = TotPayeCommande2($id_fact, $bdd);
                            $mont_paye = montant_equivalent_bdd('CDF', $m_affiche, $taux_op, $p['paye']);

                            $solde = $mont_tot - $mont_paye;

                            //Mise en session pour impression
                            sessionPrintFactureDon($id_fact, $num_fact, $nom_client, $nom_user, $date_edition, $mode, $mont_paye, $mont_tot);
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo $nom_client ?></td>
                                <td><?php echo $nom_user ?></td>
                                <td><?php echo dateAffiche($date_edition) ?></td>
                                <!--<td><?php // echo $mode  
                                        ?></td>-->
                                <td><?php echo afficheMontant2($m_affiche, $mont_tot); ?></td>
                                <td><?php echo afficheMontant2($m_affiche, $mont_paye); ?></td>
                                <td><?php echo afficheMontant2($m_affiche, $solde); ?></td>
                                <td>
                                    <a class="btn btn-info btn-xs " href="?p=facture&d=details&id=<?php echo $id_fact ?>">
                                        <i class="fa fa-list"></i> Détails
                                    </a>
                                </td>
                            </tr>
                    <?php
                            $tot1 += $mont_tot;
                            $tot2 += $mont_paye;
                            $i++;
                        }
                    }
                    $totsolde = $tot1 - $tot2;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"><span class="pull-right">Total</span></th>
                        <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                        <th><?php echo afficheMontant2($m_affiche, $tot2); ?></th>
                        <th><?php echo afficheMontant2($m_affiche, $totsolde); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="tab-pane" id="tab_f">
            <table id="example1" class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Créée par </th>
                        <th>Date</th>
                        <th>Montant total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $tot1 = 0;
                    foreach ($result_fusion as $facture) {
                        $id_fact = $facture->id_fact;
                        $num_fact = $facture->num_fact;
                        $nom_user = $facture->nom_user;
                        $date_edition = $facture->date_edition;
                        $mont_ttc = $facture->mont_ttc;
                       // var_dump($taux_op);
                        //$mont_ttc = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $mont_ttc);
                      //  $mont_ttcs = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_op, $mont_ttc);
                     
                        $mont_ttc_aff = afficheMontant2($m_affiche, $mont_ttc);
                        //var_dump($mont_ttc_aff);
                        $taux_op = $facture->taux;
                        $mont_tot = $mont_ttc;
                       // var_dump($mont_tot);
                        $solde = $facture->solde;
                        $mont_tot_eq = montant_equivalent_bdd(getsymbole_devise(), getsymbole_local(), $taux_op, $mont_ttc);
                        $mont_tot_eq_aff = afficheMontant2(getsymbole_local(), $mont_tot_eq);
                        sessionPrintFactureFusion($id_fact, $num_fact, $nom_user, $date_edition, $mont_tot);
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $num_fact ?></td>
                            <td><?php echo $nom_user ?></td>
                            <td><?php echo dateAffiche($date_edition) ?></td>
                            <td><?php echo afficheMontant2($m_affiche, $mont_tot); ?></td>
                            <td>
                                <a class="btn btn-info btn-xs " target="ablank" href="impression/examples/recu_addition_fusion.php?id_fact_fus=<?php echo $id_fact ?>">
                                    <i class="fa fa-print"></i> reimprimer
                                </a>
                            </td>
                        </tr>
                    <?php
                        $tot1 += $mont_tot;
                        $i++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"><span class="pull-right">Total</span></th>
                        <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="tab-pane" id="tab_mobile_money">
        
        </div>
        <div class="tab-pane" id="tab_s">
            <table class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date & Heure</th>
                        <th>N° Facture</th>
                        <th>Produit </th>
                        <th>Supprimé par </th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($liste_suppr as $l) {
                        $date_heure =$l->date_heure;
                        $heure = $l->heure;
                        $num_fact = $l->num_fact;
                        $serveur = $l->agent;
                        //$admin = $l->admin;
                        $prod = $l->designation;
                        $qte = ($l->qte) * -1;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $date_heure ?></td>
                            <td><?php echo $num_fact ?></td>
                            <td><?php echo $prod ?></td>
                            <td><?php echo $serveur ?></td>
                            <td><?php echo $qte ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
