
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_liberation
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
    <h3 class="box-title">T Liberation</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_liberation&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_liberation&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_liberation&id_lib=<?php echo $rows->id_lib;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_liberation&id_lib=<?php echo $rows->id_lib;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_liberation&id_lib=<?php echo $rows->id_lib;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_liberation&id_lib=<?php echo $rows->id_lib;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Date Lib</th><td><?php echo $rows->date_lib;?></td>
	</tr>
		
	<tr>
	<th>Heure Lib</th><td><?php echo $rows->heure_lib;?></td>
	</tr>
		
	<tr>
	<th>Id Ch</th><td><?php echo $rows->id_ch;?></td>
	</tr>
		
	<tr>
	<th>Id Client</th><td><?php echo $rows->id_client;?></td>
	</tr>
		
	<tr>
	<th>Id Hotel</th><td><?php echo $rows->id_hotel;?></td>
	</tr>
		
	<tr>
	<th>Id Res</th><td><?php echo $rows->id_res;?></td>
	</tr>
		
	<tr>
	<th>Id Reser Cham</th><td><?php echo $rows->id_reser_cham;?></td>
	</tr>
		
	<tr>
	<th>Id User</th><td><?php echo $rows->id_user;?></td>
	</tr>
		
	<tr>
	<th>Dte Lib</th><td><?php echo $rows->dte_lib;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	