
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        users_groupes.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		users_groupes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/users_groupes.php');
	
	class users_groupes_controller {
	public $users_groupes_model;
	
	public function __construct()  
    {  
        $this->users_groupes_model = new users_groupes_model();
    } 
	
	public function invoke_users_groupes()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->users_groupes_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->users_groupes_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=users_groupes&do=viewall');
	}else{
	$result = $this->users_groupes_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/users_groupes/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->users_groupes_model->SelectAll();
	include(APP_FOLDER.'/views/admin/users_groupes/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->users_groupes_model->SelectOne(get(''));
	include(APP_FOLDER.'/views/admin/users_groupes/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->users_groupes_model->AutoSearch(trim($qstring),10,'user_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=users_groupes&='.$srow->.'&do=details"><li class="list-group-item">'. $srow->user_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->users_groupes_model->AutoSearch(trim($qstring),10,'group_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=users_groupes&='.$srow->.'&do=details"><li class="list-group-item">'. $srow->group_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/users_groupes/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	if (post('group_id')==''){
	json_error('The field group id cannot be empty!');
	}
	elseif (post('affecteur_id')==''){
	json_error('The field affecteur id cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	else{
	$this->users_groupes_model->Insert(post('user_id'),post('group_id'),post('affecteur_id'),post('dte'));
	json_send(''.H_ADMIN.'&view=users_groupes&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->users_groupes_model->SelectOne(get(''));
	include(APP_FOLDER.'/views/admin/users_groupes/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('')==''){
	json_error('The field  cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('group_id')==''){
	json_error('The field group id cannot be empty!');
	}
	elseif (post('affecteur_id')==''){
	json_error('The field affecteur id cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	else{
	$this->users_groupes_model->Update(post('user_id'),post('group_id'),post('affecteur_id'),post('dte'),post(''));
	json_send(''.H_ADMIN.'&view=users_groupes&='.post('').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->users_groupes_model->SelectOne(get(''));
	include(APP_FOLDER.'/views/admin/users_groupes/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->users_groupes_model->TruncateTable(''.H_ADMIN.'&view=users_groupes&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/users_groupes/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('') and $dfile==''){
	$del = $this->users_groupes_model->Delete(get(''),''.H_ADMIN.'&view=users_groupes&do=viewall&msg=delete');
	}
	elseif(get('') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->users_groupes_model->Delete(get(''),''.H_ADMIN.'&view=users_groupes&do=viewall&msg=delete');
	}
	elseif(get('') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=users_groupes&='.get('').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	