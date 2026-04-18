
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk__mouvement
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
    <h3 class="box-title">Stk  Mouvement</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=stk__mouvement&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=stk__mouvement&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=stk__mouvement&idmvt=<?php echo $rows->idmvt;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=stk__mouvement&idmvt=<?php echo $rows->idmvt;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=stk__mouvement&idmvt=<?php echo $rows->idmvt;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=stk__mouvement&idmvt=<?php echo $rows->idmvt;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Indice Bs</th><td><?php echo $rows->indice_bs;?></td>
	</tr>
		
	<tr>
	<th>Type</th><td><?php echo $rows->type;?></td>
	</tr>
		
	<tr>
	<th>Motif</th><td><?php echo $rows->motif;?></td>
	</tr>
		
	<tr>
	<th>Num Bon</th><td><?php echo $rows->num_bon;?></td>
	</tr>
		
	<tr>
	<th>Qte Entree</th><td><?php echo $rows->qte_entree;?></td>
	</tr>
		
	<tr>
	<th>Qte Sortie</th><td><?php echo $rows->qte_sortie;?></td>
	</tr>
		
	<tr>
	<th>Dte Appro</th><td><?php echo $rows->dte_appro;?></td>
	</tr>
		
	<tr>
	<th>Dte Appro Heure</th><td><?php echo $rows->dte_appro_heure;?></td>
	</tr>
		
	<tr>
	<th>Depot</th><td><?php echo $rows->depot;?></td>
	</tr>
		
	<tr>
	<th>Produit Id</th><td><?php echo $rows->produit_id;?></td>
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
	