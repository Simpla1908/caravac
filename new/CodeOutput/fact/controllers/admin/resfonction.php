<?php

/*
* =======================================================================
* FILE NAME:        resfonction.php
* DATE CREATED:  	17-11-2017
* FOR TABLE:  		resfonction
* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
* =======================================================================
*/

if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/resfonction.php');
include(APP_FOLDER . '/models/objects/rescategorie.php');

class resfonction_controller
{
    public $resfonction_model;

    public function __construct()
    {
        $this->resfonction_model = new resfonction_model();
    }

    public function invoke_resfonction()
    {

        //SELECT ALL //////////////////////////////////
        if (get('do') == 'viewall') {
            $result = $this->resfonction_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resfonction/View.php');
        }
        //EXPORT ////////////////////////////////////////////////////
        if (get('do') == 'export') {
            $result = $this->resfonction_model->SelectAll();
            include(APP_FOLDER . '/views/admin/resfonction/Export.php');
        } //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->resfonction_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resfonction/Export2.php');
        } //SEARCH SUGGEST ////////////////////////////////////////////////////
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->resfonction_model->AutoSearch(trim($qstring), 10, 'libelle');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=resfonction&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->libelle . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        } //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $rescategorie_obj = new rescategorie_model();
            $result = $rescategorie_obj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resfonction/Add.php');
        } //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('libelle') == '') {
                    json_error('Le champ désignation ne peut pas être vide!!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } elseif (post('categorie_id') == '') {
                    json_error('Le champ catégorie ne peut pas être vide!');
                } else {
                    $this->resfonction_model->Insert(post('libelle'), post('psedo'), post('site_id'), post('categorie_id'));
                    json_send('' . H_ADMIN . '&view=resfonction&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        } //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
             $rescategorie_obj = new rescategorie_model();
             $rows = $this->resfonction_model->SelectOneJ(get('id'));
            include(APP_FOLDER . '/views/admin/resfonction/Update.php');
        } //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('libelle') == '') {
                    json_error('Le champ désignation ne peut pas être vide!!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } else {
                    $this->resfonction_model->Update(post('libelle'), post('psedo'), post('site_id'), post('categorie_id'), post('id'));
                    json_send('' . H_ADMIN . '&view=resfonction&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        } //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->resfonction_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resfonction/Details.php');
        } //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->resfonction_model->TruncateTable('' . H_ADMIN . '&view=resfonction&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/resfonction/View.php');
        } //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->resfonction_model->Delete(get('id'), '' . H_ADMIN . '&view=resfonction&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->resfonction_model->Delete(get('id'), '' . H_ADMIN . '&view=resfonction&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=resfonction&id=' . get('id') . '&do=update&msg=delete');
            }
        }
    }//end invoke
}//end class
?>
	