
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_facture
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_facture&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_facture&id_fact=<?php echo $rows->id_fact;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_facture&id_fact=<?php echo $rows->id_fact;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_facture&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Facture</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_fact" value="<?php echo $rows->id_fact;?>">
	<div class="form-group">
    <label class="control-label" for="num_fact">Num Fact</label>
	<input id="num_fact" name="num_fact" type="text" maxlength="20"  value="<?php echo $rows->num_fact;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="20"  value="<?php echo $rows->type;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="i_souscription">I Souscription</label>
	<input id="i_souscription" name="i_souscription" type="text" maxlength="11"  value="<?php echo $rows->i_souscription;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="etat">Etat</label>
	<input id="etat" name="etat" type="text" maxlength="20"  value="<?php echo $rows->etat;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="etat_cmd">Etat Cmd</label>
	<input id="etat_cmd" name="etat_cmd" type="text" maxlength="1"  value="<?php echo $rows->etat_cmd;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_echeance_old">Date Echeance Old</label>
	<input name="date_echeance_old" class="datepicker form-control styler" type="text" maxlength="1" value="<?php echo $rows->date_echeance_old;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_edition">Date Edition</label>
	<input name="date_edition" class="datepicker form-control styler" type="text" maxlength="1" value="<?php echo $rows->date_edition;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte_blocage">Dte Blocage</label>
	<input name="dte_blocage" class="datepicker form-control styler" type="text" maxlength="1" value="<?php echo $rows->dte_blocage;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_echeance">Date Echeance</label>
	<input name="date_echeance" class="datepicker form-control styler" type="text" maxlength="1" value="<?php echo $rows->date_echeance;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_desactivation">Date Desactivation</label>
	<input name="date_desactivation" class="datepicker form-control styler" type="text" maxlength="1" value="<?php echo $rows->date_desactivation;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="montant_total">Montant Total</label>
	<input id="montant_total" name="montant_total" type="text" maxlength="1"  value="<?php echo $rows->montant_total;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mont_tva">Mont Tva</label>
	<input id="mont_tva" name="mont_tva" type="text" maxlength="1"  value="<?php echo $rows->mont_tva;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mont_ttc">Mont Ttc</label>
	<input id="mont_ttc" name="mont_ttc" type="text" maxlength="1"  value="<?php echo $rows->mont_ttc;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mont_ttc_remise">Mont Ttc Remise</label>
	<input id="mont_ttc_remise" name="mont_ttc_remise" type="text" maxlength="1"  value="<?php echo $rows->mont_ttc_remise;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="taux">Taux</label>
	<input id="taux" name="taux" type="text" maxlength="1"  value="<?php echo $rows->taux;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="taux_prix">Taux Prix</label>
	<input id="taux_prix" name="taux_prix" type="text" maxlength="1"  value="<?php echo $rows->taux_prix;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="tva">Tva</label>
	<input id="tva" name="tva" type="text" maxlength="1"  value="<?php echo $rows->tva;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="monnaie">Monnaie</label>
	<input id="monnaie" name="monnaie" type="text" maxlength="20"  value="<?php echo $rows->monnaie;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="remise">Remise</label>
	<input id="remise" name="remise" type="text" maxlength="20"  value="<?php echo $rows->remise;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="majoration">Majoration</label>
	<input id="majoration" name="majoration" type="text" maxlength="20"  value="<?php echo $rows->majoration;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="justification">Justification</label>
	<textarea rows="5" id="justification" name="justification" class="form-control editor2 styler" /><?php echo $rows->justification;?></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="id_res">Id Res</label>
	<input id="id_res" name="id_res" type="text" maxlength="11"  value="<?php echo $rows->id_res;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="res_ch_id">Res Ch Id</label>
	<input id="res_ch_id" name="res_ch_id" type="text" maxlength="11"  value="<?php echo $rows->res_ch_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="modulecompagny">Modulecompagny</label>
	<input id="modulecompagny" name="modulecompagny" type="text" maxlength="11"  value="<?php echo $rows->modulecompagny;?>" class="form-control styler" />
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
    <label class="control-label" for="id_user">Id User</label>
	<input id="id_user" name="id_user" type="text" maxlength="11"  value="<?php echo $rows->id_user;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_client">Id Client</label>
	<input id="id_client" name="id_client" type="text" maxlength="11"  value="<?php echo $rows->id_client;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="fact1">Fact1</label>
	<input id="fact1" name="fact1" type="text" maxlength="11"  value="<?php echo $rows->fact1;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 