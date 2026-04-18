<!DOCTYPE html>
<html lang="fr">

    <?php include('head.php'); ?>

    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>

                <?php include('Fonctions/fx_.php'); ?>
            </nav>
            <!-- /.navbar-top-links -->

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Configuration</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div id="msg_config" class="alert alert-success alert-dismissable" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span id="msg_alert_config">L'enrégistrement s'est effectué avec succès!</span>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Mise à jour</h4>
                            </div>
                            <div class="panel-body">
                                <BR>
                                <form id="form_config" method="post" action="Traitement/config_insertion.php" class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Monnaie Insertion <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <!--<input type="text" name="monnaieInsert" id="monnaieInsert" value="<?php echo $m_insert;?>" required class="form-control col-md-7 col-xs-12">-->
                                            <select class="form-control" id="monnaieInsert" name="monnaieInsert" required> 													<option>  </option>
                                                <option value="USD">USD</option>
                                                <option value="CDF">CDF</option>
                                                <option selected value="<?php echo $m_insert;?>"><?php echo $m_insert;?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Monnaie Affichage <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" id="monnaieAffich" name="monnaieAffich" required> 													<option>  </option>
                                                <option value="USD">USD</option>
                                                <option value="CDF">CDF</option>
                                                <option selected value="<?php echo $m_affiche;?>"><?php echo $m_affiche;?></option>
                                            </select>
                                            <!--<input type="text" name="monnaieAffich" id="monnaieAffich" value="<?php echo $m_affiche;?>" required class="form-control col-md-7 col-xs-12">-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Taux du jour <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="taux" id="taux" value="<?php echo $tauxdollar;?>" required class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tva">TVA <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="tva" id="tva" value="<?php echo $tva;?>" required class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group hidden">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="remise">Remise <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="remise" id="remise" value="<?php echo $remise;?>" required class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stock">Liaison Stock et Point de vente <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" id="stock" name="stock" required> 													<option>  </option>
                                                <?php if($_SESSION['stock']==1){?>
                                                    <option selected value="1">oui</option>
                                                    <option value="0">non</option>
                                                <?php }else{?>
                                                    <option selected value="1">oui</option>
                                                    <option value="0" selected>non</option>
                                                 <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                            <button type="submit" id="save_config" class="btn btn-success"><i class="fa fa-edit fa-fw"></i> Updade</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                    <!--                </form>-->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php include('footer.php'); ?>

    </body>

</html>
