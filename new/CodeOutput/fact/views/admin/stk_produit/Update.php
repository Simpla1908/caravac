<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		stk_produit
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=stk_produit&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />

            <!--<a href="<?php echo H_ADMIN; ?>&view=stk_produit&idprod=<?php echo $rows->idprod; ?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS; ?></a>-->

            <!--<a href="<?php echo H_ADMIN; ?>&view=stk_produit&idprod=<?php echo $rows->idprod; ?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE; ?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE; ?></a>-->

            <a href="<?php echo H_ADMIN; ?>&view=stk_produit&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-reorder"></i> Modification</h3>
            </div>
            <div class="panel-body">

                <div class="output"></div>
                <input type="hidden" name="idprod" value="<?php echo $rows->idprod; ?>">

                <div class="form-horizontal form-label-left">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="famille_id">Catégorie <span class="required">*</span>
                                </label>

                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="sous_famille_id" id="categorie_fact" class=" form-control styler choz">
                                        <option value='<?php echo $rows->categorie_id; ?>'> <?php echo $rows->categorie; ?></option>;
                                        <?php foreach ($sousfamilles  as $f) {
                                            if ($f->id_s_fam != $rows->categorie_id) {
                                        ?>
                                                <option value='<?php echo $f->id_s_fam; ?>'> <?php echo ucfirstText($f->des); ?></option>;
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <input id="fam_id" name="fam_id" class="" type="hidden">
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="code">Code<span class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="code" name="code" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $rows->code; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="designation">Désignation<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="designation" name="designation" value="<?php echo $rows->produit; ?>" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="tva">TVA<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <input id="tva" name="tva" value="<?php echo $rows->tva; ?>" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                        <span class="input-group-addon"><?php echo '%'; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group service1 hidden">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6 tip" for="qte_min" title="C'est la quantité pour signaler la rupture de stock ">Quantité min<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="qte_min" name="qte_min" value="<?php echo $rows->qte_min; ?>" class="form-control col-md-7 col-xs-12" required="required" type="text" value="1">
                                </div>
                            </div>
                            <div class="form-group service1 hidden">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="pa">Prix d'achat<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <input id="pa" name="pa" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $rows->pa; ?>">
                                        <span class="input-group-addon"><?php echo $_SESSION['Paie_insert']; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pv">Prix de vente<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <input id="pv" name="pv" value="<?php echo $rows->pv; ?>" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                        <span class="input-group-addon"><?php echo $_SESSION['Paie_insert']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



            </div>



        </div>
        <!--/col-12-->

</form>