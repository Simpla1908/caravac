<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
ini_set('memory_limit', '1024M');
session_start();
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
if (isset($_GET['boncommande_id'])) {
    $_SESSION['num_commande'] = 0;
    $boncommande_id = $_GET['boncommande_id'];
    $id_cmd = $_GET['id_cmd'];
    $IsChecked = $_GET['IsChecked'];
    $impr = 0;
    if ($IsChecked == 1) {
        ReimprimerBC_Reprint_Lines($boncommande_id, $impr, $bdd);
    } else {
        ReimprimerBC_Reprint_All($boncommande_id, $impr, $bdd);
    }
} else {
    $nom_client = '';
    if (isset($_GET['nom_client'])) {
        $nom_client = $_GET['nom_client'];
    }
    $_SESSION['nom_client'] = $nom_client;
    $_SESSION['date_edition2'] = date('Y-m-d');
}

$default = 0;
$id = 0;
infosPos($id, $default, $bdd);
$tauxdollar = $_SESSION['taux_resto'];
$m_affiche = $_SESSION['m_affiche'];
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();
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

$nbArticles = count($_SESSION['panier']['id_article']);
$compteur_entree = 0;
$compteur_plat = 0;
$compteur_dessert = 0;
// var_dump($_SESSION['ProduitsSelectiones']);
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <table style="margin:auto; font-family: monospace; font-size: 20px;">
            <tbody id="entries">
                <tr>
                    <td colspan="2" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($nom_c) ?></b>
                        <br><br><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="border-bottom: 1px solid black;">
                        <b>BON DE CUISINE <?php echo $_SESSION['num_commande']; ?> </b>
                        <br>
                        <b><?php echo dateAfficheForHr($_SESSION['date_edition2']); ?></b>
                        <br>
                        <b>Client:<?php echo $_SESSION['nom_client']; ?></b>
                        <br>
                        <b>Serveur:<?php echo $_SESSION['nom_user']; ?></b>
                        <br>
                        <b>Nombre de couverts:<?php echo $_SESSION['nbrcouvert']; ?></b>
                        <br>
                        <b>Statut :<?php echo $_SESSION['statut_cmd']; ?></b>
                        <br>
                    </td>
                </tr>
                <?php if ($_SESSION['entree'] == 1) { ?>
                    <tr>
                        <td align="center" colspan="2"><b>
                                ENTREES
                            </b></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2" style="border-top: 1px solid black;"></td>
                    </tr>
                    <tr>
                        <td><b>DESIGNATION</b></td>
                        <td><b>QTE</b></td>

                    </tr>
                    <?php
                    $monnaie_local = getsymbole_local();
                    $mont_tva = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_tva']);
                    $total_fact = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_ht']);
                    $mont_remise = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_remise']);
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $repas = $_SESSION['panier']['repas'][$i];
                        $genre = $_SESSION['panier']['genre'][$i];

                        if ($repas == 1 && $genre == 1) {
                            $prix = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['qte'][$i]);
                    ?>
                            <tr>
                                <td><b><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></b></td>
                                <td><b><?php echo $_SESSION['panier']['qte'][$i]; ?></b></td>

                            </tr>
                    <?php
                            $ttc = ttc($total_fact, $mont_tva, $mont_remise);
                            $compteur_entree = $compteur_entree + $_SESSION['panier']['qte'][$i];
                        }
                    }
                    ?>
                    <tr>
                        <td><b>TOTAL ENTREES</b></td>
                        <td><b><?php echo $compteur_entree; ?></b></td>
                        <td></td>

                    </tr>
                <?php } ?>
                <?php if ($_SESSION['plats'] == 1) { ?>
                    <tr>
                        <td align="center" colspan="2"><b>
                                PLATS
                            </b></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2" style="border-top: 1px solid black;"></td>
                    </tr>
                    <tr>
                        <td><b>DESIGNATION</b></td>
                        <td><b>QTE</b></td>

                    </tr>
                    <?php
                    $des_plt = '';
                    $kt = 0;
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $repas = $_SESSION['panier']['repas'][$i];
                        $genre = $_SESSION['panier']['genre'][$i];
                        $des_plt = $_SESSION['panier']['description'][$i];
                        $plat_idc = $_SESSION['panier']['id_article'][$i];

                        if ($repas == 1 && $genre == 0) {
                            $prix = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['qte'][$i]);
                    ?>
                            <tr>
                                <td><b><?php echo $_SESSION['panier']['nom'][$i] . '</br>' . ' ' . $des_plt; ?></b></td>
                                <td><b><?php echo $_SESSION['panier']['qte'][$i]; ?></b></td>

                            </tr>
                    <?php
                            $compteur_plat = $compteur_plat + $_SESSION['panier']['qte'][$i];
                        }
                    }
                    ?>
                    <tr>
                        <td><b>TOTAL PLATS</b></td>
                        <td><b><?php echo $compteur_plat; ?></b></td>
                        <td></td>

                    </tr>
                <?php } ?>
                <?php if ($_SESSION['dessert'] == 1) { ?>
                    <tr>
                        <td align="center" colspan="2"><b>
                                DESSERTS
                            </b></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="3" style="border-top: 1px solid black;"></td>
                    </tr>
                    <tr>
                        <td><b>DESIGNATION</b></td>
                        <td><b>QTE</b></td>

                    </tr>
                    <?php
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $repas = $_SESSION['panier']['repas'][$i];
                        $genre = $_SESSION['panier']['genre'][$i];
                        if ($repas == 1 && $genre == 2) {
                            $prix = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['qte'][$i]);
                    ?>
                            <tr>
                                <td><b><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></b></td>
                                <td><b><?php echo $_SESSION['panier']['qte'][$i]; ?></b></td>

                            </tr>
                    <?php
                            $compteur_dessert = $compteur_dessert + $_SESSION['panier']['qte'][$i];
                        }
                    }
                    ?>
                    <tr>
                        <td><b>TOTAL DESSERTS</b></td>
                        <td><b><?php echo $compteur_dessert; ?></b></td>
                        <td></td>

                    </tr>
                <?php } ?>
                <tr>
                    <td align="center" colspan="2" style="border-top: 1px solid black;">
                        <b>NOTE :</b>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="2" style="border-top: 1px solid black;text-align:justify">
                        <b>
                            <?php
                            $ch = $_SESSION['note_cmd'];
                            echo wordwrap($ch, 25, '<br>', TRUE);
                            ?>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <br>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"><b>
                            <?php echo $_SESSION['mention'];
                            ?>
                        </b></td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82, 5000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->Output("Bon de commande.pdf", "I");
