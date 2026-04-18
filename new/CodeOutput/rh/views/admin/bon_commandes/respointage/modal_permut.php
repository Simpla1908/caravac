<!-- Modal -->
<div class="modal fade" id="ModalPermut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Ajout permutation</strong></h5>
            </div>
            <div class="modal-body">
                <div class="output"></div>
                <form action="" method="post" id="formpermut" name="formpermut" class="">
                    <input type="hidden" name="horairelib" id="horairelib" value="">
                    <input type="hidden" name="nomagent1" id="nomsagent1" value="">
                    <input type="hidden" name="nomagent2" id="nomsagent2" value="">
                    <div class="row">
                     <div class="col-lg-12 form-group">
                     <label>Type de permutation</label>
                    </div> 
                    <div class="col-lg-12 form-group">
                            <select class="form-control choz" name="type_permut" id="type_permut">
                                <option value="0"></option>
                                <option value="1">Entre agents</option>
                                <option value="2">Entreprise</option>
                            </select>
                    </div>   
                    </div>   
                    <div class="row"> 
                    <div class="col-lg-12 form-group">
                     <label>Horaire</label>
                    </div>  
                    <div class="col-lg-12 form-group">
                            <select class="form-control choz" name="horaire_id" id="horaire_id">
                                <option value="0"></option>
                                <?php
                                foreach ($result1 as $rows) {
                                    ?>
                                    <option value="<?php echo $rows->idh; ?>"><?php echo ucfirst($rows->libh); ?></option>
                                <?php } ?>
                            </select>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12 form-group">
                     <label>Titulaire</label>
                    </div>
                    <div class="col-lg-12 form-group">
                            <select class="form-control choz" name="agent1" id="agent1">
                                <option value="0"></option>
                                <?php
                                foreach ($result2 as $rows) {
                                    ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->noms); ?></option>
                                <?php } ?>
                            </select>
                    </div>
                      </div>
                    <div class="row">
                    <div class="col-lg-12 form-group">
                     <label>Remplaçant</label>
                    </div>
                    <div class="col-lg-12 form-group ">
                        <select class="form-control choz" name="agent2" id="agent2">
                            <option value="0"></option>
                            <?php
                            foreach ($result2 as $rows) {
                                ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->noms); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                     </div>
                    <div class="row">
                    <div class="col-lg-12 form-group">
                     <label>Date de début</label>
                    </div>
                     <div class="col-lg-12 form-group">
                        <input type="text" name="dte_dbt" class="form-control disabled" id="dte_dbt" value="<?php echo date('d/m/Y'); ?>">
                    </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label>Date de fin</label>
                        </div>
                        <div class="col-lg-12 form-group">
                            <input type="text" name="dte_fin" class="form-control datepicker2" id="dte_fin" value="">
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn_modal" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary btn_modal" id="btn_valider_permut">Valider</button>
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

