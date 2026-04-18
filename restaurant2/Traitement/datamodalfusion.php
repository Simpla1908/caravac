<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!isset($_SESSION)) {
    session_start();
}
include '../../FUNCTION/hebergement.php';
$nbre= count($_SESSION['fusion']['id_client']);
$montant_tot=0;
for ($i = 0; $i <= $nbre - 1; $i++) {
$id_client=$_SESSION['fusion']['id_client'][$i];
$montant_tot+=$_SESSION['fusion']['mont_ttc'][$id_client];
}
?>
             <div class="modal-header">
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>-->
                <h5 class="modal-title"><strong>Paiement : <span class="montant_fact"><?php echo $montant_tot; ?> </span>soit <span id="mont_equivalent"></span></strong></h5>
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
                    <input type="hidden" name="type_client" id="type_client" value="" class="tycl">
                    <input type="hidden" name="lib_mode" id="lib_mode" value="Cash">
                    <input type="hidden" name="montant_tot_af" id="montant_tot_af" value="">
                    <input type="hidden" name="id_client" id="client_id2" value="">
                    <input type="hidden" name="nom_client" id="nom_client" value="">
                    <input type="hidden" name="id_cmd2"  id="id_cmd2" value="0">
                    <input type="hidden" name="attente2" id="attente2" value="">
                    <input type="hidden" name="tauxrendu" id="tauxrendu"  value="<?php //echo $taux_op; ?>">
                    <input type="hidden" name="monnaieactu" id="monnaieactu"  value="<?php //echo $m_affiche; ?>">
                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_bkg">
                            <span id="sp_bkg"></span>
                        </div>
                        <div class="row">
                            <div class="col-lg-12  blocpaieall blocpaie">

                                <div class="col-lg-12 form-group">
                                    <label>Mode de paiement</label>
                                    <select name="modepaiement" class="form-control select2 input-lg"
                                            style="width: 100%;" id="mode">
                                                <?php
                                                include '../../bdd/connexion_mysql.php';
                                                $result = mysql_query("SELECT * FROM  t_mode_reglement ORDER BY lib") or die(mysql_error());
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo '<option value="' . $row['id_mode_regl'] . '">' . $row['lib'] . '</option>';
                                                }
                                                mysql_free_result($result);
                                                ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_local(); ?> </label>
                                    <div class="input-group input-group-lg">
                                        <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant montant_py_resto1 mp" value="" onFocus="highlightActive(this);
                                                activeinput = this">
                                        <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_devise(); ?></label>
                                    <div class="input-group input-group-lg">
                                        <input type="text" id="montantusd" name="montantusd" class="form-control text-right montant montant_py_resto1 mp" value="" onFocus="highlightActive(this);
                                                activeinput = this">
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
                           
                            
                        </div>

                </form>

            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">ANNULER</button>
                <button type="submit" class="btn btn-primary btn_modal btn-lg blocpaie" id="btn_valider_reglement">VALIDER</button>
            </div>

