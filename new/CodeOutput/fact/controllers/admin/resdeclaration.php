<?php

/*
* =======================================================================
* FILE NAME:        reshoraire.php
* DATE CREATED:  	17-11-2017
* FOR TABLE:  		reshoraire
* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
* =======================================================================
*/

if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
include(APP_FOLDER . '/models/objects/resdeclaration.php');

class resdeclaration_controller
{
    public $resdeclaration_model;

    public function __construct()
    {
        $this->resdeclaration_model = new resdeclaration_model();
    }

    public function invoke_resdeclaration()
    {

         if (get('do') == 'view') {
        $site_id=$_SESSION['idsite'];
        $result = $this->resdeclaration_model->Select($site_id);
         include(APP_FOLDER . '/views/admin/resdeclaration/View.php');

         }
        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $site_id=$_SESSION['idsite'];
            $result = $this->resdeclaration_model->Select($site_id);
            include(APP_FOLDER . '/views/admin/resdeclaration/Update.php');
        } //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
                if ($_POST) {
                    //verification
                     $bool = 0;
                     $nbrjrs = count($_POST["id"]);
                        for ($i = 0; $i < $nbrjrs; $i++) {
                        $code=post('code' . $_POST["id"][$i]);
                        if($code=='IPR'){
                            if(post('lib' . $_POST["id"][$i])==''|| post('pourtrav' . $_POST["id"][$i])==''|| post('pourtrav' . $_POST["id"][$i])<=0){
                             $bool = 1;   
                            }
                        }

                        if($code=='INSS'){
                            if(post('lib' . $_POST["id"][$i])==''|| post('pourtrav' . $_POST["id"][$i])==''|| post('pourtrav' . $_POST["id"][$i])<=0|| post('poursoc' . $_POST["id"][$i])==''|| post('poursoc' . $_POST["id"][$i])<=0){
                             $bool = 1;   
                            }
                        }
                        if($code=='INPP'){
                            if(post('lib' . $_POST["id"][$i])==''|| post('poursoc' . $_POST["id"][$i])==''|| post('poursoc' . $_POST["id"][$i])<=0){
                             $bool = 1;   
                            }
                        }

                        }
                          //end verification
                        if ($bool == 1) {
                            json_error('Veuillez saisir les valeurs exactes!');
                        } else {

                        for ($i = 0; $i < $nbrjrs; $i++) {
                        $id=$_POST["id"][$i];
                        $code=post('code' . $_POST["id"][$i]);
                        $lib='';
                        $pourtrav=0;
                        $poursoc=0;
                        if($code=='IPR'){
                            $lib=post('lib' . $_POST["id"][$i]);
                            $pourtrav=post('pourtrav' . $_POST["id"][$i]);
                         }

                        if($code=='INSS'){
                            $lib=post('lib' . $_POST["id"][$i]);
                            $pourtrav=post('pourtrav' . $_POST["id"][$i]);
                            $poursoc=post('poursoc' . $_POST["id"][$i]);
                            
                        }
                        if($code=='INPP'){
                            $lib=post('lib' . $_POST["id"][$i]);
                            $poursoc=post('poursoc' . $_POST["id"][$i]);
                        }
                        $this->resdeclaration_model->Update($lib,$pourtrav,$poursoc,$id);
                        }
                            json_send('' . H_ADMIN . '&view=resdeclaration&do=update&msg=update');
                            json_success('Process Completed');
                        }


            }
            //en post
        } 
        //UPDATE //////////////////////////////////////////////////
         elseif (get('do') == 'verifdates') {
        $json = array();
        $json['s'] = false;
        $json['message'] = '';
        if (post('sltdesdecl')==''||post('datedebut')==''||post('datefin')==''){
            $json['message'] = json_error2('Veuillez remplir tous les champs');
        }else{
        $json['s']=true;
        }
        echo json_encode($json);
        }
        elseif (get('do') == 'viewdatasdclrt') {
            $id=post('id');
            $code=post('code');
            $lib=post('lib');
            $pourtrav=post('pourtrav');
            $poursoc=post('poursoc');
            $datedebut= dateToformatBdd(post('datedebut'));
            $datefin=dateToformatBdd(post('datefin'));
            $site_id=$_SESSION['idsite'];
            $result = $this->resdeclaration_model->DatasFromTEmploy($datedebut,$datefin,$site_id);
            if($code=='IPR'){
            include(APP_FOLDER . '/views/admin/resdeclaration/datas1.php');
            }else if($code=='INSS'){
            include(APP_FOLDER . '/views/admin/resdeclaration/datas2.php');
            }else if($code=='INPP'){
             include(APP_FOLDER . '/views/admin/resdeclaration/datas3.php');
            }
        }
    }//end invoke
}//end class
?>
	