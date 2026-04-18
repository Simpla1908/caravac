<table id="" data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2">
    <thead>
        <tr>
            <th>#</th>
            <th>Noms</th>
            <th data-hide="phone,tablet">Chambre</th>
            <th data-hide="phone,tablet">Période</th>
            <!--<th data-hide="phone,tablet">Départ</th>-->
            <th data-hide="phone,tablet">Nuitée</th>
            <th data-hide="phone,tablet">Tarif</th>
            <th data-hide="phone,tablet">Montant séjour</th>
            <th data-hide="phone,tablet">Montant Consommation</th>
            <!--<th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>-->
        </tr>
    </thead>
    <tbody id="bloc_recette">
        <?php
        $i = 1;
        $totsej = 0;
        $totconsommation = 0;
        foreach ($recettes as $rows) {
            $date_occ = $rows->date_occ;
            $date_lib = $rows->date_lib;
            $st = $rows->statut;
            $paiech = $rows->paie;
            $dtecomp = $dte = date('Y-m-d');
            $nuite = NbJours($date_occ, $dtecomp);
            if ($rows->statut == 'reserve' || $rows->statut == 'change' || $rows->statut == 'libre') {
                $nuite = NbJours($rows->date_occ, $rows->date_lib);
                // if ($st == 'change' || $st == 'libre') {
                //     // $nuite = $rows->nuitee;
                // }
                $dte = $rows->date_lib;
                $dtecomp = $dte;
            }
            //Incrementation nuitée par rapport au checkin
            if (($rows->date_occ < $dte && $hrs_sys > $checkout) && ($rows->statut == 'occupe')) {
                $nuite++;
                $dtecomp = $dte;
            }
            $dte = $rows->idres_ch;
            $taux = $rows->taux;
            $tarif_ch = $rows->tarif_ch;
            $tarif_ch2 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $tarif_ch);
            if (isset($_SESSION['paiesej']['sejour'][$dte])) {
                $mpsej = $_SESSION['paiesej']['sejour'][$dte];
            } else {
                $mpsej = 0;
            }
            if (isset($_SESSION['paiesej']['consommation'][$dte])) {
                $mpcons = $_SESSION['paiesej']['consommation'][$dte];
            } else {
                $mpcons = 0;
            }
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $rows->nom_client; ?></td>
                <td><?php echo $rows->num_ch; ?></td>
                <td><?php echo dateAffiche($date_occ) . ' - ' . dateAffiche($dtecomp); ?></td>
                <td><?php echo $nuite; ?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2); ?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpsej); ?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpcons); ?></td>
            </tr>
        <?php $i++;
            $totsej += $mpsej;
            $totconsommation += $mpcons;
        };
        ?>
    <tfoot>
        <tr>
            <th colspan="6">Total</th>
            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $totsej); ?></th>
            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $totconsommation); ?></th>
        </tr>
    </tfoot>

    </tbody>
</table>