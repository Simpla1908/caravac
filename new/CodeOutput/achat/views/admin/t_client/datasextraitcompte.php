
<div class="row">
    <div class="col-xs-12">
        <table data-page="false" class="table table-bordered table-hover table-striped table-condensed" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>N°Bon de commande</th>
                    <th data-hide="phone,tablet">N°Bon de paiement </th>
                    <th data-hide="phone,tablet">Débit</th>
                    <th data-hide="phone,tablet">Crédit</th>
                </tr>
            </thead>
            <tbody> 
                <?php 
                $nbre=count($data['id']);
                $tdebit=$tcredit=0;
                $j=1;
                for ($i = 0; $i < $nbre; $i++) {
                  $dte=$data['date'][$i];
                  $numfact=$data['numfact'][$i];
                  $numrecu=$data['numrecu'][$i];
                  $debit=$data['debit'][$i];
                  $credit=$data['credit'][$i];
                ?>
                <tr>
                    <td><?php echo $j; ?></td>
                    <td><?php echo dateAffiche($dte); ?></td>
                    <td><?php echo $numfact; ?></td>
                    <td><?php echo $numrecu; ?></td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $debit); ?></td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $credit); ?></td>
                </tr>
                <?php 
                    $tdebit+=$debit;
                    $tcredit+=$credit;
                    $j++;
                } 
                $solde=$tcredit-$tdebit;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tdebit); ?></td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tcredit); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="4">Solde</th>
                    <td colspan="2" align="center">
                        <strong>
                            <?php
                            $solde = $tdebit - $tcredit;
                            echo afficheMontant($_SESSION['Paie_affiche'], $solde);
                            ?>
                        </strong>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
