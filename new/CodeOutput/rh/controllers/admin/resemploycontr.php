
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resemploycontr.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemploycontr
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resemploycontr.php');
	
	class resemploycontr_controller {
	public $resemploycontr_model;
	
	public function __construct()  
    {  
        $this->resemploycontr_model = new resemploycontr_model();
    } 
	
	public function invoke_resemploycontr()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resemploycontr_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resemploycontr_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resemploycontr&do=viewall');
	}else{
	$result = $this->resemploycontr_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resemploycontr/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resemploycontr_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resemploycontr/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resemploycontr_model->SelectOne(get('idemplcontr'));
	include(APP_FOLDER.'/views/admin/resemploycontr/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resemploycontr_model->AutoSearch(trim($qstring),10,'idemploy');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resemploycontr&idemplcontr='.$srow->idemplcontr.'&do=details"><li class="list-group-item">'. $srow->idemploy.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resemploycontr/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('idemploy')==''){
	json_error('The field idemploy cannot be empty!');
	}
	elseif (post('idcontr')==''){
	json_error('The field idcontr cannot be empty!');
	}
	elseif (post('datedbtcontr')==''){
	json_error('The field datedbtcontr cannot be empty!');
	}
	elseif (post('datefincontr')==''){
	json_error('The field datefincontr cannot be empty!');
	}
	else{
	$this->resemploycontr_model->Insert(post('idemploy'),post('idcontr'),post('datedbtcontr'),post('datefincontr'));
	json_send(''.H_ADMIN.'&view=resemploycontr&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resemploycontr_model->SelectOne(get('idemplcontr'));
	include(APP_FOLDER.'/views/admin/resemploycontr/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idemplcontr')==''){
	json_error('The field idemplcontr cannot be empty!');
	}
	elseif (post('idemploy')==''){
	json_error('The field idemploy cannot be empty!');
	}
	elseif (post('idcontr')==''){
	json_error('The field idcontr cannot be empty!');
	}
	elseif (post('datedbtcontr')==''){
	json_error('The field datedbtcontr cannot be empty!');
	}
	elseif (post('datefincontr')==''){
	json_error('The field datefincontr cannot be empty!');
	}
	else{
	$this->resemploycontr_model->Update(post('idemploy'),post('idcontr'),post('datedbtcontr'),post('datefincontr'),post('idemplcontr'));
	json_send(''.H_ADMIN.'&view=resemploycontr&idemplcontr='.post('idemplcontr').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->resemploycontr_model->SelectOne(get('idemplcontr'));
	include(APP_FOLDER.'/views/admin/resemploycontr/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resemploycontr_model->TruncateTable(''.H_ADMIN.'&view=resemploycontr&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resemploycontr/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idemplcontr') and $dfile==''){
	$del = $this->resemploycontr_model->Delete(get('idemplcontr'),''.H_ADMIN.'&view=resemploycontr&do=viewall&msg=delete');
	}
	elseif(get('idemplcontr') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resemploycontr_model->Delete(get('idemplcontr'),''.H_ADMIN.'&view=resemploycontr&do=viewall&msg=delete');
	}
	elseif(get('idemplcontr') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resemploycontr&idemplcontr='.get('idemplcontr').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	