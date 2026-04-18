<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		stk_produit
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=stk_produit&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Liste de produits</h3>


            </div><!-- /.box-header -->
            <div class="box-body">

                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th data-hide="phone,tablet">Designation</th>
                            <th data-hide="phone,tablet">PV</th>
                            <th data-hide="phone,tablet">OBSERVATION</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($services_produits as $rows) {
                        ?>
                            <tr>
                                <td><?php echo $rows->code; ?></td>
                                <td><?php echo $rows->produit; ?></td>
                                <td><?php echo afficheMontant($rows->monnaie, $rows->pv); ?></td>
                                <td>
                                    <?php
                                    if ($rows->statut == 0) {
                                        echo 'Produit';
                                    } else {
                                        echo 'Service';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->