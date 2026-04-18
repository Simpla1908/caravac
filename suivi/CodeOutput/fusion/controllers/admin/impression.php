<?php

//IMPRESSION////////////////////////////////////////////////////	
include './libraries/mpdf60/mpdf.php';
include_once(APP_FOLDER . '/models/objects/t_hotel.php');
$siteobj = new t_hotel_model();
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
$hrs_sys = date('H:i') . ':00';
include(APP_FOLDER . '/views/admin/impression/entete_pied_page.php');
ob_start();
if (get('do') == 'dtventegl'){
    $bdd = HDB::hus();
    $site_id=get('site_id');
    $niveau=get('niveau');
    $nomsite=get('site');
    $id = $_SESSION['company_id'];
    if($site_id!=0){
      $id =$site_id;
    }
    $dte1 =dateToformatBdd(get('dte1'));
    $dte2 =dateToformatBdd(get('dte2'));
    $dte1_af = dateAffiche($dte1);
    $dte2_af = dateAffiche($dte2);
    $description =' du ' . $dte1_af . ' au ' . $dte2_af;
    DetailsVenteGlobal($id,$dte1,$dte2, $niveau, $bdd);
    $nbre_rows = count($_SESSION['prod']['id']);
include(APP_FOLDER . '/views/admin/impression/detailsventeglobal.php');
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->Output("Details ventes.pdf", "I");
}elseif(get('do') == 'printstock'){
    $fiche=get('stk');
    $articles=$_SESSION['articles'];
    if($fiche=='sos'){
      include(APP_FOLDER.'/views/admin/impression/sos.php');  
    }else{
      include(APP_FOLDER.'/views/admin/impression/fiche_de_stock.php'); 
    }
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 15, 15, 15, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Fiche de stock.pdf", "I");
}
