
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_produits_livres
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
    <h3 class="box-title">Ach Produits Livres</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=ach_produits_livres&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=ach_produits_livres&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=ach_produits_livres&id_produit_liv=<?php echo $rows->id_produit_liv;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=ach_produits_livres&id_produit_liv=<?php echo $rows->id_produit_liv;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=ach_produits_livres&id_produit_liv=<?php echo $rows->id_produit_liv;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=ach_produits_livres&id_produit_liv=<?php echo $rows->id_produit_liv;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Quantite Cmd</th><td><?php echo $rows->quantite_cmd;?></td>
	</tr>
		
	<tr>
	<th>Quantite Liv</th><td><?php echo $rows->quantite_liv;?></td>
	</tr>
		
	<tr>
	<th>Observation</th><td><?php echo $rows->observation;?></td>
	</tr>
		
	<tr>
	<th>Produit Id</th><td><?php echo $rows->produit_id;?></td>
	</tr>
		
	<tr>
	<th>Livraison Id</th><td><?php echo $rows->livraison_id;?></td>
	</tr>
		
	<tr>
	<th>User Id</th><td><?php echo $rows->user_id;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	