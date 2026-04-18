
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

class module_controller {

    public $module_model;

    public function __construct() {
        $this->module_model = new module_model();
    }

    public function invoke_module() {
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
        }if (get('do') == 'fusion') {
            $bdd = HDB::hus();
            $id = $_SESSION['company_id'];
            $niveau = 1;
            $date_bd1 = '2019-08-01';
            $date_bd2 = '2019-08-30';
            DetailsVenteGlobal($id, $date_bd1, $date_bd2, $niveau, $bdd);
            $nbre_rows = count($_SESSION['prod']['id']);
            include(APP_FOLDER . '/views/admin/module/vente.php');
        }
    }

//end invoke
}

//end class
?>
	