
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Add.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_client
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_client&do=addpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_client&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_CREATE_NEW;?> T Client</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<div class="form-group">
    <label class="control-label" for="code">Code</label>
	<input id="code" name="code" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="designation">Designation</label>
	<input id="designation" name="designation" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="nom_client">Nom Client</label>
	<input id="nom_client" name="nom_client" type="text" maxlength="50"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_naiss_client">Date Naiss Client</label>
	<input name="date_naiss_client" class="datepicker form-control styler" type="text" maxlength="50" value="<?php echo date('Y-m-d');?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="sexe_client">Sexe Client</label>
	<input id="sexe_client" name="sexe_client" type="text" maxlength="15"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="etat_civil_client">Etat Civil Client</label>
	<input id="etat_civil_client" name="etat_civil_client" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="nationalite_client">Nationalite Client</label>
	<input id="nationalite_client" name="nationalite_client" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="provenance_client">Provenance Client</label>
	<input id="provenance_client" name="provenance_client" type="text" maxlength="25"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="num_piece_identite_client">Num Piece Identite Client</label>
	<input id="num_piece_identite_client" name="num_piece_identite_client" type="text" maxlength="200"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="num_passeport_client">Num Passeport Client</label>
	<input id="num_passeport_client" name="num_passeport_client" type="text" maxlength="30"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="adresse_provenance_client">Adresse Provenance Client</label>
	<input id="adresse_provenance_client" name="adresse_provenance_client" type="text" maxlength="50"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="email_client">Email Client</label>
	<input id="email_client" name="email_client" type="text" maxlength="30"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="telephone_client">Telephone Client</label>
	<input id="telephone_client" name="telephone_client" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="num_pers_contacter_client">Num Pers Contacter Client</label>
	<input id="num_pers_contacter_client" name="num_pers_contacter_client" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="statut">Statut</label>
	<input id="statut" name="statut" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pseudo_supp">Pseudo Supp</label>
	<input id="pseudo_supp" name="pseudo_supp" type="text" maxlength="10"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type_cl">Type Cl</label>
	<input id="type_cl" name="type_cl" type="text" maxlength="100"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_respo">Id Respo</label>
	<input id="id_respo" name="id_respo" type="text" maxlength="10"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_hotel">Id Hotel</label>
	<input id="id_hotel" name="id_hotel" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 