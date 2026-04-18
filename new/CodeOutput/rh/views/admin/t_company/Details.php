
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_company
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
    <h3 class="box-title">T Company</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_company&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_company&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_company&id_c=<?php echo $rows->id_c;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_company&id_c=<?php echo $rows->id_c;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_company&id_c=<?php echo $rows->id_c;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_company&id_c=<?php echo $rows->id_c;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Nom C</th><td><?php echo $rows->nom_c;?></td>
	</tr>
		
	<tr>
	<th>Etat</th><td><?php echo $rows->etat;?></td>
	</tr>
		
	<tr>
	<th>Adresse C</th><td><?php echo $rows->adresse_c;?></td>
	</tr>
		
	<tr>
	<th>Logo</th><td><?php echo $rows->logo;?></td>
	</tr>
		
	<tr>
	<th>Idnat</th><td><?php echo $rows->idnat;?></td>
	</tr>
		
	<tr>
	<th>Rccm</th><td><?php echo $rows->rccm;?></td>
	</tr>
		
	<tr>
	<th>Mail Company</th><td><?php echo $rows->mail_company;?></td>
	</tr>
		
	<tr>
	<th>Ville</th><td><?php echo $rows->ville;?></td>
	</tr>
		
	<tr>
	<th>Phone</th><td><?php echo $rows->phone;?></td>
	</tr>
		
	<tr>
	<th>Num Impot</th><td><?php echo $rows->num_impot;?></td>
	</tr>
		
	<tr>
	<th>Cb</th><td><?php echo $rows->cb;?></td>
	</tr>
		
	<tr>
	<th>Mention</th><td><?php echo $rows->mention;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	