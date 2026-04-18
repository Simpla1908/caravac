
<?php

/*
 * =======================================================================
 * FILE NAME:        cptprevision.php
 * DATE CREATED:  	18-04-2019
 * FOR TABLE:  		cptprevision
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/cptprevision.php');
// include(APP_FOLDER . '/models/objects/cptecritures.php');
include(APP_FOLDER . '/models/objects/cptprevisiondetails.php');
include(APP_FOLDER . '/models/objects/cptexercice.php');
// include_once(APP_FOLDER . '/models/objects/compteur.php');


class cptprevision_controller
{

    public $cptprevision_model;

    public function __construct()
    {
        $this->cptprevision_model = new cptprevision_model();
    }

    public function invoke_cptprevision()
    {
        $cptexerciceo = new cptexercice_model();
        $cptprevisiondetailso = new cptprevisiondetails_model();


        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall' || get('do') == 'filtrerprevi') {
            $bdd = HDB::hus();
            DatasExerciceDefault($_SESSION['idsite'], $bdd);
            $exercice_id = $_SESSION['exercice_id'];
            $exercices = $cptexerciceo->SelectAllJournal($_SESSION['idsite']);
            if (get('do') == 'viewall') {
                $filtre = 1;
                $datedebut = date('Y-m-d');
                $datefin = date('Y-m-d');
                $result = $this->cptprevision_model->SelectAll($exercice_id, $_SESSION['idsite'], $filtre);
                include(APP_FOLDER . '/views/admin/cptprevision/View.php');
            } else if (get('do') == 'filtrerprevi') {
                $exercice_id = post('exercice_id');
                if ($exercice_id == 'tout') {
                    $filtre = 0;
                    $result = $this->cptprevision_model->SelectAll($exercice_id, $_SESSION['idsite'], $filtre);
                } else {
                    $filtre = 1;
                    $result = $this->cptprevision_model->SelectAll($exercice_id, $_SESSION['idsite'], $filtre);
                }
                include(APP_FOLDER . '/views/admin/cptprevision/datasprevi.php');
            }
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            // $result = $this->cptprevision_model->SelectAll();
            include(APP_FOLDER . '/views/admin/cptprevision/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->cptprevision_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/cptprevision/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->cptprevision_model->AutoSearch(trim($qstring), 10, 'code');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=cptprevision&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->code . '</li></a>
                </span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $bdd = ConnectWithUtf();
            PlanComptablePourSelect($bdd);
            $exercices = $cptexerciceo->SelectAllJournal($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/cptprevision/Add.php');
        }


        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                $bdd = HDB::hus();
                $json = array();
                $json['s'] = false;
                $json['message'] = '';
                //Verification des operations de journal
                $bool = 0;
                $totaldebit = 0;
                if (isset($_POST["compte"])) {
                    $rows = count($_POST["compte"]);
                    for ($i = 0; $i < $rows; $i++) {
                        $compte_id = $_POST["compte"][$i];
                        $debit = $_POST["debit"][$i];
                        if ($compte_id == "") {
                            $bool = 1;
                        }
                        if ($debit == "") {
                            $bool = 1;
                        } else {
                            $totaldebit = $totaldebit + $debit;
                        }
                    }
                } else {
                    $bool = 1;
                }

                //Fin Verification des operations de journal
                $dte = date('Y-m-d');
                $total = 0;
                $psedo = 0;
                $exercice_id = post('exercice_id');
                $libelle = post('exercice_lib');
                $devise = post('devise');
                $user_id = $_SESSION['id_user'];
                $site_id = $_SESSION['idsite'];
                // echo "exercice_id  " . $exercice_id;
                // echo "devise  " . $devise;
                // echo "bool  " . $bool;

                if ($exercice_id == "" || $devise == "" || $bool == 1) {
                    $json['message'] = json_error2('Veuillez remplir les champs vides!');
                } else {
                    //Verification si exercice existe
                    $nb = 0;
                    $bool2 = 0;
                    $requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM cptprevision WHERE exercice_id=:exercice_id");
                    $requete->BindParam(':exercice_id', $exercice_id);
                    $requete->execute();
                    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
                    foreach ($operations as $op) :
                        $nb = $op->nb_lg;
                    endforeach;
                    if ($nb > 0) $bool2 = 1;
                    //Verification si exercice existe
                    if ($bool2 == 1) {
                        $query = $bdd->prepare("DELETE FROM cptprevision WHERE exercice_id=:exercice_id");
                        $query->BindParam(':exercice_id', $exercice_id);
                        $query->execute();
                    }
                    $prev_id = $this->cptprevision_model->insert($dte, $libelle, $psedo, $exercice_id, $user_id, $site_id, $devise);
                    $total = 0;
                    $rows = count($_POST["compte"]);
                    for ($i = 0; $i < $rows; $i++) {
                        $format = (string)$_POST["num"][$i];
                        $longcompte = strlen($format);
                        if ($longcompte == 2) {
                            $categorie_id = $_POST["compte"][$i];
                            $compte_id = NULL;
                            $souscompte_id = NULL;
                        } elseif ($longcompte == 3) {
                            $compte_id = $_POST["compte"][$i];
                            $categorie_id = $_POST["cat"][$i];
                            $souscompte_id = NULL;
                        } elseif ($longcompte == 4) {
                            $souscompte_id = $_POST["compte"][$i];
                            $categorie_id = $_POST["cat"][$i];
                            $compte_id = $_POST["compt"][$i];
                        }
                        $debit = $_POST["debit"][$i];
                        $tauxop = $_SESSION['tauxop'];
                        $total = $total + $debit;
                        $cptprevisiondetail_id = $cptprevisiondetailso->Insert($compte_id, $debit, $tauxop, $devise, $prev_id, $site_id, $categorie_id, $souscompte_id, $format, $longcompte);
                    }
                    $json['message'] = json_success2("Prévision créée avec succes");
                    $json['s'] = true;
                }
                echo json_encode($json);
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $id = get('id');
            $bdd = ConnectWithUtf();
            $rows_previ = $this->cptprevision_model->SelectAllOnePrevision($id);
            $result = $cptprevisiondetailso->SelectAllDetailPrevision($id, $bdd);
            PlanComptablePourSelect($bdd);
            $exercices = $cptexerciceo->SelectAllJournal($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/cptprevision/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                $bdd = HDB::hus();
                $json = array();
                $json['s'] = false;
                $json['message'] = '';
                //Verification des operations de journal
                $bool = 0;
                $totaldebit = 0;
                if (isset($_POST["compte"])) {
                    $rows = count($_POST["compte"]);
                    for ($i = 0; $i < $rows; $i++) {
                        $compte_id = $_POST["compte"][$i];
                        $debit = $_POST["debit"][$i];
                        if ($compte_id == "") {
                            $bool = 1;
                        }
                        if ($debit == "") {
                            $bool = 1;
                        } else {
                            $totaldebit = $totaldebit + $debit;
                        }
                    }
                } else {
                    $bool = 1;
                }

                //Fin Verification des operations de journal
                $dte = date('Y-m-d');
                $total = 0;
                $psedo = 0;
                $exercice_id = post('exercice_id');
                $libelle = post('exercice_lib');
                $devise = post('devise');
                $user_id = $_SESSION['id_user'];
                $site_id = $_SESSION['idsite'];
                $prev_id = post('prev_id');
                // echo "prev_id  " . $prev_id;
                // echo " exercice_id  " . $exercice_id;
                // echo " devise  " . $devise;
                // echo " bool  " . $bool;
                if ($exercice_id == "" || $devise == "" || $bool == 1) {
                    $json['message'] = json_error2('Veuillez remplir les champs vides!');
                } else {
                    //UPDATE INFOS PREVISION
                    $this->cptprevision_model->Update($libelle, $exercice_id, $user_id, $devise, $prev_id);
                    $query = $bdd->prepare("DELETE FROM cptprevisiondetails WHERE prev_id=:prev_id");
                    $query->BindParam(':prev_id', $prev_id);
                    $query->execute();
                    //UPDATE INFOS PREVISION
                    $total = 0;
                    $rows = count($_POST["compte"]);
                    for ($i = 0; $i < $rows; $i++) {
                        $format = (string)$_POST["num"][$i];
                        $longcompte = strlen($format);
                        if ($longcompte == 2) {
                            $categorie_id = $_POST["compte"][$i];
                            $compte_id = NULL;
                            $souscompte_id = NULL;
                        } elseif ($longcompte == 3) {
                            $compte_id = $_POST["compte"][$i];
                            $categorie_id = $_POST["cat"][$i];
                            $souscompte_id = NULL;
                        } elseif ($longcompte == 4) {
                            $souscompte_id = $_POST["compte"][$i];
                            $categorie_id = $_POST["cat"][$i];
                            $compte_id = $_POST["compt"][$i];
                        }
                        $debit = $_POST["debit"][$i];
                        $tauxop = $_SESSION['tauxop'];
                        $total = $total + $debit;
                        // echo '$rows ' . $rows;
                        // echo '$format ' . $format;
                        // echo '$longcompte ' . $longcompte;
                        // echo '$categorie_id ' . $categorie_id;
                        // echo '$souscompte_id ' . $souscompte_id;
                        // echo '$compte_id ' . $compte_id;

                        $cptprevisiondetail_id = $cptprevisiondetailso->Insert($compte_id, $debit, $tauxop, $devise, $prev_id, $site_id, $categorie_id, $souscompte_id, $format, $longcompte);
                    }
                    $json['message'] = json_success2("Prévision modifiée avec succes");
                    $json['s'] = true;
                }
                echo json_encode($json);
            }
        }
        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $id = get('id');
            $bdd = ConnectWithUtf();
            $rows = $this->cptprevision_model->SelectAllOnePrevision($id);
            $result = $cptprevisiondetailso->SelectAllDetailPrevision($id, $bdd);
            include(APP_FOLDER . '/views/admin/cptprevision/Details.php');
        }
        //FORMAT CHIFFRE //////////////////////////////////////////////
        elseif (get('do') == 'formatchiffre') {
            $json = array();
            $mont = get('mont');
            $montaff = number_format($mont, 2, ',', ' ');
            $json['mont'] = $mont;
            $json['montaff'] = $montaff;
            echo json_encode($json);
        }


        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->cptprevision_model->TruncateTable('' . H_ADMIN . '&view=cptprevision&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/cptprevision/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            // $psedo=1;
            // $cptecritureso->Updatepsedo($psedo,get('id'));  
            $id = get('id');
            $redirect_to = '';
            $this->cptprevision_model->Delete($id, $redirect_to);
        }
        //REALISATION
        elseif (get('do') == 'realisation') {
            $result3 = $cptexerciceo->SelectPrevions($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/cptprevision/realisation.php');
        } elseif (get('do') == 'verifrealisation') {
            $json = array();
            $json['s'] = False;
            $json['message'] = '';
            $prev_id = post('prev_id');
            $devise = post('devise');
            if ($prev_id == '') {
                $json['message'] = json_error2("Veuillez choisir l'exercice!");
            } elseif ($devise == '') {
                $json['message'] = json_error2("Veuillez choisir la devise!");
            } else {
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'genererealisation') {
            $bdd = ConnectWithUtf();
            $site_id = $_SESSION['idsite'];
            $exercice_id = post('exercice_id');
            $prev_id = post('prev_id');
            $devise = post('devise');
            $rows = $this->cptprevision_model->SelectAllOnePrevision($prev_id);
            $result = $cptprevisiondetailso->SelectAllDetailPrevision($prev_id, $bdd);
            include(APP_FOLDER . '/views/admin/cptprevision/resultgenerereal.php');
        }
    }

    //end invoke
}

//end class
?>
