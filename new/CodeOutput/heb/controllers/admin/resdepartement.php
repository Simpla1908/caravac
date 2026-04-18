<?php

/*
* =======================================================================
* FILE NAME:        resdepartement.php
* DATE CREATED:  	17-11-2017
* FOR TABLE:  		resdepartement
* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
* =======================================================================
*/

if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/resdepartement.php');

class resdepartement_controller
{
    public $resdepartement_model;

    public function __construct()
    {
        $this->resdepartement_model = new resdepartement_model();
    }

    public function invoke_resdepartement()
    {

        //SELECT ALL //////////////////////////////////
        if (get('do') == 'viewall') {
            $result = $this->resdepartement_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resdepartement/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////
        if (get('do') == 'export') {
            $result = $this->resdepartement_model->SelectAll();
            include(APP_FOLDER . '/views/admin/resdepartement/Export.php');
        } //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->resdepartement_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resdepartement/Export2.php');
        } //SEARCH SUGGEST ////////////////////////////////////////////////////
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->resdepartement_model->AutoSearch(trim($qstring), 10, 'libelle');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=resdepartement&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->libelle . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        } //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/resdepartement/Add.php');
        } //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('libelle') == '') {
                    json_error('The field libelle cannot be empty!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } else {
                    $this->resdepartement_model->Insert(post('libelle'), post('psedo'), post('site_id'));
                    json_send('' . H_ADMIN . '&view=resdepartement&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        } //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->resdepartement_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resdepartement/Update.php');
        } //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('libelle') == '') {
                    json_error('Le champ désignation ne peut pas être vide!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } else {
                    $this->resdepartement_model->Update(post('libelle'), post('psedo'), post('site_id'), post('id'));
                    json_send('' . H_ADMIN . '&view=resdepartement&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        } //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->resdepartement_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resdepartement/Details.php');
        } //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->resdepartement_model->TruncateTable('' . H_ADMIN . '&view=resdepartement&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/resdepartement/View.php');
        } //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->resdepartement_model->Delete(get('id'), '' . H_ADMIN . '&view=resdepartement&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->resdepartement_model->Delete(get('id'), '' . H_ADMIN . '&view=resdepartement&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=resdepartement&id=' . get('id') . '&do=update&msg=delete');
            }
        }
    }//end invoke
}//end class
?>
	