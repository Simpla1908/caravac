<?php
/*
	* =======================================================================
	* FILE NAME:        Add.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_responsable
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=t_responsable&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
		<ul class="nav pull-right" style="margin-top:5px;">
			<label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
			<input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

			<a href="<?php echo H_ADMIN; ?>&view=t_responsable&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
		</ul>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-reorder"></i> Ajout Partenaire</h3>
			</div>
			<div class="panel-body">

				<div class="output"></div>

				<div class="form-horizontal">
					<div class="row">
						<div class="col-md-10">
							<div class="form-group">
								<label for="Compte" class="col-sm-3 control-label">Compte</label>
								<div class="col-sm-9">
									<input id="accountnumberaffRespon" name="account" type="text" maxlength="50" value="" class="form-control styler" disabled="disabled" />
								</div>
							</div>
							<div class="form-group">
								<label for="email_client" class="col-sm-3 control-label">Entreprise</label>
								<div class="col-sm-9">
									<input id="entreprise" name="entreprise" type="text" maxlength="50" value="" class="form-control styler InputGenAccountRespon" />
								</div>
							</div>
							<div class="form-group">
								<label for="nom_client" class="col-sm-3 control-label" id="lbnoms">Personne à contacter</label>
								<div class="col-sm-9">
									<input id="nom_respo" name="nom_respo" type="text" maxlength="30" value="" class="form-control styler" />
								</div>
							</div>
							<div class="form-group">
								<label for="telephone_client" class="col-sm-3 control-label">Téléphone</label>
								<div class="col-sm-9">
									<input id="telephone_respo" name="telephone_respo" type="text" maxlength="20" value="" class="form-control styler" />
								</div>
							</div>
							<div class="form-group">
								<label for="telephone_client" class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input id="email" name="email" type="text" maxlength="20" value="" class="form-control styler" />
								</div>
							</div>
							<div class="form-group">
								<label for="adresse_provenance_client" class="col-sm-3 control-label">Adresse</label>
								<div class="col-sm-9">
									<input id="adresse_respo" name="adresse_respo" type="text" maxlength="100" value="" class="form-control styler" />
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="form-group hidden">
					<label class="control-label" for="filtre">Filtre</label>
					<input id="filtre" name="filtre" type="text" maxlength="11" value="1" class="form-control styler" />
				</div>

				<div class="form-group hidden">
					<label class="control-label" for="company_id">Company Id</label>
					<input id="company_id" name="company_id" type="text" maxlength="11" value="<?php echo $_SESSION['company_id']; ?>" class="form-control styler" />
				</div>
			</div>
			<div class="panel-footer" style="border-bottom:solid 2px #CCC;">
				<label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
				<input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
			</div>



		</div>
		<!--/col-12-->

</form>