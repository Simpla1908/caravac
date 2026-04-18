<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		stk_produit
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
	die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=stk_sous_famille&do=autosearch'); ?>

<div class="row">
	<div class="col-xs-12">
		<div class="box">

			<div class="box-header with-border">
				<h3 class="box-title">Liste des catégories</h3>
				<ul class="nav pull-right">
					<a href="<?php echo H_ADMIN; ?>&view=stk_sous_famille&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
					<!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=stk_produit&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>-->
				</ul>

			</div><!-- /.box-header -->
			<div class="box-body">

				<table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
					<thead>
						<tr>
							<th>#</th>
							<th data-hide="phone,tablet">Designation</th>
							<th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
						</tr>
					</thead>
					<tbody>

						<?php
						$i = 0;
						foreach ($result as $rows) {
							$i++;
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $rows->des; ?></td>
								<td class="table-actions">
									<div class="btn-group">
										<a href="<?php echo H_ADMIN; ?>&view=stk_sous_famille&id_s_fam=<?php echo $rows->id_s_fam; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
										<a href="<?php echo H_ADMIN; ?>&view=stk_sous_famille&id_s_fam=<?php echo $rows->id_s_fam; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
									</div>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->