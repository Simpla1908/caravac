<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
ini_set('memory_limit', '1024M');
session_start();
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
$m_affiche = $_SESSION['m_affiche'];
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
//$nom_client='';
//if(isset($_GET['nom_client'])){
//   $nom_client=$_GET['nom_client'];
//}
if (isset($_GET['boncommande_id'])) {
    $_SESSION['num_commande'] = 0;
    $boncommande_id = $_GET['boncommande_id'];
    $id_cmd = $_GET['id_cmd'];
    $impr = 0;
    if ($id_cmd != 0) {
        $impr = 1;
    }
    ReimprimerBC2($boncommande_id, $impr, $bdd);
} else {
    $nom_client = '';
    if (isset($_GET['nom_client'])) {
        $nom_client = $_GET['nom_client'];
    }
    $_SESSION['nom_client'] = $nom_client;
    $_SESSION['date_edition2'] = date('Y-m-d');
}
//$_SESSION['nom_client']=$nom_client;
//$_SESSION['date_edition2']=date('d/m/Y');
$nbArticles = count($_SESSION['panier']['id_article']);
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
                        <b><?php echo strtoupper($nom_c)  ?>
                        </b> <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto']) ?>)</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="border-bottom: 1px solid black;">
                        <b>BON BAR <?php echo $_SESSION['num_commande'];  ?>
                            <br>
                            <?php echo dateAfficheForHr($_SESSION['date_edition2']);  ?>
                            <br>
                            Client:<?php echo $_SESSION['nom_client'];  ?>
                            <br>
                            <b>Serveur:<?php echo $_SESSION['serveur_name']; ?></b>
                            <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td><b>DES</b></td>
                    <td><b>QTE</b></td>
                </tr>

                <?php
                $tauxdollar = $_SESSION['tauxdollar'];
                $monnaie_local = getsymbole_local();
                $mont_tva = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_tva']);
                $total_fact = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_ht']);
                $mont_remise = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_remise']);
                $ttc = 0;
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $id_article = $_SESSION['panier']['id_article'][$i];
                    $repas = $_SESSION['panier']['repas'][$i];
                    $idtab = $_SESSION['id_client'];
                    if ($repas == 0 || $repas == 3) {
                        $prix = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['qte'][$i]);
                ?>
                        <tr>
                            <td><b><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></b></td>
                            <td><b><?php echo $_SESSION['panier']['qte'][$i]; ?></b></td>
                        </tr>
                <?php $ttc = $ttc + $prix;
                    }
                }

                //                $ttc2=montant_equivalent_bdd($monnaie_local,'USD',$tauxdollar,$ttc);
                ?>
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
            </tbody>

        </table>
    </div>
</div>

<?php


ReinitialiserPanier();

$_SESSION['platdetail'] = array();
$_SESSION['platdetail']['idprod'] = array();
$_SESSION['platdetail']['id'] = array();
$_SESSION['platdetail']['nom'] = array();
$_SESSION['platdetail']['etat'] = array();

$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82, 1000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->setjs('this.print()');
$mpdf->Output("Bon bar.pdf", "I");
