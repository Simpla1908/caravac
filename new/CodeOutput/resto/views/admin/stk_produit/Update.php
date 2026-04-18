
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_produit
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=stk_produit&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=stk_produit&idprod=<?php echo $rows->idprod;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=stk_produit&idprod=<?php echo $rows->idprod;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=stk_produit&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> Stk Produit</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="idprod" value="<?php echo $rows->idprod;?>">
	<div class="form-group">
    <label class="control-label" for="code">Code</label>
	<input id="code" name="code" type="text" maxlength="50"  value="<?php echo $rows->code;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="designation">Designation</label>
	<input id="designation" name="designation" type="text" maxlength="50"  value="<?php echo $rows->designation;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="qte_min">Qte Min</label>
	<input id="qte_min" name="qte_min" type="text" maxlength="50"  value="<?php echo $rows->qte_min;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="qte_initial">Qte Initial</label>
	<input id="qte_initial" name="qte_initial" type="text" maxlength="50"  value="<?php echo $rows->qte_initial;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="qte_dispo">Qte Dispo</label>
	<input id="qte_dispo" name="qte_dispo" type="text" maxlength="50"  value="<?php echo $rows->qte_dispo;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pa">Pa</label>
	<input id="pa" name="pa" type="text" maxlength="50"  value="<?php echo $rows->pa;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pv">Pv</label>
	<input id="pv" name="pv" type="text" maxlength="50"  value="<?php echo $rows->pv;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="monnaie">Monnaie</label>
	<input id="monnaie" name="monnaie" type="text" maxlength="20"  value="<?php echo $rows->monnaie;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="repas">Repas</label>
	<input id="repas" name="repas" type="text" maxlength="11"  value="<?php echo $rows->repas;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="statut">Statut</label>
	<input id="statut" name="statut" type="text" maxlength="11"  value="<?php echo $rows->statut;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pseudo_supp">Pseudo Supp</label>
	<input id="pseudo_supp" name="pseudo_supp" type="text" maxlength="10"  value="<?php echo $rows->pseudo_supp;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="unite">Unite</label>
	<input id="unite" name="unite" type="text" maxlength="10"  value="<?php echo $rows->unite;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="famille_id">Famille Id</label>
	<input id="famille_id" name="famille_id" type="text" maxlength="11"  value="<?php echo $rows->famille_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="hotel_id">Hotel Id</label>
	<input id="hotel_id" name="hotel_id" type="text" maxlength="11"  value="<?php echo $rows->hotel_id;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 