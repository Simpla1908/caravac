<!-- Modal -->
<div class="modal fade" id="ModalCg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Exécution congé</strong></h5>
            </div>
            <div class="modal-body">
                <div class="output"></div>
                <form action="" method="post" id="formpermut" name="formpermut" class="">
                    <input type="hidden" name="horairelib" id="horairelib" value="">
                    <input type="hidden" name="nomagent1" id="nomsagent1" value="">
                    <input type="hidden" name="nomagent2" id="nomsagent2" value="">
                    <div class="row">
                     <div class="col-lg-12 form-group">
                     <label>Congé</label>
                    </div> 
                    <div class="col-lg-12 form-group">
                            <select class="form-control choz" name="type_permut" id="type_permut">
                                <option value="0"></option>
                                <option value="Congé annuel de 18 jours">Congé annuel de 18 jours</option>
                                <option value="Congé annuel de 21 jours">Congé annuel de 21 jours</option>
                            </select>
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

