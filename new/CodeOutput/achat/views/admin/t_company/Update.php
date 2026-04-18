
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_company
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_company&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_company&id_c=<?php echo $rows->id_c;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_company&id_c=<?php echo $rows->id_c;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_company&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Company</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_c" value="<?php echo $rows->id_c;?>">
	<div class="form-group">
    <label class="control-label" for="nom_c">Nom C</label>
	<input id="nom_c" name="nom_c" type="text" maxlength="245"  value="<?php echo $rows->nom_c;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="etat">Etat</label>
	<input id="etat" name="etat" type="text" maxlength="11"  value="<?php echo $rows->etat;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="adresse_c">Adresse C</label>
	<input id="adresse_c" name="adresse_c" type="text" maxlength="245"  value="<?php echo $rows->adresse_c;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="logo">Logo</label>
	<input id="logo" name="logo" type="text" maxlength="100"  value="<?php echo $rows->logo;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="idnat">Idnat</label>
	<input id="idnat" name="idnat" type="text" maxlength="245"  value="<?php echo $rows->idnat;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="rccm">Rccm</label>
	<input id="rccm" name="rccm" type="text" maxlength="245"  value="<?php echo $rows->rccm;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mail_company">Mail Company</label>
	<input id="mail_company" name="mail_company" type="text" maxlength="50"  value="<?php echo $rows->mail_company;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="ville">Ville</label>
	<input id="ville" name="ville" type="text" maxlength="20"  value="<?php echo $rows->ville;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="phone">Phone</label>
	<input id="phone" name="phone" type="text" maxlength="20"  value="<?php echo $rows->phone;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="num_impot">Num Impot</label>
	<input id="num_impot" name="num_impot" type="text" maxlength="20"  value="<?php echo $rows->num_impot;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="cb">Cb</label>
	<input id="cb" name="cb" type="text" maxlength="22"  value="<?php echo $rows->cb;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mention">Mention</label>
	<textarea rows="5" id="mention" name="mention" class="form-control editor2 styler" /><?php echo $rows->mention;?></textarea>
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 