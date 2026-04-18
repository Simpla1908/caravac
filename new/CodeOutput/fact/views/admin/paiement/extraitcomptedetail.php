<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		respointage
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=respointage&do=autosearch'); ?>



<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Extrait de compte</h3>
                <ul class="nav pull-right">
                    <!--<a href="<?php echo H_ADMIN; ?>&view=respointage&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>-->
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default tip btn_prnt_extrcompte" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                    <!--                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=respointage&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
            <div class="box-header with-border hidden">
                <div class="output"></div>
                <form action="<?php echo H_ADMIN_MAIN . '&view=paiement&do=check'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data" class="form-inline">
                    <label for="idclient">client</label>
                    <div class="form-group">
                        <select class="form-control choz" name="idclient">
                            <option value="">Sélectionner un client</option>
                            <?php
                            foreach ($result as $rows) {
                            ?>
                                <option value="<?php echo $rows->id_client; ?>"><?php echo $rows->nom_client; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="datedebut" id="datedebut" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="datefin" id="datefin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                    </div>

                    <button type="submit" class="btn btn-default" id="btnextraitcompte"><i class="fa fa-check-circle"></i> Valider</button>
                </form>

            </div>



            <!-- /.box-header -->
            <div class="box-body" id="datasextraitcompte">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>DATE</th>
                            <th>N° FACTURE</th>
                            <th>N° RECU </th>
                            <th data-hide="phone,tablet">DEBIT</th>
                            <th data-hide="phone,tablet">CREDIT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nbre = count($data['id']);
                        $tdebit = 0;
                        $tcredit = 0;
                        $j = 1;
                        $monnaie_usd = 'USD';
                        $monnaie_cdf = 'CDF';
                        for ($i = 0; $i < $nbre; $i++) {
                            $debit = 0;
                            $credit = 0;
                            $dte = $data['date'][$i];
                            $numfact = $data['numfact'][$i];
                            $numrecu = $data['numrecu'][$i];
                            $debitcdf = $data['debitcdf'][$i];
                            $creditcdf = $data['creditcdf'][$i];
                            $debitusd = $data['debitusd'][$i];
                            $creditusd = $data['creditusd'][$i];
                            $taux_op = $data['taux'][$i];
                            $debitcdf_conv = 0;
                            $creditcdf_conv = 0;
                            if ($debitcdf > 0) {
                                $debitcdf_conv = montant_equivalent_bdd($monnaie_cdf, $monnaie_usd, $taux_op, $debitcdf);
                            }
                            if ($creditcdf > 0) {
                                $creditcdf_conv = montant_equivalent_bdd($monnaie_cdf, $monnaie_usd, $taux_op, $creditcdf);
                            }
                            $debit = $debit + $debitusd + $debitcdf_conv;
                            $credit = $credit + $creditusd + $creditcdf_conv;
                            if ($credit > $debit && $debit > 0) {
                                $credit = $debit;
                            }
                        ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo dateAffiche($dte); ?></td>
                                <td><?php echo $numfact; ?></td>
                                <td><?php echo $numrecu; ?></td>
                                <td><?php if ($debit > 0) {
                                        echo afficheMontant2($monnaie_usd, $debit);
                                    } ?></td>
                                <td><?php if ($credit > 0) {
                                        echo afficheMontant2($monnaie_usd, $credit);
                                    } ?></td>
                            </tr>
                        <?php
                            $tdebit += $debit;
                            $tcredit += $credit;
                            $j++;
                        }
                        $solde = $tdebit - $tcredit;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4"><span class="pull-left">TOTAL</span></th>
                            <th><?php echo afficheMontant2($monnaie_usd, $tdebit); ?></th>
                            <th><?php echo afficheMontant2($monnaie_usd, $tcredit); ?></th>

                        </tr>
                        <tr>
                            <th colspan="4"><span class="pull-left">SOLDE</span></th>
                            <th colspan="2" align="center">
                                <?php
                                echo afficheMontant2($monnaie_usd, $solde);
                                ?>
                            </th>
                        </tr>

                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->