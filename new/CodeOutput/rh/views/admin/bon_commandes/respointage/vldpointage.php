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
                    <h3 class="box-title">Validation pointage</h3>
                </div>
                <?php if($_SESSION['depart_pointage']['ok']==1){  ?>
                <div class="output"></div>
                <!-- /.box-header -->
                <div class="box-body">
<!--                    <div class="output"></div>
-->                    <table data-page="false" class="tableau table table-bordered table-hover table-striped t1 t2"
                           data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>"
                           data-page-previous-text="<?php echo LANG_PREVIOUS; ?>"
                           data-page-next-text="<?php echo LANG_NEXT; ?>">
                        <thead>
                        <tr>
                             <th>Horaire</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th data-hide="phone,tablet">Employés</th>
                            <th data-hide="phone,tablet">Présents</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                        </thead>
                        <tbody id="viewdata">
                        <?php
                       include(APP_FOLDER . '/views/admin/respointage/datavalidation.php');
                        ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                 <?php }else if($_SESSION['depart_pointage']['ok']==0){
           ?>
            <div class="output">
             <div class="alert alert-danger">La liste de validation n'est pas disponible!</div>
            </div>
           <?php 
            }          
            ?>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
