
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_droit.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_droit
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_droit.php');
	
	class t_droit_controller {
	public $t_droit_model;
	
	public function __construct()  
    {  
        $this->t_droit_model = new t_droit_model();
    } 
	
	public function invoke_t_droit()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_droit_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_droit_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_droit&do=viewall');
	}else{
	$result = $this->t_droit_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_droit/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_droit_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_droit/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_droit_model->SelectOne(get('id_droit'));
	include(APP_FOLDER.'/views/admin/t_droit/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_droit_model->AutoSearch(trim($qstring),10,'droit');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_droit&id_droit='.$srow->id_droit.'&do=details"><li class="list-group-item">'. $srow->droit.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_droit/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('droit')==''){
	json_error('The field droit cannot be empty!');
	}
	elseif (post('libe_droit')==''){
	json_error('The field libe droit cannot be empty!');
	}
	else{
	$this->t_droit_model->Insert(post('droit'),post('libe_droit'));
	json_send(''.H_ADMIN.'&view=t_droit&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_droit_model->SelectOne(get('id_droit'));
	include(APP_FOLDER.'/views/admin/t_droit/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_droit')==''){
	json_error('The field id_droit cannot be empty!');
	}
	elseif (post('droit')==''){
	json_error('The field droit cannot be empty!');
	}
	elseif (post('libe_droit')==''){
	json_error('The field libe droit cannot be empty!');
	}
	else{
	$this->t_droit_model->Update(post('droit'),post('libe_droit'),post('id_droit'));
	json_send(''.H_ADMIN.'&view=t_droit&id_droit='.post('id_droit').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_droit_model->SelectOne(get('id_droit'));
	include(APP_FOLDER.'/views/admin/t_droit/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_droit_model->TruncateTable(''.H_ADMIN.'&view=t_droit&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_droit/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_droit') and $dfile==''){
	$del = $this->t_droit_model->Delete(get('id_droit'),''.H_ADMIN.'&view=t_droit&do=viewall&msg=delete');
	}
	elseif(get('id_droit') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_droit_model->Delete(get('id_droit'),''.H_ADMIN.'&view=t_droit&do=viewall&msg=delete');
	}
	elseif(get('id_droit') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_droit&id_droit='.get('id_droit').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	