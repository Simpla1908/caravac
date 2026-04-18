<!-- Modal -->
<?php
include 'Amelioration/reglage/recuperer_valeurs_reglages.php';
?>
    <div class="modal fade Modal_versement" id="myModal_versement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">Versement Caisse</h5>
                </div>
                <div class="modal-body" id="popup_paie">
                    <div id="msg" class="alert alert-success alert-dismissable" style="display: none">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <form action="./Traitement/versement.php" method="post" id="formversement">
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-sm-2 control-label">Utilisateur</label>

                                            <div class="col-sm-10">
                                                <select class="form-control text-blue"  id="user_id1" name="user_id">
                                                    <option value='0'>Sélectionnez un utilisateur</option>
                                                    <?php
                                                    include("../../REC/utilisateur/users_select.php");
                                                    foreach ($users as $u):
                                                        echo '<option value=' . $u->id_user . '>' . $u->nom_user . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 form-group hidden">
                                            <label>Montant</label>
                                            <div class="input-group">
												 <input type="text" id="nomlibelle" name="nomlibelle" value="">
                                                <input type="text" id="paie_id" name="paie_id"
                                                       class="form-control text-right text-blue " value="0">
                                                <input type="text" id="montant" name="montant"
                                                       class="form-control text-right text-blue " value="0">
                                                <input type="text" id="montant_aff" name="montant_aff"
                                                       class="form-control text-right text-blue " value="0">
                                                <input type="text" id="montant_tot_calc" name="montant_tot_calc"
                                                       class="form-control text-right text-blue " value="0">
                                                <span class="input-group-addon">
                                                    <?php
                                                        echo $m_affiche;
                                                    ?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 form-group">
                                            <label class="col-sm-2 control-label">Libéllé</label>

                                            <div class="col-sm-10" id="libelle_verse1">
                                                <select class="form-control text-blue"  id="libelle" name="libelle">
                                                    <?php
                                                    foreach ($libelles as $l):
                                                        echo '<option value='.$l->idmotif.'>' . $l->designation. '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <p class="text-center">
                                                <strong>REPARTITION ET BILLETAGE DES MONTANTS</strong>
                                            </p>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label>Montant en USD</label>
                                                <div class="input-group">
                                                    <input type="text" id="montant_usd" name="montant_usd"
                                                           class="form-control text-right text-blue " value="0">
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
                                                <label>Montant en CDF</label>
                                                <div class="input-group">
                                                    <input type="text" id="montant_cdf" name="montant_cdf"
                                                           class="form-control text-right text-blue " value="0">
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
                                            </table>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class=" modal-footer">
                         <span class="btn btn-danger hidden" id="loader_vers">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                            </span>
                        <button type="submit" id="verser_montant" class="btn btn-primary"><i class="fa fa-check fa-fw"></i>&nbsp;Valider
                        </button>
                    </form>
                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

    <!-- /.modal -->

