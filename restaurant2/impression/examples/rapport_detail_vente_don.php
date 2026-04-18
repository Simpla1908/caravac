<?php
if (!isset($_SESSION)) {
    session_start();
}
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('memory_limit', '1024M');
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
$date_bd1 = $date_bd2 =  date('Y-m-d');
$periode = date('d/m/Y');
if (isset($_GET['periode'])) {
    $periode = $_GET['periode'];
    $caissier_name = $_GET['caissier_name'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $date_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
    $periode = 'du ' . $date1 . ' au ' . $date2;
    $dte = date('Y-m-d');
    $hr_1 = '00:00:00';
    $hr_2 = '05:00:00';
    $hr_operation = date('H:i:s');
    //Ajustement pour des ventes tardives
    if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
        $dte1 = ReduiceDaysToDate($dte, 1);
        $periode = $dte1;
    }
}
$paiements_percus = getMontantPercuMobileMoney($m_affiche, $_SESSION['id_hotel'], $date_bd1, $date_bd2, $bdd);
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <table  style="margin:40px; font-family: monospace; font-size: 12px;">
            <tbody id="entries">
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($nom_c) ?>
                        </b> <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto']) ?>)</b><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b>
                            RAPPORT VENTE MOBILE MONEY
                            <br>
                            (<?php echo $periode; ?>)

                            <br>
                            Caissier:<?php echo $caissier_name; ?><br>
                        </b>
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
                $boisson_cash = $_SESSION['boisson_cash'];
                $boisson_credit = $_SESSION['boisson_credit'];
                $boisson_don = $_SESSION['boisson_don'];
                $nouriture_cash = $_SESSION['nouriture_cash'];
                $nouriture_credit = $_SESSION['nouriture_credit'];
                $nouriture_don = $_SESSION['nouriture_don'];
                $extra_cash = $_SESSION['extra_cash'];
                $extra_credit = $_SESSION['extra_credit'];
                $extra_don = $_SESSION['extra_don'];
                $emporte_cash = $_SESSION['emporte_cash'];
                $emporte_credit = $_SESSION['emporte_credit'];
                $emporte_don = $_SESSION['emporte_don'];
                $totalpaiecreance = $_SESSION['totalpaiecreance'];
                $nbre_rows = count($_SESSION['prod']['id']);
                $j = 1;
                $total = 0;
                $total1 = 0;
                $total2 = 0;
                $tot_qte = 0;
                $tot_qte1 = 0;
                $tot_qte2 = 0;
                $qte_cash = 0;
                $qte_credit = 0;
                $qte_don = 0;
                $pt_cash = 0;
                $pt_credit = 0;
                $pt_don = 0;
                for ($i = 0; $i <= $nbre_rows - 1; $i++) {
                    $idprod = $_SESSION['prod']['id'][$i];
                    $designation = $_SESSION['prod']['des'][$i];

                    if (isset($_SESSION['don']['qte'][$idprod])) {
                        $qte_don = $_SESSION['don']['qte'][$idprod];
                        $pt_don = $_SESSION['don']['pt'][$idprod];
                    } else {
                        $qte_don = 0;
                        $pt_don = 0;
                    }
                    $qte = $qte_don;
                    if ($qte > 0) {
                ?>
                        <tr>
                            <td><b><?php echo $designation; ?></b></td>
                            <td><b><?php echo $qte; ?></b></td>
                            <td><b><?php echo afficheMontant2($m_affiche, $pt_don) ?></b></td>
                        </tr>
                <?php
                        $j++;
                        $total1 += $pt_credit;
                        $tot_qte1 += $qte_credit;
                    }
                }
                ?>

                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <?php
                $catVente = detailsSalesCategorie(
                    $date_bd1,
                    $date_bd2,
                    $_SESSION['id_hotel'],
                    $bdd
                );
                $nbre_rows_catVente = count($catVente['numTarif']);
                $nbre_rows_catVente;
                for ($i = 0; $i <= $nbre_rows_catVente - 1; $i++) {
                    $montant_don = 0;
                    $montant_credit = 0;
                    $montant_cash = 0;
                    $familleTypeId = $catVente['numTarif'][$i];
                    $designation = $catVente['categorieVente'][$familleTypeId];
                    $designation = $catVente['categorieVente'][$familleTypeId];

                    if (isset($catVente['montant_cash'][$familleTypeId])) {
                        $montant_cash = $catVente['montant_cash'][$familleTypeId];
                    }
                    if (isset($catVente['montant_credit'][$familleTypeId])) {
                        $montant_credit = $catVente['montant_credit'][$familleTypeId];
                    }
                    if (isset($catVente['montant_don'][$familleTypeId])) {
                        $montant_don = $catVente['montant_don'][$familleTypeId];
                    }

                ?>
                    <tr>
                        <td align="right" colspan="2"><b><?php echo $designation; ?></b></td>
                        <td><b> :<?php echo afficheMontant2($m_affiche, $montant_don); ?></b></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <?php
                $totmobile = 0;
                foreach ($paiements_percus as $r) { ?>
                    <tr>
                        <td align="right" colspan="2"><b><?php echo $r->lib; ?></b></td>
                        <td><b> :<?php echo afficheMontant2($m_affiche, $r->montantpaye); ?></b></td>
                    </tr>
                <?php $totmobile += $r->montantpaye;
                } ?>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>TOTAL</b></td>
                    <td><b> :<?php echo afficheMontant2($m_affiche, $totmobile); ?></b></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                    <b> Imprimé, le <?php echo date('d/m/Y H:i:s'); ?>, par <?php echo $_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user']; ?></b>
                    </td>
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
$mpdf->Output("Rapport vente Don.pdf", "I");
