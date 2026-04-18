
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
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
                <h3 class="box-title">Affectation horaire</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN_MAIN;?>&view=resemployehoraire&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT;?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=resemployehoraire&do=add" class="btn btn-default btn-xs tip hidden" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th data-hide="phone,tablet">horaire</th>
                            <th data-hide="phone,tablet">Employé</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        $_SESSION['data'] = array();
                        $_SESSION['data']['id'] = array();
                        $_SESSION['data']['nbre'] = array();
                        foreach ($NbrEmployeByHoraires as $rows2){
                            $_SESSION['data']['id'][$rows2->horaire_id]= $rows2->horaire_id; 
                            $_SESSION['data']['nbre'][$rows2->horaire_id]= $rows2->nbremp; 
                        }
                        foreach ($horaires as $rows1) {
                            $nbremp=0;
                            $horaire_id=$rows1->idh;
                            if (in_array($horaire_id,$_SESSION['data']['id'])) {
                               $nbremp= $_SESSION['data']['nbre'][$horaire_id];
                            } 
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $rows1->libh; ?></td>
                                <td><?php echo $nbremp; ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=resemployehoraire&id=<?php echo $rows1->idh; ?>&h=<?php echo $rows1->libh; ?>&do=details"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->