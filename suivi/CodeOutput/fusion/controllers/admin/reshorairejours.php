
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        reshorairejours.php
	* DATE CREATED:  	20-10-2017
	* FOR TABLE:  		reshorairejours
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/reshorairejours.php');
	
	class reshorairejours_controller {
	public $reshorairejours_model;
	
	public function __construct()  
    {  
        $this->reshorairejours_model = new reshorairejours_model();
    } 
	
	public function invoke_reshorairejours()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->reshorairejours_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->reshorairejours_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=reshorairejours&do=viewall');
	}else{
	$result = $this->reshorairejours_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/reshorairejours/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->reshorairejours_model->SelectAll();
	include(APP_FOLDER.'/views/admin/reshorairejours/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->reshorairejours_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/reshorairejours/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->reshorairejours_model->AutoSearch(trim($qstring),10,'horaire_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=reshorairejours&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->horaire_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/reshorairejours/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('horaire_id')==''){
	json_error('The field horaire id cannot be empty!');
	}
	elseif (post('jours_id')==''){
	json_error('The field jours id cannot be empty!');
	}
	elseif (post('dbt')==''){
	json_error('The field dbt cannot be empty!');
	}
	elseif (post('mrg')==''){
	json_error('The field mrg cannot be empty!');
	}
	elseif (post('fin')==''){
	json_error('The field fin cannot be empty!');
	}
	else{
	$this->reshorairejours_model->Insert(post('horaire_id'),post('jours_id'),post('dbt'),post('mrg'),post('fin'));
	json_send(''.H_ADMIN.'&view=reshorairejours&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->reshorairejours_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/reshorairejours/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('horaire_id')==''){
	json_error('The field horaire id cannot be empty!');
	}
	elseif (post('jours_id')==''){
	json_error('The field jours id cannot be empty!');
	}
	elseif (post('dbt')==''){
	json_error('The field dbt cannot be empty!');
	}
	elseif (post('mrg')==''){
	json_error('The field mrg cannot be empty!');
	}
	elseif (post('fin')==''){
	json_error('The field fin cannot be empty!');
	}
	else{
	$this->reshorairejours_model->Update(post('horaire_id'),post('jours_id'),post('dbt'),post('mrg'),post('fin'),post('id'));
	json_send(''.H_ADMIN.'&view=reshorairejours&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->reshorairejours_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/reshorairejours/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->reshorairejours_model->TruncateTable(''.H_ADMIN.'&view=reshorairejours&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/reshorairejours/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->reshorairejours_model->Delete(get('id'),''.H_ADMIN.'&view=reshorairejours&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->reshorairejours_model->Delete(get('id'),''.H_ADMIN.'&view=reshorairejours&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=reshorairejours&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	