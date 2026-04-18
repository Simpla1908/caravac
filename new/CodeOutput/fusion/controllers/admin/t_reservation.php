
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
include_once(APP_FOLDER . '/models/objects/compteur.php');

class t_reservation_controller {

    public $t_reservation_model;

    public function __construct() {
        $this->t_reservation_model = new t_reservation_model();
    }

    public function invoke_t_reservation() {
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
        $hrs_sys = date('H:i') . ':00';
        $compteurobj = new compteur_model();
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
        }elseif (get('do') =="venteajx"){
            $bdd = HDB::hus();
            $site_id=post('site_id');
            $niveau=post('niveau');
            $id = $_SESSION['company_id'];
            if($site_id!=0){
              $id =$site_id;
            }
            $dte1 =dateToformatBdd(post('dte1'));
            $dte2 =dateToformatBdd(post('dte2'));
            $dte1_af = dateAffiche($dte1);
            $dte2_af = dateAffiche($dte2);
            $description = ' du ' . $dte1_af . ' au ' . $dte2_af;
            DetailsVenteGlobal($id,$dte1,$dte2, $niveau, $bdd);
            $nbre_rows = count($_SESSION['prod']['id']);
            include(APP_FOLDER . '/views/admin/suivi/dataventeglobal.php');
        }
    }

//end invoke
}

//end class
?>
	