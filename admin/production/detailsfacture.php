<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Détails facture</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <section class="content invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12 invoice-header">
                                <h1>
                                    <!--<i class="fa fa-globe"></i>-->
                                    <small class="pull-right">
                                        <span class="badge bg-red" id="spetat">
                                            <?php
                                            if($totpayefact==0){
                                              echo 'Non Payée';  
                                            }else{
                                               echo 'Payée' ;
                                            }
                                            ?>
                                        </span>
                                    </small>
                                </h1>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>Entreprise: <?php echo $nom_c ?></strong>
                                    <br><strong>Site: <?php echo $nom_hotel ?></strong>
                                    <br>Phone: <?php echo $phone ?>
                                    <br>Email: <?php echo $mail ?> 
                                    <br><?php echo $adresse_hotel ?> 
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>Souscription #<?php echo $num_scrpt ?></strong>
                                    <br><strong>Facture #<?php echo $num_fact ?></strong>
                                    <br>Date Edition: <?php echo dateAffiche($dte_edition) ?>
                                    <br>Echéance: <?php echo dateAffiche($date_echeance) ?>
                                </address>
                            </div>
                            <?php if($totpayefact>0){?>
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <br><strong>N° Reçu #<span id="num_recu1"> <?php echo $num_recu ?></span></strong>
                                    <br>Mode: <span id="mode1"> <?php echo $libmode ?></span>
                                    <br>Date de paiement:<span id="dtepaie1"> <?php echo dateAffiche($dte_reglmt) ?></span> 
                                </address>
                            </div>
                            <?php }else{?>
                            <div class="col-sm-4 invoice-col detailspaie hidden">
                                <address>
                                    <br><strong>N° Reçu #<span id="num_recu"> <?php echo $num_recu ?></span></strong>
                                    <br>Mode: <span id="mode"> <?php echo $libmode ?></span>
                                    <br>Date de paiement:<span id="dtepaie"> <?php echo dateAffiche($dte_reglmt) ?></span> 
                                </address>
                            </div>
                            <?php }?>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Désignation</th>
                                            <th>QTE</th>
                                            <th>P.U</th>
                                            <th>P.Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        $nbre_user=0;
                                        foreach ($lignes as $r) {
                                            $libelle = $r->libelle;
                                            $prix = $r->montant;
                                            $qte = $r->qte;
                                            $nbre_user =$qte;
                                            $montant = $prix * $qte;
                                            ?>  
                                            <tr>
                                                <td><?php echo $libelle ?> </td>
                                                <td><?php echo $qte ?> </td>
                                                <td><?php echo afficheMontant($monnaie, $prix) ?> </td>
                                                <td><?php echo afficheMontant($monnaie, $montant) ?> </td>
                                            </tr>
                                            <?php
                                            $total+=$montant;
                                        }
                                        $tva = montant_tva($total, $montant_rem, $tva);
                                        $ht = ht($total, $tva, $montant_rem);
                                        ?> 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" align="right"><span class="pull-right">HT</span></th>
                                            <td><?php echo afficheMontant($monnaie,$ht) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" align="right"><span class="pull-right">TVA</span></th>
                                            <td><?php echo afficheMontant($monnaie,$tva) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" align="right"><span class="pull-right">TTC</span></th>
                                            <td><?php echo afficheMontant($monnaie,$total) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <!--<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>-->
                                <?php if($totpayefact==0){?>
                                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#myModalreglement" id="btnpaidscrpt"><i class="fa fa-credit-card"></i> Payer</button>
                                <?php }?>
                                <!--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Modal de paiement-->
<div class="modal fade" id="myModalreglement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Paiement : <span id="affiche_montfact1"><?php echo afficheMontant($monnaie,$total) ?></span></strong></h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message">
                        <span id="message"> Best check yo self, you're not looking too good.</span>
                 </div>
                <form action="../traitement/souscription.php" method="post" id="form" class="f_modal_paiement">
                    
                    <div class="col-lg-12 form-group hidden">
                        <input type="text" name="type_fact" id="type_fact" value="<?php echo $type_fact ?>">
                        <input type="text" name="nbre_user" id="nbre_user" value="<?php echo $nbre_user ?>">
                        <input type="text" name="etat_scrpt" id="etat_scrpt" value="<?php echo $etat_scrpt ?>">
                        <input type="text" name="type_souscription" id="type_souscription" value="<?php echo $type_souscription ?>">
                         <input type="text" name="souscription_id" id="souscription_id" value="<?php echo $souscription_id ?>">
                        <input type="text" name="id_fact" id="id_fact" value="<?php echo $id_fact ?>">
                        <input type="text" name="totfact" id="totfact" value="<?php echo $total ?>">
                        <input type="text" name="company_id" id="company_id" value="<?php echo $company_id ?>">
                        <input type="text" name="id_hotel" id="id_hotel" value="<?php echo $id_hotel ?>">
                    </div>
                    <div class="col-lg-12 form-group">
                        <label>Mode de paiement</label>
                        <select name="modepaiement" class="form-control select2" style="width: 100%;" id="mode">
                             <?php foreach($modes as $o){ ?>
                                <option value="<?php echo $o->id_mode_regl ?>"><?php echo $o->lib  ?></option>
                             <?php } ?> 
                        </select>
                    </div>
                    <div class="col-lg-12 form-group cachebtn" id="div_montant">
                        <label>Montant</label>
                        <div class="input-group">
                            <input type="text" id="montant" name="montant" class="form-control montant" value="<?php echo $total; ?>">
                            <span class="input-group-addon"><?php echo $monnaie; ?></span>
                        </div>
                    </div>
                </form>
            </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn_cache" data-dismiss="modal">Annuler</button>
                 <span class="loader text-danger hidden">
                    <i class="fa fa-refresh fa-spin fa-1x text-danger"></i> Patientez !
                  </span>
                <button type="submit" class="btn btn-primary btn_cache" id="btn_paie_scrpt">&nbsp;Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
