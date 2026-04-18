<!-- Custom Tabs -->
<div class="nav-tabs-custom">

    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
        <h3><?php echo $nomClient; ?></h3>
            <a id="<?php echo $idclient; ?>" n="<?php echo $nomClient; ?>" class="btn btn-primary tip btn_prnt_extrcompte2 pull-right" title="Imprimer"><i class="fa fa-print"></i>Imprimer</a> <br><br><br>
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° FACTURE</th>
                        <th>DATE EDITION</th>
                        <th>DATE PAIEMENT</th>
                        <th>N° RECU </th>
                        <th>AGENT</th>
                        <th data-hide="phone,tablet">DEBIT</th>
                        <th data-hide="phone,tablet">CREDIT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nbre = count($data['id']);
                    $tdebit = 0;
                    $tcredit = 0;
                    $j = 1;
                    $monnaie_usd = 'USD';
                    $monnaie_cdf = 'CDF';
                    for ($i = 0; $i < $nbre; $i++) {
                        $debit = 0;
                        $credit = 0;
                        $dte = $data['date'][$i];
                        $numfact = $data['numfact'][$i];
                        $numrecu = $data['numrecu'][$i];
                        $debitcdf = $data['debitcdf'][$i];
                        $creditcdf = $data['creditcdf'][$i];
                        $debitusd = $data['debitusd'][$i];
                        $creditusd = $data['creditusd'][$i];
                        $taux_op = $data['taux'][$i];
                        $dterecu = $data['dterecu'][$i];
                        $agent = $data['agent'][$i];
                        $debitcdf_conv = 0;
                        $creditcdf_conv = 0;
                        if ($debitcdf > 0) {
                            $debitcdf_conv = montant_equivalent_bdd($monnaie_cdf, $monnaie_usd, $taux_op, $debitcdf);
                        }
                        if ($creditcdf > 0) {
                            $creditcdf_conv = montant_equivalent_bdd($monnaie_cdf, $monnaie_usd, $taux_op, $creditcdf);
                        }
                        $debit = $debit + $debitusd + $debitcdf_conv;
                        $credit = $credit + $creditusd + $creditcdf_conv;
                        if ($credit > $debit && $debit > 0) {
                            $credit = $debit;
                        }
                    ?>
                        <tr>
                            <td><?php echo $j; ?></td>
                            <td><?php echo $numfact; ?></td>
                            <td><?php echo dateAffiche($dte); ?></td>
                            <td>
                                <?php if(!empty($dterecu) && $credit > 0){echo dateAffiche($dterecu);} ?>
                            </td>
                            <td><?php
                                if ($credit > 0) { echo $numrecu; }
                                ?>
                             </td>
                            <td><?php if(!empty($agent) && $credit > 0){echo $agent;} ?></td>
                            <td><?php if ($debit > 0) {
                                    echo afficheMontant2($monnaie_usd, $debit);
                                } ?></td>
                            <td><?php if ($credit > 0) {
                                    echo afficheMontant2($monnaie_usd, $credit);
                                } ?></td>
                        </tr>
                    <?php
                        $tdebit += $debit;
                        $tcredit += $credit;
                        $j++;
                    }
                    $solde = $tdebit - $tcredit;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6"><span class="pull-left">TOTAL</span></th>
                        <th><?php echo afficheMontant2($monnaie_usd, $tdebit); ?></th>
                        <th><?php echo afficheMontant2($monnaie_usd, $tcredit); ?></th>

                    </tr>
                    <tr>
                        <th colspan="6"><span class="pull-left">SOLDE</span></th>
                        <th colspan="2" align="center">
                            <?php
                            echo afficheMontant2($monnaie_usd, $solde);
                            ?>
                        </th>
                    </tr>

                </tfoot>
            </table>
        </div>

    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->