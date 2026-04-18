
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		categorie_chambre
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=categorie_chambre&do=addpro_image'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=categorie_chambre&do=viewall_images" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Image Slider</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Upload Image</label>
                                <div class="col-sm-9">
                                    <div class="input-group col-md-12 col-sm-11 col-xs-12">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary btn-file">
                                                Parcourir <input type="file" id="imgInp" name="image">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" id="fichier" readonly2>

                                    </div>
                                    <br>
                                    <img id='img-upload' width="100" height="100" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="num_ch" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea id="description" name="description" class="form-control" type="text"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="visible" class="col-sm-3 control-label">Visible</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="visible" value="1" checked="checked">
                                    <input id="hotel_id" name="hotel_id" class="form-control" type="hidden" value="<?php echo $_SESSION['idsite']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
<!--                <button type="submit" class="btn btn-danger" id="save_categorie" name="save_categorie">
                    <i class=" fa fa-save"></i> Enrégistrer
                </button>-->
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>

        </div><!--/col-12-->

</form>
