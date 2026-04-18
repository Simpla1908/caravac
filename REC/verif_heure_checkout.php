<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
include('headerRec.php');
include('menu_Rec.php');
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
if (!isset($_SESSION)) {
    session_start();
}


/* calcul du nombre du jour */

function NbJours($dte_a, $dte_now) {

    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    return(($diff / 86400) + 1);
}

$tempsdujr = gmstrftime("%H:%M", time() + 3600);
/* Fin calcul du nombre du jour */
?>
<div id="page-wrapper" style="height:800px;" class="v_affiche">
    <br>
    <div class="col-lg-12">
        <h3 class="page-header">Situation clients logés</h3>
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Situation de logement des clients</h4>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Client</th>
                                <th>Chambre</th>
                                <!--<th>Jr rst</th>-->
                                <th>Jr eff</th>
                                <th>Tarif net</th>
                                <th>Mont. payé</th> 
                                <th>Reste</th> 
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $som_tot = 0;
                            $som_paye = 0;
                            $som_reste = 0;
                            /* Recuperation du paiement d'un client */
                            $requete_paie = $bdd->prepare("SELECT a.id_client,a.nom_client,a.id_respo,b.id_res,b.num_reserv,b.remise,b.mont_par_chambre,b.dte_a,b.dte_s,c.id_ch,c.num_ch,c.tarif_ch,d.mont_paye_heb,e.num_fact,e.id_fact, e.montant_total, SUM(f.montant_dollar) AS montantUSD, SUM(f.montant_fc) AS montantFC,b.type, g.id_respo AS respo_id,g.entreprise
                            FROM t_client AS a,t_reservation AS b,t_chambre AS c, t_reserve_chambre AS d,t_facture AS e, t_reglement AS f, t_responsable AS g 
                            WHERE a.id_client=d.id_client
                            AND b.id_res=d.idreserv AND c.id_ch=d.idchambre
                            AND b.id_res=e.id_res
                            AND e.id_fact=f.id_fact 
                            AND a.id_respo=g.id_respo 
                            AND d.statut='occupe' 
                            AND d.est_responsable='oui'
                            AND b.id_hotel=:id_hotel
                            GROUP BY a.id_client");
                            $requete_paie->BindParam(':id_hotel', $_SESSION['id_hotel']);
                            $requete_paie->execute();
                            while ($donnees = $requete_paie->fetch()) {
                                ?>
                                <?php
                                $monnaie = 1;
                                $montantUSD = $donnees['montantUSD'];
                                $montantFC = $donnees['montantFC'];
                                $montant_tot = $donnees['montant_total'];
                                $num_fact = $donnees['num_fact'];
                                $id_fact = $donnees['id_fact'];
                                $id_client = $donnees['id_client'];
                                $nom_client = $donnees['nom_client'];
                                $id_respo = $donnees['id_respo'];
                                $respo_id=$donnees['respo_id'];
                                $id_res = $donnees['id_res'];
                                $num_reserv = $donnees['num_reserv'];
                                $mont_paye_heb=$donnees['mont_paye_heb'];
                                $type = $donnees['type'];
                                $id_ch = $donnees['id_ch'];
                                $num_ch = $donnees['num_ch'];
                                $tarif_ch = $donnees['tarif_ch'];
                                $entreprise = $donnees['entreprise'];
                                $remise_heb=$donnees['remise'];
                                $mont_par_chambre=$donnees['mont_par_chambre'];
                                $dte_a = $donnees['dte_a'];
                                $dte_s = $donnees['dte_s'];
                                date_default_timezone_set('Europe/Paris');
                                $dte=  date('H:i:s');
                                $temps_actuel = $dte;
                                if($temps_actuel >=$temps_sortie){
                                    $dte_now = date('Y-m-d',time()+86400);
                                }  else {
                                     $dte_now = date('Y-m-d');
                                }
                               
                                /* Nombre de jour effectué */
                                $Nombres_jours = NbJours($dte_a, $dte_now);
                                $nb_jrs = $Nombres_jours;
                                $nb_jr = $nb_jrs - 1;
                                if ($nb_jr == 0) {
                                    $nb_jr++;
                                }
//                                include './Amelioration/reglage/recuperer_valeurs_reglages.php';
                                 $nbre_jr = $nb_jr;
                                
                                /* Fin Nombre de jour effectué*/
                                
                                /* Nombre de jour restant */
                                $Nbj_rst = NbJours($dte_now, $dte_s);
                                $nb_jrs_rst = $Nbj_rst;
                                $nb_jr_rst = $nb_jrs_rst - 1;
                                if ($nb_jr_rst == 0) {
                                    $nb_jr_rst++;
                                }
                                $nbre_jr_rst = $nb_jr_rst;
                                /* Fin Nombre de jour restant*/

                                $requete_resto = $bdd->prepare("SELECT SUM(mont_ttc_remise) AS montant_resto
                                FROM t_reservation AS b, t_facture AS c
                                WHERE b.id_res=c.id_res
                                AND b.id_hotel=:id_hotel 
                                AND b.type='commande' 
                                AND b.etat_credit='credit'
                                AND b.id_client=:client_id ");
                                $requete_resto->BindParam(':id_hotel', $_SESSION['id_hotel']);
                                $requete_resto->BindParam(':client_id', $id_client);
                                $requete_resto->execute();
                                $restaurant= $requete_resto->fetchAll(PDO::FETCH_OBJ);
                                foreach ($restaurant as $resto) {
                                    $montant_resto = $resto->montant_resto;
                                }
                                $montant_resto_usd=$montant_resto/$tauxdollar;
                                $montant_paye=  $mont_paye_heb;
                                ?>
                                <?php
                                $tarif_net =$tarif_ch * $nbre_jr;
                                $montant_a_paye=$tarif_net-($tarif_net*$remise_heb)/100;
                                $reste = $montant_a_paye - $montant_paye;
                                    ?>
                                    <tr v="<?php echo $id_client; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $nom_client; ?></td>
                                        <td><?php echo'CH' . $num_ch.'('.$tarif_ch . '$)'; ?></td>
<!--                                        <td>
                                            <?php 
//                                                if ($nbre_jr_rst < 0) {
//                                                    echo $nbre_jr;
//                                                }  else {
//                                                    echo $nbre_jr_rst;
//                                                }
//                                            echo $nbre_jr_rst;
                                            ?>
                                        </td>-->
                                        <td><?php echo $nbre_jr ; ?></td>   
                                        <td><?php echo $tarif_net . '$'; ?></td>
                                        <td><?php echo $montant_paye . '$'; ?></td>
                                        <td>
                                            <?php 
                                            if ($reste < 0) {
                                                echo '<span style="color: red">Remboursable</span>('.abs($reste) .'$)'; 
                                            }else if($reste > 0) {
                                                echo '<span style="color: blue">Redevable</span>('.abs($reste) .'$)';
                                            }else{
                                                echo 'Aucun';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if ($entreprise==$nom_client) {
                                                    echo 'Privé';
                                                }  else {
                                                    echo $entreprise; 
                                                }
                                            ?>
                                        </td>
                                    </tr>


    <?php
    $som_tot+=$tarif_net;
    $som_paye+=$montant_paye;
    $som_reste+=$reste;
    $i++;
}
/* Fin de la Recuperation du paiement d'un client */
?>
                        </tbody>
                        </tfoot>
                        <tr style="color:#ff1b2d;">
                            <td colspan="5"></td>
                            <td><?php echo $som_tot . '$'; ?></td>
                            <td><?php echo $som_paye . '$'; ?></td> 
                            <td colspan="4"></td>           
                        </tr>
                        </tfoot>
                    </table>
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
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
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
    $(document).ready(function () {
        var  verification='non';
        function maBoucle(){
            setTimeout(function(){
                $.ajax({
                        url: './verif_heure_checkout_get.php',
                        type: 'POST',
                        success: function (json) {
                           verification=json.verif;
                        }, dataType: 'json'
                });
                if(verification=='oui'){
                    $.ajax({
                        url: './verif_heure_checkout.php',
                        type: 'POST',
                        success: function (data) {
                            location.href='./verif_heure_checkout.php';
                        }
                    });
               }
                maBoucle(); // relance la fonction
            },1000);
        }
        maBoucle();
        $('#dataTables-example').dataTable();
        // Clique sur une ligne tableau FAMILLE
        $('#dataTables-example tr ').click(function (e) {
            var client_id = $(this).attr("v");
            location.href = "classeur.php?client_id=" + client_id;
        });
    });

</script>
<!--<script src="vendors/jquery/dist/jquery.min.js"></script>-->
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Select2 -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>