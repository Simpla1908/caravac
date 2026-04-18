<?php include('Gerant_global.php'); ?>
<?php include('headerRec.php'); ?>
<?php
include('menu_Rec_config.php');
include('./Amelioration/bdd/connexion .php');
include('./Amelioration/reglage/monnaie.php');
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Réglage </h3>
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <?php if (in_array('CDT',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                        <li class="active">
                            <a href="#home-pills" data-toggle="tab">Général</a>
                        </li>
                        <?php }?>
                        <?php if (in_array('CDM',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                        <li>
                            <a href="#profile-pills" data-toggle="tab">Monnaie</a>
                        </li>
                        <?php }?>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home-pills">
                            <h4>Réglage général</h4>
                            <form method="post" action="">
                                <?PHP
                                $regl = new Reglage(0, 0, '', 0, '', '');
                                $regl->voirreglage();
                                ?>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile-pills">

                            <div class="table-responsive">
                                <h4>Choix de la monnaie à utiliser pour l'affichage</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Symbole</th>
                                            <th>Description</th>
                                            <th>Choix</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monnaie">
                                        <?php $i = 1;
                                        foreach ($monnaies as $m): ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $m->symbole ?></td>
                                                <td><?php echo $m->lib_monnaie ?></td>
                                                <?php if ($m->choix==1) {?>
                                                <td><input type="radio" name="choix" id="choix"  value="<?php echo $m->id_monnaie ?>" checked="checked"></td>
                                                <?php }else{ ?>
                                                <td><input type="radio" name="choix" id="choix"  value="<?php echo $m->id_monnaie ?>"></td>
                                                <?php } ?>
                                            </tr>
    <?php $i++;
endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>  <!-- /.row -->
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
        $('#monnaie #choix').click(function (e) {
            if ($(this).is(":checked")) {
                
               var choix=$(this).val();
                $.ajax({
                    url: './Amelioration/reglage/update.php',
                    async: true,
                    type: 'POST',
                    data: "choix=" + choix,
                    global: false,
                    cache: false,
                    success: function (html) {
                   
				   }
                });
            } else {

            }

        });

        $('#dataTables-example').dataTable();
    });
</script>
</body>

</html>
