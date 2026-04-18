
<?php
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tableau de bord</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <?php if (in_array('RHFSI', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                        <div class="col-lg-3 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Saisie Information</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=resemployes&do=add" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (in_array('RHLE', $_SESSION['actions']['code_actions']) || in_array('RHMIE', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                        <div class="col-lg-3 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Employés</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=resemployes&do=viewall" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (in_array('RHGPOINT', $_SESSION['actions']['code_actions'])) { ?>
                        <div class="col-lg-3 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Présence</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-chain"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=respointage&do=viewall" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ./col -->
                    <?php if (in_array('RHGS', $_SESSION['actions']['code_actions'])) { ?>
                        <div class="col-lg-3 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Sanction</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-crop"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=ressanction&do=listsanctemply" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ./col -->
                    <?php if (in_array('RHGC', $_SESSION['actions']['code_actions'])) { ?>
                        <div class="col-lg-3 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Congé</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=resconge&do=panelconge" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ./col -->
                    <?php if (in_array('RHGR', $_SESSION['actions']['code_actions'])) { ?>
                        <div class="col-lg-3 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Résiliation</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-external-link"></i>
                                </div>
                                <a href="#" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ./col -->
                    <?php if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Paie</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-star"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-fuchsia">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Avance sur salaire</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-th"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=resemprunt&do=view_av" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Prêt</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=resemprunt&do=view_pr" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    <?php } ?>
                    <?php if (in_array('RHGBM', $_SESSION['actions']['code_actions'])) { ?>
                        <div class="col-lg-3 col-md-6 hidden">
                            <!-- small box -->
                            <div class="small-box bg-olive">
                                <div class="inner">
                                    <br>
                                    <br>
                                    <h4>Bon de malade</h4>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-ambulance"></i>
                                </div>
                                <a href="<?php echo H_ADMIN; ?>&view=resbonmalade&do=viewall" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->