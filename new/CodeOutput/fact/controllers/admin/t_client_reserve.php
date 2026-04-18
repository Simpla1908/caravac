
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_client_reserve.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_client_reserve
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_client_reserve.php');
	
	class t_client_reserve_controller {
	public $t_client_reserve_model;
	
	public function __construct()  
    {  
        $this->t_client_reserve_model = new t_client_reserve_model();
    } 
	
	public function invoke_t_client_reserve()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_client_reserve_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_client_reserve_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_client_reserve&do=viewall');
	}else{
	$result = $this->t_client_reserve_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_client_reserve/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_client_reserve_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_client_reserve/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_client_reserve_model->SelectOne(get('id_client_res'));
	include(APP_FOLDER.'/views/admin/t_client_reserve/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_client_reserve_model->AutoSearch(trim($qstring),10,'id_client');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_client_reserve&id_client_res='.$srow->id_client_res.'&do=details"><li class="list-group-item">'. $srow->id_client.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_client_reserve/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	elseif (post('id_res')==''){
	json_error('The field id res cannot be empty!');
	}
	elseif (post('responsable')==''){
	json_error('The field responsable cannot be empty!');
	}
	else{
	$this->t_client_reserve_model->Insert(post('id_client'),post('id_res'),post('responsable'));
	json_send(''.H_ADMIN.'&view=t_client_reserve&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_client_reserve_model->SelectOne(get('id_client_res'));
	include(APP_FOLDER.'/views/admin/t_client_reserve/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_client_res')==''){
	json_error('The field id_client_res cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	elseif (post('id_res')==''){
	json_error('The field id res cannot be empty!');
	}
	elseif (post('responsable')==''){
	json_error('The field responsable cannot be empty!');
	}
	else{
	$this->t_client_reserve_model->Update(post('id_client'),post('id_res'),post('responsable'),post('id_client_res'));
	json_send(''.H_ADMIN.'&view=t_client_reserve&id_client_res='.post('id_client_res').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_client_reserve_model->SelectOne(get('id_client_res'));
	include(APP_FOLDER.'/views/admin/t_client_reserve/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_client_reserve_model->TruncateTable(''.H_ADMIN.'&view=t_client_reserve&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_client_reserve/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_client_res') and $dfile==''){
	$del = $this->t_client_reserve_model->Delete(get('id_client_res'),''.H_ADMIN.'&view=t_client_reserve&do=viewall&msg=delete');
	}
	elseif(get('id_client_res') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_client_reserve_model->Delete(get('id_client_res'),''.H_ADMIN.'&view=t_client_reserve&do=viewall&msg=delete');
	}
	elseif(get('id_client_res') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_client_reserve&id_client_res='.get('id_client_res').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	