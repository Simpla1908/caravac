<!-- Modal -->
<div class="modal fade" id="ModalPermut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><strong>Justification</strong></h4>
            </div>
            <div class="modal-body">
               <!-- <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message">
                    <span id="message"> Best check yo self, you're not looking too good.</span>
                </div>
-->
                <div class="output"></div>
                <form action="" method="post" id="formjustif" name="formjustif" class="">
                    <input type="hidden" name="idpoint" id="idpoint" value="">
                    <input type="hidden" name="datedebut" id="datedebut" value="">
                    <input type="hidden" name="datefin" id="datefin" value="">
                    <input type="hidden" name="idemply" id="idemply" value="">
                       <div class="row">
                    <div class="col-lg-12">
                        <label>Commentaire</label>
                    </div>
                     </div>
                     <div class="row">
                    <div class="col-lg-12">
                        <input type="text" name="justif" class="form-control" id="justif" value="">

                    </div>
                     </div>
                      <div class="row">
                     <div class="col-lg-3">
                        <input type="checkbox" name="ismalade"  id="ismalade" value="1">  <label>Malade</label>
                    </div>
                     <div class="col-lg-9">
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn_modal" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary btn_modal" id="btn_valider_justif">Valider</button>
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

