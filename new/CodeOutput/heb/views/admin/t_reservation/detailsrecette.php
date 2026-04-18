
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		paiement
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
                <h3 class="box-title titrepg">Détails recettes du <?php echo dateAffiche($dte1); ?> </h3>
                <ul class="nav pull-right">
                    <a href="#" d="./main.php?pg=admin&view=impression&do=detrecette&dte1=<?php echo $dte1; ?>" class="btn btn-default btn-xs tip btn_prtall" title="Imprimer">Imprimer</a>
                    <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=recette" class="btn btn-default btn-xs tip" title="Retour"><i class="fa fa-reply"></i> <?php echo 'Retour'; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <table data-page="false" class="table table-bordered table-hover table-striped table-condensed" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N° Réçu</th>
                            <th>N° Facture</th>
                            <th data-hide="phone,tablet">Client</th>
                            <th data-hide="phone,tablet">Agent</th>
                            <th data-hide="phone,tablet">Service</th>
                            <!--<th data-hide="phone,tablet">Montant <?php // echo' ' . AfficheMonnaie(getsymbole_devise()); ?></th>-->
                            <th data-hide="phone,tablet">Montant <?php // echo' ' . AfficheMonnaie(getsymbole_local()); ?></th>
                            <!--<th data-sort-ignore="true"><?php // echo LANG_ACTIONS; ?></th>-->
                        </tr>
                    </thead>
                    <tbody id="majdataspaie"> 
                        <?php
                        $cashusd = 0;
                        $cashcdf = 0;
                        $donusd = 0;
                        $doncdf = 0;
                        $i = 1;
                        foreach ($result as $rows){
                            $txpaie=$rows->taux;
                            $cdf1 =$rows->montantusd*$txpaie+ $rows->montantcdf;
                            $cdf= montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txpaie, $cdf1);
                            $cashcdf +=$cdf;
                            ?>
                            <tr>
                                <td><?php echo $rows->numero; ?></td>
                                <td><?php echo $rows->num_fact; ?></td>
                                <td><?php echo $rows->nom_client; ?></td>
                                 <td><?php echo $rows->nom_user; ?></td>
                                 <td><?php echo $rows->type; ?></td>
                                <!--<td><?php // echo afficheMontant(getsymbole_devise(),$usd); ?></td>-->
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$cdf); ?></td>
<!--                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-xs tip btn_pntrecu_histo" factureid="<?php echo $rows->id_fact; ?>" mode="<?php echo $rows->lib; ?>" dte="<?php echo $rows->dte; ?>" client="<?php echo $rows->nom_client; ?>" numfact="<?php echo $rows->num_fact; ?>" recu="<?php echo $rows->numero; ?>" montantusd="<?php echo $rows->montantusd; ?>" montantcdf="<?php echo $rows->montantcdf; ?>" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                                    </div>
                                </td>-->
                            </tr>
                        <?php }; ?>
                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                             <td></td>
                            <!--<td><b><?php // echo afficheMontant(getsymbole_devise(), $cashusd); ?></b></td>-->
                            <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'],$cashcdf); ?></b></td>
                            <!--<td></td>-->
                        </tr>
                    </tbody>

                </table>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfiltrerpaie" name="frmfiltrerpaie">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrer paiement</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="output"></div>

                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="datedebut" id="datedebut" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2"> 
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="datefin" id="datefin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button  class="btn btn-danger pull-right col-md-2"
                             id="btnfiltrerpaie"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                    <span class="btn btn-info hidden pull-right" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->