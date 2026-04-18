<div class="modal fade mdpaie" id="mdpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Paiement: <span id="txtpaie_eqvlt" class="text-danger"></span></h4>
            </div>
            <div class="modal-body" id="dv_paie">
                <?php include(APP_FOLDER . '/views/admin/t_reservation/bloc_paiement.php'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <?php if (get('do') == 'detfact2') { ?>
                    <button class="btn btn-danger" id="btn_val_paieheb2">&nbsp;Valider</button>
                <?php } else { ?>
                    <button class="btn btn-danger" id="btn_val_paieheb">&nbsp;Valider</button>
                <?php } ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="mdmdfnuitee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Modification nuitée</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="nuite_frm">
                    <div class="box-body">
                        <div class="callout hidden" style="margin-bottom: 0!important;" id="notifred">
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12  ">
                                <label for="exampleInputEmail1">Chambre</label>
                                <select class=" col-md-3 form-control choz" name="ch_histo_id" id="ch_histo_id">
                                    <option value=""></option>
                                    <?php
                                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                        $id_ch = $_SESSION['panier']['id_article'][$i];
                                        $repas = $_SESSION['panier']['repas'][$i];
                                        $nom_ch = $_SESSION['panier']['nom'][$i];
                                        $qte = $_SESSION['panier']['qte'][$i];
                                        $dte_in = $_SESSION['panier']['dte_a'][$i];
                                        if ($repas == 0) {
                                    ?>
                                            <option dte_in="<?php echo $dte_in ?>" maxnuite="<?php echo $qte ?>" value="<?php echo $id_ch ?>"><?php echo $nom_ch ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12  ">
                                <label for="exampleInputEmail1">Nombre de nuitée</label>
                                <input class="form-control" name="nbrnuitee" id="nbrnuitee" type="text">
                            </div>
                            <input name="nbrnuitee1" id="nbrnuitee1" type="hidden" value="0">
                            <input name="dte_in" id="dte_in" type="hidden" value="">
                            <input name="resch_id1" class="id_resch" type="hidden" value="<?php echo $id_resch; ?>">
                            <input name="id_res2" type="hidden" value="<?php echo $id_res; ?>">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="up_nuite_btn">Valider</button>
            </div>

        </div>
    </div>
</div>

<!--Changer Responsable-->
<div class="modal fade" id="mdrespo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Modification Responsable</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="respo_frm">
                    <div class="box-body">
                        <div class="callout hidden" style="margin-bottom: 0!important;" id="notifred">
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12  ">
                                <label for="exampleInputEmail1">Responsable</label>
                                <select class=" col-md-3 form-control choz" name="resp_id" id="resp_id">
                                    <?php foreach ($responsables as $rows) { ?>
                                        <option value="<?php echo $rows->id_respo ?>" prive='<?php echo $rows->filtre ?>'><?php echo $rows->entreprise ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input name="resch_id1" class="id_resch" type="hidden" value="<?php echo $id_resch; ?>">
                            <input name="id_res2" type="hidden" value="<?php echo $id_res; ?>">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="up_respo_btn">Valider</button>
            </div>

        </div>
    </div>
</div>

<!--Changer Prix-->
<div class="modal fade" id="mdmdfprice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Modification Prix</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="price_frm">
                    <div class="box-body">
                        <div class="callout hidden" style="margin-bottom: 0!important;" id="notifprice">
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12  ">
                                <label for="exampleInputEmail1">Chambre</label>
                                <select class=" col-md-3 form-control choz" name="ch_histo_id" id="ch_histo_id">
                                    <option value=""></option>
                                    <?php
                                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                        $id_ch = $_SESSION['panier']['id_article'][$i];
                                        $repas = $_SESSION['panier']['repas'][$i];
                                        $nom_ch = $_SESSION['panier']['nom'][$i];
                                        $qte = $_SESSION['panier']['qte'][$i];
                                        $dte_in = $_SESSION['panier']['dte_a'][$i];
                                        if ($repas == 0) {
                                    ?>
                                            <option dte_in="<?php echo $dte_in ?>" maxnuite="<?php echo $qte ?>" value="<?php echo $id_ch ?>"><?php echo $nom_ch ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12  ">
                                <label for="exampleInputEmail1">Nouveau prix</label>
                                <div class="input-group">
                                    <input class="form-control" name="price" id="price" type="text">
                                    <span class="input-group-addon"><?php echo AfficheMonnaie($_SESSION['Paie_affiche']); ?></span>
                                </div>
                            </div>
                            <input name="nbrnuitee1" id="nbrnuitee1" type="hidden" value="0">
                            <input name="dte_in" id="dte_in" type="hidden" value="">
                            <input name="resch_id1" class="id_resch" type="hidden" value="<?php echo $id_resch; ?>">
                            <input name="id_res2" type="hidden" value="<?php echo $id_res; ?>">
                            <input name="tauxfact" type="hidden" value="<?php echo $tauxfactheb; ?>">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="up_price_btn">Valider</button>
            </div>

        </div>
    </div>
</div>

<!--Changer Assujestissement TVA-->
<div class="modal fade" id="mdmdftva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">TVA</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="tva_frm">
                    <div class="box-body">
                        <div class="callout hidden" style="margin-bottom: 0!important;" id="notiftva">
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12  ">
                                <label for="exampleInputEmail1">Client</label>
                                <select class=" col-md-3 form-control choz" name="assujetti" id="assujetti">
                                    <?php if ($assujetti == 1) { ?>
                                        <option value="1" selected="">Assujetti</option>
                                        <option value="0">Exonéré</option>
                                    <?php } else { ?>
                                        <option value="1">Assujetti</option>
                                        <option value="0" selected="">Exonéré</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input name="id_fact" type="hidden" value="<?php echo $id_fact; ?>">
                            <input name="resch_id1" class="id_resch" type="hidden" value="<?php echo $id_resch; ?>">
                            <input name="id_res2" type="hidden" value="<?php echo $id_res; ?>">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="up_tva_btn">Valider</button>
            </div>

        </div>
    </div>
</div>


<!--Changer Prix-->
<div class="modal fade" id="mdannuleres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Annulation réservation</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="annuleres_frm">
                    <div class="box-body">
                        <div class="callout hidden" style="margin-bottom: 0!important;" id="notifresxxx">
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>
                        <div class="row">
                            <table class="table table-bordered table-condensed">
                                <tbody>
                                    <tr>
                                        <th>Montant Payé</th>
                                        <th>Pénalité</th>
                                        <th>Reste</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $ttpay); ?></td>
                                        <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $montremb); ?></td>
                                        <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $totpaye - $montremb); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input name="num_fact" class="form-control" type="hidden" value="<?php echo $num_fact ?>">
                            <input name="ch_histo2" id="ch_histo2" type="hidden" value="<?php echo $histoch_id; ?>">
                            <input name="idfct1" id="idfct1" type="hidden" value="<?php echo $id_fact; ?>">
                            <input name="resch_id1" class="id_resch" type="hidden" value="<?php echo $id_resch; ?>">
                            <input name="id_res2" type="hidden" value="<?php echo $id_res; ?>">
                            <input name="montpayeres" type="hidden" value="<?php echo $ttpay; ?>">
                            <input name="montremb" type="hidden" value="<?php echo $montremb; ?>">
                            <input name="txfct" class="form-control" type="hidden" value="<?php echo $tauxfact ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="usd">Montant remboursement <?php echo AfficheMonnaie(getsymbole_devise()); ?></label>
                                <div class="input-group">
                                    <input name="usd" id="usd" class="form-control" type="text" value="">
                                    <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_devise()); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="cdf">Montant remboursement <?php echo AfficheMonnaie(getsymbole_local()); ?></label>
                                <div class="input-group">
                                    <input name="cdf" id="cdf" class="form-control" type="text" value="">
                                    <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_local()); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="annuleres_btn">Valider</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade mdremboursement" id="mdremboursement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Remboursement: <span id="txtpaie_eqvlt" class="text-danger"><?php echo afficheMontant($_SESSION['Paie_affiche'], abs($solde)); ?></span></h4>
            </div>
            <div class="modal-body">
                <div class="callout hidden" style="margin-bottom: 0!important;" id="notifremb">
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </div>
                <div class="row">
                    <form class="frmliberation">
                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                            <label for="usd">Montant <?php echo AfficheMonnaie(getsymbole_devise()); ?></label>
                            <div class="input-group">
                                <input name="usd" id="usd" class="form-control" type="text" value="0">
                                <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_devise()); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                            <label for="cdf">Montant <?php echo AfficheMonnaie(getsymbole_local()); ?></label>
                            <div class="input-group">
                                <input name="cdf" id="cdf" class="form-control" type="text" value="0">
                                <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_local()); ?></span>
                            </div>
                        </div>
                        <input name="num_fact" class="form-control" type="hidden" value="<?php echo $num_fact ?>">
                        <input name="txfct" class="form-control" type="hidden" value="<?php echo $tauxfact ?>">
                        <input name="montpaie" class="form-control" type="hidden" value="<?php echo $totpaye ?>">
                        <input name="totremb" class="form-control" type="hidden" value="<?php echo abs($solde) ?>">
                        <input name="hebstatut" id='hebstatut' class="form-control" type="hidden" value="<?php echo $hebstatut ?>">

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button class="btn btn-danger" id="btn_val_remb<?php echo $hebstatut ?>">&nbsp;Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="mdannuleroccup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabeloccup">Annulation occupation</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="annuleroccup_frm">
                    <div class="box-body">
                        <div class="callout hidden" style="margin-bottom: 0!important;" id="notifresxxx">
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>
                        <div class="row">
                            <table class="table table-bordered table-condensed">
                                <tbody>
                                    <tr>
                                        <th>Monatant TTC</th>
                                        <th>Montant Payé</th>
                                        <th>Montant à rembourser</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $ttc); ?></td>
                                        <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $totpaye); ?></td>
                                        <td class="text-center"><?php echo afficheMontant($_SESSION['Paie_affiche'], $totpaye); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input name="num_fact" class="form-control" type="hidden" value="<?php echo $num_fact ?>">
                            <input name="ch_histo2" id="ch_histo2" type="hidden" value="<?php echo $histoch_id; ?>">
                            <input name="idfct1" id="idfct1" type="hidden" value="<?php echo $id_fact; ?>">
                            <input name="resch_id1" class="id_resch" type="hidden" value="<?php echo $id_resch; ?>">
                            <input name="id_res2" type="hidden" value="<?php echo $id_res; ?>">
                            <input name="montpayeres" type="hidden" value="<?php echo $totpaye; ?>">
                            <input name="totfct" type="hidden" value="<?php echo $ttc; ?>">
                            <input name="montremb" type="hidden" value="<?php echo $totpaye; ?>">
                            <input name="txfct" class="form-control" type="hidden" value="<?php echo $tauxfact ?>">
                            <input name="modefac" type="hidden" value="<?php echo $modefacheboccup; ?>">
                            <input name="tva" type="hidden" value="<?php echo $tva; ?>">


                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="annuleroccup_btn">Valider</button>
            </div>

        </div>
    </div>
</div>