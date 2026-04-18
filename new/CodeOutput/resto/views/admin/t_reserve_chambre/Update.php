
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reserve_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_reserve_chambre&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_reserve_chambre&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reserve_chambre&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reserve_chambre&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Reserve Chambre</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="idreserv">Idreserv</label>
	<input id="idreserv" name="idreserv" type="text" maxlength="11"  value="<?php echo $rows->idreserv;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="idchambre">Idchambre</label>
	<input id="idchambre" name="idchambre" type="text" maxlength="11"  value="<?php echo $rows->idchambre;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_client">Id Client</label>
	<input id="id_client" name="id_client" type="text" maxlength="11"  value="<?php echo $rows->id_client;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_accomp">Id Accomp</label>
	<input id="id_accomp" name="id_accomp" type="text" maxlength="10"  value="<?php echo $rows->id_accomp;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="statut">Statut</label>
	<input id="statut" name="statut" type="text" maxlength="10"  value="<?php echo $rows->statut;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="occupe">Occupe</label>
	<input id="occupe" name="occupe" type="text" maxlength="20"  value="<?php echo $rows->occupe;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_occ">Date Occ</label>
	<input name="date_occ" class="datepicker form-control styler" type="text" maxlength="20" value="<?php echo $rows->date_occ;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_lib">Date Lib</label>
	<input name="date_lib" class="datepicker form-control styler" type="text" maxlength="20" value="<?php echo $rows->date_lib;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="annule">Annule</label>
	<input id="annule" name="annule" type="text" maxlength="10"  value="<?php echo $rows->annule;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="est_responsable">Est Responsable</label>
	<input id="est_responsable" name="est_responsable" type="text" maxlength="3"  value="<?php echo $rows->est_responsable;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mont_paye_heb">Mont Paye Heb</label>
	<input id="mont_paye_heb" name="mont_paye_heb" type="text" maxlength="3"  value="<?php echo $rows->mont_paye_heb;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mont_paye_resto">Mont Paye Resto</label>
	<input id="mont_paye_resto" name="mont_paye_resto" type="text" maxlength="3"  value="<?php echo $rows->mont_paye_resto;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="monnaie">Monnaie</label>
	<input id="monnaie" name="monnaie" type="text" maxlength="20"  value="<?php echo $rows->monnaie;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="tarif_ch">Tarif Ch</label>
	<input id="tarif_ch" name="tarif_ch" type="text" maxlength="20"  value="<?php echo $rows->tarif_ch;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="nom_accomp">Nom Accomp</label>
	<input id="nom_accomp" name="nom_accomp" type="text" maxlength="100"  value="<?php echo $rows->nom_accomp;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="checkin">Checkin</label>
	<input id="checkin" name="checkin" type="text" maxlength="100"  value="<?php echo $rows->checkin;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="checkout">Checkout</label>
	<input id="checkout" name="checkout" type="text" maxlength="100"  value="<?php echo $rows->checkout;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="idfact">Idfact</label>
	<input id="idfact" name="idfact" type="text" maxlength="11"  value="<?php echo $rows->idfact;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_hotel">Id Hotel</label>
	<input id="id_hotel" name="id_hotel" type="text" maxlength="11"  value="<?php echo $rows->id_hotel;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 