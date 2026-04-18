<?php
if (!isset($_SESSION)) {
    session_start();
}
//ini_set('memory_limit', '500M');
include '../../bdd/connexion.php';
include_once '../../../impression/mpdf60/mpdf.php';
include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../../FUNCTION/hebergement.php';
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
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket" >
        <!--<h1>Thank You!</h1>-->
        <table  style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($nom_c) ?>
                        </b> <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto'])?>)</b><br>
                        <?php echo strtoupper($adresse_c) ?>
                        <br>
                        <?php echo strtoupper($ville) ?>
                        <br>
                        <?php echo strtoupper($telephone) ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="10"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3"><b>VERSEMENT CAISSE DU <?php echo dateAffiche($_SESSION['dte_vers']); ?></b></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"></td>
                </tr>
                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
                <tr>
                    <td><b>Agent</b></td>
                    <td colspan="2"> :<?php echo strtoupper($_SESSION['nom_user']); ?></td>
                </tr>
                 <tr>
                    <td><b></b></td>
                    <td colspan="2"> </td>
                </tr>
                  <tr>
                    <td align="center" colspan="3" style="border-bottom: 1px solid black;"><b>DETAILS VENTE</b></td>
                </tr>
                 <tr>
                    <td></td>
                    <td><b>USD</b></td>
                    <td><b>CDF</b></td>
                </tr>
                <tr>
                    <td><b>F.D.C</b></td>
                    <td><?php echo afficheMontant('USD',$_SESSION['fond_usd']); ?></td>
                    <td><?php echo afficheMontant('CDF',$_SESSION['fond_cdf']); ?></td>

                </tr>
                <tr>
                    <td><b>MONTANT P.</b></td>
                    <td><?php echo afficheMontant('USD',$_SESSION['percu_usd']); ?></td>
                    <td><?php echo afficheMontant('CDF',$_SESSION['percu_cdf']); ?></td>

                </tr>
                 <tr>
                    <td><b>RENDU</b></td>
                    <td><?php echo afficheMontant('USD',$_SESSION['rendu_usd']); ?></td>
                    <td><?php echo afficheMontant('CDF',$_SESSION['rendu_cdf']); ?></td>

                </tr>
                <tr>
                    <td><b>MONTANT A.</b></td>
                    <td><?php echo afficheMontant('USD',$_SESSION['averser_usd']); ?></td>
                    <td><?php echo afficheMontant('CDF',$_SESSION['averser_cdf']); ?></td>

                </tr>
                   <tr>
                    <td><b>MONTANT V.</b></td>
                   <td><?php echo afficheMontant('USD',$_SESSION['verser_usd']); ?></td>
                    <td><?php echo afficheMontant('CDF',$_SESSION['verser_cdf']); ?></td>

                </tr>
                 <tr>
                    <td><b>SOLDE</b></td>
                   <td><?php echo afficheMontant('USD',$_SESSION['solde_usd']); ?></td>
                    <td><?php echo afficheMontant('CDF',$_SESSION['solde_cdf']); ?></td>

                </tr>
                <tr>
                    <td colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-bottom: 1px solid black;"><b>DETAILS VERSEMENT</b></td>
                </tr>
                <tr>
                    <td colspan="3" height="15"></td>
                </tr>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Montant CDF</th>
                            <th>Montant CDF</th>

                        </tr>
                        </thead>
                        <tbody>
                             <?php 
                                $nbArticles = count($_SESSION['detailversement']['i']);
                                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                ?>
                                <tr>
                                    <td><?php echo $_SESSION['detailversement']['num'][$i] ?></td>
                                    <td><?php echo $_SESSION['detailversement']['mont_usd'][$i] ?></td>
                                    <td><?php echo $_SESSION['detailversement']['mont_cdf'][$i] ?></td>

                                </tr>
                                <?php
                                 }
                                 ?>
                        </tbody>
                    </table>
                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                        <b>
                            Imprimé le  <?php echo $date = date('d/m/Y'); ?><br>
                            Signature
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

//Entete et pied de page
//include './blocfature.php';
//$stylesheet1 = file_get_contents('style.css'); // external css

$mpdf = new mPDF('c', array(82, 82), 0, '', 0, 0, 0, 0, 0, 0);

$mpdf->WriteHTML($body);
$mpdf->Output("Bon de versement.pdf", "I");
