
<?php

/*
 * =======================================================================
 * FILE NAME:        resrubrique.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resrubrique
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
include(APP_FOLDER . '/models/objects/resrubrique.php');
include_once(APP_FOLDER . '/models/objects/rescategorie.php');
include_once(APP_FOLDER . '/models/objects/resrubriquecateg.php');

class resrubrique_controller {

    public $resrubrique_model;

    public function __construct() {
        $this->resrubrique_model = new resrubrique_model();
    }

    public function invoke_resrubrique() {
        $categorieobj = new rescategorie_model();
        $rubriquecategobj = new resrubriquecateg_model();
        $rub=get('rub');
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $result = $this->resrubrique_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resrubrique/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->resrubrique_model->SelectAll();
            include(APP_FOLDER . '/views/admin/resrubrique/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->resrubrique_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resrubrique/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->resrubrique_model->AutoSearch(trim($qstring), 10, 'libelle');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=resrubrique&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->libelle . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $categories = $categorieobj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resrubrique/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                $nbre = 0;
                $salbase = 0;
                $salbrut = 0;
                $nbrenf = 0;
                $manuel = 0;
                $valeur = 0;
                $hrsup = 0;
                $jrp = 0;
                $pourcentage = 0;
                $imposable = 0;
                $salaire = post('salaire');
                $nombre = post('nombre');
                $sequence = 0;
                $valeur2 = 0;
                $type2='remuneration';
                $monnaie=$_SESSION['Paie_insert'];
                if (isset($_POST['categories'])) {
                    $nbre = COUNT($_POST['categories']);
                    $categories = $_POST['categories'];
                }
                if (post('libelle') == '') {
                    json_error('Veuillez entrer un nom comme désignation!');
                } elseif (post('type') == '') {
                    json_error('Veuillez choisir un type!');
                } elseif ($nbre == 0 && $rub==1) {
                    json_error('Veuillez choisir au moins une categorie!');
                } else {
                    $type = post('type');
                    if ($type == 'retenue'){
                        $sequence =4;
                        $type2='retenue';
                        $type='retenue';
                    } elseif ($type == 'prime'){
                        $sequence = 1;
                        $type2='prime';
                        $type='remuneration';
                    }elseif ($type == 'heure'){
                        $sequence =2;
                        $type='autre';
                        $type2='autre';
                    }elseif ($type == 'base'){
                        $sequence =0;
                        $type='base';
                        $type2='base';
                    }
                    elseif ($type == 'avance' || $type == 'pret'){
                        $sequence =5;
                        $type2='emprunt';
                    }
                    if ($type == 'transport'){
                        $sequence =0;
                        $type='remuneration';
                        $type2='transport';
                    }
                    if($salaire == 'salbase'){
                        $salbase = 1;
                    }
                    if ($salaire == 'salbrut') {
                         $salbrut= 1;
                    }
                    if ($salaire == 'manuel') {
                        $manuel = 1;
                        $valeur = post('nombre');
                        $monnaie=$_SESSION['Paie_insert'];
                    }
                    if (isset($_POST['pourcentage'])) {
                        $pourcentage = 1;
                        $valeur2 = post('valpourcentage');
                    }
                    if (isset($_POST['nbrenf'])) {
                        $nbrenf = post('nbrenf');
                    }
                    if (isset($_POST['jrp'])) {
                        $jrp = post('jrp');
                    }
                    if (isset($_POST['hrsup'])) {
                        $hrsup = post('hrsup');
                    }
                    if (isset($_POST['imposable'])) {
                        $imposable = post('imposable');
                    }
                    $rubrique_id = $this->resrubrique_model->Insert(post('libelle'),$type,$type2, post('psedo'), post('site_id'), post('affiche'), $sequence);
                    if ($rub==1){
                        for ($i = 0; $i <= $nbre - 1; $i++) {
                            $categorie_id = $categories[$i];
                            $rubriquecategobj->Insert($rubrique_id, $categorie_id, $salbase, $nbrenf, $salbrut, $manuel, $pourcentage, $imposable, $valeur,$monnaie, $jrp, $hrsup, $valeur2);
                        }
                    }
                    json_send('' . H_ADMIN . '&view=resrubrique&do=viewall&type='.$rub.'&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $id = get('id');
            $categories = $categorieobj->SelectAll($_SESSION['idsite']);
            $rubriquecategs = $this->resrubrique_model->Categories($id);
            $rows = $this->resrubrique_model->SelectOne($id);
            $paramsRubrique = $rubriquecategobj->SelectOne($id);
            include(APP_FOLDER . '/views/admin/resrubrique/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                $nbre = 0;
                $salbase = 0;
                $salbrut = 0;
                $nbrenf = 0;
                $manuel = 0;
                $valeur = 0;
                $hrsup = 0;
                $jrp = 0;
                $pourcentage = 0;
                $imposable = 0;
                $salaire = post('salaire');
                $nombre = post('nombre');
                $sequence = 0;
                $valeur2 = 0;
                $type2='remuneration';
                $monnaie=$_SESSION['Paie_insert'];
                if (isset($_POST['categories'])) {
                    $nbre = COUNT($_POST['categories']);
                    $categories = $_POST['categories'];
                }
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('libelle') == '') {
                    json_error('Veuillez entrer un nom comme désignation!');
                } elseif (post('type') == '') {
                    json_error('Veuillez choisir un type!');
                } elseif ($nbre == 0 && $rub==1) {
                    json_error('Veuillez choisir au moins une categorie!');
                } else {
                    $type = post('type');
                    if ($type == 'retenue'){
                        $sequence =4;
                        $type2='retenue';
                        $type='retenue';
                    } elseif ($type == 'prime'){
                        $sequence =1;
                        $type2='remuneration';
                        $type='prime';
                    }elseif ($type == 'heure'){
                        $sequence =2;
                        $type='autre';
                        $type2='autre';
                    }elseif ($type == 'base'){
                        $sequence =0;
                        $type='base';
                        $type2='base';
                    }
                    elseif ($type == 'avance' || $type == 'pret'){
                        $sequence =5;
                        $type2='emprunt';
                    }
                    if ($type == 'transport'){
                        $sequence =0;
                        $type='remuneration';
                        $type2='transport';
                    }
                    if($salaire == 'salbase'){
                        $salbase = 1;
                    }
                    if ($salaire == 'salbrut') {
                         $salbrut= 1;
                    }
                    if ($salaire == 'manuel') {
                        $manuel = 1;
                        $valeur = post('nombre');
                        $monnaie=$_SESSION['Paie_insert'];
                    }
                    if (isset($_POST['pourcentage'])) {
                        $pourcentage = 1;
                        $valeur2 = post('valpourcentage');
                    }
                    if (isset($_POST['nbrenf'])) {
                        $nbrenf = post('nbrenf');
                    }
                    if (isset($_POST['jrp'])) {
                        $jrp = post('jrp');
                    }
                    if (isset($_POST['hrsup'])) {
                        $hrsup = post('hrsup');
                    }
                    if (isset($_POST['imposable'])) {
                        $imposable = post('imposable');
                    }
                    $this->resrubrique_model->Update(post('libelle'),$type,$type2, post('psedo'), post('site_id'), post('affiche'), post('sequence'), post('id'));
                     if ($rub==1){
                      $rubrique_id = post('id');
                      $rubriquecategobj->DeleteByRubriqueID($rubrique_id);
                      for ($i = 0; $i <= $nbre - 1; $i++){
                        $categorie_id = $categories[$i];
                        $rubriquecategobj->Insert($rubrique_id, $categorie_id, $salbase, $nbrenf, $salbrut, $manuel, $pourcentage, $imposable, $valeur,$monnaie, $jrp, $hrsup, $valeur2);
                      }   
                     }
                    json_send('' . H_ADMIN . '&view=resrubrique&do=viewall&type='.$rub.'&msg=update');
//                    json_send('' . H_ADMIN . '&view=resrubrique&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->resrubrique_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resrubrique/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->resrubrique_model->TruncateTable('' . H_ADMIN . '&view=resrubrique&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/resrubrique/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $t=get('type');
            $del = $this->resrubrique_model->Delete(get('id'), '' . H_ADMIN . '&view=resrubrique&do=viewall&msg=delete'.'&type='.$t);
           /* $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->resrubrique_model->Delete(get('id'), '' . H_ADMIN . '&view=resrubrique&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->resrubrique_model->Delete(get('id'), '' . H_ADMIN . '&view=resrubrique&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=resrubrique&id=' . get('id') . '&do=update&msg=delete');
            }*/
        }
    }

//end invoke
}

//end class
?>
	