
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reservation
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
    <h3 class="box-title">T Reservation</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_reservation&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reservation&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reservation&id_res=<?php echo $rows->id_res;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_reservation&id_res=<?php echo $rows->id_res;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_reservation&id_res=<?php echo $rows->id_res;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reservation&id_res=<?php echo $rows->id_res;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Num Reserv</th><td><?php echo $rows->num_reserv;?></td>
	</tr>
		
	<tr>
	<th>Garantie</th><td><?php echo $rows->garantie;?></td>
	</tr>
		
	<tr>
	<th>Num Bc</th><td><?php echo $rows->num_bc;?></td>
	</tr>
		
	<tr>
	<th>Num Occ</th><td><?php echo $rows->num_occ;?></td>
	</tr>
		
	<tr>
	<th>Num Com</th><td><?php echo $rows->num_com;?></td>
	</tr>
		
	<tr>
	<th>Type</th><td><?php echo $rows->type;?></td>
	</tr>
		
	<tr>
	<th>Tva</th><td><?php echo $rows->tva;?></td>
	</tr>
		
	<tr>
	<th>Taux</th><td><?php echo $rows->taux;?></td>
	</tr>
		
	<tr>
	<th>Remise</th><td><?php echo $rows->remise;?></td>
	</tr>
		
	<tr>
	<th>Majoration</th><td><?php echo $rows->majoration;?></td>
	</tr>
		
	<tr>
	<th>Mont Nuite</th><td><?php echo $rows->mont_nuite;?></td>
	</tr>
		
	<tr>
	<th>Mont Total Res</th><td><?php echo $rows->mont_total_res;?></td>
	</tr>
		
	<tr>
	<th>Mont Par Chambre</th><td><?php echo $rows->mont_par_chambre;?></td>
	</tr>
		
	<tr>
	<th>Monnaie</th><td><?php echo $rows->monnaie;?></td>
	</tr>
		
	<tr>
	<th>Nbr Ch</th><td><?php echo $rows->nbr_ch;?></td>
	</tr>
		
	<tr>
	<th>Etat</th><td><?php echo $rows->etat;?></td>
	</tr>
		
	<tr>
	<th>Etat Credit</th><td><?php echo $rows->etat_credit;?></td>
	</tr>
		
	<tr>
	<th>Dte</th><td><?php echo $rows->dte;?></td>
	</tr>
		
	<tr>
	<th>Date Res</th><td><?php echo $rows->date_res;?></td>
	</tr>
		
	<tr>
	<th>Date Occ</th><td><?php echo $rows->date_occ;?></td>
	</tr>
		
	<tr>
	<th>Date Lib</th><td><?php echo $rows->date_lib;?></td>
	</tr>
		
	<tr>
	<th>Statut Res</th><td><?php echo $rows->statut_res;?></td>
	</tr>
		
	<tr>
	<th>Statut Occ</th><td><?php echo $rows->statut_occ;?></td>
	</tr>
		
	<tr>
	<th>Statut Sorti</th><td><?php echo $rows->statut_sorti;?></td>
	</tr>
		
	<tr>
	<th>Id Client</th><td><?php echo $rows->id_client;?></td>
	</tr>
		
	<tr>
	<th>Chambr Id</th><td><?php echo $rows->chambr_id;?></td>
	</tr>
		
	<tr>
	<th>Id Hotel</th><td><?php echo $rows->id_hotel;?></td>
	</tr>
		
	<tr>
	<th>Dte A</th><td><?php echo $rows->dte_a;?></td>
	</tr>
		
	<tr>
	<th>Dte S</th><td><?php echo $rows->dte_s;?></td>
	</tr>
		
	<tr>
	<th>Occ Indirect</th><td><?php echo $rows->occ_indirect;?></td>
	</tr>
		
	<tr>
	<th>Respo Id</th><td><?php echo $rows->respo_id;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	