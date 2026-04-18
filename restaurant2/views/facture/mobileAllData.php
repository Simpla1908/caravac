<table  class="table table-bordered table-striped table-condensed tbmobile">
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
        foreach ($facts as $facture) {
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

                $mont_tot = $mont_ttc;
                $p = TotPayeCommande2($id_fact, $bdd);
                $mont_paye = montant_equivalent_bdd(
                    'CDF',
                    $m_affiche,
                    $taux_op,
                    $p['paye']
                );
                if ($mont_paye > $mont_tot) {
                    $mont_paye = $mont_tot;
                }
                //Mise en session pour impression
                sessionPrintFacture(
                    $id_fact,
                    $num_fact,
                    $nom_client,
                    $nom_user,
                    $date_edition,
                    $mode,
                    $mont_paye,
                    $mont_tot
                );
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $num_fact; ?></td>
                    <td><?php echo $nom_client; ?></td>
                    <td><?php echo $nom_user; ?></td>
                    <td><?php echo dateAffiche(
                        $date_edition
                    ); ?></td>
                    <td><?php echo $mode; ?></td>
                    <td><?php echo afficheMontant2(
                        $m_affiche,
                        $mont_tot
                    ); ?></td>
                    <td><?php echo afficheMontant2(
                        $m_affiche,
                        $mont_paye
                    ); ?></td>
                    <td>
                        <a class="btn btn-info btn-xs " href="?p=facture&d=details&id=<?php echo $id_fact; ?>">
                            <i class="fa fa-list"></i> Détails
                        </a>
                    </td>
                </tr>
        <?php
        $tot1 += $mont_tot;
        $tot2 += $mont_paye;
        $i++;

        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6"><span class="pull-right">Total</span></th>
            <th><?php echo afficheMontant2(
                $m_affiche,
                $tot1
            ); ?></th>
            <th><?php echo afficheMontant2(
                $m_affiche,
                $tot2
            ); ?></th>
            <th></th>
        </tr>
    </tfoot>
</table>