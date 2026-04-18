
<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		categorie_chambre
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=categorie_chambre&do=updateprodetail'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            <!--<a href="<?php echo H_ADMIN; ?>&view=categorie_chambre&id_detail=<?php echo $rows->id_detail; ?>&do=deletedetail&dfile=" title="<?php echo LANG_TIP_DELETE; ?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE; ?></a>-->
            <a href="<?php echo H_ADMIN; ?>&view=categorie_chambre&do=viewall_details" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Modification détails chambre</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <input type="hidden" name="id_detail" value="<?php echo $rows->id_detail; ?>">
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="icon" class="col-sm-3 control-label">Icon</label>
                                <div class="col-sm-9">
                                    <select id="icon" name="icon" class="form-control choz">
                                        <option selected="selected" value="<?php echo $rows->icon; ?>">&#xf270; <?php echo $rows->icon; ?></option>
                                        <option value="fa-amazon">&#xf270; fa-amazon</option>
                                        <option value="fa-ambulance">&#xf0f9; fa-ambulance</option>
                                        <option value="fa-anchor">&#xf13d; fa-anchor</option>
                                        <option value="fa-android">&#xf17b; fa-android</option>
                                        <option value="fa-angellist">&#xf209; fa-angellist</option>
                                        <option value="fa-angle-double-down">&#xf103; fa-angle-double-down</option>
                                        <option value="fa-angle-double-left">&#xf100; fa-angle-double-left</option>
                                        <option value="fa-angle-double-right">&#xf101; fa-angle-double-right</option>
                                        <option value="fa-angle-double-up">&#xf102; fa-angle-double-up</option>
                                    </select>
                                    <!--<input id="icon" name="icon" class="form-control" type="text">-->
                                    <input id="hotel_id" name="hotel_id" class="form-control" type="hidden" value="<?php echo $_SESSION['idsite']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="designation" class="col-sm-3 control-label">Designation</label>
                                <div class="col-sm-9">
                                    <input id="designation" name="designation" class="form-control" type="text" value="<?php echo $rows->designation; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>
        </div><!--/col-12-->
</form>
