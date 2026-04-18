
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		reshoraire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=reshoraire&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	<a href="<?php echo H_ADMIN;?>&view=reshoraire&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i>  Mise à jour horaire</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  <div class="form-horizontal">
		  <div class="row">
			  <div class="col-md-10">
				  <br>
				  <input type="hidden" name="idh" value="<?php echo $rows->idh;?>">
				  <div class="form-group">
					  <label class="col-sm-3 control-label" for="libelle">Désignation</label>
					  <div class="col-sm-9">
						  <input id="libh" name="libh" type="text" maxlength="100"  value="<?php echo $rows->libh;?>" class="form-control styler" />
					  </div>
				  </div>
			  </div>
		  </div>
	  </div>
	  <div class="row">
		  <div class="col-md-12">
			  <br>
			  <table data-page="false" class="t1 table table-bordered table-hover table-striped" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE;?>" data-page-previous-text="<?php echo LANG_PREVIOUS;?>" data-page-next-text="<?php echo LANG_NEXT;?>">
				  <thead>
				  <tr>
                      <th data-sort-ignore="true"></th>
                      <th data-sort-ignore="true"></th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">Marge pointage</th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">Heure arrivée</th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">Marge arrivée</th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">Heure départ</th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">Marge départ</th>
				  </tr>
				  </thead>
				  <tbody>
				  <?php
				  //var_dump($result);
				  foreach ($result as $rows) {
					  $v_dbt="";
					  $v_mrg="";
					  $v_fin="";
                      $v_mrgp="";
                      $v_mrgf="";
					  $checked=0;
					  if(in_array($rows->idjrs,$horjours['hj']['jours_id'])){
						  $v_dbt=$horjours['hj']['dbt'][$rows->idjrs];
						  $v_mrg=$horjours['hj']['mrg'][$rows->idjrs];
						  $v_fin=$horjours['hj']['fin'][$rows->idjrs];
                          $v_mrgp=$horjours['hj']['mrgp'][$rows->idjrs];
                          $v_mrgf=$horjours['hj']['mrgf'][$rows->idjrs];
						  $checked=1;

					  }
					  ?>
					  <tr>
						  <td><input id="jrs[]" name="jrs[]" type="checkbox"   <?php if($checked==1){?> checked="checked" <?php } ?> class="flat-red" value="<?php echo $rows->idjrs; ?>"></td>
						  <td><?php echo ucfirst($rows->libjrs); ?></td>
                          <td><div class="input-group"><input id="mrgp<?php echo $rows->idjrs; ?>" name="mrgp<?php echo $rows->idjrs; ?>" type="text"  class="form-control" value="<?php echo $v_mrgp; ?>"><span class="input-group-addon">min</span></div></td>
                          <td><input id="dbt<?php echo $rows->idjrs; ?>" name="dbt<?php echo $rows->idjrs; ?>" type="text"  class="form-control timepicker" value="<?php echo $v_dbt; ?>"></td>
						  <td><div class="input-group"><input id="mrg<?php echo $rows->idjrs; ?>" name="mrg<?php echo $rows->idjrs; ?>" type="text"  class="form-control " value="<?php echo $v_mrg; ?>"><span class="input-group-addon">min</span></div></td>
						  <td><input id="fin<?php echo $rows->idjrs; ?>" name="fin<?php echo $rows->idjrs; ?>" type="text" class="form-control timepicker" value="<?php echo $v_fin; ?>"></td>
                          <td><div class="input-group"><input id="mrgf<?php echo $rows->idjrs; ?>" name="mrgf<?php echo $rows->idjrs; ?>" type="text"  class="form-control " value="<?php echo $v_mrgf; ?>"><span class="input-group-addon">min</span></div></td>

                      </tr>
				  <?php } ?>


				  </tbody>
			  </table>

		  </div>
	  </div>

	  <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 