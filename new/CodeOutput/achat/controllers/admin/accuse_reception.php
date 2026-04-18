
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        accuse_reception.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		accuse_reception
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/accuse_reception.php');
	
	class accuse_reception_controller {
	public $accuse_reception_model;
	
	public function __construct()  
    {  
        $this->accuse_reception_model = new accuse_reception_model();
    } 
	
	public function invoke_accuse_reception()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->accuse_reception_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->accuse_reception_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=accuse_reception&do=viewall');
	}else{
	$result = $this->accuse_reception_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/accuse_reception/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->accuse_reception_model->SelectAll();
	include(APP_FOLDER.'/views/admin/accuse_reception/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->accuse_reception_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/accuse_reception/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->accuse_reception_model->AutoSearch(trim($qstring),10,'email');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=accuse_reception&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->email.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/accuse_reception/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('email')==''){
	json_error('The field email cannot be empty!');
	}
	elseif (post('nom')==''){
	json_error('The field nom cannot be empty!');
	}
	elseif (post('sujet')==''){
	json_error('The field sujet cannot be empty!');
	}
	elseif (post('message')==''){
	json_error('The field message cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('date')==''){
	json_error('The field date cannot be empty!');
	}
	else{
	$this->accuse_reception_model->Insert(post('email'),post('nom'),post('sujet'),post('message'),post('statut'),post('date'));
	json_send(''.H_ADMIN.'&view=accuse_reception&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->accuse_reception_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/accuse_reception/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('email')==''){
	json_error('The field email cannot be empty!');
	}
	elseif (post('nom')==''){
	json_error('The field nom cannot be empty!');
	}
	elseif (post('sujet')==''){
	json_error('The field sujet cannot be empty!');
	}
	elseif (post('message')==''){
	json_error('The field message cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('date')==''){
	json_error('The field date cannot be empty!');
	}
	else{
	$this->accuse_reception_model->Update(post('email'),post('nom'),post('sujet'),post('message'),post('statut'),post('date'),post('id'));
	json_send(''.H_ADMIN.'&view=accuse_reception&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->accuse_reception_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/accuse_reception/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->accuse_reception_model->TruncateTable(''.H_ADMIN.'&view=accuse_reception&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/accuse_reception/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->accuse_reception_model->Delete(get('id'),''.H_ADMIN.'&view=accuse_reception&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->accuse_reception_model->Delete(get('id'),''.H_ADMIN.'&view=accuse_reception&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=accuse_reception&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	