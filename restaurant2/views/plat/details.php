<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Facture
        <small>#<?php echo $num_fact ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="main.php?p=facture&d=liste">Factures</a></li>
        <li class="active">Détails</li>
      </ol>
    </section>

    <div class="pad margin no-print hidden">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $nom_client ?>
            <small class="pull-right">Date:<?php echo dateAffiche($date_edition) ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Facturé à
          <address>
            <strong><?php echo $nom_client ?></strong><br>
            <?php if(!empty($telephone_client)){ ?>
             Téléphone: <?php echo $telephone_client ?><br>
            <?php } ?>
            <?php if(!empty($email_client)){ ?>
            Email: <?php echo $email_client ?>
            <?php } ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         Vendeur
          <address>
            <strong><?php echo $nom_user ?></strong><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>N° facture #<?php echo $num_fact ?></b><br>
          <?php if($annule!='3'){?>
          <b>Mode de paiement:</b> <?php echo $mode ?><br>
          <?php }else{ ?>
          <b>Statut:</b> <?php echo "annulé" ?><br>
          <?php } ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
            <tr>
              <th>Désignation</th>
              <th>Quantité</th>
              <th>Prix</th>
              <th>Montant</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($lignes as $l){
                $designation=$l->designation;
                $qte=$l->qte;
                $prix= montant_equivalent_bdd($monnaie,$m_affiche,$taux_prix,$l->prix);
                $montant=$prix*$qte;
                
            ?> 
            <tr>
                <td><?php echo $designation  ?></td>
                <td><?php echo $qte  ?></td>
                <td><?php echo  afficheMontant($m_affiche,$prix) ?></td>
                <td><?php echo afficheMontant($m_affiche,$montant)?></td>
            </tr>
            <?php
            }
            ?> 
            </tbody>
            <tfoot>
              <tr>
                <th colspan="3"><span class="text-right pull-right">HT</span></th>
              <th><?php echo afficheMontant($m_affiche,$ht)?></th>
            </tr>  
            <tr>
                <th colspan="3"><span class="text-right pull-right">TVA</span></th>
              <th><?php echo afficheMontant($m_affiche,$mont_tva)?></th>
            </tr> 
            <tr>
                <th colspan="3"><span class="text-right pull-right">Remise</span></th>
              <th><?php echo afficheMontant($m_affiche,$mont_remise)?></th>
            </tr>
            <tr>
                <th colspan="3"><span class="text-right pull-right">TTC</span></th>
              <th><?php echo afficheMontant($m_affiche,$mont_ttc)?></th>
            </tr>
            <?php if($annule!='3'){?>
            <tr>
                <th colspan="3"><span class="text-right pull-right">Montant payé</span></th>
              <th><?php echo afficheMontant($m_affiche,$mont_paye)?></th>
            </tr>
            <?php if($rendu>0){?>
                <tr>
                    <th colspan="3"><span class="text-right pull-right">Rendu</span></th>
                  <th><?php echo afficheMontant($m_affiche,$rendu)?></th>
                </tr> 
            <?php }?>
            <?php }?>
            
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <?php if($mont_paye<$mont_ttc && $annule!='3'){?>  
            <button type="button" class="btn btn-success pull-right" id="btn_regler_credit"><i class="fa fa-credit-card"></i> Payer</button>
           <?php }?>
            <a href="impression/examples/ticket.php" target="_blank" class="btn btn-primary pull-right tip "  style="margin-right: 5px;" ><i class="fa fa-print"></i> Imprimer</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
     <input type="hidden" name="montant_fact" id="montant_fact" value="<?php echo afficheMontant($m_affiche, $solde) ?>">
     <input type="hidden" name="mont_equivalent" id="mont_equivalent" value="<?php echo afficheMontant($m_eqvt, $solde_eqv) ?>">
     <input type="hidden" name="id_fact" class="id_fact" value="<?php echo $id_fact ?>">
     <input type="hidden" name="montant_tot" class="montant_tot" value="<?php echo $solde ?>">
  </div>

