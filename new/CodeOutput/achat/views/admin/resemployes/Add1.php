
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

                <div class="form-group">
                    <label class="control-label" for="matricule">Matricule</label>
                    <input id="matricule" name="matricule" type="text" maxlength="50"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="noms">Noms</label>
                    <input id="noms" name="noms" type="text" maxlength="245"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="sexe">Sexe</label>
                    <input id="sexe" name="sexe" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="etatcivil">Etatcivil</label>
                    <input id="etatcivil" name="etatcivil" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="nationalite">Nationalite</label>
                    <input id="nationalite" name="nationalite" type="text" maxlength="245"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="lieunais">Lieunais</label>
                    <input id="lieunais" name="lieunais" type="text" maxlength="245"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="datenais">Datenais</label>
                    <input name="datenais" class="datepicker form-control styler" type="text" maxlength="245" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="Adresse">Adresse</label>
                    <input id="Adresse" name="Adresse" type="text" maxlength="245"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="piece">Piece</label>
                    <input id="piece" name="piece" type="text" maxlength="245"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="numpiece">Numpiece</label>
                    <input id="numpiece" name="numpiece" type="text" maxlength="30"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="tel1">Tel1</label>
                    <input id="tel1" name="tel1" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="tel2">Tel2</label>
                    <input id="tel2" name="tel2" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="email">Email</label>
                    <input id="email" name="email" type="text" maxlength="100"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="nbrenf">Nbrenf</label>
                    <input id="nbrenf" name="nbrenf" type="text" maxlength="10"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="actif">Actif</label>
                    <input id="actif" name="actif" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="pseudo_supp">Pseudo Supp</label>
                    <input id="pseudo_supp" name="pseudo_supp" type="text" maxlength="10"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="fonction_id">Fonction Id</label>
                    <input id="fonction_id" name="fonction_id" type="text" maxlength="10"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="departement_id">Departement Id</label>
                    <?php  foreach ($fonctions as $f) { ?>
                    <input id="departement_id" name="departement_id" type="text" maxlength="10"  value=" <?php echo $f->libelle ;?>" class="form-control styler" />
                    <?php }?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="image">Image</label>

                    <input id="image" name="image"type="file" class="form-control styler"/>

                </div>

                <div class="form-group">
                    <label class="control-label" for="id_hotel">Id Hotel</label>
                    <input id="id_hotel" name="id_hotel" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="output"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>



        </div><!--/col-12-->

</form>
