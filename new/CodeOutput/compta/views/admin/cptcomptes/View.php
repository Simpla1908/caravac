
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title titrepg">Plan des comptes</h3>
                <ul class="nav pull-right">
                    <a  class="btn btn-primary btn-sm tip hidden" title="Filtrer la liste" data-toggle="modal" data-target="#mdcreercompte"> <i class="fa fa-plus"></i> Créer compte</a>
                    <a  class="btn btn-primary btn-sm tip" title="Filtrer la liste" data-toggle="modal" data-target="#modalLoginForm"> <i class="fa fa-plus"></i>  Ajouter sous - compte</a>
                    <a href="./main.php?pg=admin&view=impression&do=listedescomptes" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <table data-page="false" class="table table-bordered table-condensed table-hover t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <!--<th>N°</th>-->
                            <th data-hide="phone,tablet">Numéro</th>
                            <th data-hide="phone,tablet">Compte</th>
                            <th data-hide="phone,tablet">Classe</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody id="lignescomptes">
                       <?php include(APP_FOLDER . '/views/admin/cptcomptes/lignescomptes.php');?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Ajout Sous - compte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="callout callout-danger bloc_alert hidden">
                <!--<h4>I am a danger callout!</h4>-->
                <span class="msg_alert"></span>
              </div>
                <form id="scomptefrm">
                    <div class="md-form mb-4 scpt scpt2 hidden">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Classe</label>
                        <input type="text"  class="form-control nettoyer libclasse" disabled="">
                    </div>
                    <div class="md-form mb-4 scpt scpt2 hidden">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Catégorie</label>
                        <input type="text"  class="form-control nettoyer libcategorie"  disabled="">
                    </div>
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Compte</label>
                        <select name="compte_id" id="compte_id" class="form-control choz"  required>
                            <option>  </option>
                            <?php foreach ($comptes as $rows) { ?>
                                <option pref="<?php echo $rows->numero; ?>" 
                                        categorie="<?php echo $rows->categorie; ?>" 
                                        classe="<?php echo $rows->classe;?>" 
                                        statut="<?php echo $rows->statut;?>" 
                                        value="<?php echo $rows->id; ?>">
                                            <?php echo $rows->numero . ' ' . $rows->libelle; ?>
                                </option>
                            <?php } ?>?>
                        </select>
                    </div>
                    <div class="md-form mb-4 scpt hidden">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Numéro sous - compte</label>
                        <div class="input-group">
                            <input name="classe_id" type="hidden" id="classe_id">
                            <input name="prefnum" type="hidden" id="prefnum">
                            <input name="niveau" type="hidden" id="niveau">
                            <input name="statut" type="hidden" id="statut">
                            <span class="input-group-addon prefixe_aff"></span>
                            <input type="text" name="snumero"class="form-control nettoyer">
                        </div>
                    </div>
                    <div class="md-form mb-4 scpt hidden">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Nom</label>
                        <input type="text" name="libelle" class="form-control nettoyer">
                    </div>
                    <div class="md-form mb-4 hidden">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Bilan actif
                            </label>
                            <label>
                                <input type="checkbox"> Bilan passif
                            </label>
                            <label>
                                <input type="checkbox"> Résultat
                            </label>
                            <label>
                                <input type="checkbox"> Balance
                            </label>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary" id="btn_add_scompte">Valider</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="mdcreercompte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Créer Compte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="callout callout-danger bloc_alert hidden">
                <!--<h4>I am a danger callout!</h4>-->
                <span class="msg_alert"></span>
              </div>
                <form id="comptefrm">
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Catégories</label>
                        <select name="compte_id" id="compte_id" class="form-control choz"  required>
                            <option>  </option>
                            <?php foreach ($categories as $rows) { ?>
                                <option  
                                        value="<?php echo $rows->id; ?>">
                                            <?php echo $rows->numero . ' ' . $rows->libelle; ?>
                                </option>
                            <?php } ?>?>
                        </select>
                    </div>
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Type</label>
                        <select name="etat" id="etat" class="form-control choz"  required>
                            <option value="actif">Actif </option>
                            <option value="passif">Passif </option>
                        </select>
                    </div>
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Numéro</label>
                        <div class="input-group">
<!--                            <input name="classe_id" type="hidden" id="classe_id">
                            <input name="prefnum" type="hidden" id="prefnum">
                            <input name="niveau" type="hidden" id="niveau">
                            <input name="statut" type="hidden" id="statut">-->
                            <span class="input-group-addon prefixe_aff"></span>
                            <input type="text" name="snumero"class="form-control nettoyer">
                        </div>
                    </div>
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Nom</label>
                        <input type="text" name="libelle" class="form-control nettoyer">
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary" id="btn_add_compte">Valider</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modalUpdateSubAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Modification Sous - compte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="callout callout-danger bloc_alert hidden">
                <!--<h4>I am a danger callout!</h4>-->
                <span class="msg_alert"></span>
              </div>
                <form id="scomptefrm_updt">
                    <div class="md-form mb-4 scpt_updt scpt2_updt">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Classe</label>
                        <input type="text"  class="form-control nettoyer libclasse_updt" disabled="">
                    </div>
                    <div class="md-form mb-4 scpt_updt scpt2_updt">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Catégorie</label>
                        <input type="text"  class="form-control nettoyer_updt libcategorie_updt"  disabled="">
                    </div>
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Compte</label>
                        <select name="compte_id" id="compte_id_updt" class="form-control choz"  required>
                            <option> </option>
                            <?php foreach ($comptes as $rows) { ?>
                                <option pref="<?php echo $rows->numero; ?>" 
                                        categorie="<?php echo $rows->categorie; ?>" 
                                        classe="<?php echo $rows->classe;?>" 
                                        statut="<?php echo $rows->statut;?>" 
                                        value="<?php echo $rows->id; ?>">
                                            <?php echo $rows->numero . ' ' . $rows->libelle; ?>
                                </option>
                            <?php } ?>?>
                        </select>
                    </div>
                    <div class="md-form mb-4 scpt_updt">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Numéro sous - compte</label>
                        <div class="input-group">
                         <input name="oldnumero" type="hidden" id="oldnumero">
                           <input name="sous_compte_id" type="hidden" id="sous_compte_id">
                            <input name="classe_id" type="hidden" id="classe_id_updt">
                            <input name="prefnum" type="hidden" id="prefnum_updt">
                            <input name="niveau" type="hidden" id="niveau_updt">
                            <input name="statut" type="hidden" id="statut_updt">
                            <span class="input-group-addon prefixe_aff_updt"></span>
                            <input type="text" name="snumero" class="form-control nettoyer_updt" id="snumero">
                        </div>
                    </div>
                    <div class="md-form mb-4 scpt_updt">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Nom</label>
                        <input type="text" name="libelle" class="form-control nettoyer_updt" id="libelle_scpte" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary" id="btn_updt_scompte">Valider</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModaldelsubaccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Suppression Sous - compte</h4>     
                </div>
                    <div class="modal-body">
                     <input id="souscompteid" name="souscompteid" type="hidden" value="">           
                      <p>
                    Voulez-vous supprimer ce sous-compte
                    </p>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn btn-info" id="delsubaccountoui"><i class="fa fa-fw fa-thumbs-up"></i>&nbsp;Oui</button>
                        <button  class="btn btn-danger pull-right" id="delsubaccountnon"><i class="fa fa-fw fa-thumbs-down"></i>&nbsp;Non</button>

                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>