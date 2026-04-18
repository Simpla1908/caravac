
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
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
$_SESSION['commande'] = array();
$_SESSION['commande']['produit_id'] = array();
$_SESSION['commande']['designation'] = array();
$_SESSION['commande']['qte_dispo'] = array();
$_SESSION['commande']['prix_unit'] = array();
$_SESSION['commande']['sous_tot'] = array();
$_SESSION['commande']['unite'] = array();
$_SESSION['artsup'] = array();
$_SESSION['artsup']['id_art'] = array();
if (get('action')=='commande') {
    $titre='bon de commande';
    $commande=1;
}  else {
    $titre='etat de besoins';
    $commande=0;
}
?>
<form action="<?php echo H_ADMIN_MAIN . '&view=t_facture&do=add_besoins'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data" class="form-horizontal frm_add_besoins">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-danger btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden btn_add_besoins" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=view_commande" class="btn btn-default btn-sm tip" title="Voir la liste"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Création <?php echo $titre; ?></h3></div>
            <div class="panel-body">

                <div class="output_add_besoins"></div>

                <div class="row">
                    <div class="col-md-10">
                        <br>
                        <div class="form-group">
                            <label for="founisseur" class="col-sm-4 control-label">Founisseur</label>

                            <div class="col-sm-8">
                                <select class="form-control choz" id="founisseur_id" name="founisseur_id" style="width: 100%;">
                                    <option value="">Selectionnez</option>
                                    <?php
                                    foreach ($fournisseurs as $rows) {
                                        ?>
                                        <option value="<?php echo $rows->id_client; ?>"><?php echo $rows->nom_entreprise; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="device" class="col-sm-4 control-label">Devise</label>

                            <div class="col-sm-8">
                                <select class="form-control choz" id="device" name="device">
                                    <option value="USD">USD</option>
                                    <option value="CDF">CDF</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-4 control-label">Description</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_cmd" class="col-sm-4 control-label">Date de commande</label>

                            <div class="col-sm-8">
                                <input type="text" disabled="disabled" class="form-control" value="<?php echo date('d/m/Y'); ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask >
                                <input type="text" class="form-control datepicker2 hidden" id="date_cmd" name="date_cmd" value="<?php echo date('d/m/Y'); ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask >
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
                            </ul>
                            <div class="tab-content no-border">
                                <div class="tab-pane active" id="tab_1">
                                    <a href="#" data-toggle="modal" data-target="#modalproduit" class="btn btn-primary btn-sm md_add_prod"><i class="fa fa-plus-circle"></i> Ajouter un article</a>
                                    <br><br>
                                    <div class="table-responsive">
                                        <form  id="formlistprod" method="post" name="formlistprod">
                                        <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Désignation</th>
                                                    <th>Quantité</th>
                                                    <th>Unité</th>
                                                    <th>Prix unitaite</th>
                                                    <th>Sous-total</th>
                                                    <th>
                                            <div class="tools text-center">
                                                <a href="#" title="Selectionner & Supprimer" id="btn_supp" class="text-danger"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                            </th>
                                            </tr>
                                            </thead>
                                            <tbody id="produit_list">
                                                
                                            </tbody>
                                        </table>
                                         </form>
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
                <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                    <label for="hButton" class="btn btn-danger" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                    <input type="submit" name="button" id="hButton" class="hidden btn_add_besoins" value="<?php echo LANG_CREATE_RECORD; ?>" />
                </div>
            </div><!--/col-12-->
        <input id="id_hotel" name="id_hotel" type="hidden"  value="<?php echo $_SESSION['idsite']; ?>" />
        <input id="id_user" name="id_user" type="hidden"  value="<?php echo $_SESSION['id_user']; ?>" />
        <input id="company_id" name="company_id" type="hidden" value="<?php echo $_SESSION['company_id']; ?>" />
        <input id="commande" name="commande" type="hidden" value="<?php echo $commande; ?>" />
</form>




<!-- Modal -->
<div class="modal fade" id="modalproduit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajouter un article</h4>
            </div>
            <div class="modal-body">
            <div class="output_add_prod"></div>

                <form class="form-horizontal">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Désignation" class="col-sm-2 control-label">Désignation</label>
                            <div class="col-sm-10">
                                <select class="form-control choz" style="width: 100%;" id="produit_id" name="produit_id" required>
                                    <option value="">Selectionnez</option>
                                    <?php
                                    foreach ($produits as $rows) {
                                        ?>
                                        <option unite="<?php echo $rows->unite; ?>" value="<?php echo $rows->idprod; ?>"><?php echo $rows->designation; ?></option>
                                    <?php } ?>
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label for="Quantite" class="col-sm-2 control-label">Quantité</label>
                            <div class="col-sm-10">
                                <input id="qte_dispo" name="qte_dispo" type="text" maxlength="245"  value="" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="unite" class="col-sm-2 control-label">Unité</label>
                            <div class="col-sm-10">
                                <input  type="text" maxlength="245"  value="" class="form-control unite" disabled="">
                                <input id="unite"  name="unite" type="hidden"   value="" class="form-control unite">
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">P.U</label>
                            <div class="col-sm-10">
                                <div class="input-group"> 
                                  <input id="prix_unit" name="prix_unit" type="text" maxlength="245"  value="" class="form-control">
                                   <span class="input-group-addon mon_af">USD</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
                </form>    
            </div>
            <div class="modal-footer">
                <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                </div>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button  class="btn btn-primary pull-right col-md-2"
                         id="add_prod"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
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
<!-- /.modal -->