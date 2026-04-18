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
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
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
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
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

    table.table tr th,
    table.table tr td {
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
<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var actions = $("table td:last-child").html();
        // Append table with add row form on add new button click
        $(".add-new").click(function() {
            //$(this).attr("disabled", "disabled");
            var rowCount = $('#lignesjournal tr').length;
            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
                '<td><input type="text" class="form-control comptes" name="comptelib[]" id="comptelib' + rowCount + '" id2="' + rowCount + '"><input type="hidden" name="compt[]" id="compt' + rowCount + '"  value=""><input type="hidden" name="cat[]" id="cat' + rowCount + '"  value=""><input type="hidden" name="num[]" id="num' + rowCount + '"  value=""><input type="hidden" name="compte[]" id="compte' + rowCount + '"  value=""></td>' +
                '<td><input type="text" class="form-control debits" name="debit[]" id="debit' + rowCount + '" id3="' + rowCount + '"></td>' +
                '<td><input type="text" class="form-control credits" name="credit[]" id="credit' + rowCount + '" id4="' + rowCount + '"></td>' +
                '<td><a class="delete" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a></td>' +
                '</tr>';
            $("table").append(row);
            $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
            $('[data-toggle="tooltip"]').tooltip();

        });
        // Add row on add button click
        $(document).on("click", ".add", function() {
            var empty = false;
            var input = $(this).parents("tr").find('input[type="text"]');
            input.each(function() {
                if (!$(this).val()) {
                    $(this).addClass("error");
                    empty = true;
                } else {
                    $(this).removeClass("error");
                }
            });
            $(this).parents("tr").find(".error").first().focus();
            if (!empty) {
                input.each(function() {
                    $(this).parent("td").html($(this).val());
                });
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").removeAttr("disabled");
            }
        });
        // Edit row on edit button click
        $(document).on("click", ".edit", function() {
            $(this).parents("tr").find("td:not(:last-child)").each(function() {
                $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
            });
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").attr("disabled", "disabled");
        });
        // Delete row on delete button click
        $(document).on("click", ".delete", function() {
            $(this).parents("tr").remove();
            $(".add-new").removeAttr("disabled");
        });
    });

    $(document).ready(function() {

        $(".table").on('click', '.devises', function(e) {
            e.preventDefault();
            var devise_id = $(this).attr('id');
            $('#devise_id').val(devise_id);
            $("#myModaldevises").modal('show');
        });
        $("#validerdevises").click(function(e) {
            e.preventDefault();
            var devisechoisi = $('#selectdevise option:selected').attr('value');
            var devise_id = $('#devise_id').val();
            $('#' + devise_id).val(devisechoisi);
            $("#myModaldevises").modal('hide');

        });
        $(".table").on('click', '.comptes', function(e) {
            e.preventDefault();
            var compte_id = $(this).attr('id');
            var compte_id2 = $(this).attr('id2');
            $('#compte_id').val(compte_id);
            $('#compte_id2').val(compte_id2);
            $("#myModalcomptes").modal('show');
        });
        $("#validercomptes").click(function(e) {
            e.preventDefault();
            var comptechoisi = $('#selectcompte option:selected').attr('value');
            var cat = $('#selectcompte option:selected').attr('cat');
            var num = $('#selectcompte option:selected').attr('num');
            var compt = $('#selectcompte option:selected').attr('compt');
            var comptechoisilib = $('#selectcompte option:selected').text();
            var compte_id = $('#compte_id').val();
            var compte_id2 = $('#compte_id2').val();

            $('#' + compte_id).val(comptechoisilib);
            $('#compte' + compte_id2).val(comptechoisi);

            $('#cat' + compte_id2).val(cat);
            $('#num' + compte_id2).val(num);
            $('#compt' + compte_id2).val(compt);

            $("#myModalcomptes").modal('hide');

        });
        $(".table").on('click', '.debits', function(e) {
            e.preventDefault();
            var id3 = $(this).attr('id3');
            $('#credit' + id3).val(0);
        });
        $(".table").on('click', '.credits', function(e) {
            e.preventDefault();
            var id4 = $(this).attr('id4');
            $('#debit' + id4).val(0);
        });

    });
</script>
<form action="<?php echo H_ADMIN_MAIN . '&view=cptjournal&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2><b>Journalisation</b></h2>
                </div>
                <div class="col-sm-4 ">
                    <button type="submit" class="btn btn-primary btn-flat pull-right" id="btnjournaliser" name="btnjournaliser"><i class="fa fa-save"></i> Enregister</button>
                </div>
            </div>
            <div class="output"></div>
        </div>
        <div class="row">
            <div class="col-lg-3 form-group">
                <label>Exercice</label>
                <select id="exercice_id" name="exercice_id" class="form-control choz">
                    <option value=""></option>
                    <?php
                    foreach ($exercices as $rows) {
                    ?>
                        <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->lib); ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input name="exercice_lib" id="exercice_lib" type="hidden" value="">
            </div>

            <div class="col-lg-3 form-group">
                <label>Type de journal</label>
                <select name="typejournal" class="form-control select2" style="width: 100%;" id="typejournal">
                    <option value=""></option>
                    <?php
                    foreach ($result2 as $rows) {
                    ?>
                        <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->libelle); ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="hidden" id="libtypejournal" name="libtypejournal" value="">

            </div>



            <div class="col-lg-3 form-group">
                <label>Réference</label>
                <input type="text" id="referenceaff" name="referenceaff" class="form-control" disabled="disabled">
                <input type="hidden" id="reference" name="reference" class="form-control" value="">
                <input type="hidden" id="num_jour" name="num_jour" class="form-control" value="">
                <input type="hidden" id="lib_jour" name="lib_jour" class="form-control" value="">
            </div>
            <div class="col-lg-3 form-group">
                <label>Date</label>
                <input type="text" id="dte2" name="dte" class="form-control datepicker2" value="">
            </div>


        </div>
        <div class="row">
            <div class="col-lg-3 form-group">
            </div>
            <input type="hidden" id="isjanouveau" name="isjanouveau" value="0">
            <div class="row clsjanouveau" style="display:none;">
                <div class="col-lg-2 form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="janouveau" id="janouveau" class="minimal " value="ant">
                            Antérieure
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="janouveau" id="janouveau" class="minimal" value="cum" checked>
                            Cumul
                        </label>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 form-group">
                <label>Devise</label>
                <select id="devise" name="devise" class="form-control choz">
                    <option value=""></option>
                    <option value="CDF">CDF</option>
                    <option value="USD">USD</option>
                </select>
            </div>
            <div class="col-lg-3 form-group">
                <label>Description</label>
                <textarea rows="1" id="description" name="description" class="form-control"></textarea>
            </div>
        </div>

        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success btn-flat add-new"><i class="fa fa-plus"></i> Ajouter opération</button>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Compte</th>
                    <th>Débit</th>
                    <th>Crédit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="lignesjournal">

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
            <div class="modal-body modalbodycompte">
                <input id="compte_id" name="compte_id" type="hidden" value="">
                <input id="compte_id2" name="compte_id2" type="hidden" value="">
                <select id="selectcompte" name="selectcompte" class="form-control choz">
                    <?php
                    foreach ($result as $rows) {
                    ?>
                        <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->numero . ' . ' . $rows->libelle); ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger pull-right" id="validercomptes"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
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