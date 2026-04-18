
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
$titre='Ajouter Client';
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=t_client&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo $titre; ?></h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                           
                            <div class="row">
                                <div class="col-md-3">
                                    
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        <input name="optionsRadios" class="radioclient" id="optionsRadios1" value="particulier"  type="radio" checked="">
                                    Particulier     
                                </label>
                                    <label>
                                    <input name="optionsRadios" class="radioclient" id="optionsRadios1" value="societe" type="radio">
                                    Socièté
                                </label>
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-5">
                                    
                                </div>
                            </div>
                             <br>
                            <div class="form-group societe hidden">
                                <label for="nomsociete" class="col-sm-3 control-label" >Nom Socièté</label>
                                <div class="col-sm-9">
                                    <input id="designation" name="designation" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nom_client " class="col-sm-3 control-label" id="lbnoms">Noms</label>
                                <div class="col-sm-9">
                                    <input id="nom_client" name="nom_client" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telephone_client" class="col-sm-3 control-label">Téléphone</label>
                                <div class="col-sm-9">
                                     <input id="telephone_client" name="telephone_client" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_client" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input  id="email_client" name="email_client" type="text" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="sexe_client" class="col-sm-3 control-label">Sexe</label>
                                <div class="col-sm-9">
                                    <select id="sexe_client" name="sexe_client"  class="form-control choz">
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="adresse_provenance_client" class="col-sm-3 control-label">Adresse</label>
                                <div class="col-sm-9">
                                  <input  id="adresse_provenance_client" name="adresse_provenance_client" type="text" class="form-control" >  
                                </div>
                            </div>
                             <input  id="id_hotel" name="id_hotel" type="hidden" value="<?php echo $_SESSION['idsite']; ?>" class="form-control" >  
                               <input  id="type" name="type" type="hidden" value="client" class="form-control" >  
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
