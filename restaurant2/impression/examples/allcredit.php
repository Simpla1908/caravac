<?php
ini_set('max_execution_time', 1500); //300 seconds = 5 minutes
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
$d1 = $_GET['d1'];
$d2 = $_GET['d2'];
$image_url='./kembologo.jpeg';
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <table style="margin:auto; font-family: monospace; font-size:17px;">
            <tbody id="entries">
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                         <img src="<?php echo $image_url;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b>LISTE DES FACTURES CREDIT
                            <br>
                            <?php echo dateAffiche($d1).'-'.dateAffiche($d2);  ?>
                            <br>
                            Monnaie:<?php echo $_SESSION['m_affiche'];  ?>
                            <!-- <?php //echo 'imprimée par';  ?>
                            <br><?php //echo $_SESSION['nom_user'];  ?>
                            <br> -->
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <?php
                $id_site = $_SESSION['id_hotel'];
                $etat_cmd = 0;
                $mode = 'Credit';
                $tot_ttc = 0;
                $tot_pye = 0;
                $idclient=$_GET['idclient'];
                if($idclient==0){
                    $requete = $bdd->prepare("SELECT a.* FROM t_facture a
                   WHERE a.id_hotel=:id_site
                   AND a.mode=:mode
                   AND a.date_edition BETWEEN :dte1 AND :dte2");
                $requete->BindParam(':id_site', $id_site);
                $requete->BindParam(':mode', $mode);
                $requete->BindParam(':dte1', $d1);
                $requete->BindParam(':dte2', $d2);
                $requete->execute();
                }else{
                    $requete = $bdd->prepare("SELECT a.* FROM t_facture a
                   WHERE a.id_client=:id_client
                   AND a.mode=:mode
                   AND a.date_edition BETWEEN :dte1 AND :dte2");
                $requete->BindParam(':id_client',$idclient);
                $requete->BindParam(':mode', $mode);
                $requete->BindParam(':dte1', $d1);
                $requete->BindParam(':dte2', $d2);
                $requete->execute();
                }
                
                $operations = $requete->fetchAll(PDO::FETCH_OBJ);
                $totall=0;
                foreach ($operations as $op) {
                    $id_fact = $op->id_fact;
                    $taux_op = $op->taux;
                    ReimprimerPOS($id_fact, $bdd);
                ?>
                    <tr>
                        <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                            <b>N° Facture : <?php echo $_SESSION['num_commande'];  ?>
                                <br>
                                <?php echo dateAfficheForHr($_SESSION['date_edition2']);  ?>
                                <br>
                                Client:<?php echo $_SESSION['nom_client'];  ?>
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
                            <td><b><?php echo afficheMontant2('', $prix); ?></b></td>
                        </tr>
                    <?php };
                    $ttc = ttc($total_fact, $mont_tva, $mont_remise);
                    $ttc22 =($ttc - $mont_remise);
                    $totall+=$ttc22;
                  
                    ?>
                    <tr>
                        <td align="right" colspan="3" style="border-top: 1px solid black;">
                        </td>
                    </tr>
                    <?php if (round($mont_tva, 2) == 0) { ?>
                        <tr>
                            <td align="right" colspan="2"><b>HT</b></td>
                            <td><b> :<?php echo afficheMontant2('', $ttc); ?></b></td>
                        </tr>
                        <?php if ($mont_remise > 0) { ?>
                            <tr>
                                <td align="right" colspan="2"><b>REMISE(<?php echo round($_SESSION['panier1']['remise_fact'], 2) . '%' ?>)</b></td>
                                <td><b> :<?php echo afficheMontant2('', $mont_remise); ?></b></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2"><b>THT</b></td>
                                <td><b> :<?php echo afficheMontant2('', $ttc - $mont_remise); ?></b></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td align="right" colspan="2"><b>HT</b></td>
                            <td><b> :<?php echo afficheMontant2('', $total_fact); ?></b></td>
                        </tr>
                        <tr>
                            <td align="right" colspan="2"><b>TVA(<?php echo round($_SESSION['panier1']['tvafact'], 2) . '%' ?>)</b></td>
                            <td> <b>:<?php echo afficheMontant2('', $mont_tva); ?></b></td>
                        </tr>

                        <tr>
                            <td align="right" colspan="2"><b>TTC</b></td>
                            <td><b> :<?php echo afficheMontant2('', $ttc); ?></b></td>
                        </tr>
                        <?php if ($mont_remise > 0) { ?>
                            <tr>
                                <td align="right" colspan="2"><b>REMISE(<?php echo round($_SESSION['panier1']['remise_fact'], 2) . '%' ?>)</b></td>
                                <td><b> :<?php echo afficheMontant2('', $mont_remise); ?></b></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2"><b>NET A PAYER</b></td>
                                <td><b> :<?php echo afficheMontant2('', $netapayer); ?></b></td>
                            </tr>

                            <!-- <tr>
                                <td align="right" colspan="2"><b>Soit</b></td>
                                <td><b><?php //echo afficheMontant2($m_affiche1, montant_equivalent_bdd($m_affiche, $m_affiche1, $_SESSION['tauxfct'], $netapayer)); ?></b>
                                </td>
                            </tr> -->
                        <?php } ?>
                    <?php } ?>
                    <?php if ($_SESSION['mode_fact'] == 'Cash' || $_SESSION['mode_fact'] == 'Credit') {
                        $p = TotPayeCommande2($id_fact, $bdd);
                        $mont_paye = montant_equivalent_bdd('CDF', $m_affiche, $taux_op, $p['paye']);
                        if ($mont_paye > $ttc) {
                            $mont_paye = $ttc;
                        }
                        $tot_pye = $tot_pye + $mont_paye;
                        $rendu = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $p['rendu']);
                        $_SESSION['montantsaisi'] = $mont_paye;
                        $_SESSION['totrendu'] = $rendu;

                    ?>
                        <tr>
                            <td align="right" colspan="2"><b>MONTANT PAYE</b></td>
                            <td> <b>:<?php echo afficheMontant2('', $mont_paye); ?></b></td>
                        </tr>
                      <!--   <tr>
                            <td align="right" colspan="2"><b>Soit</b></td>
                            <td><b><?php //echo afficheMontant2($m_affiche1, montant_equivalent_bdd($m_affiche, $m_affiche1, $_SESSION['tauxfct'], $_SESSION['montantsaisi'])); ?></b>
                            </td>
                        </tr> -->
                        <?php if ($mont_remise > 0) { ?>
                            <tr>
                                <td align="right"><b>SOLDE</b></td>
                                <td colspan="2"> <b>:<?php echo afficheMontant2('', ($ttc-$mont_remise)- $mont_paye); ?></b></td>
                            </tr>
                        <?php } ?>
                        <?php if ($_SESSION['totrendu'] > 0) { ?>
                            <tr>
                                <td align="right"><b>Rendu USD</b></td>
                                <td  colspan="2"><b>:<?php echo afficheMontant2('USD', $_SESSION['rendu_usd']); ?></b></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Rendu CDF</b></td>
                                <td  colspan="2"> <b>:<?php echo afficheMontant2('CDF', $_SESSION['rendu_cdf']); ?></b></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>

                    <tr>
                        <td align="center" colspan="3" style="border-top: 1px solid black;">
                        </td>
                    </tr>

                <?php
                    $tot_ttc = $tot_ttc + $ttc;
                }
                ?>
                <tr>
                    <td align="right"><b>TOTAL CREDIT</b></td>
                    <td  colspan="2"> <b>:<?php echo afficheMontant2('', $totall); ?></b></td>
                </tr>
                <!-- <tr>
                    <td align="right" colspan="2"><b>Soit</b></td>
                    <td><b><?php// echo afficheMontant2($m_affiche1, montant_equivalent_bdd($m_affiche, $m_affiche1, $_SESSION['tauxfct'], $totall)); ?></b></td>
                </tr> -->
                <tr>
                    <td align="right"><b>TOTAL PAYE</b></td>
                    <td colspan="2"> <b>:<?php echo afficheMontant2('', $tot_pye); ?></b></td>
                </tr>
                <tr>
                    <td align="right"><b>TOTAL SOLDE</b></td>
                    <td  colspan="2"> <b>:<?php echo afficheMontant2('',$totall-$tot_pye); ?></b></td>
                </tr>
                <tr>
                    <td align="right" ><b>Soit</b></td>
                    <td colspan="2"><b><?php echo afficheMontant2($m_affiche1, montant_equivalent_bdd($m_affiche, $m_affiche1, $_SESSION['tauxfct'],$totall-$tot_pye)); ?></b></td>
                </tr>

                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"><b>
                            <?php
                            echo  'Imprimé par '.$_SESSION['nom_user'].', le '.date('d/m/y H:i:s');
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
$mpdf->Output("Factures credit.pdf", "I");
