
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglage
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_reglage&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_reglage&id_regl=<?php echo $rows->id_regl;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reglage&id_regl=<?php echo $rows->id_regl;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reglage&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Reglage</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_regl" value="<?php echo $rows->id_regl;?>">
	<div class="form-group">
    <label class="control-label" for="remise">Remise</label>
	<input id="remise" name="remise" type="text" maxlength="11"  value="<?php echo $rows->remise;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="majoration">Majoration</label>
	<input id="majoration" name="majoration" type="text" maxlength="11"  value="<?php echo $rows->majoration;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_regl">Date Regl</label>
	<input name="date_regl" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->date_regl;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte_h">Dte H</label>
	<input name="dte_h" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->dte_h;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="temps_regl">Temps Regl</label>
	<input id="temps_regl" name="temps_regl" type="text" maxlength="11"  value="<?php echo $rows->temps_regl;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="time_checkin">Time Checkin</label>
	<input id="time_checkin" name="time_checkin" type="text" maxlength="11"  value="<?php echo $rows->time_checkin;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="m_insert">M Insert</label>
	<input id="m_insert" name="m_insert" type="text" maxlength="10"  value="<?php echo $rows->m_insert;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="m_affiche">M Affiche</label>
	<input id="m_affiche" name="m_affiche" type="text" maxlength="10"  value="<?php echo $rows->m_affiche;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="tauxdollar">Tauxdollar</label>
	<input id="tauxdollar" name="tauxdollar" type="text" maxlength="10"  value="<?php echo $rows->tauxdollar;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="taux_op">Taux Op</label>
	<input id="taux_op" name="taux_op" type="text" maxlength="10"  value="<?php echo $rows->taux_op;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="tva">Tva</label>
	<input id="tva" name="tva" type="text" maxlength="10"  value="<?php echo $rows->tva;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pourcentage_defaut">Pourcentage Defaut</label>
	<input id="pourcentage_defaut" name="pourcentage_defaut" type="text" maxlength="10"  value="<?php echo $rows->pourcentage_defaut;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pourcentage_24_heure">Pourcentage 24 Heure</label>
	<input id="pourcentage_24_heure" name="pourcentage_24_heure" type="text" maxlength="10"  value="<?php echo $rows->pourcentage_24_heure;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pourcentage_48_heure">Pourcentage 48 Heure</label>
	<input id="pourcentage_48_heure" name="pourcentage_48_heure" type="text" maxlength="10"  value="<?php echo $rows->pourcentage_48_heure;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pourcentage_72_heure">Pourcentage 72 Heure</label>
	<input id="pourcentage_72_heure" name="pourcentage_72_heure" type="text" maxlength="10"  value="<?php echo $rows->pourcentage_72_heure;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pourcentage_sup_72_heure">Pourcentage Sup 72 Heure</label>
	<input id="pourcentage_sup_72_heure" name="pourcentage_sup_72_heure" type="text" maxlength="10"  value="<?php echo $rows->pourcentage_sup_72_heure;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type_annul">Type Annul</label>
	<input id="type_annul" name="type_annul" type="text" maxlength="20"  value="<?php echo $rows->type_annul;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="fcon_heberge">Fcon Heberge</label>
	<input id="fcon_heberge" name="fcon_heberge" type="text" maxlength="11"  value="<?php echo $rows->fcon_heberge;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="user_id">User Id</label>
	<input id="user_id" name="user_id" type="text" maxlength="10"  value="<?php echo $rows->user_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_hotel">Id Hotel</label>
	<input id="id_hotel" name="id_hotel" type="text" maxlength="11"  value="<?php echo $rows->id_hotel;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="company_id">Company Id</label>
	<input id="company_id" name="company_id" type="text" maxlength="11"  value="<?php echo $rows->company_id;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 