
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_utilisateur
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
    <h3 class="box-title">T Utilisateur</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=t_utilisateur&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_utilisateur&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_utilisateur&id_user=<?php echo $rows->id_user;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_utilisateur&id_user=<?php echo $rows->id_user;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=t_utilisateur&id_user=<?php echo $rows->id_user;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_utilisateur&id_user=<?php echo $rows->id_user;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Nom User</th><td><?php echo $rows->nom_user;?></td>
	</tr>
		
	<tr>
	<th>Prenom User</th><td><?php echo $rows->prenom_user;?></td>
	</tr>
		
	<tr>
	<th>Sexe User</th><td><?php echo $rows->sexe_user;?></td>
	</tr>
		
	<tr>
	<th>Telephone User</th><td><?php echo $rows->telephone_user;?></td>
	</tr>
		
	<tr>
	<th>Email User</th><td><?php echo $rows->email_user;?></td>
	</tr>
		
	<tr>
	<th>Mdp User</th><td><?php echo $rows->mdp_user;?></td>
	</tr>
		
	<tr>
	<th>Adresse Mail</th><td><?php echo $rows->adresse_mail;?></td>
	</tr>
		
	<tr>
	<th>Type</th><td><?php echo $rows->type;?></td>
	</tr>
		
	<tr>
	<th>Actif</th><td><?php echo $rows->actif;?></td>
	</tr>
		
	<tr>
	<th>Id Hotel</th><td><?php echo $rows->id_hotel;?></td>
	</tr>
		
	<tr>
	<th>Company Id</th><td><?php echo $rows->company_id;?></td>
	</tr>
		
	<tr>
	<th>Id Droit</th><td><?php echo $rows->id_droit;?></td>
	</tr>
		
	<tr>
	<th>Fconnect</th><td><?php echo $rows->fconnect;?></td>
	</tr>
		
	<tr>
	<th>Connect</th><td><?php echo $rows->connect;?></td>
	</tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	