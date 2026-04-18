
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        stk_report.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_report
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/stk_report.php');
	
	class stk_report_controller {
	public $stk_report_model;
	
	public function __construct()  
    {  
        $this->stk_report_model = new stk_report_model();
    } 
	
	public function invoke_stk_report()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->stk_report_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->stk_report_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=stk_report&do=viewall');
	}else{
	$result = $this->stk_report_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/stk_report/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->stk_report_model->SelectAll();
	include(APP_FOLDER.'/views/admin/stk_report/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->stk_report_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/stk_report/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->stk_report_model->AutoSearch(trim($qstring),10,'qte_initial_save');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=stk_report&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->qte_initial_save.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/stk_report/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('qte_initial_save')==''){
	json_error('The field qte initial save cannot be empty!');
	}
	elseif (post('dte_report')==''){
	json_error('The field dte report cannot be empty!');
	}
	elseif (post('dte_report_time')==''){
	json_error('The field dte report time cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('idmvt')==''){
	json_error('The field idmvt cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk_report_model->Insert(post('qte_initial_save'),post('dte_report'),post('dte_report_time'),post('produit_id'),post('idmvt'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=stk_report&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->stk_report_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/stk_report/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('qte_initial_save')==''){
	json_error('The field qte initial save cannot be empty!');
	}
	elseif (post('dte_report')==''){
	json_error('The field dte report cannot be empty!');
	}
	elseif (post('dte_report_time')==''){
	json_error('The field dte report time cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('idmvt')==''){
	json_error('The field idmvt cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk_report_model->Update(post('qte_initial_save'),post('dte_report'),post('dte_report_time'),post('produit_id'),post('idmvt'),post('hotel_id'),post('id'));
	json_send(''.H_ADMIN.'&view=stk_report&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->stk_report_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/stk_report/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->stk_report_model->TruncateTable(''.H_ADMIN.'&view=stk_report&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/stk_report/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->stk_report_model->Delete(get('id'),''.H_ADMIN.'&view=stk_report&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->stk_report_model->Delete(get('id'),''.H_ADMIN.'&view=stk_report&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=stk_report&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	