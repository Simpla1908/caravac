<?php
//session_start();
include_once '../../impression/mpdf60/mpdf.php';

if (!isset($_SESSION)) {
    session_start();
}
//Fusion horaire
//date_default_timezone_set('Europe/Paris');

if (isset($_GET['nombre_user']) && isset($_GET['montant'])) {
    $nbre_user=$_GET['nombre_user'];
    $mont_payer = $_GET['montant'];
}

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
                    <img src="../../images/logo_ebtl.png" width="140" height="70">
                </td>
                <td>
                    
                </td>
                <td colspan="2" align="right">
                    Kinshasa, le <?php echo $date = date('d/m/Y');?>
                </td>

            </tr>
            <tr>
                <td height="50" colspan="4" align="center">
                    <u><h2><strong>BON A PAYER</strong></h2></u></td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150">Entreprise :</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="nom" style="" align="left"><i><?php echo ucfirst($_SESSION['nom_hotel']);?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150">Nombre utilisateur :</td>
                <td align="center" bgcolor="#CCCCCC" width="150">
                    <strong>
                        <i><?php echo $nbre_user; ?></i>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150">Montant :</td>
                <td align="center" bgcolor="#CCCCCC" width="150">
                    <strong>
                        <i><?php echo $mont_payer.' $'; ?></i>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150"> </td>
                <td colspan="3" bgcolor="#CCCCCC" align="center">
                    <div id="lettre_usd" style="" align="center">
                        <i><?php echo $lettre->toWords($mont_payer) . ' ' . ' dollar';?></i>
                    </div>
              </td>
            </tr>
            <tr>
                <td colspan="4">  </td>
            </tr>
            <tr>
                <td>Motif :</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="pour" style="" align="left"><i><?php echo 'Ajout des utilisateurs';?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="20">  </td>
            </tr>
            <tr>
                <td align="center">
                    <span style="margin-left:280px; font-weight:bold;"> </span>
                </td>
                <td colspan="3">
                    <span style="margin-left:100px;">
                        Veuillez passez dans nos installations pour payer l'ajout des utilisateurs. L'activation se fera après paiement.<br>
                        <strong> Adresse:</strong> 273 Nyangwe C/ Lingwala  Kinshasa - RDC, 
                        <strong> Télephone:</strong> +243 85 464 66 79 <br><br>
                        
                        <strong> Banque:</strong> Trust Merchant Bank (TMB), 
                        <strong> N°Compte:</strong> 1201-5661768-00-19, 
                        <strong> Nom Compte:</strong> KITUNGA SARLU
                    </span>
                </td>
                
            </tr>
            <tr>
                <td colspan="4" height="15"> </td>
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
$mpdf->Output("Bon à payer.pdf", "I");