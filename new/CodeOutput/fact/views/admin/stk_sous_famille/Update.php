<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		stk_produit
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
	die('You are not allowed to execute this file directly');
$tva = 0;
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=stk_sous_famille&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
		<ul class="nav pull-right" style="margin-top:5px;">
			<label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
			<input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

			<a href="<?php echo H_ADMIN; ?>&view=stk_sous_famille&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
		</ul>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-reorder"></i> Modifier catégorie</h3>
			</div>
			<div class="panel-body">
				<div class="output"></div>
				<input id="p" name="p" value="<?php echo get('p'); ?>" type="hidden">
				<div class="form-horizontal form-label-left">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-6" for="designation">Désignation<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="hidden" name="id_s_fam" value="<?php echo $rows->id_s_fam; ?>">

									<input id="designation" name="designation" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $rows->des; ?>">
								</div>
							</div>


						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">

							<input id="hotel_id" name="hotel_id" type="hidden" maxlength="11" value="<?php echo $_SESSION['idsite']; ?>" />

						</div>
					</div>

				</div>
			</div>
			<div class="panel-footer" style="border-bottom:solid 2px #CCC;">
				<label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
				<input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
			</div>



		</div>
		<!--/col-12-->

</form>