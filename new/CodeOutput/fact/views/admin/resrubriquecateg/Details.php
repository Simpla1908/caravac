
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resrubriquecateg
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	<div class="row">
    <div class="col-xs-12">
    <div class="box">
    <div class="box-header">
    <h3 class="box-title">Resrubriquecateg</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=resrubriquecateg&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resrubriquecateg&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resrubriquecateg&id=<?php echo $rows->id;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=resrubriquecateg&id=<?php echo $rows->id;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=resrubriquecateg&id=<?php echo $rows->id;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resrubriquecateg&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Rubrique Id</th><td><?php echo $rows->rubrique_id;?></td>
	</tr>
		
	<tr>
	<th>Categorie Id</th><td><?php echo $rows->categorie_id;?></td>
	</tr>
		
	<tr>
	<th>Salbase</th><td><?php echo $rows->salbase;?></td>
	</tr>
		
	<tr>
	<th>Nbrenf</th><td><?php echo $rows->nbrenf;?></td>
	</tr>
		
	<tr>
	<th>Salbrut</th><td><?php echo $rows->salbrut;?></td>
	</tr>
		
	<tr>
	<th>Manuel</th><td><?php echo $rows->manuel;?></td>
	</tr>
		
	<tr>
	<th>Pourcentage</th><td><?php echo $rows->pourcentage;?></td>
	</tr>
		
	<tr>
	<th>Imposable</th><td><?php echo $rows->imposable;?></td>
	</tr>
		
	<tr>
	<th>Valeur</th><td><?php echo $rows->valeur;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	