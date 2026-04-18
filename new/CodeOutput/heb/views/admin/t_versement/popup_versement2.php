<div class="modal fade Modal_versement2" id="myModal_versement2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel">Versement</h5>
            </div>
            <div class="modal-body" id="popup_paie">
                <div id="outputvers2"></div>
                <form action='<?php echo H_ADMIN_MAIN . '&view=t_versement&do=addversement2'; ?>' method="post" id="formversement2">
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="row">

                                        <div class="col-lg-12" style="overflow: auto; height: 350px;">
                                            <div class="col-lg-12 form-group">
                                                <p class="text-center">
                                                    <strong>RECETTES</strong>
                                                </p>
                                            </div>
                                            <div class="col-lg-5">

                                                <div class="form-group">
                                                    <label>Agent</label>
                                                    <div>
                                                        <select class="form-control col-md-3 choz" name="user_vers" id="user_vers">
                                                            <option value=""></option>
                                                            <?php foreach ($users as $rows) { ?>
                                                                <option value="<?php echo $rows->id_user ?>"><?php echo $rows->nom_user . ' ' . $rows->prenom_user  ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" id="averser_usd" name="averser_usd" value="<?php echo $solde_usd; ?>">
                                                    <input type="hidden" id="averser_cdf" name="averser_cdf" value="<?php echo $solde_cdf; ?>">
                                                    <label>Montant en USD</label>
                                                    <div class="input-group">
                                                        <input type="text" id="montant_usd" name="montant_usd" class="form-control text-right text-blue " value="0">
                                                        <span class="input-group-addon">USD</span>
                                                    </div>
                                                </div>
                                                <table class="table table-condensed">
                                                    <tr>
                                                        <th class="text-center" style="width: 50%">BILLETS</th>
                                                        <th class="text-center" style="width: 50%">NOMBRES</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">100 USD</td>
                                                        <td class="text-center" style="width: 50%"><input type="number" name="100usd" id="100usd" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">50 USD</td>
                                                        <td class="text-center" style="width: 50%"><input type="number" name="50usd" id="50usd" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">20 USD</td>
                                                        <td class="text-center" style="width: 50%"><input type="number" name="20usd" id="20usd" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">10 USD</td>
                                                        <td class="text-center" style="width: 50%"><input name="10usd" id="10usd" type="number" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">5 USD</td>
                                                        <td class="text-center" style="width: 50%"><input name="5usd" id="5usd" type="number" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">1 USD</td>
                                                        <td class="text-center" style="width: 50%"><input type="number" name="1usd" id="1usd" min="0" value="0"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-5 pull-right">
                                                <div class="form-group">
                                                    <input type="hidden" id="averser_usd" name="averser_usd" value="<?php echo $solde_usd; ?>">
                                                    <input type="hidden" id="averser_cdf" name="averser_cdf" value="<?php echo $solde_cdf; ?>">
                                                    <label>Date</label>
                                                    <div>
                                                        <input type="text" id="dtevers" name="dtevers" class="form-control datepicker2" value="<?php echo date('d/m/Y'); ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Montant en CDF</label>
                                                    <div class="input-group">
                                                        <input type="text" id="montant_cdf" name="montant_cdf" class="form-control text-right text-blue " value="0">
                                                        <span class="input-group-addon">CDF</span>
                                                    </div>
                                                </div>
                                                <table class="table table-condensed">
                                                    <tr>
                                                        <th class="text-center" style="width: 50%">BILLETS</th>
                                                        <th class="text-center" style="width: 50%">NOMBRES</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">20.000 CDF</td>
                                                        <td class="text-center" style="width: 50%"><input type="number" name="20000cdf" id="20000cdf" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">10.000 CDF</td>
                                                        <td class="text-center" style="width: 50%"><input type="number" name="10000cdf" id="10000cdf" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">5.000 CDF</td>
                                                        <td class="text-center" style="width: 50%"><input type="number" name="5000cdf" id="5000cdf" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">1000 CDF</td>
                                                        <td class="text-center" style="width: 50%"><input type="number" name="1000cdf" id="1000cdf" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">500 CDF</td>
                                                        <td class="text-center" style="width: 50%"><input name="500cdf" id="500cdf" type="number" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">200 CDF</td>
                                                        <td class="text-center" style="width: 50%"><input name="200cdf" id="200cdf" type="number" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">100 CDF</td>
                                                        <td class="text-center" style="width: 50%"><input name="100cdf" id="100cdf" type="number" min="0" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="width: 50%">50 CDF</td>
                                                        <td class="text-center" style="width: 50%"><input name="50cdf" id="50cdf" type="number" min="0" value="0"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class=" modal-footer">
                        <div id="msg2" class="alert alert-success alert-dismissable" style="display: none">
                            <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                            <span id="msg_alert2">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                        </div>
                        <span class="btn btn-danger loader hidden">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours!
                        </span>
                        <button type="submit" id="verser_montant_heb2" class="btn btn-primary"><i class="fa fa-check fa-fw"></i>&nbsp;Valider
                        </button>
                </form>
            </div>
        </div>

    </div>
</div>
</div>