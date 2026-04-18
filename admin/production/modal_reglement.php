 <?php $result=getModepaiement($bdd);  ?>
<div class="modal fade" id="myModalreglement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Paiement : <span id="affiche_montfact"></span></strong></h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message">
                        <span id="message"> Best check yo self, you're not looking too good.</span>
                 </div>
                <form action="../traitement/souscription.php" method="post" id="form" class="f_modal_paiement">
                    <div class="col-lg-12 form-group hidden">
                        <input type="text" name="fact_id" id="fact_id" value="">
                        <input type="text" name="mont_fact" id="mont_fact" value="">
                        <input type="text" name="modulecomp_id" id="modulecomp_id" value="">
                        <input type="text" name="lfp_id" id="lfp_id" value="">
                        <input type="text" name="pack_id" id="pack_id" value="">
                        <input type="text" name="activer" id="activer" value="">
                        <input type="text" name="id_hotel" id="id_hotel" value="">
                        <input type="text" name="company_id" id="company_id" value="">
                        <input type="text" name="regler" id="regler" value="">
                        <input type="text" name="action" id="action" value="regler">
                        <input type="text" name="statut" id="statut1" value="">
                        <input type="text" name="pack_company_id" id="pack_company_id">
                        <input type="text" name="type_souscript" id="type_souscript">
                    </div>
                    <input type="hidden" name="statut" id="statut" value="">
                    <input type="hidden" name="id_user" id="id_user">
                    <input type="hidden" name="prnom_user" id="prnom_user">
                    <input type="hidden" name="nom_user" id="nom_user">
                    <input type="hidden" name="mail_company" id="mail_company">
                    <input type="hidden" name="fact1" id="fact1">
                    <div class="col-lg-12 form-group cachebtn">
                        <label>Mode de paiement</label>
                        <select name="modepaiement" class="form-control select2" style="width: 100%;" id="mode">
                             <?php foreach($result as $o){ ?>
                                <option value="<?php echo $o->id_mode_regl ?>"><?php echo $o->lib  ?></option>
                             <?php } ?> 
                        </select>
                    </div>
                    <div class="col-lg-12 form-group cachebtn" id="div_montant">
                        <label>Montant</label>
                        <div class="input-group">
                            <input type="text" id="montant" name="montant" class="form-control text-right montant" value="">
                            <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                        </div>
                    </div>
                    <span class="text-center" style="margin-left: 20px;">Rendu: <span class="text-center" id="rendu">0.00</span> <?php echo getsymbole_devise(); ?> </span></br></br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn_cache" data-dismiss="modal">Annuler</button>
                 <span class="loader text-danger hidden">
                    <i class="fa fa-refresh fa-spin fa-1x text-danger"></i> Patientez !
                  </span>
                <button type="submit" class="btn btn-primary btn_cache" id="btn_paie_fact"><i class="fa fa-print fa-fw"></i>&nbsp;Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
