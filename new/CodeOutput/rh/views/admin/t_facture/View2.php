
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
<?php // AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=t_facture&do=autosearch');   ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Liste des factures normales</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Liste des factures proforma</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="col-xs-12">
                                <div>
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Liste des factures normales</h3>
                                        <ul class="nav pull-right">

                                            <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                                            <a href="<?php echo H_ADMIN_MAIN; ?>&view=t_facture&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                                            <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=t_facture&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>-->
                                            <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=t_facture&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>-->
                                            <!--<a href="<?php echo H_ADMIN; ?>&view=t_facture&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                                        </ul>

                                    </div><!-- /.box-header -->
                                    <div>



                                        <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                                            <thead>
                                                <tr>
                                                    <th>Numero</th>
                                                    <th data-hide="phone,tablet">Edition</th>
                                                    <th data-hide="phone,tablet">Echéance</th>
                                                    <th data-hide="phone,tablet">Client</th>
                                                    <th data-hide="phone,tablet">Montant total</th>
                                                    <th data-hide="phone,tablet">Montant payé</th>
                                                    <th data-hide="phone,tablet">Solde</th>
                                                    <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include(APP_FOLDER . '/views/admin/t_facture/datalignesfact.php'); ?>
                                            </tbody>
                                          <!--  <tfoot>
                                              <tr>
                                              <td colspan="6">
                                              <div class="pagination"><?php echo $paging; ?></div>
                                              </td>
                                              </tr>
                                          </tfoot>-->
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div><!-- /.col -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
