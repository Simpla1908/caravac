
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_client
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=t_client&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Fournisseur</h3>
                <ul class="nav pull-right">
                    <?php if (in_array('ACHCF', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                        <a href="<?php echo H_ADMIN; ?>&view=t_client&do=add_ach" class="btn btn-danger btn-sm tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus-circle"></i> <?php echo LANG_ADD; ?></a>
                    <?php } ?>
                    <!--<a href="<?php echo H_ADMIN; ?>&view=t_client&do=extraitcompte" class="btn btn-primary btn-sm tip" title="Extrait de compte"><i class="fa fa-circle-o"></i> Extrait de compte</a>-->

                    <?php if (in_array('ACHIF', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                        <a href="#" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                    <?php } ?>
            <!--	<a href="<?php echo H_ADMIN_MAIN; ?>&view=t_client&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=t_client&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=t_client&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <!--AUTO COMPLETE-->

                <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th data-hide="phone,tablet">Entreprise</th>
                            <th data-hide="phone,tablet">Personne à contacter</th>
                            <th data-hide="phone,tablet">Téléphone</th>
                            <th data-hide="phone,tablet">Email</th>
                            <th data-hide="phone,tablet">Adresse</th>
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
                                <td><?php echo $rows->nom_entreprise; ?></td>
                                <td><?php echo $rows->nom_client; ?></td>
                                <td><?php echo $rows->telephone_client; ?></td>
                                <td><?php echo $rows->email_client; ?></td>
                                <td><?php echo $rows->adresse_provenance_client; ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=t_client&id_client=<?php echo $rows->id_client; ?>&do=update_ach" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=t_client&id_client=<?php echo $rows->id_client; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->