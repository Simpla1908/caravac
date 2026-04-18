
<?php

/*
 * =======================================================================
 * FILE NAME:        resconfig.php
 * DATE CREATED:  	08-02-2018
 * FOR TABLE:  		resconfig
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/facconfig.php');

class facconfig_controller
{

    public $facconfig_model;

    public function __construct()
    {
        $this->facconfig_model = new facconfig_model();
    }

    public function invoke_facconfig()
    {

        //UPDATE //////////////////////////////////////////////////
        if (get('do') == 'update') {
            $rows = $this->facconfig_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/facconfig/Update.php');
        }
        if (get('do') == 'update2') {
            $bdd = HDB::hus();
            $resannuleconfig = Getcfgannulationreservation($bdd);
            $penalite = $resannuleconfig->penalite;
            $d1 = libjrannulation($resannuleconfig->jrannule);
            $d2 = libmontretenir($resannuleconfig->retention);
            $valmont = $resannuleconfig->valmont;
            $rows = $this->facconfig_model->SelectOne(get('id'));
            $bombadiv = '';
            if ($penalite == 0) {
                $valmont = 1;
                $bombadiv = 'hidden';
            }
            include(APP_FOLDER . '/views/admin/facconfig/Update2.php');
        }
        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('nomcomp') == '') {
                    json_error("Veuillez saisir le nom de l'entreprise!");
                } elseif (post('adrcomp') == '') {
                    json_error("Veuillez saisir l'adresse de la compagnie!");
                } elseif (post('m_insert') == '') {
                    json_error("Veuillez saisir la monnaie d'insertion!");
                } elseif (post('m_affich') == '') {
                    json_error("Veuillez saisir la monnaie d'affichage!");
                } elseif (post('taux') == '') {
                    json_error("Veuillez saisir le taux!");
                } elseif (post('tel') == '') {
                    json_error("Veuillez saisir le numero de telephone!");
                } elseif (post('mail') == '') {
                    json_error("Veuillez saisir l'adresse email!");
                } elseif (post('idnat') == '') {
                    json_error("Veuillez saisir l'ID.Nat");
                } elseif (post('rccm') == '') {
                    json_error("Veuillez saisir le RCCM!");
                } elseif (post('taux') == '') {
                    json_error("Veuillez saisir le taux!");
                } elseif (post('tva') == '') {
                    json_error("Veuillez saisir le tva!");
                } elseif (post('prefsanct') == '') {
                    json_error("Veuillez saisir le pr�fixe du recu!");
                } elseif (post('prefconge') == '') {
                    json_error("Veuillez saisir le pr�fixe de la facture!");
                } else {
                    $nofile = 0;
                    if (!empty($_FILES['logo'])) {
                        $nofile = 1;
                    }
                    $uploadname = '';
                    if ($nofile == 1) {
                        $newupload = new UploadControl;
                        $uploadname = $newupload->ImageUplaodResize('logo', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
                    }
                    if ($uploadname == '') {
                        $sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,tva =:tva,echeance =:echeance,liestock =:liestock,infofact =:infofact,sujetmail=:sujetmail,msgmail=:msgmail,module_id =:module_id,site_id =:site_id,checkin=:checkin,checkout=:checkout WHERE id = :id";
                        $data = array(':nomcomp' => post('nomcomp'), ':adrcomp' => post('adrcomp'), ':m_insert' => post('m_insert'), ':m_affich' => post('m_affich'), ':taux' => post('taux'), ':fuseauhoraire' => post('fuseauhoraire'), ':prefsanct' => post('prefsanct'), ':prefconge' => post('prefconge'), ':tva' => post('tva'), ':echeance' => post('echeance'), ':liestock' => post('liestock'), ':infofact' => post('infofact'), ':sujetmail' => post('sujetmail'), ':msgmail' => post('msgmail'), ':module_id' => post('module_id'), ':site_id' => post('site_id'), ':checkin' => post('checkin'), ':checkout' => post('checkout'), ':id' => post('id'));
                    } else {
                        $sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,tva =:tva,echeance =:echeance,liestock =:liestock,infofact =:infofact,sujetmail=:sujetmail,msgmail=:msgmail,logo =:logo,module_id =:module_id,site_id =:site_id,checkin=:checkin,checkout=:checkout WHERE id = :id";
                        $data = array(':nomcomp' => post('nomcomp'), ':adrcomp' => post('adrcomp'), ':m_insert' => post('m_insert'), ':m_affich' => post('m_affich'), ':taux' => post('taux'), ':fuseauhoraire' => post('fuseauhoraire'), ':prefsanct' => post('prefsanct'), ':prefconge' => post('prefconge'), ':tva' => post('tva'), ':echeance' => post('echeance'), ':liestock' => post('liestock'), ':infofact' => post('infofact'), ':sujetmail' => post('sujetmail'), ':msgmail' => post('msgmail'), ':logo' => $uploadname, ':module_id' => post('module_id'), ':site_id' => post('site_id'), ':checkin' => post('checkin'), ':checkout' => post('checkout'), ':id' => post('id'));
                    }
                    HDB::hus()->Hupdate('resconfig', $sql, $data);

                    $sql = "  nom_hotel =:nom_hotel,adresse_hotel =:adresse_hotel,idnat =:idnat,rccm =:rccm,mail =:mail,phone =:phone WHERE id_hotel = :site_id ";
                    $data = array(':nom_hotel' => post('nomcomp'), ':adresse_hotel' => post('adrcomp'), ':idnat' => post('idnat'), ':rccm' => post('rccm'), ':mail' => post('mail'), ':phone' => post('tel'), ':site_id' => post('site_id'));
                    HDB::hus()->Hupdate('t_hotel', $sql, $data);

                    //Mise en session
                    $_SESSION['nom_hotel'] = post('nomcomp');
                    // $_SESSION['company_logo'] =$uploadname;
                    //Autres informations
                    $_SESSION['adresse_hotel'] = post('adrcomp');
                    $_SESSION['idnat'] = post('idnat');
                    $_SESSION['rccm'] = post('rccm');
                    $_SESSION['mail'] = post('mail');
                    $_SESSION['phone'] = post('tel');
                    //fin
                    $_SESSION['Paie_insert'] = post('m_insert');
                    $_SESSION['Paie_affiche'] = post('m_affich');
                    $_SESSION['Paie_taux'] = post('taux');
                    $_SESSION['prefconge'] = post('prefconge');
                    $_SESSION['prefsanct'] = post('prefsanct');
                    $_SESSION['tva'] = post('tva');
                    $_SESSION['msgmail'] = post('msgmail');
                    $_SESSION['sujetmail'] = post('sujetmail');
                    $_SESSION['checkin'] = post('checkin');
                    $_SESSION['checkout'] = post('checkout');
                    //Fin mise en session
                    json_send('' . H_ADMIN . '&view=facconfig&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        } elseif (get('do') == 'updatepro2') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('taux') == '') {
                    json_error("Veuillez saisir le taux!");
                } elseif (post('taux') == '') {
                    json_error("Veuillez saisir le taux!");
                } elseif (post('tva') == '') {
                    json_error("Veuillez saisir le tva!");
                } elseif (post('prefsanct') == '') {
                    json_error("Veuillez saisir le pr�fixe du recu!");
                } elseif (post('prefconge') == '') {
                    json_error("Veuillez saisir le pr�fixe de la facture!");
                } else {
                    $nofile = 0;
                    $bdd = HDB::hus();
                    if (!empty($_FILES['logo'])) {
                        $nofile = 1;
                    }
                    $uploadname = '';
                    if ($nofile == 1) {
                        $newupload = new UploadControl;
                        $uploadname = $newupload->ImageUplaodResize('logo', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
                    }
                    if ($uploadname == '') {
                        $sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,tva =:tva,echeance =:echeance,liestock =:liestock,infofact =:infofact,sujetmail=:sujetmail,msgmail=:msgmail,module_id =:module_id,site_id =:site_id,checkin=:checkin,checkout=:checkout,pointage=:pointage WHERE id = :id";
                        $data = array(':nomcomp' => post('nomcomp'), ':adrcomp' => post('adrcomp'), ':m_insert' => post('m_insert'), ':m_affich' => post('m_affich'), ':taux' => post('taux'), ':fuseauhoraire' => post('fuseauhoraire'), ':prefsanct' => post('prefsanct'), ':prefconge' => post('prefconge'), ':tva' => post('tva'), ':echeance' => post('echeance'), ':liestock' => post('liestock'), ':infofact' => post('infofact'), ':sujetmail' => post('sujetmail'), ':msgmail' => post('msgmail'), ':module_id' => post('module_id'), ':site_id' => post('site_id'), ':checkin' => post('checkin'), ':checkout' => post('checkout'), ':pointage' => post('compteurinit'), ':id' => post('id'));
                    } else {
                        $sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,tva =:tva,echeance =:echeance,liestock =:liestock,infofact =:infofact,sujetmail=:sujetmail,msgmail=:msgmail,logo =:logo,module_id =:module_id,site_id =:site_id,checkin=:checkin,checkout=:checkout,pointage=:pointage WHERE id = :id";
                        $data = array(':nomcomp' => post('nomcomp'), ':adrcomp' => post('adrcomp'), ':m_insert' => post('m_insert'), ':m_affich' => post('m_affich'), ':taux' => post('taux'), ':fuseauhoraire' => post('fuseauhoraire'), ':prefsanct' => post('prefsanct'), ':prefconge' => post('prefconge'), ':tva' => post('tva'), ':echeance' => post('echeance'), ':liestock' => post('liestock'), ':infofact' => post('infofact'), ':sujetmail' => post('sujetmail'), ':msgmail' => post('msgmail'), ':logo' => $uploadname, ':module_id' => post('module_id'), ':site_id' => post('site_id'), ':checkin' => post('checkin'), ':checkout' => post('checkout'), ':pointage' => post('compteurinit'), ':id' => post('id'));
                    }
                    $bdd->Hupdate('resconfig', $sql, $data);

                    $sql = "  nom_hotel =:nom_hotel,adresse_hotel =:adresse_hotel,idnat =:idnat,rccm =:rccm,mail =:mail,phone =:phone WHERE id_hotel = :site_id ";
                    $data = array(':nom_hotel' => post('nomcomp'), ':adresse_hotel' => post('adrcomp'), ':idnat' => post('idnat'), ':rccm' => post('rccm'), ':mail' => post('mail'), ':phone' => post('tel'), ':site_id' => post('site_id'));
                    $bdd->Hupdate('t_hotel', $sql, $data);

                    //Mise en session
                    $_SESSION['nom_hotel'] = post('nomcomp');
                    // $_SESSION['company_logo'] =$uploadname;
                    //Autres informations
                    $_SESSION['adresse_hotel'] = post('adrcomp');
                    $_SESSION['idnat'] = post('idnat');
                    $_SESSION['rccm'] = post('rccm');
                    $_SESSION['mail'] = post('mail');
                    $_SESSION['phone'] = post('tel');
                    //fin
                    $_SESSION['Paie_insert'] = post('m_insert');
                    $_SESSION['Paie_affiche'] = post('m_affich');
                    $_SESSION['Paie_taux'] = post('taux');
                    $_SESSION['prefconge'] = post('prefconge');
                    $_SESSION['prefsanct'] = post('prefsanct');
                    $_SESSION['tva'] = post('tva');
                    $_SESSION['msgmail'] = post('msgmail');
                    $_SESSION['sujetmail'] = post('sujetmail');
                    $_SESSION['checkin'] = post('checkin');
                    $_SESSION['checkout'] = post('checkout');
                    $_SESSION['account_respons'] = post('compteurinit');

                    //Fin mise en session
                    $rescofig = Verifcfgannulationreservation($bdd);
                    $penalite = post('anres');
                    $retention = post('typeretention');
                    $jrannule = post('jrannule');
                    $valmont = post('montval');
                    if ($rescofig == 0) {
                        InsertAnnulationResconfig($penalite, $retention, $valmont, $jrannule, $bdd);
                    } else {
                        UpdateAnnulationResconfig($penalite, $retention, $valmont, $jrannule, $bdd);
                    }
                    //Configreservation
                    json_send('' . H_ADMIN . '&view=facconfig&id=' . post('id') . '&do=details2&msg=update');
                    json_success('Process Completed');
                }
            }
        }
        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->facconfig_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/facconfig/Details.php');
        } elseif (get('do') == 'details2') {
            $bdd = HDB::hus();
            $module_id = 23;
            $site_id = $_SESSION['idsite'];
            ConfigModule($module_id, $site_id);
            $rows = $this->facconfig_model->SelectOne($_SESSION['config_id']);
            $resannuleconfig = Getcfgannulationreservation($bdd);
            $libellepenalite = 'Sans pénalité';
            if ($resannuleconfig->penalite == 1) {
                $libellepenalite = 'Avec pénalité';
            }

            include(APP_FOLDER . '/views/admin/facconfig/Details2.php');
        } elseif (get('do') == 'annulation') {
            $module_id = 23;
            $site_id = $_SESSION['idsite'];
            ConfigModule($module_id, $site_id);
            $rows = $this->facconfig_model->SelectOne($_SESSION['config_id']);
            include(APP_FOLDER . '/views/admin/facconfig/Update3.php');
        }
    }

    //end invoke
}

//end class
?>
	