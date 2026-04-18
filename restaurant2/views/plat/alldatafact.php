<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" class="facture" mode="cash">Factures payées</a></li>
        <li><a href="#tab_2" data-toggle="tab" class="facture" mode="credit">Factures crédit</a></li>
        <li><a href="#tab_4" data-toggle="tab" class="facture" mode="don">Factures Don</a></li>
        <li><a href="#tab_3" data-toggle="tab" class="facture" mode="annuelees">Factures annulées</a></li>
        <input type="hidden" id="mode" name="mode" value="cash">
        <a href="#" class="btn btn-primary btn-sm pull-right" id="print_fact"><i class="fa fa-print"></i> Imprimer</a>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <table id="example1" class="table table-bordered table-striped example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Vendeur</th>
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
                            $mont_tot = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $mont_ttc);
                            $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, TotPayeCommande($id_fact, $bdd));
                            
                            
                            //Mise en session pour impression
                            sessionPrintFacture($id_fact,$num_fact,$nom_client,$nom_user,$date_edition,$mode,$mont_paye,$mont_tot);
                            
                            ?> 
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo $nom_client ?></td>
                                <td><?php echo $nom_user ?></td>
                                <td><?php echo dateAffiche($date_edition) ?></td>
                                <td><?php echo $mode ?></td>
                                <td><?php echo afficheMontant($m_affiche, $mont_tot); ?></td>
                                <td><?php echo afficheMontant($m_affiche, $mont_paye); ?></td>
                                <td> 
                                    <a class="btn btn-info btn-xs " href="?p=facture&d=details&id=<?php echo $id_fact ?>">
                                        <i class="fa fa-list"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $tot1+=$mont_tot;
                            $tot2+=$mont_paye;
                            $i++;
                        }
                    }
                    ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6"><span class="pull-right">Total</span></th>
                        <th><?php echo afficheMontant($m_affiche, $tot1); ?></th>
                        <th><?php echo afficheMontant($m_affiche, $tot2); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <table  class="table table-bordered table-striped example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Vendeur</th>
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
                        if ($mode == 'Credit') {
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
                            $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, TotPayeCommande($id_fact, $bdd));
                            $solde = $mont_tot - $mont_paye;
                            
                            //Mise en session pour impression
                            sessionPrintFactureCredit($id_fact,$num_fact,$nom_client,$nom_user,$date_edition,$mode,$mont_paye,$mont_tot);
                            
                            ?> 
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo $nom_client ?></td>
                                <td><?php echo $nom_user ?></td>
                                <td><?php echo dateAffiche($date_edition) ?></td>
                                <!--<td><?php // echo $mode ?></td>-->
                                <td><?php echo afficheMontant($m_affiche, $mont_tot); ?></td>
                                <td><?php echo afficheMontant($m_affiche, $mont_paye); ?></td>
                                <td><?php echo afficheMontant($m_affiche, $solde); ?></td>
                                <td> 
                                    <a class="btn btn-info btn-xs " href="?p=facture&d=details&id=<?php echo $id_fact ?>">
                                        <i class="fa fa-list"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $tot1+=$mont_tot;
                            $tot2+=$mont_paye;
                            $i++;
                        }
                    }
                    $totsolde = $tot1 - $tot2;
                    ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"><span class="pull-right">Total</span></th>
                        <th><?php echo afficheMontant($m_affiche, $tot1); ?></th>
                        <th><?php echo afficheMontant($m_affiche, $tot2); ?></th>
                        <th><?php echo afficheMontant($m_affiche, $totsolde); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
            <table class="table table-bordered table-striped example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Vendeur</th>
                        <th>Date</th>
                        <!--<th>Mode</th>-->
                        <th>Montant total</th>
                        <!--<th>Montant Payé</th>-->
                        <!--<th>Solde</th>-->
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
                            $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, TotPayeCommande($id_fact, $bdd));
                            $solde = $mont_tot - $mont_paye;
                            
                            
                            //Mise en session pour impression
                            sessionPrintFactureAnnulee($id_fact,$num_fact,$nom_client,$nom_user,$date_edition,$mode,$mont_paye,$mont_tot);
                            
                            ?> 
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo $nom_client ?></td>
                                <td><?php echo $nom_user ?></td>
                                <td><?php echo dateAffiche($date_edition) ?></td>
                                <!--<td><?php // echo $mode ?></td>-->
                                <td><?php echo afficheMontant($m_affiche, $mont_tot); ?></td>
                                <!--<td><?php // echo afficheMontant($m_affiche,$mont_paye); ?></td>-->
                                <!--<td><?php // echo afficheMontant($m_affiche,$solde); ?></td>-->
                                <td> 
                                    <a class="btn btn-info btn-xs " href="?p=facture&d=details&id=<?php echo $id_fact ?>">
                                        <i class="fa fa-list"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $tot1+=$mont_tot;
                            $tot2+=$mont_paye;
                            $i++;
                        }
                    }
                    $totsolde = $tot1 - $tot2;
                    ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3"><span class="pull-right">Total</span></th>
                        <th><?php echo afficheMontant($m_affiche, $tot1); ?></th>
                        <th><?php echo afficheMontant($m_affiche, $tot2); ?></th>
                        <th><?php echo afficheMontant($m_affiche, $totsolde); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
            <table class="table table-bordered table-striped example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Vendeur</th>
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
                            $mont_tot = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $mont_ttc);
                            $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, TotPayeCommande($id_fact, $bdd));
                            $solde = $mont_tot - $mont_paye;
                            
                            //Mise en session pour impression
                            sessionPrintFactureDon($id_fact,$num_fact,$nom_client,$nom_user,$date_edition,$mode,$mont_paye,$mont_tot);
                            
                            ?> 
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo $nom_client ?></td>
                                <td><?php echo $nom_user ?></td>
                                <td><?php echo dateAffiche($date_edition) ?></td>
                                <!--<td><?php // echo $mode ?></td>-->
                                <td><?php echo afficheMontant($m_affiche, $mont_tot); ?></td>
                                <td><?php echo afficheMontant($m_affiche, $mont_paye); ?></td>
                                <td><?php echo afficheMontant($m_affiche, $solde); ?></td>
                                <td> 
                                    <a class="btn btn-info btn-xs " href="?p=facture&d=details&id=<?php echo $id_fact ?>">
                                        <i class="fa fa-list"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $tot1+=$mont_tot;
                            $tot2+=$mont_paye;
                            $i++;
                        }
                    }
                    $totsolde = $tot1 - $tot2;
                    ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"><span class="pull-right">Total</span></th>
                        <th><?php echo afficheMontant($m_affiche, $tot1); ?></th>
                        <th><?php echo afficheMontant($m_affiche, $tot2); ?></th>
                        <th><?php echo afficheMontant($m_affiche, $totsolde); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->