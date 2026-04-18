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


<form action="<?php echo H_ADMIN_MAIN . '&view=paramstk&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
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
                            <input type="hidden" name="id" value="<?php echo $site_id; ?>">
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
                                    <select id="m_affiche" name="m_affiche" class="form-control choz">
                                        <?php if ($rows->m_affiche == "CDF") { ?>
                                            <option value="<?php echo $rows->m_affiche; ?>"><?php echo $rows->m_affiche; ?></option>
                                            <option value="USD">USD</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $rows->m_affiche; ?>"><?php echo $rows->m_affiche; ?></option>
                                            <option value="CDF">CDF</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="tauxdollar" class="col-sm-3 control-label tip">Taux du jour</label>
                                <div class="col-sm-9">
                                    <input id="tauxdollar" name="tauxdollar" type="text" value="<?php echo $rows->tauxdollar; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tva" class="col-sm-3 control-label tip">TVA</label>
                                <div class="col-sm-9">
                                    <input id="tva" name="tva" type="text" value="<?php echo $rows->tva; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stock" class="col-sm-3 control-label">Liaison Stock et Point de vente</label>

                                <div class="col-sm-9">
                                    <select id="stock" name="stock" class="form-control choz">
                                        <?php if ($rows->stock == 1) { ?>
                                            <option value="1">Oui</option>
                                            <option value="0">Non</option>
                                        <?php } else { ?>
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
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