<!-- Modal -->
<form action="./Traitement/reglement.php" method="post" id="suivi">
    <div class="modal fade" id="myModal_suivi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">Suivis d'Activités</h5>
                </div>
                <div class="modal-body" id="popup_paie">
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <h4 class="box-title text-center">
                                <b>VENTE CASH</b>
                            </h4>
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <ul class="list-group list-group-unbordered">
                                                <li class="list-group-item">
                                                    <b>Montat USD</b> <a class="pull-right"><b class="cash_usd"></b></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Montat CDF</b> <a class="pull-right"><b class="cash_cdf"></b></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-group" id="accordion">
                            <h4 class="box-title text-center">
                                <b>VENTE CREDIT</b>
                            </h4>
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <ul class="list-group list-group-unbordered">
                                                <h4 class="box-title text-center">
                                                   <span class="credit"> 0 USD</span>
                                                    <small> Soit</small>
                                                    <span class="credit_eq"> 0 CDF</span>
                                                </h4>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class=" modal-footer">
<!--                        <button type="button" class="btn btn-default" data-dismiss="modal">Imprimer</button>
-->                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>
