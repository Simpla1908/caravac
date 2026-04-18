<?php include('Gerant_local.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php require './Amelioration/bdd/connexion .php'; ?>
<?php
    include'../admin/traitement/requette_abonnement.php';
    include '../admin/traitement/req_details_factureglobal.php';
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
    $etat='Non payée';
} elseif ($totalregle >0 && $totalregle < $total) {
     $etat='Ouverte';
} else {
    $etat='Payée';
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Factures </h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12 invoice-header">
            <h3>
                <i class="fa fa-home"></i> <?php echo $nom_c ?>
                 <small class="pull-right"><span class="label label-danger"><?php echo $etat ?></span></small>
                 
            </h3>
        </div>
        <!-- /.col -->
    </div>
    <br>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <b>Date édition</b><br> <?php echo date_formatee($date_edition) ?>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>Date échéance</b><br> <?php echo date_formatee($date_echeance) ?>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>Date de blocage</b><br> <?php echo date_formatee($dte_blocage) ?>
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
    <br><br>
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
            <!--<button class="btn btn-default" onclick=""><i class="fa fa-print"></i> Imprimer</button>-->
             <?php if($etat=='Brouillon'||$etat=='Ouverte'){?>
            <!--<button class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-save"></i> Payer</button>-->
            <?php }?>
        </div>
    </div>
</section>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
        $("#site_id").change(onSelectChange);
        function onSelectChange() {
        var site_id = $("#site_id option:selected").val();
       // alert(site_id);
          $.ajax({
            url: 'Traitement/maj_affich_monito.php?site_id=' + site_id,
            type: 'POST',
            success: function (data) {
                $("#table-monito").empty().append(data);
            }
        });
    
        }
    });
</script>
</body>

</html>


