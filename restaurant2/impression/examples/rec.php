<?php
if (!isset($_SESSION)) {
    session_start();
 }
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

// requette pour la selection infos site
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();

while ($donnees = $requete_idhotel->fetch()) {
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
    $nom_c = $donnees['nom_hotel '];
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
$site=getInfosSite($_SESSION['id_hotel'],$bdd);
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
                        <b><?php echo strtoupper($site->nom_hotel)  ?>
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
                         RECU N°<?php echo $_SESSION['num_commande'];  ?>
                        <br>
                        <?php echo dateAffiche($_SESSION['date_edition3']);  ?>
                        <br>
                         CLIENT:<?php echo $_SESSION['nom_client'];  ?>
                        <br>
                        AGENT:<?php echo $_SESSION['Agent'];  ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <!--<td align="right" colspan="3" style="border-top: 1px solid black;"></td>-->
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>MOTIF</b></td>
                    <td > :<?php echo $_SESSION['motif_rec']; ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>MODE</b></td>
                    <td > :<?php echo $_SESSION['mode_fact']; ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>MONTANT PAYE</b></td>
                    <td> :<?php echo afficheMontant2($m_affiche,$_SESSION['montantPaye']); ?></td>
                </tr>
             
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
$mpdf->Output("Reçu.pdf", "I");
