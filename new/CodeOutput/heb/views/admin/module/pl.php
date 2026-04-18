<table class="table table-md table-bordered table-condensed">
    <thead>
        <tr>
            <th scope="col"></th>
            <?php for ($i = 0; $i < $nbre; $i++) { ?>
                <th scope="col"><?php echo $periode_reservations['libelle'][$i] ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($chambres as $rows) {
            $id_ch = $rows->id_ch;
            $tarif = $mont_ttc = montant_equivalent_bdd($rows->monnaie, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $rows->tarif_ch);
            $tarif_aff = ' ( ' . afficheMontant($_SESSION['Paie_affiche'], $tarif) . ' ) ';
        ?>
            <tr>
                <th scope="row"><span class="badge bg-black"><?php echo AfficheNomChambre($rows->num_ch) . $tarif_aff ?></span></th>
                <?php
                for ($i = 0; $i < $nbre; $i++) {
                    $dtesej = $periode_reservations['dte'][$i];
                ?>
                    <?php
                    if ((in_array($rows->id_ch, $sejour['ch']) && in_array($dtesej, $sejour['dte']))) {
                    ?>
                        <?php if (in_array($dtesej, $inscrits2[$id_ch])) {
                            $statut = $inscrits3[$id_ch][$dtesej];
                            $color = "badge bg-green";
                            if ($statut == 'reserve') {
                                $color = "badge bg-red";
                            }
                            $id_resch = $inscrits4[$id_ch][$dtesej];
                            $nomclient1 = $inscrits[$id_ch][$dtesej];
                            $nomclient1 = ucfirst(strtolower($nomclient1));
                            $nomclient2 = substr($nomclient1, 0, 25);
                            $dtelib = $inscrits5[$id_ch][$dtesej];
                        ?>
                            <td>
                                <span class="<?php echo $color ?>">
                                    <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=add&onlyreserv=0&id_resch=<?php echo $id_resch; ?>&dte=<?php echo $dtesej; ?>&ch=<?php echo $id_ch; ?>" data-toggle="tooltip" data-html="true" title="<?php echo strtoupper($nomclient1) ?>" style="color: white" class="tip">
                                        <?php echo strtoupper($nomclient2); ?>
                                    </a>
                                </span>
                                <?php
                                if ($dtesej == $dtelib) {
                                ?>
                                    <span class="badge bg-blue">
                                        <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=add&onlyreserv=1&id_resch=0&dte=<?php echo $dtesej; ?>&ch=<?php echo $id_ch; ?>" style="color: white">
                                            RESERVER
                                        </a>
                                    </span>
                                <?php
                                }
                                ?>
                            </td>
                        <?php } else { ?>
                            <td>
                                <span class="badge bg-orange">
                                    <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=add&id_resch=0&dte=<?php echo $dtesej; ?>&ch=<?php echo $id_ch; ?>" style="color: white">
                                        LIBRE
                                    </a>
                                </span>
                            </td>
                        <?php } ?>
                    <?php } else { ?>
                        <td>
                            <span class="badge bg-orange">
                                <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=add&id_resch=0&dte=<?php echo $dtesej; ?>&ch=<?php echo $id_ch; ?>" style="color: white">
                                    LIBRE
                                </a>
                            </span>
                        </td>
                    <?php } ?>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>