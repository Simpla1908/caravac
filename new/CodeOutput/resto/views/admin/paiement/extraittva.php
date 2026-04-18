
  <?php
  /*
  * =======================================================================
  * FILE NAME:        View.php
  * DATE CREATED:   17-11-2017
  * FOR TABLE:      paiement
  * PRODUCED BY:    HEZECOM UltimateSpeed PHP CODE GENERATOR
  * AUTHOR:     Hezecom (http://hezecom.com) info@hezecom.net
  * =======================================================================
  */
  if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
  ?>
  <?php AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=paiement&do=autosearch');?>
  
  <div class="row">
            <div class="col-xs-12">
              <div class="box">
              
               <div class="box-header with-border">
               <h3 class="box-title titrepg">Extrait TVA du <?php echo date('d/m/Y');?> au <?php echo date('d/m/Y');?></h3>
                <ul class="nav pull-right">

    <a  class="btn btn-default btn-xs tip" title="Filtrer les paiements" data-toggle="modal" data-target="#modalfiltrerpaie"><i class="fa fa-sort"></i> Filtrer</a>

  <a href="<?php echo H_ADMIN_MAIN;?>&view=paiement&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip btn_prnt_fextrtva" title="<?php echo LANG_TIP_PRINT;?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
  <!--<a href="<?php echo H_ADMIN_MAIN;?>&view=paiement&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL;?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL;?></a>-->
  <!--<a href="<?php echo H_ADMIN_MAIN;?>&view=paiement&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD;?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>-->
  <!--<a href="<?php echo H_ADMIN;?>&view=paiement&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE;?>" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE;?></a>-->
  </ul>
  
   </div><!-- /.box-header -->
   <div class="box-body">
   
   <!--AUTO COMPLETE-->
  <div class="col-md-3 autosearch hidden">
    <div class=" s-absolute">
            <div class="input-group">
              <input type="text" class="form-control input-sm styler" id="inputString" onkeyup="lookup(this.value);"  placeholder="search" autocomplete="off">
              <span class="input-group-btn">
                <button class="btn btn-default btn-sm" type="button"><span class="fa fa-search"></span></button>
              </span>
            </div><!-- /input-group -->
            <div id="suggestions"></div>
      </div>
      </div><!--/col-lg-3--> 
   <!--/AUTO COMPLETE-->
   
  <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE;?>" data-page-previous-text="<?php echo LANG_PREVIOUS;?>" data-page-next-text="<?php echo LANG_NEXT;?>">
  <thead>
    <tr>
      <th>#</th>
      <th>N° Facture</th>
    <th data-hide="phone,tablet">Montant total</th>
    <th data-hide="phone,tablet">Montant TVA</th>
  </tr>
  </thead>
  <tbody id="majdatastva"> 
  
   <?php
   //Mise en session pour impression
   $_SESSION['rows_paiement'] = array();
   $_SESSION['rows_paiement']['i'] = array();
   $_SESSION['rows_paiement']['num_fact'] = array();
   $_SESSION['rows_paiement']['montant_ttc'] = array();
   $_SESSION['rows_paiement']['montant_tva'] = array();

   //Fin mise en session
   $montant_ttc_tot = 0;
   $montant_tva_tot = 0;
   $i = 1;
  foreach($result as $rows){
  $montant_ttc = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant_total);
  $montant_tva = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->mont_tva);
  $montant_ttc_tot+=$montant_ttc;
  $montant_tva_tot+=$montant_tva;

  ?>
  <tr>
  <td><?php echo $i; ?></td>
  <td><?php echo $rows->num_fact;?></td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_ttc);?></td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_tva);?></td>
    </tr>
  <?php
  //Mise en session pour impression
    array_push($_SESSION['rows_paiement']['i'], $i);
    array_push($_SESSION['rows_paiement']['num_fact'], $rows->num_fact);
    array_push($_SESSION['rows_paiement']['montant_ttc'], afficheMontant($_SESSION['Paie_affiche'],$montant_ttc));
    array_push($_SESSION['rows_paiement']['montant_tva'], afficheMontant($_SESSION['Paie_affiche'],$montant_tva));
    //Fin mise en session
    $i++;
   }
   ?>
  </tbody>
<tfoot id="majdatastva1">
          <tr>
          <th colspan="2">Total</th>
           <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_ttc_tot);?></td>
           <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_tva_tot);?></td>
          </tr>
</tfoot>
</table>
 <?php 
    //Mise en session pour impression
    $_SESSION['datedebut_paiement']=date('d/m/Y');
    $_SESSION['datefin_paiement']=date('d/m/Y');
    $_SESSION['montant_ttc_tot']=afficheMontant($_SESSION['Paie_affiche'], $montant_ttc_tot);
    $_SESSION['montant_tva_tot']=afficheMontant($_SESSION['Paie_affiche'], $montant_tva_tot);

    //Fin mise en session
?>
  </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
  <!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfiltrertva" name="frmfiltrertva">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Filtrer extrait T.V.A</h4>
            </div>
            <div class="modal-body text-center">
                <div class="output"></div>

                <div class="form-group">
                        <label for="dte1">Du</label>
                          <input name="datedebut" id="datedebut" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2"> 
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="datefin" id="datefin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                    </div>
        </div>
        <div class="modal-footer">
            <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
            </div>
            <button  class="btn btn-danger pull-right col-md-2"
                id="btnfiltrerextrtva"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
            </button>
            <span class="btn btn-info hidden pull-right" id="loader">
                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
            </span>
        </div>
        </div>
        <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->