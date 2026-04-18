<?php include('Gerant_local.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php require '../bdd/connexion.php'; ?>

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
                    <!-- Affichage Operation-->
                    <?php
                    include '../admin/traitement/fonctionalites.php';
                    $monnaie='$';
                    $result=ListeFactScpt2($_SESSION['id_hotel'],$bdd);
                    ?>
                    <div class="table-responsive" id="table-monito">
                        <table class="table table-striped table-bordered table-hover table-condensed"
                               id="dataTables-example">
                            <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>N° Souscription</th>
                                <th>N° Facture</th>
                                <th>Type</th>
                                <th>Date édition</th>
                                <th>Montant total</th>
                                <th>Montant payé</th>
                                <th>Solde</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="c">
                            <?php 
                            $i=1;
                            $reste=0;
                            foreach($result as $o){
                               $id_fact=$o->id_fact;
                               $num_scrpt=$o->libelle;
                               $num_fact=$o->num_fact;
                               $mont_ttc=$o->mont_ttc;
                               $mont_tot= afficheMontant($monnaie,$mont_ttc);
                               $totpaye=MontpayeFactScpt($id_fact,$bdd);
                               $mont_paye= afficheMontant($monnaie,$totpaye);
                               $reste=$mont_tot-$mont_paye;
                               $reste_af= afficheMontant($monnaie,$reste);
                               $dte_echeance=  dateAffiche($o->date_echeance);
                               $dte_edition=  dateAffiche($o->date_edition);
                               $nom_c=$o->nom_c;
                               $nom_hotel=$o->nom_hotel;
                               $type='souscription';
                               if($o->type=='adduser'){
                                   $type='Achat User'; 
                               }
                             ?>
                            <tr>
                                <td><?php  echo $i ?></td>
                                 <td><?php echo $num_scrpt?></td>
                                <td><?php echo $num_fact?></td>
                                <td><?php echo $type?></td>
                                <td><?php echo $dte_edition?></td>
                                <td><?php  echo $mont_tot?></td>
                                <td><?php  echo $mont_paye?></td>
                                <td><?php  echo $reste_af?></td>
                                <td>
                                    <?php if($type=='souscription'){ ?>
                                     <a href="#"class="btn btn-primary btn-xs"> Voir </a>
                                    <?php } ?>
                                   
                                </td>
                            </tr>
                           <?php $i++;};?>
                        </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
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


