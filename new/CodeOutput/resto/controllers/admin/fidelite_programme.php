
<?php

/*
 * =======================================================================
 * FILE NAME:        rescategorie.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		rescategorie
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/fidelite_programme.php');

class fidelite_programme_controller
{

    public $fidelite_programme_model;

    public function __construct()
    {
        $this->fidelite_programme_model = new fidelite_programme_model();
    }

    public function invoke_fidelite_programme()
    {

        //UPDATE //////////////////////////////////////////////////
        if (get('do') == 'update') {
            $rows = $this->fidelite_programme_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/fidelite_programme/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('des') == '') {
                    json_error('Veuillez saisir la designation!');
                } elseif (post('points') == '') {
                    json_error('Veuillez saisir les points!');
                } elseif (post('montant') == '') {
                    json_error('Veuillez saisir le montant!');
                } elseif (post('montantdep') == '') {
                    json_error('Veuillez saisir le montant depensé!');
                } elseif (post('taux') == '') {
                    json_error('Veuillez saisir le taux!');
                } else {

                    $this->fidelite_programme_model->Update(post('des'), post('points'), post('montant'), post('devise'), post('taux'), post('montantdep'), post('id'));
                    json_send('' . H_ADMIN . '&view=fidelite_programme&do=update&id=1&msg=update');
                    json_success('Process Completed');
                }
            }
        }
    }

    //end invoke
}

//end class
?>
	