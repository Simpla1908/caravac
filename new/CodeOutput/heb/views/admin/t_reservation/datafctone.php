<section class="invoice">
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <address>
                <?php if ($statut == 'reserve') {
                ?>
                    <b> N° Reçu: <?php echo $num_recu_paie; ?></b><br>
                <?php } ?>
                <?php if ($statut == 'occupe') { ?>
                    <b> N° Facture: <?php echo $num_fact; ?></b><br>
                <?php } ?>
                <?php if ($hebstatut == 0) { ?>
                    <b> N°Bon annulation: <?php echo $num_bon_annul; ?></b><br>
                <?php } ?>
                <b> Mode: <?php echo $mode; ?></b><br>
                <b>Client: <?php echo $nom_client; ?></b><br>
                <?php if ($nom_accomp != 0) { ?>
                    Accompagné par <?php echo NomClientById($nom_accomp, $bdd); ?><br>
                <?php } ?>
                Responsable: <?php echo $nom_respo; ?><br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <address>
                <?php if ($statut == 'reserve') { ?>
                    <b> N° Reservation: <?php echo $num_reserv; ?></b><br>
                <?php } ?>
                Date édition: <b> <?php echo dateAffiche($date_edition); ?></b><br>
                Date arrivée prévue: <b> <?php echo dateAffiche($date_occ); ?></b><br>
                Date départ prévue: <b> <?php echo dateAffiche($date_lib); ?></b><br>
                <?php if ($hebstatut == 0) { ?>
                    Date d'annulation: <b> <?php echo dateAffiche($dte_annule); ?></b><br>
                <?php } ?>
            </address>
        </div>
        <div class="col-sm-4 invoice-col ">
            <address>
                Statut: <b>
                    <?php
                    if ($hebstatut == 1) {
                        echo 'confirmé';
                    } else {
                        echo 'annulé';
                    }
                    ?>
                </b>
                <br>
                TVA: <b> <?php echo ClientTVA($assujetti); ?></b>
                <?php
                $libstatut = 'libre';
                $colorstatut = 'badge bg-orange';
                ?>
            </address>
        </div>

        <!-- /.col -->

        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Chambre</th>
                        <th>Période</th>
                        <th>Nuitée</th>
                        <th>Prix</th>
                        <th>Montant</th>
                        <?php if (get('do') != 'detfact2') { ?>
                            <th>Observation</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idchambre = 0;
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $id_ch = $_SESSION['panier']['id_article'][$i];
                        $repas = $_SESSION['panier']['repas'][$i];
                        if ($repas == 0) {
                            $statut2 = $_SESSION['panier']['statut'][$i];
                            $dte_in = $_SESSION['panier']['dte_a'][$i];
                            $dte_out = $_SESSION['panier']['dte_s'][$i];
                            if ($statut2 == 'occupe') {
                                $idchambre = $id_ch;
                                $libstatut = 'occupée';
                                if ($dte_in == date('Y-m-d') && $dte_out == date('Y-m-d')) {
                                    $dte_out = AddDaysToDate($dte_out, 1);
                                }
                            } elseif ($statut2 == 'reserve') {
                                $libstatut = 'reservée';
                            } elseif ($statut2 == 'change') {
                                $libstatut = 'changée';
                            }
                            $nom_ch = $_SESSION['panier']['nom'][$i];
                            $qte = $_SESSION['panier']['qte'][$i];
                            $monttva = $_SESSION['panier']['monttva'][$i];
                            $tarif_ch2 = $_SESSION['panier']['prix'][$i];

                            $cout_ch = prixHebergement($tarif_ch2, $monttva) * $qte;
                            $description = dateAffiche($dte_in) . ' - ' . dateAffiche($dte_out);
                            //datas for compta
                            $_SESSION['DataCompta_Idclient'] = $id_client;
                            $_SESSION['DataCompta_Idch'] = $id_ch;
                            $_SESSION['DataCompta_num_fact'] = $num_fact;
                            $_SESSION['DataCompta_tauxfact'] = $tauxfact;
                            $_SESSION['DataCompta_nom_client'] = $nom_client;
                            //datas for compta
                    ?>
                            <tr>
                                <td><?php echo AfficheNomChambre($nom_ch); ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $qte; ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2); ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cout_ch); ?></td>
                                <?php if (get('do') != 'detfact2') { ?>
                                    <td><?php echo $libstatut; ?></td>
                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
                <input name="factheb_id" id="factheb_id" type="hidden" value="<?php echo $id_fact; ?>">
            </table>
        </div>
        <!-- /.col -->
        <?php if ($bool_serv) { ?>
            <h6 class="page-header">Autres services<span id="panel_dontprintserv"> <input title="Ne pas mprimer autres services" name="dontprintserv" class="dontprintserv" type="checkbox" value="TRUE"></span>
            </h6>
            <div class="col-xs-12">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Désignation</th>
                            <th>QTE</th>
                            <th>Prix</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                            $id_ch = $_SESSION['panier']['id_article'][$i];
                            $repas = $_SESSION['panier']['repas'][$i];
                            $dte_a = $_SESSION['panier']['dte_a'][$i];
                            if ($repas == 1) {
                                $nom_ch = $_SESSION['panier']['nom'][$i];
                                $qte = $_SESSION['panier']['qte'][$i];
                                $monttva = $_SESSION['panier']['monttva'][$i];
                                $tarif_ch2 = $_SESSION['panier']['prix'][$i];
                                $cout_ch = prixHebergement($tarif_ch2, $monttva) * $qte;
                        ?>
                                <tr>
                                    <td><?php echo dateAffiche($dte_a); ?></td>
                                    <td><?php echo AfficheNomChambre($nom_ch); ?></td>
                                    <td><?php echo $qte; ?></td>
                                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2); ?></td>
                                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cout_ch); ?></td>
                                </tr>
                        <?php }
                        }; ?>
                        <?php
                        $nbre2 = count($service['id']);
                        for ($k = 0; $k <= $nbre2 - 1; $k++) {
                            $tp = $service['type'][$k];
                            if ($tp == 'restaurant') {
                                $dte_a = $service['dte'][$k];;
                                $nom_ch = $service['des'][$k];
                                $qte = '-';
                                $tarif_ch2 = '-';
                                $ttc1 = $service['ttc'][$k];
                                $tva1 = $service['tva'][$k];
                                $ht1 = $service['ht'][$k];
                                $cout_ch = $ttc1;
                        ?>
                                <tr>
                                    <td><?php echo dateAffiche($dte_a); ?></td>
                                    <td><?php echo AfficheNomChambre($nom_ch); ?></td>
                                    <td><?php echo $qte; ?></td>
                                    <td><?php echo $tarif_ch2; ?></td>
                                    <td><?php echo  afficheMontant($_SESSION['Paie_affiche'], $cout_ch); ?></td>
                                </tr>
                        <?php
                                $ttcresto += $ttc1;
                                $tvaresto += $tva1;
                                $htresto += $ht1;
                            }
                        }; ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-4">
            <form class="frmliberation hidden">
                <input name="id_histo" id="id_histo" type="text" value="<?php echo $idchambre; ?>">
                <input name="nbre_nte" id="nbre_nte" type="text" value="<?php echo $nuitesave; ?>">
                <input name="resch_id" id="resch_id" type="text" value="<?php echo $id_resch; ?>">
                <input name="dte_a" id="dte_a" type="text" value="<?php echo $date_occ; ?>">
                <input name="dte_l" id="dte_l" type="text" value="<?php echo $dte; ?>">
                <input name="id_res" id="id_res" type="text" value="<?php echo $id_res; ?>">
                <input name="id_fact" id="id_fact" type="text" value="<?php echo $id_fact; ?>">
                <input name="num_fact" id="num_fact" type="text" value="<?php echo $num_fact; ?>">
                <input name="compte1" id="compte1" type="text" value="<?php echo $compte1; ?>">
                <input name="compte2" id="compte2" type="text" value="<?php echo $compte2; ?>">
                <input name="tauxcompta" id="tauxcompta" type="text" value="<?php echo $tauxcompta; ?>">
                <input name="tva" id="tva" type="text" value="<?php echo $tva; ?>">
                <input name="nom_client" id="nom_client" type="text" value="<?php echo $nom_client; ?>">
                <input name="ttccompta" id="ttccompta" type="text" value="<?php echo $ttccompta; ?>">
            </form>
        </div>
        <!-- /.col -->
        <div class="col-xs-8">
            <div class="">
                <?php if ($hebstatut == 1) { ?>
                    <table class="table table-bordered table-condensed">
                        <tbody>
                            <tr>
                                <th>HT</th>
                                <th>TVA</th>
                                <th>TTC</th>
                                <th>Payé</th>
                                <th>Reste</th>
                            </tr>
                            <tr>
                                <?php
                                $valtva = $tottva + $tvaresto;
                                $valht = $ht + $htresto;
                                $valttc = $ttc + $ttcresto;
                                $solde = $valttc - $totpaye;
                                if ($assujetti == 0) {
                                    $valht += $valtva;
                                    $valtva = 0;
                                }
                                ?>
                                <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $valht); ?></td>
                                <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $valtva); ?></td>
                                <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $valttc); ?></td>
                                <td class="text-center"><span class="totpaye"><?php echo afficheMontant($_SESSION['Paie_affiche'], $totpaye); ?></span></td>
                                <td class="text-center"><span class="solde"><?php echo afficheMontant($_SESSION['Paie_affiche'], $solde); ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <table class="table table-bordered table-condensed">
                        <?php
                        $valtva = $tottva + $tvaresto;
                        $valht = $ht + $htresto;
                        $valttc = $ttc + $ttcresto;
                        $solde = $totpaye;
                        if ($assujetti == 0) {
                            $valht += $valtva;
                            $valtva = 0;
                        }
                        $montpaieclaf = $totpaye;
                        $resteremb = $totpaye - $montpenalite;
                        if ($montrenducl > 0) {
                            $resteremb = 0;
                            $montpaieclaf = $montpaiecl;
                        }
                        $solde = $resteremb;
                        ?>
                        <tbody>
                            <tr>
                                <th>HT</th>
                                <th>TVA</th>
                                <th>TTC</th>
                                <th>Payé</th>
                                <th>Pénalité</th>
                                <?php if ($solde > 0) { ?>
                                    <th>Reste</th>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $valht); ?></td>
                                <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $valtva); ?></td>
                                <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $valttc); ?></td>
                                <td class="text-center"><span class="totpaye"><?php echo afficheMontant($_SESSION['Paie_affiche'], $montpaieclaf); ?></span></td>
                                <td class="text-center"><span class="solde"><?php echo afficheMontant($_SESSION['Paie_affiche'], $montpenalite); ?></span></td>
                                <?php if ($solde > 0) { ?>
                                    <td class="text-center"><span class="solde"><?php echo afficheMontant($_SESSION['Paie_affiche'], $resteremb); ?></span></td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">

            <?php if ($hebstatut == 1) { ?>
                <?php// if (get('do') == 'detfact2') { ?>
                <a href="#" class="btn btn-primary pull-right tip  btn_heb_print " style="margin-right: 5px;"> Imprimer</a>
                <?php// } ?>
                <?php if (in_array('FCTRTN', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <?php if ($statut == 'occupe') {
                    ?>
                        <button type="button" data-toggle="modal" data-target="#mdpaie" class="btn btn-success pull-right" style="margin-right: 5px;">
                            Payer
                        </button>
                    <?php }
                    ?>
                <?php } ?>
                <?php if (in_array('EL', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <?php if ((($statut == 'occupe')) && (get('do') != 'detfact2' && get('serv') != 'majfact2')) { ?>
                        <?php if ($solde == 0 || $mode == 'Credit' || $mode == 'Don') { ?>
                            <button type="button" data-toggle="modal" data-target="#mdliberation" class="btn btn-warning pull-right" id="btn_lib_1" style="margin-right: 5px;">
                                Libérer
                            </button>
                        <?php } elseif ($solde < 0) { ?>
                            <button type="button" data-toggle="modal" data-target="#mdremboursement" class="btn btn-warning pull-right" id="btn_lib_1" style="margin-right: 5px;">
                                Libérer
                            </button>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <a href="#" class="btn btn-primary pull-right tip  btn_heb_print3" style="margin-right: 5px;"> Imprimer</a>
                <?php
                if ($hebstatut == 1) {
                    if ($solde > 0) { ?>
                        <button type="button" data-toggle="modal" data-target="#mdremboursement" class="btn btn-warning pull-right" id="btn_lib_1" style="margin-right: 5px;">
                            Rembourser
                        </button>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

        </div>
</section>