
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        cptecritures.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/cptexercice.php');
	
	class cptexercice_controller {
	public $cptexercice_model;
	
	public function __construct()  
    {  
        $this->cptexercice_model = new cptexercice_model();
    } 
	
	public function invoke_cptexercice()
	{
	
	if(get('do')=='exerciceencours'){
     $this->cptexercice_model->exerciceencours(get('id'));
     $result = $this->cptexercice_model->SelectAll($_SESSION['idsite']);	
     $bdd=HDB::hus();
     DatasExerciceDefault($_SESSION['idsite'],$bdd);
     include(APP_FOLDER.'/views/admin/cptexercice/datasexercices.php');
	}
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	$result = $this->cptexercice_model->SelectAll($_SESSION['idsite']);	
	include(APP_FOLDER.'/views/admin/cptexercice/View.php');
	}
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	$config_id=get('id');
	include(APP_FOLDER.'/views/admin/cptexercice/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('debut')==''){
	json_error('Le champs debut est vide!');
	}
	elseif (post('fin')==''){
	json_error('Le champs fin est vide!');
	}
	else{
    $debut=dateToformatBdd(post('debut'));
    $fin=dateToformatBdd(post('fin'));
	$this->cptexercice_model->Insert(post('lib'),$debut,$fin,post('etat'),post('psedo'),post('Config_id'),post('site_id'));
    $bdd=HDB::hus();
    DatasExerciceDefault($_SESSION['idsite'],$bdd);
	json_send(''.H_ADMIN.'&view=cptexercice&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){
	$rows = $this->cptexercice_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptexercice/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('debut')==''){
	json_error('Le champs debut est vide!');
	}
	elseif (post('fin')==''){
	json_error('Le champs fin est vide!');
	}
	else{
	$id=post('id');	
	$debut=dateToformatBdd(post('debut'));
    $fin=dateToformatBdd(post('fin'));
	$this->cptexercice_model->Update(post('lib'),$debut,$fin,post('etat'),post('psedo'),post('Config_id'),post('site_id'),$id);
    json_send(''.H_ADMIN.'&view=cptexercice&do=viewall&msg=update');
	json_success('Process Completed');
	}
	}
	}
	//PSEDO DEL
	elseif(get('do')=='psedodelete'){
    $psedo=1;
	$rows = $this->cptexercice_model->Updatepsedo($psedo,get('id'));
    json_send(''.H_ADMIN.'&view=cptexercice&do=viewall&msg=delete');
	json_success('Process Completed');
	}
	//Cloturer exercice
	elseif(get('do')=='cloturerexercice'){
    $cloture=1;
	$rows = $this->cptexercice_model->cloturerexercice($cloture,get('id'));
    json_send(''.H_ADMIN.'&view=cptexercice&do=viewall&msg=cloture');
	json_success('Process Completed');
	}
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->cptecritures_model->Delete(get('id'),''.H_ADMIN.'&view=cptecritures&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->cptecritures_model->Delete(get('id'),''.H_ADMIN.'&view=cptecritures&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=cptecritures&id='.get('id').'&do=update&msg=delete');
	}

    



	}
	}//end invoke
	}//end class
	?>
	