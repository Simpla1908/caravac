
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
                <h3 class="box-title">Liste de présence</h3>
                <ul class="nav pull-right">
                    <!--<a href="<?php echo H_ADMIN; ?>&view=respointage&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>-->
                    <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default tip btn_print_list_emply" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>-->
<!--                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=respointage&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
             <div class="box-header with-border">
                <form class="form-inline" id="periode_presence">
                    <div class="form-group">
                        <select id="periode" name="annee" class="form-control choz">
                        <?php 
                        $y=date('Y');
                        for($i=$y;$i>= 2010;$i--){ ?>
                            <option value="<?php echo $i?>"><?php echo $i?></option>
                        <?php }?>
                    </select>
                    </div>
                    <div class="form-group">
                     <select name="mois" class="form-control choz">
                        <option value="">Sélectionner un mois</option>  
                            <option value="1">Janvier</option>
                            <option value="2">Février</option>
                            <option value="3">Mars</option>
                            <option value="4">Avril</option>
                            <option value="5">Mai</option>
                            <option value="6">Juin</option>
                            <option value="7">Juillet</option>
                            <option value="8">Août</option>
                            <option value="9">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                           <option value="12">Décembre</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-default" id="btn_periode2">Valider</button>
                </form> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="t1 t2 table table-bordered table-condensed table-hover table-striped" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th data-hide="phone,tablet">Noms</th>
                            <th data-hide="phone,tablet">Présence</th>
                            <th data-hide="phone,tablet">Absence</th>
                            <th data-hide="phone,tablet">Malade</th>
                            <th data-hide="phone,tablet">Congé</th>
                        </tr>
                    </thead>
                    <tbody id="viewdata">
                        <?php include(APP_FOLDER.'/views/admin/respointage/data2.php'); ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->