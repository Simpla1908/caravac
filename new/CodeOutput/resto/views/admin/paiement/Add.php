
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
            <input type="submit" name="button" id="hButton" class="hidden btnfpaiement" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=paiement&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-list"></i> <?php echo 'Liste'; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Paiement</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Facture</label>
                                <div class="col-sm-9" id="maj_chx_facture">
                                    <select id="facture" name="facture"  class="form-control choz chx_facture">
                                          <option value="">Sélectionner une facture</option>
                                        <?php
                                        foreach ($result1 as $rows) {
                                         MontantsFacture($rows->id_fact);
                                         if($_SESSION['datas_exist']==1){

                                          if($_SESSION['montant_a_paye']>0){
                                          ?>
                                          <option montanttot="<?php echo $rows->mont_ttc_remise; ?>" idclientopt="<?php echo $rows->id_client; ?>" nomclientopt="<?php echo $rows->nom_client; ?>" monnaieopt="<?php echo $rows->monnaie; ?>" tvaopt="<?php echo $rows->tva; ?>" taux="<?php echo $rows->taux; ?>" montttcremise="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie,getsymbole_devise(),$rows->taux,$_SESSION['montant_a_paye'])); ?>" montttcremise1="<?php echo arrondir($_SESSION['montant_a_paye']); ?>" montttc="<?php echo $rows->mont_ttc; ?>" monttva="<?php echo $rows->mont_tva; ?>" montanttotal="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie,$_SESSION['Paie_affiche'],$rows->taux,$rows->montant_total)); ?>" dtetion="<?php echo $rows->date_edition; ?>" nfac="<?php echo $rows->num_fact; ?>" value="<?php echo $rows->id_fact; ?>"><?php echo $rows->num_fact; ?></option>
                                        <?php 
                                        } 
                                      }else{
                                        ?>
                                      <option montanttot="<?php echo $rows->mont_ttc_remise; ?>" idclientopt="<?php echo $rows->id_client; ?>" nomclientopt="<?php echo $rows->nom_client; ?>" monnaieopt="<?php echo $rows->monnaie; ?>" tvaopt="<?php echo $rows->tva; ?>" taux="<?php echo $rows->taux; ?>" montttcremise="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie,getsymbole_devise(),$rows->taux,$rows->mont_ttc_remise)); ?>" montttcremise1="<?php echo arrondir($rows->mont_ttc_remise); ?>" montttc="<?php echo $rows->mont_ttc; ?>" monttva="<?php echo $rows->mont_tva; ?>" montanttotal="<?php echo montant_equivalent_bdd($rows->monnaie,$_SESSION['Paie_affiche'],$rows->taux,$rows->montant_total); ?>" dtetion="<?php echo $rows->date_edition; ?>" nfac="<?php echo $rows->num_fact; ?>" value="<?php echo $rows->id_fact; ?>"><?php echo $rows->num_fact; ?></option>
                                         <?php 
                                      }
                                      } 
                                      ?>
                                    </select>
                                    



                                </div>
                                 <input type="hidden" id="id_fact" name="id_fact" class="form-control" value="">
                                <input type="hidden" id="num_fact" name="num_fact" class="form-control" value="num_fact">
                                <input type="hidden" id="montant_tot" name="montant_tot" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Client</label>
                                <div class="col-sm-9">
                            <input type="text"   id="affnomclient" name="affnomclient" class="form-control" value="" disabled="disabled">
                            <input type="hidden" id="idclient" name="idclient" class="form-control" value="">
                            <input type="hidden"  id="nomclient" name="nomclient" class="form-control" value="">



                                </div>
                            </div>
                             <div class="form-group hidden">
                                <label for="type" class="col-sm-3 control-label">Montant HT</label>
                                <div class="col-sm-9">
                              <div class="input-group">

                             <input type="text" id="ht" name="ht" class="form-control text-right montant montant_py_resto" value="" disabled="disabled">
                              <span class="input-group-addon monnaie"><?php echo $_SESSION['Paie_affiche']; ?></span>
                             </div>

                                </div>
                            </div>
                              <div class="form-group hidden">
                                <label for="type" class="col-sm-3 control-label">TVA</label>
                                <div class="col-sm-9">
                              <div class="input-group">

                             <input type="text" id="tva" name="tva" class="form-control text-right montant montant_py_resto" value="" disabled="disabled">
                              <span class="input-group-addon">%</span>
                              </div>

                                </div>
                            </div>
                             <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Montant à payer</label>
                                <div class="col-sm-4">
                              <div class="input-group">
                            <input type="text" <?php if($_SESSION['Paie_affiche']==getsymbole_local()){ ?>id="ttc1" name="ttc1"<?php }else{ ?>id="ttc" name="ttc"<?php } ?>  class="form-control text-right montant montant_py_resto" value="" disabled="disabled">
                            <input type="hidden" id="montant" name="montant"  value="">
                              <span class="input-group-addon monnaie"><?php if($_SESSION['Paie_affiche']==getsymbole_local()){ ?>CDF<?php }else{ ?>USD<?php } ?></span>
                               </div>

                                </div>
                              <label for="type" class="col-sm-1 control-label">Soit </label>
                                 <div class="col-sm-4">
                                 <div class="input-group">
                                <input type="text" <?php if($_SESSION['Paie_affiche']==getsymbole_devise()){ ?>id="ttc1" name="ttc1"<?php }else{ ?>id="ttc" name="ttc" <?php } ?> class="form-control text-right montant montant_py_resto" value="" disabled="disabled">
                              <span class="input-group-addon monnaie"><?php if($_SESSION['Paie_affiche']==getsymbole_devise()){ ?>CDF<?php }else{ ?>USD<?php } ?></span>
                               </div>

                                </div>
                            </div>
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
                                            if($rows->lib=='Credit'){
                                            echo 'Acompte'; 
                                            }else{
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
                    </div>
                </div>
                
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden btnfpaiement" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>



        </div><!--/col-12-->

</form>
