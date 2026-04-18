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
					<a href="<?php echo H_ADMIN; ?>&view=paramfact&id=<?php echo $module_id; ?>&do=update" title="<?php echo LANG_TIP_UPDATE; ?> configuration" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> Modifier</a>
				</ul>

			</div><!-- /.box-header -->
			<div class="box-body">
				<table data-page="false" class="table table-striped table-bordered">
					<tbody>

						<tr>
							<th>Préfixe reçu</th>
							<td><?php echo $rows->prefsanct; ?></td>
						</tr>
						<tr>
							<th>Préfixe facture</th>
							<td><?php echo $rows->prefconge; ?></td>
						</tr>

						<tr>
							<th>Instructions importantes</th>
							<td><?php echo $rows->infofact; ?></td>
						</tr>
						<tr style="display: none;">
							<th>Sujet du Mail</th>
							<td><?php echo $rows->sujetmail; ?></td>
						</tr>
						<tr style="display: none;">
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