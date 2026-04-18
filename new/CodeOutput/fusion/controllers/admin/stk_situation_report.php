
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        stk_situation_report.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_situation_report
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/stk_situation_report.php');
	
	class stk_situation_report_controller {
	public $stk_situation_report_model;
	
	public function __construct()  
    {  
        $this->stk_situation_report_model = new stk_situation_report_model();
    } 
	
	public function invoke_stk_situation_report()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->stk_situation_report_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->stk_situation_report_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=stk_situation_report&do=viewall');
	}else{
	$result = $this->stk_situation_report_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/stk_situation_report/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->stk_situation_report_model->SelectAll();
	include(APP_FOLDER.'/views/admin/stk_situation_report/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->stk_situation_report_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/stk_situation_report/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->stk_situation_report_model->AutoSearch(trim($qstring),10,'report_effectue_date');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=stk_situation_report&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->report_effectue_date.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/stk_situation_report/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('report_effectue_date')==''){
	json_error('The field report effectue date cannot be empty!');
	}
	else{
	$this->stk_situation_report_model->Insert(post('report_effectue_date'));
	json_send(''.H_ADMIN.'&view=stk_situation_report&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->stk_situation_report_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/stk_situation_report/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('report_effectue_date')==''){
	json_error('The field report effectue date cannot be empty!');
	}
	else{
	$this->stk_situation_report_model->Update(post('report_effectue_date'),post('id'));
	json_send(''.H_ADMIN.'&view=stk_situation_report&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->stk_situation_report_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/stk_situation_report/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->stk_situation_report_model->TruncateTable(''.H_ADMIN.'&view=stk_situation_report&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/stk_situation_report/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->stk_situation_report_model->Delete(get('id'),''.H_ADMIN.'&view=stk_situation_report&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->stk_situation_report_model->Delete(get('id'),''.H_ADMIN.'&view=stk_situation_report&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=stk_situation_report&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	