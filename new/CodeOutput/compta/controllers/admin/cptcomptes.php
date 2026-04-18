
<?php

/*
 * =======================================================================
 * FILE NAME:        cptcomptes.php
 * DATE CREATED:  	18-04-2019
 * FOR TABLE:  		cptcomptes
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/cptcomptes.php');
class cptcomptes_controller {

    public $cptcomptes_model;

    public function __construct() {
        $this->cptcomptes_model = new cptcomptes_model();
    }

    public function invoke_cptcomptes() {
        $json = array();
        $json['s'] = False;
        $json['message'] = '';

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->cptcomptes_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->cptcomptes_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=cptcomptes&do=viewall');
            } else {
                $result = $this->cptcomptes_model->SelectAll();
            }
             $bdd=ConnectWithUtf();
             PlanComptable($bdd);
             $comptes=GetListComptes($bdd);
             $categories=CategoriesComptes($bdd);
            include(APP_FOLDER . '/views/admin/cptcomptes/View.php');
        }elseif(get('do')=='majplcpt'){
            $bdd=ConnectWithUtf();
            PlanComptable($bdd);
           $comptes=GetListComptes($bdd); 
           include(APP_FOLDER . '/views/admin/cptcomptes/lignescomptes.php');
        }
        
        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->cptcomptes_model->SelectAll();
            include(APP_FOLDER . '/views/admin/cptcomptes/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->cptcomptes_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/cptcomptes/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->cptcomptes_model->AutoSearch(trim($qstring), 10, 'libelle');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=cptcomptes&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->libelle . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/cptcomptes/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('libelle') == '') {
                    json_error('The field libelle cannot be empty!');
                } elseif (post('numero') == '') {
                    json_error('The field numero cannot be empty!');
                } elseif (post('niveau') == '') {
                    json_error('The field niveau cannot be empty!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('classe_id') == '') {
                    json_error('The field classe id cannot be empty!');
                } else {
                    $this->cptcomptes_model->Insert(post('libelle'), post('numero'), post('niveau'), post('psedo'), post('classe_id'));
                    json_send('' . H_ADMIN . '&view=cptcomptes&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->cptcomptes_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/cptcomptes/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('libelle') == '') {
                    json_error('The field libelle cannot be empty!');
                } elseif (post('numero') == '') {
                    json_error('The field numero cannot be empty!');
                } elseif (post('niveau') == '') {
                    json_error('The field niveau cannot be empty!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('classe_id') == '') {
                    json_error('The field classe id cannot be empty!');
                } else {
                    $this->cptcomptes_model->Update(post('libelle'), post('numero'), post('niveau'), post('psedo'), post('classe_id'), post('id'));
                    json_send('' . H_ADMIN . '&view=cptcomptes&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->cptcomptes_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/cptcomptes/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->cptcomptes_model->TruncateTable('' . H_ADMIN . '&view=cptcomptes&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/cptcomptes/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            if (get('id')) {
                $del = $this->cptcomptes_model->Delete(get('id'), '' . H_ADMIN . '&view=cptcomptes&do=viewall&msg=delete');
            } 
        }
        elseif (get('do') == 'addpro2') {
                if ($_POST) {
                    //form validation
                    $bdd = HDB::hus();
                    $compte_id = post('compte_id');
                    $prefnum = post('prefnum');
                    $snumero = post('snumero');
                    $libelle = post('libelle');
                    $statut = post('statut');
                    $numero=$prefnum.$snumero;
                    $psedo=0;
                    $bool=$this->cptcomptes_model->VerifNumero($numero,$bdd);
                    $json['bool']=$bool;
                    if ($compte_id == '') {
                        $json['message'] = "Veuillez choisir un compte!";
                    } elseif ($snumero == '') {
                        $json['message'] = "Veuillez compléter le numéro du sous-compte!";
                    }elseif($bool){
                         $json['message'] = "Veuillez changer ce numéro du sous-compte, car ".$numero." existe déja !"; 
                    }
                    elseif ($libelle == '') {
                        $json['message'] = "Veuillez saisir un nom du sous-compte!";
                    } else {
                        $this->cptcomptes_model->InsertSousCompte($libelle,$numero,$compte_id,$snumero,$bdd);
                        $json['message'] = "L'ajout du sous-compte s'est effectué avec succès!";
                        $json['s'] = TRUE;
                    }
                    echo json_encode($json);
                }
        }elseif (get('do') == 'updtsubaccount') {
                if ($_POST) {
                    //form validation
                    $bool=FALSE;
                    $bdd = HDB::hus();
                    $compte_id = post('compte_id');
                    $prefnum = post('prefnum');
                    $snumero = post('snumero');
                    $libelle = post('libelle');
                    $statut = post('statut');
                    $oldnumero = post('oldnumero');
                    $sous_compte_id=post('sous_compte_id');
                    $numero=$prefnum.$snumero;
                    $psedo=0;
                    $bool=$this->cptcomptes_model->VerifNumero2($numero,$oldnumero,$bdd);
                    $json['bool']=$bool;
                    if ($compte_id == '') {
                        $json['message'] = "Veuillez choisir un compte!";
                    } elseif ($snumero == '') {
                        $json['message'] = "Veuillez compléter le numéro du sous-compte!";
                    }elseif($bool){
                         $json['message'] = "Veuillez changer ce numéro du sous-compte, car ".$numero." existe déja !"; 
                    }
                    elseif ($libelle == '') {
                        $json['message'] = "Veuillez saisir un nom du sous-compte!";
                    } else {
                        $this->cptcomptes_model->UpdateSousCompte($sous_compte_id,$libelle,$numero,$compte_id,$snumero,$bdd);
                        $json['message'] = "La mise à jours du sous-compte s'est effectué avec succès!";
                        $json['s'] = TRUE;
                    }
                    echo json_encode($json);
                }
        }elseif (get('do') == 'delsubaccount') {
                    //form validation
                    $bdd = HDB::hus();
                    $souscompteid = get('souscompteid');
                    echo 'souscompteid  '.$souscompteid;
                    $this->cptcomptes_model->DeleteSousCompte($souscompteid,$bdd);
        }elseif (get('do') == 'addcpt') {
                if ($_POST) {
                    //form validation
                    $bdd = HDB::hus();
                    $categorie_id = post('compte_id');
//                    $prefnum = post('prefnum');
                    $snumero = post('snumero');
                    $libelle = post('libelle');
                    $statut = post('etat');
                    $numero=$snumero;
//                    $bool=$this->cptcomptes_model->VerifNumero($numero,$bdd);
//                    $json['bool']=$bool;
                    if ($categorie_id == '') {
                        $json['message'] = "Veuillez choisir un compte!";
                    } elseif ($snumero == '') {
                        $json['message'] = "Veuillez compléter le numéro du sous-compte!";
                    }
//                    elseif($bool){
//                         $json['message'] = "Veuillez changer ce numéro du sous-compte, car ".$numero." existe déja !"; 
//                    }
                    elseif ($libelle == '') {
                        $json['message'] = "Veuillez saisir un nom du compte!";
                    } else {
                        $this->cptcomptes_model->Insert($libelle,$numero,$statut,$categorie_id,$bdd);
                        $json['message'] = "L'ajout du compte s'est effectué avec succès!";
                        $json['s'] = TRUE;
                    }
                    echo json_encode($json);
                }
        }
    }

//end invoke
}

//end class
?>
	