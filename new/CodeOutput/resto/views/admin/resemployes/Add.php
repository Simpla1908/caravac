
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resemployes
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=resemployes&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=resemployes&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Saisie information employé</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a aria-expanded="true" href="#tab_1" data-toggle="tab">Information personnelle</a></li>
                            <li class=""><a aria-expanded="false" href="#tab_2" data-toggle="tab">Famille</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Paramètre RH</a></li>
                             <li><a href="#tab_4" data-toggle="tab">Horaire de travail</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="col-md-5">
                                    <br>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-4 control-label">Noms</label>
                                        <div class="col-sm-8">
                                            <input id="noms" name="noms" type="text" maxlength="245"  value="" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="matricule" class="col-sm-4 control-label">Matricule</label>
                                        <div class="col-sm-8">
                                            <input name="matricule" id="matricule" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sexe" class="col-sm-4 control-label">Sexe</label>
                                        <div class="col-sm-8">
                                            <select id="sexe" name="sexe"  class="form-control choz">
                                                <option value="M">Masculin</option>
                                                <option value="F">Feminin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="etatcivil" class="col-sm-4 control-label">Etat civil</label>
                                        <div class="col-sm-8">
                                            <select id="etatcivil" name="etatcivil" class="form-control choz">
                                                <option value="celibataire">Celibataire</option>
                                                <option value="marie">Marié(e)</option>
                                                <option value="divorce">Divorcé(e)</option>
                                                <option value="veuf">Veuf(ve)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nationalite" class="col-sm-4 control-label">Nationalité</label>
                                        <div class="col-sm-8">
                                            <input id="nationalite" name="nationalite" type="text" maxlength="245"  value="" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lieunais" class="col-sm-4 control-label">Lieu de naiss.</label>
                                        <div class="col-sm-8">
                                            <input id="lieunais" name="lieunais" type="text" maxlength="245"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="datenais" class="col-sm-4 control-label">Date de naiss.</label>
                                        <div class="col-sm-8">
                                            <input name="datenais" id="datenais" type="text" class="form-control datemask" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Adresse" class="col-sm-4 control-label">Numéro,Rue</label>
                                        <div class="col-sm-8">
                                            <input id="rue" name="rue" type="text" maxlength="245"  value="" class="form-control">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="Adresse" class="col-sm-4 control-label">Quartier</label>
                                        <div class="col-sm-8">
                                            <input id="quartier" name="quartier" type="text" maxlength="245"  value="" class="form-control">
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label for="Adresse" class="col-sm-4 control-label">Commune</label>
                                        <div class="col-sm-8">
                                            <input id="commune" name="commune" type="text" maxlength="245"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Adresse" class="col-sm-4 control-label">Ville</label>
                                        <div class="col-sm-8">
                                            <input id="ville" name="ville" type="text" maxlength="245"  value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <br>
                                    <div class="form-group">
                                        <label for="piece" class="col-sm-4 control-label">Pièce</label>
                                        <div class="col-sm-8">
                                            <select id="piece" name="piece"  class="form-control choz">
                                                <option value="carte d'electeur">carte d'electeur</option>
                                                <option value="carte d'identite">carte d'identite</option>
                                                <option value="passeport">passeport</option>
                                                <option value="permis de conduire">permis de conduire</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="numpiece" class="col-sm-4 control-label">No Pièce Ind.</label>
                                        <div class="col-sm-8">
                                            <input id="numpiece" name="numpiece" type="text" maxlength="30"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="numinss" class="col-sm-4 control-label">No CNSS.</label>
                                        <div class="col-sm-8">
                                            <input id="numinss" name="numinss" type="text" maxlength="30"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group hidden">
                                        <label for="fingerprint" class="col-sm-4 control-label">Fingerprint</label>
                                        <div class="col-sm-8">
                                            <input id="fingerprint" name="fingerprint" type="text" maxlength="30"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-4 control-label">Email.</label>
                                        <div class="col-sm-8">
                                            <input id="email" name="email" type="text" maxlength="100"  value=""  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel1" class="col-sm-4 control-label">Téléphone 1</label>
                                        <div class="col-sm-8">
                                            <input id="tel1" name="tel1" type="text" maxlength="20" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel2" class="col-sm-4 control-label">Téléphone 2</label>
                                        <div class="col-sm-8">
                                            <input id="tel2" name="tel2" type="text" maxlength="20" value="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="col-sm-4 control-label">Photo</label>
                                        <div class="col-sm-8">
                                            <!--<img class="profile-user-img img-responsive" src="dist/img/user4-128x128.jpg" alt="User profile picture">-->
                                            <input id="image" name="image"type="file" class="control-label" >
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="row">
                                    <div class="col-md-5">
                                        <br>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-4 control-label">Noms conjoint(e)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomconj" id="nomconj" value="" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <br>
                                        <div class="form-group">
                                            <label for="nbrenf" class="col-sm-4 control-label">Nbr. enfants</label>
                                            <div class="col-sm-8">
                                                <select id="nbrenf" name="nbrenf" class="form-control choz">
                                                    <?php
                                                    for ($i =0; $i <=20; $i++) {
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div  id="infosenf">

                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <div class="col-md-5">
                                    <br>
                                    <div class="form-group">
                                        <label for="dteng" class="col-sm-4 control-label">Date d'eng.</label>
                                        <div class="col-sm-8">
                                            <input name="dteng" id="datemask" type="text" class="form-control datemask">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fonction_id" class="col-sm-4 control-label">Fonction</label>
                                        <div class="col-sm-8">
                                            <select id="fonction_id" name="fonction_id" class="form-control  choz">
                                              
                                                <?php
                                                foreach ($fonctions as $rows) {
                                                    ?>
                                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->fonction; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <br>
                                    <div class="form-group">
                                        <label for="typecontr" class="col-sm-4 control-label">Contrat</label>
                                        <div class="col-sm-8">
                                            <select id="typecontr" name="typecontr" class="form-control choz">
                                                <option value="CDI">CDI</option>
                                                <option value="CDD">CDD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="departement_id" class="col-sm-4 control-label">Département</label>
                                        <div class="col-sm-8">
                                            <select id="departement_id" name="departement_id" class="form-control choz">
                                                <?php
                                                foreach ($departements as $rows) {
                                                    ?>
                                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->libelle; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                              <div class="tab-pane" id="tab_4">
                                <div class="row">
                                    <div class="col-md-10">
                                        <br>
                                        <table class="table table-condensed table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 10px"></th>
                                                    <th>Liste des horaires</th>
                                                    <th class="hidden">Séquence en semaine</th>
                                                    <th class="hidden">Priorité</th>
                                                </tr>
                                                <?php
                                                foreach ($horaires as $rows) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="horaire_ids[]" value="<?php echo $rows->idh ?>">
                                                            <input type="hidden" name="nbrjrstrav[]" value="<?php echo $rows->nbrjrstrav ?>">
                                                        </td>
                                                        <td><?php echo $rows->libh ?></td>
                                                        <td class="hidden">
                                                            <div class="row">
                                                                <div class="col-xs-10">
                                                                    <select class="form-control choz" id="seq" name="seqs[]">
                                                                        <?php
                                                                        for ($i = 1; $i <= 4; $i++) {
                                                                            ?>
                                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="hidden">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <select class="form-control choz" id="priorite" name="priorites[]">
                                                                        <?php
                                                                        for ($i = 1; $i <= 4; $i++) {
                                                                            ?>
                                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>

            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>
        </div><!--/col-12-->
        <input id="actif" name="actif" type="hidden"  value="1" />
        <input id="pseudo_supp" name="pseudo_supp" type="hidden"  value="0" />
        <input id="id_hotel" name="id_hotel" type="hidden"  value="<?php echo $_SESSION['idsite']; ?>" />
</form>
