
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_client
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=t_client&do=addpro_ach'; ?>" method="post" name="hezecomform" id="hezecomform" class="form-horizontal" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall_ach" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Créaation Fournisseur</h3></div>
            <div class="panel-body">

                <div class="output"></div>

                <div class="row">
                    <div class="col-md-10">
                        <br>

                        <div class="form-group">
                            <label for="nom_entreprise" class="col-sm-4 control-label">Nom Entreprise</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" placeholder="Nom Entreprise">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Personne à contacter</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nom_client" name="nom_client" placeholder="Personne à contacter">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Téléphone</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="telephone_client" name="telephone_client" placeholder="Téléphone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Email</label>

                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email_client" name="email_client" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Adresse</label>

                            <div class="col-sm-8">
                                <textarea class="form-control" id="adresse_provenance_client" name="adresse_provenance_client" placeholder="Adresse"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="output"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>

            <input id="type" name="type" type="hidden" maxlength="100"  value="fournisseur" class="form-control styler" />
            <input id="id_hotel" name="id_hotel" type="hidden"  value="<?php echo $_SESSION['idsite']; ?>" />
            <input id="id_user" name="id_user" type="hidden"  value="<?php echo $_SESSION['id_user']; ?>" />
            <input id="company_id" name="company_id" type="hidden" value="<?php echo $_SESSION['company_id']; ?>" />

        </div><!--/col-12-->

</form>
