
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_utilisateur
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_utilisateur&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_utilisateur&id_user=<?php echo $rows->id_user;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_utilisateur&id_user=<?php echo $rows->id_user;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_utilisateur&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Utilisateur</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_user" value="<?php echo $rows->id_user;?>">
	<div class="form-group">
    <label class="control-label" for="nom_user">Nom User</label>
	<input id="nom_user" name="nom_user" type="text" maxlength="100"  value="<?php echo $rows->nom_user;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="prenom_user">Prenom User</label>
	<input id="prenom_user" name="prenom_user" type="text" maxlength="20"  value="<?php echo $rows->prenom_user;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="sexe_user">Sexe User</label>
	<input id="sexe_user" name="sexe_user" type="text" maxlength="10"  value="<?php echo $rows->sexe_user;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="telephone_user">Telephone User</label>
	<input id="telephone_user" name="telephone_user" type="text" maxlength="18"  value="<?php echo $rows->telephone_user;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="email_user">Email User</label>
	<textarea rows="5" id="email_user" name="email_user" class="form-control editor2 styler" /><?php echo $rows->email_user;?></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="mdp_user">Mdp User</label>
	<textarea rows="5" id="mdp_user" name="mdp_user" class="form-control editor2 styler" /><?php echo $rows->mdp_user;?></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="adresse_mail">Adresse Mail</label>
	<input id="adresse_mail" name="adresse_mail" type="text" maxlength="245"  value="<?php echo $rows->adresse_mail;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="11"  value="<?php echo $rows->type;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="actif">Actif</label>
	<input id="actif" name="actif" type="text" maxlength="11"  value="<?php echo $rows->actif;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_hotel">Id Hotel</label>
	<input id="id_hotel" name="id_hotel" type="text" maxlength="10"  value="<?php echo $rows->id_hotel;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="company_id">Company Id</label>
	<input id="company_id" name="company_id" type="text" maxlength="11"  value="<?php echo $rows->company_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_droit">Id Droit</label>
	<input id="id_droit" name="id_droit" type="text" maxlength="10"  value="<?php echo $rows->id_droit;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="fconnect">Fconnect</label>
	<input id="fconnect" name="fconnect" type="text" maxlength="11"  value="<?php echo $rows->fconnect;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="connect">Connect</label>
	<input id="connect" name="connect" type="text" maxlength="11"  value="<?php echo $rows->connect;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 