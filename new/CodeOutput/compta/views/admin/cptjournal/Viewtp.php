
	<?php
	/*
	* =======================================================================
	* FILE NAME:        View.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	<?php AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=cptecritures&do=autosearch');?>
	
	<div class="row">
            <div class="col-xs-12">
              <div class="box">
              
               <div class="box-header with-border">
               <h3 class="box-title">Type de Journal</h3>
                <ul class="nav pull-right">

	<a href="<?php echo H_ADMIN;?>&view=cptjournal&do=addtj" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a>
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body" id="contentdatafilter">	 
  <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
	<thead>
    <tr>
      <th>#</th>
      <th data-hide="phone,tablet">Code</th>
	  <th data-hide="phone,tablet">Libellé</th>
	  <th data-sort-ignore="true"><?php echo LANG_ACTIONS;?></th>
	</tr>
  </thead>
  <tbody>
  
   <?php
   $i=1;
	foreach($result as $rows)
			{
	?>
	<tr>
	<td><?php echo $i;?></td>
	<td><?php echo $rows->code;?></td>
	<td><?php echo $rows->libelle;?></td>
	<td class="table-actions">
	 <div class="btn-group">
	<?php 
    if($rows->site_id!=Null){
    ?>	
	<a href="<?php echo H_ADMIN;?>&view=cptexercice&id=<?php echo $rows->id;?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE;?>"></span></a>
	 <a href="<?php echo H_ADMIN;?>&view=cptexercice&id=<?php echo $rows->id;?>&do=psedodelete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH;?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE;?>"></span></a>
	<?php
    }
    ?>
	 </div>
	 </td>
    </tr>
	<?php 
	     $i++;
     }
	?>
  </tbody>
</table>
  </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->