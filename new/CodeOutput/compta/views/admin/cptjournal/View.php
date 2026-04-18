<?php
/*
0=2! * FILE NAME:        View.php
 * DATE CREATED:    18-04-2019
 * FOR TABLE:       cptjournal
 * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=cptjournal&do=autosearch'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Journalisation</h3>
                <ul class="nav pull-right">
                    <?php if (in_array('CPTJOURNLSR', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                        <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=add" class="btn btn-primary btn-flat" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i>Journaliser</a>
                    <?php } ?>
                    <!-- <a href="#" class="btn btn-default btn-flat" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-refresh"></i> Actualiser</a>
                    <a style="display:none;" href="#" class="btn btn-warning  btn-flat" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-refresh"></i> Actualiser</a> -->
                    <a href="#" title="Filtrage des journaux" data-toggle="modal" data-target="#modalfiltrerl" class="btn btn-danger btn-flat"><i class="fa fa-table"></i> Filtrer </a>
                </ul>
            </div><!-- /.box-header -->
            <div class="box-body" id="contentdatafilter">

                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th data-hide="phone,tablet">Type de journal</th>
                            <th data-hide="phone,tablet">Réference</th>
                            <th data-hide="phone,tablet">Description</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;

                        foreach ($result as $rows) {
                            if ($rows->reference != 'RES00001') {
                        ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo dateAffiche($rows->dte) ?></td>
                                    <td><?php echo ucfirst($rows->typejournal); ?></td>
                                    <td><?php echo $rows->reference; ?></td>
                                    <td><?php echo ucfirst($rows->description); ?></td>
                                    <td class="table-actions">
                                        <div class="btn-group">
                                            <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=details&id=<?php echo $rows->id; ?>" class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                            <?php if ($rows->lettrer == 1) {; ?>
                                                <a class="btn btn-success btn-xs">Lettrée</a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>

                                </tr>
                        <?php
                            }
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->


<div class="modal fade" id="modalfiltrerl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="frmfiltrerl" id="frmfiltrerl">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des journaux</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label for="typejournal">Type de journal</label>
                        <select name="typejournal" class="form-control select2" style="width: 300px;" id="typejournal">
                            <option value="tout">Tous</option>
                            <?php
                            foreach ($result2 as $rows) {
                            ?>
                                <option value="<?php echo $rows->libelle; ?>"><?php echo ucfirst($rows->libelle); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="dte1">Du</label>
                            <input name="dte1" id="dte1" type="text" value="<?php echo dateAffiche($datedebut); ?>" class="form-control datepicker2">
                        </div>
                        <div class="form-group">
                            <label for="dte2">au</label>
                            <input name="dte2" id="dte2" type="text" value="<?php echo dateAffiche($datefin); ?>" class="form-control datepicker2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger pull-right col-md-2" id="btnfiltrerjournaux">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>