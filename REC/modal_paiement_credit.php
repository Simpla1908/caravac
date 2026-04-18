<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Paiement</h4>
            </div>
            <form method="post" action='Traitement_reservation/reglement_facture_credit.php' data-parsley-validate class="form-horizontal form-label-left" id='formPay'>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date / Heure  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="date_paye" id="datetimepicker6"  value="<?php echo date('d/m/Y H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12 date_f">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Montant <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group">
                            <input class="form-control col-md-7 col-xs-12" name="montant_usd"  id="montant">
                            <span class="input-group-addon">USD</span>
                            </div>
                            <div class="input-group">
                            <input class="form-control col-md-7 col-xs-12" name="montant_cdf"  id="montant">
                            <span class="input-group-addon">CDF</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="" name="montant_total"  id="montant_total">
                    <input type="hidden" value="" name="id_respo"  id="id_respo">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_paie_credit_valider"><i class="fa fa-check"></i> Valider</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                </div>
            </form>

        </div>
    </div>
</div>