<?php
//var_dump($result);
?> 
<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Détails souscription </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h3>
                              <i class="fa fa-globe"></i> <?php echo $libelle?>
                           </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          Client
                          <address>
                            Entreprise: <b><?php echo $nom_c?> </b>
                             <br>Site:<b><?php echo $nom_hotel?></b> 
                             <br>Personne à contacter: <b><?php echo $nom_user?></b>  
                            <br>Phone: <b><?php echo $telephone_user?> </b> 
                            <br>Email: <b><?php echo $adresse_mail?> </b> 
                          </address>
                        </div>
                        <!-- /.col -->
                       
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                             <address>
                                <b>Date de souscription:</b> <?php echo dateAffiche($date_sous)?> 
                                  <br>
                                <b>Statut:</b> 
                                <?php if($etat==1){?>
                                     <span class="badge"><?php echo $statut;?></span>
                                <?php }else{?>
                                     <span class="badge bg-red"><?php echo $statut;?></span>
                                <?php }?>
                                <b>Etat:</b> 
                                <?php if($etat==1){?>
                                     <span class="badge"><?php echo $lib_etat;?></span>
                                <?php }else{?>
                                     <span class="badge bg-red"><?php echo $lib_etat;?></span>
                                <?php }?>
                             </address>
                        </div>
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Désignation</th>
                                 <th>Qté</th>
                                <th>Prix</th>
                                <th>Montant</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $total=0;
                              foreach($lignes as $r){
                                    $libelle=$r->libelle;
                                    $prix=$r->prix_user;
                                    $qte=1;
                                    $montant=$prix*$qte;
                               ?>  
                              <tr>
                                <td><?php echo $libelle?> </td>
                                 <td><?php echo $qte?> </td>
                                <td><?php echo afficheMontant($monnaie,$prix)?> </td>
                                <td><?php echo afficheMontant($monnaie,$montant)?> </td>
                              </tr>
                              <?php 
                               $total+=$montant;
                              }
                              $tva=montant_tva($total,$montant_rem,$tva);
                              $ht=ht($total,$tva,$montant_rem);
                              ?> 
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row hidden">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead"></p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">HT:</th>
                                  <td><?php echo afficheMontant($monnaie,$ht)?> </td>
                                </tr>
                                <tr>
                                  <th>TVA:</th>
                                  <td><?php echo afficheMontant($monnaie,$tva)?> </td>
                                </tr>
                                <tr>
                                  <th>TTC:</th>
                                  <td><?php echo afficheMontant($monnaie,$total)?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <form class="frm_souscription hidden">
                          <input type="text" id="souscript_id" name="souscript_id" value="<?php echo $souscription_id ?>">
                          <input type="text" id="type_souscription" name="type_souscription" value="<?php echo $type_souscription ?>">
                          <input type="text" id="etat" name="etat" value="<?php echo $etat ?>">
                          <input type="text" id="site_id" name="site_id" value="<?php echo $site_id ?>">
                      </form>
                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <!--<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>-->                         
                           <?php if($etat==0){?>
                            <button class="btn btn-success pull-right btn_actve_scrpt">Réactiver</button>
                          <?php }else{?>
                            <button class="btn btn-danger pull-right btn_bloque_scrpt" style="margin-right: 5px;"> Désactiver</button>
                          <?php }?>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!--Modal activation-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Activation</h4>
            </div>
            <div class="modal-body">
               Voulez - vous activer cette souscription?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                <button type="button" class="btn btn-primary">Oui</button>
            </div>

        </div>
    </div>
</div>