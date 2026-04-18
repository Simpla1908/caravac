
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
                <h3 class="box-title">Déclaration Fiscale</h3>
                <ul class="nav pull-right">
                    <!--<a href="<?php echo H_ADMIN; ?>&view=respointage&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>-->
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default tip btn_prnt_declaration" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
<!--                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=respointage&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
             <div class="box-header with-border">
             <div class="output"></div>
               <form action="<?php echo H_ADMIN_MAIN.'&view=resdeclaration&do=verifdates';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data" class="form-inline">

                <input name="id" id="id" type="hidden" value=""> 
                <input name="code" id="code" type="hidden" value=""> 
                 <input name="lib" id="lib" type="hidden" value=""> 
                  <input name="pourtrav" id="pourtrav" type="hidden" value=""> 
                   <input name="poursoc" id="poursoc" type="hidden" value=""> 
                     <div class="form-group">
                         <select class="form-control choz sltdesdecl " name="sltdesdecl">
                    <option value="">Sélectionner désignation</option>
                          <?php
                           foreach ($result as $rows) {  
                              ?>
                     <option value="<?php echo $rows->id;?>" code="<?php echo $rows->code;?>" lib="<?php echo $rows->lib;?>" pourtrav="<?php echo $rows->pourtrav;?>" poursoc="<?php echo $rows->poursoc;?>"><?php echo $rows->lib;?></option>
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
                    <button type="submit" class="btn btn-default" id="btndeclaration"><i class="fa fa-check-circle"></i> Valider</button>
                    </form> 

 </div>



            <!-- /.box-header -->
            <div class="box-body" id="datasdeclaration">
               
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->