<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_client
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
$hidden = '';
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=t_client&do=updateproheb'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            <a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-reorder"></i> Modification du Client</h3>
            </div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="hidden" name="id_client" value="<?php echo $rows->id_client; ?>">
                            <input type="hidden" name="boolmodif" value="1">
                            <input type="hidden" name="id_sous_compte" value="<?php echo $rows->id_sous_compte; ?>">

                            <div class="form-group">
                                <label for="nom_client " class="col-sm-3 control-label" id="lbnoms">Compte Client</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control accountnumberaff" disabled="disabled" value="" name="displysuffixcompt">
                                    <input type="hidden" class="accountnumberaff" value="" name="suffixcompt">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nom_client " class="col-sm-3 control-label" id="lbnoms">Noms</label>
                                <div class="col-sm-9">
                                    <input id="nom_client" name="nom_client" type="text" value="<?php echo $rows->nom_client; ?>" class="form-control InputGenAccount">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="adresse_provenance_client" class="col-sm-3 control-label">Adresse</label>
                                <div class="col-sm-9">
                                    <input id="adresse_provenance_client" name="adresse_provenance_client" type="text" value="<?php echo $rows->adresse_provenance_client; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telephone_client" class="col-sm-3 control-label">Téléphone</label>
                                <div class="col-sm-9">
                                    <input id="telephone_client" name="telephone_client" type="text" value="<?php echo $rows->telephone_client; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="num_pers_contacter_client" class="col-sm-3 control-label">Autre Contact</label>
                                <div class="col-sm-9">
                                    <input id="num_pers_contacter_client" name="num_pers_contacter_client" type="text" value="<?php echo $rows->num_pers_contacter_client; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_client" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input id="email_client" name="email_client" type="text" value="<?php echo $rows->email_client; ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sexe_client" class="col-sm-3 control-label">Sexe</label>
                                <div class="col-sm-9">
                                    <select id="sexe_client" name="sexe_client" class="form-control choz">
                                        <?php if ($rows->sexe_client == 'Masculin') {; ?>
                                            <option value="Masculin">Masculin</option>
                                            <option value="Feminin">Feminin</option>
                                        <?php } else {; ?>
                                            <option value="Feminin">Feminin</option>
                                            <option value="Masculin">Masculin</option>
                                        <?php }; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_naiss_client" class="col-sm-3 control-label">Date de naissance</label>
                                <div class="col-sm-9">
                                    <input id="date_naiss_client" name="date_naiss_client" type="text" value="<?php echo dateAffiche($rows->date_naiss_client); ?>" class="form-control datepicker2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="etat_civil_client" class="col-sm-3 control-label">Etat civil</label>
                                <div class="col-sm-9">
                                    <select id="etat_civil_client" name="etat_civil_client" class="form-control choz">
                                        <option value="Celibataire">Celibataire</option>
                                        <option value="Marie">Marie</option>
                                        <option value="Divorce">Divorce</option>
                                        <option value="<?php echo $rows->etat_civil_client; ?>" selected="selected"><?php echo $rows->etat_civil_client; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nationalite_client" class="col-sm-3 control-label">Nationalité</label>
                                <div class="col-sm-9">
                                    <input id="nationalite_client" name="nationalite_client" type="text" value="<?php echo $rows->nationalite_client; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="num_piece_identite_client" class="col-sm-3 control-label">Pièce</label>
                                <div class="col-sm-9">
                                    <select class="form-control col-md-4 col-sm-12 col-xs-12 choz" name="num_piece_identite_client" id="num_piece_identite_client">
                                        <option value="Carte d'électeur">Carte d'électeur</option>
                                        <option value="Permis de conduire">Permis de conduire</option>
                                        <option value="Passport">Passport</option>
                                        <option value="<?php echo $rows->num_piece_identite_client; ?>" selected="selected"><?php echo $rows->num_piece_identite_client; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="num_passeport_client" class="col-sm-3 control-label">Numéro</label>
                                <div class="col-sm-9">
                                    <input id="num_passeport_client" name="num_passeport_client" type="text" value="<?php echo $rows->num_passeport_client; ?>" class="form-control datepicker2">
                                </div>
                            </div>
                            <input id="id_hotel" name="id_hotel" type="hidden" value="<?php echo $rows->id_hotel; ?>" class="form-control">
                            <input id="type" name="type" type="hidden" value="<?php echo $rows->type; ?>" class="form-control">
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;">
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>



        </div>
        <!--/col-12-->

</form>