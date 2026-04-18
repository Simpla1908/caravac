<div class="tab-pane active table-responsive" id="tab_1">
    <?php include(APP_FOLDER . '/views/admin/t_reservation/datafctone.php'); ?>
</div>
<!-- /.tab-pane -->
<div class="tab-pane table-responsive" id="tab_2">
    <table class="table table-bordered table-striped table-condensed ">
        <thead>
            <tr>
                <th>#</th>
                <th>N° Réçu</th>
                <th>Agent</th>
                <th>Date</th>
                <th>Mode</th>
                <th>Montant Payé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $tot1 = 0;
            $monnaie = getsymbole_local();
            $m_affiche = $_SESSION['Paie_affiche'];
            $taux_op = $_SESSION['Paie_taux'];
            foreach ($paiements as $p) {
                $mode = $p->lib;
                $id_regl = $p->id_regl;
                $numero = $p->numero;
                $user = $p->nom_user . ' ' . $p->prenom_user;
                $dte = $p->dte;
                $dte_h = $p->date_regl;
                $tx_paie = $p->taux;
                $mont_paye1 = ($p->montantusd * $p->taux + $p->montantcdf) - ($p->rendu_usd * $p->taux + $p->rendu_cdf);
                $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $tx_paie, $mont_paye1);
                $annuler = $p->annuler;
                $idpaie = $p->idpaie;

            ?>
                <?php if ($annuler == 0) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $numero ?></td>
                        <td><?php echo $user ?></td>
                        <td><?php echo dateAfficheForHr2($dte_h) ?></td>
                        <td><?php echo $mode ?></td>
                        <td><?php echo afficheMontant($m_affiche, $mont_paye); ?></td>
                        <td>
                            <?php if ($hebstatut == 1) { ?>

                                <?php if ($dte == date('Y-m-d')) { ?>
                                    <a data-toggle="modal" data-target="#mdannulationpaiement" class="btn btn-danger btn-xs btn_annuler_reglement" id='<?php echo $id_regl ?>' refcompta='<?php echo $numero ?>' montpaye='<?php echo $mont_paye ?>' devise='<?php echo $m_affiche ?>' tauxop='<?php echo $taux_op ?>' benef='<?php echo $nom_client ?>' idclient='<?php echo $id_client ?>' href="#">
                                        annuler
                                    </a>
                                <?php } ?>
                            <?php } ?>

                            <a class="btn btn-info btn-xs btn_reprint_recu" id='<?php echo $idpaie ?>' href="#">
                                <i class="fa fa-print"></i> réçu
                            </a>

                        </td>
                    </tr>
                <?php
                    $tot1 += $mont_paye;
                    $i++;
                }
                ?>
            <?php } ?>
            <!--RESTAURANT-->
            <?php
            foreach ($paiementsResto as $p) {
                $mode = $p->lib;
                $id_regl = $p->id_regl;
                $numero = $p->numero;
                $user = $p->nom_user . ' ' . $p->prenom_user;
                $dte = $p->dte;
                $dte_h = $p->date_regl;
                $tx_paie = $p->taux;
                $mont_paye1 = ($p->montantusd * $p->taux + $p->montantcdf) - ($p->rendu_usd * $p->taux + $p->rendu_cdf);
                $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $tx_paie, $mont_paye1);
                $annuler = $p->annuler;
            ?>
                <?php if ($annuler == 0 && $mont_paye != 0) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $numero ?></td>
                        <td><?php echo $user ?></td>
                        <td><?php echo dateAfficheForHr2($dte_h) ?></td>
                        <td><?php echo $mode ?></td>
                        <td><?php echo afficheMontant($m_affiche, $mont_paye); ?></td>
                        <td>
                            <?php if ($dte == date('Y-m-d')) { ?>
                                <a data-toggle="modal" data-target="#mdannulationpaiement" class="btn btn-danger btn-xs btn_annuler_reglement" id='<?php echo $id_regl ?>' href="#">
                                    annuler
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                    $tot1 += $mont_paye;
                    $i++;
                }
                ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5"><span class="pull-right">Total</span></th>
                <th><?php echo afficheMontant($m_affiche, $tot1); ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <br>
    <a href="#" id_fact="<?php echo $id_fact ?>" resch_id="<?php echo $id_resch ?>" class="btn btn-primary  pull-right tip  btn_prt_excpt" style="margin-top: -35px;"> Imprimer</a>
</div>

<!--Annulations-->
<div class="tab-pane table-responsive" id="tab_3">
    <table class="table table-bordered table-striped table-condensed ">
        <thead>
            <tr>
                <th>#</th>
                <th>N° Réçu</th>
                <th>Agent</th>
                <th>Date</th>
                <th>Mode</th>
                <th>Montant Payé</th>
                <!--<th></th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $tot1 = 0;
            $monnaie = getsymbole_local();
            $m_affiche = $_SESSION['Paie_affiche'];
            $taux_op = $_SESSION['Paie_taux'];
            foreach ($paiements as $p) {
                $mode = $p->lib;
                $id_regl = $p->id_regl;
                $numero = $p->numero;
                $user = $p->nom_user . ' ' . $p->prenom_user;
                $dte = $p->dte;
                $dte_h = $p->date_regl;
                $tx_paie = $p->taux;
                $mont_paye1 = ($p->montantusd * $p->taux + $p->montantcdf) - ($p->rendu_usd * $p->taux + $p->rendu_cdf);
                $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $tx_paie, $mont_paye1);
                $annuler = $p->annuler;
            ?>
                <?php if ($annuler == 1) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $numero ?></td>
                        <td><?php echo $user ?></td>
                        <td><?php echo dateAfficheForHr2($dte_h) ?></td>
                        <td><?php echo $mode ?></td>
                        <td><?php echo afficheMontant($m_affiche, $mont_paye); ?></td>
                        <!--                    <td> 
                        <a class="btn btn-info btn-xs btn_reprint_recu" id='<?php echo $id_regl ?>' href="#">
                            <i class="fa fa-print"></i> réçu
                        </a>
                        <a class="btn btn-danger btn-xs btn_annuler_reglement" id='<?php echo $id_regl ?>' href="#">
                             annuler
                        </a>
                    </td>-->
                    </tr>
                <?php
                    $tot1 += $mont_paye;
                    $i++;
                }
                ?>
            <?php } ?>
            <!--RESTAURANT-->
            <?php
            foreach ($paiementsResto as $p) {
                $mode = $p->lib;
                $id_regl = $p->id_regl;
                $numero = $p->numero;
                $user = $p->nom_user . ' ' . $p->prenom_user;
                $dte = $p->dte;
                $dte_h = $p->date_regl;
                $tx_paie = $p->taux;
                $mont_paye1 = ($p->montantusd * $p->taux + $p->montantcdf) - ($p->rendu_usd * $p->taux + $p->rendu_cdf);
                $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $tx_paie, $mont_paye1);
                $annuler = $p->annuler;
            ?>
                <?php if ($annuler == 1) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $numero ?></td>
                        <td><?php echo $user ?></td>
                        <td><?php echo dateAfficheForHr2($dte_h) ?></td>
                        <td><?php echo $mode ?></td>
                        <td><?php echo afficheMontant($m_affiche, $mont_paye); ?></td>
                        <!--                     <td> 
                        <a class="btn btn-danger btn-xs btn_annuler_reglement" id='<?php echo $id_regl ?>' href="#">
                             annuler
                        </a>
                    </td>-->
                    </tr>
                <?php
                    $tot1 += $mont_paye;
                    $i++;
                }
                ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5"><span class="pull-right">Total</span></th>
                <th><?php echo afficheMontant($m_affiche, $tot1); ?></th>
                <!--<th></th>-->
            </tr>
        </tfoot>
    </table>
    <br>
    <a href="#" id_fact="<?php echo $id_fact ?>" resch_id="<?php echo $id_resch ?>" class="btn btn-primary  pull-right tip  btn_prt_excpt" style="margin-top: -35px;"> Imprimer</a>
</div>