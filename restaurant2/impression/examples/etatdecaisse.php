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
$musd='';
$data=$_SESSION['data_etatcaisse'];
$nbre=count($data['libelle']);
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <!--<h1>Thank You!</h1>-->
        <table style="margin:auto; font-family: monospace; font-size: 14px;">
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
                    <td colspan="3" height="5"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3">
                    <b>ETAT DE CAISSE(<?php echo $_SESSION['m_affiche'] ?>)</b>
                    <br>
                        <?php echo $data['periode'];  ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="5"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"></td>
                </tr>
                
                <tr>
                    <td><b>LIBELLE</b></td>
                    <td><b>ENTREE</b></td>
                    <td><b>SORTIE</b></td>
                </tr>
                <?php
                    $totalentree=0;
                    $totalsortie=0;
                    for ($i = 0; $i <= $nbre - 1; $i++) {
                        $libelle =$data['libelle'][$i];
                        $montant =$data['usdcdf'][$i];
                        $type =$data['type'][$i];
                        $montantentree=0;
                        $montantsortie=0;
                        if($type==1){
                            $montantentree=$montant;
                            $montantsortie=0;
                            $totalentree+=$montantentree;
                        }else{
                            $montantentree=0;
                            $montantsortie=$montant;
                            $totalsortie+=$montantsortie;
                        }
                     ?>
                <tr>
                    <td><b><?php echo  $libelle?></b></td>
                    <td align="center" ><b><?php 
                         if($montantentree>0){
                            echo  afficheMontant2($musd,$montantentree);
                        }
                     ?></b>
                     </td>
                    <td align="center" >
                        <b>
                            <?php 
                                if($montantsortie>0){
                                    echo  afficheMontant2($musd,$montantsortie);
                                }
                            ?>
                        </b>
                     </td>
                </tr>
                <?php }
                    $solde=round($totalentree,2)-round($totalsortie,2);
                ?>
                <tr>
                    <th>TOTAL</th>
                    <th><?php echo afficheMontant2($musd,$totalentree);?></th>
                    <th><?php echo afficheMontant2($musd,$totalsortie);?></th>
                </tr>
                <tr>
                    <th>SOLDE</th>
                    <th colspan="2" align="center"><?php echo $solde;?></th>
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
unset($_SESSION['data_etatcaisse']);
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

$mpdf = new mPDF('c',array(82,5000),0,'', 0, 0, 0, 0,0,0);

$mpdf->WriteHTML($body);
$mpdf->Output("Etat de caisse.pdf", "I");