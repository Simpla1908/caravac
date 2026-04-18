<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_reservation
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <?php if ($statut == 'reserve') { ?>
                    <h3 class="box-title">Reservation</h3>
                <?php } ?>
                <?php if ($statut == 'occupe') { ?>
                    <h3 class="box-title">Facturation</h3>
                <?php } ?>
                <ul class="nav pull-right">
                    <?php if ($statut == 'reserve') { ?>
                        <a href="#" class="btn btn-default btn-xs tip" title="" data-toggle="modal" data-target="#mdannuleres">Annuler réservation</a>
                        <?php if (date('Y-m-d') >= $date_occ && $hebstatut == 1) { ?>
                            <a href="#" class="btn btn-default btn-xs tip" title="Occuper" id="btn_occup_ch">Occuper</a>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($statut == 'occupe') { ?>
                        <a href="#" title="" data-toggle="modal" data-target="#mdservice" class="btn btn-default btn-xs tip">
                            Services
                        </a>
                        <!--<a href="#" class="btn btn-default btn-xs tip" title="">Changer période</a>-->
                        <?php if (in_array('CC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                            <a href="#" class="btn btn-default btn-xs tip" title="" data-toggle="modal" data-target="#mdchambres">Chambres</a>
                        <?php } ?>
                        <a href="#" class="btn btn-default btn-xs tip" title="Modifier responsable" data-toggle="modal" data-target="#mdrespo">Responsable</a>
                        <?php if (in_array('HMNNTE', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                            <a href="#" class="btn btn-default btn-xs tip" title="" data-toggle="modal" data-target="#mdmdfnuitee">Modification nuitée</a>
                        <?php } ?>
                        <?php if (in_array('MDFPRICCH', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                            <a href="#" class="btn btn-default btn-xs tip" title="" data-toggle="modal" data-target="#mdmdfprice">Prix</a>
                        <?php } ?>
                        <?php // if ($_SESSION['type_user'] == 1) { 
                        ?>
                        <a href="#" class="btn btn-default btn-xs tip" title="" data-toggle="modal" data-target="#mdmdftva">TVA</a>
                        <a href="#" class="btn btn-default btn-xs tip" title="" data-toggle="modal" data-target="#mdannuleroccup">Annuler occupation</a>

                        <?php // } 
                        ?>
                    <?php } ?>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <?php if ($statut == 'reserve') { ?>
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Détails reservation</a></li>
                        <?php } ?>
                        <?php if ($statut == 'occupe') { ?>
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Détails facture</a></li>
                        <?php } ?>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Historique paiement</a></li>
                        <?php if ($_SESSION['type_user'] == 1) { ?>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Annulations</a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content" id="contenu">
                        <?php include(APP_FOLDER . '/views/admin/t_reservation/sejourdata.php'); ?>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!--Modal liberation-->
<div class="modal fade" id="mdliberation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Confirmation
            </div>
            <div class="modal-body">
                <h4 class="text-danger"> Voulez - vous vraiment libérer cette chambre?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                <button type="submit" class="btn btn-primary" id="btn_liberer_chambre">Oui</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdannulationpaiement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Confirmation
            </div>
            <div class="modal-body">
                <h4 class="text-danger"> Voulez - vous vraiment annuler ce paiement?</h4>
                <input name="annulergl_id" id="annulergl_id" type="hidden" value="0">
                <input name="refcompta" id="refcompta" type="hidden" value="0">
                <input name="montpaye" id="montpaye" type="hidden" value="0">
                <input name="devise" id="devise" type="hidden" value="0">
                <input name="tauxop" id="tauxop" type="hidden" value="0">
                <input name="benef" id="benef" type="hidden" value="0">
                <input name="idclient" id="idclient" type="hidden" value="0">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                <button type="submit" class="btn btn-primary" id="btn_vld_anpaie">Oui</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal service-->
<div class="modal fade" id="mdservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Services</h4>
            </div>
            <div class="modal-body">
                <div class="callout hidden" style="margin-bottom: 0!important;" id="notification">
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </div>
                <form id="serviceform">
                    <div class="table-responsive no-padding" style="overflow: auto; height: 300px;">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>Libellé</th>
                                    <th>Prix</th>
                                    <th>QTE</th>
                                </tr>
                                <?php
                                foreach ($services as $rows) {
                                    $id_ch = $rows->id_ch;
                                    $tarif_ch1 = $rows->tarif_ch;
                                    $monnaie_ch = $rows->monnaie;
                                    $tarif_ch2 = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $tarif_ch1);
                                ?>
                                    <tr>
                                        <td><input name="service_ids[]" value="<?php echo $id_ch ?>" type="checkbox"></td>
                                        <td><?php echo $rows->num_ch ?></td>
                                        <td>
                                            <?php echo afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2) ?>
                                            <input name="prix<?php echo $id_ch ?>" id="tarif_ch" type="hidden" value="<?php echo arrondir($tarif_ch2); ?>">
                                        </td>
                                        <td class="col-md-2"><input name="qte<?php echo $id_ch ?>" value="<?php echo 1 ?>" type="text" class="form-control col-md-2"></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input name="resch_id1" id="resch_id" type="hidden" value="<?php echo $id_resch; ?>">
                    <input name="id_res" type="hidden" value="<?php echo $id_res; ?>">
                    <input name="dte_a1" id="dte_a" type="hidden" value="<?php echo $date_occ; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <!--                <button  class="btn btn-danger tip" title="supprimer un service déja ajouté"
                                         id="del_service_sej">&nbsp;Supprimer
                                </button>-->
                <button class="btn btn-primary" id="add_service_sej">&nbsp;Ajouter
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php include(APP_FOLDER . '/views/admin/t_reservation/modalpaie.php'); ?>
<?php include(APP_FOLDER . '/views/admin/t_reservation/lstchambres.php'); ?>