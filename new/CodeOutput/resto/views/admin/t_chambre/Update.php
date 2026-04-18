
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_chambre&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_chambre&id_ch=<?php echo $rows->id_ch;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_chambre&id_ch=<?php echo $rows->id_ch;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_chambre&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Chambre</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_ch" value="<?php echo $rows->id_ch;?>">
	<div class="form-group">
    <label class="control-label" for="num_ch">Num Ch</label>
	<input id="num_ch" name="num_ch" type="text" maxlength="10"  value="<?php echo $rows->num_ch;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="etat_ch">Etat Ch</label>
	<input id="etat_ch" name="etat_ch" type="text" maxlength="15"  value="<?php echo $rows->etat_ch;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="tarif_ch">Tarif Ch</label>
	<input id="tarif_ch" name="tarif_ch" type="text" maxlength="15"  value="<?php echo $rows->tarif_ch;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="monnaie">Monnaie</label>
	<input id="monnaie" name="monnaie" type="text" maxlength="20"  value="<?php echo $rows->monnaie;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="reserve">Reserve</label>
	<input id="reserve" name="reserve" type="text" maxlength="10"  value="<?php echo $rows->reserve;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="occupe">Occupe</label>
	<input id="occupe" name="occupe" type="text" maxlength="10"  value="<?php echo $rows->occupe;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="libre">Libre</label>
	<input id="libre" name="libre" type="text" maxlength="10"  value="<?php echo $rows->libre;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="capacite_init">Capacite Init</label>
	<input id="capacite_init" name="capacite_init" type="text" maxlength="10"  value="<?php echo $rows->capacite_init;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="capacite">Capacite</label>
	<input id="capacite" name="capacite" type="text" maxlength="11"  value="<?php echo $rows->capacite;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="categorie">Categorie</label>
	<input id="categorie" name="categorie" type="text" maxlength="11"  value="<?php echo $rows->categorie;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="niveau">Niveau</label>
	<input id="niveau" name="niveau" type="text" maxlength="11"  value="<?php echo $rows->niveau;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_hotel">Id Hotel</label>
	<input id="id_hotel" name="id_hotel" type="text" maxlength="10"  value="<?php echo $rows->id_hotel;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="del">Del</label>
	<input id="del" name="del" type="text" maxlength="11"  value="<?php echo $rows->del;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 