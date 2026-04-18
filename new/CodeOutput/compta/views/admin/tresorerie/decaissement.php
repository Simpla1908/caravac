
  <?php
        /*
        * =======================================================================
        * FILE NAME:        Add.php
        * DATE CREATED:     18-04-2019
        * FOR TABLE:        cptjournal
        * PRODUCED BY:      HEZECOM UltimateSpeed PHP CODE GENERATOR
        * AUTHOR:           Hezecom (http://hezecom.com) info@hezecom.net
        * =======================================================================
        */
        if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
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
        <script type="text/javascript">
          $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();
        // Append table with add row form on add new button click
        $(".add-new").click(function(){
            //$(this).attr("disabled", "disabled");
            var rowCount = $('#lignesjournal tr').length;
            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
            '<td><input type="text" class="form-control comptes" name="comptelib[]" id="comptelib'+rowCount+'" id2="'+rowCount+'"><input type="hidden" name="compte[]" id="compte'+rowCount+'" value=""></td>' +
            '<td><input type="text" class="form-control debits" name="debit[]" id="debit'+rowCount+'" id3="'+rowCount+'"></td>' +
            '<td><input type="text" class="form-control credits" name="credit[]" id="credit'+rowCount+'" id4="'+rowCount+'"></td>' +
            '<td><a class="delete" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a></td>'+
            '</tr>';
            $("table").append(row);     
            $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
            $('[data-toggle="tooltip"]').tooltip();

          });
        // Add row on add button click
        $(document).on("click", ".add", function(){
          var empty = false;
          var input = $(this).parents("tr").find('input[type="text"]');
          input.each(function(){
            if(!$(this).val()){
              $(this).addClass("error");
              empty = true;
            } else{
              $(this).removeClass("error");
            }
          });
          $(this).parents("tr").find(".error").first().focus();
          if(!empty){
            input.each(function(){
              $(this).parent("td").html($(this).val());
            });         
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").removeAttr("disabled");
          }       
        });
        // Edit row on edit button click
        $(document).on("click", ".edit", function(){        
          $(this).parents("tr").find("td:not(:last-child)").each(function(){
            $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
          });     
          $(this).parents("tr").find(".add, .edit").toggle();
          $(".add-new").attr("disabled", "disabled");
        });
        // Delete row on delete button click
        $(document).on("click", ".delete", function(){
          $(this).parents("tr").remove();
          $(".add-new").removeAttr("disabled");
        });
      });

          $(document).ready(function () {

            $(".table").on('click', '.devises', function (e) {
              e.preventDefault();
              var devise_id = $(this).attr('id');
              $('#devise_id').val(devise_id);
              $("#myModaldevises").modal('show');
            });
            $("#validerdevises").click(function (e) {
              e.preventDefault();
              var devisechoisi = $('#selectdevise option:selected').attr('value');
              var devise_id=$('#devise_id').val();
              $('#'+devise_id).val(devisechoisi);
              $("#myModaldevises").modal('hide');

            });
            $(".table").on('click', '.comptes', function (e) {
              e.preventDefault();
              var compte_id = $(this).attr('id');
              var compte_id2= $(this).attr('id2');
              $('#compte_id').val(compte_id);
              $('#compte_id2').val(compte_id2);
              $("#myModalcomptes").modal('show');
            });
            $("#validercomptes").click(function (e) {
              e.preventDefault();
              var comptechoisi = $('#selectcompte option:selected').attr('value');
              var comptechoisilib = $('#selectcompte option:selected').text();
              var compte_id=$('#compte_id').val();
              var compte_id2=$('#compte_id2').val();

              $('#'+compte_id).val(comptechoisilib);
              $('#compte'+compte_id2).val(comptechoisi);

              $("#myModalcomptes").modal('hide');

            });
            $(".table").on('click', '.debits', function (e) {
              e.preventDefault();
              var id3= $(this).attr('id3');
              $('#credit'+id3).val(0);
            });
            $(".table").on('click', '.credits', function (e) {
              e.preventDefault();
              var id4= $(this).attr('id4');
              $('#debit'+id4).val(0);
            });

          });
        </script>
        <form action="<?php echo H_ADMIN_MAIN.'&view=tresorerie&do=decaissementpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
          <div class="table-wrapper">
            <div class="table-title">
              <div class="row">
                <div class="col-sm-8"><h2><b>Decaissement</b></h2></div>
                <div class="col-sm-4 ">
                  <button type="submit" class="btn btn-primary btn-flat pull-right" id="btndecaisser" name="btndecaisser"><i class="fa fa-save"></i> Enregister</button>
                </div>
              </div>
              <div class="output"></div>
            </div>
            <div class="col-lg-4 form-group">
              <label>Compte</label>
              <input id="compteprov" name="compteprov" type="hidden" value="">
              <input id="cat" name="cat" type="hidden" value="">
              <input id="compt" name="compt" type="hidden" value="">
              <input id="num" name="num" type="hidden" value="">
              <input id="cpte_id" name="cpte_id" type="hidden" value="">
              <select id="selectcomptetresor" name="selectcomptetresor" class="form-control choz">
                <option value=""></option>
                <?php
                $nbre=count($_SESSION['Comptes']['numero']);
                for ($i = 0; $i <$nbre; $i++){
                  $id=$_SESSION['Comptes']['id'][$i];
                  $numero=$_SESSION['Comptes']['numero'][$i];
                  $nom=$_SESSION['Comptes']['nom'][$i];
                  $classe=$_SESSION['Comptes']['classe'][$i];
                  $cat=$_SESSION['Comptes']['categorie_id'][$i];
                  $compt=$_SESSION['Comptes']['compte_id'][$i];
                  $modif=$_SESSION['Comptes']['modif'][$i];
                  ?>
                  <option value="<?php echo $id; ?>" cat="<?php echo $cat; ?>" compt="<?php echo $compt; ?>" num="<?php echo $numero; ?>"><?php echo ucfirst($numero.' . '.$nom); ?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
             <div class="col-lg-4 form-group">
          <label>Bon de decaissement</label>
          <input type="hidden" id="num_cmd" name="num_cmd"  value="<?php echo $num_cmd; ?>">
          <input type="hidden" id="numBon" name="numBon"  value="<?php echo $numBon; ?>">
          <input type="text" id="numBonaff" name="numBonaff" class="form-control" value="<?php echo $numBon; ?>" disabled="disabled">

      </div>
            <div class="col-lg-4 form-group">
              <label>Description</label>
              <input type="text" id="libelle" name="libelle" class="form-control" value="">
            </div>
            <div class="col-lg-4 form-group">
              <label>Beneficiaire</label>
              <input type="text" id="beneficiaire" name="beneficiaire" class="form-control" value="">
            </div>
            <div class="col-lg-4 form-group">
              <label>Date</label>
              <input type="text" id="datebonentre" name="date_heure_bon" value="<?php echo date('d/m/Y H:i:s') ?>" class="form-control">
            </div>
             <div class="col-lg-2 form-group">
              <label>Monnaie</label>
              <select id="monnaie" name="monnaie" class="form-control choz changemonnaiesortie">
                <option value=""></option>
                <option value="fc">CDF</option>
                <option value="usd">USD</option>
              </select>
            </div>
            <div class="col-lg-2 form-group">
              <label>Montant</label>
              <input type="text" id="montant" name="montant" class="form-control" value="">
            </div>
           
            
            <div class="table-title">
              <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                  <button type="button" class="btn btn-success btn-flat add-new hidden"><i class="fa fa-plus"></i> Ajouter opération</button>
                </div>
              </div>
            </div>
            
          </div>
        </form>
        