
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resrubrique
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
$titre='Liste Rubrique paie';
$type=get('type');
if($type==0){
   $titre='Liste Rubrique emprunt'; 
}
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $titre; ?></h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=resrubrique&do=add&type=<?php echo $type; ?>" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">


                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-hide="phone,tablet">Désignation</th>
                            <th data-hide="phone,tablet">Type</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach ($result as $rows) {
                            if($rows->type2=='transport'){
                                $type1=$rows->type2;
                            } else {
                                $type1=$rows->type;
                            }
                            if($rows->affiche==$type){
                            ?>
                            <tr>
                                 <td><?php echo $i; ?></td>
                                <td><?php echo $rows->libelle; ?></td>
                                <td>
                                    <?php echo $type1; ?>
                                </td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=resrubrique&id=<?php echo $rows->id; ?>&do=details&type=<?php echo $rows->affiche; ?>"  class="btn btn-info btn-xs hidden"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=resrubrique&id=<?php echo $rows->id; ?>&do=update&type=<?php echo $rows->affiche; ?>" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=resrubrique&id=<?php echo $rows->id; ?>&do=delete&type=<?php echo $type; ?>" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;}} ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->