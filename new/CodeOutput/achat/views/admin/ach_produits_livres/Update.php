
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_produits_livres
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=ach_produits_livres&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=ach_produits_livres&id_produit_liv=<?php echo $rows->id_produit_liv;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=ach_produits_livres&id_produit_liv=<?php echo $rows->id_produit_liv;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=ach_produits_livres&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> Ach Produits Livres</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_produit_liv" value="<?php echo $rows->id_produit_liv;?>">
	<div class="form-group">
    <label class="control-label" for="quantite_cmd">Quantite Cmd</label>
	<input id="quantite_cmd" name="quantite_cmd" type="text" maxlength="20"  value="<?php echo $rows->quantite_cmd;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="quantite_liv">Quantite Liv</label>
	<input id="quantite_liv" name="quantite_liv" type="text" maxlength="20"  value="<?php echo $rows->quantite_liv;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="observation">Observation</label>
	<textarea rows="5" id="observation" name="observation" class="form-control editor2 styler" /><?php echo $rows->observation;?></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="produit_id">Produit Id</label>
	<input id="produit_id" name="produit_id" type="text" maxlength="11"  value="<?php echo $rows->produit_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="livraison_id">Livraison Id</label>
	<input id="livraison_id" name="livraison_id" type="text" maxlength="11"  value="<?php echo $rows->livraison_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="user_id">User Id</label>
	<input id="user_id" name="user_id" type="text" maxlength="11"  value="<?php echo $rows->user_id;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 