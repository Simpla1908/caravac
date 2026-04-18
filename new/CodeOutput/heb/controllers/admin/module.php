
<?php

/*
 * =======================================================================
 * FILE NAME:        module.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		module
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/module.php');
include_once(APP_FOLDER . '/models/objects/Panier.php');
include_once(APP_FOLDER . '/models/objects/compteur.php');

class module_controller
{

    public $module_model;

    public function __construct()
    {
        $this->module_model = new module_model();
    }

    public function invoke_module()
    {
        $panier = new Panier();
        $compteurobj = new compteur_model();
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->module_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->module_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=module&do=viewall');
            } else {
                $result = $this->module_model->SelectAll();
            }
            include(APP_FOLDER . '/views/admin/module/View.php');
        } elseif (get('do') == 'rh') {
            include(APP_FOLDER . '/views/admin/module/Rh.php');
        } elseif (get('do') == 'mcr') {
            include(APP_FOLDER . '/views/admin/module/Mcr.php');
        } elseif (get('do') == 'fact') {
            include(APP_FOLDER . '/views/admin/module/Fact.php');
            $module_id = 27;
            $site_id = $_SESSION['idsite'];
            ConfigModule($module_id, $site_id);
        } elseif (get('do') == 'achat') {
            include(APP_FOLDER . '/views/admin/module/Achat.php');
        } elseif (get('do') == 'heb2') {
            $bdd = HDB::hus();
            //Annulation reservation
            $dte = date('Y-m-d');
            $hrs_sys = date('H:i') . ':00';
            $idsite = $_SESSION['idsite'];
            $id_user = $_SESSION['id_user'];
            $taux = $_SESSION['Paie_taux'];
            $company_id = $_SESSION['company_id'];
            $resannuleconfig = Getcfgannulationreservation($bdd);
            $valmont = $resannuleconfig->valmont;
            $nbrejr = 1;
            $montremb = 0;
            $tarif_chfc = 0;
            $reservations = listereservations($bdd);
            foreach ($reservations as $r) {
                $dte_arrive = $r->occupe;
                $dteannule = AddDaysToDate($dte_arrive, $nbrejr);
                $id_fact = $r->id_fact;
                $idres_ch = $r->id;
                $tarif_chfc = $r->tarif_ch;
                $tarif_chfc1 = $r->tarif_ch;
                $txequvalent = $r->taux;
                $tarif_ch = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txequvalent, $tarif_chfc1);
                //                if ($dte >= $dteannule && $hrs_sys > $_SESSION['checkout']){
                if ($dte >= $dteannule) {
                    if ($resannuleconfig->penalite == 1) {
                        $montpaye = TotalPayeByChambre($bdd, $idres_ch);
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
                        //                        $dtereglhr = date("Y-m-d H:i:s");
                        //                        $libcptfact = NUM_REGLEMENTHEB;
                        //                        $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                        //                        $num_cmd_format = format_numero($num_cmd);
                        //                        $prefixefact = $_SESSION['prefconge'];
                        //                        $num_recu = $prefixefact . $num_cmd_format;
                        //                        $regl_id = InsertReglement($num_recu, $id_fact, $dtereglhr, $dte, $id_user, $idsite, $bdd);
                        //                        $num_cmd+=1;
                        //                        $compteurobj->Update($libcptfact, $num_cmd, $idsite);
                        //Paiement
                        //                        $rendu = 0;
                        //                        $montremise = 0;
                        //                        $justification = '';
                        //                        $histch_id = NULL;
                        //                        $mode = 2;
                        //                        $montusd = 0;
                        //                        $montcdf = 0;
                        //                        $rendu = 0;
                        //                        $rendu_usd = 0;
                        //                        $rendu_cdf = $montremb;
                        //                        $nbre_nte = 1;
                        //                        InsertPaiement($montusd, $montcdf, $taux, $rendu, $rendu_usd, $rendu_cdf, $montremise, $justification, $mode, $regl_id, $idsite, $company_id, $histch_id, $idres_ch, $bdd);
                    }
                    //                    $libcptfact='bonannuleres';
                    //                    $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
                    //                    $num_cmd_format = format_numero($num_cmd);
                    //                    $prefixefact ='AR';
                    //                    $num_recu = $prefixefact . $num_cmd_format;
                    $num_recu = '';
                    UpdateFacthebres($id_fact, $num_recu, $dteannule, $montremb, $bdd);
                    LiberationChambre3($idres_ch, $bdd);
                    //$compteurobj->Update($libcptfact,$num_cmd,$idsite);
                }
            }
            //Fin Annulation
            $module_id = 23;
            $site_id = $_SESSION['idsite'];
            ConfigModule2($module_id, $site_id, $bdd);
            $panier->initialiser();
            $per_dte = startEndDayWeek();
            $idsite = $_SESSION['idsite'];
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
            $dte1 = $per_dte['sday'];
            $dte2 = $per_dte['eday'];
            $today = date('Y-m-d');
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
                        $inscrits3[$chambre_id][$dte_a] = $statut;
                        $inscrits4[$chambre_id][$dte_a] = $ch->id;
                        $inscrits5[$chambre_id][$dte_a] = $ch->date_lib;
                    }
                }
            }
            include(APP_FOLDER . '/views/admin/module/hebergement.php');
        }
    }

    //end invoke
}

//end class
?>
	