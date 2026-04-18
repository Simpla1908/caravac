<?php

//IMPRESSION////////////////////////////////////////////////////	
include './libraries/mpdf60/mpdf.php';
include_once(APP_FOLDER . '/models/objects/t_hotel.php');
include_once(APP_FOLDER . '/models/objects/ressalaire.php');
include_once(APP_FOLDER . '/models/objects/resemployes.php');
include(APP_FOLDER . '/models/objects/respointage.php');
include(APP_FOLDER . '/models/objects/resemprunt.php');
include(APP_FOLDER . '/models/objects/ach_livraison.php');
include(APP_FOLDER . '/models/objects/ach_produits_livres.php');
include(APP_FOLDER . '/models/objects/lignes_commandes.php');
include(APP_FOLDER . '/models/objects/t_facture.php');
$siteobj = new t_hotel_model();
$salaireobj = new ressalaire_model();
$employeobj = new resemployes_model();
$pointobj = new respointage_model();
$emprunt_obj = new resemprunt_model();
$livraison_obj = new ach_livraison_model();
$produits_livObj = new ach_produits_livres_model();
$ligne_cmd_obj = new lignes_commandes_model();
$commande_obj = new t_facture_model();

$idsite = $_SESSION['idsite'];
$site = $siteobj->Infos($idsite);
$ville_hotel=$site->ville_hotel;
$logo=$site->logo1;
$adresse_c=$site->adrcomp;
$email_compagny=$site->mail_company;
$telephone=$site->phone;
$idnat=$site->idnat;
$rccm=$site->rccm;
include(APP_FOLDER . '/views/admin/impression/entete_pied_page.php');
ob_start();
if (get('do') == 'bon_livraison') {
    $result =$livraison_obj->SelectProduitLiv($_SESSION['id_liv']);
    include(APP_FOLDER . '/views/admin/impression/bon_livraison.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c','A4','','',15,15,30,20,5,5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("bon_livraison.pdf", "I");
}elseif (get('do')=='listeliv'){
  //LISTE DE LIVRAISON numboncmd
    include(APP_FOLDER . '/views/admin/impression/listelivraison.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c','A4-L','','',15,15,30,20,5,5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste de livraisons.pdf", "I");
}elseif (get('do')=='numboncmd'){
  //NUM BON CMD 
    $id_fact = get('id_fact');
    $rows = $commande_obj->SelectOneBesoin(get('id_fact'));
    $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
    include(APP_FOLDER . '/views/admin/impression/bon_commande.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c','A4','','',15,15,30,20,5,5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Bon de commande.pdf", "I");
    
    $second_print=0;
    $commande_obj->UpdateFirstPrint($id_fact,$second_print);
    
}elseif (get('do')=='listebc'){
  //LISTE BON DE COMMANDES
    include(APP_FOLDER . '/views/admin/impression/listebc.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c','A4-L','','',15,15,30,20,5,5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste bon de commandes.pdf", "I");
}elseif (get('do')=='listeeb'){
  //LISTE ETAT DE BESOINS
    include(APP_FOLDER . '/views/admin/impression/liste_eb.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c','A4-L','','',15,15,30,20,5,5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste etat de besoins.pdf", "I");
}elseif (get('do')=='etat_besoins'){
  //NUM BON CMD 
    $id_fact = get('id_fact');
    $rows = $commande_obj->SelectOneBesoin(get('id_fact'));
    $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
    
    include(APP_FOLDER . '/views/admin/impression/etat_besoin.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c','A4','','',15,15,30,20,5,5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Etat de besoins.pdf", "I");
    
    $second_print=0;
    $commande_obj->UpdateFirstPrint($id_fact,$second_print);
}elseif (get('do')=='listepaiement'){
  //LISTE DE LIVRAISON numboncmd
    include(APP_FOLDER . '/views/admin/impression/listepaiement.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c','A4-L','','',15,15,30,20,5,5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste de Paiements.pdf", "I");
}else if (get('do') == 'prnt_extrcompte') {
    $bdd = HDB::hus();
    include_once(APP_FOLDER . '/models/objects/t_client.php');
    $clientobj = new t_client_model();
    $datedebut=dateToformatBdd(get('dte1'));
    $datefin=dateToformatBdd(get('dte2'));
    $idclient=get('idclient');
    $data= ExtraitDEcompte($idclient,$datedebut,$datefin,$bdd);
    $rows = $clientobj->SelectOne_ach($idclient);
    $nomcl = $rows->nom_client;
    $societe = $rows->designation;
    $emailcl = $rows->email_client;
    $tel = $rows->telephone_client;
    $adr = $rows->adresse_provenance_client;
    $dte1=dateAffiche($datedebut);
    $dte2=dateAffiche($datefin);
    include(APP_FOLDER . '/views/admin/impression/extraitcompte.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Extrait_compte.pdf", "I");
}