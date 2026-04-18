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
				<h3 class="box-title"></h3>
				<ul class="nav pull-right">
					<a href="<?php echo H_ADMIN; ?>&view=parambase&id=<?php echo $site_id; ?>&do=update" title="<?php echo LANG_TIP_UPDATE; ?> configuration" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> Modifier</a>
				</ul>

			</div><!-- /.box-header -->
			<div class="box-body">
				<table data-page="false" class="table table-striped table-bordered">
					<tbody>
						<tr>
							<th>Entreprise</th>
							<td><?php echo $rows->nom_hotel; ?></td>
						</tr>
						<tr>
							<th>Logo</th>
							<td><?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?><a href='<?php echo UPLOAD_FOLDER . $rows->logo; ?>' data-rel='hezebox'><img src='<?php echo THUMB_FOLDER . $rows->logo; ?>'></a><?php } ?></td>
						</tr>
						<tr>
							<th>Adresse </th>
							<td><?php echo $rows->adresse_hotel; ?></td>
						</tr>
						<tr>
							<th>Ville </th>
							<td><?php echo $rows->ville_hotel; ?></td>
						</tr>
						<tr>
							<th>Télephone </th>
							<td><?php echo $rows->phone; ?></td>
						</tr>
						<tr>
							<th>Email </th>
							<td><?php echo $rows->mail; ?></td>
						</tr>
						<tr>
							<th>ID.Nat. </th>
							<td><?php echo $rows->idnat; ?></td>
						</tr>
						<tr>
							<th>RCCM. </th>
							<td><?php echo $rows->rccm; ?></td>
						</tr>

						<tr>
							<th>Taux</th>
							<td><?php echo $rows->taux; ?></td>
						</tr>

						<tr>
							<th>TVA</th>
							<td><?php echo $rows->tva; ?> %</td>
						</tr>
						<tr>
							<th>Monnaie inserion </th>
							<td><?php echo $rows->m_insert; ?></td>
						</tr>

						<tr>
							<th>Monnaie affichage</th>
							<td><?php echo $rows->m_affich; ?></td>
						</tr>


					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->