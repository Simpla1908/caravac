<!-- Modal -->
<form action="impression/examples/imprime_journal_caisse_journalier.php" method="post" target="_blank">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <i class="fa fa-warning fa-fw"></i> Suppression
                </div>
                <div class="modal-body">
                    <h4>Etes-vous sûr de vouloir supprimer cet élément ?</h4>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" id="confirmModalNo">Non</a>
                    <a href="#" class="btn btn-primary" id="confirmModalYes">Oui</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="myModalFAM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <i class="fa fa-warning fa-fw"></i> Suppression
                </div>
                <div class="modal-body">
                    <h4>Etes-vous sûr de vouloir supprimer cette famille?</h4>
                    <input class="form-control hidden" name="famid" id="famid" value="">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" id="confirmModalNoFam">Non</a>
                    <a href="#" class="btn btn-primary" id="confirmModalYesFam">Oui</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="myModalSFAM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <i class="fa fa-warning fa-fw"></i> Suppression
                </div>
                <div class="modal-body">
                    <h4>Etes-vous sûr de vouloir supprimer cette sous-famille?</h4>
                    <input class="form-control hidden" name="sfamid" id="sfamid" value="">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" id="confirmModalNoSFam">Non</a>
                    <a href="#" class="btn btn-primary" id="confirmModalYesSFam">Oui</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</form>