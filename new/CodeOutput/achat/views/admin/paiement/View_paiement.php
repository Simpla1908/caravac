
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
//Declaration session pour impression
$_SESSION['rows_paiement'] = array();
$_SESSION['rows_paiement']['i'] = array();
$_SESSION['rows_paiement']['Fournisseurs'] = array();
$_SESSION['rows_paiement']['Boncmd'] = array();
$_SESSION['rows_paiement']['Montanttotal'] = array();
$_SESSION['rows_paiement']['Montantpaye'] = array();
$_SESSION['rows_paiement']['Solde'] = array();
//Fin Declaration session
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=t_facture&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Paiements</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=listepaiement" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th data-hide="phone,tablet">Fournisseurs</th>
                            <th data-hide="phone,tablet">N° Bon cmd</th>
                            <th data-hide="phone,tablet">Montant total</th>
                            <th data-hide="phone,tablet">Montant payé</th>
                            <th data-hide="phone,tablet">Solde</th>
                            <!--<th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach ($result as $rows) {
                            $monnaie_boncmd=$rows->monnaie;
                            $taux=$rows->taux;
                            $id_fact=$rows->id_fact;
                            $mont_ttc=TotalBonCom($id_fact);
                            $montantboncmd = montant_equivalent_bdd($monnaie_boncmd,$monnaie_boncmd,$taux,$mont_ttc);
                            $montant_paye=totalMontantPaye($id_fact);
                            $montant_payer = montant_equivalent_bdd($monnaie_boncmd,$monnaie_boncmd,$taux,$montant_paye);
                            $solde=$montantboncmd - $montant_payer;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $rows->nom_entreprise; ?></td>
                                <td><a href="#"><?php echo $rows->num_cmd; ?></a></td>
                                <td><?php echo format_chiffre($montantboncmd).' '.$monnaie_boncmd; ?></td>
                                <td><?php echo format_chiffre($montant_payer).' '.$monnaie_boncmd; ?></td>
                                <td class="<?php // echo $colorLign; ?>"><?php  echo format_chiffre($solde).' '.$monnaie_boncmd; ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN;?>&view=paiement&id_fact=<?php echo $rows->id_fact; ?>&do=detailspaie"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS;?>"></span></a>
                                        <?php if ($solde!=0) { ?>
                                        <?php // if (in_array('ACHRDP', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                        <!--<a href="<?php echo H_ADMIN; ?>&view=paiement&id_fact=<?php echo $rows->id_fact; ?>&solde=<?php echo $solde; ?>&do=demande" class="btn btn-danger btn-xs"> <span class="fa fa-send tip" title="Envoie demande de paiement"> </span></a>-->
                                        <?php // } ?>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++; 

                         //Mise en session pour impression
                        array_push($_SESSION['rows_paiement']['i'], $i);
                        array_push($_SESSION['rows_paiement']['Fournisseurs'], $rows->nom_entreprise);
                        array_push($_SESSION['rows_paiement']['Boncmd'], $rows->num_cmd);
                        array_push($_SESSION['rows_paiement']['Montanttotal'],format_chiffre($montantboncmd).' '.$monnaie_boncmd);
                        array_push($_SESSION['rows_paiement']['Montantpaye'],format_chiffre($montant_payer).' '.$monnaie_boncmd);
                        array_push($_SESSION['rows_paiement']['Solde'],format_chiffre($solde).' '.$monnaie_boncmd);

                    } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->