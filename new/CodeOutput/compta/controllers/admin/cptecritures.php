
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
	
	include(APP_FOLDER.'/models/objects/cptecritures.php');
	
	class cptecritures_controller {
	public $cptecritures_model;
	
	public function __construct()  
    {  
        $this->cptecritures_model = new cptecritures_model();
    } 
	
	public function invoke_cptecritures()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->cptecritures_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->cptecritures_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=cptecritures&do=viewall');
	}else{
	$result = $this->cptecritures_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/cptecritures/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->cptecritures_model->SelectAll();
	include(APP_FOLDER.'/views/admin/cptecritures/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->cptecritures_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptecritures/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->cptecritures_model->AutoSearch(trim($qstring),10,'dte');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=cptecritures&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->dte.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/cptecritures/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('dtetime')==''){
	json_error('The field dtetime cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('journal_id')==''){
	json_error('The field journal id cannot be empty!');
	}
	elseif (post('psedo')==''){
	json_error('The field psedo cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->cptecritures_model->Insert(post('dte'),post('dtetime'),post('libelle'),post('journal_id'),post('psedo'),post('user_id'),post('site_id'));
	json_send(''.H_ADMIN.'&view=cptecritures&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->cptecritures_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptecritures/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('dtetime')==''){
	json_error('The field dtetime cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('journal_id')==''){
	json_error('The field journal id cannot be empty!');
	}
	elseif (post('psedo')==''){
	json_error('The field psedo cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->cptecritures_model->Update(post('dte'),post('dtetime'),post('libelle'),post('journal_id'),post('psedo'),post('user_id'),post('site_id'),post('id'));
	json_send(''.H_ADMIN.'&view=cptecritures&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->cptecritures_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptecritures/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->cptecritures_model->TruncateTable(''.H_ADMIN.'&view=cptecritures&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/cptecritures/View.php');
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
	