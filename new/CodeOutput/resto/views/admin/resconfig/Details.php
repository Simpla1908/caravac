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
				<h3 class="box-title">Configuration de base</h3>
				<ul class="nav pull-right">
					<a href="<?php echo H_ADMIN; ?>&view=resconfig&id=<?php echo $rows->id; ?>&do=update" title="<?php echo LANG_TIP_UPDATE; ?> configuration" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> Modifier</a>
				</ul>

			</div><!-- /.box-header -->
			<div class="box-body">
				<table data-page="false" class="table table-striped table-bordered">
					<tbody>
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
							<th>Remise</th>
							<td><?php echo $rows->age; ?></td>
						</tr>
						<tr>
							<th>Mention légale</th>
							<td><?php echo $rows->infofact; ?></td>
						</tr>

					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->