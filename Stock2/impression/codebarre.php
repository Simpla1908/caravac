<?php
session_start();
include_once '../../impression/mpdf60/mpdf.php';
include '../../FUNCTION/hebergement.php';
include '../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include './barcode128.php';

$id_prod=$_POST['produit_id'];
$text=rand();

//$company_id = $_SESSION['company_id'];
// requette pour la selection des sites
$requete_idhotel = $bdd->prepare("SELECT * FROM  stk_produit WHERE idprod=:idprod");
$requete_idhotel->BindParam(':idprod', $id_prod);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $designation = $donnees['designation'];
    $prix = $donnees['pa'];
    $code = $donnees['code'];
    $monnaie = $donnees['monnaie'];
}
///* Fin de la Recuperation des coordonnées de l'sites */
//$s_famille_id = $_GET['s_famille_id'];
//$date_rapport = $_GET['date_rapport'];
//$date_rapport_f = format_stringdateTodatetime('Y-m-d', $date_rapport, "d/m/Y");

ob_start();
?>

<!--<style>
    *
    {
        margin:0;
        padding:0;
        font-family:helvetica;
        font-size:10pt;
        color:#000; 
    }
    #titre
    {
        margin-bottom:5px;
    }
    #table
    {
        width:100%;
        border-left: 0.5px solid #000;
        border-top: 0.5px solid #000;
        border-spacing:0;
        border-collapse: collapse; 
        font-family: helvetica; 

    }
    #table th
    {
        background:#eee;
        border:0.5px solid #000;
        height:10px;
        padding: 1mm;
        text-transform: uppercase;
        /*font-weight:bold;*/
    }
    #table td{
        border-right: 0.5px solid #000;
        border-bottom: 0.5px solid #000;
        padding: 1mm;
    }
    .page
    {
        height:297mm;
        width:210mm;
        page-break-after:always;
    }
    #entete{
        text-align: center;
        text-transform: uppercase;
        padding-top: 35px;
        padding-bottom: 15px;
        font-family: helvetica;
    }
    #entete1{
        margin-top: 55px;
        margin-right: 70px;
    }
</style>-->

<div id="content">
    <div id="entete1" align="right">
        
    </div>
    <div id="entete">
        <center>
            <div style="height: 30%; width: 50%;">
                <p><?php echo $prix.' '.$monnaie; ?></p>
                <p><?php echo bar128(stripcslashes($code)); ?></p>
                <p><?php echo strtoupper($designation); ?></p>
                
            </div>
        </center>
        
        <!--<button onclick="windows.print()">Imprimer</button>-->
        <!--<h3><u> INVENTAIRE </u></h3>-->
    </div>
   
</div>


<?php
//$body = ob_get_clean();
//$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
//
////Entete et pied de page
//include './entete_pied_page.php';
//$mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 15, 20, 5, 5);
//$mpdf->SetDisplayMode('fullpage');
//$mpdf->SetHTMLHeader($header);
//$mpdf->SetHTMLFooter($footer);
////        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
//
//$mpdf->WriteHTML($body);
//$mpdf->Output("Codebarre.pdf", 'I');
