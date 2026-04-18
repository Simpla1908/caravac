<?php
if(!empty($_GET['isajax'])&& $_GET['isajax']=='oui'){
    
    include '../../bdd/connexion.php';
    include '../traitement/company.php';
}  else {
   include '../traitement/company.php'; 
}

$total = 0;
$totalapayer = 0;
$netapayer = 0;
$bool =FALSE;
foreach ($resultats as $o) {
    $id_hotel = $o->hotel;
    $id_c = $o->id_c;
    $etat = $o->etat_hotel;
    $nom_c = $o->nom_c;
    $nom_hotel = $o->nom_hotel;
    $resposable = $o->resposable;
    $adresse_c = $o->adresse_c;
    $telephone_user = $o->telephone_user;
    $libelle = $o->libelle;
    $date_sous = $o->date_sous;
    $date_activ = $o->date_activ;
    $montant_tot_sous = $o->montant_tot_sous;
    break;
}
?> 
<section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12 invoice-header">
            <h3>
                <i class="fa fa-globe"></i> <?php echo $nom_hotel ?>
                <small class="pull-right">Numéro #<?php echo $libelle ?></small>
            </h3>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Responsable
            <address>
                <strong><?php echo $resposable?></strong>
                <br>
                <?php echo $adresse_c ?>
                <br>Téléphone: <?php echo $telephone_user ?>
                <br><?php if ($etat == 1) {
                    echo 'Activé';
                } else {
                    echo 'Désactivé';
                } ?>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>Numéro #<?php echo $libelle ?></b>
            <br>
            <b>Date de souscription:</b> <?php echo $date_sous ?>
            <br>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Module</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody id="c">
                    <?php $i = 1;
                    foreach ($req_moduleBysite as $o) { ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $o->nom ?></td>
                            <td><?php echo $o->montantmodule ?> $</td>
                            <td>
                            <?php if ($o->etat_module == 1) { ?>
                               activé
                             <?php } else { ?>
                               désactivé  
                             <?php } ?>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        $total+=$o->montantmodule;
                        if ($o->paye ==0){
                          $totalapayer+=$o->montantmodule;  
                          $bool =TRUE;
                        }
                    } 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Total</td>
                        <td ><?php echo $total.' $' ?></td>
                        <td></td>
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
             <?php  if($bool){?>
            <button class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-save"></i> Payer</button>
            <?php  }?>
        </div>
    </div>
</section>

