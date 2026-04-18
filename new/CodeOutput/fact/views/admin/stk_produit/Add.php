<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		stk_produit
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
$tva = 0;
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=stk_produit&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=stk_produit&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-reorder"></i> Ajout service</h3>
            </div>
            <div class="panel-body">
                <div class="output"></div>
                <input id="p" name="p" value="<?php echo get('p'); ?>" type="hidden">
                <div class="form-horizontal form-label-left">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="famille_id">Catégorie <span class="required">*</span>
                                </label>

                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="sous_famille_id" id="categorie_fact" class=" form-control styler choz">
                                        <option value='' vendable='0'>Sélectionner</option>;
                                        <?php foreach ($sousfamilles  as $f) { ?>
                                            <option value='<?php echo $f->id_s_fam; ?>'> <?php echo ucfirstText($f->des); ?></option>;
                                        <?php } ?>
                                    </select>
                                </div>

                                <input id="fam_id" name="fam_id" class="" type="hidden">
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="code">Code<span class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="code" name="code" class="form-control col-md-7 col-xs-12" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="designation">Désignation<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="designation" name="designation" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                </div>
                            </div>
                            <!--                            <div class="form-group service">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="unite">Unité <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="unite" id="unite" class=" form-control styler choz">
                                        <option value="piece">Pièce</option>
                                        <option value="kg">Kilogramme</option>
                                        <option value="l">Litre</option>
                                        <option value="cl">Centilitre</option>
                                        <option value="g">Gramme</option>
                                        <option value="Portion">Portion</option>
                                        <option value="Ekolo">Ekolo</option>
                                        <option value="Mesurette">Mesurette</option>
                                        <option value="Filet">Filet</option>
                                        <option value="Verre">Verre</option>
                                        <option value="Sakombi">Sakombi</option>
                                        <option value="Boite">Boite</option>
                                        <option value="Paquet">Paquet</option>
                                        <option value="Sachet">Sachet</option>
                                        <option value="Carton">Carton</option>
                                    </select>
                                </div>
                            </div>-->

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="tva">TVA<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <input id="tva" name="tva" value="<?php echo $tva; ?>" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                        <span class="input-group-addon"><?php echo '%'; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group service1 hidden">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6 tip" for="qte_min" title="C'est la quantité pour signaler la rupture de stock ">Quantité min<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="qte_min" name="qte_min" class="form-control col-md-7 col-xs-12" required="required" type="text" value="1">
                                </div>
                            </div>
                            <div class="form-group service1 hidden">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="pa">Prix d'achat<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <input id="pa" name="pa" class="form-control col-md-7 col-xs-12" required="required" type="text" value="0">
                                        <span class="input-group-addon"><?php echo $_SESSION['Paie_insert']; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pv">Prix de vente<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <input id="pv" name="pv" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                        <span class="input-group-addon"><?php echo $_SESSION['Paie_insert']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <input id="hotel_id" name="hotel_id" type="hidden" maxlength="11" value="<?php echo $_SESSION['idsite']; ?>" />
                            <input id="monnaie" name="monnaie" type="hidden" maxlength="11" value="<?php echo $_SESSION['Paie_insert']; ?>" />
                            <input id="repas" name="repas" type="hidden" maxlength="11" value="0" />

                        </div>
                    </div>

                </div>
            </div>
            <!--            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>-->



        </div>
        <!--/col-12-->

</form>


<!-- Modal -->
<div class="modal fade" id="modalfam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="col-sm-12">

                            <div class="form-group ancien">
                                <label for="inputName" class="col-sm-3 control-label">Catégorie</label>
                                <div class="col-sm-9">
                                    <input id="famille" name="famille" type="text" value="" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-danger pull-right col-md-2" id="btn_vld_categorie"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
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