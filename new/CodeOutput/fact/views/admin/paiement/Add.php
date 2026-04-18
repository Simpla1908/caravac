<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		paiement
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

// foreach ($result1 as $rows) {
//  MontantsFacture($rows->id_fact);
//  echo 'montant_total'.$_SESSION['montant_total'].'</br>';
//  echo 'montant_paye'.$_SESSION['montant_paye'].'</br>';
//  echo 'montant_a_paye'.$_SESSION['montant_a_paye'].'</br>';
// }
?>
<form action="<?php echo H_ADMIN_MAIN . '&view=paiement&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="button" name="button" id="hButton" class="hidden btnfpaiement" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=paiement&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-list"></i> <?php echo 'Liste'; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-reorder"></i> Paiement</h3>
            </div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <?php
                        foreach ($result1 as $rows) { ?>
                            <div class="col-md-10">
                                <br>
                                <div class="form-group">
                                    <label for="type" class="col-sm-3 control-label">Facture</label>
                                    <div class="col-sm-9" id="maj_chx_facture">
                                        <input type="text" id="afffacture" name="afffacture" class="form-control" value="<?php echo $rows->num_fact; ?>" disabled="disabled">
                                        <input type="hidden" id="facture" name="facture" class="form-control" value="<?php echo $rows->num_fact; ?>">
                                    </div>
                                    <input type="hidden" id="frmdejapayee" name="frmdejapayee" class="form-control" value="<?php echo $rows->dejapayee; ?>">
                                    <input type="hidden" id="compte1" name="compte1" class="form-control" value="<?php echo $rows->compte1; ?>">
                                    <input type="hidden" id="compte2" name="compte2" class="form-control" value="<?php echo $rows->compte2; ?>">
                                    <input type="hidden" id="id_fact" name="id_fact" class="form-control" value="<?php echo $rows->id_fact; ?>">
                                    <input type="hidden" id="num_fact" name="num_fact" class="form-control" value="<?php echo $rows->num_fact; ?>">
                                    <input type="hidden" id="montant_tot" name="montant_tot" class="form-control" value="<?php echo $rows->mont_ttc_remise; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="type" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="affnomclient" name="affnomclient" class="form-control" value="<?php echo $rows->nom_client; ?>" disabled="disabled">
                                        <input type="hidden" id="idclient" name="idclient" class="form-control" value="<?php echo $rows->id_client; ?>">
                                        <input type="hidden" id="nomclient" name="nomclient" class="form-control" value="<?php echo $rows->nom_client; ?>">
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
                                                    <input type="text" <?php if ($_SESSION['Paie_affiche'] == getsymbole_local()) { ?>id="ttc1" name="ttc1" value="<?php echo arrondir($_SESSION['montant_a_paye']); ?>" <?php } else { ?>id="ttc" name="ttc" value="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $_SESSION['montant_a_paye'])); ?>" <?php } ?> class="form-control text-right montant montant_py_resto" disabled="disabled">
                                                    <input type="hidden" id="montant" name="montant" value="<?php echo arrondir($_SESSION['montant_a_paye']); ?>">
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
                                                <input type="text" <?php if ($_SESSION['Paie_affiche'] == getsymbole_local()) { ?>id="ttc1" name="ttc1" value="<?php echo arrondir($rows->mont_ttc_remise); ?>" <?php } else { ?>id="ttc" name="ttc" value="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $rows->mont_ttc_remise)); ?>" <?php } ?> class="form-control text-right montant montant_py_resto" disabled="disabled">
                                                <input type="hidden" id="montant" name="montant" value="<?php echo arrondir($rows->mont_ttc_remise); ?>">
                                                <span class="input-group-addon monnaie"><?php if ($_SESSION['Paie_affiche'] == getsymbole_local()) { ?>CDF<?php } else { ?>USD<?php } ?></span>
                                            </div>

                                        </div>
                                        <label for="type" class="col-sm-1 control-label">Soit </label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" <?php if ($_SESSION['Paie_affiche'] == getsymbole_devise()) { ?>id="ttc1" name="ttc1" value="<?php echo arrondir($rows->mont_ttc_remise); ?>" <?php } else { ?>id="ttc" name="ttc" value="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $rows->mont_ttc_remise)); ?>" <?php } ?> class="form-control text-right montant montant_py_resto" disabled="disabled">
                                                <span class="input-group-addon monnaie"><?php if ($_SESSION['Paie_affiche'] == getsymbole_devise()) { ?>CDF<?php } else { ?>USD<?php } ?></span>
                                            </div>

                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label for="mode" class="col-sm-3 control-label">Mode<?php // echo $_SESSION['mode']; 
                                                                                            ?></label>
                                    <div class="col-sm-9">
                                        <?php
                                        if ($rows->mode == 'Credit') {
                                            $modepaie = 'Credit';
                                        } elseif ($rows->mode == 'Acompte') {
                                            $modepaie = 'Acompte';
                                        } else {
                                            $modepaie = $rows->mode;
                                        }
                                        $mode_id = selectId_mode($rows->mode);
                                        ?>
                                        <input type="text" id="modedisable" name="modedisable" class="form-control" value="<?php echo $modepaie; ?>" disabled="disabled">
                                        <input type="hidden" id="mode" name="mode" class="form-control" value="<?php echo $mode_id; ?>">
                                        <input type="hidden" id="libelle_mode" name="libelle_mode" value="<?php echo $rows->mode; ?>">

                                        <?php // foreach ($result2 as $rows2) { 
                                        //                                        if($modepaie==$rows2->lib){
                                        //                                            if ($rows2->lib == 'Credit') {
                                        //                                                $modepaie= 'Acompte';
                                        //                                            } elseif ($rows2->lib == 'Don') {
                                        //                                                $modepaie= 'Crédit';
                                        //                                            }else {
                                        //                                                $modepaie= $rows2->lib;
                                        //                                            }
                                        ?>
                                        <!--                                    <input type="text"   id="modedisable" name="modedisable" class="form-control" value="<?php // echo $modepaie; 
                                                                                                                                                                        ?>" disabled="disabled">
                                    <input type="hidden" id="mode" name="mode" class="form-control" value="<?php // echo $rows2->id_mode_regl; 
                                                                                                            ?>">
                                    <input type="hidden" id="libelle_mode" name="libelle_mode" value="<?php // echo $rows2->lib; 
                                                                                                        ?>">-->
                                        <?php // }  
                                        //                                        } 
                                        ?>


                                        <!--                                    <select class="form-control choz chx_mode" id="mode" name="mode">
                                        <option value="">Sélectionner un mode de paiement</option>
                                        <?php
                                        //                                        if($_SESSION['mode']!="mode"){
                                        //                                            if(($_SESSION['mode']=='Credit') || ($_SESSION['mode']=='Don') ){
                                        ?>
                                            <option libmode="Cash" value="2">Cash</option>
                                            <option libmode="Credit" value="3">Acompte</option>
                                            <?php // } 
                                            ?>
                                        <?php // }else{ 
                                        ?>
                                            <?php
                                            //                                            foreach ($result2 as $rows) {
                                            ?>
                                            <?php // if(isset(get('modepaie'))){ 
                                            ?>
                                            <?php // } 
                                            ?>
                                            <option libmode="<?php // echo $rows->lib; 
                                                                ?>" value="<?php // echo $rows->id_mode_regl; 
                                                                            ?>">
                                                <?php
                                                //                                                if ($rows->lib == 'Credit') {
                                                //                                                    echo 'Acompte';
                                                //                                                } elseif ($rows->lib == 'Don') {
                                                //                                                    echo 'Crédit';
                                                //                                                }else {
                                                //                                                    echo $rows->lib;
                                                //                                                }
                                                ?>
                                            </option>
                                            <?php // } 
                                            ?>
                                            
                                        <?php //  } 
                                        ?>

                                    </select>-->




                                    </div>
                                </div>

                                <div class="form-group" style="display:block">
                                    <label for="monnaie_paie" class="col-sm-3 control-label">Monnaie</label>
                                    <div class="col-sm-9">
                                        <select class="form-control choz" id="monnaie_paie" name="monnaie_paie" required>
                                            <option value="USD">USD</option>
                                            <option value="CDF">CDF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  montantpaie usd" style="display:block">
                                    <label for="salbase" class="col-sm-3 control-label">Montant <?php echo getsymbole_devise(); ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" id="montantusd" name="montantusd" class="form-control text-right montant montant_py_resto" value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  montantpaie cdf" style="display:none">
                                    <label for="salbase" class="col-sm-3 control-label">Montant <?php echo getsymbole_local(); ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant montant_py_resto" value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group justif" style="display:none">
                                    <label for="salbase" class="col-sm-3 control-label">Justification </label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <textarea id="justification" name="justification" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        <?php } ?>
                    </div>
                </div>

            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;">
                <!--                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="button" name="button" id="hButton" class="hidden btnfpaiement" value="<?php echo LANG_CREATE_RECORD; ?>" />-->
            </div>



        </div>
        <!--/col-12-->

</form>