<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	23-10-2017
 * FOR TABLE:  		resconge
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>

 <form action="<?php echo H_ADMIN_MAIN.'&view=fondscaisse&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i>  Fonds de caisse</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                        		<input type="hidden" name="id" value="<?php echo $rows->id;?>">
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">FOND USD</label>

                                <div class="col-sm-9">
                                    <input id="montantusd" name="montantusd" type="text" maxlength="245"  value="<?php echo arrondir($rows->usd);?>" class="form-control" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">FOND CDF</label>

                                <div class="col-sm-9">
                                    <input id="montantcdf" name="montantcdf" type="text" maxlength="245"  value="<?php echo arrondir($rows->cdf);?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                      </div>

            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden updatefdc" value="<?php echo LANG_UPDATE_RECORD;?>" />
            </div>
        </div><!--/col-12-->
</form>
