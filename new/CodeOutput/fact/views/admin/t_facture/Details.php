<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

if (get('f') == 1) {
    $hide = "hidden1";
} else {
    $hide = "hidden";
}
?>

<div class="row">
    <div class="col-xs-12">
        <section class="content">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Détails factures</a></li>
                    <li class="<?php echo $hide; ?>"><a href="#tab_2" data-toggle="tab">Historique de paiements</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="box">
                                    <?php if ($msg == 1) { ?>
                                        <div class="callout callout-success" style="margin-bottom:0!important;" id="div_notification_fact">
                                            <h4><i class="fa fa-info-circle"></i> L'envoie par mail de cette facture s'est effectué avec succès!</h4>
                                            <!--<span id="sp_notification_fact"></span>-->
                                        </div>
                                    <?php } ?>
                                    <!-- form start -->
                                    <!--<form class="form-horizontal" action="<?php echo H_ADMIN_MAIN . '&view=t_facture&do=enregfact'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">-->
                                    <div class="box-body">
                                        <div class="row pad-top-botm ">
                                            <?php if ($ttc == $mont_paie) { ?>
                                                <div class="col-sm-12">
                                                    <div class="callout callout-danger">
                                                        <h4><i class="fa fa-info-circle"></i> Facture payée!!!</h4>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <img src="public/uploads/<?php echo $logo; ?>" height="100" width="100" />
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                <br /><br /><br />
                                                <strong>Email : </strong><?php echo $mail; ?>
                                                <br />
                                                <strong>Tél :</strong><?php echo $phone; ?><br />
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <br /><br /><br />
                                                <strong><?php echo $nomcomp; ?> </strong>
                                                <br />
                                                <?php echo $adrcomp; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row text-center contact-info hidden">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <hr />
                                                <span>
                                                    <strong>Email : </strong> info@yourdomain.com
                                                </span>
                                                <span>
                                                    <strong>Call : </strong> +95 - 890- 789- 9087
                                                </span>
                                                <span>
                                                    <strong>Fax : </strong> +012340-908- 890
                                                </span>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="row pad-top-botm client-info">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <h4> <strong>Information client</strong></h4>
                                                <?php if (!empty($societe)) { ?>
                                                    <b>Socièté :</b> <span id='nomsct'><?php echo $nomcl;
                                                                                        $_SESSION['client'] = $nomcl; ?></span>
                                                    <br />
                                                <?php } else { ?>
                                                    <br />
                                                <?php } ?>
                                                <strong>Noms:</strong> <span id='nomcl'><?php echo $societe;  ?></span>
                                                <br />
                                                <b>Tél :</b><span id='telcl'><?php echo $tel; ?></span>
                                                <br />
                                                <b>E-mail :</b><span id='emailcl'><?php echo $emailcl; ?></span>
                                                <br />
                                                <b>Adresse :</b><span id='adrcl'><?php echo $adr; ?></span>,

                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <h4> <strong>Détails facture <?php echo $typefact; ?></strong> </h4>
                                                <b>FACTURE N°<?php echo $numfact;
                                                                $_SESSION['numfact'] = $numfact; ?> </b>
                                                <br />
                                                Date d'édition: <span id='dte_edtsp'><?php echo $dte_edit ?></span>
                                                <br />
                                                Date d'échéance : <span id='dte_echsp'><?php echo $dte_ech; ?></span><br />

                                                Mode de paiement : <span id='mode_paie'><?php echo $mode; ?></span>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row hidden">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <a href="#" title="Ajouter" data-toggle="modal" data-target="#modaldepot" class="btn btn-danger btn-xs" id="btnaddarticle"><i class="fa fa-plus-circle"></i> Ajouter article ou service</a>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Désignation</th>
                                                                <th>Quantité</th>
                                                                <th>Prix Unitaire</th>
                                                                <th>TVA</th>
                                                                <th>Sous Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="lignefact">
                                                            <?php include(APP_FOLDER . '/views/admin/t_facture/lignesfact2.php'); ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                                Total H.T :
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <strong>
                                                    <span id="spht"><?php echo afficheMontant($_SESSION['Paie_affiche'], $ttc - $monttvax + $montremise) ?></span>
                                                </strong>
                                            </div>
                                            <hr />
                                            <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                                Total T.V.A:
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <strong>
                                                    <span id="sptva"><?php echo afficheMontant($_SESSION['Paie_affiche'], $monttvax) ?></span>
                                                </strong>
                                            </div>
                                            <?php if ($remise > 0) { ?>
                                                <br />
                                                <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                                    Remise (<?php echo $remise; ?>%):
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <strong>
                                                        <span><?php echo afficheMontant($_SESSION['Paie_affiche'], $montremise) ?></span>
                                                    </strong>
                                                </div>
                                            <?php } ?>
                                            <br />
                                            <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                                Total T.T.C :
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <strong>
                                                    <span id="spttc"><?php echo afficheMontant($_SESSION['Paie_affiche'], $ttc) ?></span>
                                                </strong>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <strong>Instructions importantes:
                                                </strong>
                                                <?php echo $justification; ?>
                                            </div>
                                        </div>
                                        <br /><br />
                                        <br />
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <p class="text-center">
                                            <b>ID.Nat.</b>: <?php echo $idnat; ?> <b>RCCM.</b>: <?php echo $rccm; ?><br />
                                            <!--<b>Adresse</b>: 27,Mbekani Q.Révolution C.Kisenso<br />-->
                                            <!--<b>Email</b>: simplicelandu1908@gmail.com <b>Tél.</b>.: +243 823 903 252-->
                                        </p>
                                    </div>
                                    <!-- /.box-footer -->
                                    <!--</form>-->
                                </div>
                                <!-- /.box -->
                            </div>
                            <div class="col-md-2">
                                <!--<div class="info-box">-->
                                <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=viewall&f=<?php echo $etatfact; ?>" class="btn btn-primary btn-lg btn-block" id="btn_retour_fact"><i class="fa fa-mail-reply"></i> Retour</a>
                                <br>
                                <?php if (get('f') == 1) { ?>
                                    <?php if ($ttc != $mont_paie) { ?>
                                        <a href="<?php echo H_ADMIN; ?>&view=paiement&do=add&modepaie=<?php echo $modepaie; ?>&id_fact=<?php echo $id_fact; ?>" class="btn btn-primary btn-lg btn-block" id="btn_payer_fact3"><i class="fa fa-check"></i> Payer</a>
                                        <!--<button type="button" class="btn btn-primary btn-lg btn-block" id="btn_payer_fact" idfact="<?php echo $id_fact; ?> " modepaie="<?php echo $mode; ?>"><i class="fa fa-check"></i> Payer</button>-->
                                        <input id="modepaiement" name="modepaiement" type="hidden" value="<?php echo $modepaie; ?>" class="form-control">
                                        <br>
                                    <?php } ?>
                                <?php } ?>
                                <a href="<?php echo H_ADMIN; ?>&view=impression&do=sendmail&id=<?php echo $id_fact; ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-envelope"></i> Envoyer</a>
                                <br>
                                <a href="#" idf="<?php echo $id_fact; ?>" modepaie="<?php echo $mode; ?>" class="btn btn-primary btn-lg btn-block" id="btn_print_facturef"><i class="fa fa-print"></i> Imprimer</a>
                                <!--</div>-->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane <?php echo $hide; ?>" id="tab_2">

                        <a href="<?php echo H_ADMIN_MAIN; ?>&view=paiement&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-sm tip btn_prnt_fpaiement pull-right" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                        <br><br>
                        <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th data-hide="phone,tablet">Date</th>
                                    <th data-hide="phone,tablet">N° Réçu</th>
                                    <th data-hide="phone,tablet">Montant</th>
                                    <th data-hide="phone,tablet">Mode</th>
                                    <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>

                                </tr>
                            </thead>
                            <tbody id="majdataspaie">

                                <?php
                                //Mise en session pour impression
                                $_SESSION['rows_paiement'] = array();
                                $_SESSION['rows_paiement']['i'] = array();
                                $_SESSION['rows_paiement']['nom_client'] = array();
                                $_SESSION['rows_paiement']['num_fact'] = array();
                                $_SESSION['rows_paiement']['numero'] = array();
                                $_SESSION['rows_paiement']['dte'] = array();
                                $_SESSION['rows_paiement']['lib'] = array();
                                $_SESSION['rows_paiement']['montant'] = array();
                                //Fin mise en session
                                $cash = 0;
                                $credit = 0;
                                $don = 0;
                                $i = 1;
                                foreach ($resultpaie as $rows) {
                                    if ($rows->lib == 'Don') {
                                        $montant = montant_equivalent_bdd($_SESSION['Paie_affiche'], $_SESSION['Paie_affiche'], $rows->taux, $ttc);
                                    } else {
                                        $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant);
                                    }

                                    //                            if ($rows->lib == 'Cash') {
                                    $cash += $montant;
                                    //                            } else if ($rows->lib == 'Credit') {
                                    //                                $credit+=$montant;
                                    //                            } else {
                                    //                                $don+=$montant;
                                    //                            }
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo dateAffiche($rows->dte); ?></td>
                                        <td><?php echo $rows->numero; ?></td>
                                        <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant); ?></td>
                                        <td>
                                            <?php
                                            echo $rows->lib;
                                            ?>
                                        </td>
                                        <td class="table-actions">
                                            <div class="btn-group">
                                                <a class="btn btn-default btn-xs tip btn_pntrecu_histo" factureid="<?php echo $rows->id_fact; ?>" mode="<?php echo $rows->lib; ?>" dte="<?php echo $rows->dte; ?>" client="<?php echo $rows->nom_client; ?>" numfact="<?php echo $rows->num_fact; ?>" recu="<?php echo $rows->numero; ?>" montantusd="<?php echo $rows->montantusd; ?>" montantcdf="<?php echo $rows->montantcdf; ?>" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php
                                    //Mise en session pour impression
                                    array_push($_SESSION['rows_paiement']['i'], $i);
                                    array_push($_SESSION['rows_paiement']['nom_client'], $rows->nom_client);
                                    array_push($_SESSION['rows_paiement']['num_fact'], $rows->num_fact);
                                    array_push($_SESSION['rows_paiement']['numero'], $rows->numero);
                                    array_push($_SESSION['rows_paiement']['dte'], dateAffiche($rows->dte));
                                    array_push($_SESSION['rows_paiement']['lib'], $rows->lib);
                                    array_push($_SESSION['rows_paiement']['montant'], afficheMontant($_SESSION['Paie_affiche'], $montant));
                                    //Fin mise en session
                                    $i++;
                                }
                                ?>
                            </tbody>
                            <tfoot id="majdataspaie1">
                                <tr>
                                    <th colspan="3">Total </th>
                                    <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $cash); ?></th>
                                    <td></td>
                                </tr>
                                <!--                        <tr>
                            <th colspan="3">Total Acompte</th>
                            <th><?php // echo afficheMontant($_SESSION['Paie_affiche'], $credit); 
                                ?></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="3">Total Crédit</th>
                            <th><?php // echo afficheMontant($_SESSION['Paie_affiche'], $don); 
                                ?></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="3">Totaux (cash + acompte)</th>
                            <th><?php // echo afficheMontant($_SESSION['Paie_affiche'], $cash + $credit); 
                                ?></th>
                            <td></td>
                        </tr>-->
                            </tfoot>
                        </table>
                        <?php
                        //Mise en session pour impression
                        $_SESSION['datedebut_paiement'] = date('d/m/Y');
                        $_SESSION['datefin_paiement'] = date('d/m/Y');
                        $_SESSION['cash_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $cash);
                        $_SESSION['credit_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $credit);
                        $_SESSION['don_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $don);

                        //Fin mise en session
                        ?>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->

        </section>
    </div><!-- /.col -->
</div><!-- /.row -->