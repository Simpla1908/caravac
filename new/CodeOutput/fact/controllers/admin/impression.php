<?php

//IMPRESSION////////////////////////////////////////////////////	
include './libraries/mpdf60/mpdf.php';
include_once(APP_FOLDER . '/models/objects/t_hotel.php');
include_once(APP_FOLDER . '/models/objects/ressalaire.php');
include_once(APP_FOLDER . '/models/objects/resemployes.php');
include(APP_FOLDER . '/models/objects/respointage.php');
include(APP_FOLDER . '/models/objects/resemprunt.php');
$siteobj = new t_hotel_model();
$salaireobj = new ressalaire_model();
$employeobj = new resemployes_model();
$pointobj = new respointage_model();
$emprunt_obj = new resemprunt_model();
$idsite = $_SESSION['idsite'];
$site = $siteobj->Infos($idsite);
$ville_hotel = $site->ville_hotel;
$logo = $site->logo1;
$adresse_c = $site->adrcomp;
$email_compagny = $site->mail_company;
$telephone = $site->phone;
$idnat = $site->idnat;
$rccm = $site->rccm;
include(APP_FOLDER . '/views/admin/impression/entete_pied_page.php');
ob_start();
if (get('do') == 'bulletin') {
    //Bulletin de paie
    $id = get('id');
    $_SESSION['rubrique'] = array();
    $_SESSION['rubrique']['type'] = array('remuneration', 'retenue');
    $_SESSION['remuneration']['id'] = array();
    $_SESSION['remuneration']['nom'] = array();
    $_SESSION['remuneration']['montant'] = array();
    $_SESSION['remuneration']['total'] = 0;
    $_SESSION['remuneration']['compteur'] = 0;

    $_SESSION['retenue']['id'] = array();
    $_SESSION['retenue']['nom'] = array();
    $_SESSION['retenue']['montant'] = array();
    $_SESSION['retenue']['total'] = 0;
    $_SESSION['retenue']['compteur'] = 0;

    $retenues = array('retenue', 'pret', 'avance');
    $remunerations = array('remuneration', 'prime');
    $rows = $salaireobj->SelectOne($id);
    $rubriques = $salaireobj->GetRubriques($id);
    $totbase = $rows->totbase;
    $taux = $rows->taux;
    $mois = $rows->libelle;
    $dtepaie = $rows->dte;
    $empploye = $rows->noms;
    $matricule = $rows->matricule;
    $fonction = $rows->fonction;

    foreach ($rubriques as $rows) {
        $montant = $rows->valeur;
        if (in_array($rows->type, $remunerations)) {
            array_push($_SESSION['remuneration']['id'], $rows->rubrique_id);
            array_push($_SESSION['remuneration']['nom'], $rows->libelle);
            array_push($_SESSION['remuneration']['montant'], $montant);
            $_SESSION['remuneration']['compteur'] = $_SESSION['remuneration']['compteur'] + 1;
            $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + $montant;
        } elseif (in_array($rows->type, $retenues)) {
            array_push($_SESSION['retenue']['id'], $rows->rubrique_id);
            array_push($_SESSION['retenue']['nom'], $rows->libelle);
            array_push($_SESSION['retenue']['montant'], $montant);
            $_SESSION['retenue']['compteur'] = $_SESSION['retenue']['compteur'] + 1;
            $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + $montant;
        }
    }
    include(APP_FOLDER . '/views/admin/impression/bulletin.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Bulletin.pdf", "I");
} elseif (get('do') == 'lstemployes') {
    //LISTE DES EMPLOYES D'UN SITE
    $result = $employeobj->SelectAll($_SESSION['idsite']);
    include(APP_FOLDER . '/views/admin/impression/lstemployes.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste des employes.pdf", "I");
} else if (get('do') == 'bon_malade') {
    $id1 = get('id1');
    $id2 = get('id2');
    $id3 = get('id3');
    //recuperation le nom de l'hopital
    //fin recup
    include(APP_FOLDER . '/views/admin/impression/bon_malade.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', array(210, 120), '', '', 0, 0, 5, 0, 5, 5);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Bon des soins medicaux.pdf", "I");
} else if (get('do') == 'prnt_recu_pret') {
    include('./libraries/Numbers/Words.php');
    $noms = get('noms');
    $numero = get('numero');
    $montant = get('montant');
    $dte = get('dte');
    $lettre = new Numbers_Words();
    include(APP_FOLDER . '/views/admin/impression/recu_pret.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', array(210, 120), '', '', 0, 0, 5, 0, 5, 5);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Recu_pret.pdf", "I");
} else if (get('do') == 'prnt_recu_avance') {
    include('./libraries/Numbers/Words.php');
    $noms = get('noms');
    $numero = get('numero');
    $montant = get('montant');
    $dte = get('dte');
    $lettre = new Numbers_Words();
    include(APP_FOLDER . '/views/admin/impression/recu_avance.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', array(210, 120), '', '', 0, 0, 5, 0, 5, 5);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Recu_avance.pdf", "I");
} else if (get('do') == 'prnt_list_pres') {
    $datedebut = format_stringdateTodatetime('d/m/Y', get('datedebut'), 'Y-m-d');
    $_SESSION['datedebut'] = get('datedebut');
    $datefin = format_stringdateTodatetime('d/m/Y', get('datefin'), 'Y-m-d');
    $_SESSION['datefin'] = get('datefin');
    $result = $pointobj->SelectPointageAll($_SESSION['idsite'], $datedebut, $datefin);
    include(APP_FOLDER . '/views/admin/impression/lstpresence.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste_presence.pdf", "I");
} else if (get('do') == 'btnpresencedetail') {
    include(APP_FOLDER . '/views/admin/impression/presencedetail.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste_presence.pdf", "I");
} else if (get('do') == 'prnt_bn_perm') {
    $num = get('num');
    $dte = get('dte');
    $dte_fin = get('dte_fin');
    $shift = get('shift');
    $tit = get('tit');
    $rem = get('rem');
    $type = get('type');
    if ($type == 1) {
        $lib_type = 'Entre agents';
    } else {
        $lib_type = 'Entreprise';
    }
    include(APP_FOLDER . '/views/admin/impression/bn_perm.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', array(210, 120), '', '', 0, 0, 5, 0, 5, 5);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Bon_permutation.pdf", "I");
} else if (get('do') == 'print_list_perm') {
    $result = $pointobj->ViewPermut($_SESSION['idsite']);
    include(APP_FOLDER . '/views/admin/impression/listpermt.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste_permutation.pdf", "I");
} else if (get('do') == 'prnt_list_pret') {
    $idlib = IdLibRubriq('pret', $_SESSION['idsite']);
    $site_id = $_SESSION['idsite'];
    $result = $emprunt_obj->ViewPretAvan($idlib, $site_id);
    include(APP_FOLDER . '/views/admin/impression/listpret.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste_pret.pdf", "I");
} else if (get('do') == 'prnt_list_avance') {
    $idlib = IdLibRubriq('avance', $_SESSION['idsite']);
    $site_id = $_SESSION['idsite'];
    $result = $emprunt_obj->ViewPretAvan($idlib, $site_id);
    include(APP_FOLDER . '/views/admin/impression/listavance.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste_avance.pdf", "I");
} else if (get('do') == 'prnt_doc_sanction') {
    $idemplsc = (int) get('idemplsc');
    $nbrj = get('nbrj');
    $imprimele = get('imprimele');
    $adresse = get('adresse');
    $rue = get('rue');
    $quartier = get('quartier');
    $commune = get('commune');
    $ville = get('ville');
    $sexe = get('sexe');
    $dte = dateAffiche(get('dte'));
    $dte1 = dateAffiche(get('dte1'));
    $dte2 = dateAffiche(get('dte2'));
    $dter = dateAffiche(DateReprise(get('dte2')));
    $sanction = get('sanction');
    $comment = $_SESSION['sanction']['comment'][$idemplsc];
    $ref = get('ref');
    $employe_id = get('employe_id');
    $doc = get('doc');
    $noms = get('noms');
    include(APP_FOLDER . '/views/admin/impression/doc_sanction.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Document_sanction.pdf", "I");
} else if (get('do') == 'prnt_doc_conge') {
    //var_dump($_SESSION['conge']);
    $imprimele = get('imprimele');
    $idemplcg = (int) get('idemplcg');
    $adresse = get('adresse');
    $rue = get('rue');
    $quartier = get('quartier');
    $commune = get('commune');
    $ville = get('ville');
    $sexe = get('sexe');
    $dte = dateAffiche(get('dte'));
    $dte1 = dateAffiche(get('dte1'));
    $dte2 = dateAffiche(get('dte2'));
    $dter = dateAffiche(DateReprise(get('dte2')));
    $conge_lib = get('conge_lib');
    $comment = $_SESSION['conge']['comment'][$idemplcg];
    $ref = get('ref');
    $employe_id = get('employe_id');
    $doc = get('doc');
    $noms = get('noms');
    include(APP_FOLDER . '/views/admin/impression/doc_conge.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Document_conge.pdf", "I");
} else if (get('do') == 'prnt_declaration') {
    $code = get('code');
    if ($code == 'IPR') {
        include(APP_FOLDER . '/views/admin/impression/listdatas1.php');
    } else if ($code == 'INSS') {
        include(APP_FOLDER . '/views/admin/impression/listdatas2.php');
    } else if ($code == 'INPP') {
        include(APP_FOLDER . '/views/admin/impression/listdatas3.php');
    }
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Declaration.pdf", "I");
} else if (get('do') == 'resiliation') {
    $salaire_id = get('id');
    $retenues = array('retenue', 'pret', 'avance');
    $remunerations = array('remuneration', 'prime');
    $_SESSION['resiliation'] = array();
    $_SESSION['resiliation']['type'] = array('jour', 'remuneration', 'retenue', 'autre');
    $_SESSION['resiliation']['libelle'] = array('Nombre de jours', 'Remuneration', 'Retenue', 'Autres');
    // $_SESSION['resiliation']['lib_type'] = array('Total jours', 'Total brut', 'Total retenue ', 'Total autre');
    $_SESSION['resiliation']['lib_type'] = array('Total', 'Total', 'Total ', 'Total');
    $_SESSION['jour']['id'] = array('0', '0', '0', '0', '0');
    $_SESSION['jour']['code'] = array('jrpt', 'jpreavis', 'jcongpreavis', 'jcongcomp', 'jcongnonpris');
    $_SESSION['jour']['nom'] = array('De jours prestés', 'De préavis', 'De congé sur préavis', 'De congé compensatoire', 'De congé non pris');
    $_SESSION['jour']['montant'] = array();
    $_SESSION['jour']['total'] = 0;

    $_SESSION['rubrique'] = array();
    $_SESSION['rubrique']['type'] = array('remuneration', 'retenue');
    $_SESSION['remuneration']['id'] = array();
    $_SESSION['remuneration']['nom'] = array();
    $_SESSION['remuneration']['montant'] = array();
    $_SESSION['remuneration']['total'] = 0;
    $_SESSION['remuneration']['compteur'] = 0;
    $_SESSION['remuneration']['totbase'] = array();

    $_SESSION['retenue']['id'] = array();
    $_SESSION['retenue']['nom'] = array();
    $_SESSION['retenue']['montant'] = array();
    $_SESSION['retenue']['total'] = 0;
    $_SESSION['retenue']['compteur'] = 0;

    $rows = $salaireobj->SelectOne($salaire_id);
    $rubriques = $salaireobj->GetRubriques($salaire_id);
    $taux = $rows->taux;
    $mois = $rows->libelle;
    $dtepaie = $rows->dte;
    $empploye = $rows->noms;
    $matricule = $rows->matricule;
    $fonction = $rows->fonction;
    $dteng = $rows->dteng;
    $dtefin = $rows->dte2;
    $anciennete = $rows->ancienete;
    $motif = $rows->motif;
    $totbase = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->totbase);
    $netapayer = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->montant);
    //Besoin technique totbase
    array_push($_SESSION['remuneration']['id'], '00');
    array_push($_SESSION['remuneration']['nom'], 'Base');
    array_push($_SESSION['remuneration']['montant'], $totbase);

    $_SESSION['jour']['id'] = array('00', '00', '00', '00', '00'); //Besoin technique
    $_SESSION['jour']['code'] = array('nbjrpreste', 'jrpreavis', 'cong6preavis', 'congcomp', 'connonpris');
    $_SESSION['jour']['montant'][0] = $rows->nbjrpreste;
    $_SESSION['jour']['montant'][1] = $rows->jrpreavis;
    $_SESSION['jour']['montant'][2] = $rows->cong6preavis;
    $_SESSION['jour']['montant'][3] = $rows->congcomp;
    $_SESSION['jour']['montant'][4] = $rows->connonpris;
    $_SESSION['jour']['total'] = $_SESSION['jour']['montant'][0] + $_SESSION['jour']['montant'][1] + $_SESSION['jour']['montant'][2] + $_SESSION['jour']['montant'][3] + $_SESSION['jour']['montant'][4];
    $totjour = $_SESSION['jour']['total'];

    $_SESSION['autre']['id'] = array('00', '00'); //Besoin technique
    $_SESSION['autre']['code'] = array('arsal', 'idemsrt');
    $_SESSION['autre']['nom'] = array('Arrierés de salaire', 'Indemnité de sortie');
    $_SESSION['autre']['montant'] = array();
    $_SESSION['autre']['total'] = 0;
    $arsal = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->arsal);
    $indemnite = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->indemnite);
    array_push($_SESSION['autre']['montant'], $arsal);
    array_push($_SESSION['autre']['montant'], $indemnite);
    $_SESSION['autre']['total'] = $indemnite + $arsal;
    foreach ($rubriques as $rows) {
        $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->valeur);
        if (in_array($rows->type, $remunerations)) {
            array_push($_SESSION['remuneration']['id'], $rows->rubrique_id);
            array_push($_SESSION['remuneration']['nom'], $rows->libelle);
            array_push($_SESSION['remuneration']['montant'], $montant);
            $_SESSION['remuneration']['compteur'] = $_SESSION['remuneration']['compteur'] + 1;
            $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + $montant;
        } elseif (in_array($rows->type, $retenues)) {
            array_push($_SESSION['retenue']['id'], $rows->rubrique_id);
            array_push($_SESSION['retenue']['nom'], $rows->libelle);
            array_push($_SESSION['retenue']['montant'], $montant);
            $_SESSION['retenue']['compteur'] = $_SESSION['retenue']['compteur'] + 1;
            $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + $montant;
        }
    }
    include(APP_FOLDER . '/views/admin/impression/resiliation.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Decompte final.pdf", "I");
}
//FACTURATION
else if (get('do') == 'facture_fact') {
    //Imprimer la facture facturation
    include_once(APP_FOLDER . '/models/objects/t_facture.php');
    include_once(APP_FOLDER . '/models/objects/Panier.php');


    $factureobj = new t_facture_model();
    $panier = new Panier();
    $id_fact = get('id');
    $rows = $factureobj->SelectOne($id_fact);
    $nomcl = $rows->nom_client;
    $societe = $rows->designation;
    $emailcl = $rows->email_client;
    $tel = $rows->telephone_client;
    $adr = $rows->adresse_provenance_client;
    $numfact = $rows->num_fact;
    $dte_edit = dateAffiche($rows->date_edition);
    $etatfact = $rows->etat;
    $modefact = $rows->mode;
    if ($etatfact == '1') {
        $typefact = 'normale';
    } else {
        $typefact = 'proforma';
    }
    $dte_ech = dateAffiche($rows->date_echeance);
    $justification = $rows->justification;
    $ht = $rows->montant_total;
    $monttvax = $rows->mont_tva;
    $ttc = $rows->mont_ttc_remise;
    $monnaie_fact = $rows->monnaie;
    $remise = $rows->remise;
    $taux = getTauxFacture2($monnaie_fact, $_SESSION['Paie_taux'], $rows->taux);
    $ht = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ht);
    $monttvax = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $monttvax);
    $ttc = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ttc);
    $montremise = $rows->mont_ttc;
    $montremise = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $montremise);

    $panier->initialiser();
    $site = $siteobj->Infos2($idsite);
    $logo = $site->logo;
    $mail = $site->mail;
    $phone = $site->phone;
    $adrcomp = $site->adrcomp;
    $nomcomp = $site->nomcomp;
    $idnat = $site->idnat;
    $rccm = $site->rccm;
    $nocompte = $site->hopital;
    // $result = $factureobj->lignesAllBySite($id_fact);
    // foreach ($result as $rows) {
    //     $select['id'] = $rows->produit_id;
    //     $select['qte'] = $rows->qte;
    //     $select['nom'] = $rows->designation;
    //     $select['prix'] = $rows->prix;
    //     $select['monttva'] = $rows->mont_tva;
    //     $panier->ajouterFact($select);
    // }
    // $nbArticles = count($_SESSION['panier']['id_article']);
    include(APP_FOLDER . '/views/admin/impression/facturation_fact.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Facture.pdf", "I");
} else if (get('do') == 'sendmail') {
    //Imprimer la facture facturation
    include_once(APP_FOLDER . '/models/objects/t_facture.php');
    include_once(APP_FOLDER . '/models/objects/Panier.php');
    include './libraries/PHPMailer/class.phpmailer.php';
    $factureobj = new t_facture_model();
    $panier = new Panier();
    $id_fact = get('id');
    $rows = $factureobj->SelectOne($id_fact);
    $nomcl = $rows->nom_client;
    $societe = $rows->designation;
    $emailcl = $rows->email_client;
    $tel = $rows->telephone_client;
    $adr = $rows->adresse_provenance_client;
    $numfact = $rows->num_fact;
    $modefact = $rows->mode;
    $dte_edit = dateAffiche($rows->date_edition);
    $etatfact = $rows->etat;
    if ($etatfact == 1) {
        $typefact = 'normale';
    } else {
        $typefact = 'proforma';
    }
    $dte_ech = dateAffiche($rows->date_echeance);
    $justification = $rows->justification;
    $ht = $rows->montant_total;
    $monttvax = $rows->mont_tva;
    $ttc = $rows->mont_ttc_remise;
    $monnaie_fact = $rows->monnaie;
    $taux = getTauxFacture2($monnaie_fact, $_SESSION['Paie_taux'], $rows->taux);
    $ht = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ht);
    $monttvax = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $monttvax);
    $ttc = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ttc);
    $panier->initialiser();
    $site = $siteobj->Infos2($idsite);
    $logo = $site->logo;
    $mail = $site->mail;
    $phone = $site->phone;
    $adrcomp = $site->adrcomp;
    $nomcomp = $site->nomcomp;
    $idnat = $site->idnat;
    $rccm = $site->rccm;
    $result = $factureobj->lignesAllBySite($id_fact);
    foreach ($result as $rows) {
        $select['id'] = $rows->produit_id;
        $select['qte'] = $rows->qte;
        $select['nom'] = $rows->designation;
        $select['prix'] = $rows->prix;
        $select['monttva'] = $rows->mont_tva;
        $panier->ajouterFact($select);
    }
    $nbArticles = count($_SESSION['panier']['id_article']);
    include(APP_FOLDER . '/views/admin/impression/facturation_fact.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $fichier = $mpdf->Output("Facture.pdf", "S");
    $mailobj = new PHPMailer();
    $bool = EmailSendFichier($_SESSION['nomexp'], $_SESSION['mailexp'], $nomcl, $emailcl, $_SESSION['sujetmail'], $_SESSION['msgmail'], $fichier, $mailobj);
    $ms = '';
    if ($bool) {
        $ms = 'mailok';
    } else {
        $ms = 'mailno';
    }
    json_send('' . H_ADMIN . '&view=t_facture&id_fact=' . $id_fact . '&do=details&f=' . $etatfact . '&msg=' . $ms . '');
    json_success('Opération terminée');
} else if (get('do') == 'sendmail2') {
    //Imprimer la facture facturation
    include_once(APP_FOLDER . '/models/objects/t_facture.php');
    include_once(APP_FOLDER . '/models/objects/Panier.php');
    include './libraries/PHPMailer/class.phpmailer.php';
    $factureobj = new t_facture_model();
    $panier = new Panier();
    $id_fact = get('id');
    $rows = $factureobj->SelectOne($id_fact);
    $nomcl = $rows->nom_client;
    $societe = $rows->designation;
    $emailcl = $rows->email_client;
    $tel = $rows->telephone_client;
    $adr = $rows->adresse_provenance_client;
    $numfact = $rows->num_fact;
    $modefact = $rows->mode;
    $dte_edit = dateAffiche($rows->date_edition);
    $etatfact = $rows->etat;
    if ($etatfact == '1') {
        $typefact = 'normale';
    } else {
        $typefact = 'proforma';
    }
    $dte_ech = dateAffiche($rows->date_echeance);
    $justification = $rows->justification;
    $ht = $rows->montant_total;
    $monttvax = $rows->mont_tva;
    $ttc = $rows->mont_ttc_remise;
    $monnaie_fact = $rows->monnaie;
    $taux = getTauxFacture2($monnaie_fact, $_SESSION['Paie_taux'], $rows->taux);
    $ht = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ht);
    $monttvax = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $monttvax);
    $ttc = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ttc);
    $panier->initialiser();
    $site = $siteobj->Infos2($idsite);
    $logo = $site->logo;
    $mail = $site->mail;
    $phone = $site->phone;
    $adrcomp = $site->adrcomp;
    $nomcomp = $site->nomcomp;
    $idnat = $site->idnat;
    $rccm = $site->rccm;
    $result = $factureobj->lignesAllBySite($id_fact);
    foreach ($result as $rows) {
        $select['id'] = $rows->produit_id;
        $select['qte'] = $rows->qte;
        $select['nom'] = $rows->designation;
        $select['prix'] = $rows->prix;
        $select['monttva'] = $rows->mont_tva;
        $panier->ajouterFact($select);
    }
    $nbArticles = count($_SESSION['panier']['id_article']);
    include(APP_FOLDER . '/views/admin/impression/facturation_fact.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $fichier = $mpdf->Output("Facture.pdf", "S");
    $mailobj = new PHPMailer();
    $bool = EmailSendFichier($_SESSION['nomexp'], $_SESSION['mailexp'], $nomcl, $emailcl, $_SESSION['sujetmail'], $_SESSION['msgmail'], $fichier, $mailobj);
    if ($bool) {
        $json['s'] = TRUE;
        $json['message'] = "L'envoie par mail de cette facture s'est effectué avec succès!";
    } else {
        $json['s'] = FALSE;
        $json['message'] = "L'envoie par mail de cette facture a échoué!";
    }

    echo json_encode($json);
} else if (get('do') == 'facturation_recu') {
    include('./libraries/Numbers/Words.php');
    $lettre = new Numbers_Words();
    $lettre1 = new Numbers_Words();
    include(APP_FOLDER . '/views/admin/impression/facturation_recu.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', array(210, 120), '', '', 0, 0, 5, 0, 5, 5);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Recu.pdf", "I");
} else if (get('do') == 'prnt_fpaiement') {
    include(APP_FOLDER . '/views/admin/impression/facturation_list_paie.php');

    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Facturation_List_Paie.pdf", "I");
} else if (get('do') == 'prnt_liste_paiement') {
    include(APP_FOLDER . '/views/admin/impression/facturation_list_paiement.php');

    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Facturation_List_Paiement.pdf", "I");
} else if (get('do') == 'print_details_vente') {
    $_SESSION['id_hotel'] = $idsite;
    include(APP_FOLDER . '/views/admin/impression/fdetails_vente.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("details_vente.pdf", "I");
} else if (get('do') == 'prnt_client') {
    include(APP_FOLDER . '/views/admin/impression/list_paie_client.php');

    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste_client.pdf", "I");
} else if (get('do') == 'prnt_fextrtva') {
    include(APP_FOLDER . '/views/admin/impression/facturation_list_tva.php');

    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Facturation_List_TVA.pdf", "I");
} else if (get('do') == 'prnt_extrcompte') {
    include_once(APP_FOLDER . '/models/objects/t_client.php');
    $clientobj = new t_client_model();
    $client_id = $_SESSION['idclient_extrcompte'];
    $dte1 = $_SESSION['dte1_extrcompte'];
    $dte2 = $_SESSION['dte2_extrcompte'];
    $rows = $clientobj->SelectOne($client_id);
    $nomcl = $rows->nom_client;
    $societe = $rows->designation;
    $emailcl = $rows->email_client;
    $tel = $rows->telephone_client;
    $adr = $rows->adresse_provenance_client;
    include(APP_FOLDER . '/views/admin/impression/extraitcompte.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Extrait_compte.pdf", "I");
} else if (get('do') == 'prnt_listfact') {
    //Mise en session pour impression
    $_SESSION['liste_fact'] = array();
    $_SESSION['liste_fact']['num_fact'] = array();
    $_SESSION['liste_fact']['date_edition'] = array();
    $_SESSION['liste_fact']['date_echeance'] = array();
    $_SESSION['liste_fact']['nom_client'] = array();
    $_SESSION['liste_fact']['montantfact'] = array();
    $_SESSION['liste_fact']['montant_paye'] = array();
    $_SESSION['liste_fact']['solde'] = array();
    //Fin mise en session

    $mode = get('mode');

    if ($mode == "Cash") {
        $_SESSION['mode'] = "CASH";
        $_SESSION['montant_tot'] = $_SESSION['cashmontant_tot'];
        $_SESSION['montant_paie'] = $_SESSION['cashmontant_paie'];
        $_SESSION['soldetot'] = $_SESSION['cashsoldetot'];

        $n = count($_SESSION['cash']['num_fact']);
        for ($i = 0; $i <= $n - 1; $i++) {
            //Mise en session pour impression
            $num_fact = $_SESSION['cash']['num_fact'][$i];
            $date_edition = $_SESSION['cash']['date_edition'][$i];
            $date_echeance = $_SESSION['cash']['date_echeance'][$i];
            $nom_client = $_SESSION['cash']['nom_client'][$i];
            $montantfact = $_SESSION['cash']['montantfact'][$i];
            $montant_paye = $_SESSION['cash']['montant_paye'][$i];
            $solde = $_SESSION['cash']['solde'][$i];

            MiseSessionListeFact($num_fact, $date_edition, $date_echeance, $nom_client, $montantfact, $montant_paye, $solde);

            //Fin mise en session
        }
    } elseif ($mode == "Acompte") {

        $_SESSION['mode'] = "ACOMPTE";
        $_SESSION['montant_tot'] = $_SESSION['acomptemontant_tot'];
        $_SESSION['montant_paie'] = $_SESSION['acomptemontant_paie'];
        $_SESSION['soldetot'] = $_SESSION['acomptesoldetot'];

        $n = count($_SESSION['acompte']['num_fact']);
        for ($i = 0; $i <= $n - 1; $i++) {
            //Mise en session pour impression
            $num_fact = $_SESSION['acompte']['num_fact'][$i];
            $date_edition = $_SESSION['acompte']['date_edition'][$i];
            $date_echeance = $_SESSION['acompte']['date_echeance'][$i];
            $nom_client = $_SESSION['acompte']['nom_client'][$i];
            $montantfact = $_SESSION['acompte']['montantfact'][$i];
            $montant_paye = $_SESSION['acompte']['montant_paye'][$i];
            $solde = $_SESSION['acompte']['solde'][$i];

            MiseSessionListeFact($num_fact, $date_edition, $date_echeance, $nom_client, $montantfact, $montant_paye, $solde);

            //Fin mise en session
        }
    } elseif ($mode == "Credit") {
        $_SESSION['mode'] = "CREDIT";
        $_SESSION['montant_tot'] = $_SESSION['creditmontant_tot'];
        $_SESSION['montant_paie'] = $_SESSION['creditmontant_paie'];
        $_SESSION['soldetot'] = $_SESSION['creditsoldetot'];

        $n = count($_SESSION['credit']['num_fact']);
        for ($i = 0; $i <= $n - 1; $i++) {
            //Mise en session pour impression
            $num_fact = $_SESSION['credit']['num_fact'][$i];
            $date_edition = $_SESSION['credit']['date_edition'][$i];
            $date_echeance = $_SESSION['credit']['date_echeance'][$i];
            $nom_client = $_SESSION['credit']['nom_client'][$i];
            $montantfact = $_SESSION['credit']['montantfact'][$i];
            $montant_paye = $_SESSION['credit']['montant_paye'][$i];
            $solde = $_SESSION['credit']['solde'][$i];

            MiseSessionListeFact($num_fact, $date_edition, $date_echeance, $nom_client, $montantfact, $montant_paye, $solde);

            //Fin mise en session
        }
    } else {
        $_SESSION['mode'] = "PROFORMAT";
        $_SESSION['montant_tot'] = $_SESSION['proformatmontant_tot'];
        $_SESSION['montant_paie'] = $_SESSION['proformatmontant_paie'];
        $_SESSION['soldetot'] = $_SESSION['proformatsoldetot'];

        $n = count($_SESSION['proformat']['num_fact']);
        for ($i = 0; $i <= $n - 1; $i++) {
            //Mise en session pour impression
            $num_fact = $_SESSION['proformat']['num_fact'][$i];
            $date_edition = $_SESSION['proformat']['date_edition'][$i];
            $date_echeance = $_SESSION['proformat']['date_echeance'][$i];
            $nom_client = $_SESSION['proformat']['nom_client'][$i];
            $montantfact = $_SESSION['proformat']['montantfact'][$i];
            $montant_paye = $_SESSION['proformat']['montant_paye'][$i];
            $solde = $_SESSION['proformat']['solde'][$i];

            MiseSessionListeFact($num_fact, $date_edition, $date_echeance, $nom_client, $montantfact, $montant_paye, $solde);

            //Fin mise en session
        }
    }
    include(APP_FOLDER . '/views/admin/impression/liste_factures.php');

    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("liste_facture.pdf", "I");
}
