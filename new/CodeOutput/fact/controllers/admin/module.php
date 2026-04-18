
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

class module_controller
{

    public $module_model;

    public function __construct()
    {
        $this->module_model = new module_model();
    }

    public function invoke_module()
    {

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
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->module_model->SelectAll();
            include(APP_FOLDER . '/views/admin/module/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->module_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/module/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->module_model->AutoSearch(trim($qstring), 10, 'nom');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=module&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->nom . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/module/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('nom') == '') {
                    json_error('The field nom cannot be empty!');
                } elseif (post('code') == '') {
                    json_error('The field code cannot be empty!');
                } else {
                    $this->module_model->Insert(post('nom'), post('code'));
                    json_send('' . H_ADMIN . '&view=module&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->module_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/module/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('nom') == '') {
                    json_error('The field nom cannot be empty!');
                } elseif (post('code') == '') {
                    json_error('The field code cannot be empty!');
                } else {
                    $this->module_model->Update(post('nom'), post('code'), post('id'));
                    json_send('' . H_ADMIN . '&view=module&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->module_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/module/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->module_model->TruncateTable('' . H_ADMIN . '&view=module&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/module/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->module_model->Delete(get('id'), '' . H_ADMIN . '&view=module&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->module_model->Delete(get('id'), '' . H_ADMIN . '&view=module&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=module&id=' . get('id') . '&do=update&msg=delete');
            }
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
        } elseif (get('do') == 'compta') {
            $_SESSION['app_folder'] = 'compta';
            $_SESSION['fichierjs'] = 'compta';
            $_SESSION['function'] = 'compta';
            include(APP_FOLDER . '/views/admin/module/compta.php');
            $ck = 0;
            $bdd = HDB::hus();
            $module_id = 23;
            $site_id = $_SESSION['id_hotel'];
            ConfLinkMod($module_id, $site_id, $bdd);
            if ($_SESSION['ConfLinkMod_lie'] == 1) {
                ConfigModule($module_id, $site_id);
                $ck = CheckerUpdateComptaAuto($module_id, $site_id, $bdd);
                if ($ck > 0) {
                    AUTO_ECRITURES_PROCESS_HEB($module_id, $site_id, $bdd);
                }
            }
        }
    }

    //end invoke
}

//end class
?>
	