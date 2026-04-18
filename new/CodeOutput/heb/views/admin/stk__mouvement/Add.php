
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Add.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk__mouvement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=stk__mouvement&do=addpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=stk__mouvement&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_CREATE_NEW;?> Stk  Mouvement</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<div class="form-group">
    <label class="control-label" for="indice_bs">Indice Bs</label>
	<input id="indice_bs" name="indice_bs" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="50"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="motif">Motif</label>
	<input id="motif" name="motif" type="text" maxlength="30"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="num_bon">Num Bon</label>
	<input id="num_bon" name="num_bon" type="text" maxlength="50"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="qte_entree">Qte Entree</label>
	<input id="qte_entree" name="qte_entree" type="text" maxlength="50"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="qte_sortie">Qte Sortie</label>
	<input id="qte_sortie" name="qte_sortie" type="text" maxlength="50"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte_appro">Dte Appro</label>
	<input name="dte_appro" class="datepicker form-control styler" type="text" maxlength="50" value="<?php echo date('Y-m-d');?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte_appro_heure">Dte Appro Heure</label>
	<input name="dte_appro_heure" class="datepicker form-control styler" type="text" maxlength="50" value="<?php echo date('Y-m-d');?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="depot">Depot</label>
	<input id="depot" name="depot" type="text" maxlength="245"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="produit_id">Produit Id</label>
	<input id="produit_id" name="produit_id" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="user_id">User Id</label>
	<input id="user_id" name="user_id" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="hotel_id">Hotel Id</label>
	<input id="hotel_id" name="hotel_id" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 