
<?php

/*
 * =======================================================================
 * FILE NAME:        resconge.php
 * DATE CREATED:  	23-10-2017
 * FOR TABLE:  		resconge
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/resconge.php');
include(APP_FOLDER . '/models/objects/resempconge.php');
include(APP_FOLDER . '/models/objects/resemployes.php');
include(APP_FOLDER . '/models/objects/compteur.php');


class resconge_controller {

    public $resconge_model;

    public function __construct() {
        $this->resconge_model = new resconge_model();
    }

    public function invoke_resconge() {
        //SELECT ALL //////////////////////////////////	
       $resemplcg_obj = new resempconge_model();
       $resempl_obj = new resemployes_model();
       $compteurobj= new compteur_model();

        if (get('do') == 'viewall') {
            $result = $this->resconge_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/resconge/View.php');
        }
        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->resconge_model->SelectAll();
            include(APP_FOLDER . '/views/admin/resconge/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->resconge_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resconge/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->resconge_model->AutoSearch(trim($qstring), 10, 'libelle');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=resconge&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->libelle . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/resconge/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
    $json = array();
    $json['s'] = false;
    $json['message'] = '';
    if($_POST){
    //form validation
    if (post('libelle')==''){
        $json['message'] = json_error2('Le champ désignation ne peut pas être vide!');
    }else if (post('nbrjr')==''){
        $json['message'] = json_error2('Le champ nombre de jours ne peut pas être vide!');
    }else{
        $libelle=post('libelle');
        $nbrjr=post('nbrjr');
        $trans=post('trans');
        $type=post('type');
        $contenu=post('contenu');
        $pseudo=post('psedo');
        $site_id=post('site_id');
    $this->resconge_model->Insert($libelle,$trans,$pseudo,$nbrjr,$type,$contenu,$site_id);
    $json['message'] = json_success2("Opération effectuée avec succes");
    $json['s'] = true;
    }
    echo json_encode($json);
    }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->resconge_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resconge/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {

        $json = array();
        $json['s'] = false;
        $json['message'] = '';
        if($_POST){
        //form validation
        if (post('libelle')==''){
            $json['message'] = json_error2('Le champ désignation ne peut pas être vide!');
        }else if (post('nbrjr')==''){
            $json['message'] = json_error2('Le champ nombre de jours ne peut pas être vide!');
        }else{
            $id=post('id');
            $libelle=post('libelle');
            $nbrjr=post('nbrjr');
            $trans=post('trans');
            $type=post('type');
            $contenu=post('contenu');
            $pseudo=post('psedo');
            $site_id=post('site_id');
        $this->resconge_model->Update($libelle,$trans,$pseudo,$nbrjr,$type,$contenu,$site_id,$id);
        $json['message'] = json_success2("Opération effectuée avec succes");
        $json['s'] = true;
        }
        echo json_encode($json);
        }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->resconge_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/resconge/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->resconge_model->TruncateTable('' . H_ADMIN . '&view=resconge&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/resconge/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->resconge_model->Delete(get('id'), '' . H_ADMIN . '&view=resconge&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->resconge_model->Delete(get('id'), '' . H_ADMIN . '&view=resconge&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=resconge&id=' . get('id') . '&do=update&msg=delete');
            }
        }

 elseif (get('do') == 'panelconge') {
            include(APP_FOLDER . '/views/admin/resconge/panelconge.php');
        }
        elseif (get('do') == 'detailcgemply') {
            $idemply=get('id');
            $idsite=$_SESSION['idsite'];
            $result=$this->resconge_model->SelectAlldetail($idemply,$idsite);
            include(APP_FOLDER . '/views/admin/resconge/detailcgemply.php');
        }elseif (get('do') == 'listcgemply') {
            include(APP_FOLDER . '/views/admin/resconge/situatcg.php');
        }elseif (get('do') == 'listcgemplyeli') {
            include(APP_FOLDER . '/views/admin/resconge/datas_eligibl.php');
        }
        elseif (get('do') == 'generedatefin') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            $json['dte2'] = '';
            $json['dte2f'] = '';

           // if($_POST){
            //form validation
            if (post('employe_id')==0){
                $json['message'] = json_error2('Le champ employé ne peut pas être vide!');
            }else if (post('conge_id')==0){
                $json['message'] = json_error2('Le champ congé ne peut pas être vide!');
            } else if (post('nombjrs')==''){
                $json['message'] = json_error2('Le champ nombre de jours ne peut pas être vide!');
            }else{
            $employe_id=post('employe_id');
            $nbrj=post('nombjrs');
            if(get('type')==1){
            $nbrj=$nbrj+get('nbrjancien');
            }
            $dte1=dateToformatBdd(post('dte1')) ;
            $dte2=DateFutureCg($dte1,$nbrj,$employe_id);
            $json['dte2'] =$dte2;
            $json['dte2f'] =dateAffiche($dte2);
            $json['s'] = true;
            }
            echo json_encode($json);
          //  }
        }
        elseif (get('do') == 'contenuconge') {
            $id=get('idcg');
            echo $_SESSION['CG']['cont'][$id];
        }
         elseif (get('do') == 'executcgpro') {
        $_SESSION['conge'] = array();
        $_SESSION['conge']['comment'] = array();
        $json = array();
        $json['s'] = false;
        $json['message'] = '';

        if($_POST){
        //form validation
        if (post('employe_id')==0){
            $json['message'] = json_error2('Le champ employé ne peut pas être vide!');
        }else if (post('conge_id')==0){
            $json['message'] = json_error2('Le champ congé ne peut pas être vide!');
        } else if (post('nombjrs')==''){
            $json['message'] = json_error2('Le champ nombre de jours ne peut pas être vide!');
        }else{
        $site_id=$_SESSION['idsite'];
        $employe_id=post('employe_id');
        $conge_id=post('conge_id');
        $dte=date('Y-m-d');
        $dte1=dateToformatBdd(post('dte1'));
        $dte2=post('dte2');
        $nbre=post('nombjrs')+post('nbrjancien');
        $transport=post('trans');
        $comment=post('editor1');
        $doc=post('doc');
       //GET REFERENCE
        $librefcg=NUM_REF_CONGE;
        $num_cmd = $compteurobj->getnumerotation($site_id,$librefcg);
        $num_cmd_format = format_numero($num_cmd);  
        $ref=$_SESSION['prefconge'].$num_cmd_format;
        //MAJ REFERENCE
        $num_cmd+=1;
        $compteurobj->Update($librefcg, $num_cmd, $site_id);
        $resemplcg_obj->preparinsertcg($employe_id);
        $idemplcg=$resemplcg_obj->Insert($employe_id,$conge_id,$dte,$dte1,$dte2,$nbre,$transport,$comment,$doc,$ref,$site_id);
        //MISE A JOURS RESEMPLOYE ELIGIBLE
        $type=post('type');
        if($type==1){
        $query = HDB::hus()->prepare("UPDATE resemploye_eligibl SET dtecg=:dtecg,dte2=:dte2,nbrjcg=:nbrjcg WHERE employe_id=:employe_id");
        $query->BindParam(':dtecg', $dte1);
        $query->BindParam(':dte2', $dte2);
        $query->BindParam(':nbrjcg', $nbre);
        $query->BindParam(':employe_id', $employe_id);
        $query->execute();
        }
        //FIN MISE A JOURS
        $json['message'] = json_success2("Opération effectuée avec succes");
        $json['s'] = true;
        //donnees json pour l'impression
        $json['noms'] = post('noms');
        $json['sexe'] = post('sexe');
        $json['adresse'] = post('adresse');
        $json['commune'] = post('commune');
        $json['quartier'] = post('quartier');
        $json['rue'] = post('rue');
        $json['ville'] = post('ville');
        $json['dte'] = $dte;
        $json['dte1'] = $dte1;
        $json['dte2'] = $dte2;
        $json['ref'] = $ref;
        $json['conge_lib'] = post('conge_lib');
        $json['idemplcg'] = $idemplcg;
        $_SESSION['conge']['comment'][$idemplcg]=$comment;
        //fin
        }
        echo json_encode($json);
        }

        }


    }

//end invoke
}

//end class
?>
	