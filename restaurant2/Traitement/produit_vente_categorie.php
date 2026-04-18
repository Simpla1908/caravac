<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
include ('../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
include ('../../FUNCTION/hebergement.php');
include ('../../FUNCTION/stock.php');
include ('../../FUNCTION/restaurant.php');
?>

    <div class="box panel panel-default">
        <ol class="breadcrumb">
            <li class="pull-right"><a href="#" title="Tous les produits" class="home"><span
                        class="step size-64"><i class="fa fa-mail-reply-all fa-2x"></i> Tous les produits</span></a>
            </li>
            <div class="row">
<!--                <div class="col-xs-3">
                  <input type="text" name="product_search_code" id="product_search_code" class="form-control" value="" placeholder="Code barre">
                  <input type="hidden" name="product_code" id="product_code">
                </div>-->
                <div class="col-xs-12">
                  <input type="text" name="product_search" id="product_search" class="form-control" value="" placeholder="Recherche article">
                </div>
            </div>
         </ol>
        <div class="box-body">
            <div class="row" style="overflow: auto; height:100px;">
                <div class="col-lg-12">
                    <?php  include '../famille_produit_sousresto.php'; ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="panel panel-default box" style="overflow:auto;height:425px;">
        <div class="box-body">
            <div class="row">
                <?php include '../produits_sousresto.php'; ?>
            </div>
        </div>
    </div>
    <!-- /.box -->

<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>  
<script>
// JavaScript Document
    $(document).ready(function () {
        $(".home").click(function () {
            $(".fam").show();
            $(".s_fam").hide();
            $(".prod").show();
        });
        $(".fam").click(function () {
            id = $(this).attr("id");
            //alert(id);
            cl = "." + id;
            $(cl).show();
            $(".fam").hide();
        });
        $(".s_fam").click(function () {
            id = $(this).attr("id");
            // alert(id);
            $(".prod").hide();
            cl = "." + id;
            $(cl).show();
        });

        $('#produit a').click(function () {
            var bool = false;
            var donnees = '';
            var idprod = $(this).attr('id');
            var repas = $(this).attr('id2');
            var pa = $(this).attr('pa');
            $('#repas_resto').val(repas);
            var prixprod = $("#produit span[id=" + idprod + "]").html();
            var nameprod = $("#produit p[id=" + idprod + "]").html();
            $.ajax({
                url: 'Traitement/tableau_affichage_commandes.php?idprod=' + idprod + "&prixprod=" + prixprod + "&nameprod=" + nameprod + "&repas=" + repas + "&pa=" + pa,
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $(".loader_cmd_h").addClass('hidden');
                    $(".loader_cmd").removeClass('hidden');
                },
                success: function (data) {
                    $("#btn_paiement_rapide").attr('disabled', false);
                    $('#affiche_commandes').html(data);
                    var accpgmt = $('#accpgmt').val();
                    if (repas == 1 && accpgmt != 0) {
                        $.ajax({
                            url: 'Traitement/listeaccompagns.php?idprod=' + idprod,
                            type: 'POST',
                            data: donnees,
                            success: function (data) {
                                $('#lib_repas').val(nameprod);
                                $('#idrepas').val(idprod);
                                $('#datasaccompagn').html(data);
                                $("#myModalCHXACC").modal('show');
                            }
                        });
                    }
                    bool = true;
                    $(".loader_cmd_h").removeClass('hidden');
                },
                complete: function () {
                    if (bool) {
                        $(".loader_cmd").addClass('hidden');
                    } else {
                        $(".loader_cmd_h").removeClass('hidden');
                    }
                }
            });
            return false;
        });

    });
</script>

