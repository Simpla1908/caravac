
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	30-10-2017
 * FOR TABLE:  		resaffectation
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=resaffectation&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=resaffectation&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_CREATE_NEW; ?> Resaffectation</h3></div>
            <div class="panel-body">
                <div class="panel-body">

                <div class="output"></div>

                <div class="form-group">
                    <label class="control-label" for="employe_id">Employe Id</label>
                    <input id="employe_id" name="employe_id" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="horaire_id">Horaire Id</label>
                    <input id="horaire_id" name="horaire_id" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="affectation_id">Affectation Id</label>
                    <input id="affectation_id" name="affectation_id" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="default">Default</label>
                    <input id="default" name="default" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="nbrjrs">Nbrjrs</label>
                    <input id="nbrjrs" name="nbrjrs" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="nbrjrsmaj">Nbrjrsmaj</label>
                    <input id="nbrjrsmaj" name="nbrjrsmaj" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="seq">Seq</label>
                    <input id="seq" name="seq" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="seqjrsmaj">Seqjrsmaj</label>
                    <input id="seqjrsmaj" name="seqjrsmaj" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="output"></div>
            </div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>
        </div><!--/col-12-->

</form>
