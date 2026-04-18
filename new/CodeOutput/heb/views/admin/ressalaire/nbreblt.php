
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		ressalaire
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
                <h3 class="box-title">Bulletins de paie</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                    <a href="#" target="_blank" class="btn btn-default btn-xs tip hidden" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <th data-hide="phone,tablet">Matricule</th>
                            <th data-hide="phone,tablet">Nombre</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                     foreach ($result as $rows) {
                        ?>
                        <tr>
                            <td><?php echo $rows->noms; ?></td>
                             <td><?php echo $rows->matricule; ?></td>
                            <td><?php echo $rows->nbreblt; ?></td>
                            <td class="table-actions">
                                <div class="btn-group">
                                    <a href="<?php echo H_ADMIN; ?>&view=ressalaire&id=<?php echo $rows->id; ?>&do=viewall2"  class="btn btn-info btn-xs"><span class="fa fa-list fa-fw tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->