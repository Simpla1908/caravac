
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resremboursement.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resremboursement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resremboursement.php');
	
	class resremboursement_controller {
	public $resremboursement_model;
	
	public function __construct()  
    {  
        $this->resremboursement_model = new resremboursement_model();
    } 
	
	public function invoke_resremboursement()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resremboursement_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resremboursement_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resremboursement&do=viewall');
	}else{
	$result = $this->resremboursement_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resremboursement/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resremboursement_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resremboursement/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resremboursement_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resremboursement/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resremboursement_model->AutoSearch(trim($qstring),10,'employe_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resremboursement&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->employe_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resremboursement/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	elseif (post('salaire_id')==''){
	json_error('The field salaire id cannot be empty!');
	}
	elseif (post('montant')==''){
	json_error('The field montant cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	else{
	$this->resremboursement_model->Insert(post('employe_id'),post('salaire_id'),post('montant'),post('dte'));
	json_send(''.H_ADMIN.'&view=resremboursement&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resremboursement_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resremboursement/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	elseif (post('salaire_id')==''){
	json_error('The field salaire id cannot be empty!');
	}
	elseif (post('montant')==''){
	json_error('The field montant cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	else{
	$this->resremboursement_model->Update(post('employe_id'),post('salaire_id'),post('montant'),post('dte'),post('id'));
	json_send(''.H_ADMIN.'&view=resremboursement&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->resremboursement_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resremboursement/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resremboursement_model->TruncateTable(''.H_ADMIN.'&view=resremboursement&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resremboursement/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->resremboursement_model->Delete(get('id'),''.H_ADMIN.'&view=resremboursement&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resremboursement_model->Delete(get('id'),''.H_ADMIN.'&view=resremboursement&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resremboursement&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	