
<?php
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Trésorerie</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <?php // if (in_array('ACHLEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>300</h3>
                                <h4>Etat de besoins</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=view_bon_cmd" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php // } ?>
                    <?php // if (in_array('ACHLBC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>44</h3>
                                <h4>Bon de commande</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=view_commande" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <?php // } ?>
                    <?php // if (in_array('ACHLPBC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>65</h3>
                                <h4>Paiement</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tags"></i>
                            </div>
                            <a href="<?php echo H_ADMIN; ?>&view=paiement&do=view_paiement" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <?php // } ?>
                    <?php // if (in_array('ACHLL', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>300</h3>
                                <h4>Livraison</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-truck"></i>
                            </div>
                            <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=viewall" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <?php // } ?>
                    <?php // if (in_array('ACHLF', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3>53</h3>
                                <h4>Fournisseur</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-times"></i>
                            </div>
                            <a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <?php // } ?>
                </div>
                <!-- /.row -->

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->