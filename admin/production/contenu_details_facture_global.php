<?php
    include '../traitement/req_details_factureglobal.php';
    include '../../FUNCTION/date_format.php';
$mont_regl=0;
$montant_tot_sous=0;
$etat ='';
foreach ($resultats as $o) { 	
    $id_hotel = $o->id_hotel;
    $id_fact = $o->id_fact;
    $num_fact = $o->num_fact;
    $date_edition = $o->date_edition;
    $date_echeance = $o->date_echeance;
    $dte_blocage =$o->dte_blocage;
    $nom_c = $o->nom_hotel;
    $adresse_c = $o->adresse_hotel;
    $libelle = $o->libelle;
    $mois= $o->nom_mois;
    break;
}
if ($totalregle == 0) {
    $etat='Brouillon';
} elseif ($totalregle >0 && $totalregle < $total) {
     $etat='Ouverte';
} else {
    $etat='Payé';
}
?>
<section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12 invoice-header">
            <h3>
                <i class="fa fa-globe"></i><?php echo $libelle ?>
                 <small class="pull-right"><span class="label label-danger"><?php echo $etat ?></span></small>
    
            </h3>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Client
            <address>
                <strong><?php echo $nom_c ?></strong>
                <br>
                <?php echo $adresse_c ?>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>Date édition:</b> <?php echo date_formatee($date_edition) ?>
            <br>
            <b>Date échéance:</b> <?php echo date_formatee($date_echeance) ?>
            <br>
            <b>Date de blocage :</b> <?php echo date_formatee($dte_blocage) ?>
        </div>
         <!-- /.col -->
        <?php if($mont_regl>0 && $mont_regl< $montant_fac){
            echo '<div class="col-sm-4 invoice-col" >
                    <h4>
                       <b> 
                           Reste:'.$reste.' $</b>
                    </h4>
                 </div>';
        }?>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th>Module</th>
                        <th>Utilisateur</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($resultats as $o): ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $o->nom ?></td>
                             <td><?php echo $o->nbreuser ?></td>
                            <td><?php echo $o->montantmodule.' $' ?></td>
                        </tr>
                        <?php
                        $i++;
                        endforeach; 
                        ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td ><?php echo $total.' $' ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">

        </div>
    </div>
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-default" onclick=""><i class="fa fa-print"></i> Imprimer</button>
             <?php if($etat=='Brouillon'||$etat=='Ouverte'){?>
            <button class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-save"></i> Payer</button>
            <?php }?>
        </div>
    </div>
</section>

