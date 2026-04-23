<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Facture
            #<?php echo $num_fact ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="main.php?p=facture&d=liste">Factures</a></li>
            <li class="active">Détails</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <!--<div class="box-header">
                <h3 class="box-title">Factures</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" class="facture" mode="cash">Détails</a></li>
                        <li><a href="#tab_2" data-toggle="tab" class="facture" mode="credit">Historique des paiements</a></li>
                        <!--                        <a href="#" class="btn btn-primary btn-sm pull-right" id="print_fact"><i class="fa fa-print"></i> Imprimer</a>-->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active " id="tab_1">
                            <section class="invoice">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 class="page-header">
                                            <i class="fa fa-globe"></i> <?php echo $nom_client ?>
                                            <small class="pull-right">Date:<?php echo dateAffiche($date_edition) ?></small>
                                        </h2>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Facturé à
                                        <address>
                                            <strong><?php echo $nom_client ?></strong><br>
                                            <?php if (!empty($telephone_client)) { ?>
                                                Téléphone: <?php echo $telephone_client ?><br>
                                            <?php } ?>
                                            <?php if (!empty($email_client)) { ?>
                                                Email: <?php echo $email_client ?>
                                            <?php } ?>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                          
                                    <div class="col-sm-2 invoice-col">
                                        Serveur
                                        <address>
                                            <strong><?php echo $serveur_name ?></strong><br>
                                        </address>
                                    </div>

                                      <div class="col-sm-2 invoice-col">
                                        Caissier
                                        <address>
                                            <strong><?php echo $nomcaisse ?></strong><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>N° facture #<?php echo $num_fact ?></b><br>
                                        <?php if ($annule != '3') { ?>
                                            <b>Mode de paiement:</b> <?php echo $mode ?><br>
                                        <?php } else { ?>
                                            <b>Statut:</b> <?php echo "annulé" ?><br>
                                        <?php } ?>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped table-bordered table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>Désignation</th>
                                                    <th>Quantité</th>
                                                    <th>Prix</th>
                                                    <th>Montant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($lignes as $l) {
                                                    $designation = $l->designation;
                                                    if ($l->accomp != '') {
                                                        $designation = $l->designation . ' avec ' . $l->accomp;
                                                    }
                                                    $qte = $l->qte;
                                                    $prix = montant_equivalent_bdd($monnaie, $m_affiche, $taux_prix, $l->prix);
                                                    $montant = $prix * $qte;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $designation ?></td>
                                                        <td><?php echo $qte ?></td>
                                                        <td><?php echo afficheMontant2($m_affiche, $prix) ?></td>
                                                        <td><?php echo afficheMontant2($m_affiche, $montant) ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                               
                                                <tr>
                                                    <th colspan="3"><span class="text-right pull-right">TOTAL</span></th>
                                                    <th><?php echo afficheMontant2($m_affiche, $ttc) ?></th>
                                                </tr>


                                                <?php if ($annule != '3') { ?>
                                                    <tr>
                                                        <th colspan="3"><span class="text-right pull-right">Montant payé</span></th>
                                                        <th><?php echo afficheMontant2($m_affiche, $mont_paye) ?></th>
                                                    </tr>
                                                    <?php if ($mode == 'Credit' && $solde >= 0) { ?>
                                                        <tr>
                                                            <th colspan="3"><span class="text-right pull-right">Solde</span></th>
                                                            <th><?php echo afficheMontant2($m_affiche, $solde) ?></th>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>

                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-xs-12">
                                        <?php if (round($mont_paye, 2) < round($netapayer) && $annule != '3') { ?>
                                            <button type="button" class="btn btn-success pull-right" id="btn_regler_credit"><i class="fa fa-credit-card"></i> Payer</button>
                                        <?php } ?>
                                        <a href="impression/examples/ticketcopie.php" target="_blank" class="btn btn-primary pull-right tip " style="margin-right: 5px;"><i class="fa fa-print"></i> Imprimer</a>
                                    </div>
                                </div>
                            </section>
                            <!-- /.content -->
                            <div class="clearfix"></div>
                            <input type="hidden" name="montant_fact" id="montant_fact" value="<?php echo afficheMontant2($m_affiche, $solde) ?>">
                            <input type="hidden" name="mont_equivalent" id="mont_equivalent" value="<?php echo afficheMontant2($m_eqvt, $solde_eqv) ?>">
                            <input type="hidden" name="id_fact" class="id_fact" value="<?php echo $id_fact ?>">
                            <input type="hidden" name="resch_id" class="resch_id" value="<?php echo $resch_id ?>">
                            <input type="hidden" name="montant_tot" class="montant_tot" value="<?php echo $solde ?>">
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane table-responsive" id="tab_2">
                            <table id="example1" class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>N° Réçu</th>
                                        <th>Agent</th>
                                        <th>Date</th>
                                        <th>Mode</th>
                                        <th>Montant Payé</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $tot1 = 0;
                                    $monnaie =  getsymbole_local();
                                    foreach ($paiements as $p) {
                                        $mode = $p->lib;
                                        $id_regl = $p->id_regl;
                                        $numero = $p->numero;
                                        $user = $p->nom_user . ' ' . $p->prenom_user;
                                        $dte = $p->dte;
                                        $dte_h = $p->date_regl;
                                        $tx_paie = $p->taux;
                                        if ($mont_paye > 0) {
                                       unset($_SESSION['montantPaye']);
                                       $_SESSION['montantPaye']=$mont_paye;
                                    ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $numero ?></td>
                                                <td><?php echo $user ?></td>
                                                <td><?php echo dateAffiche($dte) ?></td>
                                                <td><?php echo $mode ?></td>
                                                <td><?php echo afficheMontant2($m_affiche, $mont_paye); ?></td>
                                                <td>
                                                    <a class="btn btn-info btn-xs btn_reprint_recu"  id='<?php echo $id_regl ?>' href="#">
                                                        <i class="fa fa-print"></i> réçu
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                        $tot1 += $mont_paye;
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5"><span class="pull-right">Total</span></th>
                                        <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <a class="btn  btn-primary btn-sm btn_extcpte pull-right" id='<?php echo $id_fact ?>' href="#">
                                <i class="fa fa-print"></i> Extrait de compte
                            </a>
                        </div>

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

            <!-- /.box-body -->
        </div>
    </section>
</div>
