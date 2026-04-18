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
                        <b>LISTE DE BONS DE SUPPRESSIONS
                            <br>
                            <?php echo dateAffiche(date('Y-m-d'));  ?>
                            <br>
                            <?php echo 'imprimée par';  ?>
                            <br><?php echo $_SESSION['nom_user'];  ?>
                            <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <?php
                $id_site = $_SESSION['id_hotel'];
                $d1 = $_GET['d1'];
                $d2 = $_GET['d2'];
                $tot_ttc = 0;
                $requete = $bdd->prepare("SELECT * FROM suivifactures AS a, stk_produit AS b,t_facture AS c
                                WHERE a.produit_id=b.idprod AND a.facture_id=c.id_fact
                                AND c.id_hotel=:site_id AND a.suppr=1 
                                AND c.date_edition BETWEEN :dte1 AND :dte2
                                ORDER BY c.date_edition");
                $requete->BindParam(':site_id', $id_site);
                $requete->BindParam(':dte1', $d1);
                $requete->BindParam(':dte2', $d2);
                $requete->execute();
                $operations = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($operations as $l) {
                    $dte = $l->dte;
                    $heure = $l->heure;
                    $num_fact = $l->num_fact;
                    $serveur = $l->agent;
                    $admin = $l->admin;
                    $prod = $l->designation;
                    $prix = $l->prix;
                    $tauxdollar = $l->taux;
                    $prix = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $tauxdollar, $l->prix);
                    $qte = ($l->qte) * -1;
                    $pt = $prix * $qte;
                    $descpt = $l->description;
                ?>
                    <tr>
                        <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                            <b>N° Bon: <?php echo $num_fact;  ?>
                                <br>
                                <?php echo dateAfficheForHr($dte);  ?>
                                <br>
                                <?php echo $heure;  ?>
                                <br>
                                Supprimé par :<?php echo $serveur;  ?>
                                <br>

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
                        <td><b><?php echo $prod . '</br>' . ' ' . $descpt; ?></b></td>
                        <td><b><?php echo $qte; ?></b></td>
                        <td><b><?php echo afficheMontant2($m_affiche, $pt); ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            -------------------------------------
                        </td>
                    </tr>
                <?php
                    $tot_ttc = $tot_ttc + $pt;
                }
                ?>
                <tr>
                    <td align="right" colspan="2"><b>TOTAUX</b></td>
                    <td> <b>:<?php echo afficheMontant2($m_affiche, $tot_ttc); ?></b></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>Soit</b></td>
                    <td><b><?php echo afficheMontant2($m_affiche1, montant_equivalent_bdd($m_affiche, $m_affiche1, $_SESSION['tauxfct'], $tot_ttc)); ?></b></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"><b>
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
$mpdf->Output("allsup.pdf", "I");
