
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        rescontrat.php
	* DATE CREATED:  	26-10-2017
	* FOR TABLE:  		rescontrat
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/rescontrat.php');
	
	class rescontrat_controller {
	public $rescontrat_model;
	
	public function __construct()  
    {  
        $this->rescontrat_model = new rescontrat_model();
    } 
	
	public function invoke_rescontrat()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->rescontrat_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->rescontrat_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=rescontrat&do=viewall');
	}else{
	$result = $this->rescontrat_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/rescontrat/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->rescontrat_model->SelectAll();
	include(APP_FOLDER.'/views/admin/rescontrat/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->rescontrat_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/rescontrat/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->rescontrat_model->AutoSearch(trim($qstring),10,'idcontr');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=rescontrat&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->idcontr.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->rescontrat_model->AutoSearch(trim($qstring),10,'typecontr');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=rescontrat&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->typecontr.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/rescontrat/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('idcontr')==''){
	json_error('The field idcontr cannot be empty!');
	}
	if (post('typecontr')==''){
	json_error('The field typecontr cannot be empty!');
	}
	elseif (post('dteng')==''){
	json_error('The field dteng cannot be empty!');
	}
	elseif (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	else{
	$this->rescontrat_model->Insert(post('idcontr'),post('typecontr'),post('dteng'),post('employe_id'));
	json_send(''.H_ADMIN.'&view=rescontrat&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->rescontrat_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/rescontrat/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('idcontr')==''){
	json_error('The field idcontr cannot be empty!');
	}
	elseif (post('typecontr')==''){
	json_error('The field typecontr cannot be empty!');
	}
	elseif (post('dteng')==''){
	json_error('The field dteng cannot be empty!');
	}
	elseif (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	else{
	$this->rescontrat_model->Update(post('idcontr'),post('typecontr'),post('dteng'),post('employe_id'),post('id'));
	json_send(''.H_ADMIN.'&view=rescontrat&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->rescontrat_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/rescontrat/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->rescontrat_model->TruncateTable(''.H_ADMIN.'&view=rescontrat&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/rescontrat/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->rescontrat_model->Delete(get('id'),''.H_ADMIN.'&view=rescontrat&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->rescontrat_model->Delete(get('id'),''.H_ADMIN.'&view=rescontrat&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=rescontrat&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	