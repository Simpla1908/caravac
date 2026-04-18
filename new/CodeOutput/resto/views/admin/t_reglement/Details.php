
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglement
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
    <h3 class="box-title">T Reglement</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_reglement&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reglement&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reglement&id_regl=<?php echo $rows->id_regl;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_reglement&id_regl=<?php echo $rows->id_regl;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_reglement&id_regl=<?php echo $rows->id_regl;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reglement&id_regl=<?php echo $rows->id_regl;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Numero</th><td><?php echo $rows->numero;?></td>
	</tr>
		
	<tr>
	<th>Montant Dollar</th><td><?php echo $rows->montant_dollar;?></td>
	</tr>
		
	<tr>
	<th>Montant Fc</th><td><?php echo $rows->montant_fc;?></td>
	</tr>
		
	<tr>
	<th>Reste</th><td><?php echo $rows->reste;?></td>
	</tr>
		
	<tr>
	<th>Id Mode Regl</th><td><?php echo $rows->id_mode_regl;?></td>
	</tr>
		
	<tr>
	<th>Date Regl</th><td><?php echo $rows->date_regl;?></td>
	</tr>
		
	<tr>
	<th>Dte</th><td><?php echo $rows->dte;?></td>
	</tr>
		
	<tr>
	<th>Rejete</th><td><?php echo $rows->rejete;?></td>
	</tr>
		
	<tr>
	<th>Id Fact</th><td><?php echo $rows->id_fact;?></td>
	</tr>
		
	<tr>
	<th>Id Monnaie</th><td><?php echo $rows->id_monnaie;?></td>
	</tr>
		
	<tr>
	<th>Id User</th><td><?php echo $rows->id_user;?></td>
	</tr>
		
	<tr>
	<th>Id Hotel</th><td><?php echo $rows->id_hotel;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	