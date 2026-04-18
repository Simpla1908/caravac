
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		reshoraire
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
    <h3 class="box-title">Reshoraire</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=reshoraire&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=reshoraire&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=reshoraire&idh=<?php echo $rows->idh;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=reshoraire&idh=<?php echo $rows->idh;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=reshoraire&idh=<?php echo $rows->idh;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=reshoraire&idh=<?php echo $rows->idh;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Libh</th><td><?php echo $rows->libh;?></td>
	</tr>
		
	<tr>
	<th>Hlund</th><td><?php echo $rows->hlund;?></td>
	</tr>
		
	<tr>
	<th>Hmard</th><td><?php echo $rows->hmard;?></td>
	</tr>
		
	<tr>
	<th>Hmerd</th><td><?php echo $rows->hmerd;?></td>
	</tr>
		
	<tr>
	<th>Hjeud</th><td><?php echo $rows->hjeud;?></td>
	</tr>
		
	<tr>
	<th>Hvend</th><td><?php echo $rows->hvend;?></td>
	</tr>
		
	<tr>
	<th>Hsamd</th><td><?php echo $rows->hsamd;?></td>
	</tr>
		
	<tr>
	<th>Hdimd</th><td><?php echo $rows->hdimd;?></td>
	</tr>
		
	<tr>
	<th>Hlunf</th><td><?php echo $rows->hlunf;?></td>
	</tr>
		
	<tr>
	<th>Hmarf</th><td><?php echo $rows->hmarf;?></td>
	</tr>
		
	<tr>
	<th>Hmerf</th><td><?php echo $rows->hmerf;?></td>
	</tr>
		
	<tr>
	<th>Hjeuf</th><td><?php echo $rows->hjeuf;?></td>
	</tr>
		
	<tr>
	<th>Hvenf</th><td><?php echo $rows->hvenf;?></td>
	</tr>
		
	<tr>
	<th>Hsamf</th><td><?php echo $rows->hsamf;?></td>
	</tr>
		
	<tr>
	<th>Hdimf</th><td><?php echo $rows->hdimf;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	