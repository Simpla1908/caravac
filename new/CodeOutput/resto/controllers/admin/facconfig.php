
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

class facconfig_controller {

    public $facconfig_model;

    public function __construct() {
        $this->facconfig_model = new facconfig_model();
    }

    public function invoke_facconfig() {

        //UPDATE //////////////////////////////////////////////////
        if (get('do') == 'update') {
            $rows = $this->facconfig_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/facconfig/Update.php');
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
                } elseif (post('infofact') == '') {
                    json_error("Veuillez saisir les informations de la facture!");
                } elseif (post('module_id') == '') {
                    json_error('The field module id cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
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
                        $sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,tva =:tva,echeance =:echeance,liestock =:liestock,infofact =:infofact,sujetmail=:sujetmail,msgmail=:msgmail,module_id =:module_id,site_id =:site_id WHERE id = :id";
                        $data = array(':nomcomp' => post('nomcomp'), ':adrcomp' => post('adrcomp'), ':m_insert' => post('m_insert'), ':m_affich' => post('m_affich'), ':taux' => post('taux'), ':fuseauhoraire' => post('fuseauhoraire'), ':prefsanct' => post('prefsanct'), ':prefconge' => post('prefconge'), ':tva' => post('tva'), ':echeance' => post('echeance'), ':liestock' => post('liestock'), ':infofact' => post('infofact'), ':sujetmail' => post('sujetmail'), ':msgmail' => post('msgmail'), ':module_id' => post('module_id'), ':site_id' => post('site_id'), ':id' => post('id'));
                    } else {
                        $sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,tva =:tva,echeance =:echeance,liestock =:liestock,infofact =:infofact,sujetmail=:sujetmail,msgmail=:msgmail,logo =:logo,module_id =:module_id,site_id =:site_id WHERE id = :id";
                        $data = array(':nomcomp' => post('nomcomp'), ':adrcomp' => post('adrcomp'), ':m_insert' => post('m_insert'), ':m_affich' => post('m_affich'), ':taux' => post('taux'), ':fuseauhoraire' => post('fuseauhoraire'), ':prefsanct' => post('prefsanct'), ':prefconge' => post('prefconge'), ':tva' => post('tva'), ':echeance' => post('echeance'), ':liestock' => post('liestock'), ':infofact' => post('infofact'), ':sujetmail' => post('sujetmail'), ':msgmail' => post('msgmail'), ':logo' => $uploadname, ':module_id' => post('module_id'), ':site_id' => post('site_id'), ':id' => post('id'));
                    }
                    HDB::hus()->Hupdate('resconfig', $sql, $data);

                    $sql = "  nom_hotel =:nom_hotel,adresse_hotel =:adresse_hotel,idnat =:idnat,rccm =:rccm,mail =:mail,phone =:phone WHERE id_hotel = :site_id ";
                    $data = array(':nom_hotel' => post('nomcomp'), ':adresse_hotel' => post('adrcomp'), ':idnat' => post('idnat'), ':rccm' => post('rccm'), ':mail' => post('mail'), ':phone' => post('tel'), ':site_id' => post('site_id'));
                    HDB::hus()->Hupdate('t_hotel', $sql, $data);

//				   $this->facconfig_model->Update($nofile, post('nomcomp'), post('adrcomp'), post('m_insert'), post('m_affich'), post('taux'), post('fuseauhoraire'), post('prefsanct'), post('prefconge'),post('tva'),post('echeance'),post('liestock'),post('liestock'), post('infofact'), post('sujetmail'), post('msgmail'), post('module_id'), post('site_id'), post('id'));
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
                    //Fin mise en session
                    json_send('' . H_ADMIN . '&view=facconfig&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->facconfig_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/facconfig/Details.php');
        }
    }

//end invoke
}

//end class
?>
	