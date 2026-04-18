
<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_chambre
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

 $tarif_ch = montant_equivalent_bdd($rows->monnaie,$_SESSION['Paie_insert'],$_SESSION['Paie_taux'],$rows->tarif_ch);
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=t_chambre&do=updatepro2'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            <a href="<?php echo H_ADMIN; ?>&view=t_chambre&id_ch=<?php echo $rows->id_ch; ?>&do=delete2&dfile=" title="<?php echo LANG_TIP_DELETE; ?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE; ?></a>
            <a href="<?php echo H_ADMIN; ?>&view=t_chambre&do=viewall2" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Modification chambre</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <input type="hidden" name="id_ch" value="<?php echo $rows->id_ch; ?>">
                 <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="num_ch" class="col-sm-3 control-label">Nom</label>
                                <div class="col-sm-9">
                                    <input id="num_ch" name="num_ch" value="<?php echo $rows->num_ch; ?>" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tarif_ch" class="col-sm-3 control-label">Tarif</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input id="tarif_ch" name="tarif_ch" value="<?php echo arrondir($tarif_ch); ?>" class="form-control" type="text">
                                        <span class="input-group-addon"><?php echo AfficheMonnaie($_SESSION['Paie_insert']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="etat_ch" class="col-sm-3 control-label">Etat</label>
                                <div class="col-sm-9">
                                    <select id="etat_ch" name="etat_ch" class="form-control choz">
                                        <option value="propre">propre</option>
                                        <option value="salle">salle</option>
                                        <option value="<?php echo $rows->etat_ch; ?>" selected=""><?php echo $rows->etat_ch; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="categorie" class="col-sm-3 control-label">Catégorie</label>
                                <div class="col-sm-9">
                                    <select id="categorie" name="categorie" class="form-control choz">
                                        <?php foreach ($categories as $r) { ?>
                                            <?php if($r->id_cat_cha==$rows->categorie){ ?>
                                            <option value="<?php echo $r->id_cat_cha ?>" selected=""><?php echo $r->lib_cat_cha ?></option>
                                            <?php }else{ ?>
                                             <option value="<?php echo $r->id_cat_cha ?>"><?php echo $r->lib_cat_cha ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>



        </div><!--/col-12-->

</form>
