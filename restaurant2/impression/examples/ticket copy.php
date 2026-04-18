<?php
if (!isset($_SESSION)){
    session_start();
 }
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
$m_affiche=$_SESSION['m_affiche'];
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
ReimprimerPOS($_SESSION['id_fact'],$bdd);
$nbArticles = count($_SESSION['panier1']['id_article']);
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket" >
        <table  style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($nom_c)  ?>
                        </b> <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto'])?>)</b><br>
                        <?php echo strtoupper($adresse_c)  ?>
                        <br>
                        <?php echo strtoupper($ville)  ?>
                        <br>
                        <?php echo strtoupper($telephone)  ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                         FACTURE N°<?php echo $_SESSION['num_commande'];  ?>
                        <br>
                        <?php echo dateAfficheForHr($_SESSION['date_edition2']);  ?>
                        <br>
                         Mode:<?php echo $_SESSION['mode_fact'];  ?>
                        <br>
                         Client:<?php echo $_SESSION['nom_client'];  ?>
                        <br>
                        Agent:<?php echo $_SESSION['nom_user'];  ?>
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
                    $monnaie_local=getsymbole_local();
                    $mont_tva= montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar,$_SESSION['panier1']['mont_tva']);
                    $total_fact=montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar,$_SESSION['panier1']['mont_ht']);
                    $mont_remise=montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar,$_SESSION['panier1']['mont_remise']);
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                       $prix=montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar,$_SESSION['panier1']['prix'][$i]*$_SESSION['panier1']['qte'][$i]);
                  ?>
                <tr>
                    <td><?php echo ucfirst($_SESSION['panier1']['nom'][$i]); ?></td>
                    <td ><?php echo $_SESSION['panier1']['qte'][$i]; ?></td>
                    <td ><?php echo afficheMontant2($m_affiche, $prix); ?></td>
                </tr>
              <?php };
                $ttc=ttc($total_fact, $mont_tva,$mont_remise);
              ?>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>HT</b></td>
                    <td > :<?php echo afficheMontant2($m_affiche, $total_fact); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>TVA</b></td>
                    <td> :<?php echo afficheMontant2($m_affiche, $mont_tva); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>Remise</b></td>
                    <td > :<?php echo afficheMontant2($m_affiche, $mont_remise); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>TTC CDF</b></td>
                    <td > :<?php echo afficheMontant2($m_affiche, $ttc); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>TTC USD</b></td>
                    <td > :<?php echo afficheMontant2('USD',$_SESSION['ttc2']); ?></td>
                </tr>
                <?php if($_SESSION['mode_fact']=='Cash'){ ?>
                    <tr>
                        <td align="right" colspan="2"><b>Montant Payé</b></td>
                        <td > :<?php echo afficheMontant2($m_affiche,$_SESSION['montantsaisi']); ?></td>
                    </tr>
                    <?php if($_SESSION['totrendu']>0){ ?>
                    <tr>
                        <td align="right" colspan="2"><b>Rendu</b></td>
                        <td > :<?php echo afficheMontant2($m_affiche,$_SESSION['totrendu']); ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"><b>
                        <?php echo $_SESSION['mention']; ?>
                    </b></td>
                </tr>
            </tbody>
            
        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c',array(82,82),0,'',0,0,0,0,0,0);
$mpdf->WriteHTML($body);
$mpdf->Output("ticket.pdf","I");
