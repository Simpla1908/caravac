
<?php

/*
 * =======================================================================
 * FILE NAME:        ressalaire.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		ressalaire
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
include(APP_FOLDER . '/models/objects/ressalaire.php');
include_once(APP_FOLDER . '/models/objects/resemployes.php');
include_once(APP_FOLDER . '/models/objects/resrubrique.php');
include_once(APP_FOLDER . '/models/objects/resrubriquesal.php');
include_once(APP_FOLDER . '/models/objects/resremboursement.php');

class ressalaire_controller {

    public $ressalaire_model;

    public function __construct() {
        $this->ressalaire_model = new ressalaire_model();
    }

    public function invoke_ressalaire() {
        $employeobj = new resemployes_model();
        $rubriqueobj = new resrubrique_model();
        $rubriquesalobj = new resrubriquesal_model();
        $remboursementobj = new resremboursement_model();
        
        $elmtjrs['jrpt'] = 0;
        $elmtjrs['jpreavis'] = 0;
        $elmtjrs['jcongpreavis'] = 0;
        $elmtjrs['jcongcomp'] = 0;
        $elmtjrs['jcongnonpris'] = 0;
        $elmtjrs['arsal'] = 0;
        $elmtjrs['idemsrt'] = 0;
        $_SESSION['resiliation'] = array();
        $_SESSION['resiliation']['type'] = array('jour', 'remuneration', 'retenue', 'autre');
        $_SESSION['resiliation']['libelle'] = array('Nombre de jours', 'Rémuneration', 'Retenue', 'Autres');
        $_SESSION['resiliation']['lib_type'] = array('Total jours', 'Total brut', 'Total retenue ', 'Total autre');
        $_SESSION['jour']['id'] = array('0', '0', '0', '0', '0');
        $_SESSION['jour']['code'] = array('jrpt', 'jpreavis', 'jcongpreavis', 'jcongcomp', 'jcongnonpris');
        $_SESSION['jour']['nom'] = array('De jours prestés', 'De préavis', 'De congé sur préavis', 'De congé compensatoire', ' De congé non pris');
        $_SESSION['jour']['montant'] = array();
        $_SESSION['jour']['total'] = 0;

        $_SESSION['autre']['id'] = array('00', '00'); //Besoin technique
        $_SESSION['autre']['code'] = array('arsal', 'idemsrt');
        $_SESSION['autre']['nom'] = array('Arrierés de salaire', 'Indemnité de sortie');
        $_SESSION['autre']['montant'] = array();
        $_SESSION['autre']['total'] = 0;

        $_SESSION['rubrique'] = array();
        $_SESSION['rubrique']['type'] = array('remuneration', 'retenue');
        $_SESSION['remuneration']['id'] = array();
        $_SESSION['remuneration']['nom'] = array();
        $_SESSION['remuneration']['montant'] = array();
        $_SESSION['remuneration']['total'] = 0;
        $_SESSION['remuneration']['compteur'] = 0;
        $_SESSION['remuneration']['totbase'] = array();

        $_SESSION['retenue']['id'] = array();
        $_SESSION['retenue']['nom'] = array();
        $_SESSION['retenue']['montant'] = array();
        $_SESSION['retenue']['total'] = 0;
        $_SESSION['retenue']['compteur'] = 0;
        $json = array();
        $json['s'] = False;
        $json['message'] = 'okkkk';
        $json['dteng'] = '';
        $json['employe_id'] = 0;
        $json['presence'] = 0;
        $json['conge'] = 0;
        $json['hrsuppl'] = 0;
        $json['totsb'] = 0;
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $result = $employeobj->GetNbrBulletin($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/ressalaire/nbreblt.php');
        }
        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->ressalaire_model->SelectAll();
            include(APP_FOLDER . '/views/admin/ressalaire/Export.php');
        }
        //TOUS LES BULLETINS D'UN EMPPLOYE
        elseif (get('do') == 'viewall2') {
            $nomemploye = '';
            $employe_id = get('id');
            $result = $employeobj->GetAllBltById($employe_id);
            foreach ($result as $r) {
                $nomemploye = $r->noms;
            }
            include(APP_FOLDER . '/views/admin/ressalaire/View2.php');
        }
        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $employes = $employeobj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/ressalaire/Add.php');
        } elseif (get('do') == 'lstemplpaie') {
            $employes = $employeobj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/ressalaire/Employescombo.php');
        } elseif (get('do') == 'lstmotif') {
            //Liste des motifs de resiliation
            include(APP_FOLDER . '/views/admin/ressalaire/lstmotifdecompte.php');
        } elseif (get('do') == 'lstrubdcpte') {
            //Liste des rubriques de resiliation
            include(APP_FOLDER . '/views/admin/resrubrique/resiliation.php');
        }elseif (get('do') == 'employe'){
            $periodes = PeriodePaie(get('dteng'));
            $periodepayees = $employeobj->GetPeriodePayees(get('employe_id'));
            include(APP_FOLDER . '/views/admin/ressalaire/Periode.php');
        }elseif(get('do')=='employe2'){
            $periodes =PeriodePaie3();
            $periodepayees = $employeobj->GetPeriodePoint(get('employe_id'));
            include(APP_FOLDER . '/views/admin/ressalaire/Periode.php');
        }
        elseif (get('do')=='periode') {
            $employe_id = get('employe_id');
            $num_mois = get('numero');
            $annee = get('annee');
            $prestation = $employeobj->GetJourPreste($employe_id, $num_mois, $annee);
            $salbase = post('salbase');
            $montantjr = post('montantjr');
            $totsb = 0;
            if ($prestation['presence'] > 0) {
                $json['presence'] = $prestation['presence'];
                $totsb = $montantjr * $prestation['presence'];
                $json['transport'] = $prestation['jrtransport'];
                $json['totsb'] = arrondir($totsb);
            }
            if ($prestation['conge'] > 0) {
                $json['conge'] = $prestation['conge'];
            }
            if ($prestation['hrsuppl'] > 0) {
                $json['hrsuppl'] = $prestation['hrsuppl'];
            }
            $_SESSION['totsb'] = $totsb;
            echo json_encode($json);
        } elseif (get('do') == 'emprubrique') {
            $devise = get('devise');
            $_SESSION['monnaie_cat'] = $devise;
            $valeur = 0;
            $taux = 0;
            $nbjrconge = post('nbjrconge');
            $salbase = post('salbase');
            $montantjr = montant_equivalent_bdd($devise, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], post('montantjr'));
            $nbrenf = post('nbrenf');
            $nbjrpreste = post('nbjrpreste');
            $nbjrpreste=$nbjrconge+$nbjrpreste;
            $nbjrtransport = post('nbjrtransport');
            $totbase = GetMontBase($nbjrpreste, $montantjr);
            $hrsup = post('hrsup');
            $employe_id = post('employe_id');
            $periode = post('periode');
            $emprunts = $employeobj->GetEmprunt($employe_id, $periode);
            $categorie_id = get('idcat');
            $rubriques = $employeobj->GetRubriqueByCat($categorie_id);
            foreach ($rubriques as $rows) {
                $montant = CalculMontantRubrique($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup);
                if ($rows->type == 'remuneration' || $rows->type == 'prime') {
                    array_push($_SESSION['remuneration']['id'], $rows->rubrique_id);
                    array_push($_SESSION['remuneration']['nom'], $rows->libelle);
                    array_push($_SESSION['remuneration']['montant'], $montant);
                    $_SESSION['remuneration']['compteur'] = $_SESSION['remuneration']['compteur'] + 1;
                    $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + $montant;
                } elseif ($rows->type == 'retenue') {
                    array_push($_SESSION['retenue']['id'], $rows->rubrique_id);
                    array_push($_SESSION['retenue']['nom'], $rows->libelle);
                    array_push($_SESSION['retenue']['montant'], $montant);
                    $_SESSION['retenue']['compteur'] = $_SESSION['retenue']['compteur'] + 1;
                    $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + $montant;
                }
            }
            include(APP_FOLDER . '/views/admin/resrubrique/emprubrique.php');
        } elseif (get('do') == 'recalculer') {
            $rub_id_url = get('id');
            $coche = get('coche');
            $rubcoches = array();
            $temp['rub_mont'] = array();
            $temp['rub_mont']['id'] = array();
            $temp2['rub_coche'] = array();
            $temp2['rub_coche']['id'] = array();
            $temp3['emprunt'] = array();
            $temp3['emprunt']['id'] = array();
            $remboursement = array();
            $remboursement['rubrique'] = array();
            if (!empty($_POST['rub_ids'])) {
                $remboursement['rubrique'] = post('rub_ids');
            }
            $valeur = 0;
            $taux = 0;
            $salbase = post('salbase');
            $montantjr = post('montantjr');
            $nbrenf = post('nbrenf');
            $nbjrpreste = post('nbjrpreste');
            $totbase = $montantjr * $nbjrpreste;
            $hrsup = post('hrsup');
            $employe_id = post('employe_id');
            $periode = post('periode');
            $emprunts = $employeobj->GetEmprunt($employe_id, $periode);
            $categorie_id = post('idcat');
            $rubriques = $employeobj->GetRubriqueByCat($categorie_id);
            $totbase = post('totsb');
            $montants = post('montprime');
            $rub_ids_all = post('rub_ids_all');
            $montremb = post('montremb');
            $rubrique_ids = post('idsrubriques');
            $nbrex = count($rubrique_ids);
            for ($p = 0; $p <= $nbrex - 1; $p++) {
                $temp['rub_mont']['id'][$rubrique_ids[$p]] = $montants[$p];
            }
            $nbrex = count($rub_ids_all);
            for ($p = 0; $p <= $nbrex - 1; $p++) {
                $temp3['emprunt']['id'][$rub_ids_all[$p]] = $montremb[$p];
            }
            if (!empty($_POST['rubrique_ids'])) {
                $rubcoches = post('rubrique_ids');
            }
            foreach ($rubriques as $rows) {
                $id = $rows->rubrique_id;
                $montant = $temp['rub_mont']['id'][$rows->rubrique_id];
                if ($rows->type == 'remuneration' || $rows->type == 'prime') {
                    array_push($_SESSION['remuneration']['id'], $rows->rubrique_id);
                    array_push($_SESSION['remuneration']['nom'], $rows->libelle);
                    array_push($_SESSION['remuneration']['montant'], $montant);
                    $_SESSION['remuneration']['compteur'] = $_SESSION['remuneration']['compteur'] + 1;
                    //if($rows->rubrique_id==$rub_id_url && $coche==0){
                    if (!in_array($id, $rubcoches)) {
                        $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + 0;
                    } else {
                        $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + $montant;
                    }
                } elseif ($rows->type == 'retenue') {
                    array_push($_SESSION['retenue']['id'], $rows->rubrique_id);
                    array_push($_SESSION['retenue']['nom'], $rows->libelle);
                    array_push($_SESSION['retenue']['montant'], $montant);
                    $_SESSION['retenue']['compteur'] = $_SESSION['retenue']['compteur'] + 1;
                    //if($rows->rubrique_id==$rub_id_url && $coche==0){
                    if (!in_array($id, $rubcoches)) {
                        $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + 0;
                    } else {
                        $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + $montant;
                    }
                }
            }
            include(APP_FOLDER . '/views/admin/resrubrique/emprubrique2.php');
        } elseif (get('do') == 'add2') {
            $rubriques = $rubriqueobj->SelectAll($_SESSION['idsite']);
            $employes = $employeobj->SelectAll($_SESSION['idsite']);
            
            include(APP_FOLDER . '/views/admin/ressalaire/Add2.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {

            if ($_POST) {
                //form validation
                if (post('employe_id') == '') {
                    //json_error('Veuillez sélectionner un employé!');
                    $json['message'] = json_error2('Veuillez sélectionner un employé');
                } elseif (post('periode') == '') {
                    //json_error('Veuillez sélectionner une période!');
                    $json['message'] = json_error2('Veuillez sélectionner une période');
                } else {
                    $remboursement = array();
                    $remboursement['rubrique'] = array();
                    $remboursement['emprunt_ids'] = array();
                    $remboursement['montremb'] = array();
                    $rubrique_ids = array();
                    if (!empty($_POST['rubrique_ids'])) {
                        $rubrique_ids = $_POST['rubrique_ids'];
                    }

                    if (!empty($_POST['rub_ids'])) {
                        $remboursement['rubrique'] = $_POST['rub_ids'];
                        $remboursement['emprunt_ids'] = $_POST['emprunt_ids'];
                        $remboursement['montremb'] = $_POST['montremb'];
                    }
                    $employe_id = post('employe_id');
                    $json['dteng'] = post('dteng');
                    $json['employe_id'] = $employe_id;
                    $salaire_id = $this->ressalaire_model->Insert(post('libelle'), post('periode'), post('nbjrpreste'), post('nbjrconge'), post('netapayer'), post('totsb'), $_SESSION['Paie_taux'], post('dte'), post('employe_id'), post('psedo'), post('site_id'), $rubrique_ids, post('montprime'), $remboursement);
                    $json['salaire_id'] = $salaire_id;
                    $json['s'] = TRUE;
//                     json_send('' . H_ADMIN . '&view=ressalaire&do=add2');
//                    json_send('' . H_ADMIN . '&view=ressalaire&do=viewall&msg=paie');
//                    json_success('Process Completed');
                }
                echo json_encode($json);
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->ressalaire_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/ressalaire/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('libelle') == '') {
                    json_error('The field libelle cannot be empty!');
                } elseif (post('nbjrpreste') == '') {
                    json_error('The field nbjrpreste cannot be empty!');
                } elseif (post('nbjrconge') == '') {
                    json_error('The field nbjrconge cannot be empty!');
                } elseif (post('type') == '') {
                    json_error('The field type cannot be empty!');
                } elseif (post('montant') == '') {
                    json_error('The field montant cannot be empty!');
                } elseif (post('dte') == '') {
                    json_error('The field dte cannot be empty!');
                } elseif (post('employe_id') == '') {
                    json_error('The field employe id cannot be empty!');
                } elseif (post('psedo') == '') {
                    json_error('The field psedo cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } else {
                    $this->ressalaire_model->Update(post('libelle'), post('nbjrpreste'), post('nbjrconge'), post('type'), post('montant'), post('dte'), post('employe_id'), post('psedo'), post('site_id'), post('id'));
                    json_send('' . H_ADMIN . '&view=ressalaire&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $retenues = array('retenue', 'pret', 'avance');
            $remunerations = array('remuneration', 'prime');
            $employe_id = get('employe_id');
            $idempl = $employe_id;
            $id = get('id');
            $rubriques = $this->ressalaire_model->GetRubriques($id);
            //$employe=$employeobj->SelectOne($employe_id);
            $totbase = $_SESSION['employe']['totbase'][$id];
            foreach ($rubriques as $rows) {
                $montant = $rows->valeur;
                if (in_array($rows->type, $remunerations)) {
                    array_push($_SESSION['remuneration']['id'], $rows->rubrique_id);
                    array_push($_SESSION['remuneration']['nom'], $rows->libelle);
                    array_push($_SESSION['remuneration']['montant'], $montant);
                    $_SESSION['remuneration']['compteur'] = $_SESSION['remuneration']['compteur'] + 1;
                    $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + $montant;
                } elseif (in_array($rows->type, $retenues)) {
                    array_push($_SESSION['retenue']['id'], $rows->rubrique_id);
                    array_push($_SESSION['retenue']['nom'], $rows->libelle);
                    array_push($_SESSION['retenue']['montant'], $montant);
                    $_SESSION['retenue']['compteur'] = $_SESSION['retenue']['compteur'] + 1;
                    $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + $montant;
                }
            }
            $rows = $this->ressalaire_model->SelectOne($id);
            include(APP_FOLDER . '/views/admin/ressalaire/Details.php');
        } elseif (get('do')=='details3') {
            $salaire_id = get('id');
            $retenues = array('retenue', 'pret', 'avance');
            $remunerations = array('remuneration', 'prime');
            $_SESSION['resiliation'] = array();
            $_SESSION['resiliation']['type'] = array('jour', 'remuneration', 'retenue', 'autre');
            $_SESSION['resiliation']['libelle'] = array('Nombre de jours', 'Remuneration', 'Retenue', 'Autres');
            $_SESSION['resiliation']['lib_type'] = array('Total jours', 'Total brut', 'Total retenue ', 'Total autre');
            $_SESSION['jour']['id'] = array('0', '0', '0', '0', '0');
            $_SESSION['jour']['code'] = array('jrpt', 'jpreavis', 'jcongpreavis', 'jcongcomp', 'jcongnonpris');
            $_SESSION['jour']['nom'] = array('De jours prestés', 'De préavis', 'De congé sur préavis', 'De congé compensatoire', 'De congé non pris');
            $_SESSION['jour']['montant'] = array();
            $_SESSION['jour']['total'] = 0;

            $_SESSION['rubrique'] = array();
            $_SESSION['rubrique']['type'] = array('remuneration', 'retenue');
            $_SESSION['remuneration']['id'] = array();
            $_SESSION['remuneration']['nom'] = array();
            $_SESSION['remuneration']['montant'] = array();
            $_SESSION['remuneration']['total'] = 0;
            $_SESSION['remuneration']['compteur'] = 0;
            $_SESSION['remuneration']['totbase'] = array();

            $_SESSION['retenue']['id'] = array();
            $_SESSION['retenue']['nom'] = array();
            $_SESSION['retenue']['montant'] = array();
            $_SESSION['retenue']['total'] = 0;
            $_SESSION['retenue']['compteur'] = 0;

            $rows = $this->ressalaire_model->SelectOne($salaire_id);
            $rubriques = $this->ressalaire_model->GetRubriques($salaire_id);
            $taux = $rows->taux;
            $mois = $rows->libelle;
            $dtepaie = $rows->dte;
            $empploye = $rows->noms;
            $matricule = $rows->matricule;
            $fonction = $rows->fonction;
            $email= $rows->email;
            $tel1= $rows->tel1;
            $Adresse= $rows->Adresse;
            $dteng=$rows->dteng;
            $dtefin=$rows->dte2;
            $anciennete=$rows->ancienete ;
            $motif=$rows->motif ;
            $totbase = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->totbase);
            $netapayer = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->montant);
            //Besoin technique totbase
            array_push($_SESSION['remuneration']['id'], '00');
            array_push($_SESSION['remuneration']['nom'], 'Base');
            array_push($_SESSION['remuneration']['montant'], $totbase);

            $_SESSION['jour']['id'] = array('00', '00', '00', '00', '00'); //Besoin technique
            $_SESSION['jour']['code'] = array('nbjrpreste', 'jrpreavis', 'cong6preavis', 'congcomp', 'connonpris');
            $_SESSION['jour']['montant'][0] = $rows->nbjrpreste;
            $_SESSION['jour']['montant'][1] = $rows->jrpreavis;
            $_SESSION['jour']['montant'][2] = $rows->cong6preavis;
            $_SESSION['jour']['montant'][3] = $rows->congcomp;
            $_SESSION['jour']['montant'][4] = $rows->connonpris;
            $_SESSION['jour']['total'] = $_SESSION['jour']['montant'][0] + $_SESSION['jour']['montant'][1] + $_SESSION['jour']['montant'][2] + $_SESSION['jour']['montant'][3] + $_SESSION['jour']['montant'][4];
            $totjour = $_SESSION['jour']['total'];

            $_SESSION['autre']['id'] = array('00', '00'); //Besoin technique
            $_SESSION['autre']['code'] = array('arsal', 'idemsrt');
            $_SESSION['autre']['nom'] = array('Arrierés de salaire', 'Indemnité de sortie');
            $_SESSION['autre']['montant'] = array();
            $_SESSION['autre']['total'] = 0;
            $arsal = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->arsal);
            $indemnite = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->indemnite);
            array_push($_SESSION['autre']['montant'], $arsal);
            array_push($_SESSION['autre']['montant'], $indemnite);
            $_SESSION['autre']['total'] = $indemnite + $arsal;
            foreach ($rubriques as $rows) {
                $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->valeur);
                if (in_array($rows->type, $remunerations)) {
                    array_push($_SESSION['remuneration']['id'], $rows->rubrique_id);
                    array_push($_SESSION['remuneration']['nom'], $rows->libelle);
                    array_push($_SESSION['remuneration']['montant'], $montant);
                    $_SESSION['remuneration']['compteur'] = $_SESSION['remuneration']['compteur'] + 1;
                    $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + $montant;
                } elseif (in_array($rows->type, $retenues)) {
                    array_push($_SESSION['retenue']['id'], $rows->rubrique_id);
                    array_push($_SESSION['retenue']['nom'], $rows->libelle);
                    array_push($_SESSION['retenue']['montant'], $montant);
                    $_SESSION['retenue']['compteur'] = $_SESSION['retenue']['compteur'] + 1;
                    $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + $montant;
                }
            }
        include(APP_FOLDER . '/views/admin/ressalaire/Details3.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->ressalaire_model->TruncateTable('' . H_ADMIN . '&view=ressalaire&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/ressalaire/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->ressalaire_model->Delete(get('id'), '' . H_ADMIN . '&view=ressalaire&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->ressalaire_model->Delete(get('id'), '' . H_ADMIN . '&view=ressalaire&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=ressalaire&id=' . get('id') . '&do=update&msg=delete');
            }
        } elseif (get('do') == 'decompte') {
            $employes = $employeobj->SelectAll($_SESSION['idsite']);
            //$rubriques = $rubriqueobj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/ressalaire/decompte.php');
        } elseif (get('do') == 'motifdecompte') {
            if (post('employe_id') == '') {
                //  $json['message'] = json_error2("Veuillez d'abord sélectionner un employé"); 
            } elseif (post('decomptemotif') == '') {
                //$json['message'] = json_error2("Veuillez sélectionner un motif");   
            } else {
                $employe_id = post('employe_id');
                $categorie_id = post('idcat');
                $preavis = post('preavis');
                $devise = post('devise');
                $decomptemotif = post('decomptemotif');
                $_SESSION['monnaie_cat'] = $devise;
                $valeur = 0;
                $taux = 0;
                $salbase = post('salbase');
                $montantjr = montant_equivalent_bdd($devise, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], post('montantjr'));
                $dteng = post('dteng');
                list($an_eng, $m_eng, $j_eng) = explode("-", $dteng);
                $dtfin = dateToformatBdd(post('dtfin'));
                list($annee, $num_mois, $j) = explode("-", $dtfin);
                $prestation = $employeobj->GetJourPreste($employe_id, $num_mois, $annee);
                $elmtjrs['jrpt'] = $prestation['presence'];
                $nbrenf = post('nbrenf');
                $nbjrpreste = $elmtjrs['jrpt'];
                $nbjrtransport = $prestation['jrtransport'];
                $hrsup = $prestation['hrsuppl'];
                $totbase = montant_equivalent_bdd($devise, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $salbase);
                $_SESSION['totbasedcpt'] = $totbase;
                $totbase_save = $totbase;

                //Elements jour
                $anciennete = GetAncienneteEmploye($dteng);
                $annee = $anciennete['annee'];
                $nbrmois = $anciennete['mois'];
                $_SESSION['jour']['montant'][0] = $nbjrpreste;
                $jr_preavis = jrpreavis($preavis, $annee);
                if ($decomptemotif == '2') {
                    $_SESSION['jour']['montant'][1] = $jr_preavis / 2;
                } elseif ($decomptemotif == '3' || $decomptemotif == '6') {
                    $_SESSION['jour']['montant'][1] = 0;
                } else {
                    $_SESSION['jour']['montant'][1] = $jr_preavis;
                }
                $_SESSION['jour']['id'] = array('00', '00', '00', '00', '00'); //Besoin technique
                $_SESSION['jour']['code'] = array('nbjrpreste', 'jrpreavis', 'cong6preavis', 'congcomp', 'connonpris');
                $_SESSION['jour']['montant'][2] = jrcongsurpreavis($preavis, $annee);
                $_SESSION['jour']['montant'][3] = congeComp($preavis, $nbrmois);
                $_SESSION['jour']['montant'][4] = $employeobj->CongeNonPris($employe_id, $annee, $preavis);
                $_SESSION['jour']['total'] = $_SESSION['jour']['montant'][0] + $_SESSION['jour']['montant'][1] + $_SESSION['jour']['montant'][2] + $_SESSION['jour']['montant'][3] + $_SESSION['jour']['montant'][4];
                $totjour = $_SESSION['jour']['total'];
                //Elements remuneration & retenue
                $rubriques = $employeobj->GetRubriqueByCat($categorie_id);
                $elmtjrs['idemsrt']+=arrondir($totbase);
                $totbase = arrondir(MontantDecompte($totbase, $totjour));
                //Besoin technique totbase
                array_push($_SESSION['remuneration']['id'], '00');
                array_push($_SESSION['remuneration']['nom'], 'Base');
                array_push($_SESSION['remuneration']['montant'], $totbase);
                $_SESSION['remuneration']['compteur'] = $_SESSION['remuneration']['compteur'] + 1;
                $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + $totbase;
                //fin Besoin technique totbase
                foreach ($rubriques as $rows) {
                    $montant1 = CalculMontantRubrique($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup);
                    $montant = arrondir(MontantDecompte($montant1, $totjour));
                    if ($rows->type == 'remuneration' || $rows->type == 'prime') {
                        array_push($_SESSION['remuneration']['id'], $rows->rubrique_id);
                        array_push($_SESSION['remuneration']['nom'], $rows->libelle);
                        array_push($_SESSION['remuneration']['montant'], $montant);
                        $_SESSION['remuneration']['compteur'] = $_SESSION['remuneration']['compteur'] + 1;
                        $_SESSION['remuneration']['total'] = $_SESSION['remuneration']['total'] + $montant;
                        $elmtjrs['idemsrt']+=arrondir($montant1);
                    } elseif ($rows->type == 'retenue') {
                        array_push($_SESSION['retenue']['id'], $rows->rubrique_id);
                        array_push($_SESSION['retenue']['nom'], $rows->libelle);
                        array_push($_SESSION['retenue']['montant'], $montant);
                        $_SESSION['retenue']['compteur'] = $_SESSION['retenue']['compteur'] + 1;
                        $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + $montant;
                        $elmtjrs['idemsrt']-=arrondir($montant1);
                    }
                }

                //Emprunt
                $arrieres = MontantRembourse3($employe_id);
                $_SESSION['arrieres_sal'] = $arrieres;
                $nbrex = count($arrieres['id_rub']);
                for ($p = 0; $p <= $nbrex - 1; $p++) {
                    $rubrique_id = $arrieres['id_rub'][$p];
                    $libelle = $arrieres['lib_rub'][$rubrique_id];
                    $montant = $arrieres['montant_rub'][$rubrique_id] - $arrieres['mont_paye_rub'][$rubrique_id];
                    if ($montant > 0) {
                        array_push($_SESSION['retenue']['id'], $rubrique_id);
                        array_push($_SESSION['retenue']['nom'], $libelle);
                        array_push($_SESSION['retenue']['montant'], $montant);
                        $_SESSION['retenue']['compteur'] = $_SESSION['retenue']['compteur'] + 1;
                        $_SESSION['retenue']['total'] = $_SESSION['retenue']['total'] + $montant;
                    }
                }
                //Arrieres salaires
                $totretenue = 0;
                $periodepayees = $employeobj->GetPeriodePayees($employe_id);
                $m2 = array('', 'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
                $annee1 = date('Y');
                $annee2 = $an_eng;
                $totgain = 0;
                $pk = 0;
                for ($a = $annee1; $a >= $annee2; $a--) {
                    for ($i = 1; $i <= 12; $i++) {
                        $libmois2 = $m2[$i] . $a;
                        if (!in_array($libmois2, $periodepayees['mois2'])) {

                            if (($i <= date('m') && $i > $m_eng) && $a == $annee2) {
                                $prestation = $employeobj->GetJourPreste($employe_id, $i, $a);
                                $elmtjrs['jrpt'] = $prestation['presence'];
                                $nbrenf = post('nbrenf');
                                $nbjrpreste = $elmtjrs['jrpt'];
                                $nbjrtransport = $prestation['jrtransport'];
                                $hrsup = $prestation['hrsuppl'];
                                foreach ($rubriques as $rows) {
                                    $montant = CalculMontantRubrique($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup);
                                    if ($rows->type == 'remuneration' || $rows->type == 'prime') {
                                        $totgain+=$montant;
                                    } elseif ($rows->type == 'retenue') {
                                        $totretenue+=$montant;
                                    }
                                }
                                $pk++;
                            } elseif ($a <= $annee2 && $a != $annee1) {
                                $prestation = $employeobj->GetJourPreste($employe_id, $i, $a);
                                $elmtjrs['jrpt'] = $prestation['presence'];
                                $nbrenf = post('nbrenf');
                                $nbjrpreste = $elmtjrs['jrpt'];
                                $nbjrtransport = $prestation['jrtransport'];
                                $hrsup = $prestation['hrsuppl'];
                                foreach ($rubriques as $rows) {
                                    $montant = CalculMontantRubrique($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup);
                                    if ($rows->type == 'remuneration' || $rows->type == 'prime') {
                                        $totgain+=$montant;
                                    } elseif ($rows->type == 'retenue') {
                                        $totretenue+=$montant;
                                    }
                                }
                                $pk++;
                            } elseif (($a == $annee1 && $annee1 != $annee2) && ($i <= date('m'))) {
                                $prestation = $employeobj->GetJourPreste($employe_id, $i, $a);
                                $elmtjrs['jrpt'] = $prestation['presence'];
                                $nbrenf = post('nbrenf');
                                $nbjrpreste = $elmtjrs['jrpt'];
                                $nbjrtransport = $prestation['jrtransport'];
                                $hrsup = $prestation['hrsuppl'];
                                foreach ($rubriques as $rows) {
                                    $montant = CalculMontantRubrique($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup);
                                    if ($rows->type == 'remuneration' || $rows->type == 'prime') {
                                        $totgain+=$montant;
                                    } elseif ($rows->type == 'retenue') {
                                        $totretenue+=$montant;
                                    }
                                }
                                $pk++;
                            }
                        }
                    }
                }
                $totarriere_sal = ($totgain + $totbase_save * $pk) - $totretenue;
                //Elements autre
                $nbrex = count($_SESSION['autre']['id']);
                for ($p = 0; $p <= $nbrex - 1; $p++) {
                    if ($_SESSION['autre']['code'][$p] == 'arsal') {
                        $montant = $totarriere_sal;
                        $_SESSION['totarriere_sal'] = $montant;
                    } else {
                        $montant = $elmtjrs[$_SESSION['autre']['code'][$p]];
                        $_SESSION['indemnite'] = $montant;
                    }
                    array_push($_SESSION['autre']['montant'], $montant);
                    $_SESSION['autre']['total']+=$montant;
                }
                include(APP_FOLDER . '/views/admin/resrubrique/resiliation.php');
            }
        } elseif (get('do') == 'addecompte') {
            if (post('employe_id') == '') {
                $json['message'] = json_error2('Veuillez sélectionner un employé');
            } elseif (post('dtfin') == '') {
                $json['message'] = json_error2('Veuillez sélectionner la date de fin de contrat');
            } elseif (post('decomptemotif') == '') {
                $json['message'] = json_error2('Veuillez sélectionner un motif');
            } else {
                $vals = array();
                $rubrique_ids = array();
                if (!empty($_POST['rubrique_ids'])) {
                    $rubrique_ids = $_POST['rubrique_ids'];
                }
                if (!empty($_POST['vals'])) {
                    $vals = $_POST['vals'];
                }
                $site_id = post('site_id');
                $employe_id = post('employe_id');
                $json['employe_id'] = $employe_id;
                $nbjrpreste = post('nbjrpreste');
                $nbjrconge = $_SESSION['jour']['total'];
                $netapayer = post('netapayer');
                $totbase = $_SESSION['totbasedcpt'];
                $dtfin = dateToformatBdd(post('dtfin'));
                $psedo = 0;
                $jrpreavis = post('jrpreavis');
                $cong6preavis = post('cong6preavis');
                $congcomp = post('congcomp');
                $connonpris = post('connonpris');
                //Besoin technique            
                $_SESSION['nbjrpreste'] = $nbjrpreste;
                $_SESSION['jrpreavis'] = $jrpreavis;
                $_SESSION['cong6preavis'] = $cong6preavis;
                $_SESSION['congcomp'] = $congcomp;
                $_SESSION['connonpris'] = $connonpris;
                $arsal = post('arsal');
                $indemnite = post('idemsrt');
                //Besoin technique
                $_SESSION['totarriere_sal'] = $arsal;
                $_SESSION['indemnite'] = $indemnite;
                $ancienete = post('anciennete');
                $motif = post('decomptemotif');
                $decompte = 1;
            $salaire_id=$this->ressalaire_model->decompte($nbjrpreste,$nbjrconge,$netapayer,$totbase,$_SESSION['Paie_taux'],date('Y-m-d'),$dtfin,$employe_id,$psedo, $site_id,$jrpreavis,$cong6preavis,$congcomp,$connonpris,$arsal,$indemnite,$ancienete,$motif,$decompte);
                //INSERTION ELEMENT SALAIRE
            $cpt1 = count($rubrique_ids);
            for ($i =1; $i <= $cpt1 - 1; $i++) {
                $rubrique_id=$rubrique_ids[$i];
                $valeur=$vals[$i];
                $rubriquesalobj->Insert($rubrique_id,$salaire_id,$valeur);
            }
                //REMBOURSEMENT DES DETTES
            $cpt1 = count($_SESSION['arrieres_sal']['emprunt_id']);
            for ($i=0; $i <= $cpt1 - 1; $i++){
                $emprunt_id=$_SESSION['arrieres_sal']['emprunt_id'][$i];
                $emprunt_tot=$_SESSION['arrieres_sal']['emprunt_tot'][$emprunt_id];
                $emprunt_paye=$_SESSION['arrieres_sal']['emprunt_paye'][$emprunt_id];
                $reste=$emprunt_tot-$emprunt_paye;
                $remboursementobj->Insert($employe_id,$salaire_id,$reste,$_SESSION['Paie_affiche'],$_SESSION['Paie_taux'],date('Y-m-d'),$emprunt_id);
            }
                $employeobj->setDesactif($employe_id);
                $salaire_id = 25;
                $json['salaire_id'] = $salaire_id;
                $json['s'] = TRUE;
                $json['employe_id'] = $employe_id;
            }
            echo json_encode($json);
        } elseif (get('do') == 'resiliation') {
            $result = $employeobj->GetEmpResilies($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/ressalaire/viewresiliation.php');
        }
    }

//end invoke
}

//end class
?>
	