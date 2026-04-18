<?php
// Inclusion du fichier contenant la connexion à la base
include('Receptionniste.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php 
$_SESSION['p_debut']=date('d/m/Y');
$_SESSION['p_fin']=date('d/m/Y');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Paiements</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-list fa-fw"></i> Situation paiement <span id="lbl_paie" class="text-danger">global</span>
                    <div class="pull-right">
                    <a href="#" data-toggle="modal" data-target="#myModal1" title="Filtrer la liste" class="btn btn-danger btn-xs " >
                        <i class="fa fa-hourglass-half"></i> Filtrer
                    </a>
                    <a href="paiement_acompte_res.php" class="btn btn-primary btn-xs" title="Acomptes des réservations opérationnelles" >
                        <i class="fa fa-money"></i> Acomptes Réservations
                    </a>
                        </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>N°Facture</th>
                                    <th>Client</th>
                                    <th>Responsable</th>
                                    <th>Montant Total</th>
                                    <th>Montant Payé</th>
                                    <th>Reste</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tb_contenu" class="table_occup_prev">
                                <?php include('datapaiement.php'); ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!--Modal-->
    <?php
    include('../paiement/modal_paiement.php');
    ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">Filtrage paiement</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="filtreclient" class="form-vertical">
                        <div class="row">
                            <div class="col-md-10 ">
                                    <label>Filtrer par&nbsp;:</label>
                                    <select class="form-control" id="filtre" name="filtre" required>
                                        <option value="occupe" selected="selected">Clients logés</option>
                                        <option value="libre">Clients liberés</option>
                                    </select>
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="btn_occup_prev">&nbsp;Valider</button>
                     <span class="btn btn-danger hidden" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                     </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datedebut').datetimepicker({format: 'd/m/Y'});
    $('#datefin').datetimepicker({format: 'd/m/Y'});
    
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>
<script src="../js/paiement.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
      $('#dataTables-example').dataTable(
             {
                "ordering": false,
             }
          );
        $('#btn_occup_prev').click(function (e) {
            e.preventDefault();
            var bool = false;
            var filtre = $('#filtre').val();
            var donnees = $('#filtreclient').serialize();
            $.ajax({
                url: 'datapaiement.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_occup_prev").addClass('hidden');
                },
                success: function (data) {
                    $('#tb_contenu').empty().append(data);
                    if(filtre=='occupe'){
                       $('#lbl_paie').text("clients logés");
                    }else{
                        $('#lbl_paie').text("clients liberés");
                    }
                    $("#myModal1").modal('hide');
                    bool = true;
                }, complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                        $("#btn_occup_prev").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });

        });
        $("#tb_contenu").on('click', '.btn_modal_payer', function (e) {
            e.preventDefault();
            var  id_res = $(this).attr("id_res");
            var  nom_cl = $(this).attr("nom_cl");
            var  donnees = '';
            $('.montant_fact').text("");
            $('#etat_fact9').val("regler2");
            $('#id_res').val(id_res);
            $('#nom_cl').val(nom_cl);
            $.ajax({
                url: 'combo_fact_datas.php?id_res=' + id_res,
                type: 'POST',
                success: function (html) {
                    $("#znefact").empty().append(html);
                }
            });

        });
        $(".f_modal_paiement").on('change', '#slctfact', function (e) {
            e.preventDefault();
            $("#lib_mode").val($('#mode option:selected').text());
//            $('#etat_fact').val($('#slctfact option:selected').attr("etat_fact"));
            $('#taux_fact').val($('#slctfact option:selected').attr("taux_fact"));
            $('#montant_fact').val($('#slctfact option:selected').attr("montant_fact"));
            $('#montant_paye').val($('#slctfact option:selected').attr("montant_paye"));
            $('#montant_tot').val($('#slctfact option:selected').attr("montant_tot"));
            $('.montant_fact').text($('#slctfact option:selected').attr("montant_fact_af"));
            $('#id_fact').val($('#slctfact option:selected').attr("id_fact"));
            $('#id_res').val($('#slctfact option:selected').attr("id_res"));
            $('#s').val($('#slctfact option:selected').attr("service"));
            $("#rendu").text('0.00');
        });
    });

</script>

