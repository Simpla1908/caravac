
<?php

/*
 * =======================================================================
 * FILE NAME:        t_chambre_histo.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_chambre_histo
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/t_chambre_histo.php');

class t_chambre_histo_controller {

    public $t_chambre_histo_model;

    public function __construct() {
        $this->t_chambre_histo_model = new t_chambre_histo_model();
    }

    public function invoke_t_chambre_histo() {
        //date_default_timezone_set('Africa/Kinshasa');
        //SELECT ALL //////////////////////////////////	
        if (get('do')=='viewall'){
            $bdd=HDB::hus();
            $result = array();
            $datedebut = date('Y-m-d');
            $datefin = date('Y-m-d');
            //$result = $this->t_chambre_histo_model->SelectAll($bdd, $datedebut, $datefin);
            //$occupations = $this->t_chambre_histo_model->occupation($bdd);
            $result2 = $this->t_chambre_histo_model->SelectAll2($bdd, $datedebut, $datefin);
            DetailsVenteHeb($datedebut,$datefin,$bdd);
            $nbArticles=count($_SESSION['chambre']['num_tarif']);
            include(APP_FOLDER . '/views/admin/t_chambre_histo/View.php');
        }

        if (get('do') == 'filtrerdn') {
            $bdd = HDB::hus();
            $result = array();
            /* Conversion date1 */
            $transpostion_date1 = explode('/', post('dte1'));
            $jour = $transpostion_date1[0];
            $mois = $transpostion_date1[1];
            $annee = $transpostion_date1[2];
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/', post('dte2'));
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
            //$result = $this->t_chambre_histo_model->SelectAll($bdd, $datedebut, $datefin);
            //$occupations = $this->t_chambre_histo_model->occupation($bdd);
            DetailsVenteHeb($datedebut,$datefin,$bdd);
            $nbArticles=count($_SESSION['chambre']['num_tarif']);
            include(APP_FOLDER . '/views/admin/t_chambre_histo/contentdatafiltered.php');
        }
        if (get('do') == 'filtrerdn2') {
            $bdd = HDB::hus();
            $result = array();
            /* Conversion date1 */
            $transpostion_date1 = explode('/', post('dte1'));
            $jour = $transpostion_date1[0];
            $mois = $transpostion_date1[1];
            $annee = $transpostion_date1[2];
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/', post('dte2'));
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
            $result2 = $this->t_chambre_histo_model->SelectAll2($bdd, $datedebut, $datefin);
            include(APP_FOLDER . '/views/admin/t_chambre_histo/contentdatafiltered2.php');
        }
        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->t_chambre_histo_model->SelectAll();
            include(APP_FOLDER . '/views/admin/t_chambre_histo/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->t_chambre_histo_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/t_chambre_histo/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->t_chambre_histo_model->AutoSearch(trim($qstring), 10, 'idres_ch');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_chambre_histo&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->idres_ch . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/t_chambre_histo/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('idres_ch') == '') {
                    json_error('The field idres ch cannot be empty!');
                } elseif (post('idchambre') == '') {
                    json_error('The field idchambre cannot be empty!');
                } elseif (post('statut') == '') {
                    json_error('The field statut cannot be empty!');
                } elseif (post('date_occ') == '') {
                    json_error('The field date occ cannot be empty!');
                } elseif (post('date_lib') == '') {
                    json_error('The field date lib cannot be empty!');
                } elseif (post('tarif_ch') == '') {
                    json_error('The field tarif ch cannot be empty!');
                } elseif (post('monnaie') == '') {
                    json_error('The field monnaie cannot be empty!');
                } else {
                    $this->t_chambre_histo_model->Insert(post('idres_ch'), post('idchambre'), post('statut'), post('date_occ'), post('date_lib'), post('tarif_ch'), post('monnaie'));
                    json_send('' . H_ADMIN . '&view=t_chambre_histo&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->t_chambre_histo_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/t_chambre_histo/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('idres_ch') == '') {
                    json_error('The field idres ch cannot be empty!');
                } elseif (post('idchambre') == '') {
                    json_error('The field idchambre cannot be empty!');
                } elseif (post('statut') == '') {
                    json_error('The field statut cannot be empty!');
                } elseif (post('date_occ') == '') {
                    json_error('The field date occ cannot be empty!');
                } elseif (post('date_lib') == '') {
                    json_error('The field date lib cannot be empty!');
                } elseif (post('tarif_ch') == '') {
                    json_error('The field tarif ch cannot be empty!');
                } elseif (post('monnaie') == '') {
                    json_error('The field monnaie cannot be empty!');
                } else {
                    $this->t_chambre_histo_model->Update(post('idres_ch'), post('idchambre'), post('statut'), post('date_occ'), post('date_lib'), post('tarif_ch'), post('monnaie'), post('id'));
                    json_send('' . H_ADMIN . '&view=t_chambre_histo&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->t_chambre_histo_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/t_chambre_histo/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->t_chambre_histo_model->TruncateTable('' . H_ADMIN . '&view=t_chambre_histo&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/t_chambre_histo/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->t_chambre_histo_model->Delete(get('id'), '' . H_ADMIN . '&view=t_chambre_histo&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->t_chambre_histo_model->Delete(get('id'), '' . H_ADMIN . '&view=t_chambre_histo&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=t_chambre_histo&id=' . get('id') . '&do=update&msg=delete');
            }
        }
    }

//end invoke
}

//end class
?>
	