
<div class="col-md-10">
    <br>
    <div class="form-group">
        <label for="type" class="col-sm-3 control-label">Facture</label>
        <div class="col-sm-9" id="maj_chx_facture">
            <input type="text"   id="afffacture" name="afffacture" class="form-control" value="<?php echo $rows->num_fact; ?>" disabled="disabled">
            <input type="hidden" id="facture" name="facture" class="form-control" value="<?php echo $rows->num_fact; ?>">
        </div>
        <input type="hidden" id="id_fact" name="id_fact" class="form-control" value="<?php echo $rows->id_fact; ?>">
        <input type="hidden" id="num_fact" name="num_fact" class="form-control" value="<?php echo $rows->num_fact; ?>">
        <input type="hidden" id="montant_tot" name="montant_tot" class="form-control" value="<?php echo $rows->mont_ttc_remise; ?>">
    </div>

    <div class="form-group">
        <label for="type" class="col-sm-3 control-label">Client</label>
        <div class="col-sm-9">
            <input type="text"   id="affnomclient" name="affnomclient" class="form-control" value="<?php echo $rows->nom_client; ?>" disabled="disabled">
            <input type="hidden" id="idclient" name="idclient" class="form-control" value="<?php echo $rows->id_client; ?>">
            <input type="hidden"  id="nomclient" name="nomclient" class="form-control" value="<?php echo $rows->nom_client; ?>">
        </div>
    </div>
    <div class="form-group hidden">
        <label for="type" class="col-sm-3 control-label">Montant HT</label>
        <div class="col-sm-9">
            <div class="input-group">

                <input type="text" id="ht" name="ht" class="form-control text-right montant montant_py_resto" value="<?php echo montant_equivalent_bdd($rows->monnaie, $_SESSION['Paie_affiche'], $rows->taux, $rows->montant_total); ?>" disabled="disabled">
                <span class="input-group-addon monnaie"><?php echo $_SESSION['Paie_affiche']; ?></span>
            </div>

        </div>
    </div>
    <div class="form-group hidden">
        <label for="type" class="col-sm-3 control-label">TVA</label>
        <div class="col-sm-9">
            <div class="input-group">

                <input type="text" id="tva" name="tva" class="form-control text-right montant montant_py_resto" value="<?php echo $rows->tva; ?>" disabled="disabled">
                <span class="input-group-addon">%</span>
            </div>

        </div>
    </div>
    <?php
    if ($_SESSION['datas_exist'] == 1) {
        if ($_SESSION['montant_a_paye'] > 0) {
            ?>
            <div class="form-group">
                <label for="type" class="col-sm-3 control-label">Montant à payer </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" <?php if ($_SESSION['Paie_affiche'] == getsymbole_local()) { ?>id="ttc1" name="ttc1" value="<?php echo arrondir($_SESSION['montant_a_paye']); ?>" <?php } else { ?>id="ttc" name="ttc" value="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $_SESSION['montant_a_paye'])); ?>" <?php } ?>  class="form-control text-right montant montant_py_resto" disabled="disabled">
                        <input type="hidden" id="montant" name="montant"  value="<?php echo arrondir($_SESSION['montant_a_paye']); ?>">
                        <span class="input-group-addon monnaie"><?php if ($_SESSION['Paie_affiche'] == getsymbole_local()) { ?>CDF<?php } else { ?>USD<?php } ?></span>
                    </div>

                </div>
                <label for="type" class="col-sm-1 control-label">Soit </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" <?php if ($_SESSION['Paie_affiche'] == getsymbole_devise()) { ?>id="ttc1" name="ttc1" value="<?php echo arrondir($_SESSION['montant_a_paye']); ?>" <?php } else { ?>id="ttc" name="ttc" value="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $_SESSION['montant_a_paye'])); ?>" <?php } ?> class="form-control text-right montant montant_py_resto" disabled="disabled">
                        <span class="input-group-addon monnaie"><?php if ($_SESSION['Paie_affiche'] == getsymbole_devise()) { ?>CDF<?php } else { ?>USD<?php } ?></span>
                    </div>

                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">Montant à payer </label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" <?php if ($_SESSION['Paie_affiche'] == getsymbole_local()) { ?>id="ttc1" name="ttc1" value="<?php echo arrondir($rows->mont_ttc_remise); ?>" <?php } else { ?>id="ttc" name="ttc" value="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $rows->mont_ttc_remise)); ?>" <?php } ?>  class="form-control text-right montant montant_py_resto" disabled="disabled">
                    <input type="hidden" id="montant" name="montant"  value="<?php echo arrondir($rows->mont_ttc_remise); ?>">
                    <span class="input-group-addon monnaie"><?php if ($_SESSION['Paie_affiche'] == getsymbole_local()) { ?>CDF<?php } else { ?>USD<?php } ?></span>
                </div>

            </div>
            <label for="type" class="col-sm-1 control-label">Soit </label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" <?php if ($_SESSION['Paie_affiche'] == getsymbole_devise()) { ?>id="ttc1" name="ttc1" value="<?php echo arrondir($_SESSION['montant_a_paye']); ?>" <?php } else { ?>id="ttc" name="ttc" value="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $_SESSION['montant_a_paye'])); ?>" <?php } ?> class="form-control text-right montant montant_py_resto" disabled="disabled">
                    <span class="input-group-addon monnaie"><?php if ($_SESSION['Paie_affiche'] == getsymbole_devise()) { ?>CDF<?php } else { ?>USD<?php } ?></span>
                </div>

            </div>
        </div>
        <?php
    }
    ?>
    <div class="form-group">
        <label for="mode" class="col-sm-3 control-label">Mode</label>
        <div class="col-sm-9">
            <select class="form-control choz chx_mode" id="mode" name="mode">
                <option value="">Sélectionner un mode de paiement</option>
                <?php
                foreach ($result2 as $rows) {
                    ?>
                    <option libmode="<?php echo $rows->lib; ?>" value="<?php echo $rows->id_mode_regl; ?>">
                        <?php
                        if ($rows->lib == 'Credit') {
                            echo 'Acompte';
                        } else {
                            echo $rows->lib;
                        }
                        ?>
                    </option>
                <?php } ?>

            </select>
            <input type="hidden" id="libelle_mode" name="libelle_mode" value="libelle_mode">

        </div>
    </div>

    <div class="form-group  montantpaie" style="display:none">
        <label for="salbase" class="col-sm-3 control-label">Montant <?php echo getsymbole_local(); ?></label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant montant_py_resto" value="0">
                <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
            </div>
        </div>
    </div>
    <div class="form-group  montantpaie" style="display:none">
        <label for="salbase" class="col-sm-3 control-label">Montant <?php echo getsymbole_devise(); ?></label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="text" id="montantusd" name="montantusd" class="form-control text-right montant montant_py_resto" value="0">
                <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
            </div>
        </div>
    </div>
    <div class="form-group justif" style="display:none">
        <label for="salbase" class="col-sm-3 control-label">Justification </label>
        <div class="col-sm-9">
            <div class="input-group">
                <textarea id="justification" name="justification"  class="form-control"></textarea>
            </div>
        </div>
    </div>

</div>

