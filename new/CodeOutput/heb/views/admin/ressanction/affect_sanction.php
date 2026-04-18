
<?php
	/*
	* =======================================================================
	* FILE NAME:        Add.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		ressanction
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=ressanction&do=affect_sanction_pro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden btnaffsanction" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=ressanction&do=listsanctemply" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Sanction</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  <div class="form-horizontal">
		  <div class="row">
	  <div class="col-md-10">
          <br>  
          <input id="ret" name="ret" type="hidden"/>
		  <input id="nbrj" name="nbrj" type="hidden"/>
		   <input id="sanction_lib" name="sanction_lib" type="hidden"/>
		  <input id="ville" name="ville" type="hidden"/>
		  <input id="commune" name="commune" type="hidden"/>
		  <input id="noms" name="noms" type="hidden"/>
		  <input id="adresse" name="adresse" type="hidden"/>
		  <input id="sexe" name="sexe" type="hidden"/>
		  <input id="quartier" name="quartier" type="hidden"/>
		  <input id="rue" name="rue" type="hidden"/>
		  <div class="form-group">
			  <label class="col-sm-3 control-label" for="libelle">Employé</label>
			  <div class="col-sm-9">
              <select class="form-control  choz slctdatasemploye" name="employe_id" id="employe_id">
                <option value="0"></option>
                <?php
                foreach ($result1 as $rows) {
                  ?>
                  <option value="<?php echo $rows->id; ?>" noms="<?php echo $rows->noms; ?>" sexe="<?php echo $rows->sexe; ?>" adresse="<?php echo $rows->Adresse; ?>" rue="<?php echo $rows->rue; ?>" quartier="<?php echo $rows->quartier; ?>" commune="<?php echo $rows->commune; ?>"  ville="<?php echo $rows->ville; ?>"><?php echo ucfirst($rows->noms); ?></option>
                <?php } ?>
              </select>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-sm-3 control-label" for="libelle">Sanction</label>
			  <div class="col-sm-5">
			  <select class="form-control  choz chx_sanction" name="sanction_id" id="sanction_id">
                <option value="0"></option>
                 <?php
                 $_SESSION['SC'] = array();
			    $_SESSION['SC']['cont'] = array();
	            foreach ($result2 as $rows) {
	            $_SESSION['SC']['cont'][$rows->id]=$rows->contenu;

	              ?>
	              <option value="<?php echo $rows->id; ?>" lib="<?php echo $rows->libelle; ?>" ret="<?php echo $rows->retenue; ?>" nbrj="<?php echo $rows->nbrjr; ?>"><?php echo ucfirst($rows->libelle); ?></option>
	            <?php } ?>
              </select>
			  </div>
			    <div class="col-sm-2">
             	  <input type="radio" name="chxcg" id="chxcg1" value="0" class="minimal rdchxcg" checked>
                  Par défaut
			  </div>
			    <div class="col-sm-2">
			      <input type="radio" name="chxcg" id="chxcg2" value="1" class="minimal rdchxcg">
                  Personnalisé
			  </div>
		  </div>
		   <div class="form-group nbrjsanct" style="display:none">
			  <label class="col-sm-3 control-label" for="libelle">Nombre de jours</label>
			  <div class="col-sm-9">
				  <input id="nombjrs" name="nombjrs" type="text" maxlength="11"  value="0" class="form-control styler" />

			  </div>
		    </div>
		     <div class="form-group periodsanct" style="display:none">
			  <label class="col-sm-3 control-label" for="libelle">Période</label>
			  <div class="col-sm-9 radiobutton">
			   <div class="row">
			   
				  <div class="col-sm-1">
					  DU
					   </div>
					  <div class="col-sm-3">
					   <input type="text" name="dte1" class="form-control datepicker2 dtessanction" value="">		
					   </div>
				  <div class="col-sm-1">
					 AU
				  </div>
				   <div class="col-sm-3">
				   		<div class="outputdte2"></div>
                        <input type="hidden" name="dte2" class="form-control " id="dte2" value="">
				  </div>
				   <div class="col-sm-1">
					   </div>
					</div>
			  </div>
		  </div>
		  <div class="form-group hidden">
			  <label class="col-sm-3 control-label" for="libelle">Document</label>
			  <div class="col-sm-9 radiobutton">
				  <div class="radio">
					  <label>
						  <input type="radio" name="doc" id="docno" value="0" class="minimal showtext" checked>
						  Non
					  </label>
				  </div>
				  <div class="radio">
					  <label>
						  <input type="radio" name="doc" id="docyes" value="1" class="minimal showtext" >
						  Oui
					  </label>
				  </div>

			  </div>
		  </div>
		 
		  <div class="form-group texte pfrm" style="display:none">
		   <label class="col-sm-3 control-label" for="libelle">Contenu</label>
			  <div class="col-sm-9">
			  <textarea name="editor1" id="editor1">

			  </textarea>
			  </div>
		  </div>
                        </div>
                    </div>
                </div>
            </div>
      <div class="output"></div>

	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden btnaffsanction" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
