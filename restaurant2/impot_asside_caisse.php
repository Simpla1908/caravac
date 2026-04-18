<aside class="control-sidebar control-sidebar-dark">
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-settings-tab">
            <h3 class="control-sidebar-heading">Fonds de caisse</h3>
            <!-- search form -->
            <div id="msgcl" class="alert alert-success alert-dismissable" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="msgcl_alert">Succès!</span>
            </div>
            <form action="./Traitement/insertion_fond_caisse.php" method="post" id="formfdc" class="sidebar-form1">
                <div class="form-group" id="grpmontantusd">
                    <label>Montant en USD</label>
                    <input type="text" name="montantusd" id="montantusd" class="form-control" value="" placeholder="Montant en USD">
                </div>
                <div class="form-group" id="grpmontantcdf">
                    <label>Montant en CDF</label>
                    <input type="text" name="montantcdf" id="montantcdf" class="form-control" value="" placeholder="Montant en CDF">
                </div>
                <div class="form-group">
                    <button type="submit" name="save_fdc" id="save_fdc" class="btn btn-primary btn-block">
                        <i class="fa fa-check"></i> Valider
                    </button>
                    <span class="btn btn-danger hidden btn-block" id="loader_fdc">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </form>
            <!-- /.search form -->
        </div>
       
    </div>
</aside>
<div class="control-sidebar-bg"></div>