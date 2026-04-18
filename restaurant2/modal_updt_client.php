    <!-- Modal -->
    <div class="modal fade" id="myModalUPTClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel"><strong>Modification client</strong></h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="formupdtclient" class="form">
                        <div class="form-group">
                            <label>Noms</label>
                            <input type="hidden" id="id22" name="id" value="">
                            <input type="text" id="noms22" name="noms" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Sexe</label>
                            <select name="sexe" class="form-control select2"
                            style="width: 100%;" id="sexe22">
                            <option value="masculin">Masculin</option>
                            <option value="feminin">Feminin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Télephone</label>
                        <input type="text" id="tel22" name="tel" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" id="email22" name="email" class="form-control" value="">
                    </div>
                        <div class="form-group">
                            <label>Remise</label>
                            <input type="text" class="form-control"  value="" id="remise22" name="remise">
                        </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn_modal" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary " data-dismiss="modal" id="updcustomerresto_pro">Valider</button>
                <span class="btn btn-danger loader hidden">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours, patientez!
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
