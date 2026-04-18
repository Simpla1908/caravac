
<?php

/*
 * =======================================================================
 * FILE NAME:        t_chambre.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_chambre
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/t_chambre.php');
include_once(APP_FOLDER . '/models/objects/categorie_chambre.php');

class t_chambre_controller
{

    public $t_chambre_model;

    public function __construct()
    {
        $this->t_chambre_model = new t_chambre_model();
    }

    public function invoke_t_chambre()
    {
        $categorieobj = new categorie_chambre_model();

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $result = $this->t_chambre_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_chambre/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'viewall2') {
            $result = $this->t_chambre_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_chambre/View2.php');
        } elseif (get('do') == 'export2') {
            $result = $this->t_chambre_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_chambre/View2.php');
        }
        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->t_chambre_model->SelectOne(get('id_ch'));
            include(APP_FOLDER . '/views/admin/t_chambre/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->t_chambre_model->AutoSearch(trim($qstring), 10, 'num_ch');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_chambre&id_ch=' . $srow->id_ch . '&do=details"><li class="list-group-item">' . $srow->num_ch . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $categories = $categorieobj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_chambre/Add.php');
        } elseif (get('do') == 'add2') {
            $categories = $categorieobj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_chambre/Add2.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('num_ch') == '') {
                    json_error('Veuillez entrer un nom!');
                } else {
                    $bdd = HDB::hus();
                    // $resultat=TarifChambre(post('categorie'), $bdd);
                    $tarif_ch = post('tarif_ch');
                    $monnaie = $_SESSION['Paie_insert'];
                    // foreach ($resultat as $srow) {
                    //     $tarif_ch = $srow->tarif;
                    //     $monnaie = $srow->monnaie;
                    // }
                    $libre = 'oui';
                    $this->t_chambre_model->Insert(post('num_ch'), post('etat_ch'), $tarif_ch, $monnaie, $libre, post('categorie'), $_SESSION['idsite']);
                    json_send('' . H_ADMIN . '&view=t_chambre&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        } elseif (get('do') == 'addpro2') {
            if ($_POST) {
                //form validation
                if (post('num_ch') == '') {
                    json_error('Veuillez entrer un nom!');
                } elseif (post('tarif_ch') == '') {
                    json_error('Veuillez entrer un tarif!');
                } else {
                    $libre = 'non';
                    $this->t_chambre_model->Insert(post('num_ch'), post('etat_ch'), post('tarif_ch'), $_SESSION['Paie_insert'], $libre, post('categorie'), $_SESSION['idsite']);
                    json_send('' . H_ADMIN . '&view=t_chambre&do=viewall2&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $categories = $categorieobj->SelectAll($_SESSION['idsite']);
            $rows = $this->t_chambre_model->SelectOne(get('id_ch'));
            include(APP_FOLDER . '/views/admin/t_chambre/Update.php');
        } elseif (get('do') == 'update2') {
            $categories = $categorieobj->SelectAll($_SESSION['idsite']);
            $rows = $this->t_chambre_model->SelectOne(get('id_ch'));
            include(APP_FOLDER . '/views/admin/t_chambre/Update2.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('num_ch') == '') {
                    json_error('Veuillez entrer un nom!');
                } elseif (post('tarif_ch') == '') {
                    json_error('Veuillez entrer un tarif!');
                } else {
                    $this->t_chambre_model->Update(post('num_ch'), post('etat_ch'), post('tarif_ch'), $_SESSION['Paie_insert'], post('categorie'), post('id_ch'));
                    json_send('' . H_ADMIN . '&view=t_chambre&id_ch=' . post('id_ch') . '&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        } elseif (get('do') == 'updatepro2') {
            if ($_POST) {
                //form validation
                if (post('num_ch') == '') {
                    json_error('Veuillez entrer un nom!');
                } elseif (post('tarif_ch') == '') {
                    json_error('Veuillez entrer un tarif!');
                } else {
                    $this->t_chambre_model->Update(post('num_ch'), post('etat_ch'), post('tarif_ch'), $_SESSION['Paie_insert'], post('categorie'), post('id_ch'));
                    json_send('' . H_ADMIN . '&view=t_chambre&id_ch=' . post('id_ch') . '&do=viewall2&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->t_chambre_model->SelectOne(get('id_ch'));
            include(APP_FOLDER . '/views/admin/t_chambre/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->t_chambre_model->TruncateTable('' . H_ADMIN . '&view=t_chambre&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/t_chambre/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id_ch') and $dfile == '') {
                $del = $this->t_chambre_model->Delete(get('id_ch'), '' . H_ADMIN . '&view=t_chambre&do=viewall&msg=delete');
            } elseif (get('id_ch') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->t_chambre_model->Delete(get('id_ch'), '' . H_ADMIN . '&view=t_chambre&do=viewall&msg=delete');
            } elseif (get('id_ch') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=t_chambre&id_ch=' . get('id_ch') . '&do=update&msg=delete');
            }
        } elseif (get('do') == 'delete2') {
            $del = $this->t_chambre_model->Delete(get('id_ch'), '' . H_ADMIN . '&view=t_chambre&do=viewall2&msg=delete');
        }
    }

    //end invoke
}

//end class
?>
	