<?php
if (!isset($_SESSION)) {
    session_start();
}
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
$id = $_GET['id'];
$row_depense = SelectDepenseID($id, $bdd);
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <table style="margin:auto; font-family: monospace; font-size: 18px;">
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
                        <b> BON DE SORTIE N°<?php echo $row_depense->numero;  ?></b>
                        <br>
                        <?php echo dateAffiche($row_depense->dte_dep);  ?>
                        <br>
                        Agent:<?php echo $_SESSION['nom_user'];  ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td><b>LIBELLE</b></td>
                    <td><b>USD</b></td>
                    <td><b>CDF</b></td>
                </tr>
                <tr>
                    <td><?php echo ucfirst($row_depense->designation); ?></td>
                    <td><?php echo afficheMontant('USD', $row_depense->usd); ?></td>
                    <td><?php echo afficheMontant('CDF', $row_depense->cdf); ?></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                        <b>DESCRIPTION</b>
                        <br>
                        <?php echo $row_depense->motif;  ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="border-top: 1px solid black;">
                        <table>
                            <tr>
                                <td align="left">Agent</td>
                                <td width="130px"></td>
                                <td align="right">Beneficiaire</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82, 82), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->Output("ticket.pdf", "I");
