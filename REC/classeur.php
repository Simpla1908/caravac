<?php include('../bdd/connexion.php'); ?>
<?php include('Receptionniste.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php include('../FUNCTION/checkdates.php'); ?>
<?php include('../FUNCTION/hebergement.php'); ?>
<?php include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; ?>
<?php include('modal_confirm_annul_occup.php'); ?>
<?php
if (isset($_GET['idres_ch'])) {
    $id = $_GET['idres_ch'];
    $statut_res = 'hebergement';
} else {
    $id =0;
    $statut_res = 'hebergement';
}
$etat_fact = '';
$mont_paye = 0;
$mont_paye_tot=0;
$type_client = '';
$montant_remise=0;
$result=getInfosFactureOne($id,$bdd);
foreach ($result as $op) {
    $id_res = $op->id_res;
    $id_fact = $op->id_fact;
    $nom_client = $op->nom_client;
    $nom_respo = $op->nom_respo;
    $num_reserv = $op->num_reserv;
    $taux = $op->taux;
    $tva = $op->tva;
    $valRemiseEnPourcentage = $op->mont_ttc_remise;
    $monnaie = $op->monnaie;
    $monnaie_fact = $op->monnaie;
    $montant_remise = $op->mont_remise;
    $dte = $op->date_edition;
    break;
}
$_SESSION["taux_heb"]=$taux;
$_SESSION["monnaie_heb"]=$monnaie_fact;
if ($nom_respo == 'prive'|| $nom_respo == 'Prive') {
    $type_client = 'occasionnel';
} else {
    $type_client = 'partenaire';
}

$_SESSION['service']=MontantServiceone($id_res,$id,$tauxdollar,$taux_op,$m_affiche,$bdd);
$nbre_heb = count($_SESSION['service']['libelle']);
for ($i = 0; $i <= $nbre_heb - 1; $i++) {
    $mont_paye+=$_SESSION['service']['montant_pay'][$i];
  
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Situation clients logés</h3>
            <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="msg_alert">L'enrégistrement s'est effectué avec succès!</span>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-list fa-fw"></i> Détails
					<span class="pull-right hidden">Heure: <strong><?php echo date('H:i:s'); ?> </strong></span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <BR>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
								 N° Facture: <strong><?php echo ucfirst($num_reserv); ?></strong><br>
                                Client: <strong><?php echo ucfirst($nom_client); ?></strong><br>
                                Responsable:
                                <?php echo ucfirst($nom_respo); ?>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>

                        </div>
                            </address
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <span class="">Date: <?php echo dateAffiche($dte); ?> </span><br>
                        </div>                    <!-- Table row -->

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row" id="panier">
                        <div class="col-xs-12 table-responsive">
                            <br><br>
                            <form role="form" method="post" action="" id="form_occup_annul">
                                <input name="idrestbl" type="hidden" value="<?php echo $id; ?>" id="idrestbl"/>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Chambre</th>
                                            <th>Tarif</th>
                                            <th>Période</th>
                                            <th>Nuité</th>
                                            <th>Montant</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $som = 0;
                                        $temps_actuel = date('H:i:s');
                                        foreach ($result as $d) {
                                            $id_histo=$d->id_histo;
                                            $date_occ = $d->date_occ_histo;
                                            $today = date('Y-m-d');
                                            $statut=$d->statut_histo;
                                            if ($statut == 'change') {
                                                $date_lib = $d->date_lib_histo;
                                            } else {
                                                if ($temps_actuel > $temps_sortie && $today > $date_occ) {
                                                    $date_lib = date('Y-m-d', time() + 86400);
                                                } else {
                                                    $date_lib = $today;
                                                }
                                            }
                                            $tarif_ch = $d->tarif_histo;
                                            $tarif_chaf = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $tarif_ch);
                                            $nbre_jr = NbJours($date_occ, $date_lib);
                                            $montant = montant_equivalent_bdd(getsymbole_local(),$m_affiche, $tauxdollar, $tarif_ch * $nbre_jr);
                                            $dte_out = $date_lib;
                                            ?>
                                            <tr>
                                                <td><?php echo $d->num_ch ?></td>
                                                <td><?php echo afficheMontant($m_affiche, $tarif_chaf) ?></td>
                                                <td><?php echo dateAffiche($date_occ) . '-' . dateAffiche($date_lib) ?></td>
                                                <td><?php echo $nbre_jr; ?></td>
                                                <td><?php echo afficheMontant($m_affiche, $montant) ?></td>
                                                <td>
                                                    <?php
                                                    if ($statut== 'change') {
                                                        ?>
                                                        <input name="occup_annul[]" type="checkbox" value="<?php echo $id_histo; ?>" id="<?php echo $id_histo ?>" class="checkbox_occup_annul"/>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                            $som += $tarif_ch*$nbre_jr;
                                        };
                                        ?>
                                    </tbody>
                                    <tfoot style="border:none">
                                        <tr>
                                            <th colspan="4"><span class="pull-right">HT</span></th>
                                            <td>
                                                <?php
                                                $montant_rem =$montant_remise;
                                                $total=$som-$montant_remise;
                                                $mont_ht=  ht($total,$tva,$valRemiseEnPourcentage);
                                                echo afficheMontant($m_affiche,montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$mont_ht));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4"><span class="pull-right">Remise <?php // echo $temps_actuel ?></span></th>
                                            <td>
                                                <?php
                                                echo afficheMontant($m_affiche,montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$montant_rem));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4"><span class="pull-right">T.V.A (<?php echo $tva ?>%)</span></th>
                                            <td>
                                                <?php
                                                $montant_tva =tva($total,$tva,$valRemiseEnPourcentage);
                                                
                                                echo afficheMontant($m_affiche,montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar, $montant_tva));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4"><span class="pull-right">TTC</span></th>
                                            <td>
                                                <?php
                                                $montant_tot = ttc($mont_ht, $montant_tva, $montant_rem);
                                                $montant_heberge=$montant_tot;
                                                echo afficheMontant($m_affiche,montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$montant_tot));
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $prestation_client = getPrestationClient($id_res,$bdd);
                                        $result = getMontantPrestation($id_res, $bdd);
                                        $montant_autre = 0;
                                        foreach ($prestation_client as $pc) {
                                         $type =$pc->type;
                                         $montant_total=0;
                                        foreach ($result as $r) {
                                           if($id== $r->res_ch_id){
                                                $tauxdollar= getTauxFacture($r->type,$r->monnaie,$tauxdollar,$taux_op,$r->taux);
                                                if($type!='hebergement'){
                                                    $montant_total +=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$r->mont_ttc);
                                                    $idres_ch=$r->res_ch_id;
                                                }
                                            }
                                        }
                                        ?>
                                        <?php if ($type != 'hebergement'){ ?>
                                                 <tr>
                                                   <th colspan="4"><span class="pull-right"><?php echo strtoupper($type) ?></span></th>
                                                    <td>
                                                        <?php
                                                        echo afficheMontant($m_affiche,$montant_total);
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php } $montant_autre+=$montant_total;}?>
                                         <tr>
                                            <th colspan="4"><span class="pull-right">TOTAUX</span></th>
                                            <td>
                                                <?php
                                                 $montant_total_af=$montant_heberge+$montant_autre;
                                                   
                                                   echo afficheMontant($m_affiche,montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$montant_total_af));
                                                ?>
                                            </td>
                                         </tr>
                                         <tr>
                                            <th colspan="4"><span class="pull-right">MONTANT PAYE</span></th>
                                            <td>
                                                <?php
                                                $tarif=getTarifChambre($bdd,$id);
                                                $mont_paie=getTotalMontPayeSejour($bdd,$id_res);
                                                $total_nuite=  getTotalNuite($bdd, $id_res);
                                                $nbre_ch=  getNbrChambre($id_res, $bdd);
                                                $montant_paid_ch=getMontantPaye_ch($tarif,$mont_paie, $total_nuite, $nbre_ch);
                                                $montant_paye_af=$montant_paid_ch+$mont_paye;
                                                $reste = arrondir($montant_total_af)-arrondir($montant_paye_af) ;
                                                if ($reste > 0) {
                                                    $etat_fact = 'payer';
                                                    if($type_client=='partenaire'){
                                                       $etat_fact = 'credit'; 
                                                    }
                                                }else{
                                                    $etat_fact = 'liberer';
                                                }
                                                echo afficheMontant($m_affiche,montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$montant_paye_af));
                                                ?>
                                            </td>
                                         </tr>
                                    </tfoot>
                                </table>
                            </form>
                            <input type="hidden" id="dte1" name="dte" value="<?php echo $dte_out; ?>">
                            <input type="hidden" name="monnaie_fact" id="monnaie_fact1"
                                   value="<?php echo $monnaie_fact ?>">
                            <input type="hidden" name="idres_ch" id="idres_ch1" value="<?php echo $id ?>">
                            <input type="hidden" name="type_client" id="type_client1"
                                   value="<?php echo $type_client ?>">
                            <input type="hidden" name="etat_fact" id="etat_fact1" value="<?php echo $etat_fact ?>">
                            <input type="hidden" name="id_res" id="id_res1" value="<?php echo $id_res ?>">
                            <input type="hidden" name="id_fact" id="id_fact1" value="<?php echo $id_fact ?>">
                            <input type="hidden" name="montant_fact" id="montant_fact1"
                                   value="<?php echo abs($reste) ?>">
                            <!--Besoin de la cause-->
                            <input type="hidden" name="montant_tot" id="montant_tot1"
                                   value="<?php echo $montant_tot; ?>">
                            <!--Fin Besoin de la cause-->
                        </div>
                        <!-- /.col -->
                    </div>
                    <p class="pull-right">
                        <button name="sauvegarder" id="btnpayer1111"
                                class="btn btn-primary hidden"><i class=" fa fa-save"></i>&nbsp;&nbsp;Libérer
                        </button>
                        <?php if ($etat_fact == 'liberer' || $etat_fact == 'credit') { ?>
                            <a href="#" data-toggle="modal" data-target="#myModal0" class="btn btn-primary">Libérer</a>
                        <?php } else { ?>
                            <a href="paiement_cash.php?id_res=<?php echo $id_res; ?>" class="btn btn-primary"><i class=" fa fa-money"></i> Payer</a>
                        <?php } ?>
                            <a href="impression/factureone.php?id_res=<?php echo $id_res; ?>&id=<?php echo $id; ?>" class="btn btn-success" target="_blank"><i class=" fa fa-print"></i> Facture</a>
                        <button name="btn_occup_annul" id="btn_occup_annul" class="btn btn-primary btn btn-danger confirmModalLink2" data-toggle="modal" data-target="#myModal"><i class=" fa fa-times"></i> Annuler</button>
                    </p>
                        
                </div>
                
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
<div class="modal fade" id="myModal0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Notification
            </div>
            <div class="modal-body">
                <form action="../paiement/paiement.php" method="post">
                    <h4> Voulez - vous vraiment libérer cette personne?</h4>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary" id="btnpayer">Confirmer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.modal -->
<?php include '../paiement/modal_paiement.php'; ?>
<!--<script src="../Authentification/jquery-1.9.1.min.js"></script>
<script src="../Authentification/insertion_ajax.js"></script>-->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#dte1').datetimepicker(
            {
                format: "d/m/Y"
            });
    $('#dte').datetimepicker(
            {
                format: "d/m/Y"
            });
    $('#dtereglement').datetimepicker(
            {
                format: "d/m/Y"
            });

</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

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
        $('#dataTables-example').dataTable();
    });

</script>

<script type="text/javascript">
    $("#mode").change(onSelectChange);
    function onSelectChange() {
        var selected = $("#mode option:selected").text();
        $("#libele_mode").val(selected);
        if (selected == 'Credit') {
            $("#div_montant").hide();
            $("#lb_justif").hide();
            $("#montant").val(0);
        } else if (selected == 'Cash') {
            $("#lb_justif").hide();
            $("#div_montant").show();
        } else if (selected == 'Don') {
            $("#div_montant").hide();
            $("#lb_justif").show();
            $("#montant").val($("#montant_tot").val());
        }
    }
    $("#dollar").on('click', function () {
        $('input[name="dollard"]:checked').val();
        /*$("#montantusd").show();*/
        alert($('input[name="dollard"]:checked').val());
    });
    $("#confirmModalNo").click(function (e) {
        $("#myModal").modal("hide");
    });
    $("#confirmModalYes").click(function (e) {
        // alert('aggdsghh');
        e.preventDefault();
        var bool = false;
        var idrestbl = $("#idrestbl").val();
        var donnees = $('#form_occup_annul').serialize();
        //alert(donnees);
        $.ajax({
            url: './Traitement_reservation/annulation_changement.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#confirmModalYes").addClass('hidden');
            },
            success: function (data) {
                // alert(data.message);
                if (data.message == 'succes') {
                    location.href = 'classeur.php?idres_ch=' + idrestbl;
                }
                else if (data.message == 'vide') {
                    $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert').text('Veuillez cocher au moins une ligne!')
                }
                $("#myModal").modal("hide");
                bool = true;
            }, complete: function () {
                if (bool) {
                    $("#loader").addClass('hidden');
                    $("#confirmModalYes").removeClass('hidden');
                } else {
                    $("#loader").removeClass('hidden');
                }
            }, dataType: 'json'
        });


    });
</script>
<!-- Paiement-->
<script src="../js/paiement.js"></script>
