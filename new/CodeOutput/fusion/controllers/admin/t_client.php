
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
        $idsite = $_SESSION['idsite'];
        $checkin = $_SESSION['checkin'];
        $checkout = $_SESSION['checkout'];
        $hrs_sys = date('H:i') . ':00';
        //SELECT ALL //////////////////////////////////	
    
        if (get('do') == 'viewall') {
            $result = $this->t_client_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_client/View.php');
        }
        // liste des occupations
         if (get('do') == 'occupation'||get('do') == 'filter_occ') {
            $bdd=HDB::hus();
            if(get('do') == 'occupation'){
            $datedebut =date('Y-m-d');
            $datefin=date('Y-m-d');
            $result =GetClientloges($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            include(APP_FOLDER . '/views/admin/t_client/Viewhebclloge.php');
            }else if(get('do') == 'filter_occ'){
             /* Conversion date1 */
            $transpostion_date1 = explode('/',post('dte1'));
            $jour = $transpostion_date1[0];
            $mois = $transpostion_date1[1];
            $annee = $transpostion_date1[2];
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/',post('dte2'));
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
            $result =GetClientloges($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            include(APP_FOLDER . '/views/admin/t_client/datasoccupations.php'); 
            }
        }
         // liste des reservations
         if (get('do') == 'reservation'||get('do') == 'filter_res') {
            $bdd=HDB::hus();
            if(get('do') == 'reservation'){
            $datedebut =date('Y-m-d');
            $datefin=date('Y-m-d');
            $result =GetClientreserv($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            include(APP_FOLDER . '/views/admin/t_client/Viewheb.php');
            }else if(get('do') == 'filter_res'){
             /* Conversion date1 */
            $transpostion_date1 = explode('/',post('dte1'));
            $jour = $transpostion_date1[0];
            $mois = $transpostion_date1[1];
            $annee = $transpostion_date1[2];
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/',post('dte2'));
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
            $result =GetClientreserv($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            include(APP_FOLDER . '/views/admin/t_client/datasreservation.php'); 
            }

        }
        // liste des liberations
         if (get('do') == 'liberation'||get('do') == 'filter_lib') {
            $bdd=HDB::hus();
            if(get('do') == 'liberation'){
            $datedebut =date('Y-m-d');
            $datefin=date('Y-m-d');
            $result =GetClientsLiberes($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            include(APP_FOLDER . '/views/admin/t_client/Viewhebliberes.php');
            }else if(get('do') == 'filter_lib'){
             /* Conversion date1 */
            $transpostion_date1 = explode('/',post('dte1'));
            $jour = $transpostion_date1[0];
            $mois = $transpostion_date1[1];
            $annee = $transpostion_date1[2];
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/',post('dte2'));
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
            $result =GetClientsLiberes($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            include(APP_FOLDER . '/views/admin/t_client/datasliberations.php'); 
            }
        }
        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->t_client_model->SelectAll();
            include(APP_FOLDER . '/views/admin/t_client/Export.php');
        }elseif (get('do') == 'viewallheb') {
            $result = $this->t_client_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_client/Viewheb.php');
        }
        elseif (get('do') == 'pl') {
            $dte1 = '2018-08-01';
            $dte2 ='2018-08-07';
           $periode_reservations=PeriodeReservation($dte1,$dte2);
            include(APP_FOLDER . '/views/admin/t_client/pl.php');
        }
        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->t_client_model->SelectOne(get('id_client'));
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
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/t_client/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('nom_client') == '') {
                    json_error('Veuillez entrer le nom!');
                } elseif (post('sexe_client') == '') {
                    json_error('The field sexe client cannot be empty!');
                } elseif (post('adresse_provenance_client') == '') {
                    json_error("Veuillez entrer l'adresse");
                } elseif (post('email_client') == '') {
                    json_error("Veuillez entrer l'Email");
                } elseif (post('telephone_client') == '') {
                    json_error('Veuillez entrer le numéro de téléphone!');
                } elseif (post('type') == '') {
                    json_error('The field type cannot be empty!');
                } elseif (post('id_hotel') == '') {
                    json_error('The field id hotel cannot be empty!');
                } else {
                    $this->t_client_model->InsertFacturation(post('designation'), post('nom_client'), post('sexe_client'), post('adresse_provenance_client'), post('email_client'), post('telephone_client'), post('type'), post('id_hotel'));
                    json_send('' . H_ADMIN . '&view=t_client&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->t_client_model->SelectOne(get('id_client'));
            include(APP_FOLDER . '/views/admin/t_client/Updateheb.php');
        }
        elseif (get('do') == 'updateheb') {
            $rows = $this->t_client_model->SelectOne(get('id_client'));
            include(APP_FOLDER . '/views/admin/t_client/Updateheb.php');
        }
        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('nom_client') == '') {
                    json_error('Veuillez entrer le nom!');
                } elseif (post('sexe_client') == '') {
                    json_error('The field sexe client cannot be empty!');
                } elseif (post('adresse_provenance_client') == '') {
                    json_error("Veuillez entrer l'adresse");
                } elseif (post('email_client') == '') {
                    json_error("Veuillez entrer l'Email");
                } elseif (post('telephone_client') == '') {
                    json_error('Veuillez entrer le numéro de téléphone!');
                } elseif (post('type') == '') {
                    json_error('The field type cannot be empty!');
                } elseif (post('id_hotel') == '') {
                    json_error('The field id hotel cannot be empty!');
                } else {
                    $this->t_client_model->UpdateFacturation(post('designation'), post('nom_client'), post('sexe_client'), post('adresse_provenance_client'), post('email_client'), post('telephone_client'), post('type'), post('id_hotel'), post('id_client'));
                    json_send('' . H_ADMIN . '&view=t_client&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        }
         elseif (get('do') == 'updateproheb') {
            if ($_POST) {
                //form validation
                if (post('nom_client') == '') {
                    json_error('Veuillez entrer le nom!');
                } elseif (post('sexe_client') == '') {
                    json_error('The field sexe client cannot be empty!');
                } else {
                     $date_naiss_client = dateToformatBdd(post('date_naiss_client'));
                    $this->t_client_model->UpdateHebergement(post('nom_client'),$date_naiss_client,post('sexe_client'),post('etat_civil_client'),post('nationalite_client'),post('num_piece_identite_client'),post('num_passeport_client'),post('adresse_provenance_client'),post('email_client'),post('telephone_client'),post('num_pers_contacter_client'),post('id_client'));
                    json_send('' . H_ADMIN . '&view=t_client&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        }
        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->t_client_model->SelectOne(get('id_client'));
            include(APP_FOLDER . '/views/admin/t_client/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->t_client_model->TruncateTable('' . H_ADMIN . '&view=t_client&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/t_client/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {

            // $dfile = get('dfile');
            // if (get('id_client') and $dfile == '') {
            //     $del = $this->t_client_model->Delete(get('id_client'), '' . H_ADMIN . '&view=t_client&do=viewall&msg=delete');
            // } elseif (get('id_client') and $dfile != '' and get('fdel') == '') {
            //     delete_files(UPLOAD_PATH . get('dfile'));
            //     delete_files(THUMB_PATH . get('dfile'));
            //     $del = $this->t_client_model->Delete(get('id_client'), '' . H_ADMIN . '&view=t_client&do=viewall&msg=delete');
            // } elseif (get('id_client') and $dfile != '' and get('fdel') != '') {
            //     delete_files(UPLOAD_PATH . get('dfile'));
            //     delete_files(THUMB_PATH . get('dfile'));
            //     send_to('' . H_ADMIN . '&view=t_client&id_client=' . get('id_client') . '&do=update&msg=delete');
            // }
            $id=get('id_client');
            $pseudo_supp=1;
            $this->t_client_model->PseudoDel($pseudo_supp,$id);
            json_send('' . H_ADMIN . '&view=t_client&do=viewall&msg=delete');
        }
        elseif (get('do') == 'deleteheb') {
            $del = $this->t_client_model->Delete(get('id_client'), '' . H_ADMIN . '&view=t_client&do=viewall&msg=delete');
        }
        //HEBERGEMENT
        elseif (get('do')=='clliberes') {
            $bdd = HDB::hus();
            $dte1='';
            $dte2='';
            $id=$idsite;
           $result= GetClientsLiberes($id, $dte1, $dte2, $bdd);
          include(APP_FOLDER . '/views/admin/t_client/clliberes.php');
        }elseif (get('do')=='allclients') {
            $id=$idsite;
            $result = $this->t_client_model->SelectAll($_SESSION['idsite']);
          include(APP_FOLDER . '/views/admin/t_client/allclients.php');
        }elseif (get('do')=='fiche' || get('do') == 'ficheajx') {
            $bdd=HDB::hus();
            if(get('do') == 'fiche'){
            $datedebut =date('Y-m-d');
            $datefin=date('Y-m-d');
            $result =GetClientFiche($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            include(APP_FOLDER . '/views/admin/t_client/Viewhebfiche.php');
            }else if(get('do')=='ficheajx'){
             /* Conversion date1 */
            $transpostion_date1 = explode('/',post('dte1'));
            $jour = $transpostion_date1[0];
            $mois = $transpostion_date1[1];
            $annee = $transpostion_date1[2];
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/',post('dte2'));
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
            $result =GetClientFiche($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            include(APP_FOLDER . '/views/admin/t_client/datasfiche.php'); 
            }
        }
    }

//end invoke
}

//end class
?>
	