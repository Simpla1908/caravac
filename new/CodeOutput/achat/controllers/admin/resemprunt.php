
<?php

/*
 * =======================================================================
 * FILE NAME:        resemprunt.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resemprunt
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/resemprunt.php');
include(APP_FOLDER . '/models/objects/resemployes.php');
include(APP_FOLDER . '/models/objects/resremboursement.php');
include(APP_FOLDER . '/models/objects/compteur.php');


class resemprunt_controller {

    public $resemprunt_model;

    public function __construct() {
        $this->resemprunt_model = new resemprunt_model();
    }

    public function invoke_resemprunt() {
        $resempl_obj = new resemployes_model();
        $resremb_obj = new resremboursement_model();
        $compteurobj= new compteur_model();
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->resemprunt_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->resemprunt_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=resemprunt&do=viewall');
            } else {
                $result = $this->resemprunt_model->SelectAll();
            }
            include(APP_FOLDER . '/views/admin/resemprunt/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->resemprunt_model->SelectAll();
            include(APP_FOLDER . '/views/admin/resemprunt/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->resemprunt_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resemprunt/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->resemprunt_model->AutoSearch(trim($qstring), 10, 'libelle');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=resemprunt&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->libelle . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/resemprunt/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('libelle') == '') {
                    json_error('The field libelle cannot be empty!');
                } elseif (post('type') == '') {
                    json_error('The field type cannot be empty!');
                } elseif (post('montant') == '') {
                    json_error('The field montant cannot be empty!');
                } elseif (post('dte') == '') {
                    json_error('The field dte cannot be empty!');
                } elseif (post('dte_deduct') == '') {
                    json_error('The field dte deduct cannot be empty!');
                } elseif (post('employe_id') == '') {
                    json_error('The field employe id cannot be empty!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } else {
                    $this->resemprunt_model->Insert(post('libelle'), post('type'), post('montant'), post('dte'), post('dte_deduct'), post('employe_id'), post('psedo'), post('site_id'));
                    json_send('' . H_ADMIN . '&view=resemprunt&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->resemprunt_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resemprunt/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('libelle') == '') {
                    json_error('The field libelle cannot be empty!');
                } elseif (post('type') == '') {
                    json_error('The field type cannot be empty!');
                } elseif (post('montant') == '') {
                    json_error('The field montant cannot be empty!');
                } elseif (post('dte') == '') {
                    json_error('The field dte cannot be empty!');
                } elseif (post('dte_deduct') == '') {
                    json_error('The field dte deduct cannot be empty!');
                } elseif (post('employe_id') == '') {
                    json_error('The field employe id cannot be empty!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } else {
                    $this->resemprunt_model->Update(post('libelle'), post('type'), post('montant'), post('dte'), post('dte_deduct'), post('employe_id'), post('psedo'), post('site_id'), post('id'));
                    json_send('' . H_ADMIN . '&view=resemprunt&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->resemprunt_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resemprunt/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->resemprunt_model->TruncateTable('' . H_ADMIN . '&view=resemprunt&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/resemprunt/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->resemprunt_model->Delete(get('id'), '' . H_ADMIN . '&view=resemprunt&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->resemprunt_model->Delete(get('id'), '' . H_ADMIN . '&view=resemprunt&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=resemprunt&id=' . get('id') . '&do=update&msg=delete');
            }
        }
        //Avance ///////////////////////////////////
        elseif (get('do') == 'add_av') {
            $idlib = IdLibRubriq('avance', $_SESSION['idsite']);
            $result = $resempl_obj->SelectAll($_SESSION['idsite']);
            $annee = date("Y");
            $mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

            include(APP_FOLDER . '/views/admin/resemprunt/Add_Av.php');
        } elseif (get('do') == 'addpro_av') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            if ($_POST) {
                //form validation
                if (post('idagent') == '') {
                    $json['message'] = json_error2('Veuillez sélectionner un employé!');
                } elseif (post('dte') == '') {
                    $json['message'] = json_error2('Veuillez sélectionner la date!');
                } elseif (post('mont') == '' || post('mont') <= 0) {
                    $json['message'] = json_error2('Veuillez entrer un montant correct!');
                } elseif (post('dte_deduct') == '') {
                    $json['message'] = json_error2('Veuillez sélectionner le mois!');
                } else {
                    $idlib = post('idlib');
                    $idagent = post('idagent');
                    $nomemploye= post('nomemploye');
                    $dte = dateToformatBdd(post('dte'));
                    $dte_deduct = post('dte_deduct');
                    $duree = 1;
                    $mont1 = post('mont');
                    $mont2 = $mont1 / $duree;
                    $psedo = 0;
                    $monnaie = $_SESSION['Paie_insert'];
                    $taux = $_SESSION['Paie_taux'];
                    $site_id = $_SESSION['idsite'];
                     //vérification si montant emprunté soldé
                     $bool =MontEmpruntSold($idagent,$idlib,$site_id);
                     //fin vérification
                     if($bool==0){
                    //GET NUMEROTATION
                    $libcptfact=NUM_AVANCE;
                    $num_cmd = $compteurobj->getnumerotation($site_id,$libcptfact);
                    $num_cmd_format = format_numero($num_cmd);  
                    $num=$num_cmd_format;
                    $emprunt_id = $this->resemprunt_model->Insert($idlib,$num, $mont1, $mont2, $monnaie, $taux, $dte, $dte_deduct, $duree, $idagent, $psedo, $site_id);
                    //MAJ NUMEROTATION COMPTEUR
                    $num_cmd+=1;
                    $compteurobj->Update($libcptfact, $num_cmd, $site_id);
                    $salaire_id = Null;
                    $montant = 0;
                    $resremb_obj->Insert($idagent, $salaire_id, $montant, $monnaie, $taux, $dte, $emprunt_id);
                    $json['noms'] = $nomemploye;
                    $json['numero'] =$num;
                    $json['montant'] =$mont1;
                    $json['dte'] = $dte;
                    $json['message'] = json_success2("Opération effectuée avec succes");
                    $json['s'] = true;
                }else{
                    $json['message'] = json_error2("L'employé(e) ".$_SESSION['noms_employ']." ne peut pas emprunter car il a un reste de ".afficheMontant($_SESSION['Paie_affiche'],$_SESSION['reste'])." sur ".afficheMontant($_SESSION['Paie_affiche'],$_SESSION['montant'])." emprunté.");
                }
                }
                echo json_encode($json);
            }
        } elseif (get('do') == 'view_av') {
            $idlib = IdLibRubriq('avance', $_SESSION['idsite']);
            $site_id = $_SESSION['idsite'];
            $result = $this->resemprunt_model->ViewPretAvan($idlib, $site_id);
            include(APP_FOLDER . '/views/admin/resemprunt/View_Av.php');
        }elseif (get('do') == 'view_av_d') {
            $idlib = IdLibRubriq('avance', $_SESSION['idsite']);
            $site_id = $_SESSION['idsite'];
            $idemply= get('employe_id');
            $result = $this->resemprunt_model->ViewPretAvan1($idemply,$idlib, $site_id);
            include(APP_FOLDER . '/views/admin/resemprunt/View_Av_D.php');
        }
        //Pret //////////////////////////////////////////////////
        elseif (get('do') == 'add_pr') {
            $idlib = IdLibRubriq('pret', $_SESSION['idsite']);
            $result = $resempl_obj->SelectAll($_SESSION['idsite']);
            $annee = date("Y");
            $mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

            include(APP_FOLDER . '/views/admin/resemprunt/Add_Pr.php');
        } elseif (get('do') == 'addpro_pr') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            if ($_POST) {
                //form validation
                if (post('idagent') == '') {
                    $json['message'] = json_error2('Veuillez sélectionner un employé!');
                } elseif (post('mont') == '' || post('mont') <= 0) {
                    $json['message'] = json_error2('Veuillez entrer un montant correct!');
                } else if (post('duree') == '' || post('duree') <= 0) {
                    $json['message'] = json_error2('Veiuillez entrer une durée exacte!');
                } elseif (post('dte_deduct') == '') {
                    $json['message'] = json_error2('Veuillez sélectionner le mois!');
                } else {
                    $idlib = post('idlib');
                    $idagent = post('idagent');
                    $nomemploye= post('nomemploye');
                    $dte = dateToformatBdd(post('dte'));
                    $dte_deduct = post('dte_deduct');
                    $duree = post('duree');
                    $mont1 = post('mont');
                    $mont2 = $mont1 / $duree;
                    $psedo = 0;
                    $monnaie = $_SESSION['Paie_insert'];
                    $taux = $_SESSION['Paie_taux'];
                    $site_id = $_SESSION['idsite'];
                    //vérification si montant emprunté soldé
                    $bool =MontEmpruntSold($idagent,$idlib,$site_id);
                    //fin vérification
                    if($bool==0){
                         //GET NUMEROTATION
                    $libcptfact=NUM_PRET;
                    $num_cmd = $compteurobj->getnumerotation($site_id,$libcptfact);
                    $num_cmd_format = format_numero($num_cmd);  
                    $num=$num_cmd_format;
                    $emprunt_id = $this->resemprunt_model->Insert($idlib,$num,$mont1, $mont2, $monnaie, $taux, $dte, $dte_deduct, $duree, $idagent, $psedo, $site_id);
                    //MAJ NUMEROTATION COMPTEUR
                    $num_cmd+=1;
                    $compteurobj->Update($libcptfact, $num_cmd, $site_id);
                    $salaire_id = Null;
                    $montant = 0;
                    $resremb_obj->Insert($idagent, $salaire_id, $montant, $monnaie, $taux, $dte, $emprunt_id);
                    $json['noms'] = $nomemploye;
                    $json['numero'] =$num;
                    $json['montant'] =$mont1;
                    $json['dte'] = $dte;
                    $json['message'] = json_success2("Opération effectuée avec succes");
                    $json['s'] = true;
                    }else{
                        $json['message'] = json_error2("L'employé(e) ".$_SESSION['noms_employ']." ne peut pas emprunter car il a un reste de ".afficheMontant($_SESSION['Paie_affiche'],$_SESSION['reste'])." sur ".afficheMontant($_SESSION['Paie_affiche'],$_SESSION['montant'])." emprunté.");
                    }
                   
                }
                echo json_encode($json);
            }
        } elseif (get('do') == 'view_pr') {
            $idlib = IdLibRubriq('pret', $_SESSION['idsite']);
            $site_id = $_SESSION['idsite'];
            $result = $this->resemprunt_model->ViewPretAvan($idlib, $site_id);
            //var_dump($result);
            include(APP_FOLDER . '/views/admin/resemprunt/View_Pr.php');
        } elseif (get('do') == 'view_pr_d') {
            $idlib = IdLibRubriq('pret', $_SESSION['idsite']);
            $site_id = $_SESSION['idsite'];
            $idemply= get('employe_id');
            $result = $this->resemprunt_model->ViewPretAvan1($idemply,$idlib, $site_id);
            include(APP_FOLDER . '/views/admin/resemprunt/View_Pr_D.php');
        }
        //les Mises a jours des elements du formulaire
        elseif (get('do') == 'lstemplemprunt') {
            $result = $resempl_obj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resemprunt/Employescombo.php');
        }
         elseif (get('do') == 'lstmoisemprunt') {
            $annee = date("Y");
            $mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
            include(APP_FOLDER . '/views/admin/resemprunt/Moiscombo.php');
        }
         //DETAILS PRET//////////////////////////////////////////////
        elseif (get('do') == 'details_av') {
             $id=get('id');
            $idlib = IdLibRubriq('avance', $_SESSION['idsite']);
            $idemply= get('employe_id');
            $rows = $this->resemprunt_model->SelectOneDetails($idlib,$id);
            include(APP_FOLDER . '/views/admin/resemprunt/Details_Av.php');
        }
        //DETAILS AVANCE//////////////////////////////////////////////
        elseif (get('do') == 'details_pr') {
            $id=get('id');
            $idlib = IdLibRubriq('pret', $_SESSION['idsite']);
            $idemply= get('employe_id');
            $rows = $this->resemprunt_model->SelectOneDetails($idlib,$id);
            include(APP_FOLDER . '/views/admin/resemprunt/Details_Pr.php');
        }
    }

//end invoke
}

//end class
?>
	