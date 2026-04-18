<?php
if (!isset($_SESSION)) {
    session_start();
}
//ini_set('memory_limit', '500M');
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

$company_id = $_SESSION['company_id'];
$m_affiche = $_SESSION['m_affiche'];
$id_sousresto=$_SESSION['id_sousresto'];
//Selection des company
$requete_company = $bdd->prepare("SELECT * FROM  t_company WHERE id_c=:company_id");
$requete_company->BindParam(':company_id', $company_id);
$requete_company->execute();
while ($donnees = $requete_company->fetch()) {

    $nom_c = $donnees['nom_c'];
    $adresse_c = $donnees['adresse_c'];
    $ville = $donnees['ville'];
    $logo = $donnees['logo'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['mail_company'];
    $compte_bancaire = $donnees['compte_bancaire'];
    $mention = $donnees['mention'];
}

// requette pour la selection des sites
$requete_idhotel = $bdd->prepare("SELECT adresse_hotel, province_hotel, ville_hotel FROM  t_hotel WHERE company_id=:company_id");
$requete_idhotel->BindParam(':company_id', $company_id);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {

    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
}
/* Fin de la Recuperation des coordonnées de l'hotel */
$site_id=$_SESSION['id_hotel'];
$site = getInfosSite($site_id, $bdd);
$site_id=$_SESSION['id_hotel'];
$data=$_SESSION['data_versement'];
$nbre=count($data['ventes']['mode']);
$musd='';
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <!--<h1>Thank You!</h1>-->
        <table  style="margin:40px; font-family: monospace; font-size: 13px;">
            <tbody id="entries">
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($site->nom_hotel) ?>
                        </b> <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto']) ?>)</b><br>
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
                    <td align="center" colspan="3">
                    <b>RAPPORT DES VERSEMENTS</b>
                    <br>
                        <?php echo $data['periode'];  ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"></td>
                </tr>
                <tr>
                    <td colspan="3" height="5"></td>
                </tr>
                <tr>
                    <td><b></b></td>
                    <td colspan="2"> </td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-bottom: 1px solid black;"><b>VENTES</b></td>
                </tr>
                <?php
                    for ($i = 0; $i <= $nbre - 1; $i++) {
                        $mode =$data['ventes']['mode'][$i];
                        $montant =$data['ventes']['montant'][$i];
                    ?>
                    <tr>
                        <td><b><?php echo $mode; ?></b></td>
                        <td colspan="2" align="center" ><b><?php echo afficheMontant2($m_affiche,$montant); ?></b></td>

                    </tr>
                <?php } ?>

                <tr>
                    <td><b>TOTAL</b></td>
                    <td colspan="2" align="center"><b><?php echo afficheMontant2($m_affiche,$data['ventes']['total']); ?></b></td>
                </tr>
                <tr>
                    <td colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-bottom: 1px solid black;"><b>CAISSE(<?php echo $m_affiche;?>)</b></td>
                </tr>
                <tr>
                    <td><b>F.D.C</b></td>
                    <td colspan="2" align="center" ><b><?php echo  afficheMontant2($musd,$data['fdc']); ?></b></td>
                </tr>
                <tr>
                    <td><b>CASH</b></td>
                    <td colspan="2" align="center" ><b><?php echo afficheMontant2($musd,$data['totcash']); ?></b></td>

                </tr>
                <tr>
                    <td><b>PAIEMENT CREDIT</b></td>
                    <td colspan="2" align="center" ><b><?php echo afficheMontant2($musd,$data['totpaiementcredit']); ?></b></td>
                </tr>
                <tr>
                    <td><b>DEPENSE</b></td>
                    <td colspan="2" align="center" ><b><?php echo afficheMontant2($musd,$data['totdepense']); ?></b></td>
                </tr>
                <tr>
                    <td><b>SOLDE VIRTUEL</b></td>
                    <td colspan="2" align="center" ><b><?php echo afficheMontant2($musd,$data['soldevirtuel']); ?></b></td>

                </tr>

                <tr>
                    <td><b>SOLDE PHYSIQUE</b></td>
                    <td colspan="2" align="center" ><b><?php echo afficheMontant2($musd,$data['soldephys']); ?></b></td>

                </tr>
                <tr>
                    <td><b>BALANCE</b></td>
                    <td colspan="2" align="center" ><b><?php 
                    //Balance
                     echo afficheMontant2($musd,$data['balance']); ?></b></td>
                </tr>
                <tr>
                    <td><b>FONDS DE CAISSE DU LENDEMAIN</b></td>
                    <td colspan="2" align="center" ><b><?php echo afficheMontant2($musd,$data['fdcldm']); ?></b></td>
                </tr>
                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                        <b>
                            Imprimé par <?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?> , le <?php echo $date = date('d/m/Y H:i:s'); ?><br>
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php

                            
?>
<?php
unset($_SESSION['data_versement']);
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

$mpdf = new mPDF('c', array(82, 5000), 0,'', 0, 0, 0, 0, 0, 0);

$mpdf->WriteHTML($body);
$mpdf->Output("Bon de versement.pdf", "I");