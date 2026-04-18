<div class="callout hidden" style="margin-bottom: 0!important;" id="notification7">
    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
</div>
<form class="frmpaie" id="hezecomform">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
            <label for="mode">Factures</label>
            <select class=" col-md-5 form-control choz" name="fact_heb_id" id="fact_heb_id">
                <option value=""></option>
                <?php
                $nbre2 = count($service['id']);
                for ($k = 0; $k <= $nbre2 - 1; $k++) {
                    $tp = $service['type'][$k];
                    $tauxfact = $service['tauxfact'][$k];
                    $num_fact = $service['num_fact'][$k];
                    if ($tp == 'hebergement') {
                ?>
                        <option nfct="<?php echo $num_fact ?>" txf="<?php echo $tauxfact ?>" tp="<?php echo $tp ?>" value="<?php echo $service['id'][$k] ?>" ttc="<?php echo $service['solde_eqvlt'][$k] ?>" msgpaie="<?php echo $service['mont_eqvlt'][$k] ?>"><?php echo $service['des'][$k] ?></option>
                        <?php
                    } else {
                        if ($service['mont_eqvlt'][$k] > 0) {
                        ?>
                            <option nfct="<?php echo $num_fact ?>" txf="<?php echo $tauxfact ?>" tp="<?php echo $tp ?>" value="<?php echo $service['id'][$k] ?>" ttc="<?php echo $service['solde_eqvlt'][$k] ?>" msgpaie="<?php echo $service['mont_eqvlt'][$k] ?>"><?php echo $service['des'][$k] ?></option>
                    <?php
                        }
                    }
                    ?>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <label for="mode">Mode</label>
            <select class=" col-md-3 form-control choz" name="mode" id="mode">
                <?php for ($i = 0; $i <= $modecpt - 1; $i++) { ?>
                    <?php if ($modepaiements['id'][$i] != 3) { ?>
                        <option value="<?php echo $modepaiements['id'][$i] ?>"><?php echo $modepaiements['lib'][$i] ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group blrendu hidden">
            <label for="mode">Rendu</label>
            <select class=" col-md-2 col-sm-12 col-xs-12 form-control choz" name="type_rendu" id="type_rendu">
                <option value="oui">oui</option>
                <option value="non">non</option>
            </select>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-sm-12 col-xs-12 form-group blcmp">
            <label for="usd">Montant payé <?php echo AfficheMonnaie(getsymbole_devise()); ?></label>
            <div class="input-group">
                <input name="usd" id="usd" class="form-control mp2" type="text" value="<?php // echo $soldeusd;  
                                                                                        ?>">
                <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_devise()); ?></span>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 form-group blcmp">
            <label for="cdf">Montant payé <?php echo AfficheMonnaie(getsymbole_local()); ?></label>
            <div class="input-group">
                <input name="cdf" id="cdf" class="form-control mp2" type="text" value="<?php // echo $soldecdf;  
                                                                                        ?>">
                <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_local()); ?></span>
            </div>
        </div>
    </div>
    <div class="row blrendu hidden blr1">
        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
            <label for="usd">Rendu <?php echo AfficheMonnaie(getsymbole_devise()); ?></label>
            <div class="input-group">
                <input name="rendu_usd" id="rendu_usd" class="form-control" type="text" value="<?php echo 0; ?>">
                <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_devise()); ?></span>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
            <label for="cdf">Rendu <?php echo AfficheMonnaie(getsymbole_local()); ?></label>
            <div class="input-group">
                <input name="rendu_cdf" id="rendu_cdf" class="form-control" type="text" value="<?php echo 0; ?>">
                <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_local()); ?></span>
            </div>
        </div>
    </div>
    <input name="id_res" id="id_res" type="hidden" value="<?php echo $id_res ?>">
    <input name="id_fact1" id="id_fact1" type="hidden" value="<?php echo $id_fact ?>">
    <input name="ttc" id="ttc" type="hidden" value="0">
    <input name="ttc2" id="ttc2" type="hidden" value="<?php echo $ttc ?>">
    <input name="totrendu" id="totrendu" type="hidden" value="0">
    <input name="resch_id" id="resch_id" type="hidden" value="<?php echo $id_resch ?>">
    <input name="paie_id" id="paie_id" type="hidden" value="0">
    <input name="tp" id="tp" type="hidden" value="0">
    <input name="txfct1" id="txfct1" type="hidden" value="0">
    <input name="compte1" id="compte1" type="hidden" value="<?php echo $compte1; ?>">
    <input name="compte2" id="compte2" type="hidden" value="<?php echo $compte2; ?>">
    <input name="nom_client" id="nom_client" type="hidden" value="<?php echo $nom_client; ?>">
    <input name="tva" id="tva" type="hidden" value="<?php echo $tva; ?>">
    <input name="num_fact_paie" id="num_fact_paie" type="hidden" value="">
    <input name="ttccompta" id="ttccompta" type="hidden" value="<?php echo $ttccompta; ?>">
    <input name="tauxcompta" id="tauxcompta" type="hidden" value="<?php echo $tauxcompta; ?>">
</form>