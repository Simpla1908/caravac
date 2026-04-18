<?php

/*
* =======================================================================
* FILE NAME:        reshoraire.php
* DATE CREATED:  	17-11-2017
* FOR TABLE:  		reshoraire
* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
* =======================================================================
*/

if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/reshoraire.php');
include(APP_FOLDER . '/models/objects/resjours.php');
include(APP_FOLDER . '/models/objects/reshorairejours.php');
include(APP_FOLDER . '/models/objects/respointage.php');

class reshoraire_controller
{
    public $reshoraire_model;

    public function __construct()
    {
        $this->reshoraire_model = new reshoraire_model();
    }

    public function invoke_reshoraire()
    {
        $reshjrs = new reshorairejours_model();
        $respoint = new respointage_model();
        //SELECT ALL //////////////////////////////////
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->reshoraire_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->reshoraire_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=reshoraire&do=viewall');
            } else {
                $result = $this->reshoraire_model->SelectAll();
            }
            include(APP_FOLDER . '/views/admin/reshoraire/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////
        if (get('do') == 'export') {
            $result = $this->reshoraire_model->SelectAll();
            include(APP_FOLDER . '/views/admin/reshoraire/Export.php');
        } //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->reshoraire_model->SelectOne(get('idh'));
            include(APP_FOLDER . '/views/admin/reshoraire/Export2.php');
        } //SEARCH SUGGEST ////////////////////////////////////////////////////
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->reshoraire_model->AutoSearch(trim($qstring), 10, 'libh');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=reshoraire&idh=' . $srow->idh . '&do=details"><li class="list-group-item">' . $srow->libh . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        } //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $resjours_obj = new resjours_model();
            $result = $resjours_obj->SelectAll();
            include(APP_FOLDER . '/views/admin/reshoraire/Add.php');
        } //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('libh') == '') {
                    json_error('Le champ désignation ne peut pas être vide!');
                } else {
                    $bool = 0;
                    $nbrjrs = count($_POST["jrs"]);
                    for ($i = 0; $i < $nbrjrs; $i++) {
                        if (post('dbt' . $_POST["jrs"][$i]) == '' || post('mrg' . $_POST["jrs"][$i]) == '' || post('fin' . $_POST["jrs"][$i]) == '') {
                            $bool = 1;
                        }
                    }
                    if ($bool == 1) {
                        json_error('Veuillez remplir tous les champs!');
                    } else {
                        $horaire_id = $this->reshoraire_model->Insert(post('libh'), $nbrjrs, $_SESSION['idsite']);
                        for ($i = 0; $i < $nbrjrs; $i++) {
                            $jours_id = $_POST["jrs"][$i];
                            $mrgp = post('mrgp' . $_POST["jrs"][$i]);
                            $dbt = post('dbt' . $_POST["jrs"][$i]);
                            $mrg = post('mrg' . $_POST["jrs"][$i]);
                            $fin = post('fin' . $_POST["jrs"][$i]);
                            $mrgf = post('mrgf' . $_POST["jrs"][$i]);
                            $smrgp = $mrgp * 60;
                            $sdbt = $respoint->TimeToSec($dbt);
                            $smrg = $mrg * 60;
                            $sfin = $respoint->TimeToSec($fin);
                            $smrgf = $mrgf * 60;
                            $reshjrs->Insert($horaire_id, $jours_id, $dbt, $mrg, $fin, $mrgp, $mrgf, $smrgp, $sdbt, $smrg, $sfin, $smrgf);
                        }
                        json_send('' . H_ADMIN . '&view=reshoraire&do=viewall&msg=add');
                        json_success('Process Completed');
                    }
                }
            }

        } //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->reshoraire_model->SelectOne(get('idh'));
            $resjours_obj = new resjours_model();
            $result = $resjours_obj->SelectAll();
            $reshorjours_obj = new reshorairejours_model();
            $result1 = $reshorjours_obj->SelectJrsH(get('idh'));
            $horjours['hj'] = array();
            $horjours['hj']['jours_id'] = array();
            $horjours['hj']['dbt'] = array();
            $horjours['hj']['mrg'] = array();
            $horjours['hj']['fin'] = array();
            $horjours['hj']['mrgp'] = array();
            $horjours['hj']['mrgf'] = array();
            foreach ($result1 as $res1) {
                array_push($horjours['hj']['jours_id'], $res1->jours_id);
                $horjours['hj']['dbt'][$res1->jours_id] = $res1->dbt;
                $horjours['hj']['mrg'][$res1->jours_id] = $res1->mrg;
                $horjours['hj']['fin'][$res1->jours_id] = $res1->fin;
                $horjours['hj']['mrgp'][$res1->jours_id] = $res1->avmrgdbt;
                $horjours['hj']['mrgf'][$res1->jours_id] = $res1->mrgfin;


            }
            include(APP_FOLDER . '/views/admin/reshoraire/Update.php');
        } //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                $reshjrs = new reshorairejours_model();
                if ($_POST) {
                    //form validation
                    if (post('libh') == '') {
                        json_error('Le champ désignation ne peut pas être vide!');
                    } else {
                        $bool = 0;
                        $nbrjrs = count($_POST["jrs"]);
                        for ($i = 0; $i < $nbrjrs; $i++) {
                            if (post('dbt' . $_POST["jrs"][$i]) == '' || post('mrg' . $_POST["jrs"][$i]) == '' || post('fin' . $_POST["jrs"][$i]) == '') {
                                $bool = 1;
                            }
                        }
                        if ($bool == 1) {
                            json_error('Veuillez remplir tous les champs!');
                        } else {
                            $this->reshoraire_model->Update(post('libh'), $nbrjrs, post('idh'));
                            $reshjrs->Delete2(post('idh'));
                            for ($i = 0; $i < $nbrjrs; $i++) {
                                //$reshjrs->Insert(post('idh'),$_POST["jrs"][$i],post('dbt'.$_POST["jrs"][$i]),post('mrg'.$_POST["jrs"][$i]),post('fin'.$_POST["jrs"][$i]));
                                $horaire_id = post('idh');
                                $jours_id = $_POST["jrs"][$i];
                                $mrgp = post('mrgp' . $_POST["jrs"][$i]);
                                $dbt = post('dbt' . $_POST["jrs"][$i]);
                                $mrg = post('mrg' . $_POST["jrs"][$i]);
                                $fin = post('fin' . $_POST["jrs"][$i]);
                                $mrgf = post('mrgf' . $_POST["jrs"][$i]);
                                $smrgp = $mrgp * 60;
                                $sdbt = $respoint->TimeToSec($dbt);
                                $smrg = $mrg * 60;
                                $sfin = $respoint->TimeToSec($fin);
                                $smrgf = $mrgf * 60;
                                $reshjrs->Insert($horaire_id, $jours_id, $dbt, $mrg, $fin, $mrgp, $mrgf, $smrgp, $sdbt, $smrg, $sfin, $smrgf);
                            }
                            json_send('' . H_ADMIN . '&view=reshoraire&do=viewall&msg=update');
                            json_success('Process Completed');
                        }
                    }
                }


            }
        } //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->reshoraire_model->SelectOne(get('idh'));
            include(APP_FOLDER . '/views/admin/reshoraire/Details.php');
        } //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->reshoraire_model->TruncateTable('' . H_ADMIN . '&view=reshoraire&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/reshoraire/View.php');
        } //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('idh') and $dfile == '') {
                $del = $this->reshoraire_model->Delete(get('idh'), '' . H_ADMIN . '&view=reshoraire&do=viewall&msg=delete');
            } elseif (get('idh') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->reshoraire_model->Delete(get('idh'), '' . H_ADMIN . '&view=reshoraire&do=viewall&msg=delete');
            } elseif (get('idh') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=reshoraire&idh=' . get('idh') . '&do=update&msg=delete');
            }
        }
    }//end invoke
}//end class
?>
	