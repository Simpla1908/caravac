<?php
/*
     * =======================================================================
     * FILE NAME:        Update.php
     * DATE CREATED:    08-02-2018
     * FOR TABLE:     resconfig
     * PRODUCED BY:   HEZECOM UltimateSpeed PHP CODE GENERATOR
     * AUTHOR:      Hezecom (http://hezecom.com) info@hezecom.net
     * =======================================================================
     */
if (!defined('VALID_DIR'))
  die('You are not allowed to execute this file directly');
//var_dump($_SESSION['ConfLinkMod']);
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=resconfig&do=confrestopro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
  <div class="col-12">
    <ul class="nav pull-right" style="margin-top:5px;margin-right:5px;">
      <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> Valider</label>
      <input type="submit" name="button" id="hButton" class="hidden ConfirmConfLinkModHeberge" value="<?php echo LANG_UPDATE_RECORD; ?>" />
    </ul>
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-reorder"></i> Liaison Module</h3>
      </div>
      <div class="panel-body">

        <div class="output"></div>

        <div class="form-horizontal">
          <div class="row">
            <div class="col-md-12">
              <br>
              <input id="module_id" name="module_id" type="hidden" />
              <input id="site_id" name="site_id" type="hidden" />
              <input type="hidden" name="id" value="">
              <div class="col-sm-3">

              </div>
              <div class="form-group">
                <label for="devise" class="col-sm-3 control-label tip">Lié avec le module RH</label>
                <div class="col-sm-1">
                  <?php
                  if ($_SESSION['ConfLinkMod_lie'] == 1) {
                  ?>
                    <input class="chklie" id="chklie1" name="chklie1" type="checkbox" checked="checked" value="1" />
                    <input class="chklie" id="chklie0" name="chklie0" type="checkbox" value="0" style="display: none;" />

                  <?php
                  } else {
                  ?>
                    <input class="chklie" id="chklie1" name="chklie1" type="checkbox" checked="checked" value="1" style="display: none;" />
                    <input class="chklie" id="chklie0" name="chklie0" type="checkbox" value="0" />
                  <?php
                  }
                  ?>
                  <input id="lie" name="lie" type="hidden" value="<?php echo $_SESSION['ConfLinkMod_lie']; ?>" />

                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <h5>Paramétrage des comptes</h5>
              <hr>
              <div class="row">
                <?php
                $nbArticles = count($_SESSION['ConfLinkMod']['code']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                  $code = $_SESSION['ConfLinkMod']['code'][$i];
                ?>
                  <div class="col-md-12">
                    <div class="col-sm-1">
                    </div>
                    <div class="form-group">
                      <label for="devise" class="col-sm-3 control-label tip" style="text-align: left; "><?php echo $_SESSION['ConfLinkMod']['champ'][$code] ?></label>
                      <div class="col-sm-6">
                        <?php
                        if ($_SESSION['ConfLinkMod']['code'][$i] == 'TRESLOC' || $_SESSION['ConfLinkMod']['code'][$i] == 'TRESETR') {
                        ?>
                          <input id="<?php echo $code; ?>" name="<?php echo $code; ?>libelle" type="hidden" value="<?php echo $_SESSION['ConfLinkMod']['libelle'][$code] ?>" class="form-control" />
                          <input id="<?php echo $code; ?>" type="text" value="<?php echo $_SESSION['ConfLinkMod']['libelle'][$code] ?>" class="form-control" disabled="disabled" />
                        <?php
                        } else {
                        ?>
                          <input id="<?php echo $code; ?>" name="<?php echo $code; ?>libelle" type="text" value="<?php echo $_SESSION['ConfLinkMod']['libelle'][$code] ?>" class="form-control inputvalaccount" />
                        <?php
                        }
                        ?>
                        <input id="<?php echo $code; ?>compte_ecriture" name="<?php echo $code; ?>compte_ecriture" type="hidden" value="<?php echo $_SESSION['ConfLinkMod']['compte_ecriture'][$code] ?>" />
                        <input id="<?php echo $code; ?>long_compte" name="<?php echo $code; ?>long_compte" type="hidden" value="<?php echo $_SESSION['ConfLinkMod']['long_compte'][$code] ?>" />
                        <input id="<?php echo $code; ?>souscompte_id" name="<?php echo $code; ?>souscompte_id" type="hidden" value="<?php echo $_SESSION['ConfLinkMod']['souscompte_id'][$code] ?>" />
                        <input id="<?php echo $code; ?>categorie_id" name="<?php echo $code; ?>categorie_id" type="hidden" value="<?php echo $_SESSION['ConfLinkMod']['categorie_id'][$code] ?>" />
                        <input id="<?php echo $code; ?>compte_id" name="<?php echo $code; ?>compte_id" type="hidden" value="<?php echo $_SESSION['ConfLinkMod']['compte_id'][$code] ?>" />


                      </div>
                    </div>
                  </div>
                <?php
                }
                ?>
                <!--   <div class="col-md-12">
                       <div class="col-sm-1">
                       </div>
                       <div class="form-group">
                        <label for="devise" class="col-sm-3 control-label tip" style="text-align: left;">Compte de la trésorerie (devise)</label>
                        <div class="col-sm-6">
                          <input id="produit" name="produit" type="text"   value="" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                     <div class="col-sm-1">
                     </div>
                     <div class="form-group">
                      <label for="devise" class="col-sm-3 control-label tip" style="text-align: left;">Compte des produits/services</label>
                      <div class="col-sm-6">
                        <input id="produitid" name="produitid" type="hidden"   value=""/>
                        <input id="produitnum" name="produitnum" type="hidden"   value=""/>
                        <input id="produittxt" name="produittxt" type="text"   value="" class="form-control inputvalaccount" pref="produit"/>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                   <div class="col-sm-1">
                   </div>
                   <div class="form-group">
                    <label for="devise" class="col-sm-3 control-label tip" style="text-align: left;">Compte de la T.V.A</label>
                    <div class="col-sm-6">
                     <input id="tvaid" name="tvaid" type="hidden"   value=""/>
                     <input id="tvanum" name="tvanum" type="hidden"   value=""/>
                     <input id="tvatxt" name="tvatxt" type="text"   value="" class="form-control inputvalaccount" pref="tva"/>
                   </div>
                 </div>
               </div> -->


              </div>


            </div>

          </div>

        </div>

      </div>
      <div class="panel-footer" style="border-bottom:solid 2px #CCC;">
      </div>



    </div>
    <!--/col-12-->

</form>

<div class="modal fade" id="myModalaccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Comptes</h4>
      </div>
      <div class="modal-body modalbodycompte">
        <input id="code" name="code" type="hidden" value="" />
        <select id="selectcompte" name="selectcompte" class="form-control choz">
          <?php
          $nbre = count($_SESSION['Comptes']['numero']);
          for ($i = 0; $i < $nbre; $i++) {
            $id = $_SESSION['Comptes']['id'][$i];
            $numero = $_SESSION['Comptes']['numero'][$i];
            $nom = $_SESSION['Comptes']['nom'][$i];
            $classe = $_SESSION['Comptes']['classe'][$i];
            $cat = $_SESSION['Comptes']['categorie_id'][$i];
            $compt = $_SESSION['Comptes']['compte_id'][$i];
            $modif = $_SESSION['Comptes']['modif'][$i];
            $format = (string)$numero;
            $longcompte = strlen($format);
            if ($longcompte == 2) {
              $categorie_id = $cat;
              $compte_id = 0;
              $souscompte_id = 0;
            } elseif ($longcompte == 3) {
              $compte_id = $compt;
              $categorie_id = $cat;
              $souscompte_id = 0;
            } elseif ($longcompte == 4) {
              $souscompte_id = $id;
              $categorie_id = $cat;
              $compte_id = $compt;
            }



          ?>
            <option lg="<?php echo $longcompte; ?>" value="<?php echo $id; ?>" cat="<?php echo $categorie_id; ?>" compt="<?php echo $compte_id; ?>" scompt="<?php echo $souscompte_id; ?>" num="<?php echo $numero; ?>"><?php echo ucfirst($numero . ' . ' . $nom); ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger pull-right" id="btnconfirmaccount"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
        </button>
        <span class="btn btn-info hidden pull-right" id="loader">
          <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
        </span>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>