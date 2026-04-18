
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resaffectation.php
	* DATE CREATED:  	30-10-2017
	* FOR TABLE:  		resaffectation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resaffectation.php');
	
	class resaffectation_controller {
	public $resaffectation_model;
	
	public function __construct()  
    {  
        $this->resaffectation_model = new resaffectation_model();
    } 
	
	public function invoke_resaffectation()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resaffectation_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resaffectation_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resaffectation&do=viewall');
	}else{
	$result = $this->resaffectation_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resaffectation/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resaffectation_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resaffectation/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resaffectation_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resaffectation/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resaffectation_model->AutoSearch(trim($qstring),10,'libelle');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resaffectation&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->libelle.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resaffectation/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->resaffectation_model->Insert(post('libelle'),post('site_id'));
	json_send(''.H_ADMIN.'&view=resaffectation&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resaffectation_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resaffectation/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->resaffectation_model->Update(post('libelle'),post('site_id'),post('id'));
	json_send(''.H_ADMIN.'&view=resaffectation&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->resaffectation_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resaffectation/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resaffectation_model->TruncateTable(''.H_ADMIN.'&view=resaffectation&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resaffectation/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->resaffectation_model->Delete(get('id'),''.H_ADMIN.'&view=resaffectation&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resaffectation_model->Delete(get('id'),''.H_ADMIN.'&view=resaffectation&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resaffectation&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	