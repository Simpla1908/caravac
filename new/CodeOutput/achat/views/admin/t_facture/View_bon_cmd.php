
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
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=t_facture&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title titrepg">Etat de besoins du jour</h3>
                <ul class="nav pull-right">
                    <?php if (in_array('ACHCEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=add_bon_cmd" class="btn btn-danger btn-sm tip" title="Créer un état de besoin"><i class="fa fa-plus-circle"></i> Créer</a>
                    <?php } ?>
                    <a  class="btn btn-primary btn-sm tip" title="Filtrer la liste" data-toggle="modal" data-target="#modalfiltre"><i class="fa fa-sort"></i> Filtrer</a>
                    <?php if (in_array('ACHILEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=listeeb" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                    <?php } ?>
<!--                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=t_facture&do=export&hexport=yes&etype=excel" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=t_facture&do=export&hexport=yes&etype=word" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=truncate" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th data-hide="phone,tablet">N° Etat</th>
                            <th data-hide="phone,tablet">Description</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th data-hide="phone,tablet">Fournisseurs</th>
                            <th data-hide="phone,tablet">Total</th>
                            <th data-hide="phone,tablet">Devise</th>
                            <th data-hide="phone,tablet">Statut</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody id="dataview">

                        <?php
                        $i=1;
                        foreach ($result as $rows) {
                            if($rows->statut_bon=='envoye'){
                                $statut='Envoyé';
                                $colorLign='text-black';
                            }  elseif ($rows->statut_bon=='rejete') {
                                $statut='Rejeté';
                                $colorLign='text-red';
                            }  else {
                                $statut='Bon de commande';
                                $colorLign='text-green';
                            }
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $rows->num_fact; ?></td>
                                <td><?php echo $rows->justification; ?></td>
                                <td><?php echo dateAffiche($rows->date_edition); ?></td>
                                <td><?php echo $rows->nom_entreprise; ?></td>
                                <td><?php echo format_chiffre($rows->tot_cmd); ?></td>
                                <td><?php echo $rows->monnaie; ?></td>
                                <td class="<?php echo $colorLign; ?>"><?php  echo $statut; ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=details_besoins"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                        <?php if (in_array('ACHMEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                        <!--<a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>-->
                                        <?php } ?>
                                        <?php if (in_array('ACHSEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                        <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php 
                        //Mise en session pour impression
                        array_push($_SESSION['rows_bc']['i'], $i);
                        array_push($_SESSION['rows_bc']['Bon_cmd'], $rows->num_fact);
                        array_push($_SESSION['rows_bc']['Description'], $rows->justification);
                        array_push($_SESSION['rows_bc']['date'], dateAffiche($rows->date_edition));
                        array_push($_SESSION['rows_bc']['fsse'], ucfirst($rows->nom_entreprise));
                        array_push($_SESSION['rows_bc']['Total'], format_chiffre($rows->tot_cmd));
                        array_push($_SESSION['rows_bc']['Devise'], $rows->monnaie);
                        array_push($_SESSION['rows_bc']['Statut'], $statut);   
                        //Fin mise en session
                        $i++;
                        } ?>
                    </tbody>
<!--                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <div class="pagination"><?php echo $paging; ?></div>
                            </td>
                        </tr>
                    </tfoot>-->
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<!-- Modal -->
<div class="modal fade" id="modalfiltre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfiltre" name="frmfiltre">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Filtrage</h4>
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
                id="btnfiltre2"><i class="fa fa-check fa-fw"></i>&nbsp;Valider
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