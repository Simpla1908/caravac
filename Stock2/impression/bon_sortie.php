<?php
include_once '../../impression/mpdf60/mpdf.php';
include '../bdd/connexion.php';
include_once '../../FUNCTION/hebergement.php';
session_start();

$company_id = $_SESSION['company_id'];

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
        
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <table style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td colspan="4" align="center" style="border-bottom: 1px solid black;">
                        <b>BON DE SORTIE N°<?php echo $_SESSION['numbon']; ?>
                            <br>
                            <?php echo $_SESSION['date'] ?>
                            <br>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td><b>DES</b></td>
                    <td><b>QTE</b></td>
                    <td><b>UNITE</b></td>
                    <th><b>MOTIF</b></th>
                </tr>
                <?php 
                    $nbArticles = count($_SESSION['fiche']['produit_id']);
                    $j=1;
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                    <td><b><?php echo $_SESSION['fiche']['designation'][$i] ?></b></td>
                    <td><b><?php echo $_SESSION['fiche']['qte_env'][$i] ?></b></td>
                    <td><b><?php echo $_SESSION['fiche']['unite'][$i] ?></b></td>
                    <td><b><?php echo $_SESSION['fiche']['obs'][$i] ?></td>
                </tr>

                <?php
                };
                ?>
              <tr>
                    <td align="center" colspan="4" style="border-top: 1px solid black;"><b>
                            <?php echo 'Imprimé par '.strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']).', le '.date('d/m/Y  à H:i:s'); ?>
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
$mpdf->Output("Bon sortie.pdf", "I");

