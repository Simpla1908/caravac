
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

include(APP_FOLDER . '/models/objects/resconfig.php');

class resconfig_controller {

    public $resconfig_model;

    public function __construct() {
        $this->resconfig_model = new resconfig_model();
    }

    public function invoke_resconfig() {

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->resconfig_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->resconfig_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=resconfig&do=viewall');
            } else {
                $result = $this->resconfig_model->SelectAll();
            }
            include(APP_FOLDER . '/views/admin/resconfig/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->resconfig_model->SelectAll();
            include(APP_FOLDER . '/views/admin/resconfig/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->resconfig_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resconfig/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->resconfig_model->AutoSearch(trim($qstring), 10, 'm_insert');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=resconfig&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->m_insert . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/resconfig/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('m_insert') == '') {
                    json_error('The field m insert cannot be empty!');
                } elseif (post('m_affich') == '') {
                    json_error('The field m affich cannot be empty!');
                } elseif (post('taux') == '') {
                    json_error('The field taux cannot be empty!');
                } elseif (post('age') == '') {
                    json_error('The field age cannot be empty!');
                } elseif (post('fuseauhoraire') == '') {
                    json_error('The field fuseauhoraire cannot be empty!');
                } elseif (post('module_id') == '') {
                    json_error('The field module id cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } else {
                    $this->resconfig_model->Insert(post('m_insert'), post('m_affich'), post('taux'), post('age'), post('penalite'), post('fuseauhoraire'), post('module_id'), post('site_id'));
                    json_send('' . H_ADMIN . '&view=resconfig&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->resconfig_model->SelectOne(get('id'));
            $tmz = LISTTIMEZONES();
            include(APP_FOLDER . '/views/admin/resconfig/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('nomcomp') == '') {
                    json_error("Veuillez saisir le nom de la compagnie!");
                } elseif (post('adrcomp') == '') {
                    json_error("Veuillez saisir l'adresse de l'adresse!");
                } elseif (post('m_insert') == '') {
                    json_error("Veuillez saisir la monnaie d'insertion!");
                } elseif (post('m_affich') == '') {
                    json_error("Veuillez saisir la monnaie d'affichage!");
                } elseif (post('taux') == '') {
                    json_error("Veuillez saisir le taux!");
                } elseif (post('age') == '') {
                    json_error("Veuillez saisir l'age!");
                } elseif (post('fuseauhoraire') == '') {
                    json_error("Veuillez saisir le fuseau horaire!");
                } elseif (post('hopital') == '') {
                    json_error("Veuillez saisir l'hopital!");
                } elseif (post('prefsanct') == '') {
                    json_error("Veuillez saisir le pr�fixe de la sanction!");
                } elseif (post('prefconge') == '') {
                    json_error("Veuillez saisir le pr�fixe du cong�!");
                } elseif (post('module_id') == '') {
                    json_error('The field module id cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } else {
                    $nofile = 0;
                    if (!empty($_FILES['logo'])) {
                        $nofile = 1;
                    }
                    $fuseauhoraire=post('fuseauhoraire');
                    $this->resconfig_model->Update($nofile, post('nomcomp'), post('adrcomp'), post('m_insert'), post('m_affich'), post('taux'), post('age'), post('penalite'), post('hopital'),$fuseauhoraire,post('prefsanct'),post('prefconge'), post('module_id'), post('site_id'),post('pointage'), post('id'));
                    $_SESSION['fuseauhoraire']=$fuseauhoraire;
                    json_send('' . H_ADMIN . '&view=resconfig&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->resconfig_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resconfig/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->resconfig_model->TruncateTable('' . H_ADMIN . '&view=resconfig&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/resconfig/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->resconfig_model->Delete(get('id'), '' . H_ADMIN . '&view=resconfig&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->resconfig_model->Delete(get('id'), '' . H_ADMIN . '&view=resconfig&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=resconfig&id=' . get('id') . '&do=update&msg=delete');
            }
        }
    }

//end invoke
}

//end class
?>
	