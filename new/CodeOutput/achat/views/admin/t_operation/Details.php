
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_operation
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
    <h3 class="box-title">T Operation</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_operation&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_operation&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_operation&idoperation=<?php echo $rows->idoperation;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_operation&idoperation=<?php echo $rows->idoperation;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_operation&idoperation=<?php echo $rows->idoperation;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_operation&idoperation=<?php echo $rows->idoperation;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Type</th><td><?php echo $rows->type;?></td>
	</tr>
		
	<tr>
	<th>Libelle</th><td><?php echo $rows->libelle;?></td>
	</tr>
		
	<tr>
	<th>Date Bon</th><td><?php echo $rows->date_bon;?></td>
	</tr>
		
	<tr>
	<th>Date Heure Bon</th><td><?php echo $rows->date_heure_bon;?></td>
	</tr>
		
	<tr>
	<th>Beneficiaire</th><td><?php echo $rows->beneficiaire;?></td>
	</tr>
		
	<tr>
	<th>Provenance</th><td><?php echo $rows->provenance;?></td>
	</tr>
		
	<tr>
	<th>MontantFC</th><td><?php echo $rows->montantFC;?></td>
	</tr>
		
	<tr>
	<th>MontantUSD</th><td><?php echo $rows->montantUSD;?></td>
	</tr>
		
	<tr>
	<th>NumBon</th><td><?php echo $rows->numBon;?></td>
	</tr>
		
	<tr>
	<th>Indice Be</th><td><?php echo $rows->indice_be;?></td>
	</tr>
		
	<tr>
	<th>Indice Bs</th><td><?php echo $rows->indice_bs;?></td>
	</tr>
		
	<tr>
	<th>NumBordereau</th><td><?php echo $rows->numBordereau;?></td>
	</tr>
		
	<tr>
	<th>Mode Operation</th><td><?php echo $rows->mode_operation;?></td>
	</tr>
		
	<tr>
	<th>Session Id</th><td><?php echo $rows->session_id;?></td>
	</tr>
		
	<tr>
	<th>Motif Id</th><td><?php echo $rows->motif_id;?></td>
	</tr>
		
	<tr>
	<th>User Vers</th><td><?php echo $rows->user_vers;?></td>
	</tr>
		
	<tr>
	<th>User Id</th><td><?php echo $rows->user_id;?></td>
	</tr>
		
	<tr>
	<th>Hotel Id</th><td><?php echo $rows->hotel_id;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	