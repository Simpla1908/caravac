<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Parametrage des plats
        <span class="text-danger loader hidden">
            <i class="fa fa-refresh fa-spin fa-1x"></i>
        </span>
    </h1>
</section>
<section class="content">
    <div class="container">
        <div class="box">
            <!--<div class="box-header">
                <h3 class="box-title">Factures</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Plat</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Famille</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Sous-famille</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Cuisson</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Sauces</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Fiches techniques</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="col-lg-5">
                                        <h3 class="box-title">
                                            Liste des Plats
                                        </h3>
                                    </div>
                                    <div class="col-lg-5">

                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <a class="btn-xs btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" id="ajouter111">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel box box-default" id="ajout">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a>
                                                        Ajout d'un plat
                                                    </a>
                                                </h4>
                                            </div>
                                            <form id="form_insert_plat" action="Traitement/produit_insertion.php" method="post">
                                                <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert; ?>">
                                                <input class="form-control hidden" name="plat" id="plat" value="1">
                                                <input type="hidden" name="venteprod" value="plat">
                                                <input type="hidden" name="repas" value="1">
                                                <div class="box-body">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Famille</label>
                                                                <select class="form-control" id="famille_id" name="famille_id" required>
                                                                    <option> </option>
                                                                    <?php
                                                                    foreach ($familles  as $f) :
                                                                        echo '<option value=' . $f->idfamille . '>' . ucfirst($f->designation) . '</option>';
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <!-- /.form-group -->
                                                            <div class="form-group">
                                                                <label>Sous-Famille</label>
                                                                <select class="form-control" id="s_famille_id" name="s_famille_id" required>
                                                                    <option> </option>
                                                                </select>
                                                            </div>
                                                            <!-- /.form-group -->
                                                            <div class="form-group">
                                                                <label>Designation</label>
                                                                <input class="form-control col-md-7 col-xs-12" id="libelle" name="libelle">
                                                            </div>
                                                            <!-- /.form-group -->
                                                            <div class="form-group">
                                                                <label>Code</label>
                                                                <input class="form-control col-md-7 col-xs-12" id="code" name="code">
                                                                <input class="form-control col-md-7 col-xs-12 hidden" value="unite" id="unite" name="unite">
                                                            </div>
                                                            <!-- /.form-group -->
                                                            <div class="form-group hidden">
                                                                <label>Prix de vente</label>
                                                                <div class="form-group input-group">
                                                                    <input class="form-control" name="prix_vente" id="prix_vente" value="0">
                                                                    <input name="pos_id" id="pos_id" value="<?php echo $_SESSION['id_sousresto']; ?>">
                                                                    <span class="input-group-addon"> <?php echo $m_insert; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Prix de vente</label>
                                                                <div class="form-group input-group">
                                                                    <?php
                                                                    $i = 1;
                                                                    foreach ($depot as $dep) {
                                                                        if ($dep->id_sousresto == $_SESSION['id_sousresto']) {
                                                                    ?>
                                                                            <input class="form-control prix_vente_site" name="prix_vente_site[]" value="">
                                                                            <input class="form-control hidden" name="sousresto_id[]" id="sousresto_id" value="<?php echo $dep->id_sousresto ?>">
                                                                            <span class="input-group-addon"> <?php echo $m_insert; ?></span>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <!-- <input type="file" id="imgInp" name="image" class="form-control col-md-7 col-xs-12"> -->
                                                                <div class="input-group col-md-11 col-sm-11 col-xs-12">
                                                                    <span class="input-group-btn">
                                                                        <span class="btn btn-primary btn-file">
                                                                            Parcourir <input type="file" id="imgInp" name="image">
                                                                        </span>
                                                                    </span>
                                                                    <input type="text" class="form-control" id="fichier" readonly2>

                                                                </div>
                                                                <br>
                                                                <img id='img-upload' width="100" height="100" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Vendre en cas de rupture en stock</label>
                                                                <select class="form-control" id="vendrerupturestk" name="vendrerupturestk" required>
                                                                    <option value="0">Oui</option>
                                                                    <option value="1">Non</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-md-6">
                                                            <div class="box-header with-border">
                                                                <h4 class="box-title">
                                                                    <a>
                                                                        OFFRE
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="accompagnement" type="checkbox" value="1">Accompagnement</label>
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="legume" type="checkbox" value="1">Legume</label>
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="sauce" type="checkbox" value="1">Sauce</label>
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="cuisson" type="checkbox" value="1">Cuisson</label>
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="cond" type="checkbox" value="1">Conditionnement</label>
                                                            </div>
                                                            <div class="col-md-12  hidden" style="margin-top: 20px;">
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="biere" type="checkbox" value="">Soft plastique</label>
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="softplast" type="checkbox" value="1">Soft bouteille</label>
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="softbtl" type="checkbox" value="">Biere</label>
                                                                <label class="checkbox-inline" style=" font-size: 17px; "><input name="vin" type="checkbox" value="">Vin maison</label>
                                                            </div>

                                                        </div>
                                                        <br> <br>
                                                        <div class="col-md-6">
                                                            <div class="box-header with-border">
                                                                <h4 class="box-title">
                                                                    <a>
                                                                        FICHE TECHNIQUE
                                                                    </a>
                                                                    <a id="addFCH" class="btn btn-primary btn-sm" href="#" title="Ajouter" data-toggle="modal" data-target="#myModaladdFch">

                                                                        <i class="fa fa-plus-circle"></i> Produit
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <!-- Tab panes -->
                                                            <div class="tab-content" id="bloc_actions">
                                                                <br>
                                                                <div class="tab-pane active" id="tabFCH">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="table-responsive">
                                                                                <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>PRODUIT</th>
                                                                                            <th>QTE</th>
                                                                                            <th>UNITE</th>
                                                                                            <th>CR (USD)</th>
                                                                                            <th>
                                                                                                <div class="tools text-center">
                                                                                                    <a href="#" title="Selectionner & Supprimer" id="btn_supp" class="text-danger"><i class="fa fa-trash-o"></i></a>
                                                                                                </div>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="fiche_technique">

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <!-- /.table-responsive -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <div class="box-footer">
                                                    <div class="col-md-9">
                                                        <div id="msg" class="alert alert-success alert-dismissable" style=" text-align: center; display: none">
                                                            <i class='fa fa-warning fa-fw'></i> <span id="msg_alert"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit" class="btn btn-danger pull-right" id="save_produit"><i class="fa fa-save fa-fw"></i>&nbsp;Enregistrer
                                                        </button>
                                                        <span class="text-danger loader hidden">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                        </span>
                                                    </div>
                                                </div>

                                            </form>
                                            <!-- /.box-footer -->
                                        </div>

                                        <?php // }  
                                        ?>
                                    </div>
                                    <div class="box" id="view_plat">
                                        <?php include($pathview . 'plat/view_plat.php'); ?>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="col-lg-5">
                                        <h3 class="box-title">
                                            Liste des Familles
                                        </h3>
                                    </div>
                                    <div class="col-lg-5">
                                        <span class="text-danger hidden" id="loader_affich1">
                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement...
                                        </span>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <a class="btn-xs btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwofam" id="ajouterfam111">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="collapseTwofam" class="panel-collapse collapse">
                                        <div class="panel box box-default" id="ajout">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a>
                                                        Ajout d'une famille
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="box-body">
                                                <form id="formfam" method="post" action="Traitement/famille_insertion.php" data-parsley-validate class="form-horizontal form-label-left">
                                                    <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Désignation <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" name="designation" id="designation" required class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>

                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                                            <button type="submit" id="save_fam" class="btn btn-success">Sauvegarder</button>
                                                            <span class="btn btn-info hidden" id="loader_fam">
                                                                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="msg1" class="alert alert-success alert-dismissable" style="display:none;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <span id="msg_alert1">Succès!</span>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.box-footer -->
                                        </div>

                                        <?php // }  
                                        ?>
                                    </div>
                                    <div class="box" id="view_famille">
                                        <?php include($pathview . 'plat/view_famille.php'); ?>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="col-lg-5">
                                        <h3 class="box-title">
                                            Liste des Sous-familles
                                        </h3>
                                    </div>
                                    <div class="col-lg-5">
                                        <span class="text-danger hidden" id="loader_affich2">
                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement...
                                        </span>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <a class="btn-xs btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo_sfam" id="ajouter_sfam111">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="collapseTwo_sfam" class="panel-collapse collapse">
                                        <div class="panel box box-default" id="ajout">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a>
                                                        Ajout d'une sous-famille
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="box-body">
                                                <form id="form_sfam" method="post" action="Traitement/sous_famille_insertion.php" data-parsley-validate class="form-horizontal form-label-left">
                                                    <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Famille <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control" id="famille_sfam_id" name="famille_id" required>
                                                                <option> </option>
                                                                <?php
                                                                foreach ($familles as $f) :
                                                                    echo '<option value=' . $f->idfamille . '>' . $f->designation . '</option>';
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Désignation <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" name="designation" id="designation_sfam" required class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>

                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                                            <button type="submit" id="save_sous_famille" class="btn btn-success">Sauvegarder</button>
                                                            <span class="btn btn-info hidden" id="loader_sfam">
                                                                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="msg2" class="alert alert-success alert-dismissable" style="display:none;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <span id="msg_alert2">Succès!</span>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.box-footer -->
                                        </div>

                                        <?php // }  
                                        ?>
                                    </div>
                                    <div class="box" id="view_sousfamille">
                                        <?php include($pathview . 'plat/view_sousfamille.php'); ?>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.tab-pane -->

                        <!-- Cuisson -->
                        <div class="tab-pane" id="tab_4">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="col-lg-5">
                                        <h3 class="box-title">
                                            Liste des cuissons
                                        </h3>
                                    </div>
                                    <div class="col-lg-5">
                                        <span class="text-danger hidden" id="loader_affich1">
                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement...
                                        </span>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <a class="btn-xs btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwocuisson" id="ajouterfam111">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="collapseTwocuisson" class="panel-collapse collapse">
                                        <div class="panel box box-default" id="ajout">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a>
                                                        Ajout Cuisson
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="box-body">
                                                <form id="formcuisson" method="post" action="Traitement/cuisson_insert.php" data-parsley-validate class="form-horizontal form-label-left">
                                                    <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Designation <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="hidden" name="etat_detplat" id="etat_detplat" value="0">
                                                            <input type="text" name="designation" id="designation" required class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>

                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                                            <button type="submit" id="save_cuisson" class="btn btn-success">Sauvegarder</button>
                                                            <span class="btn btn-info hidden" id="loader_cuisson">
                                                                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="msg145" class="alert alert-success alert-dismissable" style="display:none;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <span id="msg_alert_cuisson">Succès!</span>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.box-footer -->
                                        </div>

                                        <?php // }  
                                        ?>
                                    </div>
                                    <div class="box" id="view_cuisson">
                                        <?php include($pathview . 'plat/view_cuisson.php'); ?>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.tab-pane -->
                        <!--Fin  Cuisson -->
                        <!-- SAUCE -->
                        <div class="tab-pane" id="tab_5">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="col-lg-5">
                                        <h3 class="box-title">
                                            Liste des sauces
                                        </h3>
                                    </div>
                                    <div class="col-lg-5">
                                        <span class="text-danger hidden" id="loader_sauce">
                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement...
                                        </span>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <a class="btn-xs btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwosauce" id="ajouterfam111">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="collapseTwosauce" class="panel-collapse collapse">
                                        <div class="panel box box-default" id="ajout">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a>
                                                        Ajout Sauce
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="box-body">
                                                <form id="formsauce" method="post" action="Traitement/cuisson_insert2.php" data-parsley-validate class="form-horizontal form-label-left">
                                                    <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Designation <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="hidden" name="etat_detplat" id="etat_detplat" value="1">
                                                            <input type="text" name="designation" id="designation" required class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>

                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                                            <button type="submit" id="save_sauce" class="btn btn-success">Sauvegarder</button>
                                                            <span class="btn btn-info hidden" id="loader_sauce">
                                                                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="msg1454" class="alert alert-success alert-dismissable" style="display:none;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <span id="msg_alert_sauce">Succes!</span>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.box-footer -->
                                        </div>

                                        <?php // }  
                                        ?>
                                    </div>
                                    <div class="box" id="view_sauce">
                                        <?php include($pathview . 'plat/view_sauce.php'); ?>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- FICHE TECHNIQUE -->
                        <div class="tab-pane" id="tab_6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="col-lg-5">
                                        <h3 class="box-title">
                                            Fiches techniques
                                        </h3>
                                    </div>
                                    <div class="col-lg-5">
                                        <span class="text-danger hidden" id="loader_fiche">
                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement...
                                        </span>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <button type="button" id="print_fich_tech" class="btn btn-success">IMPRIMER</button>
                                        <a class="btn-xs btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwofiche" id="ajouterfam11178856">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="collapseTwofiche" class="panel-collapse collapse">
                                        <div class="panel box box-default" id="ajout">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a>
                                                        Filtrage
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="box-body">
                                                <form id="formsauce" method="post" action="Traitement/cuisson_insert2.php" data-parsley-validate class="form-horizontal form-label-left">
                                                    <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Sous-famile
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control" id="fich_sfamid" name="fich_sfamid" required>
                                                                <option value="0">Tout</option>
                                                                <?php
                                                                $famille_id = 18;
                                                                $requete = $bdd->prepare("SELECT * FROM stk_sous_famille AS f"
                                                                    . " WHERE f.hotel_id=:hotel_id AND f.famille=:famille_id AND pseudo_supp=0 ORDER BY des");
                                                                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                                                $requete->BindParam(':famille_id', $famille_id);
                                                                $requete->execute();
                                                                $s_familles = $requete->fetchAll(PDO::FETCH_OBJ);
                                                                foreach ($s_familles as $f) :
                                                                    echo '<option value=' . $f->id_s_fam . '>' . $f->des . '</option>';
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <!-- /.box-footer -->
                                        </div>

                                        <?php // }  
                                        ?>
                                    </div>
                                    <div class="box" id="view_fiche_technic">
                                        <?php include($pathview . 'plat/view_fiches.php');
                                        ?>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!-- /.box-body -->
        </div>
    </div>

</section>
<!-- Modal -->
<div class="modal fade" id="myModaladdFch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Fiche technique | Ajout produit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Produits</label>
                    <select class="form-control" id="ingred_id" name="ingred_id" required>
                        <option> </option>
                        <?php
                        include('./Traitement/ingredients_combo.php');
                        foreach ($ingredients  as $ing) :
                            echo '<option pa=' . $ing->pa . ' value=' . $ing->idprod . '>' . ucfirst($ing->designation) . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Quantite</label>
                    <input class="form-control col-md-7 col-xs-12" id="qte_ingred" name="qte_ingred" value="1">
                </div>
                <!-- /.form-group -->
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Unite</label>
                    <select class="form-control" id="unite_ingred" name="unite_ingred">

                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Prix</label>
                    <div class="form-group input-group">
                        <input class="form-control" name="prix_ingred" id="prix_ingred" value="" disabled="disabled">
                        <span class="input-group-addon"> <?php echo $m_insert; ?></span>
                    </div>
                </div>
                <!-- /.form-group -->

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>

                <button class="btn btn-danger pull-right" id="add_ingred"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;AJOUTER
                </button>
                <span class="btn btn-info hidden pull-right" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Small modal Suppression -->
<div class="modal fade" id="myModalSupp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Suppression</h4>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer cet élément ?</p>
                <form id="frm_sup_art" class="hidden">
                    <input type="text" name="id_art" id="id_art" value="">
                    <input type="text" name="p" id="p" value="">
                    <input type="text" name="d" id="d" value="">
                    <input type="text" name="maj" id="maj" value="">
                    <input type="text" name="ss" id="ss" value="">
                    <input type="text" name="view" id="view" value="">
                    <input type="text" name="tbl" id="tbl" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btdl" data-dismiss="modal">Non</button>
                <button type="button" class="btn btn-danger btn_delete btdl">Oui</button>
                <span class="btn btn-info hidden pull-right" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModaladdACC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout accompagnement</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Produits</label>
                    <select class="form-control" id="accomp_id" name="accomp_id" required>
                        <option> </option>
                        <?php
                        include('./Traitement/ingredients_combo.php');
                        foreach ($ingredients  as $ing) :
                            echo '<option value=' . $ing->idprod . '>' . ucfirst($ing->designation) . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Unite</label>
                    <select class="form-control" id="unite_accomp" name="unite_accomp">

                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Quantite</label>
                    <input class="form-control col-md-7 col-xs-12" id="qte_accomp" name="qte_accomp">
                </div>
                <!-- /.form-group -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btdl" data-dismiss="modal">FERMER</button>
                <button class="btn btn-danger pull-right" id="btn_accomp"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;AJOUTER
                </button>
                <span class="btn btn-info hidden pull-right" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModaladdcuisson" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout cuisson</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nom</label>
                    <select class="form-control" id="cuisson_id" name="accomp_id" required>
                        <option> </option>
                        <?php
                        foreach ($details_plats  as $ing) :
                            if ($ing->etat == 0) {
                                echo '<option value=' . $ing->id . '>' . ucfirst($ing->nom) . '</option>';
                            }
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btdl" data-dismiss="modal">FERMER</button>
                <button class="btn btn-danger pull-right" id="btn_cuisson"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;AJOUTER
                </button>
                <span class="btn btn-info hidden pull-right" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModaladdsauce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout Sauce</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nom</label>
                    <select class="form-control" id="sauce_id" name="accomp_id" required>
                        <option> </option>
                        <?php
                        foreach ($details_plats  as $ing) :
                            if ($ing->etat == 1) {
                                echo '<option value=' . $ing->id . '>' . ucfirst($ing->nom) . '</option>';
                            }
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btdl" data-dismiss="modal">FERMER</button>
                <button class="btn btn-danger pull-right" id="btn_sauce"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;AJOUTER
                </button>
                <span class="btn btn-info hidden pull-right" id="loader_sauce">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>