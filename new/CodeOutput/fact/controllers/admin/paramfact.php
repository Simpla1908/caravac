
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

include(APP_FOLDER . '/models/objects/paramfact.php');

class paramfact_controller
{

    public $paramfact_model;

    public function __construct()
    {
        $this->paramfact_model = new paramfact_model();
    }

    public function invoke_paramfact()
    {

        //UPDATE //////////////////////////////////////////////////
        if (get('do') == 'update') {
            $module_id = get('id');
            $rows = $this->paramfact_model->SelectOne($module_id);
            include(APP_FOLDER . '/views/admin/paramfact/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('prefconge') == '') {
                    json_error("Veuillez saisir le préfixe de la facture!");
                } elseif (post('prefsanct') == '') {
                    json_error("Veuillez saisir le préfixe du reçu!");
                } else {
                    $sql = "prefconge=:prefconge,prefsanct=:prefsanct,liestock =:liestock,infofact =:infofact,sujetmail =:sujetmail,msgmail =:msgmail WHERE module_id = :id";
                    $data = array(':prefconge' => post('prefconge'), ':prefsanct' => post('prefsanct'), ':liestock' => post('liestock'), ':infofact' => post('infofact'), ':sujetmail' => post('sujetmail'), ':msgmail' => post('msgmail'), ':id' => post('id'));
                    HDB::hus()->Hupdate('resconfig', $sql, $data);
                    //Mise en session
                    $_SESSION['prefconge'] = post('prefconge');
                    $_SESSION['prefsanct'] = post('prefsanct');
                    $_SESSION['liestock'] = post('liestock');
                    $_SESSION['infofact'] = post('infofact');
                    $_SESSION['msgmail'] = post('msgmail');
                    $_SESSION['sujetmail'] = post('sujetmail');
                    //Fin mise en session
                    json_send('' . H_ADMIN . '&view=paramfact&mo=' . post('id') . '&do=paramfact&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'paramfact') {
            $module_id = get('mo');
            $rows = $this->paramfact_model->SelectOne($module_id);
            include(APP_FOLDER . '/views/admin/paramfact/Details.php');
        }
    }

    //end invoke
}

//end class
?>
	