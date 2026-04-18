
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_chambre
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=t_chambre&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Services</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=t_chambre&do=add2" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                    <!--<a href="<?php // echo H_ADMIN_MAIN; ?>&view=t_chambre&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" >
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th data-hide="phone,tablet">Tarif</th>
                            <th data-sort-ignore="true"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($result as $rows) {
                             $tarif_ch = montant_equivalent_bdd($rows->monnaie,$_SESSION['Paie_insert'],$_SESSION['Paie_taux'],$rows->tarif_ch);
                            ?>
                            <?php if($rows->libre=='non'){ ?>
                            <tr>
                                <td><?php echo $rows->num_ch; ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_insert'],$tarif_ch); ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=t_chambre&id_ch=<?php echo $rows->id_ch; ?>&do=update2" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=t_chambre&id_ch=<?php echo $rows->id_ch; ?>&do=delete2" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->