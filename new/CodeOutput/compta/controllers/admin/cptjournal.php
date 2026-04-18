
<?php

/*
 * =======================================================================
 * FILE NAME:        cptjournal.php
 * DATE CREATED:  	18-04-2019
 * FOR TABLE:  		cptjournal
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/cptjournal.php');
include(APP_FOLDER . '/models/objects/cptecritures.php');
include(APP_FOLDER . '/models/objects/cptdetailsecritures.php');
include(APP_FOLDER . '/models/objects/cptexercice.php');
include_once(APP_FOLDER . '/models/objects/compteur.php');


class cptjournal_controller
{

    public $cptjournal_model;

    public function __construct()
    {
        $this->cptjournal_model = new cptjournal_model();
    }

    public function invoke_cptjournal()
    {
        $cptecritureso = new cptecritures_model();
        $cptdetailsecritureso = new cptdetailsecritures_model();
        $cptexerciceo = new cptexercice_model();
        $compteurobj = new compteur_model();

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall' || get('do') == 'filtrerjournaux') {
            //Automatisation ecritures pour hebergement
            // AUTO_ECRITURES_PROCESS_HEB();
            //Automatisation ecritures pour hebergement
            $bdd = HDB::hus();
            $result2 = ListeJournaux($_SESSION['idsite']);
            if (get('do') == 'viewall') {
                $datedebut = date('Y-m-d');
                $datefin = date('Y-m-d');
                $result = $this->cptjournal_model->SelectAll($datedebut, $datefin, $_SESSION['idsite']);
                include(APP_FOLDER . '/views/admin/cptjournal/View.php');
            } else if (get('do') == 'filtrerjournaux') {
                $typejournal = post('typejournal');
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
                if ($typejournal == 'tout') {
                    $result = $this->cptjournal_model->SelectAll($datedebut, $datefin, $_SESSION['idsite']);
                } else {
                    $result = $this->cptjournal_model->SelectAllTypJournal($datedebut, $datefin, $_SESSION['idsite'], $typejournal);
                }
                include(APP_FOLDER . '/views/admin/cptjournal/datasjournaux.php');
            }
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $journal_id = get('journal_id');
            if ($journal_id == 3) {
                include(APP_FOLDER . '/views/admin/cptjournal/Export_caisse.php');
            } else {
                include(APP_FOLDER . '/views/admin/cptjournal/Export.php');
            }
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->cptjournal_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/cptjournal/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->cptjournal_model->AutoSearch(trim($qstring), 10, 'code');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=cptjournal&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->code . '</li></a>
                </span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $exercices = $cptexerciceo->SelectAllJournal($_SESSION['idsite']);
            $result2 = ListeJournaux();
            include(APP_FOLDER . '/views/admin/cptjournal/Add.php');
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
                $totalcredit = 0;
                if (isset($_POST["compte"])) {
                    $rows = count($_POST["compte"]);
                    for ($i = 0; $i < $rows; $i++) {
                        $compte_id = $_POST["compte"][$i];
                        $debit = $_POST["debit"][$i];
                        $credit = $_POST["credit"][$i];
                        if ($compte_id == "") {
                            $bool = 1;
                        }
                        if ($debit == "") {
                            $bool = 1;
                        } else {
                            $totaldebit = $totaldebit + $debit;
                        }
                        if ($credit == "") {
                            $bool = 1;
                        } else {
                            $totalcredit = $totalcredit + $credit;
                        }
                    }
                } else {
                    $bool = 1;
                }

                //Fin Verification des operations de journal
                $dte = dateToformatBdd(post('dte'));
                $dteaff = $dte;
                $dtetime = date('Y-m-d H:i:s');
                $libelle = post('description');
                $description = post('description');
                $devise = post('devise');
                $total = 0;
                $journal_id = post('typejournal');
                $psedo = 0;
                $exercice_id = post('exercice_id');
                $user_id = $_SESSION['id_user'];
                $site_id = $_SESSION['idsite'];
                $lib_jour = post('lib_jour');
                $reference = post('reference');
                $isjanouveau = post('isjanouveau');
                if ($libelle == "" || $devise == "" || $journal_id == "" || $dte == "" || $bool == 1) {
                    $json['message'] = json_error2('Veuillez remplir les champs vides!');
                } else {

                    if ($totaldebit != $totalcredit) {
                        $json['message'] = json_error2("Le total de débits n'est pas egal au total de crédits");
                    } else {
                        //traitement journal a nouveau
                        if ($isjanouveau == 1) {
                            $janouveau = post('janouveau');
                            if ($janouveau == 'ant') {
                                $date = new DateTime($_SESSION['exercice_debut']);
                                $date->modify("-1 day");
                                $dte = $date->format("Y-m-d");
                            }
                        }
                        //traitement journal a nouveau
                        $ecriture_id = $cptecritureso->insert($dte, $dteaff, $dtetime, $libelle, $reference, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $devise);
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
                            $credit = $_POST["credit"][$i];
                            $libelle = '';
                            $numdoc = '';
                            $tauxop = $_SESSION['tauxop'];
                            $total = $total + $debit;
                            $detail_id_ecrit = $cptdetailsecritureso->Insert($compte_id, $debit, $credit, $libelle, $numdoc, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $format, $longcompte);
                            //preparation rapport journaux ja,jv,jb,jo,jn sauf jc
                            $numerocompte = $format;
                            $data = INFOSFromAccountNumber($numerocompte, $longcompte, $bdd);
                            $libcompte = $data['lib'];
                            $compte = $numerocompte . ' ' . $libcompte;
                            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
               VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
                            $requete->BindParam(':dte', $dte);
                            $requete->BindParam(':ref', $reference);
                            $requete->BindParam(':compte', $compte);
                            $requete->BindParam(':description', $libelle);
                            $requete->BindParam(':debit', $debit);
                            $requete->BindParam(':credit', $credit);
                            $requete->BindParam(':devise', $devise);
                            $requete->BindParam(':journal_id', $journal_id);
                            $requete->BindParam(':exercice_id', $exercice_id);
                            $requete->BindParam(':site_id', $site_id);
                            $requete->BindParam(':ecriture_id', $ecriture_id);
                            $requete->execute();
                            //fin preparation rapport journaux

                            $cpte_num = $format;
                            $sub_cpte_num = substr($cpte_num, 0, 2);
                            if ($sub_cpte_num == '57') {
                                // INSERTION TRESORERIE
                                if ($debit > 0) {

                                    $entree = 'entree';
                                    if ($devise == 'CDF') {
                                        $lib_monnaie = 'entreecdf';
                                        $montantFC = $debit;
                                        $montantUSD = 0;
                                    } else {
                                        $lib_monnaie = 'entreeusd';
                                        $montantUSD = $debit;
                                        $montantFC = 0;
                                    }
                                } else {
                                    $entree = 'sortie';
                                    if ($devise == 'USD') {
                                        $lib_monnaie = 'entreeusd';
                                        $montantFC = 0;
                                        $montantUSD = $credit;
                                    } else {
                                        $lib_monnaie = 'entreecdf';
                                        $montantUSD = 0;
                                        $montantFC = $credit;
                                    }
                                }
                                $libelle = $description;
                                $beneficiaire = '';
                                $date_bon = $dte;
                                $date_heure_bon = $dtetime;
                                $id_user = $user_id;

                                $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
                                $beneficiaire = $datas['lib'];
                                TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
                                // INSERTION TRESORERIE
                            }

                            //maj REFERENCE      
                            $num_jour = post('num_jour') + 1;
                            setnumerotation($_SESSION['idsite'], $lib_jour, $num_jour, $bdd);
                            //maj REFERENCE
                        }




                        $json['message'] = json_success2("Nouveau journal créé avec succes");
                        $json['s'] = true;
                    }
                }


                echo json_encode($json);
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $exercices = $cptexerciceo->SelectAll($_SESSION['idsite']);
            $id = get('id');
            $bdd = ConnectWithUtf();
            $rows = $this->cptjournal_model->SelectAllOneJournal($id);
            $result = $cptdetailsecritureso->SelectAllDetailEcritures($id, $bdd);
            $result2 = ListeJournaux($_SESSION['idsite']);
            PlanComptablePourSelect($bdd);
            include(APP_FOLDER . '/views/admin/cptjournal/Update.php');
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
                $totalcredit = 0;
                if (isset($_POST["compte"])) {
                    $rows = count($_POST["compte"]);
                    for ($i = 0; $i < $rows; $i++) {
                        $compte_id = $_POST["compte"][$i];
                        $debit = $_POST["debit"][$i];
                        $credit = $_POST["credit"][$i];
                        if ($compte_id == "") {
                            $bool = 1;
                        }
                        if ($debit == "") {
                            $bool = 1;
                        } else {
                            $totaldebit = $totaldebit + $debit;
                        }
                        if ($credit == "") {
                            $bool = 1;
                        } else {
                            $totalcredit = $totalcredit + $credit;
                        }
                    }
                } else {
                    $bool = 1;
                }

                $dte = dateToformatBdd(post('dte'));
                // echo " dte  ".$dte;
                $dtetime = date('Y-m-d H:i:s');
                // echo " dtetime  ".$dtetime;
                $libelle = post('description');
                //echo " libelle  ".$libelle;
                $description = post('description');
                //echo " description  ".$description;
                $devise = post('devise');
                //echo " devise  ".$devise;
                $total = 0;
                $journal_id = post('typejournal');
                //echo " journal_id  ".$journal_id;
                //echo " bool  ".$bool;
                $psedo = 0;
                $exercice_id = post('exercice_id');
                //echo " exercice_id  ".$exercice_id;
                $user_id = $_SESSION['id_user'];
                //echo " user_id  ".$user_id;
                $site_id = $_SESSION['idsite'];
                //echo " site_id  ".$site_id;
                $reference = post('reference');
                //echo " reference  ".$reference;
                $ecriture_id = post('ecriture_id');
                //echo " ecriture_id  ".$ecriture_id;
                if ($reference == "" || $libelle == "" || $devise == "" || $journal_id == "" || $dte == "" || $bool == 1) {
                    $json['message'] = json_error2('Veuillez remplir les champs vides!');
                } else {

                    if ($totaldebit != $totalcredit) {
                        $json['message'] = json_error2("Le total de débits n'est pas egal au total de crédits");
                    } else {
                        $cptecritureso->Update($dte, $dtetime, $libelle, $reference, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $devise, $ecriture_id);
                        $cptecritureso->DeleteDetailsEcriture($ecriture_id);
                        $cptecritureso->DeleteRapportJournaux($ecriture_id);
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
                            } elseif ($longcompte >= 4) {
                                $souscompte_id = $_POST["compte"][$i];
                                $categorie_id = $_POST["cat"][$i];
                                $compte_id = $_POST["compt"][$i];
                                $longcompte = 4;
                            }
                            $debit = $_POST["debit"][$i];
                            $credit = $_POST["credit"][$i];
                            $libelle = '';
                            $numdoc = '';
                            $tauxop = $_SESSION['tauxop'];
                            $total = $total + $debit;
                            $detail_id_ecrit = $cptdetailsecritureso->Insert($compte_id, $debit, $credit, $libelle, $numdoc, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $format, $longcompte);
                            //preparation rapport journaux ja,jv,jb,jo,jn sauf jc
                            $numerocompte = $format;
                            $data = INFOSFromAccountNumber($numerocompte, $longcompte, $bdd);
                            $libcompte = $data['lib'];
                            $compte = $numerocompte . ' ' . $libcompte;
                            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
               VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
                            $requete->BindParam(':dte', $dte);
                            $requete->BindParam(':ref', $reference);
                            $requete->BindParam(':compte', $compte);
                            $requete->BindParam(':description', $libelle);
                            $requete->BindParam(':debit', $debit);
                            $requete->BindParam(':credit', $credit);
                            $requete->BindParam(':devise', $devise);
                            $requete->BindParam(':journal_id', $journal_id);
                            $requete->BindParam(':exercice_id', $exercice_id);
                            $requete->BindParam(':site_id', $site_id);
                            $requete->BindParam(':ecriture_id', $ecriture_id);
                            $requete->execute();
                            //fin preparation rapport journaux

                            $cpte_num = $format;
                            $sub_cpte_num = substr($cpte_num, 0, 2);
                            if ($journal_id == 3 && $sub_cpte_num == '57') {
                                //INSERTION TRESORERIE
                                if ($debit > 0) {

                                    $entree = 'entree';
                                    if ($devise == 'CDF') {
                                        $lib_monnaie = 'entreecdf';
                                        $montantFC = $debit;
                                        $montantUSD = 0;
                                    } else {
                                        $lib_monnaie = 'entreeusd';
                                        $montantUSD = $debit;
                                        $montantFC = 0;
                                    }
                                } else {


                                    $entree = 'sortie';
                                    if ($devise == 'USD') {
                                        $lib_monnaie = 'entreeusd';
                                        $montantFC = 0;
                                        $montantUSD = $credit;
                                    } else {
                                        $lib_monnaie = 'entreecdf';
                                        $montantUSD = 0;
                                        $montantFC = $credit;
                                    }
                                }
                                $libelle = $description;
                                $beneficiaire = '';
                                $date_bon = $dte;
                                $date_heure_bon = $dtetime;
                                $id_user = $user_id;
                                $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
                                $beneficiaire = $datas['lib'];
                                TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
                                //INSERTION TRESORERIE
                            }
                        }
                        $json['message'] = json_success2("Mise a jours effectuee avec succes");
                        $json['s'] = true;
                    }
                }


                echo json_encode($json);
            }
        }
        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $id = get('id');
            $bdd = ConnectWithUtf();
            $rows = $this->cptjournal_model->SelectAllOneJournal($id);
            $result = $cptdetailsecritureso->SelectAllDetailEcritures($id, $bdd);
            include(APP_FOLDER . '/views/admin/cptjournal/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->cptjournal_model->TruncateTable('' . H_ADMIN . '&view=cptjournal&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/cptjournal/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            // $psedo=1;
            // $cptecritureso->Updatepsedo($psedo,get('id'));  
            $id = get('id');
            $redirect_to = '';
            $cptecritureso->Delete($id, $redirect_to);
        }
        //LETTRAGE /////////////////////////////////////////////////
        elseif (get('do') == 'lettrer') {
            $id = get('id');
            $lettrer = 1;
            $cptecritureso->lettrer($lettrer, $id);
        }
        //JOURNAL
        elseif (get('do') == 'journal') {
            $result2 = ListeJournaux($_SESSION['idsite']);
            $result3 = $cptexerciceo->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/cptjournal/journal.php');
        } elseif (get('do') == 'verifgenerejournal') {
            $json = array();
            $json['s'] = False;
            $json['message'] = '';
            $journal_id = post('journal_id');
            $exercice_id = post('exercice_id');
            $dte1 = post('dte1');
            $dte2 = post('dte2');

            $devise = post('devise');
            if ($journal_id == '') {
                $json['message'] = json_error2("Veuillez choisir le type de journal!");
            } elseif ($exercice_id == '') {
                $json['message'] = json_error2("Veuillez choisir l'exercice!");
            } elseif ($dte1 == '') {
                $json['message'] = json_error2("Veuillez saisir la 1ere date!");
            } elseif ($dte2 == '') {
                $json['message'] = json_error2("Veuillez saisir la 2ieme date!");
            } elseif ($devise == '') {
                $json['message'] = json_error2("Veuillez choisir la devise!");
            } else {
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'generejournal') {
            $journal_id = post('journal_id');
            $exercice_id = post('exercice_id');
            $d1 = dateToformatBdd(post('dte1'));
            $d2 = dateToformatBdd(post('dte2'));
            $devise = post('devise');
            $site_id = $_SESSION['idsite'];
            $bdd = ConnectWithUtf();
            $result = GenererRapportsJournaux($journal_id, $exercice_id, $d1, $d2, $site_id, $bdd);
            if ($journal_id == 1) {
                include(APP_FOLDER . '/views/admin/cptjournal/resultgenerejournalachat.php');
            } else if ($journal_id == 2) {
                include(APP_FOLDER . '/views/admin/cptjournal/resultgenerejournalvente.php');
            } else if ($journal_id == 3) {
                $result = GenererJournalCaisse($d1, $d2, $site_id, $bdd);
                include(APP_FOLDER . '/views/admin/cptjournal/resultgenerejournalcaisse.php');
            } else if ($journal_id == 4) {
                include(APP_FOLDER . '/views/admin/cptjournal/resultgenerejournalbanque.php');
            } else if ($journal_id == 5) {
                include(APP_FOLDER . '/views/admin/cptjournal/resultgenerejournaloperdiver.php');
            } else if ($journal_id == 6) {
                include(APP_FOLDER . '/views/admin/cptjournal/resultgenerejournalanouveau.php');
            }
        }
        //GRAND LIVRE
        elseif (get('do') == 'grandlivre') {
            $exercices = $cptexerciceo->SelectAll($_SESSION['idsite']);
            $bdd = ConnectWithUtf();
            PlanComptablePourSelect($bdd);
            include(APP_FOLDER . '/views/admin/cptjournal/grandlivre.php');
        } elseif (get('do') == 'verifgeneregl') {
            $json = array();
            $json['s'] = False;
            $json['message'] = '';
            $exercice_id = post('exercice_id');
            if ($exercice_id == '') {
                $json['message'] = json_error2("Veuillez choisir l'exercice!");
            } else {
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'generegl') {
            $bdd = ConnectWithUtf();
            $devise = getsymbole_devise();
            $numerocompte = post('numerocompte');
            $exercice_id = post('exercice_id');
            $d1 = dateToformatBdd(post('dte1'));
            $d2 = dateToformatBdd(post('dte2'));
            $_SESSION['datedebut'] = post('dte1');
            $_SESSION['datefin'] = post('dte2');
            $_SESSION['devise'] = $devise;
            $_SESSION['exercice_lib'] = strtoupper(post('exercice_lib'));
            $site_id = $_SESSION['idsite'];
            if ($numerocompte == 0) {
                include(APP_FOLDER . '/views/admin/cptjournal/resultgeneregl.php');
            } else {
                include(APP_FOLDER . '/views/admin/cptjournal/resultgeneregloneaccount.php');
            }
        }
        //BALANCE /////////////////////////////////////////////////
        elseif (get('do') == 'balance') {
            $exercices = $cptexerciceo->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/cptjournal/balance.php');
        } elseif (get('do') == 'verifgenerebal') {
            $json = array();
            $json['s'] = False;
            $json['message'] = '';
            $exercice_id = post('exercice_id_bal');
            $d1 = dateToformatBdd(post('dte1'));
            $d2 = dateToformatBdd(post('dte2'));
            $devise = post('devise');
            if ($exercice_id == '') {
                $json['message'] = json_error2("Veuillez choisir l'exercice!");
            } else if ($d1 == '') {
                $json['message'] = json_error2("Veuillez choisir la date du debut!");
            } else if ($d2 == '') {
                $json['message'] = json_error2("Veuillez choisir la date de la fin!");
            } else if ($devise == '') {
                $json['message'] = json_error2("Veuillez choisir la devise!");
            } else {
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'generebal') {
            $bdd = ConnectWithUtf();
            $exercice_id = post('exercice_id_bal');
            $exercice_lib = post('exercice_lib');
            $devise = post('devise');
            $dte1 = post('debut');
            $dte2 = post('fin');
            $_SESSION['devise'] = $devise;
            $site_id = $_SESSION['idsite'];
            $d1 = dateToformatBdd(post('dte1'));
            $d2 = dateToformatBdd(post('dte2'));
            $_SESSION['datedebut'] = post('dte1');
            $_SESSION['datefin'] = post('dte2');
            $result = GenererBalance($exercice_id, $d1, $d2, $site_id, $bdd);
            include(APP_FOLDER . '/views/admin/cptjournal/resultgenerebal.php');
        }
        //BILAN /////////////////////////////////////////////////
        elseif (get('do') == 'bilan') {
            $exercicesn = $cptexerciceo->SelectAll($_SESSION['idsite']);
            $exercicesn1 = $cptexerciceo->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/cptjournal/bilan.php');
        } elseif (get('do') == 'verifgenerebilan') {
            $json = array();
            $json['s'] = False;
            $json['message'] = '';
            $exercicesn = post('exercicesn');
            $exercicesn1 = post('exercicesn1');
            $type = post('devise');
            $devise = post('devise');
            if ($exercicesn == '') {
                $json['message'] = json_error2("Veuillez choisir l'exercice en cours!");
            } else if ($exercicesn1 == '') {
                $json['message'] = json_error2("Veuillez choisir l'exercice a comparer!");
            } else if ($devise == '') {
                $json['message'] = json_error2("Veuillez choisir la devise!");
            } else if ($type == '') {
                $json['message'] = json_error2("Veuillez choisir le type de bilan!");
            } else {
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'generebilan') {
            $bdd = ConnectWithUtf();
            $dte1n = post('dte1n');
            $dte2n = post('dte2n');
            $dte1n1 = post('dte1n1');
            $dte2n1 = post('dte2n1');
            $exercicesn = post('exercicesn');
            $exercicesn1 = post('exercicesn1');
            $exercicesnlib = post('exercicesnlib');
            $exercicesn1lib = post('exercicesn1lib');
            $_SESSION['exercicesnlib'] = $exercicesnlib;
            $_SESSION['exercicesn1lib'] = $exercicesn1lib;
            $type = post('typebilan');
            $devise = post('devise');
            $_SESSION['devise'] = $devise;
            $_SESSION['dte1n'] = dateAffiche($dte1n);
            $_SESSION['dte2n'] = dateAffiche($dte2n);
            $site_id = $_SESSION['idsite'];
            if ($type == 'actif') {
                $modeles = 'ba';
                $result = ModelesComptables($modeles, $bdd);
                include(APP_FOLDER . '/views/admin/cptjournal/databilanactif.php');
            } else {
                $modeles = 'bp';
                $result = ModelesComptables($modeles, $bdd);
                include(APP_FOLDER . '/views/admin/cptjournal/databilanpassif.php');
            }
        }
        //RESULTAT /////////////////////////////////////////////////
        elseif (get('do') == 'resultat') {
            $exercicesn = $cptexerciceo->SelectAll($_SESSION['idsite']);
            $exercicesn1 = $cptexerciceo->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/cptjournal/resultat.php');
        } elseif (get('do') == 'verifgenereresultat') {
            $json = array();
            $json['s'] = False;
            $json['message'] = '';
            $exercicesn = post('exercicesn');
            $exercicesn1 = post('exercicesn1');
            $devise = post('devise');
            if ($exercicesn == '') {
                $json['message'] = json_error2("Veuillez choisir l'exercice en cours!");
            } else if ($exercicesn1 == '') {
                $json['message'] = json_error2("Veuillez choisir l'exercice a comparer!");
            } else if ($devise == '') {
                $json['message'] = json_error2("Veuillez choisir la devise!");
            } else {
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        } elseif (get('do') == 'genereresultat') {
            $bdd = ConnectWithUtf();
            $dte1n = post('dte1n');
            $dte2n = post('dte2n');
            $dte1n1 = post('dte1n1');
            $dte2n1 = post('dte2n1');
            $exercicesn = post('exercicesn');
            $exercicesn1 = post('exercicesn1');
            $exercicesnlib = post('exercicesnlib');
            $exercicesn1lib = post('exercicesn1lib');
            $_SESSION['exercicesnlib'] = $exercicesnlib;
            $_SESSION['exercicesn1lib'] = $exercicesn1lib;
            $devise = post('devise');
            $_SESSION['devise'] = $devise;
            $_SESSION['dte1n'] = dateAffiche($dte1n);
            $_SESSION['dte2n'] = dateAffiche($dte2n);
            $site_id = $_SESSION['idsite'];
            $modeles = 'r';
            $result = ModelesComptables($modeles, $bdd);
            include(APP_FOLDER . '/views/admin/cptjournal/datasresultat.php');
        }



        //Type de Journal //////////////////////////////////    
        if (get('do') == 'viewalltj') {
            $result = $this->cptjournal_model->AllTypeJournaux($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/cptjournal/Viewtp.php');
        } elseif (get('do') == 'addtj') {
            include(APP_FOLDER . '/views/admin/cptjournal/addtj.php');
        } elseif (get('do') == 'addtjpro') {
            $code = post('code');
            $libelle = post('libelle');
            $psedo = post('psedo');
            $site_id = post('site_id');
            if ($code == '') {
                json_error('Le champs code ne peut pas etre vide');
            } elseif ($libelle == '') {
                json_error('Le champs libellé ne peut pas etre vide');
            } else {
                $this->cptjournal_model->Insert($code, $libelle, $psedo, $site_id);
                json_send('' . H_ADMIN . '&view=cptjournal&do=viewalltj&msg=add');
                json_success('Process Completed');
            }
        } elseif (get('do') == 'filtrercompte') {
            $idjournal = get('idjournal');
            $bdd = ConnectWithUtf();
            PlanComptablePourSelect($bdd);
            include(APP_FOLDER . '/views/admin/cptjournal/datascomptefiltres.php');
        } elseif (get('do') == 'genererationref') {
            $bdd = HDB::hus();
            $json = array();
            $journal_id = get('idjournal');
            if ($journal_id == 1) {
                $prefnum = 'JA';
            } else if ($journal_id == 2) {
                $prefnum = 'JV';
            } else if ($journal_id == 3) {
                $prefnum = 'JC';
            } else if ($journal_id == 4) {
                $prefnum = 'JB';
            } else if ($journal_id == 5) {
                $prefnum = 'JO';
            } else if ($journal_id == 6) {
                $prefnum = 'JN';
            }
            $num_jour = getnumerotation($_SESSION['idsite'], $prefnum, $bdd);
            $reference = $prefnum . str_pad($num_jour, 4, "0", STR_PAD_LEFT);
            $json['reference'] = $reference;
            $json['num_jour'] = $num_jour;
            $json['lib_jour'] = $prefnum;
            echo json_encode($json);
        } elseif (get('do') == 'excelGL') {
            $bdd = ConnectWithUtf();
            $numerocompte = get('numerocompte');
            if ($numerocompte == 0) {
                include(APP_FOLDER . '/views/admin/cptjournal/Export_gl.php');
            } else {
                include(APP_FOLDER . '/views/admin/cptjournal/Export_gl.php');
            }
        } elseif (get('do') == 'excelBAL') {
            include(APP_FOLDER . '/views/admin/cptjournal/Export_bal.php');
        } elseif (get('do') == 'excelBAC') {
            if ($_SESSION['BilanType'] == 'actif') {
                include(APP_FOLDER . '/views/admin/cptjournal/Export_bac.php');
            } else {
                include(APP_FOLDER . '/views/admin/cptjournal/Export_bap.php');
            }
        } elseif (get('do') == 'excelRES') {
            include(APP_FOLDER . '/views/admin/cptjournal/Export_res.php');
        }

        if (get('do') == 'MajJournal') {
            $ck = 0;
            $json = array();
            $json['s'] = False;
            $bdd = HDB::hus();
            $module_id = 23;
            $site_id = $_SESSION['id_hotel'];
            ConfLinkMod($module_id, $site_id, $bdd);
            if ($_SESSION['ConfLinkMod_lie'] == 1) {
                ConfigModule($module_id, $site_id);
                $ck = CheckerUpdateComptaAuto($module_id, $site_id, $bdd);
                if ($ck > 0) {
                    AUTO_ECRITURES_PROCESS_HEB($module_id, $site_id, $bdd);
                    $json['s'] = TRUE;
                }
            }
            echo json_encode($json);
        }
    }

    //end invoke
}

//end class
?>
