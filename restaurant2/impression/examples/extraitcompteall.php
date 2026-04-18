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
/* $date_bd1 = $_GET['d1'];
$date_bd2 = $_GET['d2']; */
$idsite=$_SESSION['id_hotel'];
$data = ExtraitDEcompteAll($idsite, $bdd);?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <table style="margin:40px; font-family: monospace; font-size: 13px;">
            <tbody id="entries">
                <tr>
                    <td colspan="4" align="center" style="border-bottom: 1px solid black;">
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
                    <td colspan="4" align="center" style="border-bottom: 1px solid black;">
                        <b>EXTRAIT DE COMPTE
                            <br>
                            <?php echo date('d/m/Y H:i:s'); ?>
                            <br>
                            Tous les clients
                            <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <?php
                $nbre = count($data['id']);
                $tdebit = 0;
                $tcredit = 0;
                $tsolde = 0;
                // $j = 1;
                for ($i = 0; $i < $nbre; $i++) {
                    $client = $data['client'][$i];
                    $debit = $data['debit'][$i];
                    $credit = $data['credit'][$i];
                    $solde = $debit - $credit;
                    $tdebit += $debit;
                    $tcredit += $credit;
                    $tsolde += $solde;
                ?>
                    <tr>
                        <td colspan="4" align="center" style="border-bottom: 1px solid black;">
                            <b><?php echo $client;  ?>
                                <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2"><b>DEBIT</b></td>
                        <td align="right" colspan="2"><b>:
                                <?php if ($debit > 0) {
                                    echo afficheMontant2(getsymbole_devise(), $debit);
                                } ?>
                            </b></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2"><b>CREDIT</b></td>
                        <td align="right" colspan="2"><b>:
                                <?php if ($credit > 0) {
                                    echo afficheMontant2(getsymbole_devise(), $credit);
                                } ?>
                            </b></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2"><b>SOLDE</b></td>
                        <td align="right" colspan="2"><b>:
                                <?php if ($solde > 0) {
                                    echo afficheMontant2(getsymbole_devise(), $solde);
                                } ?>
                            </b></td>
                    </tr>
                <?php
                };
                ?>
                <tr>
                    <td align="right" colspan="4" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="2"><b>TOTAL DEBIT</b></td>
                    <td align="right" colspan="2"><b>:
                            <?php if ($tdebit > 0) {
                                echo afficheMontant2(getsymbole_devise(), $tdebit);
                            } ?>
                        </b></td>
                </tr>
                <tr>
                    <td align="left" colspan="2"><b>TOTAL CREDIT</b></td>
                    <td align="right" colspan="2"><b>:
                            <?php if ($tcredit > 0) {
                                echo afficheMontant2(getsymbole_devise(), $tcredit);
                            } ?>
                        </b></td>
                </tr>
                <tr>
                    <td align="left" colspan="2"><b>SOLDE</b></td>
                    <td align="right" colspan="2"><b>:
                            <?php if ($tsolde > 0) {
                                echo afficheMontant2(getsymbole_devise(), $tsolde);
                            } ?>
                        </b></td>
                </tr>
                <tr>
                    <td align="center" colspan="4" style="border-top: 1px solid black;"><b>
                            <?php
                            echo $_SESSION['mention'];
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
$mpdf->Output("ExtraitDeCompte.pdf", "I");
