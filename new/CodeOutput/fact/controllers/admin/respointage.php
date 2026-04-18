<?php

/*
 * =======================================================================
 * FILE NAME:        respointage.php
 * DATE CREATED:     17-11-2017
 * FOR TABLE:        respointage
 * PRODUCED BY:      HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:           Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
include(APP_FOLDER . '/models/objects/respointage.php');
include(APP_FOLDER . '/models/objects/resemployes.php');
include(APP_FOLDER . '/models/objects/reshoraire.php');
include(APP_FOLDER . '/models/objects/compteur.php');


class respointage_controller {

    public $respointage_model;

    public function __construct() {
        $this->respointage_model = new respointage_model();
    }

    public function invoke_respointage() {
        $resempl_obj = new resemployes_model();
        $reshr_obj = new reshoraire_model();
        $compteurobj= new compteur_model();
         date_default_timezone_set('Africa/Kinshasa');

        if (get('do') == 'viewall') {
            $datedebut = date('Y-m-d');
            $datefin = date('Y-m-d');
            $_SESSION['datedebut'] = $datedebut;
            $_SESSION['datefin'] = $datefin;
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->respointage_model->SelectPointageAll($_SESSION['idsite'], $datedebut, $datefin, RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->respointage_model->CountPointageRow($_SESSION['idsite']), RECORD_PER_PAGE, '' . H_ADMIN . '&view=respointage&do=viewall');
            } else {
                $result = $this->respointage_model->SelectPointageAll($_SESSION['idsite'], $datedebut, $datefin);
            }
            include(APP_FOLDER . '/views/admin/respointage/View.php');
        }   //Presence AJEX
        elseif (get('do') == 'presenceajex') {
            $datedebut = format_stringdateTodatetime('d/m/Y', post('datedebut'), 'Y-m-d');
            $_SESSION['datedebut'] = $datedebut;
            $datefin = format_stringdateTodatetime('d/m/Y', post('datefin'), 'Y-m-d');
            $_SESSION['datefin'] = $datefin;
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->respointage_model->SelectPointageAll($_SESSION['idsite'], $datedebut, $datefin, RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->respointage_model->CountPointageRow($_SESSION['idsite']), RECORD_PER_PAGE, '' . H_ADMIN . '&view=respointage&do=viewall');
            } else {
                $result = $this->respointage_model->SelectPointageAll($_SESSION['idsite'], $datedebut, $datefin);
            }
            include(APP_FOLDER . '/views/admin/respointage/data.php');
        }
        //VALIDATION POINTAGE //////////////////////////////////
        if (get('do') == 'vld') {            
            ValidationPointage($_SESSION['idsite']);
             // var_dump($_SESSION['res1']);
             // var_dump($_SESSION['res2']);
             // var_dump($_SESSION['result3']);
            DepartPointage($_SESSION['idsite']);
            //var_dump($_SESSION['depart_pointage']);
            include(APP_FOLDER . '/views/admin/respointage/vldpointage.php');
        }
        //filtremois
        if (get('do') == 'filtremois') {
            include(APP_FOLDER . '/views/admin/respointage/datamois.php');
        }
        //EXPORT ////////////////////////////////////////////////////
        if (get('do') == 'export') {
            $result = $this->respointage_model->SelectAll();
            include(APP_FOLDER . '/views/admin/respointage/Export.php');
        } //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->respointage_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/respointage/Export2.php');
        } //SEARCH SUGGEST ////////////////////////////////////////////////////
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->respointage_model->AutoSearch(trim($qstring), 10, 'employe_id');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=respointage&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->employe_id . '</li></a>
    </span>';
                }
                echo '</ul></div>';
            }
        } //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $result = $resempl_obj->SelectAllComboHr($_SESSION['idsite']);
            $resultdprt = $resempl_obj->SelectAllComboHrDprt($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/respointage/Add.php');
        } //UPDATE COMBO EMPLOYE//////////////////////////////////////////////////
        elseif (get('do') == 'slctemployupdate') {
            $resultdprt = $resempl_obj->SelectAllComboHrDprt($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/respointage/dataemploye.php');
        } //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';

            if ($_POST) {
                $idsite = $_SESSION['idsite'];
                $type = post('typepoint');
                // $idsite=86;
               //  $type=1;
                $presence = 0;
                $retard = 0;
                $absence = 0;
                $conge = 0;
                $malade = 0;
                $hrs_suplmtr = 0;
                $arrive = 0;
                $depart = 0;
                //form validation
                if ($type == 0) {
                    //Arrivée
                    $employe_id = post('employe_id');
                    $dte = date('Y-m-d');
                    $hr = post('hr');
                      $arrive = 1;
                    if ($employe_id == 0) {
                        $json['message'] = json_error2('Veuillez sélectionner un employé!');
                    }else if ($hr == '') {
                        $json['message'] = json_error2("Veuillez saisir l'heure d'arrivée!");
                    } else {
                        //on recupere le jour d'aujourdui
                        $jrs = $this->respointage_model->JourSemaine($dte);
                        $compteur = CountShiftEmploy($jrs,$employe_id);
                        //echo "compteur  ".$compteur;
                        //var_dump($_SESSION['countshiftemploy']);
                        //on recupere info employe
                        $hrsec = $this->respointage_model->TimeToSec($hr);
                        $_SESSION['data'] = $this->respointage_model->DatasEmployehorairePerso($employe_id, $jrs, $hrsec);
                        $exist = $_SESSION['data']['exist'][0];
                        $horaire_id = $_SESSION['data']['horaire_id'][0];
                        if ($exist == 0) {
                            $json['message'] = json_error2("Vous n'etez pas autorisé(e) de pointer");
                        } else {
                            $_SESSION['data'] = $this->respointage_model->DataShiftjour($horaire_id, $jrs);
                            if (empty($_SESSION['data']['jours_id'][0])) {
                                $json['message'] = json_error2("Vous n'etez pas autorisé(e) de pointer");
                            } else {
                                $jours_id = $_SESSION['data']['jours_id'][0];
                                $dbt = $_SESSION['data']['dbt'][0];
                                $mrg = $_SESSION['data']['mrg'][0];
                                $fin = $_SESSION['data']['fin'][0];
                                $avmrgdbt = $_SESSION['data']['avmrgdbt'][0];
                                $mrgfin = $_SESSION['data']['mrgfin'][0];
                                $avmrgdbtsec = $_SESSION['data']['avmrgdbtsec'][0];
                                $dbtsec = $_SESSION['data']['dbtsec'][0];
                                $mrgdbtsec = $_SESSION['data']['mrgdbtsec'][0];
                                $finsec = $_SESSION['data']['finsec'][0];
                                $mrgfinsec = $_SESSION['data']['mrgfinsec'][0];
                                $secdbt = $dbtsec;
                                $secmrg = $mrgdbtsec;
                                $sechr_in = $this->respointage_model->TimeToSec($hr);
                                $cond = 0;
                                if ($dbt <= $fin) {
                                    $cond = ($sechr_in >= ($secdbt - $avmrgdbtsec)) && ($sechr_in <= ($finsec + $mrgfinsec));
                                } else if ($dbt > $fin) {
                                    $cond = ($sechr_in >= ($secdbt - $avmrgdbtsec)) || ($sechr_in <= ($finsec + $mrgfinsec));
                                }
                                if ($cond) {
                                    if ($sechr_in > ($secdbt + $secmrg))
                                        $retard = 1;
                                    if ($this->respointage_model->CheckPointEmployehoraire($employe_id, $dte, $horaire_id) == 0) {
                                        //recuperation data employe horaire pour verifier type pointage
                                        $_SESSION['data'] = $this->respointage_model->dataEmployeHoraire($employe_id,$horaire_id);
                                        $type_permt = $_SESSION['data']['type_permt'][0];
                                        $agent_permt_id = $_SESSION['data']['agent_permt_id'][0];
                                        if($type_permt==0){
                                        if($compteur==1){
                                        $point_id = $this->respointage_model->Insert1($employe_id, $dte, $dte, $hr, '', '0', '', $presence, $retard, $absence, $conge, $malade, $hrs_suplmtr, $horaire_id, $arrive, $depart,$dbt,$fin,$idsite);
                                        $this->respointage_model->Inserttmp($employe_id, $dte, $point_id, $idsite, $horaire_id);
                                        }else if($compteur==2){
                                        $presence=0;
                                        $motif='A';
                                        $absence=1;
                                        $conge=0;
                                        $malade=0;
                                        $afich=1;
                                        $hrs_suplmtr=0;
                                        $nb= count($_SESSION['countshiftemploy']['horaire_id']);
                                        $idpointprec=0;
                                        $this->respointage_model->DelPointage($employe_id,$dte);
                                        for ($i = 0; $i < $nb; $i++) {    
                                        $horaire_id=$_SESSION['countshiftemploy']['horaire_id'][$i];
                                        $dbt=$_SESSION['countshiftemploy']['dbt'][$horaire_id];
                                        $fin=$_SESSION['countshiftemploy']['fin'][$horaire_id];
                                        if($i==0){
                                         $dte_in=$dte;
                                         $dte_out='';
                                         $hr_in=$hr;
                                         $hr_out='';
                                         $depart=1;
                                        }else{
                                         $dte_in=NextDate($dte,1);
                                         $dte_out=NextDate($dte,1);
                                         $hr_in='';
                                         $hr_out='';
                                         $depart=1;

                                        }
                                        $point_id=$this->respointage_model->Insert2($employe_id, $dte_in, $dte_out, $hr_in,$hr_out,$motif, '', $presence, $retard, $absence, $conge, $malade,$afich,$hrs_suplmtr, $horaire_id, $arrive, $depart,$dbt,$fin,$idsite);
                                        

                                        if($idpointprec==0){
                                        $idpointprec=$point_id;
                                        }



                                        }

                                        $this->respointage_model->Inserttmp1($employe_id, $dte, $point_id, $idsite, $horaire_id,$compteur,$idpointprec);


                                        }
                                             }else if($type_permt==1){
                                        $point_id = $this->respointage_model->Insert1($agent_permt_id, $dte, $dte, $hr, '', '0', '', $presence, $retard, $absence, $conge, $malade, $hrs_suplmtr, $horaire_id, $arrive, $depart,$dbt,$fin,$idsite);
                                        $this->respointage_model->Inserttmp($employe_id, $dte, $point_id, $idsite, $horaire_id);
                                        }else if($type_permt==2){
                                        $point_id = $this->respointage_model->Insert1($employe_id, $dte, $dte, $hr, '', '0', '', $presence, $retard, $absence, $conge, $malade, $hrs_suplmtr, $horaire_id, $arrive, $depart,$dbt,$fin,$idsite);
                                        $this->respointage_model->Inserttmp($employe_id, $dte, $point_id, $idsite, $horaire_id);
                                        }
                                        $json['message'] = json_success2("Vous venez d'arriver à " . $hr);
                                        $json['s'] = true;
                                    } else {
                                        $json['message'] = json_error2("Vous aviez déja pointer pour l'arrivée!");
                                    }
                                } else {
                                    $json['message'] = json_error2("Vous n'etez pas autorisé(e) de pointer.");
                                }
                            }
                        }
                    }
                } elseif ($type == 1) {

                    $idpoint = post('idpoint');
                    $idpointprec = post('idpointprec');
                    $compteurshift = post('compteurshift');
                    $dte = post('dte_in');
                    $employe_id = post('employe_id1');
                    $horaire_id = post('horaire_id');
                    $idtmppoint = post('idtmppoint');
                    $depart = 1;
                     // $dte='2017-12-29';
                      //$employe_id=17;
                     // $horaire_id=1;
                    $dte_sorti = date('Y-m-d');
                    $hr = post('hr1');
                    if ($employe_id == 0) {
                        $json['message'] = json_error2('Veuillez sélectionner un employé!');
                     }else if ($hr == '') {
                        $json['message'] = json_error2("Veuillez saisir l'heure de départ!");
                    }else {
                        if($compteurshift==1) {
                             //recuperation data employe horaire pour verifier type pointage
                            $_SESSION['data'] = $this->respointage_model->dataEmployeHoraire($employe_id,$horaire_id);
                            $type_permt = $_SESSION['data']['type_permt'][0];
                            $agent_permt_id = $_SESSION['data']['agent_permt_id'][0];
                            $heure_suplmtr_dpt = $_SESSION['data']['heure_suplmtr_dpt'][0];    
                            $dte_dbt = $_SESSION['data']['dte_dbt'][0];  
                            $dte_fin = $_SESSION['data']['dte_fin'][0];   
                        //recuperation info pointage
                        //on recupere le jour d'aujourdui
                        $jrs = $this->respointage_model->JourSemaine($dte);
                         if($type_permt==0||$type_permt==2){
                            $_SESSION['data'] = $this->respointage_model->InfosPointEmployehoraire($employe_id,$dte, $horaire_id);
                            }else{
                            $_SESSION['data'] = $this->respointage_model->InfosPointEmployehoraire($agent_permt_id,$dte, $horaire_id);
                            }
                        $id = $_SESSION['data']['id'][0];
                        $dte_in = $_SESSION['data']['dte_in'][0];
                        $dte_out = $_SESSION['data']['dte_out'][0];
                        $hr_in = $_SESSION['data']['hr_in'][0];
                        $hr_out = $_SESSION['data']['hr_out'][0];
                        $motif_bd = $_SESSION['data']['motif'][0];
                        $departbool = $_SESSION['data']['departbool'][0];
                        $justification = $_SESSION['data']['justification'][0];
                        $idtmppoint = $_SESSION['data']['idtmppoint'][0];
                        //recuperation jour et ses parametres
                        $_SESSION['data'] = $this->respointage_model->DataShiftjour($horaire_id, $jrs);
                        $jours_id = $_SESSION['data']['jours_id'][0];
                        $dbt = $_SESSION['data']['dbt'][0];
                        $mrg = $_SESSION['data']['mrg'][0];
                        $fin = $_SESSION['data']['fin'][0];
                        $avmrgdbt = $_SESSION['data']['avmrgdbt'][0];
                        $mrgfin = $_SESSION['data']['mrgfin'][0];
                        $avmrgdbtsec = $_SESSION['data']['avmrgdbtsec'][0];
                        $dbtsec = $_SESSION['data']['dbtsec'][0];
                        $mrgdbtsec = $_SESSION['data']['mrgdbtsec'][0];
                        $finsec = $_SESSION['data']['finsec'][0];
                        $mrgfinsec = $_SESSION['data']['mrgfinsec'][0];
                        $motif = 'A';
                        $justif = '';
                        $secdbt = $dbtsec;
                        $secmrg = $mrgdbtsec;
                        $secfin = $finsec;
                        $sechr_in = $this->respointage_model->TimeToSec($hr_in);
                        $sechr_out = $this->respointage_model->TimeToSec($hr);
                        $difdbtfin = abs($dbtsec - $finsec);
                        $difhr_inhr_out = abs($sechr_in - $sechr_out);
                       /* if ($dbt <= $fin) {
                            $cond = $sechr_out >= $secfin;
                        } else if ($dbt > $fin) {
                            $cond = ($sechr_in < $dbtsec + $mrgdbtsec && $sechr_out >= $secfin);
                        }*/
                        $datedebut=$dte;
                        $datefin=$dte_sorti;
                        $heuredebutshift=$dbtsec+$mrgdbtsec;
                        $heuredebutuser=$sechr_in;
                        $heurefinshift=$finsec;
                        $heurefinuser=$sechr_out;
                        $bool=DecisionPointage($datedebut,$datefin,$heuredebutshift,$heurefinshift,$heuredebutuser,$heurefinuser);
                        if ($bool==1) {
                            $motif = 'P';
                            $presence = 1;
                        } else {
                            $motif = 'A';
                            $presence = 0;
                            $absence = 1;
                            $retard = 0;
                        }

                        if ($departbool == 0) {
                            //calcul heures supplementaires
                            if ($dbt <= $fin) {
                                if ($sechr_out >= $secfin + $mrgfinsec) {
                                    $hrs_suplmtr = $sechr_out - ($secfin + $mrgfinsec);
                                }
                            } else if ($dbt > $fin) {
                                if (($sechr_out >= $secfin + $mrgfinsec) && $dte < $dte_sorti) {
                                    $hrs_suplmtr = $sechr_out - ($secfin + $mrgfinsec);
                                }
                            }
                            if($type_permt==0){
                            $this->respointage_model->Update1($employe_id, $dte_sorti, $hr, $motif, $presence, $absence,$retard,$hrs_suplmtr, $depart, $id,$horaire_id);
                            }else if($type_permt==1){
                            $this->respointage_model->Update1($agent_permt_id, $dte_sorti, $hr, $motif, $presence, $absence,$retard,$hrs_suplmtr, $depart, $id,$horaire_id);
                            }else if($type_permt==2){
                            $hrs_suplmtr=abs($sechr_out-$sechr_in);
                            $this->respointage_model->Update1($employe_id,$dte_sorti, $hr, $motif, $presence, $absence,$retard,$hrs_suplmtr, $depart, $id,$horaire_id);
                            }
                            if($dte_sorti>=$dte_fin){
                             if($type_permt==1||$type_permt==2){
                                $query = HDB::hus()->prepare("UPDATE resemployehoraire SET  employe_id=:idagent1,type_permt=:type_permt,agent_permt_id=:agent_permt_id,heure_suplmtr_dpt=:heure_suplmtr_dpt,dte_dbt=:dte_dbt,dte_fin=:dte_fin WHERE employe_id=:idagent2 AND horaire_id=:horaire_id");
                                $type_p=0;
                                $ag_perm_id=Null;
                                $he_suplm_d=Null;
                                 $dte_dbt=Null;
                                $dte_fin=Null;
                                $query->BindParam(':idagent1', $agent_permt_id);
                                $query->BindParam(':type_permt', $type_p);
                                $query->BindParam(':agent_permt_id', $ag_perm_id);
                                $query->BindParam(':heure_suplmtr_dpt', $he_suplm_d);
                                $query->BindParam(':dte_dbt',$dte_dbt);
                                $query->BindParam(':dte_fin',$dte_fin);
                                $query->BindParam(':idagent2', $employe_id);
                                $query->BindParam(':horaire_id',$horaire_id);
                                $query->execute();    
                            }   
                            } 
                            $this->respointage_model->Deltmp($idtmppoint);
                         
                        } else {

                            $json['message'] = json_error2("Vous aviez déja pointer pour le départ!");
                        }
                         $json['message'] = json_success2("Vous venez de sortir à " . $hr);
                            $json['s'] = true;
                        }elseif ($compteurshift==2) {
                            $motif = 'P';
                            $presence = 1;
                            $afich=1;
                            $hr = post('hr');
                            $absence = 0;
                            $heure_sortie1=0;
                            $heure_sortie2=0;
                            //on recupere le jour d'aujourdui
                            $jrs = $this->respointage_model->JourSemaine($dte_sorti);
                            $compteur = CountShiftEmploy($jrs,$employe_id);
                            $nb= count($_SESSION['countshiftemploy']['horaire_id']);
                            for ($i = 0; $i < $nb; $i++) {    
                            $horaire_id=$_SESSION['countshiftemploy']['horaire_id'][$i];
                            if($i==0){
                            $heure_sortie1=$_SESSION['countshiftemploy']['fin'][$horaire_id];
                            }else{
                            $heure_sortie2=$_SESSION['countshiftemploy']['fin'][$horaire_id];
                            }
                            }
                            $heure_sortie1_sec= $this->respointage_model->TimeToSec($heure_sortie1);
                            $heure_sortie2_sec= $this->respointage_model->TimeToSec($heure_sortie2);
                            $heure_sortie_user= $this->respointage_model->TimeToSec($hr);
                            if($dte==$dte_sorti){
                                 if($heure_sortie_user<$heure_sortie1_sec){
                                $motif = 'A';
                                $presence = 0;
                                $absence = 1;
                                 }
                            $this->respointage_model->Update2($idpointprec,$dte_sorti,$hr,$motif,$presence,$absence,$afich);

                            }else if($dte<$dte_sorti){
                            $this->respointage_model->Update2($idpointprec,'','',$motif,$presence,$absence,$afich);
                                if($heure_sortie_user<$heure_sortie2_sec){
                                $motif = 'A';
                                $presence = 0;
                                $absence = 1;
                                 }
                            $this->respointage_model->Update2($idpoint,$dte_sorti,$hr,$motif,$presence,$absence,$afich);

                            }
                            $this->respointage_model->Deltmp($idtmppoint);  
                             $json['message'] = json_success2("Vous venez de sortir à " . $hr);
                            $json['s'] = true;
                        }
                          
                    }
                }
                echo json_encode($json);
            }
        } 
        //validation pointage //////////////////////////////////////////////////
        elseif (get('do') == 'validpres') {
            $horaire_id = get('horaire_id');
            $dte_in = get('dte_in');
            $dbt = get('dbt');
            $fin = get('fin');
            $site_id = $_SESSION['idsite'];
            $respointmdl = $this->respointage_model;
            ValidationPointagetraite($horaire_id, $dte_in, $dbt, $fin, $site_id, $respointmdl);
            ValidationPointage($site_id);
            include(APP_FOLDER . '/views/admin/respointage/datavalidation.php');
        }
        //validation permutation
        elseif (get('do') == 'validpermut') {
           $json = array();
           $json['s'] = false;
           $json['message'] = '';
            $type_permut = post('type_permut');
            $idhoraire = post('horaire_id');
            $libhoraire = post('horairelib');
            $idagent1 = post('agent1');
            $nomsagent1 = post('nomagent1');
            $idagent2 = post('agent2');
            $nomsagent2 = post('nomagent2');
            $dte_dbt = post('dte_dbt');
            $dte_fin = post('dte_fin');
            $dte_dbt_bd =dateToformatBdd($dte_dbt);
            $dte_fin_bd =dateToformatBdd($dte_fin);
           /* $type_permut =2;
            $idhoraire =1;
            $libhoraire ='shift';
            $idagent1 =21;
            $nomsagent1 = 'Daniel Lembe';
            $idagent2 =17;
            $nomsagent2 = 'BB';
            $date_permt = '01/01/2018';*/
            $statut = 0;
            $site_id = $_SESSION['idsite'];
            if ($idhoraire == 0 || $idagent1 == 0 || $idagent2 == 0||$type_permut==0||$dte_fin=="") {
                $json['message'] = json_error2('Veuillez remplir tous les champs!');
            } else {
                $check = AgentAppartientHoraire($idagent1, $idhoraire);
                if ($check == 0) {
                    $json['message'] = json_error2("L'employé " . $nomsagent1 . " n'appartient pas à l'horaire " . $libhoraire);
                } else {
                    $check = AgentAppartientHoraire($idagent2, $idhoraire);
                    if ($check == 1) {
                        $json['message'] = json_error2("L'employé " . $nomsagent2 . " appartient deja à l'horaire " . $libhoraire);
                    } else {
                        //$jrs = $this->respointage_model->JourSemaine($dte);
                       // echo 'jours'.$jrs;
                        //$_SESSION['data'] = $this->respointage_model->DataShiftjour($idhoraire, $jrs);
                       // var_dump($_SESSION['data']);
                        //if($_SESSION['data']['exist'][0] == 0){
                         //$json['message'] = json_error2($jrs." , Le ".$date_permt." n'est pas configuré dans l'horaire " . $libhoraire);

                       // }else if($_SESSION['data']['exist'][0]  == 1){
                        $heure_suplmtr_dpt=Null;
                        $type_lib='Entre agents';
                        if($type_permut==2){
                        $type_lib='Entreprise';
                        }
                        // if($dte_dbt<=$dte_fin){
                        //GET NUMEROTATION
                        $libcptfact=NUM_BON_PERMT;
                        $num_cmd = $compteurobj->getnumerotation($site_id,$libcptfact);
                        $num_cmd_format = format_numero($num_cmd);  
                        $num=$num_cmd_format;
                        ValidationPermutation(0,$num,$idagent1,$nomsagent1,$idagent2,$nomsagent2, $idhoraire, $libhoraire, $statut,$type_permut,$type_lib,$heure_suplmtr_dpt,$site_id,$dte_dbt_bd,$dte_fin_bd,1);
                        //MAJ NUMEROTATION COMPTEUR
                        $num_cmd+=1;
                        $compteurobj->Update($libcptfact, $num_cmd, $site_id);
                        $json['num'] = $num;
                        $json['dte_dbt'] = $dte_dbt;
                        $json['dte_fin'] = $dte_fin;
                        $json['type_permut'] =  $type_permut;
                        $json['libhoraire'] = $libhoraire;
                        $json['nomsagent1'] = $nomsagent1;
                        $json['nomsagent2'] = $nomsagent2;
                        $json['message'] = json_success2("Permutation effectuée avec succes");
                        $json['s'] = true;
                   /* }else{
                    $json['message'] = json_error2("Veuillez entrer une bonne période.");

                    }*/
                       
                       // }
                        
                    }
                }
            }
            echo json_encode($json);
        }
        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'permut') {
            $result1 = $reshr_obj->SelectAllCombo($_SESSION['idsite']);
            $result2 = $resempl_obj->SelectAllCombo($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/respointage/Permut.php');
        } elseif (get('do') == 'majviewpermit') {
            include(APP_FOLDER . '/views/admin/respointage/datapermutation.php');
        } elseif (get('do') =='annulpermut') {
            $id = get('idprmt');
            $idhoraire = get('idhr');
            $idagent1 = get('idagt1');
            $idagent2 = get('idagt2');
            $statut = 1;
            ValidationPermutation($id,'',$idagent1,'',$idagent2,'',$idhoraire,'',$statut,'','','',$_SESSION['idsite'],'','',2);
        }
        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->respointage_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/respointage/Update.php');
        } //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('employe_id') == '') {
                    json_error('The field employe id cannot be empty!');
                } elseif (post('dte_in') == '') {
                    json_error('The field dte in cannot be empty!');
                } elseif (post('dte_out') == '') {
                    json_error('The field dte out cannot be empty!');
                } elseif (post('hr_in') == '') {
                    json_error('The field hr in cannot be empty!');
                } elseif (post('hr_out') == '') {
                    json_error('The field hr out cannot be empty!');
                } elseif (post('motif') == '') {
                    json_error('The field motif cannot be empty!');
                } elseif (post('justification') == '') {
                    json_error('The field justification cannot be empty!');
                } else {
                    $this->respointage_model->Update(post('employe_id'), post('dte_in'), post('dte_out'), post('hr_in'), post('hr_out'), post('motif'), post('justification'), post('id'));
                    json_send('' . H_ADMIN . '&view=respointage&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        } //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
    $datedebut=get('datedebut');
    $datefin=get('datefin');
    $result1 = $this->respointage_model->SelectPointageAgent(get('id'),$_SESSION['idsite'],$datedebut,$datefin);
    $result2 = $this->respointage_model->SelectInfoAgent(get('id'),$_SESSION['idsite']);
    $rows = $this->respointage_model->SelectOne(get('id'));
    include(APP_FOLDER.'/views/admin/respointage/Details.php');
        } //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->respointage_model->TruncateTable('' . H_ADMIN . '&view=respointage&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/respointage/View.php');
        } //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->respointage_model->Delete(get('id'), '' . H_ADMIN . '&view=respointage&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->respointage_model->Delete(get('id'), '' . H_ADMIN . '&view=respointage&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=respointage&id=' . get('id') . '&do=update&msg=delete');
            }
        }
        elseif (get('do') == 'validjustif') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            $idpoint = post('idpoint');
            $presence=1;
            $retard=0;
            $absence=0;
            $motif='AJ';
            $justif = post('justif');
            $malade =0;
            if(post('ismalade')){
            $malade = post('ismalade');
            }
             if ($justif =='') {
                $json['message'] = json_error2('Veuillez entrer le commentaire!');
            } else {
                $bdd = HDB::hus();
                $query = $bdd->prepare("UPDATE respointage SET presence=:presence,retard=:retard,absence=:absence,motif=:motif,justification=:justif,malade=:malade WHERE id=:id");
                 $query->BindParam(':presence', $presence);
                 $query->BindParam(':retard', $retard);
                 $query->BindParam(':absence', $absence);
                $query->BindParam(':motif', $motif);
                $query->BindParam(':justif', $justif);
                $query->BindParam(':malade', $malade);
                $query->BindParam(':id', $idpoint);
                $query->execute();
                 $json['message'] = json_success2("Justification enregistrée avec succes");
                 $json['s'] = true;
            }
         echo json_encode($json);    
        }
        else if(get('do') == 'majviewjstf'){
        $datedebut=get('datedebut');
        $datefin=get('datefin');
        $idemply=get('idemply');
        $result1 = $this->respointage_model->SelectPointageAgent($idemply,$_SESSION['idsite'],$datedebut,$datefin);
        $i = 1;
        foreach ($result1 as $rows) {
        $dte_in = dateAffiche($rows->dte_in);
        $dte_out =dateAffiche($rows->dte_out);
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $dte_in; ?></td>
            <td><?php echo $rows->hr_in; ?></td>
            <td><?php echo $dte_out; ?></td>
            <td><?php echo $rows->hr_out; ?></td>
            <td><?php echo $this->respointage_model->seconds_to_time2($rows->hrs_suplmtr); ?></td>
            <td> 
            <?php 
            if($rows->motif=='AJ'){
            ?>
            <a href=""  title="<?php echo $rows->justification; ?>">
             <?php 
              }
            ?>
            <?php echo ObservationPointage($rows->motif); ?></td>
             <?php 
            if($rows->motif=='AJ'){
            ?>
            </a>
             <?php 
              }
            ?>
            <td>
            <?php 
            if($rows->motif=='A'){
            ?>
            <div class="btn-group">
           <a id="<?php echo $rows->id; ?>" datedebut="<?php echo $datedebut; ?>" datefin="<?php echo $datefin; ?>" class="btn btn-primary btn-xs btnjustif"><span>Justifier</span></a>
            </div>
            <?php 
            }
            ?>
        </td>
        </tr>
        <?php
        $i++;
    }
        }

    elseif (get('do') == 'otrepointage') {
           
            include(APP_FOLDER . '/views/admin/respointage/otrepointage.php');
        }   //
    elseif (get('do') == 'addotrepointage') {
           
            include(APP_FOLDER . '/views/admin/respointage/otrepointage.php');
        }  





    }

//end invoke
}

//end class
?>
    