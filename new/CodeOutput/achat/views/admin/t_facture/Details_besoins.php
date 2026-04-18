
<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
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
                <h3 class="box-title">Détails etat de besoins</h3>
                <ul class="nav pull-right">

                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=view_bon_cmd" class="btn btn-warning btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>

                    <!--<a href="#" title="<?php echo LANG_TIP_UPDATE; ?> Record" class="btn btn-primary btn-sm tip"><i class="fa fa-edit"></i> Modifier</a>-->

                    <!--<a href="#" title="<?php echo LANG_TIP_DELETE_ALL; ?>" class="btn btn-danger btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> Supprimer</a>-->
                    
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&id_fact=<?php echo $rows->id_fact; ?>&do=etat_besoins" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">N° Etat besoin</label>

                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo $rows->num_fact;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Founisseur</label>

                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo $rows->nom_entreprise;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Device</label>

                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo $rows->monnaie;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Description</label>

                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo $rows->justification;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-4 control-label">Date</label>

                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo dateAffiche($rows->date_edition);?></span>
                                </div>
                            </div>
                            <?php if($rows->date_approbation!=NULL){?>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-4 control-label">Date d'approbation</label>

                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo dateAffiche($rows->date_approbation);?></span>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Commande</a></li>
                                </ul>
                                <div class="tab-content no-border">
                                    <div class="tab-pane active" id="tab_1">
                                        <br>
                                        <div class="table-responsive">
                                            <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Désignation</th>
                                                        <th>Quantité</th>
                                                         <th>Unité</th>
                                                        <th>Prix unitaite</th>
                                                        <th>Sous-total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="produit_list">
                                                    <?php
                                                    $i=1;
                                                    $total=0;
                                                    foreach ($lignes_cmd as $r) {
                                                        $sous_tot= $r->qte * $r->prix;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $r->designation; ?></td>
                                                        <td><?php echo $r->qte; ?></td>
                                                         <td><?php echo $r->unite; ?></td>
                                                        <td><?php echo format_chiffre($r->prix); ?></td>
                                                        <td><?php echo format_chiffre($sous_tot); ?></td>
                                                    </tr>
                                                   <?php $i++; $total=$total + $sous_tot;} ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="5" align="right">Total</th>
                                                        <th><?php echo format_chiffre($total); ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- nav-tabs-custom -->
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </form>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
