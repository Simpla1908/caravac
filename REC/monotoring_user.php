<?php include('Gerant_local.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php require './Amelioration/bdd/connexion .php'; ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Monotoring </h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                       Utilisateurs
                        
<!--                        <div class="btn-group  btn-group-sm pull-right">
                            <select class="form-control col-md-7 col-xs-12 select2" required="required" id="site_id" name="site_id">
                                <option value='0'>Filtrer par site</option>
                                <?php
//                                include("./Amelioration/caisse/caisse_hotel.php");
//                                foreach ($hotels as $h):
//                                    echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
//                                endforeach;
                                ?>
                            </select>
                        </div>-->
                    </h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Affichage Operation-->
                    <?php include('Traitement/affichage_monotoring_user.php'); ?>
                    <div class="table-responsive" id="table-monito">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Utilisateur</th>
                                    <th>Date et Heure de connexion</th>
                                    <th>Date et Heure de déconnexion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($operations as $operation): ?>
                                    <tr class="odd gradeX"> 	
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $operation->prenom_user.' '.$operation->nom_user ?></td>
                                        <td><?php echo $operation->date_con ?></td>
                                        <td><?php echo $operation->date_decon ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                endforeach;
                                ?>
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


