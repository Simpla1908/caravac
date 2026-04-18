<?php
session_start();
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';

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
ob_start();
?>
<style>
    #tab_title
    {

        /*font-weight:bold;*/
        _font-family:Segoe UI Light;
        font-size:16px;
        /*margin-top: -20px;*/
    }
    #label
    {
        _position:absolute;
        _z-index:1;
        margin-top:20px;
        margin-left:530px;
        /*font-weight:bold;*/
    }
    #content1
    {
        border:1px solid #000;
        /*        height:450px;
                width:1200px;*/
        margin:auto;
        margin-top:20px;

    }
    #chiffre
    {
        position:relative;
        top:-352px;
        left:500px;
        border:1px solid #000;
        width:200px;
        padding:2px;
        font-weight:bold;
        font-size:20px;
        background-color:#CCC;

    }
    #nom
    {
        /*position:relative;
        top:63px;
        left:105px; */
        border-bottom:1px solid #000;
        font-weight:bold;
        font-size:16px;
        width:538px;
        /*padding:2px;
        padding-left:20px;
        font-weight:bold;
        font-size:16px;
        background-color:#CCC;*/

    }
    #lettre_usd
    {
        position:relative;
        top:17px;
        left:132px;
        border:1px solid #000;
        width:562px;
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
        border:1px solid #000;
        width:665px;
        padding:2px;
        padding-left:10px;
        font-weight:bold;
        font-size:18px;
        background-color:#CCC;

    }
    #pour
    {
        /*position:relative;
        top:17px;
        left:135px; */
        border-bottom:1px solid #000;
        font-weight:bold;
        font-size:18px;
        /*width:490px;
        padding:2px;
        padding-left:80px;
        font-weight:bold;
        font-size:18px; */
        /*background-color:#CCC;*/

    }
    #date
    {

        left:60px;
        /*border:1px solid #000; */


    }
</style>
<!--<page format="130x200" orientation="L" backcolor="#fff" style="font: arial;">-->
<div id="content">
    <table id="tab_title" border="0" width="900" align="center">
        <tr>
            <td colspan="4" height="50">  </td>
        </tr>
        <tr>
            <td height="15" >
                <img src="../images/logo_entreprise/<?php echo $logo; ?>" height="150" width="180"/>
            </td>
            <td height="15" width="350">
                <div style="border: 1px solid #ffffff; width: 300px; padding: 3px; padding-left: 8px;">
                    <br />

                </div>
            </td>
            <td height="15" colspan="2" >
                <div style="border: 1px solid #ffffff; width: 200px; margin-top: -80px; margin-left: 305px; padding: 3px;">
                    <h2>   <?php echo strtoupper($nom_hotel); ?>.</h2>
                    <br /><br />
                    Adresse : <?php echo $adresse_hotel; ?>
                    <br />
                    Ville : <?php echo $ville_hotel; ?>
                    <br />
                    Province : <?php echo $province_hotel; ?>
                </div>
            </td>
        </tr>
        <tr>
            <td height="150" colspan="4" valign="middle" align="center">
                <hr>
                <h1>
                    <!--                            <font color="red">-->
                    BON DE VERSEMENT CAISSE
                    <!--</font>-->
                </h1>
                <hr>
            </td>
        </tr>
        <tr>
            <td width="300" height="60"><h2>Agent </h2></td>
            <td colspan="3"><h2> : &nbsp;&nbsp;&nbsp;<?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?> </h2></td>
        </tr>
        <tr>
            <td colspan="4" height="10">  </td>
        </tr>
        <tr>
            <td colspan="4" height="10">  </td>
        </tr>
		<tr>
            <td height="60"><h2>Libellé</h2></td>
            <td colspan="3"><h2> : &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['nomlibelle']; ?> </h2></td>
        </tr>
        <tr>
            <td colspan="4" height="10">  </td>
        </tr>
        <tr>
            <td height="60"><h2>Montant en USD </h2></td>
            <td colspan="3"><h2> : &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['montant_usd']; ?> </h2></td>
        </tr>
        <tr>
            <td colspan="4" height="10">  </td>
        </tr>
        <tr>
            <td height="60"><h2>Montant en CDF </h2></td>
            <td colspan="3"><h2> : &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['montant_cdf']; ?></h2></td>
        </tr>
        <tr>
            <td colspan="4" height="13">  </td>
        </tr>
        <tr>
            <td colspan="4">
                <span style="margin-left:490px;"> </span>
            </td>
        </tr>
        <tr>
            <td colspan="4" height="10">  </td>
        </tr>
        <tr>
            <td colspan="2" align="center"></td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td align="center" colspan="3"><h2><b>BILLETAGE</b></h2>
            <hr>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="15"></td>
        </tr>
        <tr>
            <td colspan="3"><b>1. USD</b></td>
        </tr>
        <tr>
            <td colspan="3" height="10"></td>
        </tr>
        <tr>
            <td><b>BILLETS</b></td>
            <td><b>NOMBRES</b></td>
            <td><b>TOT.</b></td>
        </tr>
        <tr>
            <td>100 USD</td>
            <td><?php echo $_SESSION['100usd']; ?></td>
            <td>
                <?php
                $tot100 = $_SESSION['100usd'] * 100;
                echo afficheMontant('USD', $tot100);
                ?>
            </td>
        </tr>
        <tr>
            <td>50 USD</td>
            <td><?php echo $_SESSION['50usd']; ?></td>
            <td>
                <?php
                $tot50 = $_SESSION['50usd'] * 50;
                echo afficheMontant('USD', $tot50);
                ?>
            </td>
        </tr>
        <tr>
            <td>20 USD</td>
            <td><?php echo $_SESSION['20usd']; ?></td>
            <td>
                <?php
                $tot20 = $_SESSION['20usd'] * 20;
                echo afficheMontant('USD', $tot20);
                ?>
            </td>
        </tr>
        <tr>
            <td>10 USD</td>
            <td><?php echo $_SESSION['10usd']; ?></td>
            <td>
                <?php
                $tot10 = $_SESSION['10usd'] * 10;
                echo afficheMontant('USD', $tot10);
                ?>
            </td>
        </tr>
        <tr>
            <td>5 USD</td>
            <td><?php echo $_SESSION['5usd']; ?></td>
            <td>
                <?php
                $tot5 = $_SESSION['5usd'] * 5;
                echo afficheMontant('USD', $tot5);
                ?>
            </td>
        </tr>
        <tr>
            <td>1 USD</td>
            <td><?php echo $_SESSION['1usd']; ?></td>
            <td>
                <?php
                $tot1 = $_SESSION['1usd'] * 1;
                echo afficheMontant('USD', $tot1);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Total</b></td>
            <td>
                <b>
                    <?php
                    $totgen1 = $tot1 + $tot5 + $tot10 + $tot20 + $tot50 + $tot100;
                    echo afficheMontant('USD', $totgen1);
                    ?>
                </b> 
            </td>
        </tr>
        <tr>
            <td colspan="3" height="15"></td>
        </tr>
        <tr>
            <td colspan="3"><b>2. CDF</b></td>
        </tr>
        <tr>
            <td colspan="3" height="10"></td>
        </tr>
        <tr>
            <td><b>BILLETS</b></td>
            <td><b>NOMBRES</b></td>
            <td><b>TOT.</b></td>
        </tr>
        <tr>
            <td>20.000 CDF</td>
            <td><?php echo $_SESSION['20000cdf']; ?></td>
            <td>
                <?php
                $totcdf1 = $_SESSION['20000cdf'] * 20000;
                echo afficheMontant('CDF', $totcdf1);
                ?>
            </td>
        </tr>
        <tr>
            <td>10.000 CDF</td>
            <td><?php echo $_SESSION['10000cdf']; ?></td>
            <td>
                <?php
                $totcdf2 = $_SESSION['10000cdf'] * 10000;
                echo afficheMontant('CDF', $totcdf2);
                ?>
            </td>
        </tr>
        <tr>
            <td>5.000 CDF</td>
            <td><?php echo $_SESSION['5000cdf']; ?></td>
            <td>
                <?php
                $totcdf3 = $_SESSION['5000cdf'] * 5000;
                echo afficheMontant('CDF', $totcdf3);
                ?>
            </td>
        </tr>
        <tr>
            <td>1000 CDF</td>
            <td><?php echo $_SESSION['1000cdf']; ?></td>
            <td>
                <?php
                $totcdf4 = $_SESSION['1000cdf'] * 1000;
                echo afficheMontant('CDF', $totcdf4);
                ?>
            </td>
        </tr>
        <tr>
            <td>500 CDF</td>
            <td><?php echo $_SESSION['500cdf']; ?></td>
            <td>
                <?php
                $totcdf5 = $_SESSION['500cdf'] * 500;
                echo afficheMontant('CDF', $totcdf5);
                ?>
            </td>
        </tr>
        <tr>
            <td>200 CDF</td>
            <td><?php echo $_SESSION['200cdf']; ?></td>
            <td>
                <?php
                $totcdf6 = $_SESSION['200cdf'] * 200;
                echo afficheMontant('CDF', $totcdf6);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Total</b></td>
            <td>
                <b>
                    <?php
                    $totgen2 = $totcdf6 + $totcdf5 + $totcdf4 + $totcdf3 + $totcdf2 + $totcdf1;
                    echo afficheMontant('CDF', $totgen2);
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="30"></td>
        </tr>
        <tr>
            <td colspan="4" valign="middle" align="center">
                <hr>
            </td>
        </tr>
        <tr>
            <td height="14" colspan="2">
                <span style="margin-left:45px; font-weight:bold;"> Réceptionniste</span>
            </td>
            <td height="14" colspan="2">
                <span style="margin-left:45px; font-weight:bold;"> Fait à  <?php echo ucfirst($ville_hotel) ; ?>, le  <?php echo $date = date('d/m/Y'); ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="4" height="15">  </td>

        </tr>
    </table>
</div>
<!--</page>-->
<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
//include './entete_pied_page.php';
$mpdf = new mPDF('c', 'A4-L', 12, '', 0, 0, 0, 0, 0, 0, 'P');
//$mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Bonversementcaisse.pdf", "I");
