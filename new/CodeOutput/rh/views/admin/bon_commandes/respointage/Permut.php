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
                    <h3 class="box-title">Permutation horaire</h3>
                    <ul class="nav pull-right">

                        <a href="" class="btn btn-default btn-xs tip" id="btnpermut" title="Nouvelle permutation"></i>Permuter</a>
                        <a href="<?php echo H_ADMIN_MAIN;?>&view=categorie_chambre&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT;?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
                        </ul>
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
                            <th>Num</th>
                            <th>Début</th>
                             <th>Fin</th>
                            <th>Horaire</th>
                            <th data-hide="phone,tablet">Titulaire</th>
                            <th data-hide="phone,tablet">Remplaçant</th>
                            <th data-hide="phone,tablet">Type</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                        </thead>
                        <tbody id="viewdata">
                        <?php
                       include(APP_FOLDER . '/views/admin/respointage/datapermutation.php');
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
<?php include('modal_permut.php');?>