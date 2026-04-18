
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
<?php
    if($rows->statut_bon=='envoye'){
        $statut='Etat de besoins';
        $color='bg-yellow';
        $visible='';
        $visible1='hidden';
    }  elseif ($rows->statut_bon=='paye') {
        $statut='Payé';
        $color='bg-black';
        $visible='hidden';
        $visible1='hidden';
    }  elseif ($rows->statut_bon=='attente') {
        $statut='En attente';
        $color='bg-green';
        $visible='hidden';
        $visible1='hidden';
    }elseif ($rows->statut_bon=='rejete') {
        $statut='Rejeté';
        $color='bg-red';
        $visible='hidden';
        $visible1='';
    }elseif ($rows->statut_bon=='approuve') {
        $statut='approuve';
        $color='bg-green';
        $visible='hidden';
        $visible1='';
    }
    ?>
<div class="row" id="contenue_update">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Détails bon de commande</h3>
                <ul class="nav pull-right">
                     <?php if (in_array('ACHAEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=approuve_commande" class="btn btn-success btn-sm tip <?php echo $visible;?>" title="Approuver cet état de besoin"><i class="fa  fa-check"></i> Approuver </a>
                    <?php } ?>
                    <?php if (in_array('ACHRTEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <!--<a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=retablir_commande" class="btn btn-success btn-sm tip <?php echo $visible1;?>" title="Retablir cet état de besoin"><i class="fa  fa-check"></i> Retablir </a>-->
                    <?php } ?>
                    <?php if (in_array('ACHREB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=rejete_commande" class="btn btn-danger btn-sm tip <?php echo $visible;?>" title="Rejeter cet état de besoin"><i class="fa  fa-close"></i> Rejeter </a>
                    <?php } ?>
                    <?php if (in_array('ACHMBC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { 
                        if (($rows->statut_bon !='approuve')) {?>
                    <!--<a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=update" class="btn btn-primary btn-sm tip" title="Modifier cet état de besoins"><i class="fa fa-edit"></i> Modifier</a>--> 
                    <?php }} ?>
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=view_commande" class="btn btn-warning btn-sm tip" title="Voir la liste"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a> 
                    <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=t_facture&id_fact=<?php // echo $rows->id_fact; ?>&do=export2&hexport=yes&etype=printer" title="Imprimer" target="_blank" class="btn btn-default btn-sm tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>-->
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&id_fact=<?php echo $rows->id_fact; ?>&do=numboncmd" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Satut</label>
                                <div class="col-sm-8">
                                    : <span class="badge <?php echo $color;?>"><?php echo $statut?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Etat de besoin N° </label>
                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo $rows->num_fact;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Bon commande N° </label>
                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo $rows->num_cmd;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Founisseur</label>

                                <div class="col-sm-8">
                                    : <span class="direct-chat-timestamp"><?php echo $rows->nom_entreprise;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Devise</label>

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
                                <label for="inputName" class="col-sm-4 control-label">Date de commande</label>

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
                              <div class="form-group">
                                <label for="inputName" class="col-sm-4 control-label">Mode de paiement</label>

                                <div class="col-sm-8">
                                 <select id="modepaiement" name="mode" class="form-control choz">
                                        <option value="cash">Cash</option>
                                        <option value="credit">Credit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Commande</a></li>
                                    <div class="status alert alert-danger col-md-9" id='msg2' style="display:none">
                                        <i class="fa fa-info-circle"></i> Veuillez remplir ces champs vides
                                    </div>
                                </ul>
                                <div class="tab-content no-border">
                                    <div class="tab-pane active" id="tab_1">
                                        <br>
                                        <input type="hidden" name="id_fact" id="id_fact" value="<?php echo $id_fact;?>">
                                        <div class="table-responsive" id="tableau_cmd">
                                          <?php include(APP_FOLDER.'/views/admin/t_facture/produits_update.php');?>
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
