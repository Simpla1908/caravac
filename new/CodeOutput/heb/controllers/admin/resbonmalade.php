
<?php

/*
 * =======================================================================
 * FILE NAME:        rescategorie.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		rescategorie
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/resbonmalade.php');
include(APP_FOLDER . '/models/objects/resemployes.php');
include(APP_FOLDER . '/models/objects/resemployefamille.php');
include(APP_FOLDER . '/models/objects/compteur.php');

class resbonmalade_controller {

    public $resbonmalade_model;

    public function __construct() {
        $this->resbonmalade_model = new resbonmalade_model();
    }

    public function invoke_resbonmalade() {
        $resempl_obj = new resemployes_model();
        $resempl_memb= new resemployefamille_model();
        $compteurobj= new compteur_model();
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
             $result = $this->resbonmalade_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resbonmalade/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->rescategorie_model->SelectAll();
            include(APP_FOLDER . '/views/admin/rescategorie/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->rescategorie_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/rescategorie/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->rescategorie_model->AutoSearch(trim($qstring), 10, 'libelle');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=rescategorie&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->libelle . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }

        //employe combo
        elseif (get('do') == 'employe') {
            $employe_id=get('employe_id');
            $result= $resempl_memb->SelectAllMemEmply($employe_id);
            include(APP_FOLDER . '/views/admin/resbonmalade/membresfamille.php');
        }
        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $result= $resempl_obj->SelectAllCombo($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resbonmalade/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            if ($_POST) {
                //form validation
                if (post('employe')==0) {
                    $json['message'] = json_error2('Veuillez sélectionner un employé!');
                }  else {
                    $idmalade=post('idmalade');
                   // echo 'idmalade'.$idmalade;
                    DataBnMalad($idmalade);
                    //var_dump($_SESSION['malade']);
                    $noms=$_SESSION['malade']['noms'][$idmalade];
                    $code=$_SESSION['malade']['statut'][$idmalade];
                    $emplyprisencharg=post('emplyprisencharg');
                    $idemploy=Null;
                    $idmembr=Null;
                    if($code=='employe'){
                       $idemploy=$idmalade;
                    }else{
                       $idmembr=$idmalade ;
                    }

                    $dte=date('Y-m-d');
                    $site_id=$_SESSION['idsite'];
                    //GET NUMEROTATION
                    $libcptfact=NUM_BON_MALADE;
                    $num_cmd = $compteurobj->getnumerotation($site_id,$libcptfact);
                    $num_cmd_format = format_numero($num_cmd);  
                    $numbon=$num_cmd_format;
                    $this->resbonmalade_model->Insert($idemploy,$idmembr,$idmalade,$emplyprisencharg,$noms,$numbon,$dte,$code,$site_id);
                    //MAJ NUMEROTATION COMPTEUR
                    $num_cmd+=1;
                    $compteurobj->Update($libcptfact, $num_cmd, $site_id);
                    $json['nom_malad'] = $noms;
                    $json['num_bon'] = $numbon;
                    $json['dte'] = $dte;
                    $json['message'] = json_success2("Bon enregistré avec succes");
                    $json['s'] = true;
                        }
            echo json_encode($json);

            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->rescategorie_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/rescategorie/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('libelle') == '') {
                    json_error('Veuillez entrer un nom!');
                } elseif (post('salbase') == '') {
                    json_error('Veuillez entrer un montant!');
                } else {
                    $this->rescategorie_model->Update(post('libelle'), post('salbase'), post('devise'), post('psedo'), post('type'), post('site_id'), post('id'));
                    json_send('' . H_ADMIN . '&view=rescategorie&id=' . post('id') . '&do=viewall&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $result = $this->resbonmalade_model->SelectDetails(get('id'));
            include(APP_FOLDER . '/views/admin/resbonmalade/Details.php');
        }
        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->rescategorie_model->TruncateTable('' . H_ADMIN . '&view=rescategorie&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/rescategorie/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->rescategorie_model->Delete(get('id'), '' . H_ADMIN . '&view=rescategorie&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->rescategorie_model->Delete(get('id'), '' . H_ADMIN . '&view=rescategorie&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=rescategorie&id=' . get('id') . '&do=update&msg=delete');
            }
        }
        elseif (get('do') == 'lstempl') {
            $result = $resempl_obj->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resemprunt/Employescombo.php');
        }
    }

//end invoke
}

//end class
?>
	