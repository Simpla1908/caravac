
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
                    <a  class="btn btn-primary btn-sm tip" title="Filtrer la liste" data-toggle="modal" data-target="#modalLoginForm"> <i class="fa fa-plus"></i>  Ajouter</a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=listebc" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                
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
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Compte</label>
                        <select name="compte_id" id="compte_id" class="form-control choz"  required>
                            <option>  </option>
                            <?php foreach ($comptes as $rows) { ?>
                                <option pref="<?php echo $rows->numero; ?>" 
                                        niveau="<?php echo $rows->niveau; ?>" 
                                        classe_id="<?php echo $rows->classe_id;?>" 
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

