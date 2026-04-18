
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

include(APP_FOLDER . '/models/objects/parambase.php');

class parambase_controller
{

    public $parambase_model;

    public function __construct()
    {
        $this->parambase_model = new parambase_model();
    }

    public function invoke_parambase()
    {

        //UPDATE //////////////////////////////////////////////////
        if (get('do') == 'update') {
            $site_id = get('id');
            $rows = $this->parambase_model->SelectOne($site_id);
            include(APP_FOLDER . '/views/admin/parambase/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('nomcomp') == '') {
                    json_error("Veuillez saisir le nom de l'entreprise!");
                } elseif (post('adrcomp') == '') {
                    json_error("Veuillez saisir l'adresse de l'entreprise!");
                } elseif (post('ville') == '') {
                    json_error("Veuillez saisir la ville de l'entreprise!");
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
                        $sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,tva =:tva WHERE site_id = :site_id";
                        $data = array(':nomcomp' => post('nomcomp'), ':adrcomp' => post('adrcomp'), ':m_insert' => post('m_insert'), ':m_affich' => post('m_affich'), ':taux' => post('taux'), ':tva' => post('tva'), ':site_id' => post('site_id'));
                    } else {
                        $sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,tva =:tva,logo=:logo WHERE site_id =:site_id";
                        $data = array(':nomcomp' => post('nomcomp'), ':adrcomp' => post('adrcomp'), ':m_insert' => post('m_insert'), ':m_affich' => post('m_affich'), ':taux' => post('taux'), ':tva' => post('tva'), ':logo' => $uploadname, ':site_id' => post('site_id'));
                    }
                    HDB::hus()->Hupdate('resconfig', $sql, $data);

                    $sql = "nom_hotel =:nom_hotel,adresse_hotel =:adresse_hotel,idnat =:idnat,rccm =:rccm,mail =:mail,phone =:phone,ville_hotel=:ville_hotel WHERE id_hotel = :site_id ";
                    $data = array(':nom_hotel' => post('nomcomp'), ':adresse_hotel' => post('adrcomp'), ':idnat' => post('idnat'), ':rccm' => post('rccm'), ':mail' => post('mail'), ':phone' => post('tel'), ':ville_hotel' => post('ville'), ':site_id' => post('site_id'));
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
                    $_SESSION['tva'] = post('tva');
                    //Fin mise en session
                    json_send('' . H_ADMIN . '&view=parambase&id=' . post('site_id') . '&do=parambase&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'parambase') {
            $site_id = $_SESSION['id_hotel'];
            $rows = $this->parambase_model->SelectOne($site_id);
            include(APP_FOLDER . '/views/admin/parambase/Details.php');
        }
    }

    //end invoke
}

//end class
?>
	