
<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	30-10-2017
 * FOR TABLE:  		resemployehoraire
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
                <h3 class="box-title">Détails<?php echo ' '.get('h'); ?></h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=resemployehoraire&do=viewall" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=resemployehoraire&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT; ?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
              <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th data-hide="phone,tablet">Matricule</th>
                             <th data-hide="phone,tablet">Employé</th>
                            <th data-hide="phone,tablet">Séquence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        $semaine='semaine';
                        foreach ($result as $rows) {
                            if($rows->seq>2){
                              $semaine='semaines';
                            }
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $rows->matricule; ?></td>
                                <td><?php echo $rows->noms; ?></td>
                                <td><?php echo $rows->seq.' '.$semaine; ?></td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
