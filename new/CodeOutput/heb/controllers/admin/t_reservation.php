
<?php
/*
 * =======================================================================
 * FILE NAME:        t_reservation.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_reservation
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/t_reservation.php');
include_once(APP_FOLDER . '/models/objects/Panier.php');
include_once(APP_FOLDER . '/models/objects/compteur.php');
include_once(APP_FOLDER . '/models/objects/t_client.php');
class t_reservation_controller
{

    public $t_reservation_model;

    public function __construct()
    {
        $this->t_reservation_model = new t_reservation_model();
    }

    public function invoke_t_reservation()
    {
        $idsite = $_SESSION['idsite'];
        $id_user = $_SESSION['id_user'];
        $monnaie = $_SESSION['Paie_affiche'];
        $m2 = $monnaie;
        if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
            $m2 = getsymbole_local();
        }
        $taux = $_SESSION['Paie_taux'];
        $tva = $_SESSION['tva'];
        $company_id = $_SESSION['company_id'];
        $checkin = $_SESSION['checkin'];
        $checkout = $_SESSION['checkout'];
        $hrs_sys = date('H:i') . ':00';
        $panier = new Panier();
        $compteurobj = new compteur_model();
        $clientobj = new t_client_model();
        $json = array();
        $json['s'] = False;
        $json['message'] = '';
        $json['totpaye'] = 0;
        $json['solde'] = 0;
        $datapaye = array();
        $datapaye['montant'] = array();
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->t_reservation_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->t_reservation_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=t_reservation&do=viewall');
            } else {
                $result = $this->t_reservation_model->SelectAll();
            }
            include(APP_FOLDER . '/views/admin/t_reservation/View.php');
        } else if (get('do') == 'rendu') {
            $json['boolrendu'] = False;
            $rendu_usd = 0;
            $rendu_cdf = 0;
            $totrendu = 0;
            $montantusd = post('usd');
            $montantcdf = post('cdf');
            if ($montantusd == '') {
                $montantusd = 0;
            }
            if ($montantcdf == '') {
                $montantcdf = 0;
            }
            $taux_op = $_SESSION['Paie_taux'];
            $montantsaisi = $montantusd * $taux_op + $montantcdf;
            $mont_ttc1 = $panier->montant_panierHeb();
            $mont_ttc = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $_SESSION['Paie_taux'], $mont_ttc1);
            // echo '$montantusd  :' . $montantusd;
            // echo '$taux_op  :' . $taux_op;
            // echo '$montantsaisi  :' . $montantsaisi;
            //echo '$mont_ttc  :' . $mont_ttc;

            if ($montantsaisi > $mont_ttc) {
                $totrendu = $montantsaisi - $mont_ttc;
                if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
                    $rendu_usd = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_op, $montantsaisi - $mont_ttc);
                } else {
                    $rendu_cdf = $montantsaisi - $mont_ttc;
                }
                $json['boolrendu'] = True;
            }
            $json['rendu_usd'] = arrondir($rendu_usd);
            $json['rendu_cdf'] = arrondir($rendu_cdf);
            $json['totrendu'] = $totrendu;
            $json['succes'] = True;
            echo json_encode($json);
        } else if (get('do') == 'rendu2') {
            $json['boolrendu'] = False;
            $rendu_usd = 0;
            $rendu_cdf = 0;
            $totrendu = 0;
            $montantusd = post('usd');
            $montantcdf = post('cdf');
            if ($montantusd == '') {
                $montantusd = 0;
            }
            if ($montantcdf == '') {
                $montantcdf = 0;
            }
            $taux_op = $_SESSION['Paie_taux'];
            $montantsaisi = $montantusd * $taux_op + $montantcdf;
            $mont_ttc = post('ttc');
            // echo " montantsaisi " . $montantsaisi;
            // echo " mont_ttc " . $mont_ttc;
            if ($montantsaisi > $mont_ttc) {
                $totrendu = $montantsaisi - $mont_ttc;
                // echo " totrendu" . $totrendu;
                // echo " Paie_affiche" . $_SESSION['Paie_affiche'];
                if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
                    $rendu_usd = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_op, $montantsaisi - $mont_ttc);
                    // echo " rendu_usd" . $rendu_usd;
                } else {
                    $rendu_cdf = $montantsaisi - $mont_ttc;
                    // echo " rendu_cdf" . $rendu_cdf;
                }
                $json['boolrendu'] = True;
            }
            $json['mt'] = $montantsaisi;
            $json['rendu_usd'] = arrondir($rendu_usd);
            $json['rendu_cdf'] = arrondir($rendu_cdf);
            $json['totrendu'] = $totrendu;
            $json['succes'] = True;
            echo json_encode($json);
        }
        //PLANNING AJAX
        elseif (get('do') == 'planajx') {
            $bdd = HDB::hus();
            $per_dte = startEndDayWeek();
            if (get('dte1') == '' || get('dte2') == '') {
                $dte1 = $per_dte['sday'];
                $dte2 = $per_dte['eday'];
            } else {
                $dte1 = dateToformatBdd(get('dte1'));
                $dte2 = dateToformatBdd(get('dte2'));
            }
            $today = date('Y-m-d');
            $sejour = array();
            $sejour['chambre'] = array();
            $sejour['dte'] = array();
            $sejour['ch'] = array();
            $sejour['cl'] = array();
            $sejour['y'] = array();
            $sejour['rchid'] = array();
            $inscrits = array(array());
            $inscrits2 = array(array());
            $inscrits3 = array(array());
            $inscrits4 = array(array());
            $inscrits5 = array(array());
            $chambres = GetListChambre($idsite, $bdd);
            $sejours = GetSejourChambre($idsite, $dte1, $dte2, $bdd);
            $periode_reservations = PeriodeReservation($dte1, $dte2);
            $nbre = count($periode_reservations['libelle']);
            for ($i = 0; $i < $nbre; $i++) {
                $dteper = $periode_reservations['dte'][$i];
                $dte_a = $dteper;
                $dte_s = $dteper;
                foreach ($sejours as $ch) {
                    $chambre_id = $ch->idchambre;
                    $statut = $ch->statut;
                    if ((($dte_a >= $ch->date_occ) && ($dte_s <= $ch->date_lib)) || ($statut == 'occupe' && ($dte_a >= $ch->date_occ && $dte_s <= $today))) {
                        $sejour['y'][$chambre_id] = $ch->id;
                        array_push($sejour['dte'], $dteper);
                        array_push($sejour['ch'], $chambre_id);
                        array_push($sejour['rchid'], $ch->id);
                        $inscrits[$chambre_id][$dte_a] = $ch->nom_client;
                        $inscrits2[$chambre_id][] = $dte_a;
                        $inscrits3[$chambre_id][$dte_a] = $ch->statut;
                        $inscrits4[$chambre_id][$dte_a] = $ch->id;
                        $inscrits5[$chambre_id][$dte_a] = $ch->date_lib;
                    }
                }
            }
            include(APP_FOLDER . '/views/admin/module/pl.php');
        }
        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->t_reservation_model->SelectOne(get('id_res'));
            include(APP_FOLDER . '/views/admin/t_reservation/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->t_reservation_model->AutoSearch(trim($qstring), 10, 'num_reserv');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_reservation&id_res=' . $srow->id_res . '&do=details"><li class="list-group-item">' . $srow->num_reserv . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }
        //CALCUL AUTOMATIQUE MONTANT PAYE
        elseif (get('do') == 'montpaye') {
            $usd = post('usd');
            $cdf = post('cdf');
            $nbre = count($cdf);
            $montfact = post('totfact');
            $montpaye1 = 0;
            $montusd = 0;
            $montcdf = 0;
            for ($i = 0; $i <= $nbre - 1; $i++) {
                $montusd = $usd[$i];
                $montcdf = $cdf[$i];
                if (empty($montusd)) {
                    $montusd = 0;
                }
                if (empty($montcdf)) {
                    $montcdf = 0;
                }
                $montpaye1 += $montusd * $_SESSION['Paie_taux'] + $montcdf;
            }

            $montpaye1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $montpaye1);
            $solde = $montfact - $montpaye1;
            $json['totpaye'] = afficheMontant($_SESSION['Paie_affiche'], $montpaye1);
            $json['solde'] = afficheMontant($_SESSION['Paie_affiche'], $solde);
            $json['s'] = True;
            echo json_encode($json);
        } elseif (get('do') == 'mdpricech') {
            $cdf = 0;
            $usd = 0;
            $totpayef = post('totpayef');
            $prix = get('prix');
            $select['prix'] = $prix;
            $select['id'] = get('id');
            $nbresej = post('nbresej');
            $totch = $prix * $nbresej;
            $panier->ModifierPrix($select);
            $ttc = $panier->montant_panierHeb();
            $totfact = $ttc;
            $ttc_eqvlt = 0;
            $ttc_eqvlt_aff = '';
            if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
                $usd = $totch;
                $ttc_eqvlt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $_SESSION['Paie_taux'], $ttc);
                $ttc_eqvlt_aff = afficheMontant(getsymbole_local(), $ttc_eqvlt);
            } else {
                $cdf = $totch;
                $ttc_eqvlt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_devise(), $_SESSION['Paie_taux'], $ttc);
                $ttc_eqvlt_aff = afficheMontant(getsymbole_devise(), $ttc_eqvlt);
            }
            $montpaye1 = $totpayef + $totch;
            $json['mpusd'] = $usd;
            $json['mpcdf'] = $cdf;
            $json['totfact'] = $totfact;
            $json['totfacture'] = afficheMontant($_SESSION['Paie_affiche'], $totfact);
            $json['monttot'] = afficheMontant($_SESSION['Paie_affiche'], $totch);
            $json['ttc_eqvlt_aff'] = $ttc_eqvlt_aff;
            // $json['totpaye'] =afficheMontant($_SESSION['Paie_insert'],$montpaye1);
            //$json['totpayef'] =$montpaye1;
            echo json_encode($json);
        } elseif (get('do') == 'recalgfct') {
            //Recalcul ligne facture hebergement sur base de nuitee
            $dte1 = dateToformatBdd(get('dte1'));
            $dte2 = dateToformatBdd(get('dte2'));
            if ($dte1 != '' && $dte2 != '') {
                $nuite = NbJours($dte1, $dte2);
                $nbArticles = count($_SESSION['panier']['id_article']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $select['qte'] = $nuite;
                    $select['id'] = $_SESSION['panier']['id_article'][$i];
                    $panier->ModifierQteHeb($select);
                }
                include(APP_FOLDER . '/views/admin/t_reservation/lich.php');
            }
        } elseif (get('do') == 'gettotal') {
            $ttc = $panier->montant_panierHeb();
            $json['totfacture'] = afficheMontant($_SESSION['Paie_affiche'], $ttc);
            $ttc_eqvlt = 0;
            $ttc_eqvlt_aff = '';
            if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
                $ttc_eqvlt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $_SESSION['Paie_taux'], $ttc);
                $ttc_eqvlt_aff = afficheMontant(getsymbole_local(), $ttc_eqvlt);
            } else {
                $ttc_eqvlt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_devise(), $_SESSION['Paie_taux'], $ttc);
                $ttc_eqvlt_aff = afficheMontant(getsymbole_devise(), $ttc_eqvlt);
            }
            $json['ttc_eqvlt_aff'] = $ttc_eqvlt_aff;
            echo json_encode($json);
        } elseif (get('do') == 'delch') {
            //SUPPRIMER LIGNE RESERVATION
            $select['id'] = get('id');
            $panier->delligneHeb($select);
            $ttc = $panier->montant_panierHeb();
            $totpaye = $ttc;
            $nbArticles = count($_SESSION['panier']['id_article']);
            //            include(APP_FOLDER . '/views/admin/t_reservation/lich.php');
            include(APP_FOLDER . '/views/admin/t_reservation/liservices.php');
        } elseif (get('do') == 'addservice') {
            //Ajouter service
            $bdd = HDB::hus();
            $infosch = InfosChambres($idsite, $bdd);
            $service_ids = post('service_ids');
            $n = count($service_ids);
            $tva = $_SESSION['tva'];
            for ($i = 0; $i <= $n - 1; $i++) {
                $id_ch = $service_ids[$i];
                $nuite = post('nuite' . $id_ch);
                $nom_ch = $infosch['nom'][$id_ch];
                $tarif_ch1 = $infosch['tarif'][$id_ch];
                $monnaie_ch = $infosch['monnaie'][$id_ch];
                $tarif_ch2 = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $tarif_ch1);
                $select['id'] = $id_ch;
                $select['qte'] = $nuite;
                $select['nom'] = $nom_ch;
                $select['prix'] = $tarif_ch2;
                $select['monttva'] = CalculMontTva($select['prix'], $tva);
                $select['repas'] = '1';
                $panier->ajouterHeb($select);
            }
            $ttc = $panier->montant_panierHeb();
            $totpaye = $ttc;
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/t_reservation/liservices.php');
        }
        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add' || get('do') == 'upnuitee' || get('do') == 'majmp1') {
            $bdd = HDB::hus();
            $prix_penalite = 0;
            $soldeusd = 0;
            $soldecdf = 0;
            $bool_serv = False;
            $id_resch = get('id_resch');
            $action = get('do');
            $modepaiements = GetModepaiement($bdd);
            $modecpt = count($modepaiements['id']);
            $services = GetListService($idsite, $bdd);
            $chambres = GetListChambre($idsite, $bdd);
            $responsables = GetListResponsable($_SESSION['company_id'], $bdd);
            $tarif_ch2 = 0;
            if ($action != 'upnuitee') {
                $panier->initialiser();
            }
            $dte = date('Y-m-d');
            if ($id_resch != 0) {
                $fichier = 'detailsfact1';
                if ($action == 'majmp1' || get('do') == 'upnuitee') {
                    $fichier = 'sejourdata';
                } elseif (get('serv') == 'majserv') {
                    $fichier = 'sejourdata';
                } elseif (get('serv') == 'majfact2') {
                    $fichier = 'datadetailsfact2';
                }
                $infofactch = InfosFactByChambre($id_resch, $bdd);
                $id_chx_ex = $infofactch->idchambre;
                $id_client = $infofactch->id_client;
                $nom_client = $infofactch->nom_client;
                $id_fact = $infofactch->id_fact;
                $id_res = $infofactch->idreserv;
                $num_fact = $infofactch->num_fact;
                $tauxfact = $infofactch->taux;
                $tauxfactheb = $infofactch->taux;
                $tva = $infofactch->tva;
                $date_edition = $infofactch->date_edition;
                $date_occ = $infofactch->occupe;
                $date_lib = $infofactch->date_lib;
                $statut = $infofactch->statut;
                $nom_accomp = $infofactch->nom_accomp;
                $mode = $infofactch->mode;
                $modefacheboccup = $infofactch->mode;
                $nom_respo = NomRespoByIdRes($id_res, $bdd);
                $assujetti = $infofactch->assujetti;
                $hebstatut = $infofactch->heb;
                $num_bon_annul = $infofactch->num_cmd;
                $dte_annule = $infofactch->date_desactivation;
                $ttccompta = $infofactch->mont_ttc;
                $tauxcompta = $infofactch->taux;


                //RECUPERATION COMPTES
                $compte1 = $infofactch->compte1;
                $compte2 = $infofactch->compte2;
                $_SESSION['ComptaCompte1']  = $infofactch->compte1;
                $_SESSION['ComptaCompte2']  = $infofactch->compte2;
                $_SESSION['ComptaCustomer']  = $nom_client;
                //RECUPERATION COMPTES
                $num_reserv = GetNumReservation($id_res, $bdd);
                $num_recu_paie = GetNumRecu($id_fact, $bdd);
                $monnaie_ch = getsymbole_local();
                $montpenalite = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montpenalite);
                $montrenducl = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montremb);
                $montpaiecl = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montpaie);
                $lignes = LignesFactByChambre($id_resch, $bdd);
                $totpaye = 0;
                $nuitesave = 1;
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
                $service['solde_eqvlt'] = array();
                $service['mont_eqvlt'] = array();
                $service['tauxfact'] = array();
                $service['num_fact'] = array();
                $txequvalent = $_SESSION['Paie_taux'];
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
                        if ($tp == 'restaurant') {
                            $txequvalent = $txp;
                        }
                        $ttpay = TotPayeHeb($fh->id_fact, $bdd);
                        $ttpay = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $ttpay);
                        /*$tva1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_tva);
                        $ht1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->montant_total); */
                        //Ajust tot facture resto
                        $tva1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_tva);
                        $ht1 = montant_equivalent_bdd(getsymbole_devise(), $_SESSION['Paie_affiche'], $txp, $fh->montant_total);
                        $totfct = montant_equivalent_bdd(getsymbole_devise(), $_SESSION['Paie_affiche'], $txp, $fh->mont_ttc);
                        $slde = $totfct - $ttpay;
                        $num_fact = $fh->num_fact;
                        array_push($service['id'], $fh->id_fact);
                        array_push($service['dte'], $dte_a);
                        array_push($service['des'], $fh->num_fact . ' ' . $tp);
                        array_push($service['type'], $tp);
                        array_push($service['qte'], '-');
                        array_push($service['prix'], '-');
                        array_push($service['ttc'], $totfct);
                        array_push($service['tva'], $tva1);
                        array_push($service['ht'], $ht1);
                        array_push($service['tauxfact'], $txp);
                        $sldeeqvt = 0;
                        if ($tp == 'hebergement') {
                            $slde = $ttc - $ttpay;
                        }
                        if ($_SESSION['Paie_affiche'] == getsymbole_local()) {
                            $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_devise(), $txequvalent, $slde);
                            $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_devise(), $sldeeqvt);
                        } else {
                            $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $txequvalent, $slde);
                            $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_local(), $sldeeqvt);
                        }
                        array_push($service['solde'], $slde);
                        array_push($service['solde_eqvlt'], $sldeeqvt);
                        array_push($service['mont_eqvlt'], $msgevlt);
                        array_push($service['num_fact'], $num_fact);
                    }
                }
                $htresto = 0;
                $tvaresto = 0;
                $ttcresto = 0;
                $paiements = HistoPaiementHeb($id_fact, $bdd);
                $paiementsResto = HistoPaiementHebResto($id_resch, $bdd);
                //Annulation reservation
                $montremb = 0;
                $montrembaff = 0;
                $tarif_chfc = $prix_penalite;
                if ($statut == 'reserve') {
                    $dte = date('Y-m-d');
                    $resannuleconfig = Getcfgannulationreservation($bdd);
                    $jrannule = $resannuleconfig->jrannule;
                    $annuledte = ReduiceDaysToDate($date_occ, $jrannule);
                    $valmont = $resannuleconfig->valmont;
                    if ($resannuleconfig->penalite == 1 && $dte >= $annuledte) {
                        if ($resannuleconfig->retention == 'nuite') {
                            $tarif_chfc = $tarif_chfc * $valmont;
                        } elseif ($resannuleconfig->retention == 'pourcentage') {
                            $tarif_chfc = $montpaye * $valmont / 100;
                            if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
                                $tarif_chfc = $tarif_chfc * $taux;
                            }
                        } elseif ($resannuleconfig->retention == 'chiffre') {
                            $tarif_chfc = $valmont;
                            if ($_SESSION['Paie_affiche'] == getsymbole_devise() && $resannuleconfig->monnaie == $_SESSION['Paie_affiche']) {
                                $tarif_chfc = $valmont * $taux;
                            }
                        }
                        $montremb = $tarif_chfc;
                    } else {
                        $montremb = 0;
                    }

                    $montrembaff = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $txequvalent, $slde);
                }
                include(APP_FOLDER . '/views/admin/t_reservation/' . $fichier . '.php');
            } else {
                $dte1 = get('dte');
                $dte2 = AddDaysToDate($dte1, 1);
                $id_ch = get('ch');
                $nuite = NbJours($dte1, $dte2);
                $clients = GetListClientByNom($idsite, $bdd);
                $infosch = InfosChambres($idsite, $bdd);
                $nom_ch = $infosch['nom'][$id_ch];
                $tarif_ch1 = $infosch['tarif'][$id_ch];
                $monnaie_ch = $infosch['monnaie'][$id_ch];
                $tarif_ch2 = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $tarif_ch1);
                $usd = 0;
                $cdf = 0;
                $select['id'] = $id_ch;
                $select['qte'] = $nuite;
                $select['nom'] = $nom_ch;
                $select['prix'] = $tarif_ch2;
                $tva = $_SESSION['tva'];
                $select['monttva'] = CalculMontTva($select['prix'], $tva);
                $select['repas'] = '0';
                $panier->ajouterHeb($select);
                $ttc = $panier->montant_panierHeb();
                $totpaye = $ttc;
                $nbArticles = count($_SESSION['panier']['id_article']);
                include(APP_FOLDER . '/views/admin/t_reservation/Add.php');
            }
        } elseif (get('do') == 'majpaie') {
            $bdd = HDB::hus();
            $soldeusd = 0;
            $soldecdf = 0;
            $bool_serv = False;
            $id_resch = get('id_resch');
            $action = get('do');
            $modepaiements = GetModepaiement($bdd);
            $modecpt = count($modepaiements['id']);
            $services = GetListService($idsite, $bdd);
            $chambres = GetListChambre($idsite, $bdd);
            $responsables = GetListResponsable($_SESSION['company_id'], $bdd);
            $dte = date('Y-m-d');
            $fichier = 'sejourdata';
            $infofactch = InfosFactByChambre($id_resch, $bdd);
            $id_chx_ex = $infofactch->idchambre;
            $nom_client = $infofactch->nom_client;
            $id_fact = $infofactch->id_fact;
            $id_res = $infofactch->idreserv;
            $num_fact = $infofactch->num_fact;
            $tauxfact = $infofactch->taux;
            $tva = $infofactch->tva;
            $date_edition = $infofactch->date_edition;
            $date_occ = $infofactch->occupe;
            $date_lib = $infofactch->date_lib;
            $statut = $infofactch->statut;
            $nom_accomp = $infofactch->nom_accomp;
            $mode = $infofactch->mode;
            $nom_respo = NomRespoByIdRes($id_res, $bdd);
            $monnaie_ch = getsymbole_local();
            $totpaye = 0;
            $nuitesave = 1;
            $montpaye = TotalPayeByChambre($bdd, $id_resch);
            //$montpaye = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $tauxfact, $montpaye);
            $totpaye = $montpaye;
            $tot = $panier->montant_panierHeb();
            $tottva = CalculMontTva($tot, $tva);
            $ht = CalculMontHtHeb($tot, $tva);
            $ttc = CalculMontTtcHeb($ht, $tottva);
            $nbArticles = count($_SESSION['panier']['id_article']);
            //            $factures_heb = GetFacturesHeb($id_res, $bdd);
            //            $service = array();
            //            $service['id'] = array();
            //            $service['dte'] = array();
            //            $service['des'] = array();
            //            $service['type'] = array();
            //            $service['qte'] = array();
            //            $service['prix'] = array();
            //            $service['ttc'] = array();
            //            $service['tva'] = array();
            //            $service['ht'] = array();
            //            $service['solde'] = array();
            //            $service['mont_eqvlt'] = array();
            //            $service['tauxfact'] = array();
            //            $txequvalent =$_SESSION['Paie_taux'];
            //            foreach ($factures_heb as $fh) {
            //                $tp = $fh->type;
            //                $txp = $fh->taux;
            //                $totfct = 0;
            //                $dte_a = $fh->date_edition;
            //                if ($tp == 'hebergement' || ($tp == 'restaurant' && $fh->mode == 'Credit')) {
            //                    if ($tp == 'hebergement') {
            //                        $totfct = $ttc;
            //                    } else {
            //                        $bool_serv = TRUE;
            //                        $totfct = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_ttc);
            //                    }
            //                    if($tp == 'restaurant'){
            //                        $txequvalent=$txp;  
            //                    }
            //                    $ttpay = TotPayeHeb($fh->id_fact, $bdd);
            //                    $ttpay = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $ttpay);
            //                    $tva1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_tva);
            //                    $ht1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->montant_total);
            //                    $slde = $totfct - $ttpay;
            //                    array_push($service['id'], $fh->id_fact);
            //                    array_push($service['dte'], $dte_a);
            //                    array_push($service['des'], $fh->num_fact . ' ' . $tp);
            //                    array_push($service['type'], $tp);
            //                    array_push($service['qte'], '-');
            //                    array_push($service['prix'], '-');
            //                    array_push($service['ttc'], $totfct);
            //                    array_push($service['tva'], $tva1);
            //                    array_push($service['ht'], $ht1);
            //                    array_push($service['solde'], $slde);
            //                    array_push($service['tauxfact'], $txp);
            //                    $sldeeqvt = 0;
            //                    if ($_SESSION['Paie_affiche'] == getsymbole_local()) {
            //                        $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_devise(),$txequvalent, $slde);
            //                        $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_devise(), $sldeeqvt);
            //                    } else {
            //                        $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(),$txequvalent, $slde);
            //                        $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_local(), $sldeeqvt);
            //                    }
            //                    array_push($service['mont_eqvlt'], $msgevlt);
            //                }
            //            }
            $htresto = 0;
            $tvaresto = 0;
            $ttcresto = 0;

            $paiements = HistoPaiementHeb($id_fact, $bdd);
            $paiementsResto = HistoPaiementHebResto($id_resch, $bdd);
            include(APP_FOLDER . '/views/admin/t_reservation/' . $fichier . '.php');
        }
        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            //            $bdd = HDB::hus();
            //            $dte_a = dateToformatBdd(post('date_arrive'));
            //            $dte_s = dateToformatBdd(post('date_sortie'));
            //            $data = getchambreIndisponibles($idsite, $dte_a, $dte_s, $checkin, $checkout,$hrs_sys,$bdd);
            //            $nbre = count($data['chambres']['id']);
            //            if ($nbre>=1){
            //                $json['message'] = "Cette chambre n'est pas disponible à la période du ".dateAffiche($dte_a).' au '.dateAffiche($dte_s);
            //            }
            //            echo json_encode($json);
            //            var_dump($data);
            if ($_POST) {
                //form validation
                $bdd = HDB::hus();
                $solde = GetCaffOfDayHeb($bdd);
                $respo_id = post('respo_id');
                $prive = post('prive');
                $id_client = post('id_client');
                $id_ch = post('id_ch');
                $dte = dateToformatBdd(post('dte'));
                $dte_a = dateToformatBdd(post('date_arrive'));
                $dte_s = dateToformatBdd(post('date_sortie'));
                $motif = post('motif');
                $mode = post('mode');
                $montusd = post('usd');
                $montcdf = post('cdf');
                $libelle_mode = post('libelle_mode');
                $rendu_usd = post('rendu_usd');
                $rendu_cdf = post('rendu_cdf');
                $totrendu = post('totrendu');
                $totrendu2 = montant_equivalent_bdd($_SESSION['Paie_affiche'], $monnaie, $taux, $totrendu);
                $type_rendu = post('type_rendu');
                $compte1 = post('compte1');
                $compte2 = post('compte2');
                $nom_client = post('nom_client');
                if ($rendu_usd == '') {
                    $rendu_usd = 0;
                }
                if ($rendu_cdf == '') {
                    $rendu_cdf = 0;
                }
                $rendusaisi = $rendu_usd * $taux + $rendu_cdf;
                if ($type_rendu == 'non') {
                    $rendu_cdf = 0;
                    $rendu_usd = 0;
                    $rendusaisi = 0;
                }
                $montsaisi = $montusd * $taux + $montcdf;

                if (post('id_client') == '0') {
                    $json['message'] = "Veuillez choisir un client!";
                    $json['s'] = FALSE;
                    echo json_encode($json);
                }
                //                else if ($dte > $dte_a) {
                //                    $json['message'] = "La date d'édition doit être inférieure ou égale à celle d'arrivée!";
                //                    $json['s'] = FALSE;
                //                    echo json_encode($json);
                //                } 
                else if ($dte_a > $dte_s) {
                    $json['message'] = "La date d'arrivée doit être inférieure ou égale à celle de départ!";
                    $json['s'] = FALSE;
                    echo json_encode($json);
                } else if ($motif == 'occupe' && $dte_a > date('Y-m-d')) {
                    $json['message'] = "Pour l'occupation, la date d'arrivée doit être inférieure ou égale à " . date('d/m/Y');
                    $json['s'] = FALSE;
                    echo json_encode($json);
                } else if ($libelle_mode == 'Cash' && arrondir($montsaisi) == 0) {
                    $json['message'] = "Veuillez saisir le montant payé!";
                    $json['s'] = FALSE;
                    echo json_encode($json);
                } else if ((arrondir($rendusaisi) != arrondir($totrendu2)) && $libelle_mode == 'Cash' && $type_rendu == 'oui') {
                    //                     $totrendu = montant_equivalent_bdd($monnaie,$_SESSION['Paie_affiche'],$taux, $totrendu);
                    $json['message'] = 'La somme de deux montants rendus doit être égale à ' . afficheMontant($_SESSION['Paie_affiche'], $totrendu);
                    echo json_encode($json);
                } elseif ($rendu_usd > arrondir($solde['usd']) && $libelle_mode == 'Cash' && $type_rendu == 'oui' && $rendusaisi > 0) {
                    $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant(getsymbole_devise(), $rendu_usd - $solde['usd']) . ' avant de faire ce rendu!';
                    echo json_encode($json);
                } elseif ($rendu_cdf > arrondir($solde['cdf']) && $libelle_mode == 'Cash' && $type_rendu == 'oui' && $rendusaisi > 0) {
                    $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant(getsymbole_local(), $rendu_cdf - $solde['cdf']) . ' avant de faire ce rendu!';
                    $json['succes'] = False;
                    echo json_encode($json);
                } else if ($libelle_mode == 'Credit' && $prive == 0) {
                    $json['message'] = "Un client privé ou occasionnel ne peut pas payer à crédit!";
                    $json['s'] = FALSE;
                    echo json_encode($json);
                } else {
                    $data = getchambreIndisponibles2($id_ch, $dte_a, $dte_s, $checkin, $checkout, $hrs_sys, $bdd);
                    $idsch = post('idsch');
                    $nbre = count($data['chambres']['id']);
                    if ($nbre >= 1) {
                        $json['message'] = "Cette chambre n'est pas disponible à la période du " . dateAffiche($dte_a) . ' au ' . dateAffiche($dte_s);
                        echo json_encode($json);
                    } else {
                        $ch_histo = array();
                        $ch_histo['id'] = array();
                        $libcptfact = NUMFACTHEB;
                        $monnaie = $_SESSION['Paie_affiche'];
                        $m2 = $monnaie;
                        if ($m2 == getsymbole_devise()) {
                            $m2 = getsymbole_local();
                        }
                        $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                        $num_cmd_format = format_numero($num_cmd);
                        $prefixefact = $_SESSION['prefsanct'];
                        $numfact = $prefixefact . $num_cmd_format;
                        //Code Add
                        $prefixerec = $_SESSION['prefreservation'];
                        $numres = $prefixerec . $num_cmd_format;

                        $statut1 = $motif;
                        $fact1 = 0; //facture de la chambre libre
                        $hebmotif = 'hebergement';
                        $chiffre_aff = 1;
                        if ($motif == 'occupe') {
                            $motif = 'occupation';
                            $statut = 'execute';
                            $fact1 = 2;
                            $facture = "occupation";
                        } elseif ($motif == 'reserve') {
                            $motif = 'reservation';
                            $hebmotif = 'reservation';
                            $statut = 'operationnel';
                            $fact1 = 1;
                            $facture = "reservation";
                            $chiffre_aff = 0;
                        }
                        $statut_res = 'hebergement';
                        $nbresej = post('nbresej');
                        $mont_total_res = post('totfact');
                        $mont_total_res = montant_equivalent_bdd($monnaie, $m2, $taux, $mont_total_res);
                        $montantnuite = $mont_total_res / $nbresej;
                        $tauxremise = 0;
                        $nbArticles = count($_SESSION['panier']['id_article']);
                        $id_res = InsertReservation($id_client, $motif, $dte, $dte_a, $dte_s, $numres, $monnaie, $idsite, $statut, $statut_res, $mont_total_res, $montantnuite, $mode, $respo_id, $bdd);
                        $id_fact = InsertFactureHeb($statut_res, $numfact, $id_res, $taux, $tva, $monnaie, $facture, $dte, $id_client, $id_user, $idsite, $company_id, $mont_total_res, $tauxremise, $libelle_mode, $fact1, $compte1, $compte2, $chiffre_aff, $bdd);
                        $num_cmd += 1;
                        $compteurobj->Update($libcptfact, $num_cmd, $idsite);
                        $nom_accomp = post('accomp_id');
                        if ($nom_accomp != '0') {
                            $id_accomp = $nom_accomp;
                        } else {
                            $id_accomp = NULL;
                        }
                        $idres_ch = 0;
                        $chhisto_id = 0;
                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                            $tarif_ch = $_SESSION['panier']['prix'][$i];
                            $qte = $_SESSION['panier']['qte'][$i];
                            $tarif_ch = montant_equivalent_bdd($monnaie, $m2, $taux, $tarif_ch);
                            $idch = $_SESSION['panier']['id_article'][$i];
                            $service = $_SESSION['panier']['repas'][$i];
                            if ($service == '0') {
                                $idres_ch = InsertReserveChambre($id_res, $id_fact, $idch, $id_client, $statut1, $dte_a, $dte_s, $tarif_ch, $id_accomp, $nom_accomp, $checkin, $checkout, $idsite, $monnaie, $bdd);
                                $chhisto_id = InsertChambreHisto($idres_ch, $idch, $statut1, $dte_a, $dte_s, $tarif_ch, $monnaie, $qte, $bdd);
                                //ARRIVEE
                                $nuite = 1;
                                factChambre($nuite, $tarif_ch, $tarif_ch, $dte_a, $idch, $chhisto_id, $id_fact, $idsite, $bdd);
                            } elseif ($service == '1') {
                                $chhisto_id = InsertChambreHisto($idres_ch, $idch, 'service', $dte_a, $dte_s, $tarif_ch, $monnaie, $qte, $bdd);
                            }
                            array_push($ch_histo['id'], $chhisto_id);
                        }
                        $dtereglhr = date("Y-m-d H:i:s");
                        $libcptfact = NUM_REGLEMENTHEB;
                        $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                        $num_cmd_format = format_numero($num_cmd);
                        $prefixefact = $_SESSION['prefconge'];
                        $num_recu = $prefixefact . $num_cmd_format;
                        $regl_id = InsertReglement($num_recu, $id_fact, $dtereglhr, $dte, $id_user, $idsite, $bdd);
                        $num_cmd += 1;
                        $compteurobj->Update($libcptfact, $num_cmd, $idsite);
                        //Paiement
                        $rendu = 0;
                        $montremise = 0;
                        $justification = '';
                        $histch_id = NULL;
                        if ($mode == 3) {
                            //Credit
                            $montusd = 0;
                            $montcdf = 0;
                            $rendu = 0;
                            $rendu_usd = 0;
                            $rendu_cdf = 0;
                        } elseif ($mode == 1) {
                            //Don
                            $montusd = 0;
                            $montcdf = $mont_total_res;
                            $rendu = 0;
                            $rendu_usd = 0;
                            $rendu_cdf = 0;
                        }
                        InsertPaiement($montusd, $montcdf, $taux, $rendu, $rendu_usd, $rendu_cdf, $montremise, $justification, $mode, $regl_id, $idsite, $company_id, $histch_id, $idres_ch, $bdd);
                        $panier->initialiser();
                        //INTERACTION COMPTA
                        $module_id = 23;
                        $site_id = $_SESSION['id_hotel'];
                        ConfLinkMod($module_id, $site_id, $bdd);
                        if ($_SESSION['ConfLinkMod_lie'] == 1) {
                            $account = $compte1 . $compte2;
                            CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                            if ($motif == 'occupation') {
                                $dte = date('Y-m-d');
                                $dtetime = date('Y-m-d H:i:s');
                                $reference = $numfact;
                                $tauxop = $taux;
                                $beneficiaire = $_SESSION['Customer_nom_client'];
                                $site_id = $_SESSION['id_hotel'];
                                $user_id = $_SESSION['id_user'];
                                $devise = $_SESSION['Paie_affiche'];
                                if ($libelle_mode == 'Cash') {
                                    $libelle = "Paiement occupation";
                                    $mode = 'Cash';
                                    $montantusd = $montusd;
                                    $montantcdf = $montcdf;
                                    $montantsaisi = $montsaisi;
                                } elseif ($libelle_mode == 'Credit') {
                                    $libelle = "Occupation à crédit";
                                    $mode = 'Credit';
                                    $montantusd = 0;
                                    $montantcdf = 0;
                                    $montantsaisi = 0;
                                }
                                $montantnuite = post('totfact') / $nbresej;
                                $mont_tva = ($montantnuite * $tva) / 100;
                                $ht = $montantnuite - $mont_tva;
                                $ttc = $montantnuite;
                                $montantsaisi = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $tauxop, $montantsaisi);
                                $totfact = post('totfact');
                                $renduincdf = $rendu_cdf;
                                $renduinusd = $rendu_usd;
                                if ($montantsaisi <= $totfact) {
                                    $type_rendu = "non";
                                }
                                if ($renduincdf > 0 || $renduinusd > 0) {
                                    $type_rendu = "non";
                                }
                                // echo '$montantusd' . $montantusd;
                                // echo '$montantcdf' . $montantcdf;
                                // echo '$montantsaisi' . $montantsaisi;
                                // echo '$totfact' . $totfact;
                                // echo '$ttc ' . $ttc;
                                // echo '$devise ' . $devise;
                                // echo '$type_rendu ' . $type_rendu;
                                COMPTA_OCCUPATION_HEBERGE($renduincdf, $renduinusd, $montantnuite, $type_rendu, $reference, $dte, $dtetime, $mode, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                            } elseif ($motif == 'reservation') {
                                $dte = date('Y-m-d');
                                $dtetime = date('Y-m-d H:i:s');
                                $reference = $numfact;
                                $tauxop = $taux;
                                $beneficiaire = $_SESSION['Customer_nom_client'];
                                $site_id = $_SESSION['id_hotel'];
                                $user_id = $_SESSION['id_user'];
                                $devise = $_SESSION['Paie_affiche'];
                                if ($libelle_mode == 'Cash') {
                                    $libelle = "Paiement reservation";
                                    $mode = 'Cash';
                                    $montantusd = $montusd;
                                    $montantcdf = $montcdf;
                                    $montantsaisi = $montsaisi;
                                } elseif ($libelle_mode == 'Credit') {
                                    $libelle = "reservation à crédit";
                                    $mode = 'Credit';
                                    $montantusd = 0;
                                    $montantcdf = 0;
                                    $montantsaisi = 0;
                                }
                                //on recupere le montant total de la facture pour la reservation
                                $ttc = post('totfact');
                                $mont_tva = ($ttc * $tva) / 100;
                                $ht = $ttc - $mont_tva;
                                // echo '$montantusd' . $montantusd;
                                // echo '$montantcdf' . $montantcdf;
                                // echo '$ttc ' . $ttc;
                                // echo '$devise ' . $devise;
                                // echo '$ht ' . $ht;
                                // echo '$mont_tva ' . $mont_tva;
                                //on recupere le montant total de la facture pour la reservation
                                COMPTA_RESERVATION_HEBERGE($ttc, $type_rendu, $reference, $dte, $dtetime, $mode, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                            }
                        }
                        //INTERACTION COMPTA

                        $json['facture_id'] = $id_fact;
                        $json['idres_ch'] = $idres_ch;
                        $json['url_print'] = H_ADMIN . '&view=impression&do=fctheball&do2=0&id=' . $id_fact;
                        if ($hebmotif == 'reservation') {
                            $json['url_print'] = H_ADMIN . '&view=impression&do=fctheball&do2=4&id=' . $id_fact;
                        }
                        $json['reservation_id'] = $id_res;
                        $json['message'] = "Cette facture vient d'être enregistrée avec succès!";
                        $json['s'] = TRUE;
                        $json['url_planning'] = H_ADMIN . '&view=module&do=heb2';
                        echo json_encode($json);
                    }
                }
            }
        } elseif (get('do') == 'payerfact') {
            //Paiement de la facture d'une chambre
            $json['s'] = FALSE;
            $id_res = post('id_res');
            $id_fact = post('fact_heb_id');
            $tpservice = post('tp');
            $txfct1 = post('txfct1');
            if ($tpservice == 'restaurant') {
                $taux = $txfct1;
            }
            $id_fact1 = post('id_fact1');
            $montusd = post('usd');
            $montcdf = post('cdf');
            $rendu_usd = post('rendu_usd');
            $rendu_cdf = post('rendu_cdf');
            $totrendu1 = post('totrendu');
            $totrendu = montant_equivalent_bdd($monnaie, $m2, $taux, $totrendu1);
            $type_rendu = post('type_rendu');
            $ttc1 = post('ttc');
            $ttc = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux, $ttc1);
            $mode = post('mode');
            $num_fact = post('num_fact_paie');
            $libmode = 'Cash';
            if ($montusd == '') {
                $montusd = 0;
            }
            if ($montcdf == '') {
                $montcdf = 0;
            }
            if ($rendu_usd == '') {
                $rendu_usd = 0;
            }
            if ($rendu_cdf == '') {
                $rendu_cdf = 0;
            }
            if ($type_rendu == 'non') {
                $rendu_usd = 0;
                $rendu_cdf = 0;
            }
            $montantsaisi = $montusd * $taux + $montcdf;
            $rendusaisi = $rendu_usd * $taux + $rendu_cdf;
            // echo 'ttc   ' . $ttc;
            // echo 'montantsaisi   ' . $montantsaisi;
            if ($id_fact == '') {
                $json['message'] = "Veuillez sélectionner une facture!";
            } elseif ($montantsaisi != $ttc1 && $tpservice == 'restaurant') {
                $json['message'] = "Veuillez saisir correctement le montant";
            } elseif ($montantsaisi <= 0) {
                $json['message'] = "Veuillez saisir un montant supérieur à 0!";
                // } elseif ($rendusaisi > $totrendu && $mode != 1) {
                //     $json['message'] = "La somme de deux montants rendus doit être égale à " . afficheMontant($_SESSION['Paie_affiche'], $totrendu1);
            } else {
                $bdd = HDB::hus();
                $idres_ch = post('resch_id');
                $totpaye = post('totpaye');
                $dte = date('Y-m-d');
                $dtereglhr = date("Y-m-d H:i:s");
                $dtetime = $dtereglhr;
                $libcptfact = NUM_REGLEMENTHEB;
                $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                $num_cmd_format = format_numero($num_cmd);
                $prefixefact = $_SESSION['prefconge'];
                $num_recu = $prefixefact . $num_cmd_format;
                $regl_id = InsertReglement($num_recu, $id_fact, $dtereglhr, $dte, $id_user, $idsite, $bdd);
                //Paiement
                $rendu = 0;
                $montremise = 0;
                $justification = '';
                $histch_id = NULL;
                if ($mode == 1) {
                    //Don
                    $montusd = 0;
                    $montcdf = $ttc;
                    $rendu = 0;
                    $rendu_usd = 0;
                    $rendu_cdf = 0;
                    $libmode = 'Don';
                }
                $paie_id = InsertPaiement($montusd, $montcdf, $taux, $rendu, $rendu_usd, $rendu_cdf, $montremise, $justification, $mode, $regl_id, $idsite, $company_id, $histch_id, $idres_ch, $bdd);
                $num_cmd += 1;
                $compteurobj->Update($libcptfact, $num_cmd, $idsite);
                //INTERACTION COMPTA
                $module_id = 23;
                $site_id = $_SESSION['id_hotel'];
                ConfLinkMod($module_id, $site_id, $bdd);
                if ($_SESSION['ConfLinkMod_lie'] == 1) {
                    $compte1 = $_SESSION['ComptaCompte1'];
                    $compte2 = $_SESSION['ComptaCompte2'];
                    $nom_client = $_SESSION['ComptaCustomer'];
                    $account = $compte1 . $compte2;
                    CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                    if ($tpservice != 'restaurant') {
                        $reference = $num_fact;
                        $tauxop = $taux;
                        $libelle = "";
                        $beneficiaire = $nom_client;
                        $site_id = $_SESSION['id_hotel'];
                        $user_id = $_SESSION['id_user'];
                        $devise = $_SESSION['Paie_affiche'];
                        $montantusd = $montusd;
                        $montantcdf = $montcdf;
                        $ttc = post('ttc');
                        if ($ttc > 0) {
                            if ($devise == getsymbole_devise()) {
                                $ttc = montant_equivalent_bdd(getsymbole_local(), $devise, $tauxop, $ttc);
                            }
                            // echo 'montantusd  ' . $montantusd;
                            // echo 'montantcdf  ' . $montantcdf;
                            // echo 'tauxop  ' . $tauxop;
                            // echo 'ttc  ' . $ttc;
                            // echo 'devise  ' . $devise;

                            COMPTA_PAIE_HEBERGE($type_rendu, $reference, $dte, $dtetime, $libmode, $montantusd, $montantcdf, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                        } else {

                            COMPTA_PAIE_PLUS_HEBERGE($type_rendu, $reference, $dte, $dtetime, $libmode, $montantusd, $montantcdf, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                        }
                    } else {
                        $reference = $num_fact;
                        $montantusd = $montusd;
                        $montantcdf = $montcdf;
                        $montantsaisi = $montantsaisi;
                        $devise = $_SESSION['Paie_affiche'];
                        $tauxop = $taux;
                        $libelle = '';
                        $beneficiaire = $nom_client;
                        $site_id = $_SESSION['id_hotel'];
                        $user_id = $_SESSION['id_user'];
                        $ttc = post('ttc');
                        if ($devise == getsymbole_devise()) {
                            $ttc = montant_equivalent_bdd(getsymbole_local(), $devise, $tauxop, $ttc);
                        }
                        COMPTA_PAIE_RESTO($reference, $montantusd, $montantcdf, $montantsaisi, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd, $ttc);
                    }
                }
                //INTERACTION COMPTA
                $json['paie_id'] = $paie_id;
                $json['resch_id'] = $idres_ch;
                $json['id_res'] = $id_res;
                $json['id_fact'] = $id_fact1;
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        }
        //LIBERATION CHAMBRE //////////////////////////////////////////////////
        elseif (get('do') == 'libererchambre') {
            $bdd = HDB::hus();
            $nbre_nte = post('nbre_nte');
            $resch_id = post('resch_id');
            $id_res = post('id_res');
            $dte_l = post('dte_l');
            $dte_a = post('dte_a');
            $id_histo = post('id_histo');
            $id_fact = post('id_fact');
            LiberationChambre($resch_id, $dte_l, $nbre_nte, $id_histo, $id_res, $bdd);
            //Ajustement facturation au niveau de factChambre
            regularizeBilledNight($id_histo, $nbre_nte, $bdd);

            $json['statut'] = "Chambre libre";
            $json['url_planning'] = H_ADMIN . '&view=module&do=heb2';
            $json['facture_id'] = $id_fact;
            $json['resch_id'] = $resch_id;
            $json['s'] = TRUE;
            echo json_encode($json);
        }
        //OCCUPATION CHAMBRE //////////////////////////////////////////////////
        elseif (get('do') == 'occupch') {
            $bdd = HDB::hus();
            $resch_id = post('resch_id');
            $id_res = post('id_res');
            $dte_l = post('dte_l');
            $dte_a = post('dte_a');
            //Pour compta
            $compte1 = post('compte1');
            $compte2 = post('compte2');
            $nom_client = post('nom_client');
            $tva = post('tva');
            $id_fact = post('id_fact');
            $num_fact = post('num_fact');
            $taux = post('tauxcompta');
            $ttcfact = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux, post('ttccompta'));
            OccupationChambre($resch_id, $id_res, $id_fact, $bdd);
            //INTERACTION COMPTA
            $module_id = 23;
            $site_id = $_SESSION['id_hotel'];
            ConfLinkMod($module_id, $site_id, $bdd);
            if ($_SESSION['ConfLinkMod_lie'] == 1) {
                $account = $compte1 . $compte2;
                CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                $dte = date('Y-m-d');
                $dtetime = date('Y-m-d H:i:s');
                $reference = $num_fact;
                $tauxop = $taux;
                $beneficiaire = $_SESSION['Customer_nom_client'];
                $site_id = $_SESSION['id_hotel'];
                $user_id = $_SESSION['id_user'];
                $devise = getsymbole_devise();
                $ttc = $ttcfact;
                $mont_tva = ($ttc * $tva) / 100;
                $ht = $ttc - $mont_tva;
                $libelle = "";
                COMPTA_OCCUP_APRES_RESERV($reference, $dte, $dtetime, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
            }
            //INTERACTION COMPTA
            $json['statut'] = "Chambre occupée";
            $json['resch_id'] = $resch_id;
            $json['id_res'] = $id_res;
            $json['url'] = H_ADMIN . '&view=t_reservation&do=add&id_resch=' . $resch_id;
            $json['s'] = TRUE;
            echo json_encode($json);
        }
        //AJOUTER PERSONNE //////////////////////////////////////////////////
        elseif (get('do') == 'addpers') {
            $bdd = HDB::hus();
            $nom_client = post('nom_client');
            if ($nom_client == '') {
                $json['message'] = "Veuillez entrer un nom pour cette personne";
                $json['s'] = FALSE;
            } else {
                $date_naiss_client = dateToformatBdd(post('date_naiss_client'));
                $sexe_client = post('sexe_client');
                $etat_civil_client = post('etat_civil_client');
                $nationalite_client = post('nationalite_client');
                $provenance_client = post('provenance_client');
                $num_piece_identite_client = post('num_piece_identite_client');
                $num_passeport_client = post('num_passeport_client');
                $adresse_provenance_client = post('adresse_provenance_client');
                $email_client = post('email_client');
                $telephone_client = post('telephone_client');
                $num_pers_contacter_client = post('num_pers_contacter_client');
                $type = 'client';
                $id_hotel = $idsite;
                $suffixcompt = post('suffixcompt');
                $idcl = $clientobj->InsertHebergement($nom_client, $date_naiss_client, $sexe_client, $etat_civil_client, $nationalite_client, $provenance_client, $num_piece_identite_client, $num_passeport_client, $adresse_provenance_client, $email_client, $telephone_client, $num_pers_contacter_client, $type, $id_hotel, $suffixcompt);
                $numberincre = $_SESSION['numberincreaccountnumber'];
                $numberincre += 1;
                $libelle = "compteclient";
                setnumerotation($_SESSION['id_hotel'], $libelle, $numberincre, $bdd);
                $json['idcl'] = $idcl;
                $json['suffixcompt'] = $suffixcompt;
                $json['nom_client'] = $nom_client;

                $json['message'] = "Cet enregistrement vient de s'effectuer avec succes";
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'majaccomp') {
            $bdd = HDB::hus();
            $clients = GetListClientByNom($idsite, $bdd);
            include(APP_FOLDER . '/views/admin/t_client/comboaccompheb.php');
        } elseif (get('do') == 'majclient') {
            $bdd = HDB::hus();
            $clients = GetListClientByID($idsite, $bdd);
            include(APP_FOLDER . '/views/admin/t_client/comboclienthebmaj.php');
        }
        //DETAILS RECETTES //////////////////////////////////////////////////
        elseif (get('do') == 'detrecet') {
            $bdd = HDB::hus();
            $dte1 = get('dte1');
            $dte2 = $dte1;
            $result = GetListPaiement($idsite, $dte1, $dte2, $bdd);
            include(APP_FOLDER . '/views/admin/t_reservation/detailsrecette.php');
        } //LISTE DES RECTTES //////////////////////////////////////////////////
        elseif (get('do') == 'recette') {
            $bdd = HDB::hus();
            $per_dte = startEndDayMonth();
            $dte1 = $per_dte['sday'];
            $dte2 = $per_dte['eday'];
            $dte1_af = dateAffiche($dte1);
            $dte2_af = dateAffiche($dte2);
            $description = ' du ' . $dte1_af . ' au ' . $dte2_af;
            GetListRecette($idsite, $dte1, $dte2, $bdd);
            include(APP_FOLDER . '/views/admin/t_reservation/recette.php');
        } elseif (get('do') == 'recetteajx') {
            $bdd = HDB::hus();
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            GetListRecette($idsite, $dte1, $dte2, $bdd);
            include(APP_FOLDER . '/views/admin/t_reservation/datarecette.php');
        }
        //LISTE DES FACTURES //////////////////////////////////////////////////
        elseif (get('do') == 'factall' || get('do') == 'factallajx') {
            $bdd = HDB::hus();
            $action = get('do');
            $company_id = 299;
            $responsables = GetListResponsable($company_id, $bdd);
            $result = "";

            if ($action == 'factallajx') {
                $respo_id = post('respo_id');
                $dte1 = dateToformatBdd(post('dte1'));
                $dte2 = dateToformatBdd(post('dte2'));
                if ($respo_id == 0) {
                    $result = AllFactureHeb($idsite, $dte1, $dte2, $bdd);
                } else {
                    $result = AllFactureHebPartner($respo_id, $idsite, $dte1, $dte2, $bdd);
                }

                $fichier = '/views/admin/t_reservation/datafacttout.php';
            } else {
                $per_dte = startEndDayMonth();
                $dte1 = $per_dte['sday'];
                $dte2 = $per_dte['eday'];
                $result = AllFactureHeb($idsite, $dte1, $dte2, $bdd);
                $fichier = '/views/admin/t_reservation/factall.php';
            }
            include(APP_FOLDER . $fichier);
        }
        //DETAILS FACTURE //////////////////////////////////////////////////
        elseif (get('do') == 'detfact2') {
            $bdd = HDB::hus();
            if (get('do2') == 'maj') {
                $fichier = 'sejourdata';
            } else {
                $fichier = 'detailsfact2';
            }
            $bool_serv = FALSE;
            $_SESSION['dontprintserv'] = $bool_serv;
            $panier->initialiser();
            $id_fact = get('id');
            $infofactch = InfosFactByChambre2($id_fact, $bdd);
            $id_chx_ex = $infofactch->idchambre;
            $id_client = $infofactch->id_client;
            $nom_client = $infofactch->nom_client;
            $id_res = $infofactch->id_res;
            $num_fact = $infofactch->num_fact;
            $tauxfact = $infofactch->taux;
            $tva = $infofactch->tva;
            $date_edition = $infofactch->date_edition;
            $date_occ = $infofactch->occupe;
            $date_lib = $infofactch->date_lib;
            $statut = $infofactch->statut;
            $nom_accomp = $infofactch->nom_accomp;
            $id_resch = $infofactch->id_resch;
            $accompagne = 'oui';
            $mode = $infofactch->mode;
            $assujetti = $infofactch->assujetti;
            $hebstatut = $infofactch->heb;
            $num_bon_annul = $infofactch->num_cmd;
            $dte_annule = $infofactch->date_desactivation;
            $compte1 = $infofactch->compte1;
            $compte2 = $infofactch->compte2;
            $ttccompta = $infofactch->mont_ttc;
            $tauxcompta = $infofactch->taux;
            $montpenalite = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montpenalite);
            $montrenducl = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montremb);
            $montpaiecl = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $tauxfact, $infofactch->montpaie);
            if (empty($nom_accomp)) {
                $accompagne = 'non';
            }
            $nom_respo = NomRespoByIdRes($id_res, $bdd);
            $modepaiements = GetModepaiement($bdd);
            $modecpt = count($modepaiements['id']);
            $services = GetListService($idsite, $bdd);
            $chambres = GetListChambre($idsite, $bdd);
            $lignes = LignesFactByChambre($id_resch, $bdd);
            $monnaie_ch = getsymbole_local();
            $totpaye = 0;
            $nuitesave = 1;
            $num_reserv = GetNumReservation($id_res, $bdd);
            $num_recu_paie = GetNumRecu($id_fact, $bdd);
            foreach ($lignes as $rows) {
                $st = $rows->statut;
                $paiech = $rows->paie;
                $dte = date('Y-m-d');
                $dtecomp = $dte;
                if ($rows->date_occ < $dte) {
                    $dtecomp = DimunuerDaysToDate($dte, 1);
                }
                $nuite = NbJours($rows->date_occ, $dtecomp);
                $nuitesave = $nuite;
                if ($rows->statut == 'reserve' || $rows->statut == 'change' || $rows->statut == 'libre') {
                    $nuite = NbJours($rows->date_occ, $rows->date_lib);
                    if ($st == 'change' || $st == 'libre') {
                        $nuite = $rows->nuitee;
                    }
                    $dte = $rows->date_lib;
                    $dtecomp = $dte;
                }
                //Incrementation nuitée par rapport au checkin
                if (($rows->date_occ < $dte && $hrs_sys > $checkin) && ($rows->statut == 'occupe')) {
                    $nuite++;
                    $dtecomp = $dte;
                }

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
                $tarif_ch1 = $rows->tarif_ch;
                $tarif_ch2 = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $tauxfact, $tarif_ch1);
                if ($paiech == 0) {
                    $nuite = 0;
                }
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
            $montpaye = TotalPayeByChambre($bdd, $id_resch);
            //$montpaye = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $tauxfact, $montpaye);
            $totpaye = $montpaye;
            $tot = $panier->montant_panierHeb();
            $tottva = CalculMontTva($tot, $tva);
            $ht = CalculMontHtHeb($tot, $tva);
            $ttc = CalculMontTtcHeb($ht, $tottva);
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
            $service['solde_eqvlt'] = array();
            $service['mont_eqvlt'] = array();
            $service['tauxfact'] = array();
            $service['num_fact'] = array();
            $txequvalent = $_SESSION['Paie_taux'];
            foreach ($factures_heb as $fh) {
                $tp = $fh->type;
                $txp = $fh->taux;
                $totfct = 0;
                $dte_a = $fh->date_edition;
                if ($tp == 'hebergement' || ($tp == 'restaurant' && $fh->mode == 'Credit')) {
                    if ($tp == 'hebergement') {
                        $totfct = $ttc;
                    } else {
                        $totfct = $fh->mont_ttc;
                        $bool_serv = TRUE;
                    }
                    if ($tp == 'restaurant') {
                        $txequvalent = $txp;
                    }
                    $ttpay = TotPayeHeb($fh->id_fact, $bdd);
                    $ttpay = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $ttpay);
                    $tva1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_tva);
                    $ht1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->montant_total);
                    $slde = $totfct - $ttpay;
                    if ($tp == 'hebergement') {
                        $slde = $ttc - $ttpay;
                    }
                    array_push($service['id'], $fh->id_fact);
                    array_push($service['dte'], $dte_a);
                    array_push($service['des'], $fh->num_fact . ' ' . $tp);
                    array_push($service['type'], $tp);
                    array_push($service['qte'], '-');
                    array_push($service['prix'], '-');
                    array_push($service['ttc'], $totfct);
                    array_push($service['tva'], $tva1);
                    array_push($service['ht'], $ht1);
                    array_push($service['solde'], $ttc);
                    array_push($service['tauxfact'], $txp);
                    $sldeeqvt = 0;
                    if ($tp == 'hebergement') {
                        $slde = $ttc - $ttpay;
                    }
                    if ($_SESSION['Paie_affiche'] == getsymbole_local()) {
                        $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_devise(), $txequvalent, $slde);
                        $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_devise(), $sldeeqvt);
                    } else {
                        $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $txequvalent, $slde);
                        $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_local(), $sldeeqvt);
                    }
                    array_push($service['solde'], $slde);
                    array_push($service['solde_eqvlt'], $sldeeqvt);
                    array_push($service['mont_eqvlt'], $msgevlt);
                    array_push($service['num_fact'], $num_fact);
                }
            }
            $htresto = 0;
            $tvaresto = 0;
            $ttcresto = 0;
            $paiements = HistoPaiementHeb($id_fact, $bdd);
            $paiementsResto = HistoPaiementHebResto($id_resch, $bdd);
            include(APP_FOLDER . '/views/admin/t_reservation/' . $fichier . '.php');
        }
        //MODIFIER NUITEE //////////////////////////////////////////////////
        elseif (get('do') == 'upnuitee') {
            $select['qte'] = post('nbrnuitee');
            $nbArticles = count($_SESSION['panier']['id_article']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $select['id'] = $_SESSION['panier']['id_article'][$i];
                $panier->modifierQTeArticle($select);
            }
        }
        //MAJ MONTANT PAYE //////////////////////////////////////////////////
        elseif (get('do') == 'majmp2') {
            $bdd = HDB::hus();
            $id_res = get('id_res');
            $id_resch = get('resch_id');
            $id_fact = post('id_fact1');
            //          $ttc=post('ttc2');
            $ttc = $panier->montant_panierHeb();
            $modepaiements = GetModepaiement($bdd);
            $modecpt = count($modepaiements['id']);
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
            $service['tauxfact'] = array();
            $txequvalent = $_SESSION['Paie_taux'];
            foreach ($factures_heb as $fh) {
                $tp = $fh->type;
                $txp = $fh->taux;
                $totfct = 0;
                $dte_a = $fh->date_edition;
                if ($tp == 'hebergement' || ($tp == 'restaurant' && $fh->mode == 'Credit')) {
                    if ($tp == 'hebergement') {
                        $totfct = $ttc;
                    } else {
                        $totfct = $fh->mont_ttc;
                    }
                    if ($tp == 'restaurant') {
                        $txequvalent = $txp;
                    }
                    $ttpay = TotPayeHeb($fh->id_fact, $bdd);
                    $ttpay = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $ttpay);
                    $tva1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->mont_tva);
                    $ht1 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $fh->montant_total);
                    $slde = $totfct - $ttpay;
                    if ($slde > 0) {
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
                        array_push($service['tauxfact'], $txp);
                        $sldeeqvt = 0;
                        if ($_SESSION['Paie_affiche'] == getsymbole_local()) {
                            $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_devise(), $txequvalent, $slde);
                            $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_devise(), $sldeeqvt);
                        } else {
                            $sldeeqvt = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $txequvalent, $slde);
                            $msgevlt = afficheMontant($_SESSION['Paie_affiche'], $slde) . ' Soit ' . afficheMontant(getsymbole_local(), $sldeeqvt);
                        }
                        array_push($service['mont_eqvlt'], $msgevlt);
                    }
                }
            }
            include(APP_FOLDER . '/views/admin/t_reservation/bloc_paiement.php');
        }


        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id_res') == '') {
                    json_error('The field id_res cannot be empty!');
                } elseif (post('num_reserv') == '') {
                    json_error('The field num reserv cannot be empty!');
                } elseif (post('garantie') == '') {
                    json_error('The field garantie cannot be empty!');
                } elseif (post('num_bc') == '') {
                    json_error('The field num bc cannot be empty!');
                } elseif (post('num_occ') == '') {
                    json_error('The field num occ cannot be empty!');
                } elseif (post('num_com') == '') {
                    json_error('The field num com cannot be empty!');
                } elseif (post('type') == '') {
                    json_error('The field type cannot be empty!');
                } elseif (post('tva') == '') {
                    json_error('The field tva cannot be empty!');
                } elseif (post('taux') == '') {
                    json_error('The field taux cannot be empty!');
                } elseif (post('remise') == '') {
                    json_error('The field remise cannot be empty!');
                } elseif (post('majoration') == '') {
                    json_error('The field majoration cannot be empty!');
                } elseif (post('mont_nuite') == '') {
                    json_error('The field mont nuite cannot be empty!');
                } elseif (post('mont_total_res') == '') {
                    json_error('The field mont total res cannot be empty!');
                } elseif (post('mont_par_chambre') == '') {
                    json_error('The field mont par chambre cannot be empty!');
                } elseif (post('monnaie') == '') {
                    json_error('The field monnaie cannot be empty!');
                } elseif (post('nbr_ch') == '') {
                    json_error('The field nbr ch cannot be empty!');
                } elseif (post('etat') == '') {
                    json_error('The field etat cannot be empty!');
                } elseif (post('etat_credit') == '') {
                    json_error('The field etat credit cannot be empty!');
                } elseif (post('dte') == '') {
                    json_error('The field dte cannot be empty!');
                } elseif (post('date_res') == '') {
                    json_error('The field date res cannot be empty!');
                } elseif (post('date_occ') == '') {
                    json_error('The field date occ cannot be empty!');
                } elseif (post('date_lib') == '') {
                    json_error('The field date lib cannot be empty!');
                } elseif (post('statut_res') == '') {
                    json_error('The field statut res cannot be empty!');
                } elseif (post('statut_occ') == '') {
                    json_error('The field statut occ cannot be empty!');
                } elseif (post('statut_sorti') == '') {
                    json_error('The field statut sorti cannot be empty!');
                } elseif (post('id_client') == '') {
                    json_error('The field id client cannot be empty!');
                } elseif (post('chambr_id') == '') {
                    json_error('The field chambr id cannot be empty!');
                } elseif (post('id_hotel') == '') {
                    json_error('The field id hotel cannot be empty!');
                } elseif (post('dte_a') == '') {
                    json_error('The field dte a cannot be empty!');
                } elseif (post('dte_s') == '') {
                    json_error('The field dte s cannot be empty!');
                } elseif (post('occ_indirect') == '') {
                    json_error('The field occ indirect cannot be empty!');
                } elseif (post('respo_id') == '') {
                    json_error('The field respo id cannot be empty!');
                } else {
                    $this->t_reservation_model->Update(post('num_reserv'), post('garantie'), post('num_bc'), post('num_occ'), post('num_com'), post('type'), post('tva'), post('taux'), post('remise'), post('majoration'), post('mont_nuite'), post('mont_total_res'), post('mont_par_chambre'), post('monnaie'), post('nbr_ch'), post('etat'), post('etat_credit'), post('dte'), post('date_res'), post('date_occ'), post('date_lib'), post('statut_res'), post('statut_occ'), post('statut_sorti'), post('id_client'), post('chambr_id'), post('id_hotel'), post('dte_a'), post('dte_s'), post('occ_indirect'), post('respo_id'), post('id_res'));
                    json_send('' . H_ADMIN . '&view=t_reservation&id_res=' . post('id_res') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->t_reservation_model->SelectOne(get('id_res'));
            include(APP_FOLDER . '/views/admin/t_reservation/Details.php');
        }
        //AJOUTER LES SERVICES DANS SEJOUR //////////////////////////////////////////////
        elseif (get('do') == 'adservsej') {
            $bdd = HDB::hus();
            $service_ids = post('service_ids');
            $tarif_chs = post('tarif_ch');
            //$dte_a=post("dte_a1");
            $dte_a = date('Y-m-d');
            $dte = date('Y-m-d');
            $qte = post('nuite');
            $monnaie = getsymbole_local();
            $idres_ch = post("resch_id1");
            $id_res = post("id_res");
            $nbre = count($service_ids);
            $statut = 'service';
            $json['s'] = FALSE;
            if ($nbre > 0) {
                for ($i = 0; $i < $nbre; $i++) {
                    $idch = $service_ids[$i];
                    $prix = 'prix' . $idch;
                    $qte = 'qte' . $idch;
                    $tarif_ch = post($prix);
                    $tarif_ch = montant_equivalent_bdd($_SESSION['Paie_affiche'], $monnaie, $_SESSION['Paie_taux'], $tarif_ch);
                    $qte = post($qte);
                    $chhisto_id = InsertChambreHisto($idres_ch, $idch, $statut, $dte_a, $dte, $tarif_ch, $monnaie, $qte, $bdd);
                }
                $json['message'] = "L'opération a réussi!";
            } else {
                $json['message'] = "Veuillez cocher un élément!";
            }
            $json['resch_id'] = $idres_ch;
            $json['id_res'] = $id_res;
            $json['s'] = TRUE;
            echo json_encode($json);
        }
        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->t_reservation_model->TruncateTable('' . H_ADMIN . '&view=t_reservation&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/t_reservation/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id_res') and $dfile == '') {
                $del = $this->t_reservation_model->Delete(get('id_res'), '' . H_ADMIN . '&view=t_reservation&do=viewall&msg=delete');
            } elseif (get('id_res') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->t_reservation_model->Delete(get('id_res'), '' . H_ADMIN . '&view=t_reservation&do=viewall&msg=delete');
            } elseif (get('id_res') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=t_reservation&id_res=' . get('id_res') . '&do=update&msg=delete');
            }
        }
        //CHANGER DE CHAMBRE /////////////////////////////////////////////////
        elseif (get('do') == 'addchsej') {
            $bdd = HDB::hus();
            $json['s'] = FALSE;
            $dte = date('Y-m-d');
            $id_res = post('id_res2');
            $dte_in = post('dte_in');
            $date_lib = post('dte_lib1');
            $id_chx_ex = post('id_chx_ex');
            $id_reserv_chx = post('resch_id3');
            $id_chx_new = post('ch_ids');
            $nbre_nte = post('nbre_nte');
            $id_histo = post('id_histo');
            if ($id_chx_new == '') {
                $json['message'] = "Veuillez cocher une chambre ";
            }
            //            elseif($dte > $date_lib){
            //              $json['message'] = "Pas moyen de changer la chambre,car la date d'aujourd'hui dépasse celle de départ ".dateAffiche($date_lib);     
            //            }
            else {
                if ($dte > $date_lib) {
                    $date_lib = AddDaysToDate($dte, 1);
                }
                $name = 'price' . $id_chx_new;
                $tarif = post($name);
                $monnaie = getsymbole_local();
                $tarif_ch = montant_equivalent_bdd($_SESSION['Paie_affiche'], $monnaie, $_SESSION['Paie_taux'], $tarif);
                ChangerChambre($id_reserv_chx, $id_chx_ex, $id_chx_new, $dte_in, $date_lib, $monnaie, $tarif_ch, $nbre_nte, $id_histo, $bdd);
                $json['resch_id'] = $id_reserv_chx;
                $json['id_res'] = $id_res;
                //                $json['facture_id'] =$id_fact;
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        }
        //REDUCTION NUITEE /////////////////////////////////////////////////
        elseif (get('do') == 'rednuitee') {
            $json['s'] = FALSE;
            $id_res = post('id_res2');
            $nbrnuitee1 = post('nbrnuitee1');
            $nbrnuitee = post('nbrnuitee');
            $resch_id = post('resch_id1');
            $ch_histo_id = post('ch_histo_id');
            $dte_in = post('dte_in');
            $dte_s = AddDaysToDate($dte_in, $nbrnuitee);
            if ($ch_histo_id == '') {
                $json['message'] = "Veuillez sélectionner une chambre!";
            } elseif ($nbrnuitee == '') {
                $json['message'] = "Entrez un nombre de nuitée non nul";
            } elseif ($nbrnuitee1 == 0) {
                $json['message'] = "Impossible de modifier ce nombre de nuité!";
            } elseif (($nbrnuitee > $nbrnuitee1 || $nbrnuitee < 0)) {
                $json['message'] = "Entrez un nombre de nuitée non nul inférieur ou égal à " . $nbrnuitee1;
            } else {
                $select['id'] = $ch_histo_id;
                $select['qte'] = $nbrnuitee;
                $select['dte_s'] = $dte_s;
                $panier->UpdateQteAndDte($select);
                $json['resch_id'] = $resch_id;
                $json['id_res'] = $id_res;
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'rembourser') {
            $bdd = HDB::hus();
            $solde = GetCaffOfDayHeb($bdd);
            $id_fact = post('id_fact');
            $num_fact = post('num_fact');
            $idres_ch = post('resch_id');
            $id_res = post('id_res');
            $txfct = post('txfct');
            $montpaie = post('montpaie');
            $mode = 2;
            $rendu_usd = post('usd');
            $rendu_cdf = post('cdf');
            if ($rendu_usd == '') {
                $rendu_usd = 0;
            }
            if ($rendu_cdf == '') {
                $rendu_cdf = 0;
            }
            $montusd = 0;
            $montcdf = 0;
            $dte = date('Y-m-d');
            $totremb1 = post('totremb');
            $dtereglhr = date("Y-m-d H:i:s");
            $totremb = montant_equivalent_bdd($_SESSION['Paie_affiche'], $m2, $taux, $totremb1);
            $rendusaisi = $rendu_usd * $taux + $rendu_cdf;
            if ($rendusaisi != $totremb) {
                $json['message'] = 'La somme de deux montants saisis doit être égale à ' . afficheMontant($_SESSION['Paie_affiche'], $totremb1);
                echo json_encode($json);
            } elseif ($rendu_usd > arrondir($solde['usd'])) {
                $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant(getsymbole_devise(), $rendu_usd - $solde['usd']) . ' avant de faire ce rendu!';
                echo json_encode($json);
            } elseif ($rendu_cdf > arrondir($solde['cdf'])) {
                $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant(getsymbole_local(), $rendu_cdf - $solde['cdf']) . ' avant de faire ce rendu!';
                echo json_encode($json);
            } else {
                $libcptfact = NUM_REMBOURSEMENT;
                $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                $num_cmd_format = format_numero($num_cmd);
                $prefixefact = 'RBM';
                $num_recu = $prefixefact . $num_cmd_format;
                $regl_id = InsertReglement($num_recu, $id_fact, $dtereglhr, $dte, $id_user, $idsite, $bdd);
                //Paiement
                $rendu = 0;
                $montremise = 0;
                $justification = '';
                $histch_id = NULL;
                $paie_id = InsertPaiement($montusd, $montcdf, $taux, $rendu, $rendu_usd, $rendu_cdf, $montremise, $justification, $mode, $regl_id, $idsite, $company_id, $histch_id, $idres_ch, $bdd);
                $num_cmd += 1;
                $compteurobj->Update($libcptfact, $num_cmd, $idsite);
                UpdtRemboursement($id_fact, $totremb, $txfct, $montpaie, $bdd);
                //INTERACTION COMPTA
                $module_id = 23;
                $site_id = $_SESSION['id_hotel'];
                ConfLinkMod($module_id, $site_id, $bdd);
                if ($_SESSION['ConfLinkMod_lie'] == 1) {
                    $compte1 = $_SESSION['ComptaCompte1'];
                    $compte2 = $_SESSION['ComptaCompte2'];
                    $nom_client = $_SESSION['ComptaCustomer'];
                    $account = $compte1 . $compte2;
                    CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                    $reference = $num_fact;
                    $tauxop = $_SESSION['DataCompta_tauxfact'];
                    $libelle = "Remboursement client";
                    $beneficiaire = $nom_client;
                    $user_id = $_SESSION['id_user'];
                    $devise = $_SESSION['Paie_affiche'];
                    $montantusd = $rendu_usd;
                    $montantcdf = $rendu_cdf;
                    $dtetime = $dtereglhr;
                    COMPTA_REMBOURSEMENT($reference, $dte, $dtetime, $montantusd, $montantcdf, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                }
                //INTERACTION COMPTA
                $json['paie_id'] = $paie_id;
                $json['resch_id'] = $idres_ch;
                $json['id_res'] = $id_res;
                $json['id_fact'] = $id_fact;
                $json['url_planning'] = H_ADMIN . '&view=module&do=heb2';
                $json['s'] = TRUE;
                echo json_encode($json);
            }
        } elseif (get('do') == 'prtrmb') {
            $url_planning = get('url_planning');
            $json['url_planning'] = $url_planning;
            $json['s'] = TRUE;
            echo json_encode($json);
        } elseif (get('do') == 'uprespo') {
            $bdd = HDB::hus();
            $json['s'] = FALSE;
            $id_res = post('id_res2');
            $resch_id = post('resch_id1');
            $respo_id = post('resp_id');
            RespoUpdate($id_res, $respo_id, $bdd);
            $json['resch_id'] = $resch_id;
            $json['id_res'] = $id_res;
            $json['s'] = TRUE;
            echo json_encode($json);
        }
        //PRIX MODIFICATION/////////////////////////////////////////////////
        elseif (get('do') == 'upprice') {
            $json['s'] = FALSE;
            $id_res = post('id_res2');
            $resch_id = post('resch_id1');
            $ch_histo_id = post('ch_histo_id');
            $price = post('price');
            if ($ch_histo_id == '') {
                $json['message'] = "Veuillez sélectionner une chambre!";
            } elseif ($price == '') {
                $json['message'] = "Veuillez saisir un prix!";
            } elseif ($price < 0) {
                $json['message'] = "Veuillez saisir un prix supérieur 0!";
            } else {
                $json['ch_histo_id'] = $ch_histo_id;
                $json['resch_id'] = $resch_id;
                $json['id_res'] = $id_res;
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'uppricepro') {
            $json['s'] = FALSE;
            $id_res = post('id_res2');
            $resch_id = post('resch_id1');
            $tauxfact = post('tauxfact');
            $ch_histo_id = get('ch_histo_id');
            $price = post('price');
            if ($ch_histo_id == '') {
                $json['message'] = "Veuillez sélectionner une chambre!";
            } else {
                $bdd = HDB::hus();
                if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
                    $price = $price * $tauxfact;
                }
                PrixChambreUpdate($price, $ch_histo_id, $bdd);
                $json['ch_histo_id'] = $ch_histo_id;
                $json['resch_id'] = $resch_id;
                $json['id_res'] = $id_res;
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'annulerpaie') {
            //Annuler paiement
            $json['s'] = FALSE;
            $reglement_id = get('reglement_id');
            $resch_id = post('resch_id');
            if ($reglement_id == '') {
                $json['message'] = "Veuillez cliquer sur un bouton annuler!";
            } else {
                $bdd = HDB::hus();
                AnnulerPaiement($reglement_id, $bdd);
                //COMPTA
                $module_id = 23;
                $site_id = $_SESSION['id_hotel'];
                ConfLinkMod($module_id, $site_id, $bdd);
                if ($_SESSION['ConfLinkMod_lie'] == 1) {
                    $dte = date('Y-m-d');
                    $dtetime = date("Y-m-d H:i:s");
                    $refcompta = get('refcompta');
                    $montpaye = get('montpaye');
                    $devise = get('devise');
                    $tauxop = get('tauxop');
                    $benef = get('benef');
                    $id_client = get('idclient');
                    $site_id = $_SESSION['id_hotel'];
                    $user_id = $_SESSION['id_user'];
                    $libelle = "";
                    $beneficiaire = $benef;
                    $reference = $refcompta;
                    $type_client = '';
                    $montantcdf = 0;
                    $montantusd = 0;
                    $compte1 = $_SESSION['ComptaCompte1'];
                    $compte2 = $_SESSION['ComptaCompte2'];
                    $nom_client = $_SESSION['ComptaCustomer'];
                    $account = $compte1 . $compte2;
                    CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                    if ($devise == 'CDF') {
                        $montantcdf = $montpaye;
                    } else {
                        $montantusd = $montpaye;
                    }
                    AnnulationPaiemmentCompta($reference, $dte, $dtetime, $montantusd, $montantcdf, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                }
                //COMPTA
                $json['resch_id'] = $resch_id;
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'uptvapro') {
            $bdd = HDB::hus();
            $json['s'] = FALSE;
            $id_res = post('id_res2');
            $resch_id = post('resch_id1');
            $id_fact = post('id_fact');
            $assujetti = post('assujetti');
            TVAUpdateFacture($assujetti, $id_fact, $bdd);
            $json['resch_id'] = $resch_id;
            $json['id_res'] = $id_res;
            $json['s'] = TRUE;
            echo json_encode($json);
        } elseif (get('do') == 'verifmontremb') {
            $json['s'] = FALSE;
            $id_res = post('id_res2');
            $resch_id = post('resch_id1');
            $id_fact = post('idfct1');
            $montremb = post('montremb');
            $montpayeres = post('montpayeres');
            if ($montremb > $montpayeres) {
                $json['message'] = 'Le montant de la pénalité ne peut pas dépasser le montant payé.';
            } else {
                $json['resch_id'] = $resch_id;
                $json['id_res'] = $id_res;
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'annuleres') {
            $bdd = HDB::hus();
            $resannuleconfig = Getcfgannulationreservation($bdd);
            $solde = GetCaffOfDayHeb($bdd);
            $json['s'] = FALSE;
            $id_res = post('id_res2');
            $idres_ch = post('resch_id1');
            $id_fact = post('idfct1');
            $num_fact = post('num_fact');
            $montremb = post('montremb');
            $montpayeres = post('montpayeres');
            $id_histo = post('ch_histo2');
            $dtereglhr = date("Y-m-d H:i:s");
            $dte = date('Y-m-d');
            $rendu_usd = $montrembusd = post('usd');
            $rendu_cdf = $montrembcdf = post('cdf');
            $tauxfact = post('txfct');
            $totremb1 = $montpayeres - $montremb;
            $totalremb = $montpayeres - $montremb;
            $totremb = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $tauxfact, $totremb1);
            $rendusaisi = $rendu_usd * $tauxfact + $rendu_cdf;

            if ($rendusaisi != $totremb) {
                $json['message'] = 'La somme de deux montants saisis doit être égale à ' . afficheMontant($_SESSION['Paie_affiche'], $totremb1);
                //echo json_encode($json);
            } elseif ($rendu_usd > arrondir($solde['usd'])) {
                $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant(getsymbole_devise(), $rendu_usd - $solde['usd']) . ' avant de faire ce rendu!';
                // echo json_encode($json);
            } elseif ($rendu_cdf > arrondir($solde['cdf'])) {
                $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant(getsymbole_local(), $rendu_cdf - $solde['cdf']) . ' avant de faire ce rendu!';
                //echo json_encode($json);
            } else {
                $montpenalite = 0;
                if ($resannuleconfig->penalite == 1) {
                    $libcptfact = NUM_REGLEMENTHEB;
                    $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                    $num_cmd_format = format_numero($num_cmd);
                    $prefixefact = $_SESSION['prefconge'];
                    $num_recu = $prefixefact . $num_cmd_format;
                    $regl_id = InsertReglement($num_recu, $id_fact, $dtereglhr, $dte, $id_user, $idsite, $bdd);
                    $num_cmd += 1;
                    $compteurobj->Update($libcptfact, $num_cmd, $idsite);
                    //Paiement
                    $rendu = 0;
                    $montremise = 0;
                    $justification = '';
                    $histch_id = NULL;
                    $mode = 2;
                    $montusd = 0;
                    $montcdf = 0;
                    $rendu = 0;
                    $rendu_usd = 0;
                    $rendu_cdf = $totremb1;
                    $totremb = $montremb;
                    $montpenalite = $montremb;
                    if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
                        $rendu_cdf = $totremb1 * $tauxfact;
                        $montpenalite = $montremb * $tauxfact;
                    }
                    InsertPaiement($montusd, $montcdf, $taux, $rendu, $rendu_usd, $rendu_cdf, $montremise, $justification, $mode, $regl_id, $idsite, $company_id, $histch_id, $idres_ch, $bdd);
                    UpdtRemboursement($id_fact, $totalremb, $tauxfact, $montpayeres, $bdd);
                }
                SetMontsRembourFact($id_fact, $montrembusd, $montrembcdf, $bdd);
                $libcptfact = 'bonannuleres';
                $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                $num_cmd_format = format_numero($num_cmd);
                $prefixefact = 'AR';
                $num_recu = $prefixefact . $num_cmd_format;
                UpdateFacthebres($id_fact, $num_recu, $dte, $montpenalite, $bdd);
                LiberationChambre3($idres_ch, $bdd);
                $compteurobj->Update($libcptfact, $num_cmd + 1, $idsite);
                //INTERACTION COMPTA
                $module_id = 23;
                $site_id = $_SESSION['id_hotel'];
                // $id_client = $_SESSION['DataCompta_Idclient'];
                // $nom_client = $_SESSION['DataCompta_nom_client'];
                ConfLinkMod($module_id, $site_id, $bdd);
                if ($_SESSION['ConfLinkMod_lie'] == 1) {
                    $compte1 = $_SESSION['ComptaCompte1'];
                    $compte2 = $_SESSION['ComptaCompte2'];
                    $nom_client = $_SESSION['ComptaCustomer'];
                    $account = $compte1 . $compte2;
                    CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                    $reference = $num_fact;
                    $tauxop = $_SESSION['DataCompta_tauxfact'];
                    $libelle = "";
                    $beneficiaire = $nom_client;
                    $site_id = $_SESSION['id_hotel'];
                    $user_id = $_SESSION['id_user'];
                    $devise = $_SESSION['Paie_affiche'];
                    $montantusd = post('usd');
                    $montantcdf = post('cdf');
                    $dtetime = $dtereglhr;
                    COMPTA_REMBOURSEMENT_ANNULATION($reference, $dte, $dtetime, $montantusd, $montantcdf, $montpenalite, $montpayeres, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                }
                //INTERACTION COMPTA
                $json['s'] = TRUE;
                $json['facture_id'] = $id_fact;
                $json['resch_id'] = $idres_ch;
                $json['url_planning'] = H_ADMIN . '&view=module&do=heb2';
            }
            echo json_encode($json);
        } elseif (get('do') == 'annuleroccup') {
            $bdd = HDB::hus();
            $json['s'] = FALSE;
            $id_res = post('id_res2');
            $idres_ch = post('resch_id1');
            $id_fact = post('idfct1');
            $num_fact = post('num_fact');
            $montremb = post('montremb');
            $montpayeres = post('montpayeres');
            $id_histo = post('ch_histo2');
            $dtereglhr = date("Y-m-d H:i:s");
            $dte = date('Y-m-d');
            // $rendu_usd = post('usd');
            // $rendu_cdf = post('cdf');
            $tauxfact = post('txfct');
            $solde = GetCaffOfDayHeb($bdd);
            $montrembusd = $montremb;
            $montrembcdf = 0;
            // echo $solde['usd'] . '/';
            // echo $solde['cdf'] . '/';
            // echo $montrembusd . '/';
            // echo $montrembcdf . '/';


            if ($montrembusd > arrondir($solde['usd'])) {
                $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant(getsymbole_devise(), $montrembusd - $solde['usd']) . ' avant de faire ce rendu!';
                // echo json_encode($json);
            } elseif ($montrembcdf > arrondir($solde['cdf'])) {
                $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant(getsymbole_local(), $montrembcdf - $solde['cdf']) . ' avant de faire ce rendu!';
                //echo json_encode($json);
            } else {
                // $totremb1 = $montpayeres - $montremb;
                // $totalremb = $montpayeres - $montremb;
                // $totremb = montant_equivalent_bdd($_SESSION['Paie_affiche'], getsymbole_local(), $tauxfact, $totremb1);
                // $rendusaisi = $rendu_usd * $tauxfact + $rendu_cdf; 
                $libcptfact = 'bonannuleroccup';
                $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                $num_cmd_format = format_numero($num_cmd);
                $prefixefact = 'AO';
                $num_recu = $prefixefact . $num_cmd_format;
                $montpenalite = 0;
                UpdateFacthebres($id_fact, $num_recu, $dte, $montpenalite, $bdd);
                LiberationChambre3($idres_ch, $bdd);
                $compteurobj->Update($libcptfact, $num_cmd + 1, $idsite);
                SetMontsRembourFact($id_fact, $montrembusd, $montrembcdf, $bdd);
                //INTERACTION COMPTA
                $module_id = 23;
                $site_id = $_SESSION['id_hotel'];
                ConfLinkMod($module_id, $site_id, $bdd);
                if ($_SESSION['ConfLinkMod_lie'] == 1) {
                    $compte1 = $_SESSION['ComptaCompte1'];
                    $compte2 = $_SESSION['ComptaCompte2'];
                    $nom_client = $_SESSION['ComptaCustomer'];
                    $account = $compte1 . $compte2;
                    CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                    $reference = $num_fact;
                    $tauxop = $_SESSION['DataCompta_tauxfact'];
                    $libelle = "";
                    $beneficiaire = $nom_client;
                    $site_id = $_SESSION['id_hotel'];
                    $user_id = $_SESSION['id_user'];
                    $devise = $_SESSION['Paie_affiche'];
                    $dtetime = $dtereglhr;
                    $libmodefact = post('modefac');
                    $tva = post('tva');
                    $ttc = post('totfct');
                    $devise = getsymbole_devise();
                    $tauxop = post('txfct');
                    $montanttva = ($ttc * $tva) / 100;
                    $ht = $ttc - $montanttva;
                    COMPTA_ANNULATION_FAC_HEB($id_fact, $libmodefact, $reference, $dte, $dtetime, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                }
                //INTERACTION COMPTA
                $json['s'] = TRUE;
                $json['facture_id'] = $id_fact;
                $json['resch_id'] = $idres_ch;
                $json['url_planning'] = H_ADMIN . '&view=module&do=heb2';
            }
            echo json_encode($json);
        } elseif (get('do') == 'recettecl') {
            $bdd = HDB::hus();
            //$per_dte = startEndDayMonth();
            $dte1 = dateToformatBdd(get('dte1'));
            $dte2 = dateToformatBdd(get('dte2'));
            $dte1_af = dateAffiche($dte1);
            $dte2_af = dateAffiche($dte2);
            $description = ' du ' . $dte1_af . ' au ' . $dte2_af;
            $recettes = GetSejourClient($idsite, $dte1, $dte2, $bdd);
            paieSejour($idsite, $dte1, $dte2, $bdd);
            include(APP_FOLDER . '/views/admin/t_reservation/datarecettecl.php');
        } elseif (get('do') == 'recettejr') {
            $bdd = HDB::hus();
            $dte1 = dateToformatBdd(get('dte1'));
            $dte2 = dateToformatBdd(get('dte2'));
            $dte1_af = dateAffiche($dte1);
            $dte2_af = dateAffiche($dte2);
            $description = ' du ' . $dte1_af . ' au ' . $dte2_af;
            GetListRecette($idsite, $dte1, $dte2, $bdd);
            include(APP_FOLDER . '/views/admin/t_reservation/datarecettejr.php');
        } elseif (get('do') == 'recetteclajx') {
            $bdd = HDB::hus();
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            $dte1_af = dateAffiche($dte1);
            $dte2_af = dateAffiche($dte2);
            $description = ' du ' . $dte1_af . ' au ' . $dte2_af;
            $recettes = GetSejourClient($idsite, $dte1, $dte2, $bdd);
            //            paieSejour($idsite, $dte1, $dte2, $bdd);
            include(APP_FOLDER . '/views/admin/t_reservation/datarecettecl.php');
        } elseif (get('do') == 'dontprintserv') {
            if ($_SESSION['dontprintserv'] == TRUE) {
                $_SESSION['dontprintserv'] = FALSE;
            } else {
                $_SESSION['dontprintserv'] = TRUE;
            }
        } elseif (get('do') == 'ProcGenAccount') {
            $bdd = HDB::hus();
            $libelle = 'compteclient';
            $numberincre = getnumerotation($_SESSION['id_hotel'], $libelle, $bdd);
            $accountnumber = str_pad($numberincre, 4, "0", STR_PAD_LEFT);
            $_SESSION['numberincreaccountnumber'] = $numberincre;
            $_SESSION['accountnumber'] = $accountnumber;
            echo $accountnumber;
        }
    }

    //end invoke
}

//end class
?>
	