
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_facture
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
    <h3 class="box-title">T Facture</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_facture&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_facture&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_facture&id_fact=<?php echo $rows->id_fact;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_facture&id_fact=<?php echo $rows->id_fact;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_facture&id_fact=<?php echo $rows->id_fact;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_facture&id_fact=<?php echo $rows->id_fact;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Num Fact</th><td><?php echo $rows->num_fact;?></td>
	</tr>
		
	<tr>
	<th>Type</th><td><?php echo $rows->type;?></td>
	</tr>
		
	<tr>
	<th>I Souscription</th><td><?php echo $rows->i_souscription;?></td>
	</tr>
		
	<tr>
	<th>Etat</th><td><?php echo $rows->etat;?></td>
	</tr>
		
	<tr>
	<th>Etat Cmd</th><td><?php echo $rows->etat_cmd;?></td>
	</tr>
		
	<tr>
	<th>Date Echeance Old</th><td><?php echo $rows->date_echeance_old;?></td>
	</tr>
		
	<tr>
	<th>Date Edition</th><td><?php echo $rows->date_edition;?></td>
	</tr>
		
	<tr>
	<th>Dte Blocage</th><td><?php echo $rows->dte_blocage;?></td>
	</tr>
		
	<tr>
	<th>Date Echeance</th><td><?php echo $rows->date_echeance;?></td>
	</tr>
		
	<tr>
	<th>Date Desactivation</th><td><?php echo $rows->date_desactivation;?></td>
	</tr>
		
	<tr>
	<th>Montant Total</th><td><?php echo $rows->montant_total;?></td>
	</tr>
		
	<tr>
	<th>Mont Tva</th><td><?php echo $rows->mont_tva;?></td>
	</tr>
		
	<tr>
	<th>Mont Ttc</th><td><?php echo $rows->mont_ttc;?></td>
	</tr>
		
	<tr>
	<th>Mont Ttc Remise</th><td><?php echo $rows->mont_ttc_remise;?></td>
	</tr>
		
	<tr>
	<th>Taux</th><td><?php echo $rows->taux;?></td>
	</tr>
		
	<tr>
	<th>Taux Prix</th><td><?php echo $rows->taux_prix;?></td>
	</tr>
		
	<tr>
	<th>Tva</th><td><?php echo $rows->tva;?></td>
	</tr>
		
	<tr>
	<th>Monnaie</th><td><?php echo $rows->monnaie;?></td>
	</tr>
		
	<tr>
	<th>Remise</th><td><?php echo $rows->remise;?></td>
	</tr>
		
	<tr>
	<th>Majoration</th><td><?php echo $rows->majoration;?></td>
	</tr>
		
	<tr>
	<th>Justification</th><td><?php echo $rows->justification;?></td>
	</tr>
		
	<tr>
	<th>Id Res</th><td><?php echo $rows->id_res;?></td>
	</tr>
		
	<tr>
	<th>Res Ch Id</th><td><?php echo $rows->res_ch_id;?></td>
	</tr>
		
	<tr>
	<th>Modulecompagny</th><td><?php echo $rows->modulecompagny;?></td>
	</tr>
		
	<tr>
	<th>Id Hotel</th><td><?php echo $rows->id_hotel;?></td>
	</tr>
		
	<tr>
	<th>Company Id</th><td><?php echo $rows->company_id;?></td>
	</tr>
		
	<tr>
	<th>Id User</th><td><?php echo $rows->id_user;?></td>
	</tr>
		
	<tr>
	<th>Id Client</th><td><?php echo $rows->id_client;?></td>
	</tr>
		
	<tr>
	<th>Fact1</th><td><?php echo $rows->fact1;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	