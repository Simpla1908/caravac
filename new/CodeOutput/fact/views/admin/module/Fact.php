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
                    <?php // if (in_array('RHFSI', $_SESSION['actions']['code_actions'])) { 
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <!-- small box -->
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">CLIENTS</span>
                                <span class="info-box-number"><?php echo FxNombreClient($_SESSION['idsite']); ?></span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <?php // } 
                    ?>
                    <?php // if (in_array('RHLE', $_SESSION['actions']['code_actions']) || in_array('RHMIE', $_SESSION['actions']['code_actions'])) { 
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">FACTURES CASH</span>
                                <span class="info-box-number"><?php $mode = "Cash";
                                                                echo FxNombreFacture($mode, $_SESSION['idsite']); ?></span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <?php // } 
                    ?>
                    <?php // if (in_array('RHGPOINT', $_SESSION['actions']['code_actions'])) { 
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  bg-red">
                            <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">FACTURES ACOMPTE</span>
                                <span class="info-box-number"><?php $mode = "Acompte";
                                                                echo FxNombreFacture($mode, $_SESSION['idsite']); ?></span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <?php // } 
                    ?>
                    <!-- ./col -->
                    <?php // if (in_array('RHGS', $_SESSION['actions']['code_actions'])) { 
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <!-- small box -->
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">FACTURES CREDIT</span>
                                <span class="info-box-number"><?php $mode = "Credit";
                                                                echo FxNombreFacture($mode, $_SESSION['idsite']); ?></span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <?php // } 
                    ?>
                    <!-- ./col -->


                    <!-- ./col -->

                    <?php // if (in_array('RHGBM', $_SESSION['actions']['code_actions'])) { 
                    ?>
                    <!--                        <div class="col-lg-3 col-md-6">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">SOLDE USD</span>
                                    <span class="info-box-number">41,410</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">
                                    </span>
                                </div>
                                 /.info-box-content 
                            </div>
                        </div>-->
                    <?php // } 
                    ?>
                </div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->