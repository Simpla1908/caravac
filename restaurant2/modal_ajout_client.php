    <!-- Modal -->
    <div class="modal fade" id="myModalAddClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Ajout client</strong></h4>
                </div>
                <div class="modal-body" style="height:450px;">
                    <div id="msgclpopup" class="alert alert-success alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span id="msgcl_alertpopup">L'enrégistrement s'est effectué avec succès!</span>
                    </div>
                    <form action="./Traitement/addclient.php" method="post" id="formaddclient" class="form">
                        <div class="col-lg-12 form-group">
                            <label>Noms</label>
                            <input type="text" id="noms" name="noms" class="form-control" value="">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label>Sexe</label>
                            <select name="sexe" class="form-control select2" style="width: 100%;" id="sexe">
                                <option value=""></option>
                                <option value="masculin">Masculin</option>
                                <option value="feminin">Feminin</option>
                            </select>
                        </div>

                        <div class="col-lg-12 form-group">
                            <label>Télephone</label>
                            <input type="text" id="tel" name="tel" class="form-control" value="">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label>E-mail</label>
                            <input type="text" id="email" name="email" class="form-control" value="">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label>Remise</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="remisecl" name="remisecl" value="40">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary btn_modal" id="btn_add_client_conf">Valider</button>
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