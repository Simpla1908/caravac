<?php

//IMPRESSION////////////////////////////////////////////////////	
include './libraries/mpdf60/mpdf.php';
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
if (get('do') == 'fctheball') {
    $bdd = HDB::hus();
    $panier->initialiser();
    $id_fact = get('id');
    $id_resch = get('id2');
    $do2 = get('do2');
    $bool_serv = $_SESSION['dontprintserv'];
    $infofactch = InfosFactHeb($id_fact, $bdd);
    $id_res = $infofactch->id_res;
    $mode = $infofactch->mode;
    $nom_user = $infofactch->nom_user;
    $prenom_user = $infofactch->prenom_user;
    $agent = $nom_user . ' ' . $prenom_user;
    $num_fact = $infofactch->num_fact;
    $tauxfact = $infofactch->taux;
    $tva = $infofactch->tva;
    $date_edition = $infofactch->date_edition;
    $date_occ = $infofactch->dte_a;
    $date_lib = $infofactch->dte_s;
    $etat_res = $infofactch->etat;
    $dte = date('Y-m-d');
    $dtecomp = $dte;
    $nom_respo = $infofactch->nom_respo;
    $nom_client = $infofactch->nom_client;
    $telcl = $infofactch->telephone_client;
    $emailcl = $infofactch->email_client;
    $adrcl = $infofactch->adresse_provenance_client;
    $assujetti = $infofactch->assujetti;
    $lignes = LignesFactByChambre($id_resch, $bdd);
    $monnaie_ch = getsymbole_local();
    $totpaye = 0;
    $nuite = 0;
    foreach ($lignes as $rows) {
        $st = $rows->statut;
        $paiech = $rows->paie;
        $dte = date('Y-m-d');
        $dtecomp = $dte;
        if ($rows->date_occ < $dte) {
            $dtecomp = DimunuerDaysToDate($dte, 1);
        }
        $nuite = NbJours($rows->date_occ, $dtecomp);
        if ($rows->statut == 'reserve' || $rows->statut == 'change' || $rows->statut == 'libre') {
            $nuite = NbJours($rows->date_occ, $rows->date_lib);
            if ($st == 'change' || $st == 'libre') {
                $nuite = $rows->nuitee;
            }
            $dte = $rows->date_lib;
            $dtecomp = $dte;
        }
        //Incrementation nuitée par rapport au checkin
        if (($rows->date_occ < $dte && $hrs_sys > $checkout) && ($rows->statut == 'occupe')) {
            $nuite++;
            $dtecomp = $dte;
        }
        $nuitesave = $nuite;
        //Quantité par rapport au service ou produit
        $repas = 0;
        if ($rows->libre == 'non') {
            $nuite = $rows->qte;
            $repas = 1;
            $bool_serv = TRUE;
        }
        $histoch_id = $rows->histoch_id;
        $select['id'] = $histoch_id;
        $nom_ch = $rows->num_ch;
        if ($action != 'upnuitee') {
            $tarif_ch1 = $rows->tarif_ch;
            if ($paiech == 0) {
                $nuite = 0;
            }
            $tarif_ch2 = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $tauxfact, $tarif_ch1);
            $select['qte'] = $nuite;
            $select['nom'] = $nom_ch;
            $select['prix'] = $tarif_ch2;
            $select['monttva'] = CalculMontTva($select['prix'], $tva);
            $select['repas'] = $repas;
            $select['dte_a'] = $rows->date_occ;
            $select['dte_s'] = $dtecomp;
            $select['statut'] = $st;
            $panier->ajouterHeb2($select);
        }
    }

    $prix_penalite = $tarif_ch2;
    $montpaye = TotalPayeByChambre($bdd, $id_resch);
    $totpaye = $montpaye;
    $tot = $panier->montant_panierHeb();
    $tottva = CalculMontTva($tot, $tva);
    $ht = CalculMontHtHeb($tot, $tva);
    $ttc = CalculMontTtcHeb($ht, $tottva);
    $solde = $ttc - $totpaye;
    $nbArticles = count($_SESSION['panier']['id_article']);
    $factures_heb = GetFacturesHeb($id_res, $bdd);
    $service = array();
    $service['id'] = array();
    $service['dte'] = array();
    $service['des'] = array();
    $service['type'] = array();
    $service['qte'] = array();
    $service['prix'] = array();
    $service['ttc'] = array();
    $service['tva'] = array();
    $service['ht'] = array();
    $service['solde'] = array();
    $service['mont_eqvlt'] = array();
    foreach ($factures_heb as $fh) {
        $tp = $fh->type;
        $txp = $fh->taux;
        $totfct = 0;
        $dte_a = $fh->date_edition;
        if ($tp == 'hebergement' || ($tp == 'restaurant' && $fh->mode == 'Credit')) {
            if ($tp == 'hebergement') {
                $totfct = $ttc;
            } else {
                // $bool_serv = TRUE;
                $totfct = $fh->mont_ttc;
            }
            $ttpay = TotPayeHeb($fh->id_fact, $bdd);
            TotalPayeByChambre($bdd, $id_resch);
            $ttpay = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $ttpay);
            $tva1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_tva);
            $ht1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->montant_total);
            $slde = $totfct - $ttpay;
            array_push($service['id'], $fh->id_fact);
            array_push($service['dte'], $dte_a);
            array_push($service['des'], $fh->num_fact . ' ' . $tp);
            array_push($service['type'], $tp);
            array_push($service['qte'], '-');
            array_push($service['prix'], '-');
            array_push($service['ttc'], $totfct);
            array_push($service['tva'], $tva1);
            array_push($service['ht'], $ht1);
            array_push($service['solde'], $slde);
            $sldeeqvt = 0;
            if ($_SESSION['Paie_affiche'] == getsymbole_local()) {
                $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_devise(), $_SESSION['Paie_taux'], $slde);
                $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_devise(), $sldeeqvt);
            } else {
                $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $_SESSION['Paie_taux'], $slde);
                $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_local(), $sldeeqvt);
            }
            array_push($service['mont_eqvlt'], $msgevlt);
        }
    }
    $htresto = 0;
    $tvaresto = 0;
    $ttcresto = 0;
    include(APP_FOLDER . '/views/admin/impression/fctheball.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Facture.pdf", "I");
} else if (get('do') == 'recuheb') {
    $bdd = HDB::hus();
    $paie_id = get('id');
    $infosrecu = GetRecuInfos($paie_id, $bdd);
    $resch_id = $infosrecu->resch_id;
    $numero_recu = ' ' . $infosrecu->numero;
    $taux = $infosrecu->taux;
    $libmode = $infosrecu->lib;
    $montpaye = $infosrecu->montant_paye;
    $montantusd = $infosrecu->montantusd;
    $montantcdf = $infosrecu->montantcdf;
    $nom_user2 = $infosrecu->nom_user;
    $prenom_user2 = $infosrecu->prenom_user;
    $rendu_usd = $infosrecu->rendu_usd;
    $rendu_cdf = $infosrecu->rendu_cdf;
    $agent2 = $nom_user2 . ' ' . $prenom_user2;
    $date = date('d/m/Y');
    $dte_paie = $infosrecu->dte;
    if ($date != $dte_paie) {
        $date = $dte_paie;
    }
    $mp = ($montantusd * $taux + $montantcdf) - ($rendu_usd * $taux + $rendu_cdf);
    $montpaye = montant_equivalent_bdd(getsymbole_local(), $monnaie_aff, $taux, $mp);
    $id_fact = $infosrecu->id_fact;
    $infofactch = InfosFactHeb($id_fact, $bdd);
    $nom_respo = $infofactch->nom_respo;
    $nom_client = $infofactch->nom_client;
    $telcl = $infofactch->telephone_client;
    $emailcl = $infofactch->email_client;
    $adrcl = $infofactch->adresse_provenance_client;
    $num_fact = $infofactch->num_fact;
    $ch = GetInfosChambre($resch_id, $bdd);
    $nom_ch = $ch->num_ch;
    include(APP_FOLDER . '/views/admin/impression/recuheb2.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Reçu.pdf", "I");
} else if (get('do') == 'extcpte') {
    $bdd = HDB::hus();
    $id_fact = get('id_fact');
    $resch_id = get('resch_id');
    $infofactch = InfosFactHeb($id_fact, $bdd);
    $nom_respo = $infofactch->nom_respo;
    $nom_client = $infofactch->nom_client;
    $telcl = $infofactch->telephone_client;
    $emailcl = $infofactch->email_client;
    $adrcl = $infofactch->adresse_provenance_client;
    $num_fact = $infofactch->num_fact;
    $date_edition = $infofactch->date_edition;
    $nom_user2 = $infofactch->nom_user;
    $prenom_user2 = $infofactch->prenom_user;
    $agent2 = $nom_user2 . ' ' . $prenom_user2;
    $ch = GetInfosChambre($resch_id, $bdd);
    $nom_ch = $ch->num_ch;
    $paiements = HistoPaiementHeb($id_fact, $bdd);
    $paiementsResto = HistoPaiementHebResto($resch_id, $bdd);
    include(APP_FOLDER . '/views/admin/impression/extcpte.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Extrait de compte.pdf", "I");
} else if (get('do') == 'bon_versement_heb') {
    include(APP_FOLDER . '/views/admin/impression/bon_versement_heb.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Bon versement.pdf", "I");
} else if (get('do') == 'detailversementheb') {
    include(APP_FOLDER . '/views/admin/impression/details_versement.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Details versement.pdf", "I");
} else if (get('do') == 'fondscaisseheb') {
    include(APP_FOLDER . '/views/admin/impression/fondscaisseheb.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Fondscaisseheb.pdf", "I");
} else if (get('do') == 'detailnuite') {
    $t = get('t');
    if ($t == 'prod') {
        include(APP_FOLDER . '/views/admin/impression/detailsnuites.php');
    } else {
        include(APP_FOLDER . '/views/admin/impression/detailsventesservices.php');
    }
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Detailsventes.pdf", "I");
} else if (get('do') == 'listeclients') {
    include(APP_FOLDER . '/views/admin/impression/listeclients.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste des clients.pdf", "I");
} else if (get('do') == 'listeoccupations') {
    include(APP_FOLDER . '/views/admin/impression/listeoccupations.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste des occupations.pdf", "I");
} else if (get('do') == 'listeliberations') {
    include(APP_FOLDER . '/views/admin/impression/listeliberations.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste des libérations.pdf", "I");
} else if (get('do') == 'listereservations') {
    include(APP_FOLDER . '/views/admin/impression/listereservations.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste des reservations.pdf", "I");
} else if (get('do') == 'detrecette') {
    $bdd = HDB::hus();
    $dte1 = get('dte1');
    $dte2 = $dte1;
    $result = GetListPaiement($idsite, $dte1, $dte2, $bdd);
    include(APP_FOLDER . '/views/admin/impression/listrecette.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Recettes.pdf", "I");
} else if (get('do') == 'listefiche') {
    include(APP_FOLDER . '/views/admin/impression/listefiche.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Liste des libérations.pdf", "I");
}
if (get('do') == 'bonannulationres') {
    $bdd = HDB::hus();
    $panier->initialiser();
    $id_fact = get('id');
    $id_resch = get('id2');
    $do2 = get('do2');
    $bool_serv = False;
    $infofactch = InfosFactHeb($id_fact, $bdd);
    $id_res = $infofactch->id_res;
    $mode = $infofactch->mode;
    $nom_user = $infofactch->nom_user;
    $prenom_user = $infofactch->prenom_user;
    $agent = $nom_user . ' ' . $prenom_user;
    $num_fact = $infofactch->num_fact;
    $tauxfact = $infofactch->taux;
    $tva = $infofactch->tva;
    $date_edition = $infofactch->date_edition;
    $date_occ = $infofactch->dte_a;
    $date_lib = $infofactch->dte_s;
    $etat_res = $infofactch->etat;
    $num_bon_annul = $infofactch->num_cmd;
    $dte_annule = $infofactch->date_desactivation;
    $montpenalite = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montpenalite);
    $montrenducl = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montremb);
    $montpaiecl = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montpaie);
    $dte = date('Y-m-d');
    $dtecomp = $dte;
    $nom_respo = $infofactch->nom_respo;
    $nom_client = $infofactch->nom_client;
    $telcl = $infofactch->telephone_client;
    $emailcl = $infofactch->email_client;
    $adrcl = $infofactch->adresse_provenance_client;
    $assujetti = $infofactch->assujetti;
    $obser = $infofactch->justification;
    $lignes = LignesFactHeb($id_fact, $bdd);
    $monnaie_ch = getsymbole_local();
    $totpaye = 0;
    $nuite = 0;
    foreach ($lignes as $rows) {
        $histoch_id = $rows->histoch_id;
        $paiech = $rows->paie;
        $select['id'] = $histoch_id;
        $statut = $rows->statut;
        $st = $statut;
        $date_occ = $rows->date_occ;
        $date_lib = $rows->date_lib;

        if ($statut == 'occupe') {
            if ($do2 == '1') {
                $date_lib = $date_lib;
            } else {
                $date_lib = $dte;
            }
            if ($rows->date_occ < $dte) {
                $dtecomp = DimunuerDaysToDate($dte, 1);
            }
            $nuite = NbJours($date_occ, $dtecomp);
            //Incrémentation de la nuitée par rapport au checkout
            if (($date_occ < $dte && $hrs_sys > $checkout) && $statut == 'occupe') {
                $nuite++;
                $dtecomp = $dte;
            }
            if (($date_occ == $dte) && $nuite == 0) {
                $nuite++;
            }
        } elseif ($statut == 'change' || $statut == 'reserve' || $statut == 'libre') {
            $date_lib = $date_lib;
            $nuite = NbJours($date_occ, $date_lib);
            $dtecomp = $date_lib;
        }

        if ($statut == 'change' || $st == 'libre') {
            $nuite = $rows->nuitee;
        }
        if ($paiech == 0) {
            $nuite = 0;
        }
        $repas = 0;
        if ($rows->libre == 'non') {
            $nuite = $rows->qte;
            $repas = 1;
            $bool_serv = TRUE;
        }
        $nom_ch = $rows->num_ch;
        $tarif_ch1 = $rows->tarif_ch;
        $tarif_ch2 = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $tauxfact, $tarif_ch1);
        $select['qte'] = $nuite;
        $select['nom'] = $nom_ch;
        $select['prix'] = $tarif_ch2;
        $select['monttva'] = CalculMontTva($select['prix'], $tva);
        $select['repas'] = $repas;
        $select['dte_a'] = $rows->date_occ;
        if ($rows->date_occ == date('Y-m-d') && $dtecomp == date('Y-m-d')) {
            $dtecomp = AddDaysToDate($dtecomp, 1);
        }
        $select['dte_s'] = $dtecomp;
        $select['statut'] = $st;
        $panier->ajouterHeb2($select);
    }
    $totpaye = TotalPayeByChambre($bdd, $id_resch);
    $tot = $panier->montant_panierHeb();
    $tottva = CalculMontTva($tot, $tva);
    $ht = CalculMontHtHeb($tot, $tva);
    $ttc = CalculMontTtcHeb($ht, $tottva);
    $solde = $ttc - $totpaye;
    $nbArticles = count($_SESSION['panier']['id_article']);
    $factures_heb = GetFacturesHeb($id_res, $bdd);
    $service = array();
    $service['id'] = array();
    $service['dte'] = array();
    $service['des'] = array();
    $service['type'] = array();
    $service['qte'] = array();
    $service['prix'] = array();
    $service['ttc'] = array();
    $service['tva'] = array();
    $service['ht'] = array();
    $service['solde'] = array();
    $service['mont_eqvlt'] = array();
    foreach ($factures_heb as $fh) {
        $tp = $fh->type;
        $txp = $fh->taux;
        $totfct = 0;
        $dte_a = $fh->date_edition;
        if ($tp == 'hebergement' || ($tp == 'restaurant' && $fh->mode == 'Credit')) {
            if ($tp == 'hebergement') {
                $totfct = $ttc;
            } else {
                $bool_serv = TRUE;
                $totfct = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_ttc);
            }
            $ttpay = TotPayeHeb($fh->id_fact, $bdd);
            TotalPayeByChambre($bdd, $id_resch);
            $ttpay = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $ttpay);
            $tva1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_tva);
            $ht1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->montant_total);
            $slde = $totfct - $ttpay;
            array_push($service['id'], $fh->id_fact);
            array_push($service['dte'], $dte_a);
            array_push($service['des'], $fh->num_fact . ' ' . $tp);
            array_push($service['type'], $tp);
            array_push($service['qte'], '-');
            array_push($service['prix'], '-');
            array_push($service['ttc'], $totfct);
            array_push($service['tva'], $tva1);
            array_push($service['ht'], $ht1);
            array_push($service['solde'], $slde);
            $sldeeqvt = 0;
            if ($_SESSION['Paie_affiche'] == getsymbole_local()) {
                $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_devise(), $_SESSION['Paie_taux'], $slde);
                $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_devise(), $sldeeqvt);
            } else {
                $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $_SESSION['Paie_taux'], $slde);
                $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_local(), $sldeeqvt);
            }
            array_push($service['mont_eqvlt'], $msgevlt);
        }
    }
    $htresto = 0;
    $tvaresto = 0;
    $ttcresto = 0;
    include(APP_FOLDER . '/views/admin/impression/bonannulation.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($body);
    $mpdf->Output("Facture.pdf", "I");
} else if (get('do') == 'recettejr') {
    $bdd = HDB::hus();
    $dte1 = dateToformatBdd(get('dte1'));
    $dte2 = dateToformatBdd(get('dte2'));
    $dte1_af = dateAffiche($dte1);
    $dte2_af = dateAffiche($dte2);
    $description = ' DU ' . $dte1_af . ' au ' . $dte2_af;
    GetListRecette($idsite, $dte1, $dte2, $bdd);
    include(APP_FOLDER . '/views/admin/impression/recettejour.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Recettes.pdf", "I");
} else if (get('do') == 'recettecl') {
    $bdd = HDB::hus();
    $dte1 = dateToformatBdd(get('dte1'));
    $dte2 = dateToformatBdd(get('dte2'));
    $dte1_af = dateAffiche($dte1);
    $dte2_af = dateAffiche($dte2);
    $description = ' du ' . $dte1_af . ' au ' . $dte2_af;
    $recettes = GetSejourClient($idsite, $dte1, $dte2, $bdd);
    include(APP_FOLDER . '/views/admin/impression/recetteclient.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("Recettes.pdf", "I");
} else if (get('do') == 'versement') {
    $bdd = HDB::hus();
    include(APP_FOLDER . '/views/admin/impression/listeversement.php');
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("listeversement.pdf", "I");
} else if (get('do') == 'pfact') {
    $bdd = HDB::hus();
    $f = get('f');
    if ($f == 'cash') {
        include(APP_FOLDER . '/views/admin/impression/facturecash.php');
    } elseif ($f == 'credit') {
        include(APP_FOLDER . '/views/admin/impression/facturecredit.php');
    }
    $body = ob_get_clean();
    $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
    $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($body);
    $mpdf->Output("facture.pdf", "I");
}
