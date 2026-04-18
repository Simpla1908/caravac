<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	08-02-2018
 * FOR TABLE:  		resconfig
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=paramfact&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;margin-right:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="btnconfigfactrtn hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-reorder"></i></h3>
            </div>
            <div class="panel-body">

                <div class="output"></div>

                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <input type="hidden" name="id" value="<?php echo $module_id; ?>">

                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip">Préfixe facture</label>
                                <div class="col-sm-9">
                                    <input id="prefconge" name="prefconge" type="text" value="<?php echo $rows->prefconge; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="prefsanct" class="col-sm-3 control-label tip">Préfixe reçu</label>
                                <div class="col-sm-9">
                                    <input id="prefsanct" name="prefsanct" type="text" value="<?php echo $rows->prefsanct; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="liestock" class="col-sm-3 control-label">Lier avec le Module Stock</label>

                                <div class="col-sm-9">
                                    <select id="liestock" name="liestock" class="form-control choz">
                                        <?php if ($rows->liestock == 1) { ?>
                                            <option value="1">Oui</option>
                                            <option value="0">Non</option>
                                        <?php } else { ?>
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="infofact" class="col-sm-3 control-label tip">Instructions importantes</label>
                                <div class="col-sm-9">
                                    <textarea id="editor" name="infofact" class="form-control editor2" rows="5"><?php echo $rows->infofact; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <label for="sujetmail" class="col-sm-3 control-label tip">Sujet du Mail</label>
                                <div class="col-sm-9">
                                    <input id="sujetmail" name="sujetmail" type="text" value="<?php echo $rows->sujetmail; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="msgmail" class="col-sm-3 control-label tip">Message du Mail</label>
                                <div class="col-sm-9">
                                    <textarea id="editor2" name="msgmail" class="form-control editor2" rows="5"><?php echo $rows->msgmail; ?></textarea>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="output"></div>
            </div>




        </div>
        <!--/col-12-->

</form>