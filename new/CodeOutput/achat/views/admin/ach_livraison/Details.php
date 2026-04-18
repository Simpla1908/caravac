
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

$_SESSION['fournisseur']=ucfirst($rows->nom_entreprise);
$_SESSION['num_bon']=$rows->num_cmd;
$_SESSION['num_bon_liv']=$rows->numBon_liv;
$_SESSION['id_liv']=$rows->id_fact;

$_SESSION['id_liv']=$rows->id_liv;
$_SESSION['first']=0;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Détails Livraison</h3>
                <ul class="nav pull-right">

                    <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>

                    <!--<a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=add" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>-->

                    <!--<a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=update" title="<?php echo LANG_TIP_UPDATE; ?> Record" class="btn btn-default btn-sm tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE; ?></a>-->

                    <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD; ?>" class="btn btn-default btn-sm tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>-->

                    <a  id="printlivraison" target="_blank" class="btn btn-primary btn-sm tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>

                    <!--<a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL; ?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
            <form class="form-horizontal">
                <div class="box-body">
                
                <div class="row">
                    <div class="col-md-10">
                        <br>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">N° Bon livraison</label>

                            <div class="col-sm-8">
                                : <span class="direct-chat-timestamp"><?php echo $rows->numBon_liv;?></span>
                            </div>
                        </div>
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
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 control-label">Date de livraison</label>

                            <div class="col-sm-8">
                                : <span class="direct-chat-timestamp"><?php echo dateAffiche($rows->date);?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Utilisateur</label>

                            <div class="col-sm-8">
                                : <span class="direct-chat-timestamp"><?php echo ucfirst($rows->nom_user.' '.$rows->prenom_user);?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Produits</a></li>
                            </ul>
                            <div class="tab-content no-border">
                                <div class="tab-pane active" id="tab_1">
                                    <br>
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
                                                foreach ($result as $r) {
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
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>
                </div>

            </div><!-- /.box-body -->
            </form>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
