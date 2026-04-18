
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_modulecompany
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
    <h3 class="box-title">T Modulecompany</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_modulecompany&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_modulecompany&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_modulecompany&id=<?php echo $rows->id;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_modulecompany&id=<?php echo $rows->id;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_modulecompany&id=<?php echo $rows->id;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_modulecompany&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Nbreuser</th><td><?php echo $rows->nbreuser;?></td>
	</tr>
		
	<tr>
	<th>Nbre User Maj</th><td><?php echo $rows->nbre_user_maj;?></td>
	</tr>
		
	<tr>
	<th>Etat Module</th><td><?php echo $rows->etat_module;?></td>
	</tr>
		
	<tr>
	<th>Paye</th><td><?php echo $rows->paye;?></td>
	</tr>
		
	<tr>
	<th>Montantmodule</th><td><?php echo $rows->montantmodule;?></td>
	</tr>
		
	<tr>
	<th>Prix Id</th><td><?php echo $rows->prix_id;?></td>
	</tr>
		
	<tr>
	<th>Pack Id</th><td><?php echo $rows->pack_id;?></td>
	</tr>
		
	<tr>
	<th>Company Id</th><td><?php echo $rows->company_id;?></td>
	</tr>
		
	<tr>
	<th>Module Id</th><td><?php echo $rows->module_id;?></td>
	</tr>
		
	<tr>
	<th>Souscription Id</th><td><?php echo $rows->souscription_id;?></td>
	</tr>
		
	<tr>
	<th>Date Sous</th><td><?php echo $rows->date_sous;?></td>
	</tr>
		
	<tr>
	<th>Date Activ</th><td><?php echo $rows->date_activ;?></td>
	</tr>
		
	<tr>
	<th>Date Echeance</th><td><?php echo $rows->date_echeance;?></td>
	</tr>
		
	<tr>
	<th>Dte Blocage</th><td><?php echo $rows->dte_blocage;?></td>
	</tr>
		
	<tr>
	<th>Site Id</th><td><?php echo $rows->site_id;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	