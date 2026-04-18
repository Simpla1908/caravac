
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
                     <ul class="nav pull-right">
                    <button type="submit" class="btn btn-primary btn-flat pull-right" id="btngenerebal" name="btngenerebal"><i class="fa fa-save"></i> Valider</button>
                    <a href="#" id="btnprintdisabled" class="btn btn-danger btn-flat" disabled><i class="fa fa-print"></i> Imprimer </a>
                    <a href="#" id="btnprintabled" data-toggle="modal" data-target="#modalChoiceFile" class="btn btn-danger btn-flat" style="display:none;"><i class="fa fa-print"></i> Imprimer </a>

                </ul>    
                 </div>
            </div>
            <div class="output"></div>
        </div>
        <div class="col-lg-2 form-group">
            <label>Exercice</label>
            <select name="exercice_id_bal" class="form-control select2" id="exercice_id_bal">
                <option value=""></option>
                 <?php
                 foreach ($exercices as $rows) {
                  ?>
                  <option value="<?php echo $rows->id; ?>" debut="<?php echo $rows->debut; ?>" fin="<?php echo $rows->fin; ?>"><?php echo ucfirst($rows->lib); ?></option>
                <?php 
                  }
                  ?>
            </select>
            <input name="exercice_lib" id="exercice_lib"  type="hidden" value=""> 
            <input name="debut" id="debut"  type="hidden" value=""> 
            <input name="fin" id="fin"  type="hidden" value=""> 

        </div>
          <div class="col-lg-3 form-group">
                <label>Du</label>
                <input type="text" id="dte1" name="dte1" class="form-control datepicker2" value="">
            </div>
            <div class="col-lg-3 form-group">
                <label>Au</label>
                <input type="text" id="dte2" name="dte2" class="form-control datepicker2" value="">
            </div>
        <div class="col-lg-2 form-group">
            <label>Devise</label>
            <select id="devise" name="devise" class="form-control choz">
                <option value=""></option>
                <option value="CDF">CDF</option>
                <option value="USD">USD</option>
            </select>
        </div>

        <br><br>
        <div class="row" id="resultgenerebal">

        </div>
    </div>
</form>
<div class="modal fade" id="modalChoiceFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="frmChoiceFile" id="frmChoiceFile">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Type Document</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="typedoc">PDF</label>
                            <input name="typedoc" id="pdf"  type="radio" value="pdf" class="flat-red" checked="checked"> 
                        </div>
                        <div class="form-group">
                            <label for="typedoc">EXCEL</label>
                            <input name="typedoc" id="excel"  type="radio" value="excel" class="flat-red">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-danger pull-right col-md-2" id="btnChoiceFileBAL">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
