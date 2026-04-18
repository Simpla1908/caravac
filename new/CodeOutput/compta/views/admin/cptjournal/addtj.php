
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Add.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>	 
   <form action="<?php echo H_ADMIN_MAIN.'&view=cptjournal&do=addtjpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=cptjournal&do=viewalltj" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i>   Ajout Type Journal</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  <div class="form-horizontal">
		  <div class="row">
	  <div class="col-md-10">
                            <br>
                            
		  <div class="form-group">
			  <label class="col-sm-3 control-label" for="lib">Code</label>
			  <div class="col-sm-9">
				  <input id="code" name="code" type="text" maxlength="245"  value="" class="form-control" />

			  </div>
		  </div>
		 
		 <div class="form-group">
			  <label class="col-sm-3 control-label" for="lib">Libellé</label>
			  <div class="col-sm-9">
				  <input id="libelle" name="libelle" type="text" maxlength="245"  value="" class="form-control" />

			  </div>
		  </div>
		 
		  <div class="form-group hidden">
			  <input id="psedo" name="psedo" type="text" maxlength="11"  value="0" class="form-control styler" />
			  <input id="site_id" name="site_id" type="text" maxlength="11"  value="<?php echo $_SESSION['idsite']; ?>" class="form-control styler" />
		  </div>
                        </div>
                    </div>
                </div>
            </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>