<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:    18-04-2019
 * FOR TABLE:       cptjournal
 * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
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
                '<td><input type="text" class="form-control comptes" name="comptelib[]" id="comptelib' + rowCount + '" id2="' + rowCount + '"><input type="hidden" name="compte[]" id="compte' + rowCount + '" value=""></td>' +
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
            var comptechoisilib = $('#selectcompte option:selected').text();
            var compte_id = $('#compte_id').val();
            var compte_id2 = $('#compte_id2').val();

            $('#' + compte_id).val(comptechoisilib);
            $('#compte' + compte_id2).val(comptechoisi);

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
                    <h2> <b>Compte de résultat</b></h2>
                </div>
                <div class="col-sm-4 ">
                    <ul class="nav pull-right">
                        <button type="submit" class="btn btn-primary btn-flat pull-right" id="btngenereresultat" name="btngenereresultat"><i class="fa fa-save"></i> Valider</button>
                        <a href="#" id="btnprintdisabled" class="btn btn-danger btn-flat" disabled><i class="fa fa-print"></i> Imprimer </a>
                        <a href="#" id="btnprintabled" data-toggle="modal" data-target="#modalChoiceFileresultat" class="btn btn-danger btn-flat" style="display:none;"><i class="fa fa-print"></i> Imprimer </a>

                    </ul>
                </div>
            </div>
            <div class="output"></div>
        </div>
        <div class="col-lg-2 form-group">
            <label>Exercice</label>
            <select name="exercicesn" class="form-control choz" style="width: 100%;" id="exercicesn">
                <option value=""></option>
                <?php
                foreach ($exercicesn as $rows) {
                ?>
                    <option value="<?php echo $rows->id; ?>" debut="<?php echo $rows->debut; ?>" fin="<?php echo $rows->fin; ?>"><?php echo ucfirst($rows->lib); ?></option>
                <?php
                }
                ?>
            </select>
            <input name="exercicesnlib" id="exercicesnlib" type="hidden" value="">
            <input name="dte1n" id="dte1n" type="hidden" value="">
            <input name="dte2n" id="dte2n" type="hidden" value="">
        </div>
        <div class="col-lg-2 form-group">
            <label>Comparé à </label>
            <select name="exercicesn1" class="form-control choz" style="width: 100%;" id="exercicesn1">
                <option value=""></option>
                <?php
                foreach ($exercicesn1 as $rows) {
                ?>
                    <option value="<?php echo $rows->id; ?>" debut="<?php echo $rows->debut; ?>" fin="<?php echo $rows->fin; ?>"><?php echo ucfirst($rows->lib); ?></option>
                <?php
                }
                ?>
            </select>
            <input name="exercicesn1lib" id="exercicesn1lib" type="hidden" value="">
            <input name="dte1n1" id="dte1n1" type="hidden" value="">
            <input name="dte2n1" id="dte2n1" type="hidden" value="">
        </div>
        <div class="col-lg-2 form-group">
            <label>Devise</label>
            <select id="devise" name="devise" class="form-control choz">
                <option value="CDF">CDF</option>
                <option value="USD">USD</option>
            </select>
        </div>
        <br><br>
        <div class="row" id="resultgenereresultat">
            <?php
            // $bdd = ConnectWithUtf();
            // $site_id = $_SESSION['idsite'];
            // DatasExerciceDefault($site_id, $bdd);
            // $devise = "USD";
            // $dte1n = $dte1n1 = $_SESSION['exercice_debut'];
            // $dte2n = $dte2n1 = $_SESSION['exercice_fin'];
            // $dte1n = '2021-01-01';
            // $dte2n = '2021-12-31';
            // $dte1n1 = '2020-01-01';
            // $dte2n1 = '2020-12-31';
            // $exercicesn = $exercicesn1 = $_SESSION['exercice_id'];
            // $comptederesultat = GetResultCompta($devise, $dte1n, $dte2n, $exercicesn, $dte1n1, $dte2n1, $exercicesn1, $site_id, $bdd);
            // var_dump($comptederesultat);
            ?>
        </div>

    </div>
</form>
<div class="modal fade" id="modalChoiceFileresultat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <input name="typedoc" id="pdf" type="radio" value="pdf" class="flat-red" checked="checked">
                        </div>
                        <div class="form-group">
                            <label for="typedoc">EXCEL</label>
                            <input name="typedoc" id="excel" type="radio" value="excel" class="flat-red">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger pull-right col-md-2" id="btnChoiceFileresultat">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>