<?php
include_once"../../../impression/mpdf60/mpdf.php";
$nom_hotel='MEMLING';
if (isset($_GET['page'])) {
    
    $header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="50%" align="left"><img src="logoKB1.png" /></td>
<td width="50%" align="right"><span style="font-size:12pt;">{PAGENO}</span></td>
</tr></table>';
    
$footer = '<div align="center" style="color:blue;font-family:mono;font-size:12pt;font-weight:bold;font-style:italic;border-top: 0.03cm solid #000000;">{DATE j-m-Y} &raquo; '
        .$nom_hotel.'</div>';


switch ($_GET['page']) {
    case 'facture':
        $mpdf = new mPDF('c', 'A4');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

        $mpdf->WriteHTML(file_get_contents('facture.php'));
        $mpdf->Output("Facture.pdf", "I");

        break;
    
    case 'recu':
        $mpdf = new mPDF('c', 'A4');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

        $mpdf->WriteHTML(file_get_contents('recu.php'));
        $mpdf->Output("Recu.pdf", "I");
        
        break;
    
    default:
        break;
}

}
?>