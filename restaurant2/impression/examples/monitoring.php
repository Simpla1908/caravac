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
$cmd_id = $_GET['cmd_id'];
$dte_cmd = $_GET['dte_cmd'];
$client = $_GET['client'];
$numfact = $_GET['numfact'];
$tauxdollar = $_SESSION['tauxdollar'];
$prods_groupes = SelectProduitsMonitoringGroupes($cmd_id, $bdd);
$prods_details = SelectProduitsMonitoringDetails($cmd_id, $bdd);
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
                            (<?php echo strtoupper($_SESSION['libelle_resto']) ?>)<br>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b> FACTURE N°<?php echo $numfact;  ?>
                            <br>
                            <?php echo dateAffiche($dte_cmd);  ?>
                            <br>
                            Table/Client: <?php echo $client;  ?>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td><b>DESCRIPTION</b></td>
                    <td><b>DESIGNATION</b></td>
                    <td><b>QTE</b></td>
                </tr>
                <?php
                $ttc = 0;
                foreach ($prods_groupes as $pg) {
                    $designation = $pg->designation;
                    $qtegr = $pg->qte;
                    $produit_idgr = $pg->produit_id;
                ?>
                <?php
                    $tarif = 0;
                    foreach ($prods_details as $pd) {

                        $produit_id = $pd->produit_id;
                        if ($produit_idgr == $produit_id) {
                            $heure = $pd->heure;
                            $agent = $pd->agent;
                            $des = $pd->designation;
                            $des_plt = $pd->description;
                            $qte = $pd->qte;
                            $prix = $pd->prix;
                            $monnaie = $pd->monnaie;
                            $repas = $pd->repas;
                            $suppr = $pd->suppr;
                            $tarif = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $prix);
                            $tarif1 = $tarif * $qte;
                            $ttc += $tarif1;
                    ?>
                <tr>
                    <td><?php echo $heure . ' ' . $agent; ?></td>
                    <td><?php echo $des . '</br>' . ' ' . $des_plt; ?></td>
                    <td><?php echo $qte; ?></td>
                </tr>
                <?php }
                    } ?>
                <tr>
                    <td colspan="2"><b><?php echo $designation . ' Total'; ?></b></td>
                    <td><?php echo $qtegr; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82, 5000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->Output("Monitoring.pdf", "I");