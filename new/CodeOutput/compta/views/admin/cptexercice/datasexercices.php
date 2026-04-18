 <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
	<thead>
    <tr>
      <th>#</th>
	  <th data-hide="phone,tablet">Libellé</th>
	  <th data-hide="phone,tablet">Début</th>
	  <th data-hide="phone,tablet">Fin</th>
	   <th data-hide="phone,tablet">En cours</th>
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
	<td><?php echo $rows->lib;?></td>
	<td><?php echo dateAffiche($rows->debut);?></td>
	<td><?php echo dateAffiche($rows->fin);?></td>
    <td>
    <?php 
    if($rows->etat==0){
    ?>
    <input id="<?php echo $rows->id; ?>" name="exercices[]" type="radio"  class="flat-red exercicencours" value="<?php echo $rows->id; ?>">
    <?php
    }else{
    ?>
    <input id="<?php echo $rows->id; ?>" name="exercices[]" type="radio"  class="flat-red exercicencours" checked="checked" value="<?php echo $rows->id; ?>">
    <?php
    }
    ?>
    </td>
	<td class="table-actions">
	 <div class="btn-group">
	<a href="<?php echo H_ADMIN;?>&view=cptexercice&id=<?php echo $rows->id;?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE;?>"></span></a>
	  <?php 
    if($rows->etat==0){
    ?>
	 <a href="<?php echo H_ADMIN;?>&view=cptexercice&id=<?php echo $rows->id;?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH;?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE;?>"></span></a>
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