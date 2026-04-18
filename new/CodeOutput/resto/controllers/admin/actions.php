
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        actions.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		actions
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/actions.php');
	
	class actions_controller {
	public $actions_model;
	
	public function __construct()  
    {  
        $this->actions_model = new actions_model();
    } 
	
	public function invoke_actions()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->actions_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->actions_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=actions&do=viewall');
	}else{
	$result = $this->actions_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/actions/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->actions_model->SelectAll();
	include(APP_FOLDER.'/views/admin/actions/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->actions_model->SelectOne(get('id_act'));
	include(APP_FOLDER.'/views/admin/actions/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->actions_model->AutoSearch(trim($qstring),10,'code_act');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=actions&id_act='.$srow->id_act.'&do=details"><li class="list-group-item">'. $srow->code_act.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/actions/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('code_act')==''){
	json_error('The field code act cannot be empty!');
	}
	elseif (post('lib_act')==''){
	json_error('The field lib act cannot be empty!');
	}
	elseif (post('visible')==''){
	json_error('The field visible cannot be empty!');
	}
	elseif (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	else{
	$this->actions_model->Insert(post('code_act'),post('lib_act'),post('visible'),post('module_id'));
	json_send(''.H_ADMIN.'&view=actions&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->actions_model->SelectOne(get('id_act'));
	include(APP_FOLDER.'/views/admin/actions/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_act')==''){
	json_error('The field id_act cannot be empty!');
	}
	elseif (post('code_act')==''){
	json_error('The field code act cannot be empty!');
	}
	elseif (post('lib_act')==''){
	json_error('The field lib act cannot be empty!');
	}
	elseif (post('visible')==''){
	json_error('The field visible cannot be empty!');
	}
	elseif (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	else{
	$this->actions_model->Update(post('code_act'),post('lib_act'),post('visible'),post('module_id'),post('id_act'));
	json_send(''.H_ADMIN.'&view=actions&id_act='.post('id_act').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->actions_model->SelectOne(get('id_act'));
	include(APP_FOLDER.'/views/admin/actions/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->actions_model->TruncateTable(''.H_ADMIN.'&view=actions&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/actions/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_act') and $dfile==''){
	$del = $this->actions_model->Delete(get('id_act'),''.H_ADMIN.'&view=actions&do=viewall&msg=delete');
	}
	elseif(get('id_act') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->actions_model->Delete(get('id_act'),''.H_ADMIN.'&view=actions&do=viewall&msg=delete');
	}
	elseif(get('id_act') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=actions&id_act='.get('id_act').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	