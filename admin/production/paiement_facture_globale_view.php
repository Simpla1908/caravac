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
            <b>Date édition:</b> <?php echo $date_edition ?>
            <br>
            <b>Date échéance:</b> <?php echo $date_echeance ?>
            <br>
            <b>Date de blocage :</b> <?php echo $dte_blocage ?>
        </div>
        <!-- /.col -->
        <?php
//        if ($mont_regl > 0 && $mont_regl < $montant_fac) {
            echo '<div class="col-sm-4 invoice-col" >
                    <h4>
                       <b> 
                           Reste:' . $reste . ' $</b>
                    </h4>
                 </div>';
//        }
        ?>
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
                    <?php
                    $i = 1;
                    foreach ($resultats as $o):
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $o->nom ?></td>
                            <td><?php echo $o->nbreuser ?></td>
                            <td><?php echo $o->montantmodule . ' $' ?></td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td ><?php echo $total . ' $' ?></td>
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
            <?php // if($etat=='Brouillon'||$etat=='Ouverte'){  ?>
            <button class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-save"></i> Payer</button>
            <?php // }  ?>
        </div>
    </div>
</section>

