
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        actions_groupe.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		actions_groupe
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/actions_groupe.php');
	
	class actions_groupe_controller {
	public $actions_groupe_model;
	
	public function __construct()  
    {  
        $this->actions_groupe_model = new actions_groupe_model();
    } 
	
	public function invoke_actions_groupe()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->actions_groupe_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->actions_groupe_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=actions_groupe&do=viewall');
	}else{
	$result = $this->actions_groupe_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/actions_groupe/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->actions_groupe_model->SelectAll();
	include(APP_FOLDER.'/views/admin/actions_groupe/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->actions_groupe_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/actions_groupe/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->actions_groupe_model->AutoSearch(trim($qstring),10,'group_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=actions_groupe&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->group_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/actions_groupe/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('group_id')==''){
	json_error('The field group id cannot be empty!');
	}
	elseif (post('action_id')==''){
	json_error('The field action id cannot be empty!');
	}
	else{
	$this->actions_groupe_model->Insert(post('group_id'),post('action_id'));
	json_send(''.H_ADMIN.'&view=actions_groupe&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->actions_groupe_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/actions_groupe/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('group_id')==''){
	json_error('The field group id cannot be empty!');
	}
	elseif (post('action_id')==''){
	json_error('The field action id cannot be empty!');
	}
	else{
	$this->actions_groupe_model->Update(post('group_id'),post('action_id'),post('id'));
	json_send(''.H_ADMIN.'&view=actions_groupe&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->actions_groupe_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/actions_groupe/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->actions_groupe_model->TruncateTable(''.H_ADMIN.'&view=actions_groupe&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/actions_groupe/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->actions_groupe_model->Delete(get('id'),''.H_ADMIN.'&view=actions_groupe&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->actions_groupe_model->Delete(get('id'),''.H_ADMIN.'&view=actions_groupe&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=actions_groupe&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	