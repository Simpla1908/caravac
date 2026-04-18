<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <?php // if (in_array('CSR', $_SESSION['actions']['code_actions'])) { ?>
        <li class="active"><a title="Fonds de caisse" href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-dollar"></i></a></li>
            <li><a title="Infos du sous-site" href="#control-sidebar-affect-tab" data-toggle="tab"><i class="fa fa-pencil"></i></a></li>
        <?php // } ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <?php //if(in_array('CSR', $_SESSION['actions']['code_actions'])){  ?>
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
                <div class="form-group" id="fdcmotifdiv">
                    <label>Description</label>
                    <textarea name="fdcmotif" class="form-control" id="fdcmotif" rows="2">Fonds de caisse</textarea>
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
        <!-- /.tab-pane -->
        <div class="tab-pane" id="control-sidebar-affect-tab">
            <h3 class="control-sidebar-heading">Infos du sous-site</h3>
            <!-- search form -->
            <div id="msgml" class="alert alert-success alert-dismissable" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="msgml_alert">Succès!</span>
            </div>
             
            <form action="./Traitement/insertion_mention_legale.php" method="post" id="formml" class="sidebar-form1">
                <div class="form-group">
                    <?php if (in_array('AR10', $_SESSION['actions']['code_actions'])) { ?>
                     <label>Nom</label>
                    <input type="text" name="nompos" id="nompos" class="form-control" value="<?php echo $_SESSION['libelle_resto'] ?>">
                    <?php }else{ ?>
                    <input type="hidden" name="nompos" id="nompos"  class="form-control" value="<?php echo $_SESSION['libelle_resto'] ?>">
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label>Taux</label>
                    <input type="text" name="taux_op2" id="taux_op2" class="form-control" value="<?php echo arrondir($_SESSION['taux_resto']); ?>">
                </div>
                <div class="form-group">
                    <label>Remise</label>
                    <input type="text" name="remise" id="remise" class="form-control" value="<?php echo $_SESSION['remise']?>">
                </div>
                <div class="form-group">
                    <?php if (in_array('AR10', $_SESSION['actions']['code_actions'])) { ?>
                    <label>Mention légale</label>
                    <textarea name="ml" id="ml" cols="25" rows="8" class="form-control"><?php echo $_SESSION['mention'] ?></textarea>
                    <?php }else{ ?>
                     <textarea name="ml" id="ml" cols="25" rows="8" class="form-control hidden" ><?php echo $_SESSION['mention'] ?></textarea>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <button type="submit" name="save_ml" id="save_ml" class="btn btn-primary btn-block">
                        <i class="fa fa-check"></i> Valider
                    </button>
                    <span class="btn btn-danger hidden btn-block" id="loader_ml">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </form>
        </div>
        <!-- /.tab-pane -->
        <?php //} ?>
    </div>
</aside>
<div class="control-sidebar-bg"></div>