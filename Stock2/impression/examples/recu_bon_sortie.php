<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../../mpdf/mpdf60/mpdf.php';
include '../../bdd/connexion.php';

//Fusion horaire
date_default_timezone_set('Europe/Paris');

$company_id = $_SESSION['company_id'];

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
//    $compte_bancaire = $donnees['compte_bancaire'];
//    $mention = $donnees['mention'];
}

// requette pour la selection des sites
$requete_idhotel = $bdd->prepare("SELECT nom_hotel,adresse_hotel, province_hotel, ville_hotel FROM  t_hotel WHERE company_id=:company_id");
$requete_idhotel->BindParam(':company_id', $company_id);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $nom_hotel = $donnees['nom_hotel'];
    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
}
/* Fin de la Recuperation des coordonnées de l'hotel */

include '../../Traitement/operation_motif_edit.php';
//include('../../ChiffresEnLettres.php');
//$lettre = new ChiffreEnLettre();
$be_id=$_GET['id'];
$type=$_GET['type'];
$operation_motifs=  getoperation_motif($be_id,$bdd);
foreach ($operation_motifs as $operation):
    $numBon= $operation->num_bon;
    $produit=$operation->designation;
    if($operation->type=='sortie'){
        $qte=$operation->qte_sortie;
    }else{
        $qte=$operation->qte_entree;
    }
    $dte_appro_heure= $operation->dte_appro_heure;
endforeach;

ob_start();
?>
<style>
        #tab_title
        {

            /*font-weight:bold;*/
            _font-family:Segoe UI Light;
        }
        #label
        {
            _position:absolute;
            _z-index:1;
            margin-top:20px;
            margin-left:530px;
            /*font-weight:bold;*/
        }
        #content
        {
            border:1px solid #000;
            height:400px;
            width:720px;
            margin:auto;
            margin-top:20px;
            padding: 10px;

        }
        #chiffre
        {
            /*        position:relative;
                    top:-352px;
                    left:500px; */
            border:1px solid #000;
            width:350px;
            padding:10px;
            font-weight:bold;
            font-size:16px;
            background-color:#CCC;

        }
        #nom
        {
            position:relative;
            top:65px;
            left:145px;

            width:538px;
            padding:2px;
            padding-left:20px;
            font-weight:bold;
            font-size:18px;
            /*background-color:#CCC;*/

        }
        #lettre_usd
        {
            position:relative;
            top:20px;
            left:115px;
            width:577px;
            padding:2px;
            padding-left:10px;
            font-weight:bold;
            font-size:18px;
            background-color:#CCC;

        }
        #lettre_fc
        {
            position:relative;
            top:8px;
            left:28px;
            width:665px;
            padding:2px;
            padding-left:10px;
            font-weight:bold;
            font-size:18px;
            background-color:#CCC;

        }
        #pour
        {
            position:relative;
            top:12px;
            left:63px;
            width:555px;
            padding:2px;
            padding-left:80px;
            font-weight:bold;
            font-size:18px;
            /*background-color:#CCC;*/

        }
        #date
        {
            position:relative;
            top:30px;
            left:460px;
            /*border:1px solid #000; */
            width:200px;
            padding:2px;

        }
    </style>
<!--<page format="130x200" orientation="L" backcolor="#fff" style="font: arial;">-->
    <div id="content">
        <table id="tab_title" border="0" width="500" align="center">
            <tr>
                <td>
                    <img src="../../../REC/images/logo_entreprise/<?php echo $logo;?>" height="70" width="80"/>
                </td>
                <td>

                </td>
                <td colspan="2" align="right">
                    <div style="border: 1px solid #ffffff; width: 300px; padding: 3px; padding-left: 8px;">
                        <strong>   <?php echo strtoupper($nom_hotel);?>.</strong><br />
                        ID-Nat : <?php echo $idnat;?> -- RCCM : <?php echo $rccm;?> -- N° Impôt : <?php echo $num_impot;?>
                        <br />
                        Téléphone : <?php echo $telephone;?> -- Email : <?php echo $email_compagny;?>
                    </div>
                    <!--                    <div style="border: 1px solid #ffffff; width: 200px; margin-top: -80px; margin-left: 305px; padding: 3px;">
                        <strong>   <?php echo strtoupper($nom_hotel);?>.</strong>
                        <br /><br />
                        Adresse : <?php echo $adresse_hotel;?>
                        <br />
                        Ville : <?php echo $ville_hotel;?>
                        <br />
                        Province : <?php echo $province_hotel;?>
                    </div>-->
                </td>
            </tr>
            <tr>
                <td height="50" colspan="4" valign="top" align="center">
                    <u><h3><strong>BON <?php if($type=='sortie'){echo 'DE SORTIE';}else{ echo 'D\'ENTREE';}?> STOCK</strong></h3></u>
                </td>
            </tr>
            <tr>
                <td width="142" height="21">N° Bon </td>
                <td colspan="3"><div id="nom" style="" align="left"><i>: <?php echo $numBon;?></i></div></td>

            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td height="21" style="width:120px;">Produit </td>
                <td width="400"><div id="nom" style="" align="left"><i>: <?php echo $produit;?></i></div></td>
                <td width="59" style="width:100px;">Quantité:</td>
                <td width="81"><div id="nom" style="" align="left"><i>: <?php echo $qte;?></i></div></td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td height="21">Date <?php if($type=='sortie'){echo 'de Sortie';}else{ echo 'd\'Entrée';}?></td>
                <td colspan="3"><div id="pour" style="" align="left"><i>: <?php echo $dte_appro_heure;?></i></div></td>
            </tr>
            <tr>
                <td colspan="4" height="50">  </td>
            </tr>
            <tr>
                <?php if($type=='sortie'){
                    $col=1;
                    $disp='block';
                    $type='sortie';
                }else{ 
                    $col=2;
                    $disp='none';
                    $type='entree';
                }?>
                <td>
                    <span style="margin-left:100px; font-weight:bold;"> Chargé de Stock</span>
                </td>
                <td colspan="<?php echo $col; ?>" align="center">
                    <span style="margin-left:280px; font-weight:bold;">Visa de la Direction</span>
                </td>
                <?php if($type=='sortie'){?>
                    <td colspan="1">
                        <span style="margin-left:280px; font-weight:bold;">Béneficaire</span>
                    </td>
                <?php } ?>
                
            </tr>
            <tr>
                <td colspan="4">
                    <span style="margin-left:100px; font-weight:bold;"> </span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span style="margin-left:330px; font-weight:bold;"> <?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']);?></span>
                </td>
                <td colspan="<?php echo $col; ?>">
                </td>
                <td colspan="1" style="display:<?php echo $disp; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="4" height="15">  </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2" align="right">
                    <div id="date">
                        Fait à Kinshasa, le  <?php echo $date = date('d/m/Y');
                        unset($_SESSION['operation_last_id']);
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<!--</page>-->
<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

$mpdf = new mPDF('c', array(210,120), '', '', 0, 0, 5, 0, 5, 5);
$mpdf->WriteHTML($body);
$mpdf->Output("Bon ".$type." stock.pdf", "I");