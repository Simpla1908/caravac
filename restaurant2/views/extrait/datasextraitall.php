<!-- Custom Tabs -->
<div class="nav-tabs-custom">

    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <a class="btn btn-primary tip btn_prnt_extrcompte_all pull-right" title="Imprimer"><i class="fa fa-print"></i>Imprimer</a> <br><br><br>
            <table class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CLIENT</th>
                        <th>DEBIT</th>
                        <th>CREDIT</th>
                        <th>SOLDE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nbre = count($data['id']);
                    $tdebit = 0;
                    $tcredit = 0;
                    $tsolde = 0;
                    $j = 1;
                    for ($i = 0; $i < $nbre; $i++) {
                        $idclient = $data['id'][$i];
                        $client = $data['client'][$i];
                        $debit = $data['debit'][$i];
                        $credit = $data['credit'][$i];
                        $solde = $debit - $credit;
                        $tdebit += $debit;
                        $tcredit += $credit;
                        $tsolde += $solde;
                    ?>
                        <tr>
                            <td><?php echo $j; ?></td>
                            <td><?php echo $client; ?></td>
                            <td>
                                <?php if ($debit > 0) {
                                    echo afficheMontant2(getsymbole_devise(), $debit);
                                } ?>
                            </td>
                            <td>
                                <?php if ($credit > 0) {
                                    echo afficheMontant2(getsymbole_devise(), $credit);
                                } ?>
                            </td>
                            <td>
                                <?php if ($solde > 0) {
                                    echo afficheMontant2(getsymbole_devise(), $solde);
                                } ?>
                            </td>
                            <td>
                                    <a class="btn btn-info btn-xs" href="?p=extrait&d=details2&idclient=<?php echo $idclient; ?>&cl=<?php echo $client; ?>">
                                      <i class="fa fa-list"></i> Détails
                                    </a>
                                    <?php if ($solde > 0) { ?>
                                        <button style="margin-left:10px;" type="button" class="btn btn-success btn-xs btn_regler_extrait_line"  client="<?php echo $client; ?>"   solde="<?php echo $solde; ?>" idclient="<?php echo $idclient; ?>">
                                            <i class="fa fa-credit-card"></i> Payer
                                        </button>
                                    <?php } ; ?>
                            </td>
                        </tr>
                    <?php
                        $j++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2"><span class="pull-left">TOTAL</span></th>
                        <th>
                            <?php if ($tdebit > 0) {
                                echo afficheMontant2(getsymbole_devise(), $tdebit);
                            } ?>
                        </th>
                        <th>
                            <?php if ($tcredit > 0) {
                                echo afficheMontant2(getsymbole_devise(), $tcredit);
                            } ?>
                        </th>
                        <th>
                            <?php if ($tsolde > 0) {
                                echo afficheMontant2(getsymbole_devise(), $tsolde);
                            } ?>
                        </th>
                    </tr>

                </tfoot>
            </table>
        </div>

    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->