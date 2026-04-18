
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resrubriquesal.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resrubriquesal
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resrubriquesal.php');
	
	class resrubriquesal_controller {
	public $resrubriquesal_model;
	
	public function __construct()  
    {  
        $this->resrubriquesal_model = new resrubriquesal_model();
    } 
	
	public function invoke_resrubriquesal()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resrubriquesal_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resrubriquesal_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resrubriquesal&do=viewall');
	}else{
	$result = $this->resrubriquesal_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resrubriquesal/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resrubriquesal_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resrubriquesal/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resrubriquesal_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resrubriquesal/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resrubriquesal_model->AutoSearch(trim($qstring),10,'rubrique_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resrubriquesal&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->rubrique_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resrubriquesal/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('rubrique_id')==''){
	json_error('The field rubrique id cannot be empty!');
	}
	elseif (post('salaire_id')==''){
	json_error('The field salaire id cannot be empty!');
	}
	elseif (post('valeur')==''){
	json_error('The field valeur cannot be empty!');
	}
	else{
	$this->resrubriquesal_model->Insert(post('rubrique_id'),post('salaire_id'),post('valeur'));
	json_send(''.H_ADMIN.'&view=resrubriquesal&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resrubriquesal_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resrubriquesal/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('rubrique_id')==''){
	json_error('The field rubrique id cannot be empty!');
	}
	elseif (post('salaire_id')==''){
	json_error('The field salaire id cannot be empty!');
	}
	elseif (post('valeur')==''){
	json_error('The field valeur cannot be empty!');
	}
	else{
	$this->resrubriquesal_model->Update(post('rubrique_id'),post('salaire_id'),post('valeur'),post('id'));
	json_send(''.H_ADMIN.'&view=resrubriquesal&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->resrubriquesal_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resrubriquesal/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resrubriquesal_model->TruncateTable(''.H_ADMIN.'&view=resrubriquesal&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resrubriquesal/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->resrubriquesal_model->Delete(get('id'),''.H_ADMIN.'&view=resrubriquesal&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resrubriquesal_model->Delete(get('id'),''.H_ADMIN.'&view=resrubriquesal&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resrubriquesal&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	