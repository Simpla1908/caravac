<div class="col-lg-12">
    <div class="panelt">
        <form id="formaddclient" action="Traitement/addclient.php" method="post">
            <div class="body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Noms</label>
                            <input type="text" class="form-control" id="noms"
                                   name="noms" placeholder="Noms" value="">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sexe</label>
                            <select name="sexe" class="form-control select2" style="width: 100%;" id="sexe">
                                <option value=""selected="selected"></option>
                                <option value="masculin">Masculin</option>
                                <option value="feminin">Feminin</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Télephone</label>
                            <input type="text" class="form-control" id="tel"
                                   name="tel" placeholder="Telephone" value="">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" id="email"
                                   name="email" placeholder="E-mail" value="">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <div class="box-footer">
                <div class="col-md-9">
                    <div id="msgcl" class="alert alert-success alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span id="msgcl_alert">L'enrégistrement s'est effectué avec succès!</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-info pull-right"
                            id="btn_add_client_conf"><i class="fa fa-save fa-fw"></i>&nbsp;Enregistrer
                    </button>
                </div>
            </div>

        </form>
        <!-- /.box-footer -->
    </div>
</div>