
<?php

/*
 * =======================================================================
 * FILE NAME:        resemployes.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resemployes
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/resemployes.php');
include_once (APP_FOLDER . '/models/objects/resfonction.php');
include_once (APP_FOLDER . '/models/objects/resdepartement.php');
include_once (APP_FOLDER . '/models/objects/resemployefamille.php');
include_once(APP_FOLDER . '/models/objects/rescontrat.php');
include_once(APP_FOLDER . '/models/objects/reshoraire.php');
include_once(APP_FOLDER . '/models/objects/resemployehoraire.php');

class resemployes_controller {

    public $resemployes_model;

    public function __construct() {
        $this->resemployes_model = new resemployes_model();
    }

    public function invoke_resemployes() {
        $fonctionbj = new resfonction_model();
        $departementobj = new resdepartement_model();
        $employefamilleobj = new resemployefamille_model();
        $contratobj = new rescontrat_model();
        $horaireobj = new reshoraire_model();
        $affectationhoraireobj = new resemployehoraire_model();
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $result = $this->resemployes_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resemployes/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->resemployes_model->SelectAll();
            include(APP_FOLDER . '/views/admin/resemployes/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->resemployes_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resemployes/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->resemployes_model->AutoSearch(trim($qstring), 10, 'matricule');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=resemployes&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->matricule . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $fonctions = $fonctionbj->SelectAll($_SESSION['idsite']);
            $departements = $departementobj->SelectAll($_SESSION['idsite']);
            $horaires = $horaireobj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resemployes/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                 //form validation
                if (post('matricule') == '') {
                    json_error('Veuillez entrer un matricule.');
                } elseif (post('noms') == '') {
                    json_error('The field noms cannot be empty!');
                } elseif (post('nationalite') == '') {
                    json_error('The field nationalite cannot be empty!');
                } elseif (post('lieunais') == '') {
                    json_error('The field lieunais cannot be empty!');
                } elseif (post('datenais') == '') {
                    json_error('The field datenais cannot be empty!');
                } elseif (post('rue') == '') {
                    json_error('The field rue cannot be empty!');
                }  elseif (post('quartier') == '') {
                    json_error('The field Adresse cannot be empty!');
                }elseif (post('commune') == '') {
                    json_error('The field commune cannot be empty!');
                } elseif (post('ville') == '') {
                    json_error('The field ville cannot be empty!');
                }
                elseif (post('numpiece') == '') {
                    json_error('The field numpiece cannot be empty!');
                } elseif (post('tel1') == '') {
                    json_error('The field tel1 cannot be empty!');
                } elseif (post('email') == '') {
                    json_error('The field email cannot be empty!');
                } else {
                    $etatcivil = post('etatcivil');
                    $noms=post('noms');
                    $datenais = format_stringdateTodatetime('d/m/Y', post('datenais'), 'Y-m-d');
                    $adresse=post('rue').'  Q/'.post('quartier').' C/'.post('commune');
                    if (!empty($_FILES['image'])) {
                        $employe_id = $this->resemployes_model->InsertImage(post('matricule'), post('noms'), post('sexe'), post('etatcivil'), post('nationalite'), post('lieunais'), $datenais,$adresse,post('rue'),post('quartier'),post('commune'), post('ville'), post('piece'), post('numpiece'), post('tel1'), post('tel2'), post('email'), post('nbrenf'), post('actif'), post('pseudo_supp'), post('fonction_id'), post('departement_id'), post('id_hotel'), post('numinss'), post('fingerprint'));
                    } else {
                        $employe_id = $this->resemployes_model->Insert(post('matricule'), post('noms'), post('sexe'), post('etatcivil'), post('nationalite'), post('lieunais'), $datenais,$adresse,post('rue'),post('quartier'), post('commune'), post('ville'), post('piece'), post('numpiece'), post('tel1'), post('tel2'), post('email'), post('nbrenf'), post('actif'), post('pseudo_supp'), post('fonction_id'), post('departement_id'), post('id_hotel'), post('numinss'), post('fingerprint'));
                    }
                    $dteng = format_stringdateTodatetime('d/m/Y', post('dteng'), 'Y-m-d');
                    $contratobj->Insert(post('typecontr'), $dteng, $employe_id);
                    $j = 0;
                    if ($etatcivil == 'marie' || $etatcivil == 'divorce') {
                        $type = 'enfant';
                        $nbrenf = post('nbrenf');
                        if ($nbrenf > 0) {
                            $bool = False;
                            $nbrenf = count($_POST['enfnoms']);
                            for ($i = 0; $i <= $nbrenf - 1; $i++) {
                                if (empty($_POST['enfnoms'][$i])) {
                                    $bool = TRUE;
                                    $j = $i + 1;
                                    break;
                                }
                            }
                            if ($bool) {
                                json_error('Veullez remplir le champ noms' . $j . '!');
                            }
                            for ($i = 0; $i <= $nbrenf - 1; $i++) {
                                $dtenais = dateToformatBdd($_POST['enfdatenais'][$i]);
                                $employefamilleobj->Insert($_POST['enfnoms'][$i], $dtenais, 'enfant', $employe_id);
                            }
                        }
                        if (post('nomconj') != '') {
                            $datenais = '0000-00-00';
                            $type = 'conjoint';
                            $employefamilleobj->Insert(post('nomconj'), $datenais, $type, $employe_id);
                        }
                    }
                    //Affectation horaire
                    if (isset($_POST['horaire_ids'])) {
                        $nbrhoraire = COUNT($_POST['horaire_ids']);
                        if ($nbrhoraire > 0) {
                            for ($j = 0; $j <= $nbrhoraire - 1; $j++) {
                                $default = $_POST['priorites'][$j];
                                $seq = $_POST['seqs'][$j];
                                $seqjrsmaj = $seq;
                                $horaire_id = $_POST['horaire_ids'][$j];
                                $nbrjrs = $_POST['nbrjrstrav'][$j];
                                $nbrjrsmaj = $nbrjrs;
                                $affectationhoraireobj->Insert($employe_id, $horaire_id, $default, $nbrjrs, $nbrjrsmaj, $seq, $seqjrsmaj, $_SESSION['idsite']);
                            }
                        }
                    }
                      //Insertion dans resemploye_eligibl pour etablir facilement la liste des employes elibles
                    if(post('typecontr')=='CDI'){
                    $id_hotel=post('id_hotel');
                    $query = HDB::hus()->prepare("INSERT resemploye_eligibl(employe_id,noms_employe,dteengag,dte1,site_id)
                                         VALUES(:employe_id,:noms_employe,:dteengag,:dte1,:site_id)");

                    $query->BindParam(':employe_id',$employe_id);
                    $query->BindParam(':noms_employe',$noms);
                    $query->BindParam(':dteengag', $dteng);
                    $query->BindParam(':dte1', $dteng);
                    $query->BindParam(':site_id',$id_hotel);
                    $query->execute();     
                    } 
                    //fin  insertion
                    
                    json_send('' . H_ADMIN . '&view=resemployes&do=viewall&msg=add');
                    json_success("L'opération vient de s'effectuer avec succès!");
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $employe_id = get('id');
            $rows = $this->resemployes_model->SelectOne(get('id'));
            $fonctions = $fonctionbj->SelectAll($_SESSION['idsite']);
            $departements = $departementobj->SelectAll($_SESSION['idsite']);
            $horaires = $horaireobj->SelectAll($_SESSION['idsite']);
            $this->resemployes_model->GetHoraire($employe_id);
            $this->resemployes_model->GetFamille($employe_id);
            include(APP_FOLDER . '/views/admin/resemployes/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
               //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('matricule') == '') {
                    json_error('The field matricule cannot be empty!');
                } elseif (post('noms') == '') {
                    json_error('The field noms cannot be empty!');
                } elseif (post('sexe') == '') {
                    json_error('The field sexe cannot be empty!');
                } elseif (post('etatcivil') == '') {
                    json_error('The field etatcivil cannot be empty!');
                } elseif (post('nationalite') == '') {
                    json_error('The field nationalite cannot be empty!');
                } elseif (post('lieunais') == '') {
                    json_error('The field lieunais cannot be empty!');
                } elseif (post('datenais') == '') {
                    json_error('The field datenais cannot be empty!');
                } elseif (post('rue') == '') {
                    json_error('The field Adresse cannot be empty!');
                }elseif (post('quartier') == '') {
                    json_error('The field Adresse cannot be empty!');
                }elseif (post('commune') == '') {
                    json_error('The field commune cannot be empty!');
                }elseif (post('ville') == '') {
                    json_error('The field ville cannot be empty!');
                } elseif (post('piece') == '') {
                    json_error('The field piece cannot be empty!');
                } elseif (post('numpiece') == '') {
                    json_error('The field numpiece cannot be empty!');
                } elseif (post('tel1') == '') {
                    json_error('The field tel1 cannot be empty!');
                } elseif (post('tel2') == '') {
                    json_error('The field tel2 cannot be empty!');
                } elseif (post('email') == '') {
                    json_error('The field email cannot be empty!');
                } elseif (post('nbrenf') == '') {
                    json_error('The field nbrenf cannot be empty!');
                } elseif (post('actif') == '') {
                    json_error('The field actif cannot be empty!');
                } elseif (post('pseudo_supp') == '') {
                    json_error('The field pseudo supp cannot be empty!');
                } elseif (post('fonction_id') == '') {
                    json_error('The field fonction id cannot be empty!');
                } elseif (post('departement_id') == '') {
                    json_error('The field departement id cannot be empty!');
                } elseif (post('id_hotel') == '') {
                    json_error('The field id hotel cannot be empty!');
                }else {
                    $employe_id = post('id');
                    $etatcivil = post('etatcivil');
                    $datenais = format_stringdateTodatetime('d/m/Y', post('datenais'), 'Y-m-d');
                    $nbrenf = post('nbrenf');
                    $adresse=post('rue').'  Q/'.post('quartier').' C/'.post('commune');
                    if (!empty($_FILES['image'])) {
                        $this->resemployes_model->UpdateImage(post('matricule'), post('noms'), post('sexe'), post('etatcivil'), post('nationalite'), post('lieunais'), $datenais, $adresse, post('rue'), post('quartier'), post('commune'), post('ville'), post('piece'), post('numpiece'), post('tel1'), post('tel2'), post('email'), post('nbrenf'), post('actif'), post('pseudo_supp'), post('fonction_id'), post('departement_id'), post('id_hotel'), post('id'), post('numinss'), post('fingerprint'));
                    } else {
                        $this->resemployes_model->Update(post('matricule'), post('noms'), post('sexe'), post('etatcivil'), post('nationalite'), post('lieunais'), $datenais, $adresse, post('rue'), post('quartier'), post('commune'), post('ville'), post('piece'), post('numpiece'), post('tel1'), post('tel2'), post('email'), post('nbrenf'), post('actif'), post('pseudo_supp'), post('fonction_id'), post('departement_id'), post('id_hotel'), post('id'), post('numinss'), post('fingerprint'));
                    }
                    $dteng = format_stringdateTodatetime('d/m/Y', post('dteng'), 'Y-m-d');
                    $contratobj->Update(post('typecontr'), $dteng, $employe_id);
                    if ($nbrenf > 0 && !empty($_POST['enfnoms'])) {
                        $type = 'enfant';
                        $enfnoms = $_POST['enfnoms'];
                        $enfdatenais = $_POST['enfdatenais'];
                        $nomconj = post('nomconj');
                        $bool = False;
                        for ($i = 0; $i <= $nbrenf - 1; $i++) {
                            if (empty($enfnoms[$i])) {
                                $bool = TRUE;
                                $j = $i + 1;
                                break;
                            }
                        }
                        if ($bool) {
                            json_error('Veullez remplir le champ noms' . $j . '!');
                        }
                        $this->resemployes_model->UpdateFamille($employe_id, $nomconj, $nbrenf, $enfnoms, $enfdatenais, $employefamilleobj);
                    }
                    //Affectation horaire
                    if (!empty($_POST['horaire_ids'])) {
                        $horaire_ids = $_POST['horaire_ids'];
                        $priorites = $_POST['priorites'];
                        $seqs = $_POST['seqs'];
                        $nbrjrstrav = $_POST['nbrjrstrav'];
                        $this->resemployes_model->UpdateHoraire($employe_id, $horaire_ids, $priorites, $seqs, $nbrjrstrav, $affectationhoraireobj);
                    } else {
                        $horaire_ids = array();
                        $priorites = array();
                        $seqs = array();
                        $nbrjrstrav = array();
                        $this->resemployes_model->UpdateHoraire($employe_id, $horaire_ids, $priorites, $seqs, $nbrjrstrav, $affectationhoraireobj);
                    }

                     //Update dans resemploye_eligibl pour etablir facilement la liste des employes elibles
                      $noms=post('noms');
                      $id_hotel=post('id_hotel');

                    if(post('typecontr')=='CDI'){   
                        //on verifie s'il existe dans reseligible
                    $requete = 'SELECT * FROM resemploye_eligibl 
                    WHERE employe_id=:employe_id';
                    $query = HDB::hus()->prepare($requete);
                    $query->BindParam(':employe_id', $employe_id);
                    try {
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                    } catch (PDOException $e) {
                        die($e->getMessage());
                    }
                    if (COUNT($result) > 0) {

                    $query =HDB::hus()->prepare("UPDATE resemploye_eligibl SET noms_employe=:noms_employe,dteengag=:dteengag,dte1=:dte1 WHERE employe_id=:employe_id ");
                    $query->BindParam(':noms_employe', $noms);
                    $query->BindParam(':dteengag', $dteng);
                    $query->BindParam(':dte1', $dteng);
                    $query->BindParam(':employe_id', $employe_id);
                    $query->execute();
                    }else{
                    $query = HDB::hus()->prepare("INSERT resemploye_eligibl(employe_id,noms_employe,dteengag,dte1,site_id)
                                         VALUES(:employe_id,:noms_employe,:dteengag,:dte1,:site_id)");

                    $query->BindParam(':employe_id',$employe_id);
                    $query->BindParam(':noms_employe',$noms);
                    $query->BindParam(':dteengag', $dteng);
                    $query->BindParam(':dte1', $dteng);
                    $query->BindParam(':site_id',$id_hotel);
                    $query->execute();     
                    }

                    }else{
                    $query = HDB::hus()->prepare("DELETE FROM resemploye_eligibl WHERE employe_id=:employe_id");
                    $query->BindParam(':employe_id', $employe_id);
                    $query->execute();
                    }
                    //fin  Update
                    json_send('' . H_ADMIN . '&view=resemployes&id=' . post('id') . '&do=details&msg=update');
                    json_send('' . H_ADMIN . '&view=resemployes&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->resemployes_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resemployes/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->resemployes_model->TruncateTable('' . H_ADMIN . '&view=resemployes&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/resemployes/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->resemployes_model->Delete(get('id'), '' . H_ADMIN . '&view=resemployes&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->resemployes_model->Delete(get('id'), '' . H_ADMIN . '&view=resemployes&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=resemployes&id=' . get('id') . '&do=update&msg=delete');
            }
        }
    }

//end invoke
}

//end class
?>
	