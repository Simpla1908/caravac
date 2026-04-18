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
				<ul class="nav pull-right">
					<a href="<?php echo H_ADMIN; ?>&view=resconfig&id=<?php echo $rows->id; ?>&do=update" title="<?php echo LANG_TIP_UPDATE; ?> configuration" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> Modifier</a>
				</ul>

			</div><!-- /.box-header -->
			<div class="box-body">
				<table data-page="false" class="table table-striped table-bordered">
					<tbody>
						<tr>
							<th>Nom compagnie</th>
							<td><?php echo $rows->nomcomp; ?></td>
						</tr>
						<tr>
							<th>Adresse </th>
							<td><?php echo $rows->adrcomp; ?></td>
						</tr>
						<tr>
							<th>Monnaie inserion</th>
							<td><?php echo $rows->m_insert; ?></td>
						</tr>

						<tr>
							<th>Monnaie affichage</th>
							<td><?php echo $rows->m_affich; ?></td>
						</tr>

						<tr>
							<th>Taux</th>
							<td><?php echo $rows->taux; ?></td>
						</tr>

						<tr>
							<th>Age</th>
							<td><?php echo $rows->age; ?></td>
						</tr>
						<tr>
							<th>Pénalité sur les absences</th>
							<td><?php echo GetPenalite($rows->penalite); ?></td>
						</tr>
						<tr>
							<th>Hopital</th>
							<td><?php echo $rows->hopital; ?></td>
						</tr>
						<tr>
							<th>Préfixe congé</th>
							<td><?php echo $rows->prefconge; ?></td>
						</tr>
						<tr>
							<th>Préfixe sanction</th>
							<td><?php echo $rows->prefsanct; ?></td>
						</tr>
						<tr>
							<th>Fuseau horaire</th>
							<td><?php echo $rows->fuseauhoraire; ?></td>
						</tr>
						<tr>
							<th>Logo</th>
							<td><?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?><a href='<?php echo UPLOAD_FOLDER . $rows->logo; ?>' data-rel='hezebox'><img src='<?php echo THUMB_FOLDER . $rows->logo; ?>'></a><?php } ?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->