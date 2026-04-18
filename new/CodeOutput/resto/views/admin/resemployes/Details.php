
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemployes
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
    <h3 class="box-title">Resemployes</h3>
   <ul class="nav pull-right">
				
	<a href="<?php echo H_ADMIN;?>&view=resemployes&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resemployes&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resemployes&id=<?php echo $rows->id;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<a href="<?php echo H_ADMIN_MAIN;?>&view=resemployes&id=<?php echo $rows->id;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=resemployes&id=<?php echo $rows->id;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resemployes&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-xs tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>Matricule</th><td><?php echo $rows->matricule;?></td>
	</tr>
		
	<tr>
	<th>Noms</th><td><?php echo $rows->noms;?></td>
	</tr>
		
	<tr>
	<th>Sexe</th><td><?php echo $rows->sexe;?></td>
	</tr>
		
	<tr>
	<th>Etatcivil</th><td><?php echo $rows->etatcivil;?></td>
	</tr>
		
	<tr>
	<th>Nationalite</th><td><?php echo $rows->nationalite;?></td>
	</tr>
		
	<tr>
	<th>Lieunais</th><td><?php echo $rows->lieunais;?></td>
	</tr>
		
	<tr>
	<th>Datenais</th><td><?php echo $rows->datenais;?></td>
	</tr>
		
	<tr>
	<th>Adresse</th><td><?php echo $rows->Adresse;?></td>
	</tr>
		
	<tr>
	<th>Piece</th><td><?php echo $rows->piece;?></td>
	</tr>
		
	<tr>
	<th>Numpiece</th><td><?php echo $rows->numpiece;?></td>
	</tr>
		
	<tr>
	<th>Tel1</th><td><?php echo $rows->tel1;?></td>
	</tr>
		
	<tr>
	<th>Tel2</th><td><?php echo $rows->tel2;?></td>
	</tr>
		
	<tr>
	<th>Email</th><td><?php echo $rows->email;?></td>
	</tr>
		
	<tr>
	<th>Nbrenf</th><td><?php echo $rows->nbrenf;?></td>
	</tr>
		
	<tr>
	<th>Actif</th><td><?php echo $rows->actif;?></td>
	</tr>
		
	<tr>
	<th>Pseudo Supp</th><td><?php echo $rows->pseudo_supp;?></td>
	</tr>
		
	<tr>
	<th>Fonction Id</th><td><?php echo $rows->fonction_id;?></td>
	</tr>
		
	<tr>
	<th>Departement Id</th><td><?php echo $rows->departement_id;?></td>
	</tr>
		
	<tr>
	<th>Image</th><td class='gallery'><?php if(is_file(UPLOAD_FOLDER.$rows->image)){?><a href='<?php echo UPLOAD_FOLDER.$rows->image;?>' data-rel='hezebox'><img src='<?php echo THUMB_FOLDER.$rows->image;?>'></a><?php }?></td>
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
	