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
$paiements=$_SESSION['paiements'];
$paimentsbymodes=$_SESSION['paimentsbymodes'];
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket" >
        <table  style="margin:40px; font-family: monospace; font-size: 12px;">
            <tbody id="entries">
                <tr>
                    <td  colspan="4" align="center" style="border-bottom: 1px solid black;">
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
                    <td  colspan="4" align="center" style="border-bottom: 1px solid black;">
					<b>  LISTE DES PAIEMENTS(<?php echo $_SESSION['m_affiche']; ?>)
                        <br>
                        <?php echo $_SESSION['periodepaiement'];  ?>
                       </b> <br>  
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
				<tr>
                    <td><b>FACTURE</b></td>
                    <td><b>RECU</b></td>
                    <td><b>MODE</b></td>
                    <td><b>MONTANT</b></td>
                </tr>
                <?php
                    $i = 1;
                    $totpaiementcredit=0;
                    $tot1 = 0;
                    $monnaie =  getsymbole_local();
                    foreach ($paiements as $p) {
                        $mode = $p->lib;
                        $mode2 = $p->mode;
                        $id_regl = $p->id_regl;
                        $numero = $p->numero;
                        $num_fact = $p->num_fact;
                        $user = $p->nom_user . ' ' . $p->prenom_user;
                        $dte = $p->dte;
                        $dte_h = $p->date_regl;
                        $tx_paie = $p->taux;
                        $mont_paye1 = ($p->montantusd * $p->taux + $p->montantcdf) - ($p->rendu_usd * $p->taux + $p->rendu_cdf);
                        $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche,$tx_paie, $mont_paye1);
                        if($mode2=='Credit'){
                            $totpaiementcredit+= $mont_paye;
                        }
                       
                        if ($mont_paye > 0) {
                ?>
                <tr>
                    <td><b><?php echo $num_fact; ?></b></td>
                    <td><b><?php echo $numero; ?></b></td>
                    <td><b><?php echo $mode ; ?></b></td>
                    <td><b><?php echo afficheMontant2('',$mont_paye); ?></b></td>
                </tr>
                <?php
                    }
                    $tot1 += $mont_paye;
                    $i++;
                    }
                 ?>
				<tr>
					<td  colspan="4" align="center" style="border-bottom: 1px solid black;">
                   </td>
                </tr>
                <?php
                foreach ($paimentsbymodes as $p) {
                ?>
                <tr>
                    <th colspan="3"><?php echo 'Total '.$p->lib; ?></th>
                    <th><?php echo afficheMontant2('', $p->montpaye); ?></th>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <th colspan="3"><?php echo 'Total Paiement crédit' ?></th>
                    <th><?php echo afficheMontant2('',$totpaiementcredit); ?></th>
                </tr>
            </tbody>

            
        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c',array(82,5000),0,'',0,0,0,0,0,0);
$mpdf->WriteHTML($body);
$mpdf->Output("Liste paiement credit.pdf", "I");
