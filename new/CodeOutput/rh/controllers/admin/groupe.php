
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        groupe.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		groupe
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/groupe.php');
	
	class groupe_controller {
	public $groupe_model;
	
	public function __construct()  
    {  
        $this->groupe_model = new groupe_model();
    } 
	
	public function invoke_groupe()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->groupe_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->groupe_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=groupe&do=viewall');
	}else{
	$result = $this->groupe_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/groupe/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->groupe_model->SelectAll();
	include(APP_FOLDER.'/views/admin/groupe/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->groupe_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/groupe/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->groupe_model->AutoSearch(trim($qstring),10,'libelle');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=groupe&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->libelle.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/groupe/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->groupe_model->Insert(post('libelle'),post('module_id'),post('user_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=groupe&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->groupe_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/groupe/Update.php');
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
	elseif (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->groupe_model->Update(post('libelle'),post('module_id'),post('user_id'),post('hotel_id'),post('id'));
	json_send(''.H_ADMIN.'&view=groupe&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->groupe_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/groupe/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->groupe_model->TruncateTable(''.H_ADMIN.'&view=groupe&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/groupe/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->groupe_model->Delete(get('id'),''.H_ADMIN.'&view=groupe&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->groupe_model->Delete(get('id'),''.H_ADMIN.'&view=groupe&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=groupe&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	