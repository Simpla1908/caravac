<div id="myModal2" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>-->
                <h5 class="modal-title blocpaieall blocpaie"><strong>Paiement : <span class="montant_fact"> </span>soit <span id="mont_equivalent"></span></strong></h5>
                <h5 class="modal-title blocpaieall blocqte hidden"><strong>Modification Quantite </strong></h5>
                <h5 class="modal-title blocpaieall blocoffre hidden"><strong>Offre </strong></h5>
                <h5 class="modal-title blocpaieall blocprix hidden"><strong>Remise </strong></h5>
                <h5 class="modal-title blocpaieall blocdepense hidden"><strong>Depense </strong></h5>
            </div>
            <div class="modal-body">
                <form role="form" action="./Traitement/reglement.php" method="post" id="form" class="f_modal_paiement">
                    <input type="hidden" name="id_res" id="id_res" value="0">
                    <input type="hidden" name="dte_edite" id="dte_edite" value="<?php echo date('Y-m-d'); ?>">
                    <input type="hidden" name="justification" id="justification" value="">
                    <input type="hidden" name="id_fact" id="id_fact" value="">
                    <input type="hidden" name="etat_fact" id="etat_fact" value="">
                    <input type="hidden" name="montant_fact" id="montant_fact" value="">
                    <input type="hidden" name="montant_tot" id="montant_tot" value="">
                    <input type="hidden" name="res_ch_id" id="res_ch_id3" value="">
                    <input type="hidden" name="type_client" id="type_client" value="" class="tycl idclrp">
                    <input type="hidden" name="lib_mode" id="lib_mode" value="Cash">
                    <input type="hidden" name="montant_tot_af" id="montant_tot_af" value="">
                    <input type="hidden" name="id_client" id="client_id2" value="">
                    <input type="hidden" name="nom_client" id="nom_client" value="">
                    <input type="hidden" name="id_cmd2" id="id_cmd2" value="0">
                    <input type="hidden" name="attente2" id="attente2" value="">
                    <input type="hidden" name="tauxrendu" id="tauxrendu" value="<?php echo $taux_op; ?>">
                    <input type="hidden" name="monnaieactu" id="monnaieactu" value="<?php echo $m_affiche; ?>">
                    <input type="hidden" name="fusion_frm" id="fusion_frm" value="">
                    <input type="hidden" name="id_fact_fus" id="id_fact_fus" value="">
                    <input type="hidden" name="id_tbl_fus2" id="id_tbl_fus2" value="">
                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_bkg">
                            <span id="sp_bkg"></span>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 hidden blocpaieall blocpaie">

                                <div class="col-lg-12 form-group">
                                    <label>Mode de paiement</label>
                                    <select name="modepaiement" class="form-control select2 input-lg selectmodeclient111" style="width: 100%;" id="mode">
                                        <?php
                                        include '../bdd/connexion.php';
                                        $requete = $bdd->prepare("SELECT * FROM t_mode_reglement WHERE visible=1 ORDER BY priority");
                                        $requete->execute();
                                        $modes = $requete->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($modes as $mode) {
                                            echo '<option value="' . $mode->id_mode_regl . '">' . $mode->lib . '</option>';
                                        }
                                        ?>
                                    </select>
                                   
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_local(); ?> </label>
                                    <div class="input-group input-group-lg">
                                        <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant montant_py_resto mp" value="" 
                                        >
                                        <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant<?php echo getsymbole_devise(); ?></label>
                                    <div class="input-group input-group-lg">
                                        <input type="text" id="montantusd" name="montantusd" class="form-control text-right montant montant_py_resto mp" value="" 
                                                >
                                        <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                    </div>
                                </div>

                                <div class="blrendu hidden">
                                    <input type="hidden" id="totrendu" name="totrendu" value="0">
                                    <div class="col-lg-6 form-group cachebtn">
                                        <label>Rendu <?php echo getsymbole_local(); ?> </label>
                                        <div class="input-group">
                                            <input type="text" id="rendu_cdf" name="rendu_cdf" class="form-control text-right rd11" value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group cachebtn">
                                        <label>Rendu <?php echo getsymbole_devise(); ?> </label>
                                        <div class="input-group">
                                            <input type="text" id="rendu_usd" name="rendu_usd" class="form-control  text-right rd22 " value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 hidden blocpaieall blocdepense">
                                <div class="col-lg-12 form-group">
                                    <label>Libelle</label>
                                    <select name="libelle_id" class="form-control" style="width: 100%;" id="libelle_id">
                                        <?php
                                        $site_id = $_SESSION['id_hotel'];
                                        $libelles = SelectLibelleDepense($site_id, $bdd);
                                        foreach ($libelles as $l) {
                                            $id = $l->id;
                                            $designation = $l->designation;
                                        ?>
                                            <option value="<?php echo $id ?>"><?php echo $designation ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Description </label>
                                    <div class="form-group">
                                        <textarea class="form-control mt" rows="1" id="motif" name="motif"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group cachebtn hidden">
                                    <label>Date </label>
                                    <div class="form-group">
                                        <input type="text" id="dte_dep" name="dte_dep" class="form-control text-left" value="<?php echo date('d/m/Y') ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_local(); ?> </label>
                                    <div class="input-group input-group">
                                        <input type="text" id="montantcdf" name="depcdf" class="form-control text-left mt " value="" onFocus="highlightActive(this);
                                                activeinput = this">
                                        <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_devise(); ?></label>
                                    <div class="input-group input-group">
                                        <input type="text" id="montantusd" name="depusd" class="form-control text-left mt" value="" onFocus="highlightActive(this);
                                                activeinput = this">
                                        <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                    </div>
                                </div>
                            </div>
                            <!--Modal Modification Quantité-->
                            <div class="col-lg-12 blocpaieall blocqte hidden">

                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Quantite </label>
                                    <div class=" col-lg-12 input-group input-group-lg">
                                        <input type="text" id="qte_produit" name="qte_produit" class="form-control text-right" value="" onFocus="highlightActive(this);
                                                activeinput = this">
                                        <!--<span class="input-group-addon"><?php // echo getsymbole_local();  
                                                                            ?></span>-->
                                    </div>
                                </div>
                            </div>
                            <!--Fin Modal Modification Quantité-->
                            <!--Partie Offre-->
                            <div class="col-lg-12 blocpaieall blocoffre hidden">
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Quantite Offerte</label>
                                    <div class="col-lg-12 input-group input-group-lg">
                                        <input type="text" id="qteofferte" name="qteofferte" class="form-control text-right" value="" onFocus="highlightActive(this);
                                                activeinput = this">
                                        <!--<span class="input-group-addon"><?php // echo getsymbole_local();  
                                                                            ?></span>-->
                                    </div>
                                </div>
                            </div>
                            <!--Fin partie Offre-->
                            <!--Partie PRIX-->
                            <div class="col-lg-12 blocpaieall blocprix">
                                <div class="col-lg-12 form-group cachebtn">
                                    <!--<label>Montant Remise</label>-->
                                    <div class=" col-lg-12 input-group input-group-lg">
                                        <input type="text" id="kremise" name="remise" class="form-control text-right" value="<?php echo $_SESSION['remise']; ?>" onFocus="highlightActive(this);
                                                activeinput = this">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                </form>
            </div>
            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="add_libelledep_btn">Valider</button>-->
                <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">ANNULER</button>
                <button type="submit" class="btn btn-primary btn_modal btn-lg blocpaie" id="btn_valider_reglement">VALIDER</button>
                <button type="button" class="btn btn-primary btn_modal btn-lg blocqte hidden" id="btn_qte_produit2">VALIDER</button>
                <button type="button" class="btn btn-primary btn_modal btn-lg blocoffre hidden" id="btn_offert2">VALIDER</button>
                <button type="button" class="btn btn-primary btn_modal btn-lg blocprix hidden" id="btn_remise">VALIDER</button>
                <button type="button" class="btn btn-primary btn_modal btn-lg blocdepense hidden" id="btn_vld_depense">VALIDER</button>
            </div>

        </div>
    </div>
</div>