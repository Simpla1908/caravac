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
            // var rowCount = $('#lignesjournal tr').length;
            var rowCount = $('#rows').val();

            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
                '<td><input type="text" class="form-control comptes" name="comptelib[]" id="comptelib' + rowCount + '" id2="' + rowCount + '"><input type="hidden" name="compt[]" id="compt' + rowCount + '"  value=""><input type="hidden" name="cat[]" id="cat' + rowCount + '"  value=""><input type="hidden" name="num[]" id="num' + rowCount + '"  value=""><input type="hidden" name="compte[]" id="compte' + rowCount + '"  value=""></td>' +
                '<td><input type="hidden" class="form-control" name="debit[]" id="debit' + rowCount + '"><input type="text" class="form-control debits" name="debitaff[]" id="debitaff' + rowCount + '" id3="' + rowCount + '" value=""></td>' +
                '<td><a class="delete" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a></td>' +
                '</tr>';
            $("table").append(row);
            $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
            $('[data-toggle="tooltip"]').tooltip();
            $('#rows').val(parseInt(rowCount) + 1);

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
<form action="<?php echo H_ADMIN_MAIN . '&view=cptprevision&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2><b>Prévisions</b></h2>
                </div>
                <div class="col-sm-4 ">
                    <button type="submit" class="btn btn-primary btn-flat pull-right" id="btnupdateprevi" name="btnupdateprevi"><i class="fa fa-save"></i> Enregister</button>
                </div>
            </div>
            <div class="output"></div>
        </div>
        <div class="row">
            <input type="hidden" id="prev_id" name="prev_id" value="<?php echo $id; ?>">

            <div class="col-lg-3 form-group">
                <label>EXERCICE</label>
                <select id="exercice_id" name="exercice_id" class="form-control choz">
                    <option value="<?php echo $rows_previ->exercice_id; ?>"><?php echo ucfirst($rows_previ->exercice_lib); ?></option>
                    <?php
                    foreach ($exercices as $rows) {
                        if ($rows_previ->exercice_id != $rows->id) {
                    ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->lib); ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <input name="exercice_lib" id="exercice_lib" type="hidden" value="<?php echo ucfirst($rows_previ->exercice_lib); ?>">
            </div>

            <div class="col-lg-3 form-group">
                <label>DEVISE</label>
                <select id="devise" name="devise" class="form-control choz">
                    <?php
                    if ($rows_previ->devise == 'CDF') {
                    ?>
                        <option value="CDF">CDF</option>
                        <option value="USD">USD</option>
                    <?php
                    } else {
                    ?>
                        <option value="USD">USD</option>
                        <option value="CDF">CDF</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success btn-flat add-new"><i class="fa fa-plus"></i> Ajouter compte</button>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Compte</th>
                    <th>Montant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="lignesjournal">
                <?php
                $rowCount = 0;
                foreach ($result as $rows) {
                    $data = INFOSFromAccountNumber($rows->compte_ecriture, $rows->long_compte, $bdd);
                    $idcompte = $data['id'];
                    $libcompte = $data['lib'];
                    $numcompte = $rows->compte_ecriture;
                    $montaff = number_format($rows->mont, 2, ',', ' ');


                ?>
                    <tr>
                        <td>
                            <input value="<?php echo $numcompte . ' ' . ucfirst($libcompte); ?>" type="text" class="form-control comptes" name="comptelib[]" id="comptelib<?php echo $rowCount; ?>" id2="<?php echo $rowCount; ?>">
                            <input type="hidden" name="compt[]" id="compt<?php echo $rowCount; ?>" value="<?php echo $rows->compte_id; ?>">
                            <input type="hidden" name="cat[]" id="cat<?php echo $rowCount; ?>" value="<?php echo $rows->categorie_id; ?>">
                            <input type="hidden" name="num[]" id="num<?php echo $rowCount; ?>" value="<?php echo $rows->compte_ecriture; ?>">
                            <input type="hidden" name="compte[]" id="compte<?php echo $rowCount; ?>" value="<?php echo $idcompte; ?>">
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="debit[]" id="debit<?php echo $rowCount; ?>" value="<?php echo arrondir($rows->mont); ?>">
                            <input type="text" class="form-control debits" name="debitaff[]" id="debitaff<?php echo $rowCount; ?>" id3="<?php echo $rowCount; ?>" value="<?php echo $montaff; ?>">
                        </td>
                        <td><a class="delete" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                <?php
                    $rowCount++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <input type="hidden" id="rows" name="rows" value="<?php echo $rowCount; ?>">

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
                    $nbre = count($_SESSION['Comptes']['numero']);
                    for ($i = 0; $i < $nbre; $i++) {
                        $id = $_SESSION['Comptes']['id'][$i];
                        $numero = $_SESSION['Comptes']['numero'][$i];
                        $nom = $_SESSION['Comptes']['nom'][$i];
                        $classe = $_SESSION['Comptes']['classe'][$i];
                        $cat = $_SESSION['Comptes']['categorie_id'][$i];
                        $compt = $_SESSION['Comptes']['compte_id'][$i];
                        $modif = $_SESSION['Comptes']['modif'][$i];
                    ?>
                        <option value="<?php echo $id; ?>" cat="<?php echo $cat; ?>" compt="<?php echo $compt; ?>" num="<?php echo $numero; ?>"><?php echo ucfirst($numero . ' . ' . $nom); ?></option>
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