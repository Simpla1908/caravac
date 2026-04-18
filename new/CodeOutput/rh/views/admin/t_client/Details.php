
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_client
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
    <h3 class="box-title">T Client</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_client&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_client&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_client&id_client=<?php echo $rows->id_client;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_client&id_client=<?php echo $rows->id_client;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_client&id_client=<?php echo $rows->id_client;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_client&id_client=<?php echo $rows->id_client;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
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
	<th>Nom Client</th><td><?php echo $rows->nom_client;?></td>
	</tr>
		
	<tr>
	<th>Date Naiss Client</th><td><?php echo $rows->date_naiss_client;?></td>
	</tr>
		
	<tr>
	<th>Sexe Client</th><td><?php echo $rows->sexe_client;?></td>
	</tr>
		
	<tr>
	<th>Etat Civil Client</th><td><?php echo $rows->etat_civil_client;?></td>
	</tr>
		
	<tr>
	<th>Nationalite Client</th><td><?php echo $rows->nationalite_client;?></td>
	</tr>
		
	<tr>
	<th>Provenance Client</th><td><?php echo $rows->provenance_client;?></td>
	</tr>
		
	<tr>
	<th>Num Piece Identite Client</th><td><?php echo $rows->num_piece_identite_client;?></td>
	</tr>
		
	<tr>
	<th>Num Passeport Client</th><td><?php echo $rows->num_passeport_client;?></td>
	</tr>
		
	<tr>
	<th>Adresse Provenance Client</th><td><?php echo $rows->adresse_provenance_client;?></td>
	</tr>
		
	<tr>
	<th>Email Client</th><td><?php echo $rows->email_client;?></td>
	</tr>
		
	<tr>
	<th>Telephone Client</th><td><?php echo $rows->telephone_client;?></td>
	</tr>
		
	<tr>
	<th>Num Pers Contacter Client</th><td><?php echo $rows->num_pers_contacter_client;?></td>
	</tr>
		
	<tr>
	<th>Statut</th><td><?php echo $rows->statut;?></td>
	</tr>
		
	<tr>
	<th>Pseudo Supp</th><td><?php echo $rows->pseudo_supp;?></td>
	</tr>
		
	<tr>
	<th>Type</th><td><?php echo $rows->type;?></td>
	</tr>
		
	<tr>
	<th>Type Cl</th><td><?php echo $rows->type_cl;?></td>
	</tr>
		
	<tr>
	<th>Id Respo</th><td><?php echo $rows->id_respo;?></td>
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
	