
<?php

/*
 * =======================================================================
 * FILE NAME:        t_client.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_client
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/t_client.php');

class t_client_controller {

    public $t_client_model;

    public function __construct() {
        $this->t_client_model = new t_client_model();
    }

    public function invoke_t_client() {

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall_ach') {
            $result = $this->t_client_model->SelectAll_ach($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_client/View_ach.php');
        }elseif (get('do')=='extraitcompte'){
             $result = $this->t_client_model->SelectAll_ach($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_client/extraitcompte.php');
        }
        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->t_client_model->SelectAll();
            include(APP_FOLDER . '/views/admin/t_client/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->t_client_model->SelectOne_ach(get('id_client'));
            include(APP_FOLDER . '/views/admin/t_client/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->t_client_model->AutoSearch(trim($qstring), 10, 'code');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_client&id_client=' . $srow->id_client . '&do=details"><li class="list-group-item">' . $srow->code . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add_ach') {
            include(APP_FOLDER . '/views/admin/t_client/Add_ach.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro_ach') {
            if ($_POST) {
                //form validation
                if (post('nom_entreprise') == '') {
                    json_error('Veuillez remplir ce champ vide!');
                } elseif (post('nom_client') == '') {
                    json_error('Veuillez remplir ce champ vide!');
                } elseif (post('adresse_provenance_client') == '') {
                    json_error('Veuillez remplir ce champ vide!');
                } elseif (post('telephone_client') == '') {
                    json_error('Veuillez remplir ce champ vide!');
                } else {
                    $this->t_client_model->Insert_ach(post('nom_client'), post('adresse_provenance_client'),post('email_client'), post('telephone_client'), post('type'), post('id_hotel'), post('nom_entreprise'));
                    json_send('' . H_ADMIN . '&view=t_client&do=viewall_ach&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update_ach') {
            $rows = $this->t_client_model->SelectOne_ach(get('id_client'));
            include(APP_FOLDER . '/views/admin/t_client/Update_ach.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro_ach') {
            if ($_POST) {
                //form validation
               if (post('nom_entreprise') == '') {
                    json_error('Veuillez remplir ce champ vide!');
                } elseif (post('nom_client') == '') {
                    json_error('Veuillez remplir ce champ vide!');
                } elseif (post('adresse_provenance_client') == '') {
                    json_error('Veuillez remplir ce champ vide!');
                } elseif (post('telephone_client') == '') {
                    json_error('Veuillez remplir ce champ vide!');
                } else {
                    $this->t_client_model->Update_ach(post('nom_client'), post('adresse_provenance_client'),post('email_client'), post('telephone_client'), post('id_hotel'), post('nom_entreprise'), post('id_client'));
//                    json_send('' . H_ADMIN . '&view=t_client&id_client=' . post('id_client') . '&do=details&msg=update');
                    json_send('' . H_ADMIN . '&view=t_client&do=viewall_ach&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details_ach') {
            $rows = $this->t_client_model->SelectOne_ach(get('id_client'));
            include(APP_FOLDER . '/views/admin/t_client/Details_ach.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->t_client_model->TruncateTable('' . H_ADMIN . '&view=t_client&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/t_client/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete_ach') {
            $dfile = get('dfile');
            if (get('id_client') and $dfile == '') {
                $del = $this->t_client_model->Delete(get('id_client'), '' . H_ADMIN . '&view=t_client&do=viewall&msg=delete');
            } elseif (get('id_client') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->t_client_model->Delete(get('id_client'), '' . H_ADMIN . '&view=t_client&do=viewall&msg=delete');
            } elseif (get('id_client') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=t_client&id_client=' . get('id_client') . '&do=update&msg=delete');
            }
        }
        else if (get('do') == 'check') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            if (post('idclient') == '') {
                $json['message'] = json_error2('Veuillez sélectionner un client');
            } else if (post('datedebut') == '' || post('datefin') == '') {
                $json['message'] = json_error2('Veuillez remplir tous les champs');
            } else {


                $json['s'] = true;
            }
            echo json_encode($json);
        } elseif (get('do')=='viewdatas') {
            $bdd = HDB::hus();
            $datedebut=dateToformatBdd(post('datedebut'));
            $datefin=dateToformatBdd(post('datefin'));
            $idclient=post('idclient');
            $data= ExtraitDEcompte($idclient,$datedebut,$datefin,$bdd);
            include(APP_FOLDER . '/views/admin/t_client/datasextraitcompte.php');
        }
    }

//end invoke
}

//end class
?>
	