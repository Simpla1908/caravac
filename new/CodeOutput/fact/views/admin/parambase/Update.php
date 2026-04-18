<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	08-02-2018
 * FOR TABLE:  		resconfig
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=parambase&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;margin-right:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="btnconfigfactrtn hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-reorder"></i></h3>
            </div>
            <div class="panel-body">

                <div class="output"></div>

                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <input type="hidden" name="site_id" value="<?php echo $site_id; ?>">
                            <div class="form-group">
                                <label for="nomcomp" class="col-sm-3 control-label">Entreprise</label>
                                <div class="col-sm-9">
                                    <input id="nomcomp" name="nomcomp" type="text" value="<?php echo $rows->nom_hotel; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label tip" title="Choisissez le logo de l'Entreprise">Logo</label>
                                <div class="col-sm-9">
                                    <input id="logo" name="logo" type="file" /><br><?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?><a href="#"><img src="<?php echo THUMB_FOLDER . $rows->logo; ?>"></a><br><?php } ?>
                                    <?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?>
                                        <a href="<?php echo H_ADMIN; ?>&view=resconfig&id=<?php echo $rows->id; ?>&dfile=<?php echo $rows->logo; ?>&do=delete&fdel=file" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><span class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> <?php echo LANG_DELETE; ?></span></a><br><?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="adrcomp" class="col-sm-3 control-label tip" title="Adresse de la compagnie">Adresse</label>
                                <div class="col-sm-9">
                                    <input id="adrcomp" name="adrcomp" type="text" value="<?php echo $rows->adresse_hotel; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ville" class="col-sm-3 control-label tip" title="Adresse de la compagnie">Ville</label>
                                <div class="col-sm-9">
                                    <input id="ville" name="ville" type="text" value="<?php echo $rows->ville_hotel; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tel" class="col-sm-3 control-label tip">Télephone</label>
                                <div class="col-sm-9">
                                    <input id="tel" name="tel" type="text" value="<?php echo $rows->phone; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mail" class="col-sm-3 control-label tip">Email</label>
                                <div class="col-sm-9">
                                    <input id="mail" name="mail" type="text" value="<?php echo $rows->mail; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="idnat" class="col-sm-3 control-label tip">ID.Nat.</label>
                                <div class="col-sm-9">
                                    <input id="idnat" name="idnat" type="text" value="<?php echo $rows->idnat; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rccm" class="col-sm-3 control-label tip">RCCM</label>
                                <div class="col-sm-9">
                                    <input id="rccm" name="rccm" type="text" value="<?php echo $rows->rccm; ?>" class="form-control" />
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="taux" class="col-sm-3 control-label tip">Taux</label>
                                <div class="col-sm-9">
                                    <input id="taux" name="taux" type="text" value="<?php echo $rows->taux; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tva" class="col-sm-3 control-label tip">TVA</label>
                                <div class="col-sm-9">
                                    <input id="tva" name="tva" type="text" value="<?php echo $rows->tva; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Monnaie insertion</label>

                                <div class="col-sm-9">
                                    <select id="m_insert" name="m_insert" class="form-control choz">
                                        <?php if ($rows->m_insert == "CDF") { ?>
                                            <option value="<?php echo $rows->m_insert; ?>"><?php echo $rows->m_insert; ?></option>
                                            <option value="USD">USD</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $rows->m_insert; ?>"><?php echo $rows->m_insert; ?></option>
                                            <option value="CDF">CDF</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Monnaie affichage</label>

                                <div class="col-sm-9">
                                    <select id="m_affich" name="m_affich" class="form-control choz">
                                        <?php if ($rows->m_affich == "CDF") { ?>
                                            <option value="<?php echo $rows->m_insert; ?>"><?php echo $rows->m_affich; ?></option>
                                            <option value="USD">USD</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $rows->m_insert; ?>"><?php echo $rows->m_affich; ?></option>
                                            <option value="CDF">CDF</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="output"></div>
            </div>




        </div>
        <!--/col-12-->

</form>