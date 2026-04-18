
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resemployes
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
                <h3 class="box-title">Liste des employés</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=resemployes&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=lstemployes" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>Noms</th>
                            <th data-hide="phone,tablet">Sexe</th>
                            <th data-hide="phone,tablet">Age</th>
                            <th data-hide="phone,tablet">Engagement</th>
                            <th data-hide="phone,tablet">Fonction</th>
                            <th data-hide="phone,tablet">Catégorie</th>
                            <th data-hide="phone,tablet">Ancienneté</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach ($result as $rows) {
                            
                            ?>
                            <tr>
                                <td><?php echo $rows->noms; ?></td>
                                <td><?php echo $rows->sexe; ?></td>
                                <td><?php echo  NbAnnee($rows->datenais)?></td>
                                <td><?php echo dateAffiche($rows->dteng) ; ?></td>
                                <td><?php echo $rows->fonction; ?></td>
                                <td><?php echo $rows->categorie; ?></td>
                                <td><?php echo  NbAnnee($rows->dteng); ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=resemployes&id=<?php echo $rows->id; ?>&do=details"  class="btn btn-info btn-xs hidden"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                        <?php if (in_array('RHMIE', $_SESSION['actions']['code_actions'])) { ?>
											<a href="<?php echo H_ADMIN; ?>&view=resemployes&id=<?php echo $rows->id; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                        <?php } ?>
										<a href="<?php echo H_ADMIN; ?>&view=resemployes&id=<?php echo $rows->id; ?>&do=delete&dfile=<?php echo $rows->image; ?>" class="btn btn-danger btn-xs hidden" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;} ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->