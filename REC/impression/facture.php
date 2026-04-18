<?php
session_start();
//Fusion horaire
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
$company_id = $_SESSION['company_id'];
$id_hotel = $_SESSION['id_hotel'];
//Selection des company
$requete_company = $bdd->prepare("SELECT * FROM t_company As a, t_hotel AS b "
        . "                      WHERE a.id_c=b.company_id AND b.id_hotel=:id_hotel");
$requete_company->BindParam(':id_hotel', $id_hotel);
$requete_company->execute();
while ($donnees = $requete_company->fetch()) {
    $nom_hotel = $donnees['nom_hotel'];
    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $logo = $donnees['logo'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['email_company'];
    $compte_bancaire = $donnees['compte_bancaire'];
    $mention = $donnees['mention'];
}
?>
<?php
if (isset($_GET['id_res'])) {
    $id_res = $_GET['id_res'];
} else {
    $id_res = 0;
}
$statut_res = 'hebergement';
include '../Traitement_reservation/req_facture.php';
$monnaie='';
foreach ($result as $op) {
    $nom_client = $op->nom_client;
    $nom_user = $op->nom_user;
    $nom_respo = $op->nom_respo;
    $num_reserv = $op->num_reserv;
    $taux = $op->taux;
    $tva = $op->tva;
    $monnaie = $op->monnaie;
    $mont_paye =$op->montantusd*$op->taux_paie+$op->montantcdf;
    $remise = $op->remise;
    $tauxremise = $op->mont_ttc_remise;
    $dte = $op->dte;
    $dte_a = $op->dte_a;
    $dte_s = $op->dte_s;
    $mode = $op->lib;
    break;
}

?>
<?php
ob_start();
?>


<header class="clearfix">
    <div id="logo">
        <img src="../images/logo_entreprise/<?php echo $logo; ?>" width="70" height="70">
    </div>
    <div id="company">
        <h2 class="name"><?php echo $nom_hotel; ?></h2>
        <div><?php echo $nom_hotel; ?></div>
        <div>(+243) <?php echo $telephone; ?></div>
        <div><a href="mailto:<?php echo $nom_hotel; ?>"><?php echo $email_compagny; ?></a></div>
    </div>
</div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">Client:<?php echo ' '.strtoupper($nom_client); ?></div>
            <h2 class="name"></h2>
            <div class="address"></div>
            <div class="email"><a href="mailto:john@example.com">Responsable:<?php echo ' '.strtoupper($nom_respo); ?></a></div>
        </div>
        <div class="email">
            <br>
            Mode de Paiement: <font color="red"><?php echo strtoupper($mode); ?><font>
        </div>
        <div id="invoice">
            <div class="date">Hébergement N° <font color="red"><?php echo $num_reserv; ?><font></div>
            <div class="date">Date de réservation: <?php echo dateAffiche($dte); ?> </div>
            <div class="date">Date d'arrivée: <?php echo dateAffiche($dte_a); ?></div>
            <div class="date">Date de sortie: <?php echo dateAffiche($dte_s); ?> </div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
           <th class="total"><h3>N°</h3></th>
           <th class="desc"><h3>Chambre</h3></th>
           <th class="unit"><h3>Tarif</h3></th>
           <th class="qty"><h3>Nombre nuité</h3></th>
           <th class="total"><h3>Sous-total</h3></th>
        </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $qte = NbJours($dte_a,$dte_s);
                $som = 0;
                foreach ($result as $op) {
                    $taux_fact=$op->taux;
                    $tauxdollar= getTauxFacture($op->type_fac,$monnaie,$tauxdollar,$taux_op,$taux_fact);
                    $tarif = $op->tarif_ch;
                    $tarif=montant_equivalent_bdd($monnaie,$m_affiche,$tauxdollar,$tarif);
                    $montant =$tarif * $qte;
                    ?>
                    <tr>
                        <td class="no"><?php echo $i; ?></td>
                        <td class="desc"><h3> <?php echo $op->num_ch; ?></h3></td>
                        <td class="unit"> <?php echo afficheMontant($m_affiche,$tarif); ?></td>
                        <td class="qty"> <?php echo $qte; ?></td>
                        <td class="total"><?php echo afficheMontant($m_affiche,$montant); ?></td>
                    </tr>
                    <?php 
                    $som += $montant;
                    $i+=1;
                    }
               ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">HT</td>
                <td>
                    <?php 
                        $total=total($som,$tva,$tauxremise);
                        $mont_ht=  ht($total,$tva,$tauxremise);
                         echo afficheMontant($m_affiche,$mont_ht);
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">Remise</td>
                <td>
                    <?php
                        $remise=remise($som,$tva,$tauxremise);
                        $montant_rem=montant_equivalent_bdd($monnaie,$m_affiche,$tauxdollar,$remise);
                        echo afficheMontant($m_affiche,$montant_rem);
                     ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">TVA ( <?php echo$tva.' % '?>)</td>
                <td>
                    <?php
                    $montant_tva =tva($total,$tva,$tauxremise);
                    echo afficheMontant($m_affiche,$montant_tva);
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">TTC</td>
                <td>
                    <?php
                        $montant_tot=ttc($mont_ht,$montant_tva,$montant_rem);
                        echo afficheMontant($m_affiche,$montant_tot);
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">Montant Payé</td>
                <td>
                    <?php
                       $mont_paye=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$mont_paye);
                        echo afficheMontant($m_affiche,$mont_paye);
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <div id="thanks">La Réception,</div>
    <div id="notices">
        <!--        <div>NOTICE:</div>-->
        <div class="notice">Créee le <?php echo dateAffiche($dte); ?> par <?php echo ' ' . strtoupper($nom_user); ?> / Imprimée le <?php echo date('d/m/Y H:i'); ?> par <?php echo strtoupper($_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user']); ?>.</div>
    </div>
</main>
<footer>
<?php echo 'Tél.; ' . $telephone . ' -- Email: ' . $email_compagny . ' -- RCCM: ' . $rccm . ' -- Id-Nat: ' . $idnat; ?>.
</footer>
<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
include './blocfature.php';
$stylesheet1 = file_get_contents('style.css'); // external css
$mpdf = new mPDF('c', 'A4');
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet1, 1);
$mpdf->WriteHTML($body);
$mpdf->Output("Facture.pdf", "I");
