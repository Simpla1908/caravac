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

$client=$_GET['nom_client'];
$responsable=$_GET['nom_responsable'];
$dte=$_GET['dte'];
$dte_in= $_GET['dte_in'];
$dte_out=$_GET['dte_out'];
$tva=$_GET['tvainclu'];
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
            <div class="to">Client:<?php echo $client; ?></div>
            <h2 class="name"></h2>
            <div class="address"></div>
            <div class="email"><a href="mailto:john@example.com">Responsable:<?php echo $responsable; ?></a></div>
        </div>
        <div class="email">
            <br>
        </div>
        <div id="invoice">
            <div class="date">PROFORMA</div>
            <div class="date">Date d'édition: <?php echo $dte; ?> </div>
            <div class="date">Date d'arrivée: <?php echo $dte_in; ?></div>
            <div class="date">Date de sortie: <?php echo $dte_out; ?> </div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
           <th class="total"><h3>N°</h3></th>
           <th class="unit"><h3>Tarif</h3></th>
           <th class="qty"><h3>Nombre chambre</h3></th>
           <th class="unit"><h3>Nuité</h3></th>
           <th class="total"><h3>Montant</h3></th>
        </tr>
        </thead>
        <tbody>
            <?php
            $nbArticles=count($_GET['chambre']);
            $dte_in=dateToformatBdd($dte_in);
            $dte_out=dateToformatBdd($dte_out);
            $qte = NbJours($dte_in,$dte_out);
            $som = 0;
            $j = 1;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $tarif =montant_equivalent_bdd($_GET['monnaie'][$i],$m_affiche,$tauxdollar,$_GET['tarif'][$i]);
                    $nbre_ch=$_GET['nbre_ch'][$i];
                    $montant =$tarif * $qte*$nbre_ch;
                    ?>
                    <tr>
                        <td class="no"><?php echo $j; ?></td>
                        <td class="unit"> <?php echo afficheMontant($m_affiche,$tarif); ?></td>
                        <td class="qty"> <?php echo $nbre_ch; ?></td>
                        <td class="unit"> <?php echo $qte; ?></td>
                        <td class="total"><?php echo afficheMontant($m_affiche,$montant); ?></td>
                    </tr>
                    <?php 
                    $som += $montant;
                    $$j+=1;
               }
               ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">HT</td>
                <td>
                    <?php 
                        $total=total($som,$tva,0);
                        $mont_ht=  ht($total,$tva,0);
                         echo afficheMontant($m_affiche,$mont_ht);
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">TVA ( <?php echo $tva.' % '?>)</td>
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
