
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

include(APP_FOLDER . '/models/objects/rescategorie.php');

class rescategorie_controller {

    public $rescategorie_model;

    public function __construct() {
        $this->rescategorie_model = new rescategorie_model();
    }

    public function invoke_rescategorie() {

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $result = $this->rescategorie_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/rescategorie/View.php');
        }

        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->rescategorie_model->SelectAll();
            include(APP_FOLDER . '/views/admin/rescategorie/Export.php');
        }
        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->rescategorie_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/rescategorie/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->rescategorie_model->AutoSearch(trim($qstring), 10, 'libelle');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=rescategorie&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->libelle . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/rescategorie/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('libelle') == '') {
                    json_error('Veuillez entrer un nom!');
                } elseif (post('salbase') == '') {
                    json_error('Veuillez entrer un montant!');
                } else {
                   $salbase=post('salbase');
                   $type=post('type');
                   $montantjr= GetMontantjrPaie($salbase,$type);
                    $this->rescategorie_model->Insert(post('libelle'), post('salbase'),$montantjr,post('devise'), post('psedo'), post('type'),post('preavis'), post('site_id'));
                    json_send('' . H_ADMIN . '&view=rescategorie&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->rescategorie_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/rescategorie/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('libelle') == '') {
                    json_error('Veuillez entrer un nom!');
                } elseif (post('salbase') == '') {
                    json_error('Veuillez entrer un montant!');
                } else {
                   $salbase=post('salbase');
                   $type=post('type');
                   $montantjr= GetMontantjrPaie($salbase,$type);
                    $this->rescategorie_model->Update(post('libelle'), post('salbase'),$montantjr ,post('devise'), post('psedo'), post('type'),post('preavis'),post('site_id'), post('id'));
                    json_send('' . H_ADMIN . '&view=rescategorie&id=' . post('id') . '&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->rescategorie_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/rescategorie/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->rescategorie_model->TruncateTable('' . H_ADMIN . '&view=rescategorie&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/rescategorie/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->rescategorie_model->Delete(get('id'), '' . H_ADMIN . '&view=rescategorie&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->rescategorie_model->Delete(get('id'), '' . H_ADMIN . '&view=rescategorie&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=rescategorie&id=' . get('id') . '&do=update&msg=delete');
            }
        }
    }

//end invoke
}

//end class
?>
	