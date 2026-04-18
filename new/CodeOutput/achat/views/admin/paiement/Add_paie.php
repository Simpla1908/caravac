
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		paiement
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=paiement&do=addpro'; ?>" method="post" name="hezecomform" class="form-horizontal" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=paiement&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Enregistrer paiement</h3></div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-10">
                        <br>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">N° Bon de commande</label>

                            <div class="col-sm-8">
                                <select class="form-control choz" id="num_bon" name="num_bon" style="width: 100%;">
                                    <option>Selectionnez</option>
                                    <?php
                                    foreach ($bons as $rows) {
                                    ?>
                                        <option value="<?php echo $rows->id_fact; ?>"><?php echo $rows->num_fact; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Founisseur</label>

                            <div class="col-sm-8">
                                <select class="form-control choz" id="founisseur_id" name="founisseur_id" style="width: 100%;">
                                    <option>Selectionnez</option>
                                    <?php
                                    foreach ($fournisseurs as $rows) {
                                    ?>
                                        <option value="<?php echo $rows->id_client; ?>"><?php echo $rows->nom_entreprise; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Mode paiement</label>

                            <div class="col-sm-8">
                                <select class="form-control">
                                    <option>Selectionnez</option>
                                    <option value="usd">CASH</option>
                                    <option value="cdf">CREDIT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Montant</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputPassword3" placeholder="Montant">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Devise</label>

                            <div class="col-sm-8">
                                <select class="form-control">
                                    <option>Selectionnez</option>
                                    <option value="usd">USD</option>
                                    <option value="cdf">CDF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>

        </div><!--/col-12-->

</form>
