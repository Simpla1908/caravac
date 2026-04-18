
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	09-07-2018
 * FOR TABLE:  		ach_livraison
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');


$_SESSION['livraison'] = array();
$_SESSION['livraison']['produit_id'] = array();
$_SESSION['livraison']['designation'] = array();
$_SESSION['livraison']['qte_attendue'] = array();
$_SESSION['livraison']['qte_recue'] = array();
$_SESSION['livraison']['observation'] = array();
$_SESSION['livraison']['commande_id'] = array();
$_SESSION['livraison']['qte_cmd'] = array();

?>


<form action="<?php echo H_ADMIN_MAIN . '&view=ach_livraison&do=addliv'; ?>" method="post" name="hezecomform" class="form-horizontal" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
<!--            <label for="hButton" class="btn btn-danger btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />-->

            <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Livraison</h3></div>

            <div class="panel-body">
                <div class="output"></div>
                <div class="row">
                    <div class="col-md-10">
                        <br>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Founisseur</label>

                            <div class="col-sm-8">
                                <select class="form-control choz" id="liv_founisseur_id" name="liv_founisseur_id" style="width: 100%;">
                                    <option>Selectionnez</option>
                                    <?php
                                    foreach ($fournisseurs as $rows) {
                                        ?>
                                        <option value="<?php echo $rows->id_client; ?>"><?php echo $rows->nom_entreprise; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div id="boncommande_bloc">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Bon commande</label>

                            <div class="col-sm-8" id="boncommande_bloc2">
                                <select class="form-control choz" id="boncommande_id" name="boncommande_id">
                                    <option>Selectionnez</option>
                                    <?php
//                                    foreach ($bons as $rows) {
                                        ?>
                                        <option value="<?php // echo $rows->id_fact; ?>"><?php // echo $rows->num_fact; ?></option>
                                    <?php // } ?>
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <br><br>
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Les produits commandés</a></li>
                                <div class="status alert alert-danger col-md-9" id='msg2' style="display:none">
                                    <i class="fa fa-info-circle"></i> Veuillez remplir ces champs vides
                                </div>
                            </ul>
                            <div class="tab-content no-border" id="produits_bloc">
                                <div class="tab-pane active" id="tab_1">
                                    <br>
                                    <div class="table-responsive">
                                        <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Produits</th>
                                                    <th>Quantité à livrais</th>
                                                    <th>Quantité livrée</th>
                                                    <th>Observation</th>
                                                </tr>
                                            </thead>
                                            <tbody id="fiche_tranfert">
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
            </div>
            <!-- /.box-body -->

            <div class="panel-footer" style="border-bottom:solid 2px #CCC;">
                <button class="btn btn-danger" id="save_liv"><i class="fa fa-floppy-o"></i> Valider</button>
<!--                <label for="hButton" class="btn btn-danger" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />-->
            </div>

        </div><!--/col-12-->

</form>
