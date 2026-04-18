
<?php

/*
 * =======================================================================
 * FILE NAME:        t_responsable.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_responsable
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/t_responsable.php');

class t_responsable_controller
{

    public $t_responsable_model;

    public function __construct()
    {
        $this->t_responsable_model = new t_responsable_model();
    }

    public function invoke_t_responsable()
    {

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $result = $this->t_responsable_model->SelectAll($_SESSION['company_id']);
            include(APP_FOLDER . '/views/admin/t_responsable/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->t_responsable_model->SelectAll();
            include(APP_FOLDER . '/views/admin/t_responsable/Export.php');
        } elseif (get('do') == 'ProcGenAccountRespon') {
            $bdd = HDB::hus();
            $num_cmd = 1;
            $libelle = 'compteclientresponsable';
            $numberincre = getnumerotationresponsable($_SESSION['id_hotel'], $libelle, $num_cmd, $bdd);
            $numberincrefmt = str_pad($numberincre, 4, "0", STR_PAD_LEFT);
            $accountnumber = '4111' . $numberincrefmt;
            $_SESSION['numberincreaccountnumber'] = $numberincre;
            $_SESSION['accountnumber'] = $accountnumber;
            echo $accountnumber;
        }
        //elseif (get('do') == 'generationaccount') {
        //     $bdd = HDB::hus();
        //     $num_cmd = $_SESSION['account_respons'];
        //     $id_respo = $_GET['id_respo'];
        //     $entreprise = $_GET['entreprise'];
        //     $libelle = 'compteclientresponsable';
        //     $num_cmd = $_SESSION['account_respons'];
        //     $numberincre = getnumerotationresponsable($_SESSION['id_hotel'], $libelle, $num_cmd, $bdd);
        //     $accountnumber = str_pad($numberincre, 3, "0", STR_PAD_LEFT);
        //     $suffixe = $accountnumber;
        //     $accountnumber = '4111' . $accountnumber;
        //     //CREATION COMPTE CLIENT
        //     $libelle = $entreprise;
        //     $numero = $accountnumber;
        //     $compte_id = '284';
        //     $psedo = 0;
        //     $modif = 0;
        //     $site_id = $_SESSION['id_hotel'];
        //     $requete = $bdd->prepare("INSERT INTO cptsouscomptes (libelle,numero,compte_id,psedo,modif,site_id,suffixe)
        //                             VALUES(:libelle,:numero,:compte_id,:psedo,:modif,:site_id,:suffixe)");

        //     $requete->BindParam(':libelle', $libelle);
        //     $requete->BindParam(':numero', $numero);
        //     $requete->BindParam(':compte_id', $compte_id);
        //     $requete->BindParam(':psedo', $psedo);
        //     $requete->BindParam(':modif', $modif);
        //     $requete->BindParam(':site_id', $site_id);
        //     $requete->BindParam(':suffixe', $suffixe);
        //     $requete->execute();
        //     $id_sous_compte = $bdd->lastInsertId();
        //     //CREATION COMPTE CLIENT
        //     $requete = $bdd->prepare("UPDATE t_responsable  SET id_sous_compte =:id_sous_compte WHERE id_respo=:id_respo");
        //     $requete->BindParam(':id_sous_compte', $id_sous_compte);
        //     $requete->BindParam(':id_respo', $id_respo);
        //     $requete->execute();
        //     $numberincre += 1;
        //     $libelle = 'compteclientresponsable';
        //     setnumerotation($_SESSION['id_hotel'], $libelle, $numberincre, $bdd);
        // }
        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->t_responsable_model->SelectOne(get('id_respo'));
            include(APP_FOLDER . '/views/admin/t_responsable/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->t_responsable_model->AutoSearch(trim($qstring), 10, 'nom_respo');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_responsable&id_respo=' . $srow->id_respo . '&do=details"><li class="list-group-item">' . $srow->nom_respo . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/t_responsable/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('nom_respo') == '') {
                    json_error('The field nom respo cannot be empty!');
                } elseif (post('telephone_respo') == '') {
                    json_error('The field telephone respo cannot be empty!');
                } elseif (post('email') == '') {
                    json_error('The field email  cannot be empty!');
                } elseif (post('adresse_respo') == '') {
                    json_error('The field adresse respo cannot be empty!');
                } elseif (post('entreprise') == '') {
                    json_error('The field entreprise cannot be empty!');
                } elseif (post('filtre') == '') {
                    json_error('The field filtre cannot be empty!');
                } elseif (post('company_id') == '') {
                    json_error('The field company id cannot be empty!');
                } else {

                    $account = $_SESSION['accountnumber'];
                    $numberincre = $_SESSION['numberincreaccountnumber'];
                    $bdd = HDB::hus();
                    $libelle = post('entreprise');
                    $numero = $account;
                    $compte_id = 284;
                    $psedo = 0;
                    $modif = 0;
                    $site_id = $_SESSION['id_hotel'];
                    $requete = $bdd->prepare("INSERT INTO cptsouscomptes (libelle,numero,compte_id,psedo,modif,site_id)
                                        VALUES(:libelle,:numero,:compte_id,:psedo,:modif,:site_id)");

                    $requete->BindParam(':libelle', $libelle);
                    $requete->BindParam(':numero', $numero);
                    $requete->BindParam(':compte_id', $compte_id);
                    $requete->BindParam(':psedo', $psedo);
                    $requete->BindParam(':modif', $modif);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->execute();
                    $id_sous_compte = $bdd->lastInsertId();
                    $this->t_responsable_model->Insert(post('nom_respo'), post('telephone_respo'), post('email'), post('adresse_respo'), post('entreprise'), post('filtre'), post('company_id'), $id_sous_compte);
                    $numberincre += 1;
                    $libelle = 'compteclientresponsable';
                    setnumerotation($_SESSION['id_hotel'], $libelle, $numberincre, $bdd);
                    json_send('' . H_ADMIN . '&view=t_responsable&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->t_responsable_model->SelectOne(get('id_respo'));
            if ($rows->id_sous_compte == NULL) {
                include(APP_FOLDER . '/views/admin/t_responsable/UpdateDefault.php');
            } else {
                $rows = $this->t_responsable_model->SelectOne2(get('id_respo'));
                include(APP_FOLDER . '/views/admin/t_responsable/Update.php');
            }
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id_respo') == '') {
                    json_error('The field id_respo cannot be empty!');
                } elseif (post('nom_respo') == '') {
                    json_error('The field nom respo cannot be empty!');
                } elseif (post('telephone_respo') == '') {
                    json_error('The field telephone respo cannot be empty!');
                } elseif (post('email') == '') {
                    json_error('The field email respo cannot be empty!');
                } elseif (post('adresse_respo') == '') {
                    json_error('The field adresse respo cannot be empty!');
                } elseif (post('entreprise') == '') {
                    json_error('The field entreprise cannot be empty!');
                } elseif (post('filtre') == '') {
                    json_error('The field filtre cannot be empty!');
                } elseif (post('company_id') == '') {
                    json_error('The field company id cannot be empty!');
                } else {
                    $boolmodif = post('boolmodif');
                    $id_sous_compte = post('id_sous_compte');
                    if ($boolmodif == 1) {
                        $account = $_SESSION['accountnumber'];
                        $numberincre = $_SESSION['numberincreaccountnumber'];
                        $bdd = HDB::hus();
                        $libelle = post('entreprise');
                        $numero = $account;
                        $compte_id = 284;
                        $psedo = 0;
                        $modif = 0;
                        $site_id = $_SESSION['id_hotel'];
                        $requete = $bdd->prepare("INSERT INTO cptsouscomptes (libelle,numero,compte_id,psedo,modif,site_id)
                                        VALUES(:libelle,:numero,:compte_id,:psedo,:modif,:site_id)");

                        $requete->BindParam(':libelle', $libelle);
                        $requete->BindParam(':numero', $numero);
                        $requete->BindParam(':compte_id', $compte_id);
                        $requete->BindParam(':psedo', $psedo);
                        $requete->BindParam(':modif', $modif);
                        $requete->BindParam(':site_id', $site_id);
                        $requete->execute();
                        $id_sous_compte = $bdd->lastInsertId();
                    }
                    $this->t_responsable_model->Update(post('nom_respo'), post('telephone_respo'), post('email'), post('adresse_respo'), post('entreprise'), post('filtre'), post('company_id'), $id_sous_compte, post('id_respo'));
                    if ($boolmodif == 1) {
                        $numberincre += 1;
                        $libelle = 'compteclientresponsable';
                        setnumerotation($_SESSION['id_hotel'], $libelle, $numberincre, $bdd);
                    }
                    json_send('' . H_ADMIN . '&view=t_responsable&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->t_responsable_model->SelectOne(get('id_respo'));
            include(APP_FOLDER . '/views/admin/t_responsable/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->t_responsable_model->TruncateTable('' . H_ADMIN . '&view=t_responsable&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/t_responsable/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            // $dfile=get('dfile');
            // 	if(get('id_respo') and $dfile==''){
            // $del = $this->t_responsable_model->Delete(get('id_respo'),''.H_ADMIN.'&view=t_responsable&do=viewall&msg=delete');
            // }
            // elseif(get('id_respo') and $dfile!='' and get('fdel')==''){
            // delete_files(UPLOAD_PATH.get('dfile'));
            // delete_files(THUMB_PATH.get('dfile'));
            // $del = $this->t_responsable_model->Delete(get('id_respo'),''.H_ADMIN.'&view=t_responsable&do=viewall&msg=delete');
            // }
            // elseif(get('id_respo') and $dfile!='' and get('fdel')!=''){
            // delete_files(UPLOAD_PATH.get('dfile'));
            // delete_files(THUMB_PATH.get('dfile'));
            // send_to(''.H_ADMIN.'&view=t_responsable&id_respo='.get('id_respo').'&do=update&msg=delete');
            // }
            $id = get('id_respo');
            $pseudo_supp = 1;
            $this->t_responsable_model->PseudoDel($pseudo_supp, $id);
            json_send('' . H_ADMIN . '&view=t_responsable&do=viewall&msg=delete');
        }
    }

    //end invoke
}

//end class
?>
	