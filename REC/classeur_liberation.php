<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
$id_hotel=$_SESSION['id_hotel'];
include('../bdd/connexion.php'); ?>
<?php //include('Receptionniste.php'); ?>
<?php //include('headerRec.php'); ?>
<?php //include('menu_Rec.php'); ?>
<?php include('../FUNCTION/checkdates.php'); ?>
<?php include('../FUNCTION/hebergement.php'); ?>
<?php include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; ?>
<?php
if (isset($_GET['idres_ch'])) {
    $id = $_GET['idres_ch'];
    $statut_res = 'hebergement';
} else {
    $id = 152;
    $statut_res = 'hebergement';
}
$mont_paye=0;
$type_client='';
$tempsdujr =date('H:i:s');
$requete = $bdd->prepare("
    SELECT a.id_res,a.type,a.num_reserv,a.garantie,b.id_fact,b.num_fact,b.type AS type_fac,b.date_edition,
        b.taux,b.tva,b.monnaie AS monnaie_fact,b.id_user,k.statut,k.tarif_ch,k.monnaie,k.date_occ,k.date_lib,g.num_ch,h.id_client,h.nom_client,j.nom_respo
  FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,
       t_chambre AS g,t_client AS h,t_responsable AS j,t_chambre_histo AS k
  WHERE a.id_res=b.id_res AND b.id_fact=c.idfact 
	AND c.id=k.idres_ch
        AND k.idchambre=g.id_ch
        AND b.id_client=h.id_client
        AND h.id_respo=j.id_respo
	AND c.id=:id
        AND a.statut_res=:statut_res
");
$requete->BindParam(':id', $id);
$requete->BindParam(':statut_res', $statut_res);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $op) {
    $id_res = $op->id_res;
    $id_fact = $op->id_fact;
    $nom_client = $op->nom_client;
    $nom_respo = $op->nom_respo;
    $num_reserv = $op->num_reserv ;
    $num_fact = $op->num_fact ;
    $taux = $op->taux;
    $tva = $op->tva;
    $monnaie= $op->monnaie;
    $monnaie_fact= $op->monnaie_fact;
    $mont_paye = $op->garantie;
    $dte= $op->date_edition;
    break;
}
if($nom_respo=='prive'){
    $type_client='occasionnel';
}  else {
    $type_client='partenaire';
}
$mont_paye=round(montant_equivalent_bdd($m_affiche,$monnaie_fact,$tauxdollar,$mont_paye),2)
?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            <?php echo 'Détails' ?>
        </h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Numéro facture: <?php echo ' '.$num_fact.' '.$mont_paye?></h4>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <BR>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">

                        <address>
                            Client: <strong><?php echo ucfirst($nom_client); ?></strong><br>
                            Responsable:
                            <?php echo ucfirst($nom_respo); ?>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <address>

                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <span class="">Date: <?php echo dateAffiche($dte); ?> </span><br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row" id="panier">
                    <div class="col-xs-12 table-responsive">
                        <br><br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Chambre</th>
                                <th>Tarif</th>
                                <th>Période</th>
                                <th>Nombre nuité</th>
                                <th>Montant</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $som = 0;
                            $temps_actuel =date('H:i:s');
                            foreach ($result as $d){
                                $date_occ=$d->date_occ;
                                $today= date('Y-m-d');
                                if ($d->statut=='change') {
                                    $date_lib=$d->date_lib;
                                } else {
                                    if ($temps_actuel > $temps_sortie && $today > $date_occ) {
                                        $date_lib = date('Y-m-d',time()+86400);
                                    } else {
                                        $date_lib =$today;
                                    }
                                }
                                if ($d->monnaie == $m_affiche) {
                                    $tarif_ch = $d->tarif_ch;
                                } else {
                                    if ($d->monnaie = 'USD' && $m_affiche == 'CDF') {
                                        $tarif_ch = round($d->tarif_ch * $tauxdollar, 2);
                                    } else {
                                        $tarif_ch = round($d->tarif_ch * 1 / $tauxdollar, 2);
                                    }
                                }
                                $nbre_jr=NbJours($date_occ,$date_lib);
                                $montant=$tarif_ch * $nbre_jr;
                                ?>
                                <tr>
                                    <td><?php echo 'Ch ' . $d->num_ch ?></td>
                                    <td><?php echo afficheMontant($m_affiche,$tarif_ch) ?></td>
                                    <td><?php echo'du '.  dateAffiche($date_occ).' au '.dateAffiche($date_lib) ?></td>
                                    <td><?php echo $nbre_jr; ?></td>
                                    <td><?php echo  afficheMontant($m_affiche,$montant) ?></td>
                                </tr>
                                <?php
                                $i++;
                                $som += $montant;
                            };
                            ?>
                            </tbody>
                            <tfoot style="border:none">
                            <tr>
                                <th colspan="4"><span class="pull-right">HT</span></th>
                                <td>
                                    <?php
                                    echo afficheMontant($m_affiche,$som);
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th colspan="4"><span class="pull-right">T.V.A (<?php echo $tva ?>%)</span></th>
                                <td>
                                    <?php
                                    $montant_rem =  montant_remise($som, 0);
                                    $montant_tva=montant_tva($som,$montant_rem,$tva);
                                    echo afficheMontant($m_affiche,$montant_tva);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4"><span class="pull-right">TTC</span></th>
                                <td>
                                    <?php
                                    $montant_tot =montant_ttc($som,$montant_tva,$montant_rem);
                                    $reste=$mont_paye-$montant_tot;
                                    if($reste < 0){
                                        $etat_fact='payer';
                                    }else if($reste >=0){
                                        $etat_fact='liberer';
                                    }
                                    echo afficheMontant($m_affiche,$montant_tot);
                                    ?>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.col -->
                </div>

                <button name="sauvegarder" id="btnclose"
                        class="btn btn-primary pull-right"><i class=" fa fa-save"></i>&nbsp;&nbsp;Fermer
                </button>

            </div>

        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

