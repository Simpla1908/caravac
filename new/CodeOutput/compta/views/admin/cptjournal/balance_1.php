
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	18-04-2019
 * FOR TABLE:  		cptjournal
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<style type="text/css">
    body {
        color: #404E67;
        background: #F5F7FA;
        font-family: 'Open Sans', sans-serif;
    }
    .table-wrapper {
        background: #fff;
        padding: 20px;	
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
        height: 30px;
        font-weight: bold;
        font-size: 12px;
        text-shadow: none;
        min-width: 100px;
        line-height: 13px;
    }
    .table-title .add-new i {
        margin-right: 4px;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
        cursor: pointer;
        display: inline-block;
        margin: 0 5px;
        min-width: 24px;
    }    
    table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
    table.table td a.add i {
        font-size: 24px;
        margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
    table.table .form-control.error {
        border-color: #f50000;
    }
    table.table td .add {
        display: none;
    }
</style>

<form action="<?php echo H_ADMIN_MAIN . '&view=cptjournal&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2> <b>Balance</b></h2></div>
                <div class="col-sm-4 ">
                    <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=add" class="btn btn-primary btn-flat" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-check"></i> Valider</a>
                     <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=add" class="btn btn-primary btn-flat" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-print"></i> Imprimer</a>
                </div>
            </div>
            <div class="output"></div>
        </div>
        <div class="col-lg-2 form-group">
            <label>Exercice au </label>
            <select name="typejournal" class="form-control select2"
                    style="width: 100%;" id="typejournal">
                <option value="">31/12/2019 </option>
                <option value="">31/12/2018 </option>
                <option value="">31/12/2017 </option>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label>Comparé à </label>
            <select name="typejournal" class="form-control select2"
                    style="width: 100%;" id="typejournal">
                <option value="">31/12/2018 </option>
                <option value="">31/12/2017 </option>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label>Devise</label>
            <select id="devise" name="devise" class="form-control choz">
                <option value="CDF">CDF</option>
                <option value="USD">USD</option>
            </select>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2"  style="text-align: center;">Numéro</th>
                    <th rowspan="2"  style="text-align: center;">Compte</th>
                    <th rowspan="2"  style="text-align: center;">Total Débits</th>  
                    <th rowspan="2"  style="text-align: center;">Total Crédits</th>
                    <th colspan="2"   style="text-align: center;">Solde N</th>
                    <th colspan="2"  style="text-align: center;">Solde N-1</th>
                </tr>
                <tr>
                    <th  style="text-align: center;">Débitaire</th>
                    <th  style="text-align: center;">Créditaire</th>
                    <th  style="text-align: center;">Débitaire</th>
                    <th  style="text-align: center;">Créditaire</th>
                </tr>
            </thead>
            <tbody id="lignesjournal">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</form>
<div class="modal fade" id="myModalcomptes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Comptes</h4>                
            </div>
            <div class="modal-body">
                <input id="compte_id" name="compte_id" type="hidden" value="">
                <input id="compte_id2" name="compte_id2" type="hidden" value="">
                <select id="selectcompte" name="selectcompte" class="form-control choz">
                    <?php
                    foreach ($result as $rows) {
                        ?>
                        <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->libelle); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-danger pull-right"
                         id="validercomptes"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                </button>
                <span class="btn btn-info hidden pull-right" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
