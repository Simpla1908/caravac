<!-- Modal -->
<form action="impression/examples/imprime_journal_caisse_journalier.php" method="post" target="_blank">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    Confirmation de l'annulation
                </div>
                <div class="modal-body">
                    <h4>Etes-vous sûr de vouloir annuler?</h4>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" id="confirmModalNo">Non</a>
                    <a href="#" class="btn btn-primary" id="confirmModalYes">Oui</a>
                     <span class="hidden" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                     </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>