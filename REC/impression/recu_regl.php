<?php
//session_start();
include_once '../../impression/mpdf60/mpdf.php';
include_once '../../bdd/connexion.php';
include_once '../../FUNCTION/hebergement.php';

if (!isset($_SESSION)) {
    session_start();
}
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
include("Numbers/Words.php");
// créer l'objet
$lettre = new Numbers_Words();
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
        <table id="tab_title" border="0" width="780" align="center">
           <tr>
                <td>
                    <img src="../images/logo_entreprise/<?php echo $logo; ?>" width="70" height="70">
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
                </td>

            </tr>
            <tr>
                <td height="50" colspan="4" align="center">
                    <u><h3><strong>RECU N°<?php echo ' '.$_SESSION['num_recu'];?></strong></h3></u></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="center" bgcolor="#CCCCCC" width="150"><strong>
                    <?php echo afficheMontant($_SESSION['mon_aff'],$_SESSION['montant_paye']); ?>
                </strong></td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150">Reçu de :</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="nom" style="" align="left"><i><?php echo $_SESSION['nom_client'];?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150">Montant: </td>
                <td colspan="3" bgcolor="#CCCCCC" align="center">
                    <div id="lettre_usd" style="" align="center">
                        <i><?php
                            if($_SESSION['mon_aff']==getsymbole_devise()){
                                echo $lettre->toWords($_SESSION['montant_paye']) . ' ' . ' Dollar';
                            }else{
                                echo $lettre->toWords($_SESSION['montant_paye']) . ' ' . ' Franc Congolais';
                            }
                            ?>
                        </i>
                    </div>
              </td>
            </tr>
            <tr>
                <td colspan="4">  </td>
            </tr>
            <tr>
                <td>Motif :</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="pour" style="" align="left"><i><?php echo $_SESSION['motif_fact'];?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="50">  </td>
            </tr>
            <tr>
                <td align="center">
                    <span style="margin-left:280px; font-weight:bold;"> </span>
                </td>
                <td colspan="2" align="center">
                    <span style="margin-left:100px; font-weight:bold;">Réceptionniste</span>
                </td>
                <td align="center">
                    <span style="margin-left:280px; font-weight:bold;"></span>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <span style="margin-left:45px; font-weight:bold;"> </span>
                </td>
                <td colspan="2" align="center"> <?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']);?></td>
                <td align="center"></td>
            </tr>
            <tr>
                <td colspan="4" height="15"> </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2" align="right"> 
                    <div id="date">
                        Kinshasa, le  <?php echo $date = date('d/m/Y');
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

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c', array(210,120), '', '', 0, 0, 5, 0, 5, 5);
$mpdf->WriteHTML($body);
$mpdf->Output("Bon sortie caisse.pdf", "I");