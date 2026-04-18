
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_lignesfact_pack
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_lignesfact_pack&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_lignesfact_pack&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_lignesfact_pack&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_lignesfact_pack&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Lignesfact Pack</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="montant">Montant</label>
	<input id="montant" name="montant" type="text" maxlength="11"  value="<?php echo $rows->montant;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mont_paye">Mont Paye</label>
	<input id="mont_paye" name="mont_paye" type="text" maxlength="11"  value="<?php echo $rows->mont_paye;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="active">Active</label>
	<input id="active" name="active" type="text" maxlength="11"  value="<?php echo $rows->active;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pack_company_id">Pack Company Id</label>
	<input id="pack_company_id" name="pack_company_id" type="text" maxlength="11"  value="<?php echo $rows->pack_company_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pack_id">Pack Id</label>
	<input id="pack_id" name="pack_id" type="text" maxlength="11"  value="<?php echo $rows->pack_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="fact_id">Fact Id</label>
	<input id="fact_id" name="fact_id" type="text" maxlength="11"  value="<?php echo $rows->fact_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="20"  value="<?php echo $rows->type;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 