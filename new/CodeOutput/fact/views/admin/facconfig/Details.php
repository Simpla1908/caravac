<?php
/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	08-02-2018
	* FOR TABLE:  		resconfig
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
?>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Configurations</h3>
				<ul class="nav pull-right">
					<a href="<?php echo H_ADMIN; ?>&view=facconfig&id=<?php echo $rows->id; ?>&do=update" title="<?php echo LANG_TIP_UPDATE; ?> configuration" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> Modifier</a>
				</ul>

			</div><!-- /.box-header -->
			<div class="box-body">
				<table data-page="false" class="table table-striped table-bordered">
					<tbody>
						<tr class="hidden">
							<th>Entreprise</th>
							<td><?php echo $rows->nom_hotel; ?></td>
						</tr>
						<tr class="hidden">
							<th>Logo</th>
							<td><?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?><a href='<?php echo UPLOAD_FOLDER . $rows->logo; ?>' data-rel='hezebox'><img src='<?php echo THUMB_FOLDER . $rows->logo; ?>'></a><?php } ?></td>
						</tr>
						<tr class="hidden">
							<th>Adresse </th>
							<td><?php echo $rows->adresse_hotel; ?></td>
						</tr>
						<tr class="hidden">
							<th>Télephone </th>
							<td><?php echo $rows->phone; ?></td>
						</tr>
						<tr class="hidden">
							<th>Email </th>
							<td><?php echo $rows->mail; ?></td>
						</tr>
						<tr class="hidden">
							<th>ID.Nat. </th>
							<td><?php echo $rows->idnat; ?></td>
						</tr>
						<tr class="hidden">
							<th>RCCM. </th>
							<td><?php echo $rows->rccm; ?></td>
						</tr>
						<tr class="hidden">
							<th>Fuseau horaire</th>
							<td><?php echo $rows->fuseauhoraire; ?></td>
						</tr>
						<tr class="hidden">
							<th>Taux</th>
							<td><?php echo $rows->taux; ?></td>
						</tr>

						<tr class="hidden">
							<th>TVA</th>
							<td><?php echo $rows->tva; ?> %</td>
						</tr>
						<tr class="hidden">
							<th>Monnaie inserion </th>
							<td><?php echo $rows->m_insert; ?></td>
						</tr>

						<tr class="hidden">
							<th>Monnaie affichage</th>
							<td><?php echo $rows->m_affich; ?></td>
						</tr>
						<tr>
							<th>Préfixe reçu</th>
							<td><?php echo $rows->prefsanct; ?></td>
						</tr>
						<tr>
							<th>Préfixe facture</th>
							<td><?php echo $rows->prefconge; ?></td>
						</tr>
						<tr>
							<th>Intitulé compte</th>
							<td><?php echo $rows->hopital; ?></td>
						</tr>

						<tr>
							<th>Instructions importantes</th>
							<td><?php echo $rows->infofact; ?></td>
						</tr>
						<tr class="hidden">
							<th>Sujet du Mail</th>
							<td><?php echo $rows->sujetmail; ?></td>
						</tr>
						<tr class="hidden">
							<th>Message du Mail</th>
							<td><?php echo $rows->msgmail; ?></td>
						</tr>
						<tr>
							<th>Lier avec le Module Stock</th>
							<td>
								<?php if ($rows->liestock == 1) {
									echo 'Oui';
								} else {
									echo 'Non';
								};
								?>
							</td>
						</tr>

					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->