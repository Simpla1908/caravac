<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

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
$idcommande = $_GET['idfactcl'];
$pn = $_GET['pn'];
$pd = $_GET['pd'];
$pq = $_GET['pq'];
$pt = $_GET['pt'];
$repas = $_GET['repas'];
$idp = $_GET['idp'];
$agent = $_GET['agent'];

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
                        </b> <br>
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
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b>BON DE SUPPRESSION <?php echo $_SESSION['num_commande'];  ?></b>
                        <br>
                        <?php echo dateAfficheForHr($_SESSION['date_edition2']);  ?>
                        <br>
                        Supprimé par :<?php echo $agent;  ?>
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
                <tr>
                    <td><?php echo $pn . '</br>' . ' ' . $pd; ?></td>
                    <td><?php echo $pq; ?></td>
                    <td><?php echo afficheMontant($m_affiche, $pt); ?></td>
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
$mpdf->Output("bonsuppression.pdf", "I");
