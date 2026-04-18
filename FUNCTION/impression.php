<?php
function imprimer($data) {
     $mpdf = new mPDF('c', 'A4');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
        $mpdf->WriteHTML(file_get_contents('facture.php'));
        $mpdf->Output("Facture.pdf", "I");
    
}

