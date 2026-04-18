
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

include(APP_FOLDER . '/models/objects/facconditionpaie.php');

class facconditionpaie_controller {

    public $facconditionpaie_model;

    public function __construct() {
        $this->facconditionpaie_model = new facconditionpaie_model();
    }

    public function invoke_facconditionpaie() {

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $result = $this->facconditionpaie_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/facconditionpaie/View.php');
        }

        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/facconditionpaie/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('des') == '') {
                    json_error('Veuillez saisir une designation!');
                } elseif (post('njrs') == '') {
                    json_error('Veuillez saisir le nombre de jours!');
                } else {
                   $des=post('des');
                   $njrs=post('njrs');
                    $this->facconditionpaie_model->Insert(post('des'), post('njrs'),post('site_id'));
                    json_send('' . H_ADMIN . '&view=facconditionpaie&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->facconditionpaie_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/facconditionpaie/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                 if (post('des') == '') {
                    json_error('Veuillez saisir une designation!');
                } elseif (post('njrs') == '') {
                    json_error('Veuillez saisir le nombre de jours!');
                } else {
                    $des=post('des');
                   $njrs=post('njrs');
                    $this->facconditionpaie_model->Update(post('des'), post('njrs'),post('site_id'), post('id'));
                    json_send('' . H_ADMIN . '&view=facconditionpaie&id=' . post('id') . '&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        }
         //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
        $this->facconditionpaie_model->Delete(get('id'), '' . H_ADMIN . '&view=facconditionpaie&do=viewall&msg=delete');
    }



    }

//end invoke
}

//end class
?>
	