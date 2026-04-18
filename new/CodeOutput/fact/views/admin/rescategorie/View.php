
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		rescategorie
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
                <h3 class="box-title">Liste catégorie</h3>
                <ul class="nav pull-right">

                    <a href="<?php echo H_ADMIN; ?>&view=rescategorie&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=rescategorie&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=rescategorie&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip hidden" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=rescategorie&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip hidden" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=rescategorie&do=truncate" class="btn btn-default btn-xs tip hidden" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2 " data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th data-hide="phone,tablet">Salaire de base</th>
                             <th data-hide="phone,tablet">Paiement</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i=1;
                        foreach ($result as $rows) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $rows->libelle; ?></td>
                                <td><?php echo afficheMontant( $rows->devise,arrondir($rows->salbase)); ?></td>
                                <td><?php echo $rows->type; ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=rescategorie&id=<?php echo $rows->id; ?>&do=details"  class="btn btn-info btn-xs hidden"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=rescategorie&id=<?php echo $rows->id; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=rescategorie&id=<?php echo $rows->id; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination"><?php // echo $paging; ?></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->