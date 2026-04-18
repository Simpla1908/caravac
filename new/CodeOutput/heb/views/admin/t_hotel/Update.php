
<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_hotel
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=t_hotel&do=updatepro_tc'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />

        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Termes & Conditions</h3></div>
            <div class="panel-body">

                <div class="output"></div>

                <input type="hidden" name="id_hotel" value="<?php echo $rows->id_hotel; ?>">

                <div class="form-group">
                    <label class="control-label" for="adresse_hotel">Editer</label>
                    <textarea rows="5" id="terme_condition" name="terme_condition" class="form-control editor2 " /><?php echo $rows->terme_condition; ?></textarea>
                </div>


                <div class="output"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>



        </div><!--/col-12-->

</form>
