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
					<a href="<?php echo H_ADMIN; ?>&view=paramstk&id=<?php echo $site_id; ?>&do=update" title="<?php echo LANG_TIP_UPDATE; ?> configuration" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> Modifier</a>
				</ul>

			</div><!-- /.box-header -->
			<div class="box-body">
				<table data-page="false" class="table table-striped table-bordered">
					<tbody>

						<tr>
							<th>Monnaie Insertion</th>
							<td><?php echo $rows->m_insert; ?></td>
						</tr>
						<tr>
							<th>Monnaie Affichage</th>
							<td><?php echo $rows->m_affiche; ?></td>
						</tr>

						<tr>
							<th>Taux du jour</th>
							<td><?php echo $rows->tauxdollar; ?></td>
						</tr>
						<tr>
							<th>TVA</th>
							<td><?php echo $rows->tva; ?></td>
						</tr>
						<tr>
							<th>Liaison Stock et Point de vente</th>
							<td>
								<?php
								if ($rows->stock == 1) {
									echo "Le module de stock est lié avec le point de point";
								} else {
									echo "Le module de stock n'est pas lié avec le point de point";
								}
								?>
							</td>
						</tr>


					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->