
<?php
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Journal</h3>
                <ul class="nav pull-right">
                    <a  class="btn btn-primary btn-sm tip"> <i class="fa fa-plus"></i>  Ajouter opération</a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=listebc" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>
            </div><!-- /.box-header -->
            <div class="box-header with-border">
                <div class="col-md-12">
                    <form class="form-inline" id="p">
                        <div class="form-group">
                            <label for="ex3">Du</label>
                            <input id="dte1pl" nam="dte1" class="form-control datepicker2 " placeholder=" " type="text" value="<?php echo date('d/m/Y');?>">
                        </div>
                        <div class="form-group">
                            <label for="ex4"> au</label>
                            <input id="dte2pl" nam="dte2" class="form-control datepicker2" placeholder=" " type="text" value="<?php echo date('d/m/Y');?>">
                        </div>
                        <div class="form-group">
                            <select class="form-control choz"  required>
                                <option>Journal de vente </option>
                                <option>Journal d'Achat </option>
                                <option>Journal Caisse</option>
                                <option>Journal Banque</option>
                                 <option>Opérations diverses</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Valider</button>
                    </form>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div>
                  <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th data-hide="phone,tablet">Date</th>
                             <th data-hide="phone,tablet">Code journal</th>
                            <th data-hide="phone,tablet">Reférence</th>
                            <th data-hide="phone,tablet">Description</th>
                            <th data-hide="phone,tablet">Total</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody id="dataview">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="table-actions">
                                <div class="btn-group">
                                    <!--<a href="<?php // echo H_ADMIN;  ?>&view=cptcomptes&id=<?php // echo $rows->id;  ?>&do=details"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>-->
                                    <a href="<?php // echo H_ADMIN;  ?>&view=cptcomptes&id=<?php // echo $rows->id;  ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                    <a href="<?php // echo H_ADMIN;  ?>&view=cptcomptes&id=<?php // echo $rows->id;  ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->