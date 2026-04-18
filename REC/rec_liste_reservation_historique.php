<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec.php'); ?>

<div id="page-wrapper">
    <div class="col-lg-12">
        <h1 class="page-header">Réservation</h1>
        <div class="panel panel-default">
            <!--Menu tabulation-->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="dropdown"> <a  href="rec_liste_reservation.php"> Réservation en cours <b class="caret"></b></a></li>
                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="rec_liste_reservation_periodique.php">Réservation  périodique <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li style="padding:10px;">
                            <form action="rec_liste_reservation_periodique.php" method="post" name="periode">
                                <fieldset>
                                    <div style="border:1px solid #dddddd; padding:10px;">
                                        <table width="300" border="0">
                                            <tr>
                                                <td width="120"> <label for="date">Date de debut&nbsp;:</label></td>
                                                <td width="5"></td>
                                                <td><input id="datetimepickerOcc"  type="date" class="form-control"  name="date_d" required >
                                                </td>
                                            </tr>
                                            <tr>
                                            <tr height="15">
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td> <label for="date">Date de fin&nbsp;:</label></td>
                                                <td width="5"></td>
                                                <td>
                                                    <input id="datetimepickerLib"  type="date" class="form-control"  name="date_f" required >
                                                </td>
                                            </tr>
                                            <tr height="15">
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td width="5"></td>
                                                <td align="left"> <button  name="sauvegarder" type="submit" class="btn btn-primary">Valider</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                </fieldset>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="dropdown active"> <a  href="rec_liste_reservation_historique.php">Réservation  historique <b class="caret"></b></a></li>
            </ul>
            <!--/Menu tabulation-->

            <?php
            if (isset($_POST['sauvegarder'])) {
                $date_d = $_POST['date_d'];
                $date_f = $_POST['date_f'];

                $_SESSION['date_d'] = $date_d;
                $_SESSION['date_f'] = $date_f;

                $date_d1 = explode(' ', $date_d);
                $date_d_expl1 = explode('/', $date_d1[0]);

                $date_d_expl = $date_d_expl1[2] . '-' . $date_d_expl1[1] . '-' . $date_d_expl1[0];

                $date_f1 = explode(' ', $date_f);
                $date_f_expl1 = explode('/', $date_f1[0]);

                $date_f_expl = $date_f_expl1[2] . '-' . $date_f_expl1[1] . '-' . $date_f_expl1[0];
            }
            ?>

            <div class="panel-heading">
                <h4>
                    Liste de réservations historique 
                    
                    <?php if (in_array('ILR',$_SESSION['actions']['code_actions'])){?>
                    <a class="btn btn-primary btn-sm pull-right"  href="impression/imprime_liste_reservation.php?reservation=historique" target="_blank"><i class="fa fa-print"></i> Imprimer</a>
                    <?php }?>
                    <?php if (in_array('ER',$_SESSION['actions']['code_actions'])) { ?>
                    <a class="btn btn-primary btn-sm pull-right"  href="rec_reservation_multiple.php?hebergement=1"><i class="fa fa-edit"></i> Effectuer une réservation</a>
                    <?php } ?>
                </h4>
            </div>
            <!-- /.panel-heading -->


            <!-- Div stratégique -->
            <div class="panel-body">
                <div class="table-responsive">



                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>N° Rés</th>
                                <th>Client</th>
                                <th>Date réservation </th>
                                <th>Date d'arrivée </th>
                                <th>Date de sortie </th>
                                <th>Etat</th>           
                                <th align="center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $type = 'reservation';

                            /* Recuperation du paiement d'un client */
                            $requete_reserv = $bdd->prepare("SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.date_res, b.date_occ, b.date_lib,b.statut_occ, b.statut_res, b.dte_a, b.dte_s FROM t_client AS a, t_reservation AS b WHERE a.id_client=b.id_client
												                                 AND b.type=:type
																				 AND b.id_hotel=:id_hotel ORDER BY b.date_res");
                            $requete_reserv->BindParam(':type', $type);
                            $requete_reserv->BindParam(':id_hotel', $_SESSION['id_hotel']);
                            $requete_reserv->execute();
                            while ($donnees = $requete_reserv->fetch()) {
                                $id_client = $donnees['id_client'];
                                $nom_client = $donnees['nom_client'];
                                $id_res = $donnees['id_res'];
                                $num_reserv = $donnees['num_reserv'];
                                $date_res = $donnees['date_res'];
                                $date_occ = $donnees['date_occ'];
                                $date_lib = $donnees['date_lib'];
                                $statut_res = $donnees['statut_res'];
                                $statut_occ=$donnees['statut_occ'];
                                $dte_a = $donnees['dte_a'];
                                $dte_s = $donnees['dte_s'];

                                $date_res1 = explode(' ', $date_res);
                                $date_res_expl = $date_res1[0];

                                $date_occ1 = explode('-', $date_occ);
                                $date_occ1_Heure = explode(' ', $date_occ1[2]);

                                $date_occ_expl = $date_occ1_Heure[0] . '/' . $date_occ1[1] . '/' . $date_occ1[0] . ' ' . $date_occ1_Heure[1];

                                $date_lib1 = explode('-', $date_lib);
                                $date_lib1_Heure = explode(' ', $date_lib1[2]);

                                $date_lib_expl = $date_lib1_Heure[0] . '/' . $date_lib1[1] . '/' . $date_lib1[0] . ' ' . $date_lib1_Heure[1];

                                $date_res1 = explode('-', $date_res);
                                $date_res1_Heure = explode(' ', $date_res1[2]);

                                $date_res_explode = $date_res1_Heure[0] . '/' . $date_res1[1] . '/' . $date_res1[0] . ' ' . $date_res1_Heure[1];
                                ?>

                                <?php
                                if ($date_res_expl < date('Y-m-d')) {

                                    $_SESSION['date_d'] = date('Y-m-d');
                                    $_SESSION['date_f'] = date('Y-m-d');
                                    ?>
                                    <?php
                                    //Récuperation seulement du date occ 
                                    $date_occ_test1 = explode(' ', $date_occ);
                                    $date_occ_test = $date_occ_test1[0];

                                    if ($statut_res == 'operationnel'||$statut_res == 'execute') {
                                        if ($statut_res == 'operationnel') {
                                            $statut_lib='Validée';
                                            $color='warning';
                                        }
                                        else{
                                            $statut_lib='Exécutée';
                                            $color='success';
                                        }
                                    ?>

                                        <tr>
                                            <td><?php echo $num_reserv; ?></td>
                                            <td><?php echo $nom_client; ?></td>
                                            <td><?php echo $date_res_explode; ?></td>
                                            <td><?php echo $date_occ_expl; ?></td>   
                                            <td><?php echo $date_lib_expl; ?></td>
                                            <td align="center"><span class="label label-<?php echo $color; ?>"><?php echo $statut_lib; ?></span></td>
                                            <td align="center">
                                                <a href="rec_detail_reservation_client.php?num_reserv=<?php echo $num_reserv; ?> && id_res=<?php echo $id_res;?>" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Détails </a>
                                            </td>
                                        </tr>
                                        <?php
                                    } else if ($statut_res == 'annulee') {
                                        ?>

                                        <tr style="color:#dd4f43;">
                                            <td><?php echo $num_reserv; ?></td>
                                            <td><?php echo $nom_client; ?></td>
                                            <td><?php echo $date_res_explode; ?></td>
                                            <td><?php echo $date_occ_expl; ?></td>   
                                            <td><?php echo $date_lib_expl; ?></td>
                                            <td align="center"><span class="label label-danger"><?php echo 'Annulée'; ?></span></td>
                                            <form role="form" method="post" action="Traitement_reservation/annulation_reservation.php">
                                            <td align="center">
                                                <a href="rec_detail_reservation_client.php?num_reserv=<?php echo $num_reserv; ?> && id_res=<?php echo $id_res;?>" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Détails </a>
                                            </td>
                                            </form>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                    <?php
                                    //$i++;
                                }
                                /* Fin de la Recuperation du paiement d'un client */
                                ?>

                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->

            </div>
            <!-- / Div stratégique -->
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
	<script src="../datepicker/jquery.js"></script>
	<script src="../datepicker/jquery.datetimepicker.js"></script>
    <script>
    $('#datetimepicker6').datetimepicker();
	$('#datetimepickerOcc').datetimepicker();
	$('#datetimepickerLib').datetimepicker();
    </script>

     <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
	
    </script>