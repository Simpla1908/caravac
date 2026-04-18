
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
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=resdeclaration&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Rubrique Déclaration</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  <div class="row">
		  <div class="col-md-12">
			  <br>
			  <table data-page="false" class="t1 table table-bordered table-hover table-striped" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE;?>" data-page-previous-text="<?php echo LANG_PREVIOUS;?>" data-page-next-text="<?php echo LANG_NEXT;?>">
				  <thead>
				  <tr>
                      <th data-sort-ignore="true">#</th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">Code</th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">Désignation</th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">% Travailleur</th>
                      <th data-sort-ignore="true" data-hide="phone,tablet">% Société</th>
				  </tr>
				  </thead>
				  <tbody>
				  <?php
				  $i=1;
				  foreach ($result as $rows) {
					  ?>
					  <tr>
						  <td><?php echo $i;?></td>
                          <td><?php echo $rows->code;?></td>
                          <td>
                          <input id="id[]" name="id[]" type="hidden"   value="<?php echo $rows->id; ?>">
                           <input id="code<?php echo $rows->id;?>" name="code<?php echo $rows->id;?>" type="hidden"   value="<?php echo $rows->code; ?>">
                          <input id="lib<?php echo $rows->id;?>" name="lib<?php echo $rows->id;?>" type="text"  class="form-control" value="<?php echo $rows->lib;?>"></td>
						  <td><?php if($rows->pourtrav>0){;?><div class="input-group"><input id="pourtrav<?php echo $rows->id;?>" name="pourtrav<?php echo $rows->id;?>" type="text"  class="form-control" value="<?php echo $rows->pourtrav;?>"><span class="input-group-addon">%</span></div><?php } ?></td>
						  <td><?php if($rows->poursoc>0){;?><div class="input-group"><input id="poursoc<?php echo $rows->id;?>" name="poursoc<?php echo $rows->id;?>" type="text"  class="form-control" value="<?php echo $rows->poursoc;?>"><span class="input-group-addon">%</span></div><?php } ?></td>

                      </tr>
				  <?php 
				  $i++;
				  } 
				  ?>


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
	 