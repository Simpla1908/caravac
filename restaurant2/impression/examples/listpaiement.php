<?php
if (!isset($_SESSION)) {
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
                         LISTE DES PAIMENTS
                        <br>
                        <br>
                         Mode:<?php echo $_SESSION['mode_fact'];  ?>
                        <br>
                        
                        Agent:<?php echo $_SESSION['nom_user'];  ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td><b>NUMERO</b></td>
                     <td><b>DATE</b></td>
                    <td><b>MONTANT</b></td>
                </tr>
              <?php     
                    $paiements=$_SESSION['paiements'];
                    $taux_op=$_SESSION['taux_fact'];
                    $monnaie=getsymbole_local();
                    $tot1 = 0;
                    foreach ($paiements as $p) {
                        $mode = $p->lib;
                        $id_regl=$p->id_regl;
                        $numero =$p->numero;
                        $user =$p->nom_user.' '.$p->prenom_user;
                        $dte =$p->dte;
                        $dte_h=$p->date_regl;
                        $tx_paie= $p->taux;
                        $mont_paye1 =($p->montantusd*$p->taux+$p->montantcdf)-($p->rendu_usd*$p->taux+$p->rendu_cdf) ;
                        $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op,$mont_paye1);
                  ?>
                <tr>
                     <td><?php echo $numero ?></td>
                      <td><?php echo dateAffiche($dte) ?></td>
                    <td><?php echo afficheMontant($m_affiche, $mont_paye); ?></td>
                </tr>
              <?php  $tot1+=$mont_paye;};
              ?>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>TOTAL</b></td>
                    <td > :<?php echo afficheMontant($m_affiche,$tot1); ?></td>
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
$mpdf->Output("Extrait de compte.pdf", "I");
