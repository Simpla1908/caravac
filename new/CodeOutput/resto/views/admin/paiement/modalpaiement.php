<!-- Modal -->
<div class="modal fade modalpaiement" id="modalpaiement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Paiement</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Mode</label>
                    <select class="form-control choz" id="produit_id" name="produit_id" required>
                        <option> Cash </option>
                        <option> Don </option>
                        <?php
//                    include("./Traitement/produit_combo.php");
//                    foreach ($produits as $p):
//                      echo  '<option value=' . $p->idprod . '>' . ucfirst($p->designation) .'</option>';
//                    endforeach;
                        ?>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Montant <?php echo getsymbole_local(); ?></label>
                    <div class="input-group">
                        <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant montant_py_resto" value="0">
                        <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                    </div>
                </div>
                  <div class="form-group">
                    <label>Montant <?php echo getsymbole_devise(); ?></label>
                    <div class="input-group">
                        <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant montant_py_resto" value="0">
                        <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                    </div>
                </div>
                <!-- /.form-group -->
            </div>
            <div class="modal-footer">
                <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                </div>
                <button  class="btn btn-danger pull-right col-md-2"
                         id="add_prod"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
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
<!-- /.modal -->