
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_produit
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
    <h3 class="box-title">Stk Produit</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=stk_produit&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=stk_produit&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=stk_produit&idprod=<?php echo $rows->idprod;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=stk_produit&idprod=<?php echo $rows->idprod;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=stk_produit&idprod=<?php echo $rows->idprod;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=stk_produit&idprod=<?php echo $rows->idprod;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Code</th><td><?php echo $rows->code;?></td>
	</tr>
		
	<tr>
	<th>Designation</th><td><?php echo $rows->designation;?></td>
	</tr>
		
	<tr>
	<th>Qte Min</th><td><?php echo $rows->qte_min;?></td>
	</tr>
		
	<tr>
	<th>Qte Initial</th><td><?php echo $rows->qte_initial;?></td>
	</tr>
		
	<tr>
	<th>Qte Dispo</th><td><?php echo $rows->qte_dispo;?></td>
	</tr>
		
	<tr>
	<th>Pa</th><td><?php echo $rows->pa;?></td>
	</tr>
		
	<tr>
	<th>Pv</th><td><?php echo $rows->pv;?></td>
	</tr>
		
	<tr>
	<th>Monnaie</th><td><?php echo $rows->monnaie;?></td>
	</tr>
		
	<tr>
	<th>Repas</th><td><?php echo $rows->repas;?></td>
	</tr>
		
	<tr>
	<th>Statut</th><td><?php echo $rows->statut;?></td>
	</tr>
		
	<tr>
	<th>Pseudo Supp</th><td><?php echo $rows->pseudo_supp;?></td>
	</tr>
		
	<tr>
	<th>Unite</th><td><?php echo $rows->unite;?></td>
	</tr>
		
	<tr>
	<th>Famille Id</th><td><?php echo $rows->famille_id;?></td>
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
	