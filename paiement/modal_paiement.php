    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel"><strong>Paiement : <span class="montant_fact"></span></strong></h5>
                </div>
                <div class="modal-body">
                    <div id="msg" class="alert alert-danger alert-dismissable" style="display: none">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <form action="../paiement/paiement.php" method="post" id="form" class="f_modal_paiement">
					 
                        <div class="hidden">
                         <input type="text" name="nom_cl" id="nom_cl" value="">
						<input type="text" name="id_res" id="id_res" value="">
                         <input type="text" name="justification" id="justification" value="">
                        <input type="text" name="id_fact" id="id_fact" value="">
                        <input type="text" name="etat_fact" id="etat_fact9" value="">
                        <input type="text" name="montant_fact" id="montant_fact" value="">
                        <input type="text" name="montant_paye" id="montant_paye" value="">
                        <input type="text" name="s" id="s" value="">
                        <input type="text" name="montant_tot" id="montant_tot" value="">
                        <input type="text" name="taux_fact" id="taux_fact" value="">
                        <input type="text" name="idres_ch" id="idres_ch" value="">
                        <input type="text" name="type_client" id="type_client" value="">
                        <input type="text" name="lib_mode" id="lib_mode" value="">
                        <input type="text" name="monnaie_fact" id="monnaie_fact" value="">
                        </div>

                        <div class="col-lg-12 form-group" id="znefact">

                        </div>
                        <div class="col-lg-12 form-group cachebtn">
                            <label>Mode de paiement</label>
                            <select name="modepaiement" class="form-control select2"
                                    style="width: 100%;" id="mode">
                                <?php
                                include '../bdd/connexion_mysql.php';
                                $result = mysql_query("SELECT * FROM  t_mode_reglement WHERE id_mode_regl<>3 ORDER BY lib") or die(mysql_error());
                                while ($row = mysql_fetch_array($result)) {
                                    echo '<option value="' . $row['id_mode_regl'] . '">' . $row['lib'] . '</option>';
                                }
                                mysql_free_result($result);
                                ?>
                            </select>
                        </div>
                          <div class="col-lg-12 form-group cachebtn" id="div_montant">
                            <label>Montant</label>
                            <div class="input-group">
                                <input type="text" id="montantusd" name="montantusd" class="form-control text-right montant" value="">
                                <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                            </div>
                            <br>
                            <div class="input-group">
                                <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant" value="">
                                <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                            </div>
                         </div>
                        
                        <div class="col-lg-12 form-group hidden">
                            <label>Date</label>
                            <input class="form-control" id="dtereglement" name="dtereglement" value="<?php echo date('d/m/Y'); ?>">
                        </div>
                        <div class="col-lg-12 form-group hidden" id="div_dte">
                            <label>Date</label>
                            <input class="form-control" id="dte" name="dte" value="<?php echo date('d/m/Y'); ?>">
                        </div>
                        <span class="text-center" style="margin-left: 20px;">Rendu: <span class="text-center" id="rendu">0.00</span> <?php echo $m_affiche; ?> </span></br></br>
                        <span class="text-center msg_error hidden" style="margin-left: 20px;"> </span></br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary btn_modal" id="btn_valider_paiement">Valider</button>
                    <span class="btn btn-danger hidden loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours,Patientez !
                  </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

     