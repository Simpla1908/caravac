<?php
//IMPRESSION////////////////////////////////////////////////////  
include './libraries/mpdf60/mpdf.php';
include("./libraries/Numbers/Words.php");
include_once(APP_FOLDER . '/models/objects/t_hotel.php');
include_once(APP_FOLDER . '/models/objects/Panier.php');
$siteobj = new t_hotel_model();
$panier = new Panier();
$idsite = $_SESSION['idsite'];
$monnaie_aff = $_SESSION['Paie_affiche'];
$monnaie_ins = $_SESSION['Paie_insert'];
$site = $siteobj->Infos($idsite);
$nomcomp = $site->nom_hotel;
$ville_hotel = $site->ville_hotel;
$logo = $site->logo;
$adresse_c = $site->adresse_hotel;
$email_compagny = $site->mail_company;
$telephone = $site->phone;
$idnat = $site->idnat;
$rccm = $site->rccm;
$checkin = $_SESSION['checkin'];
$checkout = $_SESSION['checkout'];
$hrs_sys = date('H:i') . ':00';
include(APP_FOLDER . '/views/admin/impression/entete_pied_page.php');
ob_start();
if (get('do') == 'journal') {
    $journal_id = get('journal_id');
    if ($journal_id == 1) {
        include(APP_FOLDER . '/views/admin/impression/journalachat.php');
    } else if ($journal_id == 2) {
        include(APP_FOLDER . '/views/admin/impression/journalvente.php');
    } else if ($journal_id == 3) {
        include(APP_FOLDER . '/views/admin/impression/journalcaisse.php');
    } else if ($journal_id == 4) {
        include(APP_FOLDER . '/views/admin/impression/journalbanque.php');
    }
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("journal.pdf", "I");
} else if (get('do') == 'recuencaisse') {
    $bdd = ConnectWithUtf();
    $idoperation = get('id');
    include(APP_FOLDER . '/views/admin/impression/recu_bon.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', array(210, 120), '', '', 0, 0, 5, 0, 5, 5);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Bon entree caisse.pdf", "I");
} else if (get('do') == 'recudecaisse') {
    $bdd = ConnectWithUtf();
    $idoperation = get('id');
    include(APP_FOLDER . '/views/admin/impression/recu_bon_sortie.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', array(210, 120), '', '', 0, 0, 5, 0, 5, 5);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Bon sortie caisse.pdf", "I");
} else if (get('do') == 'encaissementliste') {
    include(APP_FOLDER . '/views/admin/impression/encaissementliste.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste des encaissements.pdf", "I");
} else if (get('do') == 'decaissementliste') {
    include(APP_FOLDER . '/views/admin/impression/decaissementliste.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste des decaissements.pdf", "I");
} else if (get('do') == 'grandlivre') {
    $bdd = ConnectWithUtf();
    $numerocompte = get('numerocompte');
    if ($numerocompte == 0) {
        include(APP_FOLDER . '/views/admin/impression/grandlivre.php');
    } else {
        include(APP_FOLDER . '/views/admin/impression/grandlivreoneaccount.php');
    }
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("grandlivre.pdf", "I");
} else if (get('do') == 'balance') {
    include(APP_FOLDER . '/views/admin/impression/balance.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("balance.pdf", "I");
} else if (get('do') == 'resultat') {
    include(APP_FOLDER . '/views/admin/impression/resultat.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("resultat.pdf", "I");
} else if (get('do') == 'bilan') {
    if ($_SESSION['BilanType'] == 'actif') {
        include(APP_FOLDER . '/views/admin/impression/bilanactif.php');
    } else {
        include(APP_FOLDER . '/views/admin/impression/bilanpassif.php');
    }
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("resultat.pdf", "I");
} else if (get('do') == 'detailsjournal') {
    include(APP_FOLDER . '/views/admin/impression/detailsjournal.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("detailsjournal.pdf", "I");
} else if (get('do') == 'synthesecaisse') {
    include(APP_FOLDER . '/views/admin/impression/synthesecaisse.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("synthesecaisse.pdf", "I");
} else if (get('do') == 'listedescomptes') {
    ini_set("memory_limit", "-1");
    include(APP_FOLDER . '/views/admin/impression/listedescomptes.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("listedescomptes.pdf", "I");
} else if (get('do') == 'detailsprevi') {
    include(APP_FOLDER . '/views/admin/impression/detailsprevi.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("detailsprevi.pdf", "I");
}
