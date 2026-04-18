<?php
include_once '../';
include '../bdd/connexion.php';
session_start();
//Fusion horaire
date_default_timezone_set('Europe/Paris');
ob_start();
?>

<style>
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
</style>

    <div id="content">
        <div id="entete1" align="right">
            <span>Kinshasa, </span><?php echo $date_heure_bon; ?>
        </div>
        <div id="entete">
            <h3><u>FICHE DE STOCK DES PRODUITS</u></h3>
            <h4>(Catégorie: <?php  foreach ($mouvements as $ap): echo $ap->designation; endforeach;?>)</h4>
        </div>
      
    </div>


<?php

$body = ob_get_clean();
$body = iconv("UTF-8","UTF-8//IGNORE",$body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c','A4','','',15,15,15,20,5,5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Fiche de stock.pdf", "I");


