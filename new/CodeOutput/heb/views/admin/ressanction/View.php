<?php
/*
* =======================================================================
* FILE NAME:        View.php
* DATE CREATED:  	17-11-2017
* FOR TABLE:  		ressanction
* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
* =======================================================================
*/
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=ressanction&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Liste sanction</h3>
                <ul class="nav pull-right">

                    <a href="<?php echo H_ADMIN; ?>&view=ressanction&do=add" class="btn btn-default btn-xs tip"
                       title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=ressanction&do=export&hexport=yes&etype=printer"
                       target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT; ?>"><i
                            class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <table data-page="false" class="t1 t2 tableau table table-bordered table-hover table-striped"
                       data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>"
                       data-page-previous-text="<?php echo LANG_PREVIOUS; ?>"
                       data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Désignation</th>
                        <th data-hide="phone,tablet">Privation Salaire</th>
                        <th data-hide="phone,tablet">Nombre de jours</th>
                        <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $i = 1;
                    foreach ($result as $rows) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rows->libelle; ?></td>
                            <td>
                                <?php
                                if ($rows->retenue == 0) {
                                    echo 'Non';
                                } else {
                                    echo 'Oui';
                                }

                                ?>
                            </td>
                            <td><?php echo $rows->nbrjr; ?></td>
                            <td class="table-actions">
                                <div class="btn-group">
                                    <a href="<?php echo H_ADMIN; ?>&view=ressanction&id=<?php echo $rows->id; ?>&do=update"
                                       class="btn btn-primary btn-xs"><span class="fa fa-edit tip"
                                                                            title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                    <a href="<?php echo H_ADMIN; ?>&view=ressanction&id=<?php echo $rows->id; ?>&do=delete"
                                       class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>">
                                        <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="pagination"><?php //echo $paging;?></div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->