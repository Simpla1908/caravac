<!--<!-- Modal -->
<form action="./Traitement/reglement.php" method="post" id="formpaiement">
    <div class="modal fade" id="myModal_paie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">Paiement facture</h5>
                </div>
                <div class="modal-body" id="loader"></div>
                <div class="modal-body" id="popup_paie">
                    <!--                    <h1 class="box-title text-center">
                                            <b>95000 FC soit 100 $</b>
                                        </h1>-->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <h4 class="box-title text-center">
                                <b id="mont_fc"> 0</b> CDF
                                <small> Soit</small>
                                <b id="mont_usd">0</b> USD
                            </h4>
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label>Montant en CDF:</label>
                                            <div class="input-group">
                                                <input name="taux" id="taux" type="hidden" value=" <?php /*echo $tauxdollar;*/?>"/>
                                                <input name="res_ch_id" id="res_ch_id" type="hidden" value=""/>
                                                <input name="chambreid" id="chambreid" type="hidden" value="0"/>
                                                <input type="hidden" id="commandeID" name="commandeID"
                                                       class="form-control text-right text-blue" value="">
                                                <input type="hidden" id="client_id" name="id_client"
                                                       class="form-control text-right text-blue" value="">
                                                <input type="text" id="mont_commande" name="mont_commande"
                                                       class="form-control text-right text-blue montant_py_resto" value="0">
                                                <span class="input-group-addon">CDF</span>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 form-group">
                                            <label>Montant en USD:</label>
                                            <div class="input-group">
                                                <input type="hidden" id="mont_usd_lbl" name="mont_usd_lbl"
                                                       class="form-control text-right text-blue" value="">
                                                <input type="hidden" id="mont_commandeUSD_tot"
                                                       name="mont_commandeUSD_tot"
                                                       class="form-control text-right text-blue" value="">
                                                <input type="text" id="mont_commandeUSD" name="mont_commandeUSD"
                                                       class="form-control text-right text-blue montant_py_resto" value="0">
                                                <span class="input-group-addon">USD</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label>Mode de paiement</label>
                                            <select name="modepaiement" class="form-control select2"
                                                    style="width: 100%;" id="modepaiement">
                                                <option value="2" selected="selected">Cash</option>
                                                <option value="3">à crédit</option>
                                            </select>
                                        </div>
                                        <br>
                                        <h4 class="box-title text-center">
                                            Montant rendu : <b id="mont_rnd_cdf"> 0</b> CDF
                                            <small> Soit</small>
                                            <b id="mont_rnd_usd"> 0</b> USD
                                        </h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class=" modal-footer">
                        <button type="submit" id="valider1" class="btn btn-primary"><i class="fa fa-check fa-fw"></i>&nbsp;Valider
                        </button>
                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script>
    // JavaScript Document
    $(document).ready(function () {

        $('#mont_commandeUSD').keyup(function () {
            alert('fgcgcgxs');
        });

    });
</script>-->