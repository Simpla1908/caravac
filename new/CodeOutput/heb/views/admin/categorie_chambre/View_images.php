
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		categorie_chambre
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Catégories</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=categorie_chambre&do=add_images" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                </ul>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter">
                    <thead>
                        <tr>
                          <th>Images</th>
                              <th data-hide="phone,tablet">Description</th>
                              <th data-hide="phone,tablet">Visible</th>
                              <th data-sort-ignore="true"><?php echo LANG_ACTIONS;?></th>
                            </tr>
                      </thead>
                      <tbody>

                       <?php
                            foreach($result as $rows)
                                {
                            ?>
                            <tr>
                                <td><img style="width: 30px; height: 30px" src='<?php echo THUMB_FOLDER.$rows->libelle;?>'></td>
                            <td><?php echo $rows->description;?></td>
                            <td><?php echo $rows->visible;?></td>
                            <td class="table-actions">
                             <div class="btn-group">
                            <a href="<?php echo H_ADMIN;?>&view=categorie_chambre&id_img=<?php echo $rows->id_img;?>&do=update_img" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE;?>"></span></a>
                             <a href="<?php echo H_ADMIN;?>&view=images_chambre&id_img=<?php echo $rows->id_img;?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH;?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE;?>"></span></a>
                             </div>
                             </td>
                        </tr>
                            <?php }?>
                      </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->