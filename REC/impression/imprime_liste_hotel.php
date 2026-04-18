<?php
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
session_start();

$company_id = $_SESSION['company_id'];
$i = 1;
$type = 'reservation';

$requete_idhotel = $bdd->prepare("SELECT adresse_hotel, province_hotel, ville_hotel FROM  t_hotel WHERE company_id=:company_id");
$requete_idhotel->BindParam(':company_id', $company_id);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {

    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
}
/* Fin de la Recuperation des coordonnées de l'hotel */

$html .= "
<style>
    *
    {
        margin:0;
        padding:0;
        font-family:Arial;
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
        border-left: 1px solid #000;
        border-top: 1px solid #000;

        border-spacing:0;
        border-collapse: collapse; 

    }
    #table th
    {
        background:#eee;
        border:1px solid #000;
        height:20px;
        padding: 2mm;
    }
    #table td{
        border-right: 1px solid #000;
        border-bottom: 1px solid #000;
        padding: 2mm;
    }
    .page
    {
        height:297mm;
        width:210mm;
        page-break-after:always;
    }
</style>


    <div id='content'>
        <div id='titre' align='center'>
            <h3><u><strong>Liste des clients</strong></u></h3>
        </div>
        <table border='1' align='center' id='table'>
            <thead>
                <tr>
                    <th>N°</th>
                    <th valign='middle'>Hotel</th>
                    <th valign='middle'>Adresse</th>
                    <th valign='middle'>Province</th>
                    <th valign='middle'>Ville</th>
                </tr>
            </thead>
            <tbody>";
                $requete_hotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE company_id=:company_id ORDER BY nom_hotel ASC");
                $requete_hotel->BindParam(':company_id', $company_id);
                $requete_hotel->execute();
                while ($donnees = $requete_hotel->fetch()) {
                    $nom_hotel = $donnees['nom_hotel'];
                    $adresse_hotel = $donnees['adresse_hotel'];
                    $province_hotel = $donnees['province_hotel'];
                    $ville_hotel = $donnees['ville_hotel'];
                    ?>

                 <?php $html .= "  <tr>
                        <td>$i</td>
                        <td valign='middle'>$nom_hotel</td>
                        <td valign='middle'>$adresse_hotel</td>   
                        <td valign='middle'>$province_hotel</td>
                        <td valign='middle'>$ville_hotel</td>
                    </tr>";

    
    $i++;
}/* Fin de la boucle while */
?>
           <?php $html .= " </tbody>
        </table>
    </div>";

$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="50%" align="left"><img src="logoKB1.png" /></td>
<td width="50%" align="right"><span style="font-size:12pt;">{PAGENO}</span></td>
</tr></table>
';
$footer = '<div align="center" style="color:blue;font-family:mono;font-size:12pt;font-weight:bold;font-style:italic;border-top: 0.03cm solid #000000;">{DATE j-m-Y} &raquo; '
        .$nom_hotel.'</div>';

$mpdf = new mPDF('c', 'A4');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($html);
$mpdf->Output("liste de sites.pdf", "I");

?>