<?php
/*
* =======================================================================
* FILE NAME:        View.php
* DATE CREATED:     17-11-2017
* FOR TABLE:        respointage
* PRODUCED BY:      HEZECOM UltimateSpeed PHP CODE GENERATOR
* AUTHOR:           Hezecom (http://hezecom.com) info@hezecom.net
* =======================================================================
*/
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=respointage&do=autosearch');
?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Pointage spécial</h3>
                    <ul class="nav pull-right">

                        <a href="" class="btn btn-default btn-xs tip" id="btnpermut" title="Nouvelle permutation"></i>Ajouter</a>
                        <a href="<?php echo H_ADMIN_MAIN;?>&view=categorie_chambre&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip btn_print_list_perm" title="<?php echo LANG_TIP_PRINT;?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
                        </ul>
                </div>
                    <div class="box-header with-border">
                <form class="form-inline" id="periode_presence">
                    <div class="form-group">
                        <label for="dte1">Du</label>
                          <input name="datedebut" id="datedebut" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2"> 
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="datefin" id="datefin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                    </div>
                    <button type="submit" class="btn btn-default" id="btn_periode">Valider</button>
                </form> 
            </div>
                <!-- /.box-header -->
                <div class="box-body">
<!--                    <div class="output"></div>
-->                    <table data-page="false" class="tableau table table-bordered table-hover table-striped t1 t2"
                           data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>"
                           data-page-previous-text="<?php echo LANG_PREVIOUS; ?>"
                           data-page-next-text="<?php echo LANG_NEXT; ?>">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Employé</th>
                            <th>Date</th>
                             <th>Date début</th>
                            <th>Date fin</th>
                            <th data-hide="phone,tablet">Heure début</th>
                            <th data-hide="phone,tablet">Heure fin</th>
                            <th data-hide="phone,tablet">Statut</th>
                            <th data-hide="phone,tablet">Details</th>
                            <th data-hide="phone,tablet">Actions</th>
                       </tr>
                        </thead>
                        <tbody id="viewdata">
                        <?php
                       //include(APP_FOLDER . '/views/admin/respointage/datapermutation.php');
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination"><?php //echo $paging;?></div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
<?php include('modal_otrepointage.php');?>