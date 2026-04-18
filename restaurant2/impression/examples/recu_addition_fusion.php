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
$id_fact_fus = $_GET['id_fact_fus'];
$fusion_total = 0;
$datasfusion = $bdd->prepare("SELECT a.*,d.* FROM t_facture a,t_utilisateur AS d 
                   WHERE a.id_user=d.id_user 
                   AND a.id_fact=:id_fact");
$datasfusion->BindParam(':id_fact', $id_fact_fus);
$datasfusion->execute();
while ($donnees = $datasfusion->fetch()) {
    $num_fact_fus = $donnees['num_fact'];
    $date_edition_fus = $donnees['date_edition'];
    $caissier = $donnees['nom_user'];
    $fusion_total = montant_equivalent_bdd('CDF', 'USD', $donnees['taux'], $donnees['mont_ttc']);
}
if ($_SESSION['update_bill']) {
    $montantsaisi=$_SESSION['montantsaisi'];
    $montantusd = $_SESSION['usd'];
    $montantcdf = $_SESSION['cdf'];
    if ($_SESSION['cdf'] == '') {
        $montantcdf = 0;
    }
    if ($_SESSION['usd'] == '') {
        $montantusd = 0;
        # code...
    }
    $idpaie = $_SESSION['update_bill'];
   // var_dump($idpaie);
    $requete = $bdd->prepare("UPDATE paiement SET montant=:montant, montantusd=:montantusd, montantcdf=:montantcdf WHERE idpaie=:idpaie");
    $requete->BindParam(':montant',$montantsaisi);
    $requete->BindParam(':montantusd', $montantusd);
    $requete->BindParam(':montantcdf', $montantcdf);
    $requete->BindParam(':idpaie', $idpaie);
    $requete->execute();
    unset($_SESSION['update_bill']);
}
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
                <!--  <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b>BON DE FUSION N°<? //php echo $num_fact_fus; 
                                            ?>
                            <br>
                            <? //php echo dateAffiche($date_edition_fus);  
                            ?>
                            <br>
                            <? //php echo 'créée par';  
                            ?>
                            <br><? //php echo $caissier;  
                                ?>
                            <br>
                    </td>
                </tr> -->
                <tr>
                    <td colspan="3"></td>
                </tr>
                <?php
                $tot_ttc = 0;
                // $tot_nbc=0;

                $requete = $bdd->prepare("SELECT * FROM fusion_factures WHERE id_fact_fus=:id_fact_fus");
                $requete->BindParam(':id_fact_fus', $id_fact_fus);
                $done = $requete->execute();
                $operations = $requete->fetchAll(PDO::FETCH_OBJ);
                ReimprimerPOS($id_fact_fus, $bdd);
                ?>
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b>N° Facture : <?php echo $_SESSION['num_commande'];  ?>
                            <br>
                            <?php echo dateAfficheForHr($_SESSION['date_edition2']);  ?>
                            <br>
                            Client:<?php echo $_SESSION['nom_client'];  ?>
                            <br>
                            Serveur:<?php echo $_SESSION['serveur_name'];  ?>
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
                $nbArticles = count($_SESSION['panier1']['id_article']);
                $tauxdollar = $_SESSION['tauxdollar'];
                $monnaie_local = getsymbole_local();
                $mont_tva = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_tva']);
                $total_fact = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_ht']);
                $mont_remise = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_remise']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $prix = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['prix'][$i] * $_SESSION['panier1']['qte'][$i]);
                    $des_plt = $_SESSION['panier1']['description'][$i];
                ?>
                    <tr>
                        <td><b><?php echo $_SESSION['panier1']['nom'][$i] . '</br>' . ' ' . $des_plt; ?></b></td>
                        <td><b><?php echo $_SESSION['panier1']['qte'][$i]; ?></b></td>
                        <td><b><?php echo afficheMontant2($m_affiche, $prix); ?></b></td>
                    </tr>
                <?php };
                $ttc = ttc($total_fact, $mont_tva, $mont_remise);
                ?>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <?php
                if (round($mont_tva) == 0) { ?>
                    <tr>
                        <td align="right" colspan="2"><b>HT</b></td>
                        <td><b>:<?php echo afficheMontant2($m_affiche, $ttc); ?></b></td>
                    </tr>
                    <?php if ($mont_remise > 0) { ?>
                        <tr>
                            <td align="right" colspan="2"><b>Remise</b></td>
                            <td><b> :<?php echo afficheMontant2($m_affiche, $mont_remise); ?><b></td>
                        </tr>
                        <tr>
                            <td align="right" colspan="2"><b>THT</b></td>
                            <td><b> :<?php echo afficheMontant2($m_affiche, $ttc - $mont_remise); ?></b></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td align="right" colspan="2"><b>HT</b></td>
                        <td><b> :<?php echo afficheMontant2($m_affiche, $total_fact); ?></b></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2"><b>TVA</b></td>
                        <td><b> :<?php echo afficheMontant2($m_affiche, $mont_tva); ?></b></td>
                    </tr>
                    <?php if ($mont_remise > 0) { ?>
                        <tr>
                            <td align="right" colspan="2"><b>Remise</b></td>
                            <td><b> :<?php echo afficheMontant2($m_affiche, $mont_remise); ?></b></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td align="right" colspan="2"><b>TTC</b></td>
                        <td> <b>:<?php echo afficheMontant2($m_affiche, $ttc); ?></b></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2"><b>Soit</b></td>
                        <td><b><?php echo afficheMontant2($m_affiche1, montant_equivalent_bdd($m_affiche, $m_affiche1, $_SESSION['tauxfct'], $ttc)); ?></b></td>
                    </tr>
                <?php
                }
                $tot_ttc = $fusion_total;
                ?>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <?php
                // }
                ?>
                <?php echo afficheMontant2($m_affiche, $fusion_total); ?>
                <!--  <tr>
                    <td align="right" colspan="2"><b>TOTAUX</b></td>
                    <td> <b>:
                   
                    </b></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>Soit</b></td>
                    <td><b>
                        <?php echo afficheMontant2($m_affiche1, montant_equivalent_bdd($m_affiche, $m_affiche1, $_SESSION['tauxfct'], $tot_ttc)); ?></b></td>
                </tr> -->

                <?php if ($_SESSION['mode_fact'] == 'Cash') { ?>
                    <tr>
                        <td align="right" colspan="2"><b>Montant Payé</b></td>
                        <td> <b>:<?php echo afficheMontant2($m_affiche, $_SESSION['montantsaisi']); ?></b></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2"><b>Soit</b></td>
                        <td><b><?php echo afficheMontant2($m_affiche1, montant_equivalent_bdd($m_affiche, $m_affiche1, $_SESSION['tauxfct'], $_SESSION['montantsaisi'])); ?></b></td>
                    </tr>
                    <?php if ($_SESSION['totrendu'] > 0) { ?>
                        <tr>
                            <td align="right" colspan="2"><b>Rendu USD</b></td>
                            <td><b>:<?php echo afficheMontant2('USD', $_SESSION['rendu_usd']); ?></b></td>
                        </tr>
                        <tr>
                            <td align="right" colspan="2"><b>Rendu CDF</b></td>
                            <td> <b>:<?php echo afficheMontant2('CDF', $_SESSION['rendu_cdf']); ?></b></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                        <b>
                            <?php
                            echo $_SESSION['mention'];
                            ?>
                        </b>
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
$mpdf->Output("facture_fusion.pdf", "I");
 