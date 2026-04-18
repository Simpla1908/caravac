
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resempconge.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resempconge
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resempconge.php');
	
	class resempconge_controller {
	public $resempconge_model;
	
	public function __construct()  
    {  
        $this->resempconge_model = new resempconge_model();
    } 
	
	public function invoke_resempconge()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resempconge_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resempconge_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resempconge&do=viewall');
	}else{
	$result = $this->resempconge_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resempconge/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resempconge_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resempconge/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resempconge_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resempconge/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resempconge_model->AutoSearch(trim($qstring),10,'employe_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resempconge&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->employe_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resempconge/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	elseif (post('conge_id')==''){
	json_error('The field conge id cannot be empty!');
	}
	elseif (post('dte1')==''){
	json_error('The field dte1 cannot be empty!');
	}
	elseif (post('dte2')==''){
	json_error('The field dte2 cannot be empty!');
	}
	elseif (post('nbre')==''){
	json_error('The field nbre cannot be empty!');
	}
	else{
	$this->resempconge_model->Insert(post('employe_id'),post('conge_id'),post('dte1'),post('dte2'),post('nbre'));
	json_send(''.H_ADMIN.'&view=resempconge&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resempconge_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resempconge/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	elseif (post('conge_id')==''){
	json_error('The field conge id cannot be empty!');
	}
	elseif (post('dte1')==''){
	json_error('The field dte1 cannot be empty!');
	}
	elseif (post('dte2')==''){
	json_error('The field dte2 cannot be empty!');
	}
	elseif (post('nbre')==''){
	json_error('The field nbre cannot be empty!');
	}
	else{
	$this->resempconge_model->Update(post('employe_id'),post('conge_id'),post('dte1'),post('dte2'),post('nbre'),post('id'));
	json_send(''.H_ADMIN.'&view=resempconge&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->resempconge_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resempconge/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resempconge_model->TruncateTable(''.H_ADMIN.'&view=resempconge&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resempconge/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->resempconge_model->Delete(get('id'),''.H_ADMIN.'&view=resempconge&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resempconge_model->Delete(get('id'),''.H_ADMIN.'&view=resempconge&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resempconge&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	