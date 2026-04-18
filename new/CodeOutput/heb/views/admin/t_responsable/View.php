<?php
/*
	* =======================================================================
	* FILE NAME:        View.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_responsable
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=t_responsable&do=autosearch'); ?>

<div class="row">
	<div class="col-xs-12">
		<div class="box">

			<div class="box-header with-border">
				<h3 class="box-title">Liste des partenaires</h3>
				<ul class="nav pull-right">
					<a href="<?php echo H_ADMIN; ?>&view=t_responsable&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
				</ul>

			</div><!-- /.box-header -->
			<div class="box-body">

				<table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
					<thead>
						<tr>
							<th>N°</th>
							<th>Compte</th>
							<th>Entreprise</th>
							<th>Personne à contacter</th>
							<th data-hide="phone,tablet">Télephone</th>
							<th data-hide="phone,tablet">E-mail</th>
							<th data-hide="phone,tablet">Adresse</th>
							<th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
						</tr>
					</thead>
					<tbody>

						<?php
						$i = 1;
						foreach ($result as $rows) {
							$bdd = HDB::hus();
							GetAccountCustomer($rows->id_sous_compte, $bdd);
							$compte = $_SESSION['souscomptes_num'];
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $compte; ?></td>
								<td><?php echo $rows->entreprise; ?></td>
								<td><?php echo $rows->nom_respo; ?></td>
								<td><?php echo $rows->telephone_respo; ?></td>
								<td><?php echo $rows->email; ?></td>
								<td><?php echo $rows->adresse_respo; ?></td>
								<td class="table-actions">
									<div class="btn-group">
										<a href="<?php echo H_ADMIN; ?>&view=t_responsable&id_respo=<?php echo $rows->id_respo; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
										<a href="<?php echo H_ADMIN; ?>&view=t_responsable&id_respo=<?php echo $rows->id_respo; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
									</div>
								</td>
							</tr>
						<?php
							$i++;
						}
						?>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->