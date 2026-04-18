<?php
$result1 = $resempl_obj->SelectAllComboHrCg($_SESSION['idsite']);
$result2 = $this->resconge_model->SelectAll($_SESSION['idsite']);

?>
	 <form action="<?php echo H_ADMIN_MAIN.'&view=resconge&do=executcgpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden btnaffconge" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Exécution congé</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  <div class="form-horizontal">
		  <div class="row">
	  <div class="col-md-10">
                         <br>
		  <input id="trans" name="trans" type="hidden"/>
		   <input id="type" name="type" type="hidden"/>
		   <input id="conge_lib" name="conge_lib" type="hidden"/>
		  <input id="ville" name="ville" type="hidden"/>
		  <input id="commune" name="commune" type="hidden"/>
		  <input id="noms" name="noms" type="hidden"/>
		  <input id="adresse" name="adresse" type="hidden"/>
		  <input id="sexe" name="sexe" type="hidden"/>
		  <input id="nbrjancien" name="nbrjancien" type="hidden"/>
		  <input id="rue" name="rue" type="hidden"/>
		  <input id="quartier" name="quartier" type="hidden"/>
		  <div class="form-group">
			  <label class="col-sm-3 control-label" for="libelle">Employé</label>
			  <div class="col-sm-9">
              <select class="form-control  slctdatasemployecg choz" name="employe_id" id="employe_id">
                <option value="0"></option>
                <?php
                foreach ($result1 as $rows) {
                  ?>
                 <option value="<?php echo $rows->id; ?>" noms="<?php echo $rows->noms; ?>" sexe="<?php echo $rows->sexe; ?>" adresse="<?php echo $rows->Adresse; ?>" rue="<?php echo $rows->rue; ?>" quartier="<?php echo $rows->quartier; ?>" commune="<?php echo $rows->commune; ?>"  ville="<?php echo $rows->ville; ?>" nbrjancien="<?php echo AncienneteEmploye($rows->dteng); ?>"><?php echo ucfirst($rows->noms); ?></option>

                <?php } ?>
              </select>
			  </div>
		  </div>
          <div class="form-group">
			  <label class="col-sm-3 control-label" for="libelle">Congé</label>
			  <div class="col-sm-5">
              <select class="form-control  choz chx_conge" name="conge_id" id="conge_id">
                <option value="0"></option>
                 <?php
                $_SESSION['CG'] = array();
			    $_SESSION['CG']['cont'] = array();
	            foreach ($result2 as $rows) {
	            	 $_SESSION['CG']['cont'][$rows->id]=$rows->contenu;
	              ?>
	            <option value="<?php echo $rows->id; ?>" nbrj="<?php echo $rows->nbrjr; ?>" trans="<?php echo $rows->transport; ?>" type="<?php echo $rows->type; ?>" lib="<?php echo $rows->libelle; ?>"> <?php echo ucfirst($rows->libelle); ?></option>
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
		    <div class="form-group pfrm" style="display:none">
			  <label class="col-sm-3 control-label" for="libelle">Nombre de jours</label>
			  <div class="col-sm-9">
				  <input id="nombjrs" name="nombjrs" type="text" maxlength="11"  value="" class="form-control styler" />

			  </div>
		    </div>
		   <div class="form-group">
			  <label class="col-sm-3 control-label" for="libelle">Période</label>
			  <div class="col-sm-9 radiobutton">
			   <div class="row">
			   
				  <div class="col-sm-1">
					  DU
					   </div>
					  <div class="col-sm-3">
					   <input type="text" name="dte1" class="form-control datepicker2" id="dte1" value="">		
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
               	 <div class="output"></div>

            </div>
           <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden btnaffconge" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 </div>
        </div><!--/col-12-->
</form>
