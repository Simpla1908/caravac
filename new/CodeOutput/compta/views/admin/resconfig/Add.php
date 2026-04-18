
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Add.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		resconfig
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=resconfig&do=addpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=resconfig&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_CREATE_NEW;?> Resconfig</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<div class="form-group">
    <label class="control-label" for="nomcomp">Nomcomp</label>
	<input id="nomcomp" name="nomcomp" type="text" maxlength="500"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="adrcomp">Adrcomp</label>
	<input id="adrcomp" name="adrcomp" type="text" maxlength="500"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="m_insert">M Insert</label>
	<input id="m_insert" name="m_insert" type="text" maxlength="10"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="m_affich">M Affich</label>
	<input id="m_affich" name="m_affich" type="text" maxlength="10"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="taux">Taux</label>
	<input id="taux" name="taux" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="age">Age</label>
	<input id="age" name="age" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="penalite">Penalite</label>
	<input id="penalite" name="penalite" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="hopital">Hopital</label>
	<textarea rows="5" id="hopital" name="hopital" class="form-control editor2 styler" /></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="fuseauhoraire">Fuseauhoraire</label>
	<input id="fuseauhoraire" name="fuseauhoraire" type="text" maxlength="100"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="prefsanct">Prefsanct</label>
	<input id="prefsanct" name="prefsanct" type="text" maxlength="100"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="prefconge">Prefconge</label>
	<input id="prefconge" name="prefconge" type="text" maxlength="100"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="tva">Tva</label>
	<input id="tva" name="tva" type="text" maxlength="100"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="echeance">Echeance</label>
	<input id="echeance" name="echeance" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="liestock">Liestock</label>
	<input id="liestock" name="liestock" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="infofact">Infofact</label>
	<textarea rows="5" id="infofact" name="infofact" class="form-control editor2 styler" /></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="sujetmail">Sujetmail</label>
	<input id="sujetmail" name="sujetmail" type="text" maxlength="245"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="msgmail">Msgmail</label>
	<textarea rows="5" id="msgmail" name="msgmail" class="form-control editor2 styler" /></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="logo">Logo</label>
	
	<input id="logo" name="logo"type="file" class="form-control styler"/>
	
	</div>

	<div class="form-group">
    <label class="control-label" for="module_id">Module Id</label>
	<input id="module_id" name="module_id" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="site_id">Site Id</label>
	<input id="site_id" name="site_id" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="checkin">Checkin</label>
	<input id="checkin" name="checkin" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="checkout">Checkout</label>
	<input id="checkout" name="checkout" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 