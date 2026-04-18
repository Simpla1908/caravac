<div class="modal fade" id="mdpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Paiement</h4>
            </div>

            <div class="modal-body table-responsive no-padding">
                <div class="callout hidden" style="margin-bottom: 0!important;" id="notification">
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </div>
                <form class="frmpaie">
                    <div class=" ">
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <label for="mode">Mode</label>
                            <select class=" col-md-3 form-control choz" name="mode" id="mode">
                                <?php for ($i = 0; $i <= $modecpt - 1; $i++) { ?>
                                    <?php if ($modepaiements['id'][$i] != 3) { ?>
                                        <option value="<?php echo $modepaiements['id'][$i] ?>"><?php echo $modepaiements['lib'][$i] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group" id="bloc_paiement">
                            <?php include(APP_FOLDER . '/views/admin/t_reservation/bloc_paiement.php'); ?>
                        </div>
                    </div>
                    <input name="paie_id" id="paie_id" type="hidden" value="0">
                    <input name="urlmaj" id="urlmaj" type="hidden" value="./main.php?pg=admin&view=t_reservation&do=majmp">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button class="btn btn-success hidden" id="btn_print_recuheb">&nbsp;Imprimer réçu</button>
                <button class="btn btn-danger" id="btn_val_paieheb">&nbsp;Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>