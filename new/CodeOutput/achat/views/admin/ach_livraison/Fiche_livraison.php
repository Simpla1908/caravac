
<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	09-07-2018
 * FOR TABLE:  		ach_livraison
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
            <div class="box-header">
                <h3 class="box-title">Fiche des Livraisons</h3>
                <ul class="nav pull-right">

                    <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>

                    <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT; ?>" target="_blank" class="btn btn-default btn-sm tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>-->

                </ul>

            </div><!-- /.box-header -->
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-10">
                        <br>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">N° Bon commande</label>

                            <div class="col-sm-8">
                                : <span class="direct-chat-timestamp"><?php echo $rows->num_cmd;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Founisseur</label>

                            <div class="col-sm-8">
                                : <span class="direct-chat-timestamp"><?php echo ucfirst($rows->nom_entreprise);?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 control-label">Date de commande</label>

                            <div class="col-sm-8">
                                : <span class="direct-chat-timestamp"><?php echo dateAffiche($rows->date_edition);?></span>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <!-- The time line -->
                            <ul class="timeline">
                                <?php
//                                $i=1;
                                foreach ($result_rows as $rr) {
                                    $id_liv = $rr->id_liv;
                                    $bonliv = $rr->numBon_liv;
                                    $date = $rr->date;
                                    $date_h = $rr->date_h;
                                    $format1='Y-m-d h:i:s';
                                    $format2='d/m/Y h:i:s';
                                    $produits=ProduitsLiv($id_liv, $_SESSION['idsite']);
                                ?>
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-red">
                                        <?php echo format_stringdateTodatetime('Y-m-d H:i:s', $date_h, 'd/m/Y H:i:s'); ?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-truck bg-aqua"></i>

                                    <div class="timeline-item">
                                        <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->

                                        <h3 class="timeline-header">N° bon livraison : <a href="#"><?php echo $bonliv; ?></a></h3>

                                        <div class="timeline-body">
                                            <div class="table-responsive">
                                                <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Produits</th>
                                                            <th>Qté à livrer</th>
                                                            <th>Qté livrée</th>
                                                            <th>Qté solde</th>
                                                            <th>Observations</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="produit_list">
                                                        <?php
                                                        $i=1;
                                                        foreach ($produits as $r) {
                                                            $solde = $r->quantite_cmd - $r->quantite_liv;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $r->designation; ?></td>
                                                            <td><?php echo $r->quantite_cmd; ?></td>
                                                            <td><?php echo $r->quantite_liv; ?></td>
                                                            <td><?php echo $solde; ?></td>
                                                            <td><?php echo $r->observation; ?></td>
                                                        </tr>
                                                       <?php $i++; } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <?php } ?>
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </div><!-- /.box-body -->
            </form>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
