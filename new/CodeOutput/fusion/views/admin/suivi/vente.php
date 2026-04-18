<?php 
$bdd = HDB::hus();
$id = $_SESSION['company_id'];
$niveau = 1;
$date_bd1 =date('Y-m-d');
$date_bd2 =date('Y-m-d');;
DetailsVenteGlobal($id, $date_bd1, $date_bd2, $niveau, $bdd);
$nbre_rows = count($_SESSION['prod']['id']);
$sites=SiteInfos($id,$bdd);
$nbresite=count($sites['id']);
?>
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand"><b>ebutelo</b></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">

                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!-- User Account-->
                            <?php if (isset($_SESSION[H_USER_SESSION])) { ?>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">

                                        <img src="<?php echo NO_IMAGE; ?>" class="img-circle" alt="User Image" />
                                        <p>
                                            <?php echo $_SESSION['user']; ?>
                                            <small>Aujourd'hui <?php echo date('d/m/Y'); ?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo H_ADMIN; ?>&view=hsys_users2&do=details" class="btn btn-success btn-flat hidden"><?php echo LANG_PROFILE; ?></a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo H_LOGIN; ?>" class="btn btn-success btn-flat"><?php echo LANG_LOGOUT2; ?></a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper" id="bloc_view_main">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Vente <span id="descrpt"><?php echo 'du '.date('d/m/Y').' au '.date('d/m/Y'); ?></span>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
                    <li><a href="#"  data-toggle="modal" data-target="#modalfiltrerpaie">Filtrer</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <!--                    <div class="box-header with-border">
                                            <h3 class="box-title">Blank Box</h3>
                                        </div>-->
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active onglet_chambre"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Détails vente</a></li>
                                 <a href="#"  class="btn btn-default pull-right prtrappgl"><i class="fa fa-print"></i> Imprimer</a>
                                <!--<li class="onglet_service"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Factures</a></li>-->
                            </ul>
                            <div class="tab-content" id="viewbloc">
                               <?php include(APP_FOLDER.'/views/admin/suivi/dataventeglobal.php'); ?>
                            </div>
                            <!-- /.tab-content -->
                        </div> 
                    </div>
                    <!--<div style="margin-top:5px">
                            <a href="#"  class="btn btn-default pull-right prtrappgl"><i class="fa fa-print"></i> Imprimer</a>
                        </div>-->
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.3.8
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->
<!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfiltrerpaie" name="frmfiltrerpaie">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des ventes</h4>
                </div>
                <div class="modal-body text-center">
                    <form class="frmpaie">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">

                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="site">Site</label>
                                <select class=" col-md-5 form-control choz" name="site_id" id="site_id">
                                    <option value="0" nomsite="tout" niveau="1">tout</option>
                                    <?php for ($i = 0; $i <= $nbresite - 1; $i++){
                                       $id= $sites['id'][$i];
                                       $libelle= $sites['libelle'][$i];
                                       $niveau=$sites['niveau'][$i];
                                     ?>
                                        <option value="<?php echo $id ?>" nomsite="<?php echo $libelle ?>" niveau='<?php echo $niveau ?>'><?php echo $libelle ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <input name="niveau" id="niveau"  type="hidden" value="1">
                            <input name="nomsite" id="nomsite"  type="hidden" value="tout">
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                           
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group blcmp">
                                <label for="usd"> Du</label>
                                <input name="dte1" id="dte1" class="form-control datepicker2"  type="text" value="<?php  echo date('d/m/Y');?>">
                                au
                                <input name="dte2" id="dte2" class="form-control datepicker2"  type="text" value="<?php  echo date('d/m/Y');?>">
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button  class="btn btn-danger pull-right col-md-2" id="btnfiltrageglobal">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                    <span class="btn btn-info hidden pull-right" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->