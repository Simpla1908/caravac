<?php
if (!empty($_GET['isajax']) && $_GET['isajax'] == 'oui') {
    include '../../bdd/connexion.php';
    include'../traitement/requette_abonnement.php';
    include '../traitement/facture_bymodule.php';
    require '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
} else {
    include '../traitement/facture_bymodule.php';
    require '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
}

$total = 0;
$mont_regl=0;
$montant_tot_sous=0;
$reste=0;
foreach ($resultats as $o) { 	
    $id_c = $o->id_c;
    $id_hotel = $o->id_hotel;
    $id_fact = $o->id_fact;
    $idmodcomp=$o->idmodule;
    $num_fact = $o->num_fact;
    $date_edition = $o->date_edition;
    $date_echeance = $o->date_echeance;
    $dte_blocage =$o->dte_blocage;
    $etat = $o->etat_fac;
    $nom_c = $o->nom_hotel;
    $resposable = $o->resposable;
    $adresse_c = $o->adresse_hotel;
    $telephone_user = $o->telephone_user;
    $libelle = $o->libelle;
    $date_activ = $o->date_activ;
    $montant_fac= $o->mont_ttc;
    if(count($reglement_by_facture)>=0){
       foreach ($reglement_by_facture as $r) { 
        $mont_regl=round($r->mont_rglt,2);
       }
    }  else {
        $mont_regl=0;
    }
   $reste=$montant_fac - $mont_regl;
   $_SESSION['reste']=$reste;
}
?>
<section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12 invoice-header">
            <h3>
                <i class="fa fa-globe"></i><?php echo $num_fact ?>
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
                <br>Phone: <?php echo $telephone_user ?>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>Date édition:</b> <?php echo $date_edition ?>
            <br>
            <b>Date échéance:</b> <?php echo $date_echeance ?>
            <br>
            <b>Date de blocage :</b> <?php echo $dte_blocage ?>
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
                        <th>Module</th>
                        <th>Nombre utilisateur</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($resultats as $o): ?>
                        <tr>
                            <td><?php echo $o->nom ?></td>
                             <td><?php echo $o->nbreuser ?></td>
                            <td><?php echo $o->mont_ttc.' $' ?></td>
                            <td><?php echo $etat ?></td>
                        </tr>
                        <?php
                        $total+=$o->mont_ttc;
                        $i++;
                        endforeach; 
                        ?>
                </tbody>
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

