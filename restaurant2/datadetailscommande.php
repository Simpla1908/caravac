<?php
if (!isset($_SESSION)) {
    session_start();
 }
include_once './bdd/connexion.php';
include_once '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../FUNCTION/hebergement.php';
$id_fact=0;
if(isset($_GET['id'])){
    $id_fact=$_GET['id'];
}
$_SESSION['id_fact']=$id_fact;
$monnaie_local=getsymbole_local();
$entete= enteteFacture($id_fact,$bdd);
$taux_op= getTauxFacture($entete->type,$entete->monnaie,$tauxdollar,$taux_op,$entete->taux);
$lignes=ligneFactureResto($id_fact,$bdd);
$total_paye=montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,totalMontantPayeFacture($id_fact,$bdd));
$ttc=montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,$entete->mont_ttc);
$mont_tva=montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,$entete->mont_tva);
$mont_remise=montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,$entete->mont_remise);
$val_tva=$entete->tva;
$val_remise=$entete->tauxremise;
$tbl = $entete->tbl;
$cl = $entete->nom_client;
$typ = $entete->typecl;
if ($typ == 'client') {
    $cl_tbl = $cl;
} else if ($typ == 'table') {
    $cl_tbl = $tbl;
} else {
    $cl_tbl = 'Client occasionnel';
}

if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
    $resto_id = $entete->id_sousresto;

    $sousresto=getNameSresto($resto_id,$bdd);
    foreach ($sousresto as $sr) {
        $resto_name = $sr->libelle;
        $_SESSION['libelle_resto']=$resto_name;
    }
}
?>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Client
            <address>
                <strong><?php echo $cl_tbl  ?></strong>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
            Resto : <strong class='text-danger'><?php echo $resto_name  ?></strong><br>
            <?php } ?>
            Vendeur
            <address>
                <strong><?php echo $entete->nom_user  ?></strong>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>N° Facture:<?php echo $entete->num_fact  ?></b><br>
            <b>Mode:<?php echo $entete->mode  ?></b><br>
            <b>Date:</b> <?php echo dateAffiche($entete->date_edition);  ?><br>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Désignation</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $total_fact=0;
                            foreach ($lignes as $r){
                               $tauxdollar1= getTauxPrixFact($r->monnaie,$tauxdollar,$r->taux_prix);
                               $prix= montant_equivalent_bdd($monnaie_local,$m_affiche,$tauxdollar1,$r->prix);
                               $qte=$r->qte;
                               $montant=$prix*$qte;
                               $designation=$r->designation;
                         ?>
                        <tr>
                            <td><?php echo $i  ?></td>
                            <td><?php echo $designation  ?></td>
                            <td><?php echo $qte  ?></td>
                            <td><?php echo  afficheMontant($m_affiche,$prix) ?></td>
                            <td><?php echo afficheMontant($m_affiche,$montant)?></td>
                        </tr>
                        <?php
                            $i++;
                            $total_fact+=$montant;
                        }
                        $total1=$total_fact;
                        $total=total($total1,$val_tva,$val_remise);
                        $mont_tva=tva($total,$val_tva,$val_remise);
                        $mont_remise=remise($total1,$val_tva,$val_remise);
                        $mont_ht=  ht($total, $tva,$val_remise);
                        $ttc=  ttc($mont_ht, $mont_tva,$mont_remise);
                       ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <div class="table-responsive">
                <table class="table">
                    <tbody><tr>
                            <th style="width:50%">HT</th>
                            <td><?php echo afficheMontant($m_affiche,$mont_ht)?></td>
                        </tr>
                        <tr>
                            <th>TVA (<?php echo arrondir($val_tva) ?>%)</th>
                            <td><?php echo afficheMontant($m_affiche,$mont_tva)?></td>
                        </tr>
                        <tr>
                            <th>Remise (<?php echo arrondir($val_remise) ?>%)</th>
                            <td><?php echo afficheMontant($m_affiche,$mont_remise)?></td>
                        </tr>
                        <tr>
                            <th>TTC</th>
                            <td><?php echo afficheMontant($m_affiche,$ttc)?></td>
                        </tr>
                        <tr>
                            <th>Montant payé</th>
                            <td><?php echo afficheMontant($m_affiche,$total_paye)?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">

        </div>
    </div>


