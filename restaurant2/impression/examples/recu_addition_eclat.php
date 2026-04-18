<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
ini_set('memory_limit', '1024M');
if (!isset($_SESSION)) {
    session_start();
}
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
$m_affiche = $_SESSION['m_affiche'];
if ($m_affiche == 'USD') {
    $m_affiche1 = 'CDF';
} else {
    $m_affiche1 = 'USD';
}
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
    $nom_c = $donnees['nom_hotel'];
    $adresse_c = $donnees['adresse_hotel'];
    $ville = $donnees['ville_hotel'];
    $logo = $donnees['image'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['mail'];
    $compte_bancaire = $donnees['cb'];
}
/* Fin de la Recuperation des coordonnées de l'hotel */
$boncommande_id = $_GET['boncommande_id'];
ReimprimerPOS($boncommande_id, $bdd);
// var_dump($_SESSION['panier']);
// var_dump($_SESSION['eclat']);
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <table style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($nom_c)  ?>
                            <br>
                            <b>(<?php echo strtoupper($_SESSION['libelle_resto']) ?>)</b><br>
                            <?php
                            if ($rccm != '') {
                                echo 'RCCM:' . $rccm . '<br>';
                            }
                            ?>
                            <?php
                            if ($idnat != '') {
                                echo 'IDNAT:' . $idnat . '<br>';
                            }
                            ?>
                            <?php echo strtoupper($adresse_c)  ?>
                            <br>
                            <?php echo strtoupper($telephone)  ?>
                            <br>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b> ADDITION N°<?php echo $_SESSION['num_commande'];  ?>
                            <br>
                            <?php echo dateAfficheForHr($_SESSION['date_edition2']);  ?>
                            <br>
                            Mode:<?php echo $_SESSION['mode_fact'];  ?>
                            <br>
                            Client:<?php echo $_SESSION['nom_client'];  ?>
                            <br>
                            Serveur:<?php echo $_SESSION['nomserveur'];  ?>
                            <br>
                            Caissier:<?php echo $_SESSION['nom_user'];  ?>
                            <br>
                            Nombre de couverts:<?php echo $_SESSION['nbrcouvert'];  ?></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td><b>DES</b></td>
                    <td><b>QTE</b></td>
                    <td><b>PT</b></td>
                </tr>
                <?php
                $tauxdollar = $_SESSION['tauxdollar'];
                $monnaie_local = getsymbole_local();
                $mont_tva = $_SESSION['panier1']['mont_tva'];
                //$total_fact=montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar,$_SESSION['panier1']['mont_ht']);
                $total_fact = 0;
                $mont_remise = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_remise']);
                $nbArticles = count($_SESSION['eclat']['id']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $cpte = $_SESSION['eclat']['id'][$i];
                    $qte = $_SESSION['eclat']['qte_modif'][$cpte];
                    $prix = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['prix'][$cpte] * $qte);
                    $des_plt = $_SESSION['panier']['description'][$cpte];
                ?>
                    <tr>
                        <td><b><?php echo $_SESSION['panier']['nom'][$cpte] . '</br>' . ' ' . $des_plt; ?></b></td>
                        <td><b><?php echo $qte; ?></b></td>
                        <td><b><?php echo afficheMontant2($m_affiche, $prix); ?></b></td>
                    </tr>
                <?php
                    $total_fact = $total_fact + $prix;
                };


                ?>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>

                <tr>
                    <td align="right" colspan="2"><b>Montant total : </b></td>
                    <td><b>:<?php echo afficheMontant2($m_affiche, $total_fact); ?></b></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"><b>
                            <?php echo $_SESSION['mention']; ?>
                        </b></td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<?php
//POUR ECLATEMENT FACTURE
$_SESSION['eclat'] = array();
$_SESSION['eclat']['id'] = array();
$_SESSION['eclat']['qte_modif'] = array();
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82, 5000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->setjs('this.print()');
$mpdf->Output("Addition.pdf", "I");
