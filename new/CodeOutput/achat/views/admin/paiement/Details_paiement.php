
<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		paiement
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

foreach ($result as $rows) {
    $fournisseur = $rows->nom_entreprise;
    $num_bon= $rows->num_fact;
    $montant_tot = $rows->mont_ttc;
    $monnaie=$rows->monnaie;
}

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Détails Paiement</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=paiement&do=view_paiement" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">
                                <br>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Founisseur</label>

                                    <div class="col-sm-8">
                                        : <span class="direct-chat-timestamp"><?php echo $rows->nom_entreprise; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">N° Bon commande</label>

                                    <div class="col-sm-8">
                                        : <span class="direct-chat-timestamp"><?php echo $num_bon; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-4 control-label">Montant total</label>

                                    <div class="col-sm-8">
                                        : <span class="direct-chat-timestamp"><?php echo format_chiffre($montant_tot).' '.$monnaie; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <br/><br/>
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Détails Paiement</a></li>
                                  </ul>
                                  <div class="tab-content no-border">
                                    <div class="tab-pane active" id="tab_1">
                                        <br>
                                        <div class="table-responsive">
                                            <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th data-hide="phone,tablet">Date</th>
                                                        <th data-hide="phone,tablet">N° Bon Caisse</th>
                                                        <th data-hide="phone,tablet">Montant payé</th>
                                                        <th data-hide="phone,tablet">Mode</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $i = 1;
                                                    $tot=0;
                                                    foreach ($result as $rows) {
                                                        $monnaie_boncmd = $rows->monnaie;
                                                        $taux =$rows->taux;
                                                        $montant_payer = montant_equivalent_bdd($monnaie_boncmd, $monnaie_boncmd, $taux, $rows->montant_paye);
                                                        $tot=$tot + $montant_payer;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo dateAffiche($rows->dte);  ?></td>
                                                            <td><?php echo $rows->numBon; ?></td>
                                                            <td><?php echo format_chiffre($montant_payer) . ' ' . $monnaie_boncmd; ?></td>
                                                            <td><?php echo $rows->lib; ?></td>
                                                        </tr>
                                                        <?php $i++;
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3">Total</th>
                                                        <th><?php echo format_chiffre($tot).' ' .$monnaie_boncmd; ?></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.tab-pane -->
                                  </div>
                                  <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
                
                
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
