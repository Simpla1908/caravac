
<?php

/*
 * =======================================================================
 * FILE NAME:        resconfig.php
 * DATE CREATED:  	08-02-2018
 * FOR TABLE:  		resconfig
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/paramstk.php');

class paramstk_controller
{

    public $paramstk_model;

    public function __construct()
    {
        $this->paramstk_model = new paramstk_model();
    }

    public function invoke_paramstk()
    {

        //UPDATE //////////////////////////////////////////////////
        if (get('do') == 'update') {
            $site_id = get('id');
            $rows = $this->paramstk_model->SelectOne($site_id);
            include(APP_FOLDER . '/views/admin/paramstk/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('m_insert') == '') {
                    json_error("Veuillez saisir la monnaie d'insertion!");
                } elseif (post('m_affiche') == '') {
                    json_error("Veuillez saisir la monnaie d'affichage!");
                } elseif (post('tauxdollar') == '') {
                    json_error("Veuillez saisir le taux du jour!");
                } elseif (post('tva') == '') {
                    json_error("Veuillez saisir la tva!");
                } else {
                    $sql = "m_insert=:m_insert,m_affiche=:m_affiche,tauxdollar =:tauxdollar,tva =:tva,stock =:stock WHERE id_hotel = :id";
                    $data = array(':m_insert' => post('m_insert'), ':m_affiche' => post('m_affiche'), ':tauxdollar' => post('tauxdollar'), ':tva' => post('tva'), ':stock' => post('stock'), ':id' => post('id'));
                    HDB::hus()->Hupdate('t_reglage', $sql, $data);
                    //Mise en session
                    // $_SESSION['prefconge'] = post('prefconge');
                    // $_SESSION['prefsanct'] = post('prefsanct');
                    // $_SESSION['liestock'] = post('liestock');
                    // $_SESSION['infofact'] = post('infofact');
                    // $_SESSION['msgmail'] = post('msgmail');
                    // $_SESSION['sujetmail'] = post('sujetmail');
                    //Fin mise en session
                    json_send('' . H_ADMIN . '&view=paramstk&mo=24&do=paramstk&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'paramstk') {
            $module_id = get('mo');
            $site_id = $_SESSION['id_hotel'];
            $rows = $this->paramstk_model->SelectOne($site_id);
            include(APP_FOLDER . '/views/admin/paramstk/Details.php');
        }
    }

    //end invoke
}

//end class
?>
	