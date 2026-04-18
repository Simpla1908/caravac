<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Gerant_local.php');
?>
<?php include('./headerRec_popup.php'); ?>
<?php
include('menu_Rec.php');

/* calcul du nombre du jour */

function NbJours($dte_a, $dte_now) {

    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    return(($diff / 86400) + 1);
}

/* Fin calcul du nombre du jour */
?>

<div id="page-wrapper" >
    <div class="col-lg-12">
        <h3 class="page-header">Libération</h3>
        <div class="panel panel-default">
            <!--Menu tabulation-->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="dropdown active"> <a  href="liste_liberation_encours.php"> Libération en cours <b class="caret"></b></a></li>
                <li class="dropdown "> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Libération  périodique <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li style="padding:10px;">
                            <form action="liste_liberation_periodique.php" method="post" name="periode">
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
                <li class="dropdown"> <a  href="liste_liberation_historique.php">Libération  historique <b class="caret"></b></a></li>
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
                <h4>Liste des libérations du jour (le <?php echo date('d/m/Y'); ?>)</h4>
                <?php if (in_array('ILL',$_SESSION['actions']['code_actions'])){?>
                <div style="margin-top:-41px; margin-left:860px;"><a class="btn btn-default btn-lg btn-block" href="../html2pdf/examples/imprime_liste_reservation.php?reservation=encours" target="_blank" style="width:120px;"><img src="../img/print.png">&nbsp;Imprimer</a></div>
                <?php }?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                        <thead>
                            <tr>
                            <tr>
                                <th>N°</th>
                                <th>Client</th>
                                <th>Chambre </th>
                                <th>Date </th> 
                                <th>Nbr jr </th> 
                            </tr>
                            </tr>
                        </thead>
                        <tbody id="liberation">
                            <?php
                            $i = 1;


                            /* Recuperation du paiement d'un client */
                            $requete_lib = $bdd->prepare("SELECT r.id_res,c.id_client,c.nom_client,ch.id_ch,ch.num_ch,l.id_lib,l.date_lib,l.dte_lib,r.dte_a
                                                                                 FROM t_liberation AS l,t_client AS c, t_chambre AS ch,t_reservation AS r
																				 WHERE l.id_client=c.id_client
																				 AND l.id_ch=ch.id_ch
																				 AND l.id_res=r.id_res
																				 AND l.id_hotel=:id_hotel 
																				 ORDER BY l.dte_lib ");
                            $requete_lib->BindParam(':id_hotel', $_SESSION['id_hotel']);
                            $requete_lib->execute();
                            while ($donnees = $requete_lib->fetch()) {
                                $id_lib = $donnees['id_lib'];
                                $id_client = $donnees['id_client'];
                                $nom_client = $donnees['nom_client'];
                                $id_ch = $donnees['id_ch'];
                                $num_ch = $donnees['num_ch'];
                                $date_lib = $donnees['date_lib'];
                                $dte_lib = $donnees['dte_lib'];
                                $dte_a = $donnees['dte_a'];
                                $id_res = $donnees['id_res'];

                                /* Nombre de jour */
                                $Nombres_jours = NbJours($dte_a, $dte_lib);
                                $nb_jrs = $Nombres_jours;
                                $nb_jr = $nb_jrs - 1;
                                if ($nb_jr == 0) {
                                    $nb_jr++;
                                }
                                $nbre_jr = $nb_jr;
                                /* Fin Nombre de jour */

                                $date_lib1 = explode('-', $date_lib);
                                $date_lib1_Heure = explode(' ', $date_lib1[2]);

                                $date_lib_expl = $date_lib1_Heure[0] . '/' . $date_lib1[1] . '/' . $date_lib1[0] . ' ' . $date_lib1_Heure[1];
                                ?>

                                <?php
                                if ($dte_lib == date('Y-m-d')) {
                                    ?>
                                    <?php
                                    ?>
                            <tr valign="middle" id="<?php echo $id_client; ?>" id2="<?php echo $id_res; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $nom_client; ?></td>
                                        <td><?php echo 'Ch' . $num_ch; ?></td>
                                        <td><?php echo $date_lib_expl; ?></td>
                                        <td><?php echo $nbre_jr; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                /* Fin de la Recuperation du paiement d'un client */
                                ?>

                                <?php
                            }
                            ?>
                        </tbody>
                    </table> 
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
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

<!--            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Détails de l'ancien client</h4>
            </div>-->
            <div id='historique_lib'>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
<!--                                    <button  name="sauvegarder" id="completer_paiement" type="submit" class="btn btn-danger"><i class=" fa fa-save"></i> Sauvegarder</button>
                <div id="imprimer_fact" style="display:none;" ><a class="btn btn-success" href="../html2pdf/examples/recu_completer_paiement.php" target="_blank"><img src="../img/print.png">&nbsp;Imprimer la facture</a></div>-->
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->
</div>
<!-- /#wrapper -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
</script>
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

        // Clique sur une ligne tableau liberation
        $("#dataTables-example").on('click', '#liberation tr', function (e) {
//        var numcom = $(this).find('td').eq(1).html();
//        $('#tab_com').load('./Traitement/apercu_commande.php?numcom=' + numcom);
            var idclient= $(this).attr("id");
            var id_res= $(this).attr("id2");
             $.ajax({
            url: 'classeur_liberation.php?idclient=' + idclient+'&id_res='+id_res,
            type: 'POST',
            success: function (html) {
                $("#historique_lib").html(html);
                $("#myModal").modal('show');
            }
        });
            
        });

    });
</script>

</body>

</html>
